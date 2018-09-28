<?php
session_start();
$sessionid = session_id();

require_once 'phpqrcode/phpqrcode.php'; //引入类库
//        $text = "lr199966@152x";//要生成二维码的文本
//$text = "http://ruirui.jinxiaofei.xyz?session_id=".$sessionid;
//$text = $sessionid;
//$logo = './a.png';//定义logo路径
QRcode::png($text,false,'H',4,2,false);//输出到浏览器或者生成文件
?>