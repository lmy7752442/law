<?php
//普通接收返回消息
$xml = file_get_contents('php://input','r');

file_put_contents(__DIR__.'/aa.log',$xml."\r\n" ,FILE_APPEND);
//接收消息
function XmlToArr($xml)
{
    if($xml == '') return '';
    libxml_disable_entity_loader(true);
    $arr = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $arr;
}
$accept = XmlToArr($xml);
//判断是否是扫码推事件,存sessionid,openid
if($accept['Event']=='scancode_push' || $accept['Event']=='scancode_waitmsg'){
    $link = mysqli_connect('127.0.0.1','root','root','shop');
    if (!$link) {
        file_put_contents(__DIR__.'/aa.log','error('.mysqli_connect_errno().'):'.mysqli_connect_error()."\r\n" ,FILE_APPEND);
    }
    mysqli_set_charset($link,'utf8');
    $a = strpos($accept['ScanCodeInfo']['ScanResult'],'=');
    $b = substr($accept['ScanCodeInfo']['ScanResult'],$a+1);
    $c = strrpos($accept['ScanCodeInfo']['ScanResult'],'/');
    $d = substr($accept['ScanCodeInfo']['ScanResult'],$a+1);
//    print_r($b);exit;
    $sql = "insert into session_openid(sessionid,openid) values('".$d."','".$accept['FromUserName']."')";
    $result = mysqli_query($link,$sql);
    if ($result) {
        file_put_contents(__DIR__.'/aa.log',"新记录插入成功"."\r\n" ,FILE_APPEND);
    } else {
        file_put_contents(__DIR__.'/aa.log', "Error: " . $sql . "<br>".$accept['ScanCodeInfo']['ScanResult'] . mysqli_error($conn)."\r\n" ,FILE_APPEND);
    }
    mysqli_close($link);
}

//发送消息
$arr = [
    'ToUserName' => $accept['FromUserName'],
    'FromUserName' =>$accept['ToUserName'] ,
    'CreateTime' =>time(),
    'MsgType' => 'text',
    'Content' => '哈哈哈'
];
function ArrToXml($arr)
{
    if(!is_array($arr) || count($arr) == 0) return '';

    $xml = "<xml>";
    foreach ($arr as $key=>$val)
    {
        if (is_numeric($val)){
            $xml.="<".$key.">".$val."</".$key.">";
        }else{
            $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
    }
    $xml.="</xml>";
    return $xml;
}
$new_xml = ArrToXml($arr);
echo $new_xml;
file_put_contents(__DIR__.'/bb.log',$new_xml."\r\n" ,FILE_APPEND);

?>