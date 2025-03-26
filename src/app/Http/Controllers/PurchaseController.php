<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exhibition;

class PurchaseController extends Controller
{
    public function index($id)
    {
        $item = Exhibition::find($id);
        $user = Auth::user();
        $contact = [];
        return view('purchase', compact('item', 'user', 'contact'));
    }

    public function address($id)
    {
        $item = Exhibition::find($id);
        return view('address', compact('item'));
    }

    public function update(Request $request)
    {
        $contact = $request->all();
        unset($contact['_token']);

        return back()->withInput();
    }
}
