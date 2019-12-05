<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function portal()
    {
        $user = Answer::where('user_id', Auth::user()->id)->first();
        return view('nazo/portal', compact('user'));
    }

    public function cow() {
        return view('answer/cow');
    }

    public function cowAnswer(Request $request)
    {
        $form = $request->nazo_cow;
        if($form == 'こどく'){
            $user = Answer::where('user_id', Auth::user()->id)->first();
            $user->nazo_first = true;
            $user->save();
            return redirect()->to('/portal');
        }else{
            return view('detail/bad');
        }
    }

    public function lion() {
        return view('answer/lion');
    }

    public function lionAnswer(Request $request)
    {
        $form = $request->nazo_lion;
        if($form == 'あい'){
            $user = Answer::where('user_id', Auth::user()->id)->first();
            $user->nazo_second = true;
            $user->save();
            return redirect()->to('/portal');
        }else{
            return view('detail/bad');
        }
    }

    public function duck()
    {
        return view('answer/duck');
    }

    public function duckAnswer(Request $request)
    {
        $form = $request->nazo_duck;
        if($form == '045'){
            $user = Answer::where('user_id', Auth::user()->id)->first();
            $user->nazo_third = true;
            $user->save();
            return redirect()->to('/portal');
        }else{
            return view('detail/bad');
        }
    }

    public function anubis()
    {
        return view('answer/anubis');
    }

    public function anubisAnswer(Request $request)
    {
        $form = $request->nazo_anubis;
        if($form == 'ひとりぼっち'){
            $user = Answer::where('user_id', Auth::user()->id)->first();
            $user->nazo_four = true;
            $user->save();
            return redirect()->to('/portal');
        }else{
            return view('detail/bad');
        }
    }

    public function vulture()
    {
        return view('answer/vulture');
    }

    public function vultureAnswer(Request $request)
    {
        $form = $request->nazo_vulture;
        if($form == 'thisstoryisalie!'){
            $user = Answer::where('user_id', Auth::user()->id)->first();
            $user->nazo_five = true;
            $user->save();
            return redirect()->to('/portal');
        }else{
            return view('detail/bad');
        }
    }

    public function finish()
    {
        return view('detail/finish');
    }

    public function staff()
    {
        return view('staff');
    }

    public function table()
    {
        $answer = new Answer();
        $answer->user_id = Auth::user()->id;
        $answer->username = Auth::user()->username;
        $answer->nazo_first = false;
        $answer->nazo_second = false;
        $answer->nazo_third = false;
        $answer->nazo_four = false;
        $answer->nazo_five = false;
        $answer->save();

        return redirect('/staff/adddb')->with('flash_message', '登録が完了しました');
    }
}
