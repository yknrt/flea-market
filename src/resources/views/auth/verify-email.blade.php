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
        <div class="content-txt">
            <p class="txt-row">登録していただいたメールアドレスに認証メールを送付しました。</p>
            <p class="txt-row">メール認証を完了してください。</p>
        </div>
        @if (!auth()->user()->hasVerifiedEmail())
            <a href="{{ route('verification.notice') }}" class="verify">認証はこちらから</a>
        @else
            <a href="{{ route('profile') }}" class="verify">認証はこちらから</a>
        @endif
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" class="resend-email">認証メールを再送する</button>
        </form>
    </div>
</body>
</html>