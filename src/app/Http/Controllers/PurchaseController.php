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
        return view('purchase', compact('item', 'user'));
    }

    public function address($id)
    {
        return view('address');
    }
}
