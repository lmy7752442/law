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
//跳转
Route::get('/tiaozhuan','LawyerController@tiaozhuan');
//律师电脑投稿
Route::get('/pc_tougao','LawyerController@pc_tougao');
//扫二维码投稿
Route::get('/pc_gaozi_add','LawyerController@pc_gaozi_add');
//
Route::get('/pc','LawyerController@pc');
//稿子详情
Route::get('/gaozi_detail','LawyerController@gaozi_detail');
//微信直接生成二维码
Route::get('/qrcode','LawyerController@qrcode');
//微信获取access_token 入数据库
Route::get('/access_token','LawyerController@access_token');

########## HotController控制器 ##########
//热点后台展示
Route::get('/hot_list','HotController@hot_list');
//后台决定是否展示
Route::get('/is_show','HotController@is_show');
//热点详情
Route::get('/hot_detail','HotController@hot_detail');


Route::get('user_add','IndexController@user_add');
Route::get('as','IndexController@as');
// 创建菜单
Route::get('createmenu','IndexController@createmenu');
Route::get('ssss','IndexController@ssss');
Route::get('person','PersonController@index');
// 热点评论
Route::get('comment','IndexController@comment');
// 热点评论后 评论
Route::get('comment_do','IndexController@comment_do');
Route::get('comment_do_do','IndexController@comment_do_do');


