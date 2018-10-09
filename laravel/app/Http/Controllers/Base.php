<?php
namespace App\Http\Controllers;
/*
 * 黎明互联
 * https://www.liminghulian.com/
 */

class Base
{
    /**
     * 以下信息需要根据自己实际情况修改
     */
    const APPPRIKEY = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCHhWtG4PWu9mn/l5jainCiK3OnkUSLr68dqficur96Ajr3DyMGs7v6bG/GbPudNzREio9WMqYmbimvjtcx7H4dUy+g+B9qLTh90S3aOauW2EUs0t8NJ7KZA1/KiAMA4TngGTAyDREx4b1TOGOF3Ln2hlWXXRM7tMvR+B2hqAf/K3CdFAQO2Q8uiw9pnKHOfiZO642h5SIozTe77s0Gg85NSuaQ1G4CSAvxc2IIBQ/tofZtwLrRpa/j5SwgljekZw9J6kn/JpF/dVAofHhToabPyfecPX3ym2a1ek9Jpgm3mh8JfmYnUlkMRsxy4HeNe51dP1KwKnjGFt31Rb/XY5ZRAgMBAAECggEACdhWb8K99mTuVGQV9aJjBlTzxPOXsDImHZiQeApVCK8Ky5Hs8Hq0KEAiap7WNJijEmuieBeb3GTaYGeXGIherRCzABWmapc4aGN+2kCgR4gUlmoHTDRbFCSbm+H/ndu+0Zni12/9lMsabuZEzJ+5XsBpjWJ0mDzNJcbJmEnVsuLAWt7sjmo10JJH3dGm2HJ4byztEWuHTlHevMBVftafabagM88Ioi4Y1SvWf4OJifrI9bq1TMGWcgEj2Ac5iuKKwViR1FRekcsh9Zs/PeBUBQzInUGs+bUMDaO9mpDewHFdtZ58HT6rpWWBtVnztoM79eX2Bx9Alyze9FK+B+TucQKBgQDk5IS71RJ2WIpnURpnec12As1HY8jTH2bqvs36th9YbJsEYioqZe+jBskOjE5bUR8jQLgRDppeK/03s1ERT59Nr5irz18Ed39eZVv/WpoGu7oyeJUYZbfVNw5XD2VKXXR3w1ITOrWpotmnsDVc/Ai7Yjs5xO1iDYCK06byY/4k1QKBgQCXkhlXUR/loa3TsrGeEbqyQInNPbO9iuwvfUJA2ziERSCyrgi277QkIVBHXbVAOY5xSVW221q6G7nT/o21dirEPlqyFkge9GeFNtRJz0YBHP9+6ckTlX2vyIc30jxgAC7kyb0IrqBmtfymkcF3/u2B1Q72gGHUSrW4NXpTyc6ZjQKBgD0M1npi8nGuW/wCndBLpIl9ZdNMwhvNnF2wVrAwM1waW55nsGdumOQawzWmJqAkmvGEKZQjGPlVMkzQ/yZm3k6SL15kCSvf05ER59/MApkZKSidEOdY+hdcf+6opJOZKZ9n8VQ/rIR6cyNO1GzgrFOOd82IwOgOQeLFYRn1oauhAoGBAIXSAfmrsGPHuXc9P8B1msYiYQgKQBVLAHh1OPeWFXICrnnTWfJZ9Ewp9Xzs6UgJCRBQVRMa3CGQtSLMjkT2TY/yFZVCQu7Bjlx5Kjj4fbAh8BoXQua9h7iZbXkFbzS7NKveyb1OoGPOrYBLE+tj8kI83/cXJkiOpZ476QLtHDFJAoGAStKZT6IE26vY58HtbMmU3hAUraOI5WDqunj/vc+q43vAPSlhKHOJ7P4JDu7HpPJKWUxCs+X3lihdDc3SGCGNV6Ynfc4UyUZyqvse47M/zn+GngYFNhO7dBonet03aZOnTz9kh0LCJ3ZbuxUJnzcvdQtP/l501Z1GNSxDzgu0NZo='; //修改成自己的 应用私钥
    const APPID = '2018022702283497';     //修改成自己的 APPID
    const NEW_ALIPUBKE = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0/hl6rBbL5J3oqkfQrCZ+C3eoROrtv/yKlDQP/24NrpZ0w4iPyuUrWANGk5TszBvdGO4GCCq2aWJj1Qn6G0yuSZZIk/aL8YwSC81y8tjEYDKhTu3Zv6doQRXqcq/oLKJzwuKiVmlWu20Gg+fByb/MnQAmj7GuVXsdXPU5kX2Bb/OOmoj1OwgaNLHQs0rgf98V7V5STinH3/FXeN9UTUN+Jc86Fq0VbDcSPs4o0ePr+MbGXYqllUNbQGaKTUD7zfuOn78MwO9CCiKdHWHMvCZOiGS9z+rq+yy8BuLg+nlxej7taZAFJ10eZQKpigJzT8qgPELqLChTpykYdKtfG1D3QIDAQAB'; //修改成自己的 支付宝公钥

