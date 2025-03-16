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
            <li><a href="#">出品した商品</a></li>
            <li><a href="#">購入した商品</a></li>
        </nav>
    </div>
    <div class="products">
        <div class="button-container">
            <button class="image-button">
                <img class="product-img" src="https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg" alt="商品画像">
            </button>
            <div class="button-label">商品名</div>
        </div>
        <div class="button-container">
            <button class="image-button">
                <img class="product-img" src="https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg" alt="商品画像">
            </button>
            <div class="button-label">商品名</div>
        </div>
        <div class="button-container">
            <button class="image-button">
                <img class="product-img" src="https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg" alt="商品画像">
            </button>
            <div class="button-label">商品名</div>
        </div>
    </div>
@endsection