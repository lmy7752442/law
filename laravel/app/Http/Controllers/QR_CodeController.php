<?php
namespace App\Http\Controllers;

use DB;

class QR_CodeController extends Controller
{
    /** 请求模板消息的地址 */
    const TEMP_URL = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';
    public function getAccessToken(){
        //这里获取accesstoken  请根据自己的程序进行修改
        //数据库access_token 查询
        $access=(array)Db::table('access_token')->orderBy('id','desc')->first();
//        print_r($access);exit;
        $access_token=$access['access_token'];
//        print_r($access_token);exit;
        return $access_token;
    }

    /**
     * 微信模板消息发送;
     * @param $openid 接收用户的openid
     * return 发送结果
     */
    public function send(){
        $tokens = $this->getAccessToken();
        $url = self::TEMP_URL . $tokens;
        session_start();
        $sessionid=session_id();
        $json='{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$sessionid.'"}}}';
        return $this->curlPost($url, $json);
    }

    /**
     * 通过CURL发送数据
     * @param $url 请求的URL地址
     * @param $data 发送的数据
     * return 请求结果
     */
    protected function curlPost($url,$data)
    {
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = FALSE; //是否返回响应头信息
        $params[CURLOPT_SSL_VERIFYPEER] = false;
        $params[CURLOPT_SSL_VERIFYHOST] = false;
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_POST] = true;
        $params[CURLOPT_POSTFIELDS] = $data;
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }

}