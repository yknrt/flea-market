<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exhibition;

class ListController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        if (empty($user)) {
            $exhibitions = Exhibition::all();
        } else {
            $exhibitions = Exhibition::whereNotIn('user_id', [$user])->all();
        }
        return view('index', compact('exhibitions'));
    }

    public function mylist()
    {
        $user = Auth::id();
        if (empty($user)) {
            return view('auth/login');
        }
        // お気に入りリスト一覧
        $exhibitions = Exhibition::whereNotIn('user_id', [$user])->all();
        return view('index', compact('exhibitions'));
    }

}
