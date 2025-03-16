@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection
@section('main')
    <div class="payment">
        <div class="payment-detail">
            <div class="product">
                <img src="{{ asset($item->img) }}" alt="商品画像">
                <div class="product-txt">
                    <p class="product-name">商品名</p>
                    <div class="product-price">
                        <p>¥{{ $item->price }}</p>
                    </div>
                </div>
            </div>
            <div class="payment-method">
                <div class="method-ttl">支払い方法</div>
                <select name="method" class="select" id="inputMethod">
                    <option selected disabled>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード払い</option>
                </select>
            </div>
            <div class="shipping-address">
                <div class="address-header">
                    <div class="address-ttl">配送先</div>
                    <a href="{{ route('address', $item->id) }}">変更する</a>
                </div>
                <div class="address-txt">
                    <p>〒 {{ $contact->zip ?? contact?->zip ?? $user->profile?->zip }}</p>
                    <p>{{ $contact->address ?? contact?->address ?? $user->profile?->address }}</p>
                    <p>{{ $contact->building ?? contact?->building ?? $user->profile?->building }}</p>
                </div>
            </div>
        </div>
        <div class="payment-info">
            <table class="table">
                <tr class="table__row">
                    <td class="table__header">商品代金</td>
                    <td class="table__text">¥{{ $item->price }}</td>
                </tr>
                <tr class="table__row">
                    <td class="table__header">支払い方法</td>
                    <td class="table__text" id="displayMethod">-</td>
                </tr>
            </table>
            <form action="">
                <button class="form-btn">購入する</button>
            </form>
        </div>
    </div>
    <script>
        const inputMethodField = document.getElementById('inputMethod');
        const displayMethodField = document.getElementById('displayMethod');
        inputMethodField.addEventListener('input', function () {
            if (inputMethodField.value == '1') {
                displayMethodField.textContent = 'コンビニ払い';
            } else {
                displayMethodField.textContent = 'カード払い';
            }
        });
    </script>
@endsection