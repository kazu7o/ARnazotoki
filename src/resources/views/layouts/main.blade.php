<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151328919-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-151328919-1');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>謎の少女からのメッセージ</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.2.0/dist/css/yakuhanjp.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/musubii@6.5.0/docs/css/musubii.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- <script src="https://kit.fontawesome.com/c0449af42e.js" crossorigin="anonymous"></script> -->
</head>

<body>
    <div class="content">
        <div class="header">
            <a href="/portal">謎の少女からのメッセージ</a>
        </div>
        <div class="main">
            @yield('content')
        </div>
    </div>
</body>
</html>
