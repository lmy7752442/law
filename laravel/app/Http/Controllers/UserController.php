<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller{
    /**
     * 添加用户勋章
     */
    public function add_medal(){
        $last_time = 3600 * 24 *7;#过期时间

        $now = time();#当前时间

        $new_time = $now + $last_time;

        $uid = 1;

        $user_consumer_where = [
            'uid'=>$uid,
            'status'=>1,
            'c_type'=>1
        ];

        $user_consumer = DB::table('consumer_log')->where($user_consumer_where)->get();#用户消费记录表数据

        $user_info = DB::table('user')->where('id',$uid)->first();#用户数据

        #如果消费日期在7天之内 判断勋章属性

        $user_money = 0;

        $mid = $user_info->m_id;#勋章id

        $user_consumer_id = '';

        $consumer_id = '';

        foreach($user_consumer as $v){
            if( $v->ctime - $now < $last_time ){
                $user_consumer_id .= $v->id .",";

                $user_money += $v->c_money;
            }
        }
        $consumer_id = rtrim($user_consumer_id,',');


        $number = 50;

        $sum = $this->check_zero($number);
        if($user_money >0 && $user_money <= 10){#如果消费金额大于0小于10勋章是铜
            #如果用户有勋章，并且没有过期，就续费7天 否则就颁发勋章
            if( $mid ==1 && $now < $user_info->last_time ){

                $save = $now + $last_time;

                #修改数据
                $update_save = [
                    'last_time'=>$save
                ];

                #修改条件
                $update_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now +$last_time,
                    'm_id'=>1
                ];

                $install_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($install_where)->update($install);
            }
        }elseif($user_money > 10 && $user_money <= 20){#大于10小于20勋章是银
            if( $user_info ->m_id ==2){
                $save = $now + $last_time;

                #修改数据
                $update_save = [
                    'last_time'=>$save
                ];

                #修改条件
                $update_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now +$last_time,
                    'm_id'=>1
                ];

                $install_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($install_where)->update($install);
            }
        }elseif($user_money >20 && $user_money <= 30){#大于20小于30勋章是金
            if( $user_info ->m_id ==3){
                $save = $now + $last_time;

                #修改数据
                $update_save = [
                    'last_time'=>$save
                ];

                #修改条件
                $update_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now +$last_time,
                    'm_id'=>1
                ];

                $install_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($install_where)->update($install);
            }
        }elseif($user_money > 30 && $user_money <= 50){#大于30小于50是钻石
            if( $user_info ->m_id ==4){
                $save = $now + $last_time;

                #修改数据
                $update_save = [
                    'last_time'=>$save
                ];

                #修改条件
                $update_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now +$last_time,
                    'm_id'=>1
                ];

                $install_where = [
                    'id'=>$uid
                ];

                DB::table('user')->where($install_where)->update($install);
            }
        }
    }

    /**
     * 判断是否是10的倍数
     * @param $number
     * @return float
     */
    protected function check_zero($number){

        return $number % 10 == 0;

    }
}