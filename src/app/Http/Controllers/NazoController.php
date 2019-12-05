<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NazoController extends Controller
{
    public function duck()
    {
        return view('nazo/duck');
    }

    public function duckDetail()
    {
        return view('detail/duck');
    }

    public function anubis()
    {
        return view('nazo/anubis');
    }

    public function anubisDetail() {
        return view('detail/anubis');
    }

    public function cow()
    {
        return view('nazo/cow');
    }

    public function cowDetail() {
        return view('detail/cow');
    }

    public function lion()
    {
        return view('nazo/lion');
    }

    public function lionDetail() {
        return view('detail/lion');
    }

    public function vulture()
    {
        return view('nazo/vulture');
    }

    public function vultureDetail()
    {
        return view('detail/vulture');
    }

}
