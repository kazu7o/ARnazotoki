@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/duck.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">空を飛ぶアヒルの謎</h1>
            <p class="card-text">※半角英数字で入力してください</p>
        </div>
        <div class="p-md">
            <form action="{{ action('AnswerController@duckAnswer') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input class="m-b-md" type="text" name="nazo_duck" placeholder="解答"><br>
                <button class="btn is-success is-ghost is-outline" type="submit">解答する</button>
            </form>
        </div>
    </div>
@endsection
