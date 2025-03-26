<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Exhibition;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');
        if ($tab == 'sell') {
            $user = Auth::user();
            $exhibitions = $user->exhibitions;
        } else {
            $user = Auth::user();
            $exhibitions = $user->exhibitions;
        }
        return view('mypage', compact('user', 'exhibitions'));
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
            return redirect()->route('myList');
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
