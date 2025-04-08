<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Condition;
use App\Models\Exhibition;
use App\Models\Favorite;
use Session;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');
        $userId = Auth::id();
        $query = Exhibition::query();
        if ($request->has('search')) {
            $keyword = $request->search;
            Session::forget('search');
        } elseif (Session::get('search')) {
            $keyword = Session::get('search');
        } else {
            $keyword = '';
        }

        if ($tab === 'all') {
            $query = $this->searchKeyword($query, $keyword);
        } else {
            if ($userId) {
                $user = Auth::user();
                $favoriteExhibitionIds = $user->favorites->pluck('exhibition_id'); // お気に入りのIDリスト取得
                $query = $this->searchKeyword($query, $keyword);
                $query->whereIn('id', $favoriteExhibitionIds);
            } else {
                $query->whereRaw('1 = 0'); // ユーザーがログインしていない場合、結果を空にする
            }
        }
        $exhibitions = $query->get();

        return view('index', compact('exhibitions'));
    }

    public function productView($id)
    {
        $item = Exhibition::find($id);
        $favorites = $item->favorites;
        $count_favorites = count($favorites);
        $comments = $item->comments;
        $count_comments = count($comments);
        $user = Auth::user();
        // ログイン中のユーザーのお気に入り店舗IDを取得
        if (!empty($user)) {
            $favoriteItemIds = $user->favorites()->pluck('exhibition_id')->toArray();
        } else {
            $favoriteItemIds = [];
        }
        return view('product', compact('item', 'count_favorites', 'count_comments', 'favoriteItemIds'));
    }

    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('exhibition', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $form = $request->all();
        unset($form['_token'], $form['condition'], $form['categories'], $form['image']);
        $user = Auth::id();
        $form['user_id'] = $user;
        $form['condition_id'] = $request->condition;
        $path = $request->file('image')->store('public/images/items');
        $img = Storage::url($path);
        $form['img'] = $img;
        $item = Exhibition::create($form);
        $categories = $request->input('categories', []);
        $item->categories()->attach($categories);

        return redirect()->route('mypage', ['tab' => 'sell']);
    }

    public function favorite(Request $request)
    {
        $user = Auth::user();
        $favorite = Favorite::all();
        // 既にお気に入り登録済みかチェック
        if ($user->favorites()->where('exhibition_id', $request->exhibition_id)->exists()) {
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

    public function comment(CommentRequest $request)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'exhibition_id' => $request->exhibition_id,
            'comment' => $request->comment,
        ]);
        return redirect()->back();
    }

    private function searchKeyword($query, $keyword)
    {
        $userId = Auth::id();
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
            session(['search' => $keyword]);
        }
        $query->where('user_id', '!=', $userId);
        return $query;
    }

}
