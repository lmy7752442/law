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

Route::get('/', 'IndexController@index');
//首页
Route::get('law_knowledge', 'IndexController@law_knowledge');

Route::get('lawyer', 'LawyerController@lawyer');

Route::get('ask', 'AskController@ask');

//律师投稿
Route::get('/tougao','LawyerController@tougao');

