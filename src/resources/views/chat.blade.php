<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="header">
            <a href="{{ route('home') }}" class="header-logo"><img src="{{ asset('logo/logo.svg') }}" alt="logo" class="logo-img"></a>
        </div>
    </header>
    <div class="grid-parent">
        <div class="side">
            <p class="side-title">その他の取引</p>
            @foreach($sortDealings as $dealing)
                <form action="/chat">
                    <input type="hidden" name="item" value="{{ $dealing->dealing->exhibition->id }}">
                    <input type="hidden" name="dealing" value="{{ $dealing->dealing->id }}">
                    <button class="side-link">{{ $dealing->dealing->exhibition->name }}</button>
                </form>
            @endforeach
        </div>
        <div class="ttl">
            <img src="{{ $trade->exhibition->user->profile?->img ?? asset('icon/default.svg') }}" class="ttl-img">
            <span class="ttl-txt">「{{ $trade['user_id'] == $user->id ? $trade['exhibition']->user->name : $trade->user->name }}」さんとの取引画面</span>
            <label for="modal-toggle" class="complete-btn" style="{{$trade['user_id'] == $user->id ? '' : 'display:none'}}">取引を完了する</label>
            <input type="checkbox" id="modal-toggle" class="modal-toggle" @checked($trade['completed'] == 1) />

            <div class="modal">
                <div class="modal-content">
                    <div class="form-error">
                        @error('rating')
                            {{ $message }}
                        @enderror
                    </div>
                    <p>取引が完了しました。</p>
                    <form action="/chat/review" method="post">
                        @csrf
                        <div class="rating">
                            <p>今回の取引相手はどうでしたか？</p>
                            <div class="form-rating">
                                @for ($i = 5; $i > 0; $i--)
                                    <input class="form-rating__input" id="star{{$i}}" name="rating" type="radio" value="{{$i}}">
                                    <label class="form-rating__label" for="star{{$i}}"><i class="fa-solid fa-star"></i></label>
                                @endfor
                            </div>
                        </div>
                        <input type="hidden" name="dealing" value="{{ $trade['id'] }}">
                        <button class="review-btn" type="submit">送信する</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="item">
            <img src="{{ asset($item->img) }}" class="item-img">
            <div>
                <p class="item-name">{{ $item->name }}</p>
                <p class="item-price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>
        <div class="chat">
            @foreach($messages as $message)
                @if($message->user_id == $user->id)
                    <div class="my-message">
                        <span class="user-name">{{ $user->name }}</span>
                        <img src="{{ $user->profile?->img ?? asset('icon/default.svg') }}" class="my-img">
                        @if (!empty($message->img))
                            <img src="{{ asset($message->img) }}" alt="送信画像" class="my-chat-img">
                        @endif
                        <p class="chat-message">{{ $message->message }}</p>
                        <div class="chat-btn">
                            <form action="/chat/edit">
                                <input type="hidden" name="messageId" value="{{ $message->id }}">
                                <button>編集</button>
                            </form>
                            <form action="/chat/delete">
                                <input type="hidden" name="messageId" value="{{ $message->id }}">
                                <button>削除</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="your-message">
                        <img src="{{ $trade->exhibition->user->profile?->img ?? asset('icon/default.svg') }}" class="your-img">
                        <span class="user-name">{{ $trade->user->id == $user->id ? $trade->exhibition->user->name : $trade->user->name }}</span>
                        @if (!empty($message->img))
                            <img src="{{ asset($message->img) }}" alt="送信画像" class="your-chat-img">
                        @endif
                        <p class="chat-message">{{ $message->message }}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <form action="/chat/store" method="post" id="input-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dealing" value="{{ $trade['id'] }}">
            <input type="hidden" name="item" value="{{ $item->id }}">
            <img class="img--preview" id="img-preview" src="" alt="送信画像のプレビュー" style="display: none;">
            <div class="form-error">
                @error('message')
                {{ $message }}
                @enderror
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="input">
                @if (session('editMessage'))
                    <input type="hidden" name="update" value="{{ session('editMessage')->id }}">
                    <input type="text" name="message" class="input-message" placeholder="取引メッセージを記入してください" value="{{ session('editMessage')->message }}">
                @else
                    <input type="text" name="message" class="input-message" id="messageInput{{ $item->id }}.{{ $trade['user_id'] }}" placeholder="取引メッセージを記入してください" value="{{ old('message') }}">
                @endif
                <label class="upload-label">画像を追加
                    <input type="file" name="image" class="upload-input" onchange="previewImage(event)">
                </label>
                <button class="input-btn" id="input-btn{{ $item->id }}.{{ $trade['user_id'] }}" type="submit">
                    <img src="{{ asset('icon/inputbtn.jpg') }}">
                </button>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('img-preview');
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
    <script>
        const input = document.getElementById('messageInput{{ $item->id }}.{{ $trade["user_id"] }}');

        // 入力時にlocalStorageへ保存
        input.addEventListener('input', () => {
            localStorage.setItem('messageInput{{ $item->id }}.{{ $trade["user_id"] }}', input.value);
        });

        // ページ読み込み時にlocalStorageから取得
        window.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('messageInput{{ $item->id }}.{{ $trade["user_id"] }}');
            if (saved) {
                input.value = saved;
            }
        });
    </script>
    <script>
        document.getElementById('input-btn{{ $item->id }}.{{ $trade["user_id"] }}').addEventListener('click', function (e) {
            e.preventDefault();

            // ✅ localStorageのデータを削除
            localStorage.removeItem('messageInput{{ $item->id }}.{{ $trade["user_id"] }}');  // 特定のキー
            document.getElementById('input-form').submit();

        });
    </script>
</body>
</html>