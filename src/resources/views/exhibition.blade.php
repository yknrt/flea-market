@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/listing.css') }}">
@endsection
@section('main')
    <div class="listing">
        <h1 class="listing-ttl">商品の出品</h1>
        <form action="" class="listing-form">
            <div class="form-inner">
                <p class="form--label">商品の画像</p>
                <div class="product-img">
                    <label class="upload-label">画像を選択する
                        <input type="file" accept="image/*" class="upload-input" >
                    </label>
                </div>
            </div>
            <h2 class="product-ttl">商品の詳細</h2>
            <div class="form-inner">
                <p class="form--label">カテゴリー</p>
                <input type="checkbox" name="category" class="checkbox-input" id="check1" value="1">
                <label for="check1" class="checkbox-label">ファッション</label>
            </div>
            <div class="form-inner">
                <p class="form--label">商品の状態</p>
                <select name="condition" class="form--select">
                    <option selected disabled>選択してください</option>
                    <option value="1">良好</option>
                    <option value="2">目立った傷や汚れなし</option>
                    <option value="3">やや傷や汚れあり</option>
                    <option value="4">状態が悪い</option>
                </select>
            </div>
            <div class="form-inner">
                <label class="form--label">商品名
                    <input type="text" name="name" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">商品の説明
                    <input type="textarea" name="description" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">販売価格
                    <input type="text" name="price" class="form--input" value="¥">
                </label>
            </div>
            <button class="form-btn">出品する</button>
        </form>
    </div>
@endsection