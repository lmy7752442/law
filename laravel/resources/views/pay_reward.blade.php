<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>悬赏金额支付</title>
	<meta name="keywords" content="悬赏金额支付" /><meta name="description" content="输入标题和内容就可以免费免注册发布您的法律咨询" />	<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
    	<script type="text/javascript" src="/law_css/mobi.min.js" ></script>
   <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<link type="text/css" href="/layer/theme/default/layer.css" rel="stylesheet" />
<script type="text/javascript" src="/layer/layer.js"></script>
</head>
<body>
<header class="sub_header">
		<a href="as?status=1" class="b_link">首页</a>
		<ul class="top_nav">
			<li><a href="ask">发咨询</a></li>
			<li><a href="lawyer">找律师</a></li>
			<li><a href="fagui">查法规</a></li>
		</ul>
		<h1 class="sub_title">悬赏金额支付</h1>
	</header>
	<div class="fl_form">
	    <p>订单号：{{$data['order_no']}}</p>
        <p><input type="radio" name="pay_type" value="1" checked>余额支付{{--&nbsp;&nbsp;<input type="radio" name="pay_type" value="2" >微信--}}</p>
		<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        <p><input class="btn" id="rewardSubmit" value="去支付" type="button" /></p>
        
</div>

    <a class="tips_box" href="tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
	<footer class="f16 tc c666">
		<div class="footer_bar">
							<a href="../login">登录</a>
				<a href="../register">注册</a>			<!--<a href="http://m.findlaw.cn/shortcut">下载到手机桌面</a>-->
			<a href="#" class="to_top tl">TOP</a>
		</div>
		<div class="footer_version">
			<a href="../../3g.findlaw.cn/default.htm">普通版</a>
			<a href="../default.htm">触屏版</a>
			<a href="../../china.findlaw.cn/default.htm">电脑版</a>
		</div>
		<div class="footer_nav">
			<a href="as?status=1">首页</a>
			<a href="ask">发咨询</a>
			<a href="lawyer">找律师</a>
			<a href="fagui">查法规</a>
		</div>
		<p class="copyright">Copyright@2003-2014　版权所有 找法网（Findlaw.cn）- 中国最大的法律服务平台</p>
	</footer>
</body>
</html>
<script type="text/javascript">

$(function(){
	$(window).bind("scroll",function(){
		if(document.body.scrollTop>60){
			$(".tips_box").show();
		}else{
			$(".tips_box").hide();
		}
	});
});

var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F16f2e7c9bbcd505f4a9cf6e267e10b0c' type='text/javascript'%3E%3C/script%3E"));
$(document).ready(function(){
    var $a = $('body>a');
    $a[$a.length - 1].style.display = 'none';
});
</script>
<script type="text/javascript">
	  $('#rewardSubmit').click(function(){
		 var pay_type = $("input[name='pay_type']:checked").val();
		 var token = $('#token').val();
		 if(pay_type != 1){
		     layer.msg('请选择支付方式',{icon:2});
			 return false;
		 }
	     $.post('/index.php/pay_rewardDo',{pay_type:pay_type,order_no:{{$data['order_no']}},_token:token},function(info){
		    if(info.status == 1){
				 layer.msg(info.msg,{icon:1},function(){
				   location.href=info.url;
				 });
			}else{
			   layer.msg(info.msg,{icon:2});	
			}
		 },'json')
	  })
	</script>