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

Route::any('/', 'IndexController@index');

Route::get('law_knowledge', 'IndexController@law_knowledge');

Route::get('lawyer', 'LawyerController@lawyer');

Route::get('ask', 'AskController@ask');
Route::get('add_medal', 'UserController@add_medal');
Route::get('login', 'Admin\LoginController@login');
Route::get('homepage','Admin\IndexController@homepage');
Route::get('hot_article ','Admin\IndexController@hot_article');
Route::get('select_article','Admin\IndexController@select_article');


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
//稿子详情
Route::get('/gaozi_detail','LawyerController@gaozi_detail');
//微信获取access_token 入数据库
Route::get('/access_token','LawyerController@access_token');
//判断身份 是用户还是律师
Route::get('/user_role_type','LawyerController@user_role_type');
//所有稿子
Route::get('/all_gaozi','LawyerController@all_gaozi');


########## HotController控制器 ##########
//热点后台展示
Route::get('/hot_list','HotController@hot_list');
//后台决定是否展示
Route::get('/is_show','HotController@is_show');
//热点详情
Route::get('/hot_detail','HotController@hot_detail');
//所有热点
Route::get('/all_hot','HotController@all_hot');


Route::get('user_add','IndexController@user_add');
Route::get('as','IndexController@as');
// 创建菜单
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

// 热点评论
Route::get('comment','IndexController@comment');
// 热点评论后 评论
Route::get('comment_do','IndexController@comment_do');
Route::get('comment_do_do','IndexController@comment_do_do');


########## FindlawyerController控制器 ##########
//找律师
Route::get('lawyer', 'FindlawyerController@lawyer');
//免费咨询
Route::get('consult', 'FindlawyerController@consult'); 
//咨询提交
Route::post('subconsult','FindlawyerController@subconsult');
//咨询列表(用户指定律师，已经回复的咨询)
Route::get('consult_list','FindlawyerController@consult_list');
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
//计划任务
Route::get('fp_reward','FindlawyerController@fp_reward');
//检查是否获取了联系方式
Route::post('check','FindlawyerController@check');
//获取律师的联系方式(支付)
Route::get('obtain_contact','FindlawyerController@obtain_contact');
//提交获取律师的联系方式(支付)
Route::post('obtain_contactDO','FindlawyerController@obtain_contactDO');
//个人中心(悬赏问题详情)
Route::get('person_reward_detail','PersonController@person_reward_detail');


Route::resource('posts','PostController');

