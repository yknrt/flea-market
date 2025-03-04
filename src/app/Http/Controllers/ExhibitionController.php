<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Exhibition;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Favorite;

class ExhibitionController extends Controller
{
    public function index($id)
    {
        $item = Exhibition::find($id);
        // お気に入り
        // コメント
        return view('product', compact('item'));
    }

    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('exhibition', compact('categories', 'conditions'));
    }

    public function store(Request $request)
    {
        $path = $request->file('image')->store('public/images');
        $img = Storage::url($path);
    }

    public function storeFavorite(Request $request)
    {
        $user = Auth::user();
        $favorite = Favorite::all();
        // 既にお気に入り登録済みかチェック
        if ($user->favorite()->where('exhibition_id', $request->exhibition_id)->exists()) {
            // 削除
            Favorite::where('user_id', $user->id)->where('exhibition_id', $request->exhibition_id)->delete();
        } else {
            // 登録
            $form = [
                'user_id' => $user->id,
                'exhibition_id' => $request->exhibition_id,
            ];
            Favorite::create($form);
        }
        return redirect()->back();
    }
}
