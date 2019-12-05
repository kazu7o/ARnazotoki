@extends('layouts.main')

@section('content')
    <div class="nazo-card">
        <img class="card-img" src="{{ asset('image/nazo-hiero/anubis.svg') }}" alt="">
        <div class="card-content">
            <h1 class="card-title">アヌビスの謎</h1>
        </div>
        <div class="p-md">
            <form action="{{ action('AnswerController@anubisAnswer') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input class="m-b-md" type="text" name="nazo_anubis" placeholder="解答"><br>
                <button class="btn is-success is-ghost is-outline" type="submit">解答する</button>
            </form>
        </div>
    </div>
@endsection
