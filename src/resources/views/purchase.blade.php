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
                        <p>¥{{ number_format($item->price) }}</p>
                    </div>
                </div>
            </div>
            <div class="payment-method">
                <div class="method-ttl">支払い方法</div>
                <select name="method" class="select" id="selectMethod">
                    <option selected disabled>選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード払い</option>
                </select>
            </div>
            <div class="shipping-address">
                <div class="address-header">
                    <div class="address-ttl">配送先</div>
                    <a href="{{ route('address', $item->id) }}">変更する</a>
                </div>
                <div class="address-txt">
                    <p>〒 {{ $address['zip'] }}</p>
                    <p>{{ $address['address'] }}</p>
                    <p>{{ $address['building'] }}</p>
                </div>
            </div>
        </div>
        <div class="payment-info">
            <table class="table">
                <tr class="table__row">
                    <td class="table__header">商品代金</td>
                    <td class="table__text">¥{{ number_format($item->price) }}</td>
                </tr>
                <tr class="table__row">
                    <td class="table__header">支払い方法</td>
                    <td class="table__text" id="displayMethod">-</td>
                </tr>
            </table>
            <form action="/purchase/checkout" method="post">
                @csrf
                <input type="hidden" name="item" value="{{ $item->id }}">
                <input type="hidden" name="zip" value="{{ $address['zip'] }}">
                <input type="hidden" name="address" value="{{ $address['address'] }}">
                <input type="hidden" name="building" value="{{ $address['building'] }}">
                <input type="hidden" name="method" id="inputMethod">
                <button type="submit" class="form-btn">購入する</button>
            </form>
        </div>
    </div>
    <script>
        const selectMethodField = document.getElementById('selectMethod');
        const displayMethodField = document.getElementById('displayMethod');
        const inputMethodField = document.getElementById('inputMethod');
        selectMethodField.addEventListener('input', function () {
            if (selectMethodField.value == 'card') {
                displayMethodField.textContent = 'カード払い';
            } else {
                displayMethodField.textContent = 'コンビニ払い';
            }
            inputMethodField.value = selectMethodField.value;
        });
    </script>
@endsection