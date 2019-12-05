<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (config('app.env') === 'production') {
    URL::forceScheme('https');
}

Route::group(['middleware' => 'auth'], function () {

    Route::get('/portal', 'AnswerController@portal');

    Route::get('/staff/adddb', 'AnswerController@staff');
    Route::post('/staff/adddb', 'AnswerController@table');

    Route::post('/duck', 'AnswerController@duck');
    Route::post('/answer/duck', 'AnswerController@duckAnswer');
    Route::post('/detail/duck', 'NazoController@duckDetail');
    Route::post('nazo/duck', 'NazoController@duck');

    Route::post('/anubis', 'AnswerController@anubis');
    Route::post('/answer/anubis', 'AnswerController@anubisAnswer');
    Route::post('/detail/anubis', 'NazoController@anubisDetail');
    Route::post('nazo/anubis', 'NazoController@anubis');

    Route::post('/cow', 'AnswerController@cow');
    Route::post('/answer/cow', 'AnswerController@cowAnswer');
    Route::post('/detail/cow', 'NazoController@cowDetail');
    Route::post('nazo/cow', 'NazoController@cow');

    Route::post('/lion', 'AnswerController@lion');
    Route::post('/answer/lion', 'AnswerController@lionAnswer');
    Route::post('/detail/lion', 'NazoController@lionDetail');
    Route::post('nazo/lion', 'NazoController@lion');

    Route::post('/vulture', 'AnswerController@vulture');
    Route::post('/answer/vulture', 'AnswerController@vultureAnswer');
    Route::post('/detail/vulture', 'NazoController@vultureDetail');
    Route::post('nazo/vulture', 'NazoController@vulture');

    Route::post('/finish', 'AnswerController@finish');
    Route::get('/finish', 'AnswerController@finish');



});


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth.very_basic'], function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::get('/hint', function () {
    return view('hint/hint');
});
Route::get('/hint/cow', function () {
    return view('hint/cow');
});
Route::get('/hint/lion', function () {
    return view('hint/lion');
});
Route::get('/hint/duck', function () {
    return view('hint/duck');
});
Route::get('/hint/anubis', function () {
    return view('hint/anubis');
});
Route::get('/hint/vulture', function () {
    return view('hint/vulture');
});
Route::get('/ar-check', function () {
    return view('ar_check');
});
