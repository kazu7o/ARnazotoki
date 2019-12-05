@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/lion.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">ライオンの謎</h1>
            <p class="card-text">
                建物入り口付近にあるらしいぞ
            </p>
        </div>
        <div class="card-link">
            <a class="nazo_lion-btn" href="{{ action('NazoController@lion') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_lion').submit();">
            カメラを起動する
            </a>
            <form id="nazo_lion" action="{{ action('NazoController@lion') }}" method="POST" style="dispaly: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="answer-page">
        <a class="answer_lion-btn" href="{{ action('AnswerController@lion') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_lion').submit();">
            <i class="fas fa-link"></i> 解答ページへ
        </a>
        <form id="answer_lion" action="{{ action('AnswerController@lion') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
@endsection
