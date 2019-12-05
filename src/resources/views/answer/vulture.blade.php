@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/vulture.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">ハゲワシの謎</h1>
            <p class="card-text">※回答は半角英数字&スペース無しで入力してください</p>
        </div>
        <div class="p-md">
            <form action="{{ action('AnswerController@vultureAnswer') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input class="m-b-md" type="text" name="nazo_vulture" placeholder="解答"><br>
                <button class="btn is-success is-ghost is-outline" type="submit">解答する</button>
            </form>
        </div>
    </div>
@endsection
