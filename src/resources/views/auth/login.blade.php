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
        <h1 class="content-ttl">ログイン</h1>
        <form action="/login" method="post" class="content-form">
            @csrf
            <div class="form-inner">
                <label class="form--label">メールアドレス
                <input type="text" name="email" class="form--input">
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
            <div class="form-error">
                @if ($errors->has('login'))
                    {{ $errors->first('login') }}
                @endif
            </div>
            <button type="submit" class="form-btn">ログインする</button>
        </form>
        <a href="{{ route('register') }}" class="content-link">会員登録はこちら</a>
    </div>
</body>
</html>