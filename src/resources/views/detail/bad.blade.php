@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/bad.png') }}" alt="">
        <div class="card-content">
            <h1 class="card-title"></h1>
            <p class="card-text">
                どうやら答えが違うようだ...<br>
                もう一度、謎をとき直してみよう！<br>
            </p>
        </div>
        <div class="card-link">
            <a href="/portal">ホームに戻る</a>
        </div>
    </div>
    <div class="answer-page">
        <a href="/hint"><i class="fas fa-link"></i> どうしてもわからない場合</a>
    </div>
@endsection
