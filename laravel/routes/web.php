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
Route::get('law_knowledge', 'IndexController@law_knowledge');
Route::get('ask', 'AskController@ask');
Route::get('lawyer', 'IndexController@lawyer');


Route::get('user_add','IndexController@user_add');
Route::get('as','IndexController@as');
Route::get('createmenu','IndexController@createmenu');
Route::get('ssss','IndexController@ssss');