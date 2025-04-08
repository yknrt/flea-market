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
                <span>{{ number_format($item->price) }}</span>
                <span>(税込)</span>
            </div>
            <div class="product-count">
                <div class="count-content">
                    <form action="/favorite" method="post">
                        @csrf
                        <input type="hidden" name="exhibition_id" value="{{ $item->id }}">
                        <button class="favorite-btn" type="submit">
                            @if (in_array($item->id, $favoriteItemIds))
                            <img src="{{ asset('icon/star_on.svg') }}">
                            @else
                            <img src="{{ asset('icon/star_off.svg') }}">
                            @endif
                        </button>
                        <p>{{ $count_favorites }}</p>
                    </form>
                </div>
                <div class="count-content">
                    <img src="{{ asset('icon/comment.svg') }}" alt="comment">
                    <p>{{ $count_comments }}</p>
                </div>
            </div>
            <form action="{{ route('purchase', $item->id) }}">
                <button class="pay-btn" @disabled($item->purchase) >{{ $item->purchase ? "Sold" : "購入手続きへ" }}</button>
            </form>
            <div class="product-description">
                <h2>商品説明</h2>
                <p>{{ $item->description }}</p>
            </div>
            <div class="product-info">
                <h2>商品の情報</h2>
                <div class="info-category">
                    <div class="info-ttl">カテゴリー</div>
                    @foreach($item->categories as $category)
                    <div class="category-tag">{{ $category->category }}</div>
                    @endforeach
                </div>
                <div class="info-condition">
                    <div class="info-ttl">商品の状態</div>
                    <div class="condition">{{ $item->condition->condition }}</div>
                </div>
            </div>
            <div class="product-comment">
                <h2 class="comment-ttl">コメント({{ $count_comments }})</h2>
                @foreach($item->comments as $comment)
                <div class="comment">
                    <div class="profile-img">
                        <img src="{{ $comment->user->profile->img ?? $comment->user->profile?->img ?? asset('icon/default.svg') }}" class="profile-picture">
                        <div class="profile-name">{{ $comment->user->name }}</div>
                    </div>
                    <p class="comment-text">{{ $comment->comment }}</p>
                </div>
                @endforeach
            </div>
            <form action="/comment" method="post">
                @csrf
                <input type="hidden" name="exhibition_id" value="{{ $item->id }}">
                <div class="form-comment">
                    <div class="form--ttl">商品へのコメント</div>
                    <textarea class="form--input" name="comment" rows="5"></textarea>
                    <div class="form-error">
                        @error('comment')
                        {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="form--btn">コメントを送信する</button>
                </div>
            </form>
        </div>
    </div>
@endsection