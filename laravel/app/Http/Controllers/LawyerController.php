<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\QR_CodeController;
use Symfony\Component\HttpFoundation\Session\Session;
class LawyerController extends Controller
{
    /** 用户找律师 */
    public function Lawyer(){
        return view('lawyer');
    }

    /** 律师投稿 */
    public function tougao(){
        //查询分类表数据
        $cate_data = DB::table('category')->get();
//        print_r($cate_data);exit;
        return view('tougao')->with('cate_data',$cate_data);
    }

    /** 添加稿子 */
    public function gaozi_add(Request $request){
        $data = $_GET;
//        print_r($data);exit;
        $insert_data = [
            'uid' => 1,
            'title' => $data['title'],
            'content' => $data['content'],
            'ctime' => time(),
            'utime' => time(),
            'cate_id' => $data['cate_id'],
        ];
//        print_r($insert_data);exit;
        $res = DB::table('article')->insert($insert_data);
//        print_r($res);
        if($res){
            return ['msg'=>'投稿成功' , 'code'=>'1' , 'status'=>'true'];
        }else{
            return ['msg'=>'投稿失败' , 'code'=>'2' , 'status'=>'false'];
        }
    }

    /** 跳转页面 */
    public function tiaozhuan(){
        # 查询稿子表数据
        $gaozi_data = DB::table('article')->where(['status'=>1])->orderBy('ctime','desc')->limit(5)->get();
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show'=>2])->orderBy('ctime','desc')->limit(5)->get();

        return view('law_knowledge')->with('gaozi_data',$gaozi_data)->with('hot_data',$hot_data);
    }

    /** 律师电脑投稿 直接生成二维码 */
    public function pc_tougao(){
        $qrcode=new QR_CodeController();
        $data=json_decode($qrcode->send(),true);
//        print_r($data);exit;
        //echo '<pre/>';
        //print_r($data);
        $ticket=$data['ticket'];
        $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
//        echo $url;die;
//        return view('qrcode')->with('url',$url);
        return view('pc_tougao')->with('url',$url);

//        return view('pc_tougao');
    }

    /** 扫二维码投稿 */
    public function pc_gaozi_add(){
        session_start();
        $sessionid = session_id();
//        print_r($sessionid);exit;

        # 根据sessionid查询数据库此用户是否存在
        $res = (array)DB::table('session_openid')->where(['sessionid'=>$sessionid])->first();
//        print_r($res);exit;
        $data = [];
        # 用户存在
        if($res){
            # 根据openid查询用户表 用户的角色
            $openid = $res['openid'];
            $user = (array)DB::table('user')->where(['openid'=>$openid])->first();
//            print_r($user);exit;
            if(empty($user)) {
                return $data = ['msg'=>'此用户不存在','code'=>2];
            }else{
                if($user['role_type'] == 2){
//                    header("location:http://ruirui.jinxiaofei.xyz/tougao");
                    //删除成功数据,session_openid
//                    $result2=Db::table('session_openid')->where(['sessionid'=>$sessionid])->delete();
//                    print_r($result2);exit;
                    return $data = ['msg'=>'进入律师投稿页面','code'=>1];
                }else{
//                    echo "<script>alert('此用户不是律师')</script>";
                    return $data=['msg'=>'此用户不是律师','code'=>2];
                }
            }
        }else{
//            echo "<script>alert('此用户不存在')</script>";
                return $data=['msg'=>'未扫码','code'=>2];
            exit;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    /** 稿子详情 */
    public function gaozi_detail(){
        $art_id = $_GET['art_id'];
//        print_r($art_id);exit;
        # 根据稿子id查询数据库表数据
        $gaozi_data = DB::table('article')->where(['art_id'=>$art_id,'status'=>1])->first();
//        print_r($gaozi_data);exit;
        # 擦寻分类表数据
        $cate_data = DB::table('category')->get();
//        print_r($cate_data);exit;
        return view('gaozi_detail')->with('gaozi_data',$gaozi_data)->with('cate_data',$cate_data);
    }

    /** 微信获取access_token 入数据库 */
    public function access_token(){
        //获取微信access_token
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx8dace98e9b799000&secret=40b9d8949a8ae965637316fbb888a50e';
        $data= file_get_contents($url);
        $arr = json_decode($data,true);
        //存入数据库shop_access_token
        $add=[
            'access_token'=>$arr['access_token'],
            'ctime'=>time()
        ];
        $add_id=DB::table('access_token')->insertGetId($add);
    }

    /** 判断是用户还是身份 */
    public function user_role_type(Request $request){
        $session = new Session;
        $openid = $session->get('openid');
//        return $data = [ 'data' => $openid ];exit;
//        print_r($openid['openid']);exit;
        return $openid['openid'];exit;

        # 根据openid查询此用户是否存在
//        $user_info = (array)DB::table('user')->where(['openid'=>$sessionid])->first();
//        print_r($res);exit;
//        $data = [];
//        # 用户存在
//        if($res){
//            # 根据openid查询用户表 用户的角色
//            $openid = $res['openid'];
//            $user = (array)DB::table('user')->where(['openid'=>$openid])->first();
////            print_r($user);exit;
//            if(empty($user)) {
//                return $data = ['msg'=>'此用户不存在','code'=>2];
//            }else{
//                if($user['role_type'] == 2){
////                    header("location:http://ruirui.jinxiaofei.xyz/tougao");
//                    return $data = ['msg'=>'进入律师投稿页面','code'=>1];
//                }else{
////                    echo "<script>alert('此用户不是律师')</script>";
//                    return $data=['msg'=>'此用户不是律师','code'=>3];
//                }
//            }
//        }else{
//            return $data=['msg'=>'此用户不存在','code'=>2];
//            exit;
//        }
//        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    /** 所有稿子 */
    public function all_gaozi()
    {
        # 查询稿子表数据
        $gaozi_data = DB::table('article')->where(['status' => 1])->orderBy('ctime', 'desc')->get();

        return view('all_gaozi')->with('gaozi_data', $gaozi_data);
    }
}