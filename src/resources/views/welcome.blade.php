<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.2.0/dist/css/yakuhanjp.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/musubii@6.5.0/docs/css/musubii.min.css">


    <!-- Styles -->
    <style>
        html, body {
            background-color: #2E354C;
            color: #636b6f;
            font-weight: 600;
            font-family: YakuHanJP, "Hiragino Sans";
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 64px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="is-mobile-only-full">
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
        @auth
            <a class="logout-btn" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <div class="content">
        <div class="title is-tablet-md is-mobile-xxs m-b-md">AR-NAZOTOKI</div>

        <div class="links">
            <a href="/portal"><button class="btn is-primary is-ghost is-outline">Portal</button></a>
            <a href="/nazo/sun"><button class="btn is-danger is-ghost is-outline">Sun</button></a>
            <a href="/nazo/beetle"><button class="btn is-success is-ghost is-outline">Beetle</button></a>
            <a href="/nazo/dice"><button class="btn is-warning is-ghost is-outline">Dice</button></a>
            <a href="/nazo/hall"><button class="btn is-info is-ghost is-outline">Hall</button></a>
        </div>
    </div>
</div>
</body>
</html>
