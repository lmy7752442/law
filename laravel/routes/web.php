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
Route::get('lawyer', 'LawyerController@lawyer');
Route::get('ask', 'AskController@ask');
Route::get('add_medal', 'UserController@add_medal');
Route::get('login', 'Admin\LoginController@login');
Route::get('homepage','Admin\IndexController@homepage');
Route::get('hot_article ','Admin\IndexController@hot_article');
Route::get('select_article','Admin\IndexController@select_article');


