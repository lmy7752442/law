<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;


class FindlawyerController extends Controller
{
    public function lawyer(Request $request){
		$page = $request->get('page');
		$law_data = DB::table('user')->where(['role_type' => 2,'status' => 1])->orderBy('integral','desc','help_count','desc')->paginate(2);
		//var_dump($law_data);
		$law_data->count();
		$law_data->currentPage();
		$law_data->firstItem();
		$law_data->hasMorePages();
		$law_data->lastItem();
		//$law_data->lastPage(); //（使用 simplePaginate 时不可用）
		$law_data->nextPageUrl();
		$law_data->perPage();
		$law_data->previousPageUrl();
		//$law_data->total(); //（使用 simplePaginate 时不可用）
	    $law_data->url($page);
        return view('lawyer',['law_data' => $law_data]);
    }
    //在线咨询
	public function consult(Request $request){
	   $uid = $request->get('id');
	   $result = DB::table('user')->where(['id' => $uid,'role_type' => 2 ,'status' => 1])->first();
	   if(empty($result)){
		   echo '该律师不存在！';die;
	   }else{
	       return view('consult',['lawyer_data' => $result,'uid'=>$uid]);
	   }
	   
	}
	//咨询提交
	public function subconsult(Request $request){
	   if($request->ajax()){
		  //$uid = session('userid');
	      $uid = 2;
		  $content = $request->post('content');
		  $id = $request->post('id');
          $consult_id = DB::table('consult')->insert(['uid' => $uid,'law_id' => $id,'consult_content' => $content,'consult_time' => time()]);
		  if($consult_id){
			 echo json_encode(['status' => 1,'msg' => '提交成功','data'=>'']);
		  }else{
		      echo json_encode(['status' => 0,'msg' => '提交失败，请尝试重新提交','data'=>'']);
		  }
	   }else{
	      echo '非法操作！';
	   }
	}
   //咨询回复
   public function relayconsult(Request $request){
	   $consult_id = $request->get('consult_id');
	   //$uid = session('userid');
	   $consult_data = DB::table('consult')->where(['consult_id' => $consult_id])->first();
	   if(empty($consult_data)){
	      echo '信息不存在';die;
	   }
       return view('relayconsult',['consult_data' => $consult_data]);
   }
   //提交回复
   public function relayconsultDo(Request $request){
     if($request->ajax()){
        //$uid = session('userid');
	    $uid = 1;
		$content = $request->post('content');
		if(mb_strlen($content,'UTF8') <=0 || mb_strlen($content,'UTF8') > 800){
			return ['status' => 0,'msg' => '请输入10~800个字符，且需包含中文','data'=>''];
		}
		$id = $request->post('id');
        $consult_data = DB::table('consult')->where(['consult_id' => $id])->first();
		if(empty($consult_data)){
		   return ['status' => 0,'msg' => '您要回复的咨询不存在','data'=>''];
		}else{
		   if($consult_data->status == 2){
			 return ['status' => 0,'msg' => '该条咨询已经回复过了','data'=>''];
		   }elseif($consult_data->status == 3){
			  return ['status' => 0,'msg' => '该条咨询已经删除','data'=>''];
		   }else{
		      if($consult_data->law_id !=$uid ){
				  return ['status' => 0,'msg' => '您不是被咨询人','data'=>''];
			  }

			  $update = DB::table('consult')->where(['consult_id' => $id,'law_id' => $uid])->update(['status' => 2,'relay' => $content,'relay_time' => time()]);
			  if($update){
			    return ['status' => 1,'msg' => '回复成功','data'=>''];
			  }else{
			    return ['status' => 0,'msg' => '回复失败','data'=>'']; 
			  }
		   }
		}
	 }else{
	   echo '非法操作';
	 }
   }

