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

// ホーム
Route::get('/', 'HomeController@index')->middleware('login');

// 仕訳帳
Route::resource('journals', 'JournalsController')->middleware('login');

// 会計年度
Route::resource('capitals', 'CapitalsController')->middleware('login');

// 勘定科目
Route::resource('accounts', 'AccountsController')->middleware('login');

// ログイン
Route::get('login', function () {
    return view('login');
});
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout')->middleware('login');
