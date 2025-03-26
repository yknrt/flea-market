@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('main')
    <div class="profile">
        <img src="{{ $user->profile->img ?? $user->profile?->img ?? asset('icon/default.svg') }}" class="profile-picture" id="profile-picture">
        <label for="profile-picture" class="profile-name">{{$user->name}}</label>
        <a href="{{ route('profile') }}" class="profile-link">プロフィールを編集</a>
    </div>
    <div class="nav">
        <nav class="products-nav">
            <li @class(['active' => request()->query('tab') === 'sell'])>
                <a href="{{ route('mypage', ['tab' => 'sell']) }}">出品した商品</a>
            </li>
            <li @class(['active' => request()->query('tab') === 'buy'])>
                <a href="{{ route('mypage', ['tab' => 'buy']) }}">購入した商品</a>
            </li>
        </nav>
    </div>
    <div class="products">
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
    </div>
@endsection