@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/exhibition.css') }}">
@endsection
@section('main')
    <div class="listing">
        <h1 class="listing-ttl">商品の出品</h1>
        <form action="/sell/exhibition" method="post" class="listing-form" enctype="multipart/form-data">
            @csrf
            <div class="form-inner">
                <p class="form--label">商品の画像</p>
                <div class="product-img">
                    <div id="img-container">
                        <img class="img--preview" id="profile-preview" src="" alt="プロフィール画像のプレビュー" style="display: none;">
                        <label class="upload-label" for="img-input">画像を選択する</label>
                    </div>
                    <input type="file" name="image" class="upload-input" id="img-input" onchange="previewImage(event)" >
                </div>
                <div class="form-error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <h2 class="product-ttl">商品の詳細</h2>
            <div class="form-inner">
                <p class="form--label">カテゴリー</p>
                @foreach($categories as $category)
                    <input type="checkbox" name="categories[]" class="checkbox-input" id="check{{ $category->id }}" value="{{ $category->id }}">
                    <label for="check{{ $category->id }}" class="checkbox-label">{{ $category->category }}</label>
                @endforeach
            </div>
            <div class="form-error">
                @error('categories')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <p class="form--label">商品の状態</p>
                <select name="condition" class="form--select">
                    <option selected disabled>選択してください</option>
                    @foreach($conditions as $condition)
                        <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-error">
                @error('condition')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">商品名
                    <input type="text" name="name" class="form--input">
                </label>
            </div>
            <div class="form-error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">ブランド名
                    <input type="text" name="brand" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">商品の説明
                    <input type="textarea" name="description" class="form--input" rows="4">
                </label>
            </div>
            <div class="form-error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">販売価格
                    <input type="number" name="price" class="form--input" placeholder="¥">
                </label>
            </div>
            <div class="form-error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
            <button type="submit" class="form-btn">出品する</button>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('profile-preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection