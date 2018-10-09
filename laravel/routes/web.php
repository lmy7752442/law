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
//稿子修改
Route::get('/gaozi_update','LawyerController@gaozi_update');
//稿子删除
Route::get('/gaozi_delete','LawyerController@gaozi_delete');

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


//找律师
Route::get('lawyer', 'FindlawyerController@lawyer');
//免费咨询
Route::get('consult', 'FindlawyerController@consult'); 
//咨询提交
Route::post('subconsult','FindlawyerController@subconsult');
//律师回复
Route::get('relayconsult','FindlawyerController@relayconsult');
//回复提交
Route::post('relayconsultDo','FindlawyerController@relayconsultDo');
//悬赏问题
Route::get('postReward','FindlawyerController@postReward');
//悬赏问题提交
Route::post('postRewardDo','FindlawyerController@postRewardDo');
//悬赏金额支付
Route::get('pay_reward','FindlawyerController@pay_reward');
//支付
Route::post('pay_rewardDo','FindlawyerController@pay_rewardDo');
//律师评论悬赏问题
Route::get('reward_comment','FindlawyerController@reward_comment');
//提交悬赏评论
Route::post('reward_commentDo','FindlawyerController@reward_commentDo');
//悬赏问题列表
Route::get('reward_problem_list','FindlawyerController@reward_problem_list');
//用户选择悬赏最佳答案
Route::post('select_best','FindlawyerController@select_best');
//用户撤销悬赏问题
Route::post('revoke','FindlawyerController@revoke');
//获取律师的联系方式、
Route::get('obtain_contact','FindlawyerController@obtain_contact');
//
Route::get('fp_reward','FindlawyerController@fp_reward');
//
Route::post('check','FindlawyerController@check');
Route::post('obtain_contactDO','FindlawyerController@obtain_contactDO');



