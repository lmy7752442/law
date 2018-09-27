<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HotController extends Controller{
    /** 热点后台展示 */
    public function hot_list(){
        $hot_data = DB::table('hot')->where(['is_show'=>1])->get();
//        print_r($hot_data);exit;
        $new_data = json_decode($hot_data,true);
        foreach($new_data as $k=>$v){
            $new_data[$k]['ctime'] = date('Y-m-s H:i:s',$v['ctime']);
        }
        return view('hot_list')->with('new_data',$new_data);
    }

    /** 是否展示 */
    public function is_show(){
        $h_id = $_GET['h_id'];
//        print_r($h_id);exit;
        $h_id = rtrim($h_id,',');
//        print_r($h_id);exit;
        $where = explode(',',$h_id);
//        print_r($where);exit;
        $update_data = [
            'is_show' => 2
        ];
        if($h_id){
            $res = DB::table('hot')->whereIn('h_id',$where)->update($update_data);
//            print_r($res);
            if($res){
                return 1;
            }else{
                return 2;
            }
        }
    }

    /** 跳 */
    public function tiao(){
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show'=>2])->orderBy('ctime','desc')->get();
//        print_r($hot_data);exit;
        return view('law_knowledge')->with('hot_data',$hot_data);
    }

    /** 热点详情 */
    public function hot_detail(){
        $h_id = $_GET['h_id'];
//        print_r($h_id);exit;
        $res = DB::table('hot')->where(['h_id'=>$h_id])->first();
//        print_r($res);exit;
        return view('hot_detail')->with('data',$res);
    }
}