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
            <a href="#" class="header-logo"><img src="{{ asset('logo/logo.svg') }}" alt="logo" class="logo-img"></a>
        </div>
    </header>
    <div class="content">
        <h1 class="content-ttl">会員登録</h1>
        <form action="" class="content-form">
            <div class="form-inner">
                <label class="form--label">ユーザー名/メールアドレス
                <input type="text" name="name" class="form--input">
                </label>
            </div>
            <div class="form-inner">
                <label class="form--label">パスワード
                <input type="password" name="password" class="form--input">
                </label>
            </div>
            <button class="form-btn">ログインする</button>
        </form>
        <a href="#" class="content-link">会員登録はこちら</a>
    </div>
</body>
</html>