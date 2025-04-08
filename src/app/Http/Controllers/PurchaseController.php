<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exhibition;
use App\Models\Purchase;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function index($id)
    {
        $item = Exhibition::find($id);
        $user = Auth::user();
        $address = session('address', $user->profile);

        return view('purchase', compact('item', 'user', 'address'));
    }

    public function address($id)
    {
        $item = Exhibition::find($id);
        return view('address', compact('item'));
    }

    public function update(AddressRequest $request)
    {
        $contact = $request->all();
        session(['address' => $contact]);

        return redirect()->route('purchase', ['item_id' => $request->item]);
    }

    public function checkout(PurchaseRequest $request)
    {
        $user = Auth::id();
        $purchase = [
            'user_id' => $user,
            'exhibition_id' => $request->item,
            'zip' => $request->zip,
            'address' => $request->address,
            'building' => $request->building
        ];

        Purchase::create($purchase);

        $item = Exhibition::find($request->item);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentMethod = $request->method; // 'card' または 'konbini'
        $session = Session::create([
            'payment_method_types' => [$paymentMethod],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return 'お支払いが完了しました。';
    }

    public function cancel()
    {
        return 'お支払いがキャンセルされました。';
    }
}
