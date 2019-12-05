@extends('layouts.main')

@section('content')
<div class="description">
    @if ($user->nazo_five == true)
    <form action="{{ action('AnswerController@finish') }}" method="POST">
        @csrf
        <button class="btn is-ghost is-outline is-primary" type="submit">エンドページ:<span class="is-primary">{{ $user->username }}</span></button>
    </form><br>
    @else
    <p>このアプリを使って神戸電子のどこかにある<br>
        謎を解いていこう！<br>
        謎を見つけたら、それと同じマーカー<br>
        のカメラを起動しよう。<br><br>
        ※ARが表示されない場合はマーカーからカメラを離して、
        もう一度かざしてみてください。
    </p>
    @endif
</div>
<div class="nazo-card">
    @if ($user->nazo_first == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/cow-clear.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">暴れる牡牛の謎</h1>
    </div>
    <div class="card-link">
        <span>解読済み</span>
    </div>
    @else
    <img class="card-img" src="{{ asset('image/nazo-hiero/cow.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">暴れる牡牛の謎</h1>
    </div>
    <div class="card-link">
        <a class="nazo_cow-btn" href="{{ action('NazoController@cowDetail') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_cow').submit();">
            謎を探す
        </a>
        <form id="nazo_cow" action="{{ action('NazoController@cowDetail') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    <div class="card-link">
        <a class="answer_cow-btn" href="{{ action('AnswerController@cow') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_cow').submit();">
            解答する
        </a>
        <form id="answer_cow" action="{{ action('AnswerController@cow') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    @endif
</div>

<div class="nazo-card">
    @if ($user->nazo_second == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/lion-clear.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">ライオンの謎</h1>
    </div>
    <div class="card-link">
        <span>解読済み</span>
    </div>
    @elseif ($user->nazo_first == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/lion.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">ライオンの謎</h1>
    </div>
    <div class="card-link">
        <a class="nazo_lion-btn" href="{{ action('NazoController@lionDetail') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_lion').submit();">
            謎を探す
        </a>
        <form id="nazo_lion" action="{{ action('NazoController@lionDetail') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    <div class="card-link">
        <a class="answer_lion-btn" href="{{ action('AnswerController@lion') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_lion').submit();">
            解答する
        </a>
        <form id="answer_lion" action="{{ action('AnswerController@lion') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    @else
    <img class="card-img" src="{{ asset('image/nazo-hiero/hatena.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">？？？</h1>
        <p class="card-text">？？？？？？？？？？？？？？？？</p>
    </div>
    <div class="card-link">
        <span>？？？？？？？</span>
    </div>
    @endif
</div>

<div class="nazo-card">
    @if ($user->nazo_third == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/duck-clear.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">空を飛ぶアヒルの謎</h1>
    </div>
    <div class="card-link">
        <span>解読済み</span>
    </div>
    @elseif ($user->nazo_first == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/duck.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">空を飛ぶのアヒル謎</h1>
    </div>
    <div class="card-link">
        <a class="nazo_duck-btn" href="{{ action('NazoController@duckDetail') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_duck').submit();">
            謎を探す
        </a>
        <form id="nazo_duck" action="{{ action('NazoController@duckDetail') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    <div class="card-link">
        <a class="answer_duck-btn" href="{{ action('AnswerController@duck') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_duck').submit();">
            解答する
        </a>
        <form id="answer_duck" action="{{ action('AnswerController@duck') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    @else
    <img class="card-img" src="{{ asset('image/nazo-hiero/hatena.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">？？？</h1>
        <p class="card-text">？？？？？？？？？？？？？？？？</p>
    </div>
    <div class="card-link">
        <span>？？？？？？？</span>
    </div>
    @endif
</div>

<div class="nazo-card">
    @if ($user->nazo_four == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/anubis-clear.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">アヌビスの謎</h1>
    </div>
    <div class="card-link">
        <span>解読済み</span>
    </div>
    @elseif ($user->nazo_first == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/anubis.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">アヌビスの謎</h1>
    </div>
    <div class="card-link">
        <a class="nazo_anubis-btn" href="{{ action('NazoController@anubisDetail') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_anubis').submit();">
            謎を探す
        </a>
        <form id="nazo_anubis" action="{{ action('NazoController@anubisDetail') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    <div class="card-link">
        <a class="answer_anubis-btn" href="{{ action('AnswerController@anubis') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_anubis').submit();">
            解答する
        </a>
        <form id="answer_anubis" action="{{ action('AnswerController@anubis') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    @else
    <img class="card-img" src="{{ asset('image/nazo-hiero/hatena.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">？？？</h1>
        <p class="card-text">？？？？？？？？？？？？？？？？</p>
    </div>
    <div class="card-link">
        <span>？？？？？？？</span>
    </div>
    @endif
</div>

<div class="nazo-card">
    @if ($user->nazo_five == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/vulture-clear.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">ハゲワシの謎</h1>
    </div>
    <div class="card-link">
        <span>解読済み</span>
    </div>
    @elseif ($user->nazo_first == true && $user->nazo_second == true && $user->nazo_third == true && $user->nazo_four == true)
    <img class="card-img" src="{{ asset('image/nazo-hiero/vulture.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">ハゲワシの謎</h1>
    </div>
    <div class="card-link">
        <a class="nazo_vulture-btn" href="{{ action('NazoController@vultureDetail') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_vulture').submit();">
            謎を探す
        </a>
        <form id="nazo_vulture" action="{{ action('NazoController@vultureDetail') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    <div class="card-link">
        <a class="answer_vulture-btn" href="{{ action('AnswerController@vulture') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_vulture').submit();">
            解答する
        </a>
        <form id="answer_vulture" action="{{ action('AnswerController@vulture') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
    @else
    <img class="card-img" src="{{ asset('image/nazo-hiero/hatena.svg') }}" alt="">
    <div class="card-content">
        <h1 class="card-title">？？？</h1>
        <p class="card-text">？？？？？？？？？？？？？？？？</p>
    </div>
    <div class="card-link">
        <span>？？？？？？？</span>
    </div>

    @endif
</div>
@endsection
