<<<<<<< HEAD
=======
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class IndexController extends Controller
{
    public $APPID="wxf50dc03dd5f160a7";
    public $APPSECRET="2077c45807dae09d4915b53ccbe723bc";
    public function index(Request $request){

    }
    // 判断 选择角色
    public function law_knowledge(Request $request){
        $arr = $_GET;
        $code = $arr['code'];
        $state = $arr['state'];
        $data = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf50dc03dd5f160a7&secret=2077c45807dae09d4915b53ccbe723bc&code='.$code .'&grant_type=authorization_code');
        $data = json_decode($data,true);
//        $openid = $data['openid'];
//        $token =  $data['access_token'];
        $session = new Session;
        $session->set("openid",$data['openid']);
//        $openid = $session->get('openid');
        $session ->set('token',$data['access_token']);
        $session->set("state",$state);
        //  单选框页面  选择律师或公众用户
        header('refresh:0;url=as');
    }
    public function as(Request $request){
        $session = new Session;
        $openid = $session->get('openid');
        $token = $session->get('token');
        $state = $session->get('state');
        $user_data =  DB::table('user')->where(['openid'=>$openid])->first();
        if(empty($user_data)){
            $user_arr = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='. $token .'&openid='. $openid .'&lang=zh_CN');
            return view('radio')->with('data',$user_arr)->with('openid',$openid)->with('state',$state);
        }else{
            // $state  1 = 热点列表   2,3= 首页 找律师    4 = 个人中心
            if($state == 1 ){
                return view('hotspot_list');
            }else if($state == 2 || $state == 3){
                return view('law_knowledge');
            }else if($state == 4){
                return view('personage');
            }
        }
    }
    public function user_add(Request $request){
        $user_arr = $request->get('data');
        $openid = $request->get('openid');
        $name = $request->get('name');
        $state = $request->get('state');
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
        // $state  1 = 热点列表   2,3= 首页 找律师    4 = 个人中心
        if($state == 1 ){
            return view('hotspot_list');
        }else if($state == 2 || $state == 3){
            return view('law_knowledge');
        }else if($state == 4){
            return view('personage');
        }
    }
    //拼接参数，带着access_token请求创建菜单的接口
    public function createmenu(){
        $data='{
      "button":[
       {
               "type":"view",
               "name":"实时热点",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://luo.luomengyaun.club/law_knowledge&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
      },
      {
            "name":"法律服务",
           "sub_button":[
            {
               "type":"view",
                "name":"找律师",
                "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=2#wechat_redirect"
            },
            {
               "type":"view",
                "name":"法律常识",
                "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=3#wechat_redirect"
            } ]
       },
       {
               "type":"view",
               "name":"个人中心",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=4#wechat_redirect"
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
>>>>>>> 66f6520912c13dbe3238697da2280edb853e4013
