<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exhibition;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $userId = Auth::id();
        if ($tab == 'all') {
            if (empty($user)) {
                $exhibitions = Exhibition::all();
            } else {
                $exhibitions = Exhibition::whereNotIn('user_id', [$userId])->get();
            }
        } else {
            if (empty($userId)) {
                $exhibitions = [];
            } else {
                $user = Auth::user();
                $exhibitions = [];
                $favorites = $user->favorites;
                foreach ($favorites as $favorite) {
                    $exhibition = Exhibition::find($favorite->exhibition_id);
                    array_push($exhibitions, $exhibition);
                }
            }
        }
        return view('index', compact('exhibitions'));
    }
}
