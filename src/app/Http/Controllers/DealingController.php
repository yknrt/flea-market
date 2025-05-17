<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\Models\Exhibition;
use App\Models\Purchase;
use App\Models\Message;
use App\Models\Review;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\ReviewRequest;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class DealingController extends Controller
{
    public function index(Request $request)
    {
        // マイページからチャットへ
        $user = Auth::user();
        $item = Exhibition::find($request->item);

        $trade = Purchase::find($request->purchase);

        $messages = Message::where('purchase_id', $trade->id)->get();

        // 未読メッセージを既読にする
        $yourMessages = $messages->where('user_id', '!=', $user->id);
        foreach ($yourMessages as $yourMessage) {
            $yourMessage->is_read = true;
            $yourMessage->save();
        }

        $exhibitions = Exhibition::where('user_id', $user->id)->pluck('id');
        $purchases = Purchase::whereIn('exhibition_id', $exhibitions)->orWhere('user_id', $user->id)->where('id', '!=', $trade->id)->get();

        $purchaseId = $purchases->pluck('id')->toArray();
        $arrReviewedId = Review::whereIn('purchase_id', $purchaseId)->where('user_id', $user->id)->pluck('purchase_id')->toArray();

        $sortPurchases = $purchases->whereNotIn('id', $arrReviewedId)->where('id', '!=', $trade->id)->sortByDesc('talked_at')->values()->all();

        return view('chat', compact('item', 'user', 'trade', 'sortPurchases', 'messages'));
    }

    public function store(ChatRequest $request)
    {
        $item = $request->item;
        $user = Auth::user();

        $trade = Purchase::find($request->purchase);

        if ($request->has('update')) {
            // 送信したメッセージを編集する
            $message = Message::find($request->update);
            $message->message = $request->message;
            $message->save();
        } else {
            $form = [
                'purchase_id' => $trade->id,
                'user_id' => Auth::id(),
                'message' => $request->message
            ];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $path = $request->file('image')->store('public/images/chat');
                    $img = Storage::url($path);
                    $form['img'] = $img;
                }
            }
            Message::create($form);
            $trade->talked_at = Carbon::now();
            $trade->save();
        }

        return redirect()->back();

    }

    public function edit(Request $request)
    {
        $editMessage = Message::find($request->messageId);
        return back()->with(['editMessage'=> $editMessage]);
    }

    public function delete(Request $request)
    {
        $message = Message::find($request->messageId);
        if (!empty($message->img)) {
            $replace = str_replace('/storage', 'public', $message->img);
            Storage::delete($replace);
        }

        $message->delete();
        return redirect()->back();
    }

    public function review(ReviewRequest $request)
    {
        if (empty($request->purchase)) {
            return redirect()->route('home');
        }

        $user = Auth::user();
        $purchase = Purchase::find($request->purchase);
        $purchase->talked = true;
        $purchase->save();

        $form = [
            'purchase_id' => $request->purchase,
            'user_id' => $user->id,
            'score' => $request->rating
        ];
        Review::create($form);

        # メール送信
        if ($user->id == $purchase->user_id) {
            $sellerEmail = $purchase->exhibition->user->email;

            $content = [
                'user' => $user->name,
                'item' => $purchase->exhibition->name,
            ];

            Mail::to($sellerEmail)->send(new NotificationMail($content));
        }

        return redirect()->route('home');
    }
}
