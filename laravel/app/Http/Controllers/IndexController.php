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
        $data = file_get_contents('php://input');
        $arr = $this -> XmlToArr($data);
        file_put_contents('./aa.log',print_r($arr,true),FILE_APPEND);
        if($arr['Event'] == 'subscribe' || $arr['Event'] == 'SCAN') {
            $ToUserName = $arr['ToUserName'];
            $CreateTime = time();
            if(strpos($arr['EventKey'],'_') > 0){
                $s_id = substr($arr['EventKey'],strpos($arr['EventKey'],'_')+1);
                $sid = substr($s_id,1);
                $che_id = $s_id[0];
            }else{
                $sid = substr($arr['EventKey'],1);
                $che_id = $arr['EventKey'][0];
            }
            $link = mysqli_connect('127.0.0.1','luo','root','images');
            $openid = $arr['FromUserName'];
            $weixin_arr = [
                'ToUserName'    =>  $openid,
                'FromUserName'    =>  $ToUserName,
                'CreateTime'    =>  $CreateTime,
                'MsgType'    =>  'text'
            ];
            $che_data = mysqli_query($link,"select * from image_sid_openid where openid='{$openid}' and status=1");
            $che_status = mysqli_query($link,"select * from image_che where id='{$che_id}' and status=2");
            if(mysqli_fetch_assoc($che_data)){
                $weixin_arr['Content'] = '您在骑行中';
            }else if(mysqli_fetch_assoc($che_status)){
                $weixin_arr['Content'] = '此车正在骑行中，请选其他车';
            } else{
                $weixin_arr['Content'] = '扫描成功';
                mysqli_query($link,"insert into image_sid_openid(sid,openid,che_id) values('{$sid}','{$openid}',{$che_id})");
                mysqli_query($link,"update image_che set status=2 where id = '$che_id' and status=1");
            }
            echo $str = $this -> ArrToXml($weixin_arr);
        }
    }

    // 判断 选择角色
    public function law_knowledge(Request $request){
            $arr = $_GET;
            $code = $arr['code'];
            $data = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf50dc03dd5f160a7&secret=2077c45807dae09d4915b53ccbe723bc&code='.$code .'&grant_type=authorization_code');
            $data = json_decode($data,true);
            $session = new Session;
            $session->set("openid",$data['openid']);
            $session ->set('token',$data['access_token']);
            //  单选框页面  选择律师或公众用户
            header('refresh:0;url=as');
    }

    public function ssss(Request $request){
            $id = $request->get('id');
            $session = new Session;
            $session->set("state",$id);
            $openid = $session->get('openid');
            if(empty($openid)){
                    if($id == '1'){
                            header('refresh:0;url=https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect');
                    }elseif ($id == '2'){
                            header('refresh:0;url=https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=2#wechat_redirect');
                    } else{
                            header('refresh:0;url=https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf50dc03dd5f160a7&redirect_uri=http://yuan.jinxiaofei.xyz/law_knowledge&response_type=code&scope=snsapi_userinfo&state=3#wechat_redirect');
                    }
            }else{
                    header('refresh:0;url=http://yuan.jinxiaofei.xyz/as');
            }
    }



    public function as(Request $request)
    {
        $status = $request->get('status');
        $session = new Session;
        $openid = $session->get('openid');
        $token = $session->get('token');
        $state = $session->get('state');
        $user_data = DB::table('user')->where(['openid' => $openid])->first();
        # 查询稿子表数据
        $gaozi_data = DB::table('article')->where(['status' => 1])->orderBy('ctime', 'desc')->limit(5)->get();
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show' => 2])->orderBy('ctime', 'desc')->limit(5)->get();
        if($status == 1){
            return view('law_knowledge')->with('gaozi_data', $gaozi_data)->with('hot_data', $hot_data);
        }
        if (empty($user_data)) {
            $user_arr = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $token . '&openid=' . $openid . '&lang=zh_CN');
            return view('radio')->with('data', $user_arr)->with('openid', $openid)->with('state', $state);
        } else {
            // $state  1 = 热点列表   2,3= 首页 找律师    4 = 个人中心
            if ($state == '1') {
                header('refresh:0;url=person');
            } else if ($state == '2') {
//                print_r($gaozi_data);exit;
                return view('law_knowledge')->with('gaozi_data', $gaozi_data)->with('hot_data', $hot_data);
            } else if ($state == '3') {
                header('refresh:0;url=person');
            }

        }
    }

    public function user_add(Request $request){
        $user_arr = $request->get('data');
        $openid = $request->get('openid');
        $name = $request->get('name');
        $state = $request->get('state');
        $user_arr = json_decode($user_arr,true);
        # 查询稿子表数据
        $gaozi_data = DB::table('article')->where(['status' => 1])->orderBy('ctime', 'desc')->limit(5)->get();
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show'=>2])->orderBy('ctime','desc')->limit(5)->get();
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
            $res2 = DB::table('user')->where(['openid'=>$openid])->first();
            if(empty($res2)){
                    DB::table('user')->insert($res);
            }
            // $state  1 = 热点列表   2,3= 首页 找律师    4 = 个人中心
            if($state == '1' ){
                    return view('hotspot_list');
            }else if($state == '2'){
                    return view('law_knowledge')->with('gaozi_data',$gaozi_data)->with('hot_data',$hot_data);
            }else if($state == '3'){
                    header('refresh:0;url=person');
            }
    }

    //拼接参数，带着access_token请求创建菜单的接口
    public function createmenu(){
        $data='{
              "button":[
                   {
                           "type":"view",
                           "name":"实时热点",
                           "url":"http://yuan.jinxiaofei.xyz/ssss?id=1"
                   },
                   {
                       "name":"法律服务",
                       "sub_button":[
                            {
                               "type":"view",
                                "name":"找律师",
                                "url":"http://yuan.jinxiaofei.xyz/ssss?id=2"
                            },
                            {
                               "type":"view",
                                "name":"法律常识",
                                "url":"http://yuan.jinxiaofei.xyz/ssss?id=2"
                            }
                       ]
                   },
                   {
                           "type":"view",
                           "name":"个人中心",
                           "url":"http://yuan.jinxiaofei.xyz/ssss?id=3"

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

    public function postcurl($url,$data = null){
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
            return     $output=json_decode($output,true);
    }

    // 热点评论
    public function comment(Request $request){
//        echo 123;exit;
            //  热点id
            $id = $request->get('id');
            // 评论内容
            $content = $request->get('content');
            session_start();
            $session_id = session_id();
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $openid = $redis->get($session_id);
            $data = (array)DB::table('user')->where(['openid'=>$openid])->first();
            // 用户 id
            $u_id = $data['id'];
            $arr = [
                'h_id'=>$id,
                'uid'=>$u_id,
                'content'=>$content,
                'ctime'=>time(),
                'status'=>1
            ];
            $res = DB::table('comment')->insert($arr);
            if($res){
                    return 1;
            }else{
                    return 2;
            }
    }

    // 评论 后 评论
    public  function comment_do(Request $request){
            //  上级评论 id
            $pid = $request->get('pid');
            $data = DB::table('comment')->where(['pid'=>$pid])->first();
            return view('comment')->with('data',$data);
    }

    public function comment_do_do(Request $request){
            $id = $request->get('id');// pid
            $hid = $request->get('hid');// 热点 id
            $area =  $request->get('area'); // 评论内容
            session_start();
            $session_id = session_id();
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $openid = $redis->get($session_id);
            $data = (array)DB::table('user')->where(['openid'=>$openid])->first();
            // 用户 id
            $u_id = $data['id'];
            $arr = [
                'h_id'=>$hid,
                'uid'=>$u_id,
                'content'=>$area,
                'ctime'=>time(),
                'status'=>1,
                'pid'=>$id
            ];
            $res = DB::table('comment')->insert($arr);
            if($res){
                    return 1;
            }else{
                    return 2;
            }
    }
}
