<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Exhibition;
use App\Models\Profile;
use App\Models\purchase;
use App\Models\Message;
use App\Models\Review;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        $user = Auth::user();

        #未読メッセージの取得
        $purchaseBuyerIds = $user->purchases->pluck('id');
        $purchaseExhibitionsId = $user->exhibitions->pluck('id');
        $purchaseSellerIds = Purchase::whereIn('exhibition_id', $purchaseExhibitionsId)->pluck('id');

        if ($purchaseSellerIds) {
            $purchases = purchase::whereIn('id', $purchaseBuyerIds)->orWhereIn('id', $purchaseSellerIds)->get();
        } else {
            $purchases = purchase::whereIn('id', $purchaseBuyerIds)->get();
        }
        $notReadMessage = $purchases->flatMap->messages->where('is_read', 0)->where('user_id', '!=', $user->id)->pluck('purchase_id')->toArray();

        if ($tab == 'sell') {
            $exhibitions = $user->exhibitions;
        } elseif ($tab == 'buy') {
            $purchaseExhibitionIds = $user->purchases->pluck('exhibition_id');
            $exhibitions = Exhibition::whereIn('id', $purchaseExhibitionIds)->get();
        } else {
            $purchaseId = $purchases->pluck('id')->toArray();

            $arrReviewedId = Review::whereIn('purchase_id', $purchaseId)->where('user_id', $user->id)->pluck('purchase_id')->toArray();

            $exhibitions = $purchases->whereNotIn('id', $arrReviewedId)->sortByDesc('talked_at')->values()->all();
        }

        $rating = $purchases->where('talked', 1)->flatMap->reviews->where('user_id', '!=', $user->id)->pluck('score')->toArray();
        if (count($rating)) {
            $average = round(array_sum($rating) / count($rating));
        } else {
            $average = 0;
        }

        return view('mypage', compact('user', 'notReadMessage', 'exhibitions', 'average'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        if ($request->name != $user->name) {
            $user->name = $request->name;
            $user->save();
        }

        $profile = Profile::where('user_id', $user->id)->first();
        if (empty($profile)) {
            $form = $request->all();
            unset($form['_token']);
            $form['user_id'] = $user->id;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $path = $request->file('image')->store('public/images/profiles');
                    $img = Storage::url($path);
                    $form['img'] = $img;
                }
            }
            Profile::create($form);
            return redirect()->route('home', ['tab' => 'mylist']);
        } else {
            $form = $request->all();
            unset($form['_token']);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $this->delete_image($request->img);
                    $path = $request->file('image')->store('public/images/profiles');
                    $img = Storage::url($path);
                    $form['img'] = $img;
                }
            }
            $profile->update($form);
            return redirect()->route('mypage');
        }

        return back();
    }

    private function delete_image($img){
        if (!empty($img)) {
            $replace = str_replace('/storage', 'public', $img);
            Storage::delete($replace);
        }
    }
}
