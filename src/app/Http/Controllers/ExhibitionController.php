<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Exhibition;
use App\Models\Category;
use App\Models\Condition;

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
}
