<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function myPage()
    {
        $user = Auth::user();
        return view('mypage', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($request->name != $user->name) {
            $user->name = $request->name;
            $user->save();
        }

        $profile = Profile::where('user_id', $user->id)->first();
        dd($profile);
        if (empty($profile)) {
            $form = $request->all();
            dd($form);
            $form['$user_id'] = $user->id;
            Profile::create($form);
            return redirect()->route('myList');
        } else {
            $form = $request->all();
            dd($form);
            unset($form['_token']);
            $profile->update($form);
            return redirect()->route('mypage');
        }

        return back();
    }

}
