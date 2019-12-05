@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/vulture.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">ハゲワシの謎</h1>
            <p class="card-text">
                最後の問題は北野館の３Fにある！！
            </p>
        </div>
        <div class="card-link">
            <a class="nazo_vulture-btn" href="{{ action('NazoController@vulture') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_vulture').submit();">
            カメラを起動する
            </a>
            <form id="nazo_vulture" action="{{ action('NazoController@vulture') }}" method="POST" style="dispaly: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="answer-page">
        <a class="answer_vulture-btn" href="{{ action('AnswerController@vulture') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_vulture').submit();">
            <i class="fas fa-link"></i> 解答ページへ
        </a>
        <form id="answer_vulture" action="{{ action('AnswerController@vulture') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
@endsection