   //普通用户发布悬赏
   public function postReward(){
	 //$uid = session('uid');
	 $uid = 2;
     
     return view('postReward');
   }
   //提交悬赏问题
   public function postRewardDo(Request $request){
	   if($request->ajax()){
          $data = $_POST;
		  //var_dump($data);die;
		  //$uid = session('userid');
		 if(empty($data['content'])){
		    return ['status' => 0,'msg' => '请输入10~800个字符，且需包含中文','data'=>''];
		 }
		 if(mb_strlen($data['content'],'UTF8') <=0 || mb_strlen($data['content'],'UTF8') > 800){
			return ['status' => 0,'msg' => '请输入10~800个字符，且需包含中文','data'=>''];
		 }
		 if(empty($data['reward_money'])){
		    return ['status' => 0,'msg' => '请输入悬赏金额','data'=>''];
		 }
		 if(!is_numeric($data['reward_money'])){
		    return ['status' => 0,'msg' => '请输入正确的悬赏金额(数字)','data'=>''];
		 }
		 if($data['reward_money'] < 10){
		    return ['status' => 0,'msg' => '悬赏金额不得低于10元','data'=>''];
		 } 
		 if(empty($data['validity'])){
		   return ['status' => 0,'msg' => '请输入问题有效期','data' => ''];
		 }
		 if(!is_numeric($data['validity'])){
		    return ['status' => 0,'msg' => '请输入正确的问题有效期(数字)','data' => ''];
		 }
		 if($data['validity'] < 2 || $data['validity'] > 7){
			 return ['status' => 0,'msg' => '请设置正确的问题有效期(2-7天)','data'=>''];
		 }
		 $uid = 2;
		 $len = strlen($uid);
		 if($len < 4){
           $uid = str_repeat(0,(4-$len)).$uid;
		 }else{
			 $uid = $uid % 10000;
		 }
         $order_no =  '1'.$uid.date('ymd').rand(1000,9999);
		  $insert_data = [
		     'q_title' => $data['content'],
			 'uid' => $uid,
			 'reward_money' => $data['reward_money'],
			 'validity'    => $data['validity'],
			 'ctime' => time(),
			 'status' => 1,
			 'order_no' => $order_no
		  ];
		  $q_id = DB::table('reward_problem')->insert($insert_data);
		  if($q_id){
		     return ['status' => 1,'msg' => '','data' => $order_no];
		  }else{
		     return ['status' => 0,'msg'=>'发布失败','data' => ''];
		  }
	   }else{
	      echo '非法操作';
	   }
   }
   //支付悬赏页面
   public function pay_reward(Request $request){
	  $order_no = $request->get('order_no');
      $data = (array)DB::table('reward_problem')->where(['order_no' => $order_no])->first();
	  if(empty($data)){
		  echo '该悬赏金额支付订单不存在';die;
	  }

      return view('pay_reward',['data' => $data]);
   }
   //支付
   public function pay_rewardDo(Request $request){
	   if($request->ajax()){
	     $data = $_POST;
		 $uid = 2;
		 //var_dump($data);die;
		 if($data['pay_type'] != 1){
			 return ['status' => 0,'msg' => '请选择支付方式','data' => ''];
		 }
         $reward_problem = (array)DB::table('reward_problem')->where(['order_no' => $data['order_no']])->first();
		 if(empty($reward_problem)){
			 return ['status' => 0,'msg' => '该订单不存在','data' => ''];
		 }
         if($reward_problem['pay_status'] == 2){
		    return ['status' => 0,'msg' => '该订单已经完成，无需重复支付','data' =>''];
		 }
		 if($data['pay_type'] == 1){
             $user_data = (array)DB::table('user')->where(['id' => $uid,'status' => 1])->first();
		     if($reward_problem['reward_money'] > $user_data['money']){
				 return ['status' => 0,'msg' => '余额不足,请前往个人中心进行充值','url' =>''];
			 }
             $money = $user_data['money'] - $reward_problem['reward_money'];
			 DB::beginTransaction();
             $save_user = DB::table('user')->where(['id' => $uid,'status' => 1])->update(['money' => $money]);
			 $save_problem = DB::table('reward_problem')->where(['order_no' => $reward_problem['order_no']])->update(['pay_type' => $data['pay_type'],'pay_time' => time(),'pay_status' => 2]);
			 if($save_user && $save_problem){
			   DB::commit();
			   return ['status' => 1,'msg' => '支付成功','url' => '/index/person'];
			 }else{
			   DB::rollback();
			   return ['status' => 0,'msg' => '支付失败','url' => ''];
			 }
		 }
	   }else{
	     echo '非法操作';
	   }
   }
   //律师评论悬赏问题
   public function reward_comment(Request $request){
	 $q_id = $request->get('q_id');
	 $data =(array)DB::table('reward_problem')->where(['q_id' => $q_id])->first();
	 if(empty($data)){
		 echo '该悬赏问题不存在';die;
	 }
	 $all_comment = DB::table('reward_comment')
		          ->join('user', 'reward_comment.law_id', '=', 'user.id')
	              ->where(['rp_id' => $q_id])
		          ->select('reward_comment.*','user.username','user.headimg','user.ID_Photo','user.mobile')
		          ->orderBy('is_best','desc','ctime','desc')
		          ->get();
     return view('reward_comment',['question' => $data,'all_comment' => $all_comment]);
   }
   //提交悬赏问题评论
   public function reward_commentDo(Request $request){
     if($request->ajax()){
		//$uid = session('userid');
        $uid = 1;
		$data = $_POST;
		$reward_problem = (array)DB::table('reward_problem')->where(['q_id' => $data['q_id']])->first();
		if(empty($reward_problem)){
			return ['status' => 0,'msg' => '该悬赏问题不存在','url' => ''];
		}
		$count = DB::table('reward_comment')->where(['law_id' => $uid,'rp_id' => $data['q_id']])->count();
		if($count > 0){
           return ['status' => 0,'msg' => '您已经评论过了,不能再评论了','url' => ''];
		}
        if($reward_problem['pay_status'] == 1){
		   return ['status' => 0,'msg' => '该悬赏问题未支付赏金,不能进行评论','url' => ''];
		}
		if($reward_problem['status'] == 4){
		   return ['status' => 0,'msg' => '该悬赏问题已经删除','url' => '']; 
		}
		if($reward_problem['status'] == 2){
		   return ['status' => 0,'msg' => '该悬赏问题已经解决,不能再进行评论','url' => ''];
		}
		if(($reward_problem['pay_time'] + 3600 * 24 * $reward_problem['validity']) < time()){
		  return ['status' => 0,'msg' => '该悬赏问题已经过期,不能再进行评论','url' => ''];
		}
        $insert = DB::table('reward_comment')->insert(['rp_id' => $reward_problem['q_id'],'law_id' => $uid,'content' => $data['content'],'ctime' => time()]);
		if($insert){
           return ['status' => 1,'msg' => '回复成功','url' => ''];
		}else{
		   return ['status' => 0,'msg' => '回复失败','url' => ''];
		}
	 }else{
		 echo '非法操作';
	 }
   }

