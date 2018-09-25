<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class CommonController extends Controller
{
    // 判断 选择角色
    public function select_do(Request $request){
        $arr = $_GET;
        $code = $arr['code'];
        $data = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx812a083d4498638e&secret=92a75a70f282313ac6c1d5075c4c23e5&code='.$code .'&grant_type=authorization_code');
        $data = json_decode($data,true);
//        $openid = $data['openid'];
//        $token =  $data['access_token'];
        $session = new Session;
        $session->set("openid",$data['openid']);
//        $openid = $session->get('openid');
        $session ->set('token',$data['access_token']);
            header('refresh:0;url=as');
    }
    public function as(Request $request){
        $session = new Session;
        $openid = $session->get('openid');
        $token = $session->get('token');
        $user_data =  DB::table('user')->where(['openid'=>$openid])->first();
        if(empty($user_data)){
            $user_arr = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='. $token .'&openid='. $openid .'&lang=zh_CN');
            return view('radio')->with('data',$user_arr)->with('openid',$openid);
        }else{
            header('refresh:0;url=law_knowledge');
        }
    }
    public function user_add(Request $request){
        $user_arr = $request->get('data');
        $openid = $request->get('openid');
        $name = $request->get('name');
        $user_arr = json_decode($user_arr,true);
        if($name == '公众用户'){
            $res = [
                'openid'=>$openid,
                'username'=>$user_arr['nickname'],
                'headimg'=>$user_arr['headimgurl'],
                'introduce'=>'公众用户',
                'role_type'=>1,
                'ctime'=>time(),
                'utime'=>time(),
                'status'=>1
            ];
        }else if($name == '律师'){
            $res = [
                'openid'=>$openid,
                'username'=>$user_arr['nickname'],
                'headimg'=>$user_arr['headimgurl'],
                'introduce'=>'这是律师',
                'role_type'=>2,
                'ctime'=>time(),
                'utime'=>time(),
                'status'=>1
            ];
        }

        DB::table('user')->insert($res);
        header('refresh:0;url=law_knowledge');
    }
}