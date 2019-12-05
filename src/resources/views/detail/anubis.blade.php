@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/anubis.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">アヌビスの謎</h1>
            <p class="card-text">
                どうやらウサギ？のカフェにあるようだ
            </p>
        </div>
        <div class="card-link">
            <a class="nazo_anubis-btn" href="{{ action('NazoController@anubis') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_anubis').submit();">
            カメラを起動する
            </a>
            <form id="nazo_anubis" action="{{ action('NazoController@anubis') }}" method="POST" style="dispaly: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="answer-page">
        <a class="answer_anubis-btn" href="{{ action('AnswerController@anubis') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_anubis').submit();">
            <i class="fas fa-link"></i> 解答ページへ
        </a>
        <form id="answer_anubis" action="{{ action('AnswerController@anubis') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
@endsection
