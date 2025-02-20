@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('main')
    <div class="nav">
        <nav class="products-nav">
            <li><a href="#">おすすめ</a></li>
            <li><a href="#">マイリスト</a></li>
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