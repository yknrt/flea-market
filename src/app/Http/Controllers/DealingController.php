<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\Models\Exhibition;
use App\Models\Purchase;
use App\Models\Dealing;
use App\Models\Message;
use App\Models\Review;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\ReviewRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class DealingController extends Controller
{
    public function index(Request $request)
    {
        // 商品ページからチャットへ
        $user = Auth::user();
        $item = Exhibition::find($request->item);

        if ($request->has('dealing')) {
            $trade = Dealing::find($request->dealing);
        } else {
            $trade = Dealing::where('exhibition_id', $item->id)->where('user_id', $user->id)->where('completed', 0)->first();
        }

        if (is_null($trade)) {
            // 取引開始
            $trade = [
                'id' => 0,
                'user_id' => $user->id,
                'completed' => 0,
                'user' => $user,
                'exhibition' => $item
            ];
            $messages = [];
            $exhibitions = Exhibition::where('user_id', $user->id)->pluck('id');
            $dealings = Dealing::whereIn('exhibition_id', $exhibitions)->orWhere('user_id', $user->id)->get();

            $dealingId = $dealings->pluck('id')->toArray();
            $arrReviewedId = Review::whereIn('dealing_id', $dealingId)->where('user_id', $user->id)->pluck('dealing_id')->toArray();

            $sortDealings = $dealings->whereNotIn('id', $arrReviewedId)->flatMap->messages->sortByDesc('created_at')->unique('dealing_id')->values()->all();
        } else {
            // 2回目以降
            $messages = Message::where('dealing_id', $trade->id)->get();

            // 未読メッセージを既読にする
            $yourMessages = $messages->where('user_id', '!=', $user->id);
            foreach ($yourMessages as $yourMessage) {
                $yourMessage->is_read = true;
                $yourMessage->save();
            }

            $exhibitions = Exhibition::where('user_id', $user->id)->pluck('id');
            $dealings = Dealing::whereIn('exhibition_id', $exhibitions)->orWhere('user_id', $user->id)->where('id', '!=', $trade->id)->get();

            $dealingId = $dealings->pluck('id')->toArray();
            $arrReviewedId = Review::whereIn('dealing_id', $dealingId)->where('user_id', $user->id)->pluck('dealing_id')->toArray();

            $sortDealings = $dealings->whereNotIn('id', $arrReviewedId)->flatMap->messages->sortByDesc('created_at')->unique('dealing_id')->where('dealing_id', '!=', $trade->id)->values()->all();
        }

        return view('chat', compact('item', 'user', 'trade', 'sortDealings', 'messages'));
    }

    public function store(ChatRequest $request)
    {
        $item = $request->item;
        $user = Auth::user();

        // 初めてチャットをする
        if ($request->dealing == 0) {
            $trade = [
                'user_id' => $user->id,
                'exhibition_id' => $item
            ];
            Dealing::create($trade);
            $trade = Dealing::where('exhibition_id', $item)->where('user_id', $user->id)->first();
        } else {
            $trade = Dealing::find($request->dealing);
        }

        if ($request->has('update')) {
            // 送信したメッセージを編集する
            $message = Message::find($request->update);
            $message->message = $request->message;
            $message->save();
        } else {
            $form = [
                'dealing_id' => $trade->id,
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
        if (empty($request->dealing)) {
            return redirect()->route('home');
        }

        $user = Auth::user();
        $dealing = Dealing::find($request->dealing);
        $dealing->completed = true;
        $dealing->save();

        $form = [
            'dealing_id' => $request->dealing,
            'user_id' => $user->id,
            'score' => $request->rating
        ];
        Review::create($form);

        # メール送信
        if ($user->id == $dealing->user_id) {
            $sellerEmail = $dealing->exhibition->user->email;

            $content = [
                'user' => $user->name,
                'item' => $dealing->exhibition->name,
            ];

            Mail::to($sellerEmail)->send(new NotificationMail($content));
        }

        return redirect()->route('home');
    }
}
