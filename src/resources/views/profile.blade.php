@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('main')
    <div class="profile">
        <h1 class="profile-ttl">プロフィール設定</h1>
        <div class="profile-img">
            <img src="#" class="profile-picture">
            <label class="upload-label">画像を選択する
                <input type="file" accept="image/*" class="upload-input" >
            </label>
        </div>
        <form action="" class="profile-form">
            <div class="form-inner">
                <label class="form--label">ユーザー名
                    <input type="text" name="name" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">郵便番号
                    <input type="text" name="zip" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">住所
                    <input type="text" name="address" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">建物名
                    <input type="password" name="building" class="form--input">
                </label>
            </div>
            <button class="form-btn">更新する</button>
        </form>
    </div>
@endsection