   //悬赏问题列表
   public function reward_problem_list(){
	  $reward_problem = (array)DB::table('reward_problem')->where('status','<>',4 )->where('pay_status','=',2)->get();
      return view('reward_comment_list',['reward_problem' => $reward_problem]);
   }

   //用户选择悬赏问题评论最佳答案
   public function select_best(Request $request){
      if($request->ajax()){
         $data = $_POST;
         //$uid = session('userid');
		 $uid = 2;
		 $reward_data = (array)DB::table('reward_comment')->where(['rc_id' => $data['rc_id'],'status' => 1])->first();
		 if(empty($reward_data)){
		    return ['status' => 0,'msg' => '该评论不存在','url' => ''];
		 }
		 $reward_problem = (array)DB::table('reward_problem')->where(['q_id' => $data['q_id']])->first();
		 if(time() > ($reward_problem['pay_time'] + 3600 * 24 * ($reward_problem['validity'] + 7)) ){
		      return ['status' => 0,'msg' => '评选时间已经过了，不能再进行评选了','url' => '']; 
		 }
		 if(time() < $reward_problem['pay_time'] + 3600 * 24 * $reward_problem['validity']){
		      return ['status' => 0,'msg' => '评选还没有到，不能进行评选','url' => ''];
		 }
         $is_best = DB::table('reward_comment')->where(['rp_id' => $data['q_id'],'is_best' => 1,'status' => 1])->count();
		 if($is_best > 0){
            return view(['status' => 0,'msg' => '最佳答案已评出！不可再评选了']);
		 }
		 //设置当前评论为最佳答案
		 $save_reward_comment = DB::table('reward_comment')->where(['rc_id' => $data['rc_id']])->update(['is_best' => 1,'utime' => time()]);
		 DB::beginTransaction();
         //当前用户增加积分
         $save_user = DB::table('user')->where(['id' => $uid])->update(['integral' => intval($reward_problem['money'])]);
		 //当前评论律师增加积分
		 $save_lawyer = DB::table('user')->where(['id' => $reward_data['law_id']])->update(['integral' => intval($reward_problem['money'])]);
		 //获取其他评论律师的ID
         $lawyer_id_arr = (array)DB::table('reward_comment')->where(['rp_id' => $data['q_id']])->select('law_id')->get();
		 //给其他评论的律师增加1积分
		 $other_lawyer = DB::table('user')->whereIn('id',$lawyer_id_arr)->update(['integral' => intval($reward_problem['money'])]);
		 //给最佳评论律师分配赏金80%
		 $lawyer_money = DB::table('user')->where('id',$reward_data['law_id'])->update(['money' => intval($reward_problem['money'] * 0.8)]);
         if($save_user && $save_lawyer && $other_lawyer){
		    DB::commit();
			return ['status' => 1,'msg' => '最佳答案评选成功','url' => ''];
		 }else{
			DB::rollback();
			return ['status' => 0,'msg' => '最佳答案评选失败','url' => ''];
		 }
	  }else{
	    echo '非法操作';
	  }
   }
   /**
   **计划任务
   **如果在有效期过后的7天内用户没有选择最优答案，则赏金的80%会平均分配到每个参与评论的律师的账户中
   **/

