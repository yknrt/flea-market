<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Exhibition;
use App\Models\Profile;
use App\Models\Dealing;
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
        $dealingBuyerIds = $user->dealings->pluck('id');
        $dealingSellerIds = $user->exhibitions->flatMap->dealings->pluck('id');
        $dealings = Dealing::whereIn('id', $dealingBuyerIds)->orWhereIn('id', $dealingSellerIds)->get();
        $notReadMessage = $dealings->flatMap->messages->where('is_read', 0)->where('user_id', '!=', $user->id)->pluck('dealing_id')->toArray();

        if ($tab == 'sell') {
            $exhibitions = $user->exhibitions;
        } elseif ($tab == 'buy') {
            $purchaseExhibitionIds = $user->purchases->pluck('exhibition_id');
            $exhibitions = Exhibition::whereIn('id', $purchaseExhibitionIds)->get();
        } else {
            $dealingId = $dealings->pluck('id')->toArray();
            $arrReviewedId = Review::whereIn('dealing_id', $dealingId)->where('user_id', $user->id)->pluck('dealing_id')->toArray();

            $exhibitions = $dealings->whereNotIn('id', $arrReviewedId)->flatMap->messages->sortByDesc('created_at')->unique('dealing_id')->values()->all();
        }

        $rating = $dealings->where('completed', 1)->flatMap->reviews->where('user_id', '!=', $user->id)->pluck('score')->toArray();
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
