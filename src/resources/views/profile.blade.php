@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('main')
    <div class="profile">
        <h1 class="profile-ttl">プロフィール設定</h1>
        <form action="/mypage/profile" class="profile-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profile-img">
                <img src="{{ $user->profile->img ?? asset('$user->profile?->img') ?? asset('icon/default.svg') }}" class="profile-picture" id="profile-preview">
                <label class="upload-label">画像を選択する
                    <input type="file" name="image" class="upload-input" onchange="previewImage(event)" >
                </label>
            </div>
            <div class="form-error">
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">ユーザー名
                    <input type="text" name="name" class="form--input" value="{{ $user->name }}">
                </label>
            </div>
            <div class="form-error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">郵便番号
                    <input type="text" name="zip" class="form--input" value="{{ $user->profile->zip ?? $user->profile?->zip ?? '' }}">
                </label>
            </div>
            <div class="form-error">
                @error('zip')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">住所
                    <input type="text" name="address" class="form--input" value="{{ $user->profile->address ?? $user->profile?->address ?? '' }}">
                </label>
            </div>
            <div class="form-error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">建物名
                    <input type="text" name="building" class="form--input" value="{{ $user->profile->building ?? $user->profile?->building ?? '' }}">
                </label>
            </div>
            <button type="submit" class="form-btn">更新する</button>
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
                preview.src = '{{ asset("icon/default.svg") }}';
            }
        }
    </script>
@endsection