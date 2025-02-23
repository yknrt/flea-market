@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('main')
    <div class="product">
        <div class="product-img">
            <img src="{{ asset($item->img) }}" alt="商品画像">
        </div>
        <div class="product-detail">
            <h1 class="product-name">{{ $item->name }}</h1>
            <p class="product-brand">{{ $item->brand }}</p>
            <div class="product-price">
                <span>¥</span>
                <span>{{ $item->price }}</span>
                <span>(税込)</span>
            </div>
            <div class="product-count">
                <div class="count-content">
                    <form action="">
                    @csrf
                        <input type="hidden" name="shop_id" value="{{ $item->id }}">
                        <button class="favorite-btn" type="submit">
                            <img src="{{ asset('icon/star_off.svg') }}">
                        </button>
                        <p>3</p>
                    </form>
                </div>
                <div class="count-content">
                    <img src="{{ asset('icon/comment.svg') }}" alt="comment">
                    <p>1</p>
                </div>
            </div>
            <form action="">
                <button class="pay-btn">購入手続きへ</button>
            </form>
            <div class="product-description">
                <h2>商品説明</h2>
                <p>{{ $item->description }}</p>
            </div>
            <div class="product-info">
                <h2>商品の情報</h2>
                <div class="info-category">
                    <div class="info-ttl">カテゴリー</div>
                    <div class="category-tag">{{ $item->category->category }}</div>
                </div>
                <div class="info-condition">
                    <div class="info-ttl">商品の状態</div>
                    <div class="condition">{{ $item->condition->condition }}</div>
                </div>
            </div>
            <div class="product-comment">
                <h2 class="comment-ttl">コメント(1)</h2>
                <div class="comment">
                    <div class="profile-img">
                        <img src="{{ asset('icon/default.svg') }}" class="profile-picture">
                        <div class="profile-name">admin</div>
                    </div>
                    <p class="comment-text">ここにコメントが入ります。</p>
                </div>
            </div>
            <form action="">
            <div class="form-comment">
                <div class="form--ttl">商品へのコメント</div>
                <textarea class="form--input" name="comment" rows="5"></textarea>
                <button class="form--btn">コメントを送信する</button>
            </div>
            </form>
        </div>
    </div>
@endsection