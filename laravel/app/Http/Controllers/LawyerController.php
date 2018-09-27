<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $gaozi_data = DB::table('article')->where(['status'=>1])->orderBy('ctime','desc')->get();

        return view('law_knowledge')->with('gaozi_data',$gaozi_data);
    }


    /** 律师电脑投稿 */
    public function pc_tougao(){
        return view('pc_tougao');
    }

    /** 扫二维码投稿 */
    public function pc_gaozi_add(){
        $data = $_GET;
//        print_r($data);exit;
        $sessionid = $data['session_id'];
//        print_r($sessionid);exit;
        # 根据sessionid查询数据库此用户是否存在
        $res = (array)DB::table('session_openid')->where(['sessionid'=>$sessionid])->first();
//        print_r($res);
        # 用户存在
        if($res){
            # 根据openid查询用户表 用户的角色
            $openid = $res['openid'];
            $user = (array)DB::table('user')->where(['openid'=>$openid])->first();
//            print_r($user);exit;
            if($user['role_type'] == 2){
                  header("location:http://ruirui.jinxiaofei.xyz/tougao");
            }else{
                echo "<script>alert('此用户不是律师')</script>";
            }
        }else{
            echo "<script>alert('此用户不存在')</script>";
        }
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

    /** 稿子修改 */
    public function gaozi_update(){
        $art_id = $_GET['art_id'];
        print_r($art_id);exit;
    }

    /** 稿子删除 */
    public function gaozi_delete(){
        $art_id = $_GET['art_id'];
        print_r($art_id);exit;
    }

    /**  */
//    public function pc(Request $request){
//        session_start();
//        $sessionid = session_id();
////        print_r($sessionid);exit;
//        # 根据 sessionid 查询 session_openid 表 openid
//        $result = (array)Db::table('session_openid')->where(['sessionid'=>$sessionid])->first();
////        print_r($result);exit;
//        $data = [];
//        if($result){
//            # 根据 openid 查询 user 表
//            $user_info = (array)Db::table('user')->where(['openid'=>$result['openid']])->first();
////            print_r($we_info);exit;
//            if(empty($user_info)){
//                return $data = ['msg'=>'此用户不存在','code'=>2];
//                exit;
//            }else{
//                //登陆成功，session 赋值
//                $request->session()->put(['u_id'=>$user_info['u_id']]);
//                //删除登录成功数据,session_openid
////                $result2=Db::table('session_openid')->where(['sessionid'=>$sessionid])->delete();
////                print_r($result2);exit;
//                $data=['msg'=>'登录成功','code'=>1];
//            }
//        }else{
//            return $data=['msg'=>'未扫码','code'=>2];
//        }
//        echo json_encode($data,JSON_UNESCAPED_UNICODE);
////        return $data;
//    }


}