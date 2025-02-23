<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header">
            <a href="#" class="header-logo"><img src="{{ asset('logo/logo.svg') }}" alt="logo" class="logo-img"></a>
            <input type="text" name="search" class="header-input" placeholder="なにをお探しですか？">
            <nav class="header-nav">
                @auth
                    <li><a href="#">ログアウト</a></li>
                @endauth
                @guest
                    <li><a href="#">ログイン</a></li>
                @endguest
                <li><a href="#">マイページ</a></li>
                <li><a href="{{ route('sell') }}">出品</a></li>
            </nav>
        </div>
    </header>
    @yield('main')
</body>
</html>