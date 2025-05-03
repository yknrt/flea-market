@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection
@section('main')
    <div class="profile">
        <img src="{{ $user->profile->img ?? $user->profile?->img ?? asset('icon/default.svg') }}" class="profile-picture" id="profile-picture">
        <div class="user">
            <p class="profile-name">{{$user->name}}</p>
            <div class="rating">
                @for ($i = 5; $i > 0; $i--)
                    <span class="{{ $average >= $i ? 'rating-true' : 'rating-false' }}"><i class="fa-solid fa-star"></i></span>
                @endfor
            </div>
        </div>
        <a href="{{ route('profile') }}" class="profile-link">プロフィールを編集</a>
    </div>
    <div class="nav">
        <nav class="products-nav">
            <li class="{{ request()->query('tab') === 'sell' ? 'active' : '' }}">
                <a href="{{ route('mypage', ['tab' => 'sell']) }}">出品した商品</a>
            </li>
            <li class="{{ request()->query('tab') === 'buy' ? 'active' : '' }}">
                <a href="{{ route('mypage', ['tab' => 'buy']) }}">購入した商品</a>
            </li>
            <li class="{{ request()->query('tab') === 'transaction' ? 'active' : '' }}">
                <a href="{{ route('mypage', ['tab' => 'transaction']) }}">取引中の商品</a>
                @php
                    $notReadCount = count($notReadMessage)
                @endphp
                <span class="transaction-num">{{ $notReadCount }}</span>
            </li>
        </nav>
    </div>
    <div class="products">
        @if (request()->query('tab') === 'transaction')
            @foreach($exhibitions as $exhibition)
            <div class="button-container">
                <form action="{{ route('chat') }}">
                    <input type="hidden" name="item" value="{{ $exhibition->dealing->exhibition->id }}">
                    <input type="hidden" name="dealing" value="{{ $exhibition->dealing->id }}">
                    <button class="image-button">
                        <img class="product-img" src="{{ asset($exhibition->dealing->exhibition->img) }}" alt="商品画像">
                        @php
                            $arrCount = array_count_values($notReadMessage)
                        @endphp
                        @if (isset($arrCount[$exhibition->dealing->id]))
                            <p class="overlay-text">{{ $arrCount[$exhibition->dealing->id] }}</p>
                        @endif
                    </button>
                </form>
                <div class="button-label">{{ $exhibition->dealing->exhibition->name }}</div>
            </div>
            @endforeach
        @else
            @foreach($exhibitions as $exhibition)
            <div class="button-container">
                <form action="{{ route('item', $exhibition->id) }}">
                    <button class="image-button">
                        <img class="product-img" src="{{ asset($exhibition->img) }}" alt="商品画像">
                    </button>
                </form>
                <div class="button-label">{{ $exhibition->name }}</div>
            </div>
            @endforeach
        @endif
    </div>
@endsection