   public function fp_reward(Request $request){
      $reward_problem = DB::table('reward_problem')->where(['status' => 1,'pay_status' => 2])->get()->toArray();
	  if(empty($reward_problem)){
	    file_put_contents('error.log','没有可操作的悬赏',FILE_APPEND);
		die;
	  }
	  //var_dump($reward_problem);die;
	  foreach($reward_problem as $key=>$val){
		  $val = (array)$val;
		  //计算平分的金额
          $avg_money = $val['reward_money'] * 0.8;
	     if(time() > ($val['pay_time'] + 3600 * 24 * ($val['validity'] + 7))){
			 $count = DB::table('reward_comment')->where(['status' => 1,'rp_id' => $val['q_id'],'is_best' => 1])->count();
			 if($count == 0){
			    $all_count = DB::table('reward_comment')->where(['status' => 1,'rp_id' => $val['q_id']])->count();
				if($all_count == 0){
					//没有人评论，赏金退回原有账户
				}else{
				   //没有选择最优答案，赏金的80%平分给所有的评论律师
				   
				   $person_money = $avg_money/$all_count;
				   //获取平分赏金的律师
				   $law_id = DB::table('reward_comment')->where(['rp_id' => $val['q_id']])->select('law_id')->get()->toArray();
				   foreach($law_id as $k=>$v){
					   $v = (array)$v;
				       //获取律师的余额
				       $law_money = (array)DB::table('user')->where(['id' => $v['law_id']])->first();
					   $money = $law_money['money'] + $person_money;
					   //更新余额
					   $save_money = DB::table('user')->where(['id' => $v['law_id']])->update(['money' => $money]);
				   }  
                   DB::table('reward_problem')->where(['q_id' => $val['q_id']])->update(['status' => 2]); 
				}
			 }else{

			 //如果选择了最优答案
              $law_id = (array)DB::table('reward_comment')->where(['status' => 1,'rp_id' => $val['q_id'],'is_best' => 1])->select('law_id')->first();
			  //获取律师的余额
			  $law_money_integral = (array)DB::table('user')->where(['id' => $law_id['law_id']])->first();
			  $money = $law_money_integral['money'] + $avg_money;
              $user_integral = (array)DB::table('user')->where(['id' => $val['uid']])->first();
              $u_integral = $user_integral['integral'] + intval($val['reward_money']);
			  $integral = $law_money_integral['integral'] + intval($val['reward_money']);
			  DB::table('user')->where(['id' => $val['uid']])->update(['integral' => $u_integral]);
			  DB::table('user')->where(['id' => $law_id['law_id']])->update(['money' => $money,'integral' => $integral]);
			  //获取其他发表评论的律师(除了最优答案的律师)
			  $other_law_id = DB::table('reward_comment')->where(['rp_id' => $val['q_id']])->select('law_id','is_best')->get()->toArray();
			  foreach($other_law_id as $kk=>$vv){
				  $vv = (array)$vv;
				  $integral = (array)DB::table('user')->where(['id' => $vv['law_id'],'status' => 1])->first();
				  if($vv['is_best'] == 0){
				    //其他发表评论的律师都可获得1积分
			        DB::table('user')->where(['id' => $vv['law_id'],'status' => 1])->update(['integral' => $integral['integral'] + 1]);
				  }
			  }
              DB::table('reward_problem')->where(['q_id' => $val['q_id']])->update(['status' => 2]); 
			 }
		 }
	  }
   }
   //如果有效期内无一律师评论则有效期内用户可以随时撤销问题
   public function revoke(Request $request){
      $q_id = $request->post('q_id');
	  $uid = 2;
	  $question = (array)DB::table('reward_problem')->where(['q_id' => $q_id,'uid' => $uid,'status' => 1])->first();
	  if(empty($question)){
	    return ['status' => 0,'msg'=>'该悬赏问题不存在，或者已经解决'];
	  }
      
	  if(time() > $question['validity'] * 3600 * 24 + $question['ctime']){
		  return ['status' => 0,'msg' => '该悬赏问题已经过期，不可撤回'];
	  }else{
	      $count = DB::table('reward_comment')->where(['rp_id' => $q_id])->count();
		  if($count > 0){
		    return ['status' => 0,'msg' => '该问题已经有人评论，不能撤销'];
		  }
		  $save = DB::table('reward_problem')->where(['q_id' => $q_id])->update(['status' => 4]);
          if($save){
		     return ['status' => 1,'msg' => '撤销成功','url' => ''];
		  }else{
		     return ['status' => 0,'msg' => '撤销失败'];
		  }
	  }
   }
   //检查是否已经获取了联系方式
   public function check(Request $request){
      if($request->ajax()){
		   $law_id = $request->post('uid');
		   $uid = 2;
		   $data = (array)DB::table('contact_log')->where(['uid' => $uid,'law_id' => $law_id])->first();
		   if(!empty($data)){
			  $user_data =(array)DB::table('user')->where(['id' => $law_id])->first();
			  return ['status' => 1,'msg' => '','data' => $user_data['mobile']];
		   }else{
		      return ['status' => 2,'msg' => '','data' => $law_id];
		   }
			  
	   }else{
	      echo '非法操作';die;
	   }
   }
   public function obtain_contact(Request $request){
          $law_id = $request->get('uid');
	      return view('obtain_contact',['law_id' => $law_id]);
   }
   //获取律师联系方式
   public function obtain_contactDO(Request $request){
      if($request->ajax()){
         $uid = 2;
         $law_id = $request->post('id');
		 $pay_type = $request->post('pay_type');
		 if($pay_type != 1 && $pay_type == 2){
		   return ['status' => 0,'msg' => '请选择支付方式'];
		 }
		 $contact_log = (array)DB::table('contact_log')->where(['uid' => $uid,'law_id' => $law_id])->first();
		 if(empty($contact_log)){
		   $user_data =(array)DB::table('user')->where(['id' => $uid])->first();
		   if($pay_type == 1){
		      if($user_data['money'] < 10){
			     return ['status' => 0,'msg' => '余额不足，请前往个人中心进行充值'];
			  }
			  $money = $user_data['money'] - 10;
              DB::table('user')->where(['id' => $uid])->update(['money' => $money]);
		   }else{
		     if($user_data['integral'] < 50){
			     return ['status' => 0,'msg' => '积分不足，请前往个人中心进行充值'];
			  }
		   }
		   $insert = DB::table('contact_log')->insert(['uid' => $uid,'law_id' => $law_id,'ctime' => time(),'pay_type' => $pay_type]);

           if($insert){

		     return ['status'=>1,'msg' => '支付成功','data'=>$user_data['mobile']];
		   }else{
		     return ['status'=>0,'msg' => '支付失败'];
		   }
		 }else{
		   return ['status'=>2,'msg' => '该律师的联系方式已经获取','data' => $user_data['mobile']];
		 }

	  }else{
	    echo '非法操作';die;
	  }
   }
}