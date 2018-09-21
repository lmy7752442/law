<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public $APPID="wxf50dc03dd5f160a7";
    public $APPSECRET="2077c45807dae09d4915b53ccbe723bc";
    public function index(Request $request){
        
    }
    public function law_knowledge(){
        return view('law_knowledge');
    }
    //拼接参数，带着access_token请求创建菜单的接口
    public function createmenu(){
        $data='{
      "button":[
       {
               "type":"view",
               "name":"实时热点",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://luo.luomengyaun.club/login_weixin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
      },
      {
            "name":"法律服务",
           "sub_button":[
            {
               "type":"view",
                "name":"找律师",
                "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
            },
            {
               "type":"view",
                "name":"法律常识",
                "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
            } ]
       },
       {
               "type":"view",
               "name":"个人中心",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://luo.luomengyaun.club/login_weixin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
      }
       ]
 }';

        $link = mysqli_connect('127.0.0.1','root','root','shop');
        $sql = "select * from shop_token";
        $res = mysqli_query($link,$sql);
        $data2 = mysqli_fetch_assoc($res);
        $access_token=$data2['token'];
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $result=$this->postcurl($url,$data);
        var_dump($result);
    }
    function postcurl($url,$data = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return 	$output=json_decode($output,true);
    }
}

