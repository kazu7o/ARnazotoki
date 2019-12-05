@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/cow.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">暴れる牡牛の謎</h1>
            <p class="card-text">

                <span style="color: #1cb4c7;">最初の謎は北野館1Fにあるらしいぞ！</span><br><br>

                下のボタンを押してマーカーをかざそう！<br>
                謎の答えがわかったら最初のページにある<br>
                「解答する」ボタンから答えを入力してください
            </p>
        </div>
        <div class="card-link">
            <a class="nazo_cow-btn" href="{{ action('NazoController@cow') }}"
            onclick="event.preventDefault();
            document.getElementById('nazo_cow').submit();">
            カメラを起動する
            </a>
            <form id="nazo_cow" action="{{ action('NazoController@cow') }}" method="POST" style="dispaly: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="answer-page">
        <a class="answer_cow-btn" href="{{ action('AnswerController@cow') }}"
            onclick="event.preventDefault();
            document.getElementById('answer_cow').submit();">
            <i class="fas fa-link"></i> 解答ページへ
        </a>
        <form id="answer_cow" action="{{ action('AnswerController@cow') }}" method="POST" style="dispaly: none;">
            @csrf
        </form>
    </div>
@endsection
