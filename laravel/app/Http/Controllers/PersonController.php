<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class PersonController extends Controller
{
    public function index(){
        $session = new Session;
        $openid = $session->get('openid');
        //$openid = 'qwerrtyyu1232145';
        $data = DB::table('user')->where('openid',$openid)->first();
		//用户发布的悬赏问题
		$reward_problem = DB::table('reward_problem')->where(['uid' => $data->id])->get();
		$reward_problem = json_encode($reward_problem);
		$reward_problem = json_decode($reward_problem,true);
        return view('person',['user'=>$data,'reward_problem' => $reward_problem]);
    }
    //悬赏问题详情
	public function person_reward_detail(Request $request){
	   $q_id = $request->get('q_id');
	   //$openid = 'qwerrtyyu1232145';
	   $session = new Session;
       $openid = $session->get('openid');
       $data = DB::table('user')->where('openid',$openid)->first();
	   $reward_problem = DB::table('reward_problem')->where(['uid' => $data->id,'q_id' => $q_id])->first();
	   $reward_problem = json_encode($reward_problem);
	   $reward_problem = json_decode($reward_problem,true);
	   if(empty($reward_problem)){
		   echo '该悬赏问题不存在';die;
	   }
	   //悬赏评论
	   $reward_comment = DB::table('reward_comment')
		          ->join('user', 'reward_comment.law_id', '=', 'user.id')
	              ->where(['rp_id' => $q_id,'reward_comment.status' => 1])
		          ->select('reward_comment.*','user.username','user.headimg')
		          ->orderBy('is_best','desc','reward_comment.ctime','desc')
		          ->get();
	   $reward_comment = json_encode($reward_comment);
	   $reward_comment = json_decode($reward_comment,true);
       $count = DB::table('reward_comment')->where(['rp_id' => $q_id,'is_best' => 1])->count();
	   return view('person_reward_detail',['reward_problem' => $reward_problem,'reward_comment' => $reward_comment,'is_best' => $count]);
	}

    public function chongzhi(){
        $out_trade_no = time().rand(1000,9999);
        return view('chongzhi',['order_number'=>$out_trade_no]);
    }
    public function chongzhi_do(Request $request){
        $out_trade_no = $request->get('order_number');
        $pid = 1;
        $session = new Session;
        $openid = $session->get('openid');
        $total_fee = $request->get('money')*100;
        //调用统一下单API
        $params = [
            'appid'=> self::APPID,
            'mch_id'=> self::MCHID,
            'nonce_str'=>md5(time()),
            'body'=> '扫码支付模式二',
            'out_trade_no'=> $out_trade_no,
            'total_fee'=> $total_fee,
            'spbill_create_ip'=>$_SERVER['SERVER_ADDR'],
            'notify_url'=> self::NOTIFY,
            'trade_type'=>'NATIVE',
            'product_id'=>$pid
        ];
        $arr = $this->unifiedorder($params);
        //加入记录表
        $data = [
            'openid'=>'oemNh1jsYgd5gkcDXfFYrvW9FIMQ',
            'recharg_money'=>$request->get('money'),
            'ctime'=>time(),
            'status'=>1,
            'order_number'=>$out_trade_no
        ];
        DB::table('recharge_log')->insert($data);
        //生成二维码
        return \QRcode::png($arr['code_url']);
    }
    public function notify(){
        $xml = $this->getPost();
        $arr = $this -> XmlToArr($xml);
        //file_put_contents('./aa.log',print_r($arr,true),FILE_APPEND);
        if($arr['result_code'] == 'SUCCESS' && $arr['return_code'] == 'SUCCESS'){
            //对比订单金额是否一致
            $data = DB::table('recharge_log')->where('order_number',$arr['out_trade_no'])->first();
            if($arr['total_fee'] == $data->recharg_money*100 ){
               //修改订单状态（当订单状态为未支付的时候）\

                $res = DB::table('recharge_log')->where('order_number',$arr['out_trade_no'])->where('status',1)->update(['status'=>2]);
                if($res > 0){
//                    file_put_contents('./aa.log',$data->recharg_money,FILE_APPEND);
                    $res2 = DB::table('user')->where('openid',$data->openid)->increment('money',$data->recharg_money);
                    file_put_contents('./aa.log',$res2,FILE_APPEND);
                }
            }
        }
    }
    public function chongzhi_status(Request $request){
        $order = $request->get('order_number');
        $data = DB::table('recharge_log')->where('order_number',$order)->first();
        if(!empty($data)){
            if($data->status == 2){
                return 1;
            }
        }
    }
    public function tixian(){
        return view('tixian');
    }
    //执行提现
    public function tixian_do(Request $request){
        $status = $request -> get('status');
        $money = $request -> get('money');
        //查询提现金额是否超过了余额
        $session = new Session;
        $openid = $session->get('openid');
        $user_data = DB::table('user')->where('openid',$openid)->first();
        if($user_data->money-$money < 0){
            return 2;
        }
        $order_number = time().rand(1000,9999);

        $arr = [
            'openid'=>$openid,
            'money'=>$money,
            'ctime'=>time(),
            'status'=>1,
            'order_number'=>$order_number
        ];
        if($status == 1){
            $arr['way'] = 1;
            DB::table('cash_log')->insert($arr);
            $this -> lingqian($openid,$money*100,$order_number);
        }
        if($status == 2){
            $bankCard = $request -> get('bankCard');
            $name = $request -> get('name');
            $arr['way'] = 2;
            DB::table('cash_log')->insert($arr);
            $this -> bankCard($bankCard,$name,$order_number,$money*100);
        }
        if($status == 3){
            $alipay = $request -> get('alipay');
            $arr['way'] = 3;
            DB::table('cash_log')->insert($arr);
            $this -> alipay($openid,$order_number,$alipay,$money);
        }
    }
    //提现到零钱
    public function lingqian($openid,$money,$order_number){
        $param = [
            'mch_appid' => self::APPID,
            'mchid' => self::MCHID,
            'nonce_str'=> uniqid(),
            'partner_trade_no'=> $order_number,
            'openid'=> 'ooz740ZaohzSVSwgcRYF9gzCVNDY',
            'check_name'=> 'NO_CHECK',
            'amount'=> $money,
            'desc'=> '中秋快乐',
            'spbill_create_ip'=> $_SERVER["REMOTE_ADDR"]
        ];
        $arr = $this -> setSign($param);
        $xml = $this -> ArrToXml($arr);
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
        $info = $this->postData($url,$xml);
        $info_arr = $this->XmlToArr($info);
        //file_put_contents('./aa.log',print_r($info_arr,true),FILE_APPEND);
        if($info_arr['return_code'] == 'SUCCESS' && $info_arr['result_code'] == 'SUCCESS'){
            $res = DB::table('cash_log')->where('order_number',$info_arr['partner_trade_no'])->where('status',1)->update(['status'=>2]);
            if($res > 0){
                //余额中减去提现的金额
                $res2 = DB::table('user')->where('openid',$openid)->decrement('money',$money/100);
                if($res2 > 0){
                    echo 1;
                }
            }
        }

    }
    public function bankCard($bankCard,$name,$order_name,$money){
        $param = [
            'nonce_str' => uniqid(),
            'partner_trade_no' => $order_name,
            'mch_id' => self::MCHID,
            'bank_code'=> 1003,
            'amount'=> $money
        ];
//        $param2 = [
//            'mch_id' =>self::MCHID,
//            'nonce_str' =>uniqid(),
//            'sign_type' =>'MD5'
//        ];
//        $arr = $this -> setSign($param2);
//        $xml = $this -> ArrToXml($arr);
//        $url = 'https://fraud.mch.weixin.qq.com/risk/getpublickey';
//        $return_data = $this -> postData($url,$xml);
//        $return_arr = $this -> XmlToArr($return_data);
//        file_put_contents('./bankcard/pubkey.pem',$return_arr['pub_key']);
//        print_r($return_arr);
        $rsa = new BrankRSA(file_get_contents('./bankcard/pubkey8.pem'),'');
        $param['enc_bank_no'] = $rsa -> public_encrypt($bankCard);
        $param['enc_true_name'] = $rsa -> public_encrypt($name);
        $arr = $this -> setSign($param);
        $xml = $this -> ArrToXml($arr);
        $url2 = 'https://api.mch.weixin.qq.com/mmpaysptrans/pay_bank';
        $return_xml = $this->postData($url2,$xml);
        $return_arr = $this->XmlToArr($return_xml);
        if($return_arr['return_code']=='SUCCESS' && $return_arr['result_code']=='SUCCESS' && $return_arr['err_code']=='SUCCESS'){
            $res = DB::table('cash_log')->where('order_number',$return_arr['partner_trade_no'])->where('status',1)->update(['status'=>2]);
            if($res > 0){
                //余额中减去提现的金额
                $res2 = DB::table('user')->where('openid','oemNh1jsYgd5gkcDXfFYrvW9FIMQ')->decrement('money',$money/100);
                if($res2 > 0){
                    echo 1;
                }
            }
        }
    }
    public function alipay($openid,$order_number,$alipay,$money){
        //公共请求参数
        $pub_params = [
            'app_id'    => '2018022702283497',
            'method'    =>  'alipay.fund.trans.toaccount.transfer', //接口名称 应填写固定值alipay.fund.trans.toaccount.transfer
            'format'    =>  'JSON', //目前仅支持JSON
            'charset'    =>  'UTF-8',
            'sign_type'    =>  'RSA2',//签名方式
            'sign'    =>  '', //签名
            'timestamp'    => date('Y-m-d H:i:s'), //发送时间 格式0000-00-00 00:00:00
            'version'    =>  '1.0', //固定为1.0
            'biz_content'    =>  '', //业务请求参数的集合
        ];

        //请求参数
        $api_params = [
            'out_biz_no'  => $order_number,//商户转账订单号
            'payee_type'  => 'ALIPAY_LOGONID', //收款方账户类型
            'payee_account'  => $alipay, //收款方账户
            'amount'  => $money, //金额
        ];
        $pub_params['biz_content'] = json_encode($api_params,JSON_UNESCAPED_UNICODE);
        //print_r($pub_params);
        $rsa = new Base();
        $pub_params =  $rsa->setRsa2Sign($pub_params);
        $data = $rsa->curlRequest('https://openapi.alipay.com/gateway.do', $pub_params);
        $data = iconv('gbk','utf-8',$data);
        $arr = json_decode($data,true);
        $arr2 = $arr['alipay_fund_trans_toaccount_transfer_response'];
        if($arr2['msg']=='Success' && $arr2['code']==10000){
            $res = DB::table('cash_log')->where('order_number',$arr2['out_biz_no'])->where('status',1)->update(['status'=>2]);
            if($res > 0){
                //余额中减去提现的金额
                file_put_contents('./aa.log',$openid,FILE_APPEND);
                $res2 = DB::table('user')->where('openid',$openid)->decrement('money',$money);
                if($res2 > 0){
                    echo 1;
                }
            }
        }
    }
}