@extends('layouts.main')

@section('content')
    @if (session('flash_message'))
        <div class="flash_message" style="background-color: #1cb4c7; padding: 10px;">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="content">
        <div class="title is-tablet-md is-mobile-xxs m-b-md">{{ Auth::user()->username }}</div>
        <div class="adddb m-b-md">
            <p>ステップ1</p>
            <form action="{{ action('AnswerController@table') }}" method="POST">
                @csrf
                <button class="btn is-success is-ghost is-outline" type="submit">DB追加</button>
            </form>
        </div>
        <div class="logout-btn">
            <p>ステップ２</p>
            <a class="logout-btn btn is-danger is-ghost is-outline" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@endsection
