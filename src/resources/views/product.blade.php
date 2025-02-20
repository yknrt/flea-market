@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('main')
    <div class="product">
        <div class="product-img">
            <img src="https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg" alt="商品画像">
        </div>
        <div class="product-detail">
            <h1 class="product-name">商品名がここに入る</h1>
            <p class="product-brand">ブランド名</p>
            <div class="product-price">
                <span>¥</span>
                <span>47,000</span>
                <span>(税込)</span>
            </div>
            <div class="product-count">
                <div class="count-content">
                    <img src="{{ asset('icon/star.svg') }}" alt="star">
                    <p>3</p>
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
                <p>スタイリッシュなデザインのメンズ腕時計</p>
            </div>
            <div class="product-info">
                <h2>商品の情報</h2>
                <div class="info-category">
                    <div class="info-ttl">カテゴリー</div>
                    <div class="category-tag">洋服</div>
                    <div class="category-tag">メンズ</div>
                </div>
                <div class="info-condition">
                    <div class="info-ttl">商品の状態</div>
                    <div class="condition">良好</div>
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