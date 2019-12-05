@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/duck.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">空を飛ぶアヒルの謎</h1>
            <p class="card-text">
                南館のゲームセンターにあるという情報を手に入れた！
            </p>
        </div>
        <div class="card-link">
            <a class="nazo_duck-btn" href="{{ action('NazoController@duck') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_duck').submit();">
            カメラを起動する
            </a>
            <form id="nazo_duck" action="{{ action('NazoController@duck') }}" method="POST" style="dispaly: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="answer-page">
        <a class="answer_duck-btn" href="{{ action('AnswerController@duck') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_duck').submit();">
            <i class="fas fa-link"></i> 解答ページへ
        </a>
        <form id="answer_duck" action="{{ action('AnswerController@duck') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
@endsection
