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

Route::get('lawyer', 'IndexController@lawyer');


########## LawyerController控制器 ##########

//律师投稿
Route::get('/tougao','LawyerController@tougao');
//添加稿子
Route::get('/gaozi_add','LawyerController@gaozi_add');
//律师电脑投稿
Route::get('/pc_tougao','LawyerController@pc_tougao');
//扫二维码投稿
Route::get('/pc_gaozi_add','LawyerController@pc_gaozi_add');
//
Route::get('/pc','LawyerController@pc');



Route::get('user_add','IndexController@user_add');
Route::get('as','IndexController@as');

Route::get('createmenu','IndexController@createmenu');
Route::get('ssss','IndexController@ssss');

########## PersonController控制器 ##########
Route::get('person','PersonController@index');
Route::get('chongzhi','PersonController@chongzhi');
Route::get('chongzhi_do','PersonController@chongzhi_do');
Route::any('notify','PersonController@notify');
Route::any('chongzhi_status','PersonController@chongzhi_status');
Route::any('tixian','PersonController@tixian');
Route::any('tixian_do','PersonController@tixian_do');


