@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('main')
    <div class="nav">
        <nav class="products-nav">
            <li class="{{ request()->query('tab') ? '' : 'active'}}"><a href="{{ route('home') }}">おすすめ</a></li>
            <li class="{{ request()->query('tab') ? 'active' : ''}}"><a href="{{ route('home', ['tab' => 'mylist']) }}">マイリスト</a></li>
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