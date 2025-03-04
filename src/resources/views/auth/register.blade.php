<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <header>
        <div class="header">
            <a href="{{ route('home') }}" class="header-logo"><img src="{{ asset('logo/logo.svg') }}" alt="logo" class="logo-img"></a>
        </div>
    </header>
    <div class="content">
        <h1 class="content-ttl">会員登録</h1>
        <form action="/register" method="post" class="content-form">
            @csrf
            <div class="form-inner">
                <label class="form--label">ユーザー名
                <input type="text" name="name" class="form--input" value="{{ old('name') }}">
                </label>
            </div>
            <div class="form-error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">メールアドレス
                <input type="email" name="email" class="form--input" value="{{ old('email') }}">
                </label>
            </div>
            <div class="form-error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">パスワード
                <input type="password" name="password" class="form--input">
                </label>
            </div>
            <div class="form-error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="form-inner">
                <label class="form--label">確認用パスワード
                <input type="password" name="password_confirmation" class="form--input">
                </label>
            </div>
            <button type="submit" class="form-btn">登録する</button>
        </form>
        <a href="{{ route('login') }}" class="content-link">ログインはこちら</a>
    </div>
</body>
</html>