<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.2.0/dist/css/yakuhanjp.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/musubii@6.5.0/docs/css/musubii.min.css">

    <style>
        html, boby {
            background-color: #000;
            font-family: YakuHanJP, "Hiragino Sans";
            height: 100vh;
        }

        input {
            background-color:transparent;
        }
        .content {
            height: 100vh;
        }

        .main {
            vertical-align: middle;
        }

        .title-logo {
            padding: 20px;
        }
    </style>
</head>
<body style="max-width:575px; margin:auto;">
    <div class="section content">
        <div class="inner">
            <div class="grid is-center">
                <div class="col is-mobile-12 is-tablet-6 main">
                    <img class="title-logo" src="{{ asset('image/title-logo.svg') }}" alt="">
                    <div class="group">
                        <form class="form is-space" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                            <div class="field">
                                <input id="username" type="text" class="input is-mobile-full is-primary @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="ユーザーネーム">

                                @error('username')
                                <span class="texts is-danger is-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="field bg">
                                <input id="password" type="password" class="input is-primary is-mobile-full @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">

                                @error('password')
                                <span class="texts is-danger is-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="btns">
                                <button type="submit" class="btn is-primary is-mobile-full is-ghost is-outline">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