    public function getStr($arr,$type = 'RSA'){
        //筛选
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        if(isset($arr['sign_type']) && $type == 'RSA'){
            unset($arr['sign_type']);
        }
        //排序
        ksort($arr);
        //拼接
        return  $this->getUrl($arr,false);
    }
    //将数组转换为url格式的字符串
    public function getUrl($arr,$encode = true){
        if($encode){
            return http_build_query($arr);
        }else{
            return urldecode(http_build_query($arr));
        }
    }

    //获取签名RSA2
    public function getRsa2Sign($arr){
        return $this->rsaSign($this->getStr($arr,'RSA2'), self::APPPRIKEY,'RSA2') ;
    }
    //获取含有签名的数组RSA
    public function setRsa2Sign($arr){
        $arr['sign'] = $this->getRsa2Sign($arr);
        return $arr;
    }
    public function checkSign($arr){
        if($this->getRsa2Sign($arr) == $arr['sign']){
            return true;
        }else{
            return false;
        }
    }

    public function curlRequest($url,$data = ''){
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_TIMEOUT] = 30; //超时时间
        if(!empty($data)){
            $params[CURLOPT_POST] = true;
            $params[CURLOPT_POSTFIELDS] = $data;
        }
        $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
        $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }
    /**
     * RSA签名
     * @param $data 待签名数据
     * @param $private_key 私钥字符串
     * return 签名结果
     */
    function rsaSign($data, $private_key,$type = 'RSA') {

        $search = [
            "-----BEGIN RSA PRIVATE KEY-----",
            "-----END RSA PRIVATE KEY-----",
            "\n",
            "\r",
            "\r\n"
        ];

        $private_key=str_replace($search,"",$private_key);
        $private_key=$search[0] . PHP_EOL . wordwrap($private_key, 64, "\n", true) . PHP_EOL . $search[1];
        $res=openssl_get_privatekey($private_key);

        if($res)
        {
            if($type == 'RSA'){
                openssl_sign($data, $sign,$res);
            }elseif($type == 'RSA2'){
                //OPENSSL_ALGO_SHA256
                openssl_sign($data, $sign,$res,OPENSSL_ALGO_SHA256);
            }
            openssl_free_key($res);
        }else {
            exit("私钥格式有误");
        }
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * RSA验签
     * @param $data 待签名数据
     * @param $public_key 公钥字符串
     * @param $sign 要校对的的签名结果
     * return 验证结果
     */
    function rsaCheck($data, $public_key, $sign,$type = 'RSA')  {
        $search = [
            "-----BEGIN PUBLIC KEY-----",
            "-----END PUBLIC KEY-----",
            "\n",
            "\r",
            "\r\n"
        ];
        $public_key=str_replace($search,"",$public_key);
        $public_key=$search[0] . PHP_EOL . wordwrap($public_key, 64, "\n", true) . PHP_EOL . $search[1];
        $res=openssl_get_publickey($public_key);
        if($res)
        {
            if($type == 'RSA'){
                $result = (bool)openssl_verify($data, base64_decode($sign), $res);
            }elseif($type == 'RSA2'){
                $result = (bool)openssl_verify($data, base64_decode($sign), $res,OPENSSL_ALGO_SHA256);
            }
            openssl_free_key($res);
        }else{
            exit("公钥格式有误!");
        }
        return $result;
    }
}