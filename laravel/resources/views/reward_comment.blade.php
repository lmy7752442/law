<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>悬赏问题</title>
	<meta name="keywords" content="悬赏问题回复" /><meta name="description" content="输入标题和内容就可以免费免注册发布您的法律咨询" />	<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
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
		<h1 class="sub_title">悬赏问题回复</h1>
	</header>
	<div class="fl_form">
    
	    <p >{{ $question['q_title'] }}</p>	
        <p><label>回复：</label><textarea class="txt_ipt" id="askContent" name="askContent" cols="30" rows="10" maxlength="2000" placeholder="请详细描述您的问题、目前的困惑，以便于律师精确分析，最少10个字"></textarea></p>
		<input type="hidden" id="q_id" value="{{$question['q_id']}}">
		<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        <p><input class="btn" id="askSubmit" value="回复" type="button" /></p>
        
</div>
<div class="s">
     @foreach($all_comment as $k=>$v)
    <div class="s" style="color:blue;">
            <img src="{{$v->headimg}}" alt="" style="width:40px;height:40px;">
		{{$v->username}}<?php echo date('Y-m-d H:i:s',$v->ctime);?>@if($v->is_best == 1)<span style="color:red">最佳答案</span>@endif
     </div>
    <div class="s">
     {{$v->content}}
     </div>
     @endforeach
</div>
    <a class="tips_box" href="tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
	<footer class="f16 tc c666">
		<div class="footer_bar">
							{{--<a href="../login">登录</a>--}}
				{{--<a href="../register">注册</a>			<!--<a href="http://m.findlaw.cn/shortcut">下载到手机桌面</a>-->--}}
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
	  $('#askSubmit').click(function(){
		 var content = $('#askContent').val();
		 var q_id = $('#q_id').val();
		 var token = $('#token').val();
		 if(content.length <10 || content.length > 800){
			 layer.msg('请输入10~800个字符，且需包含中文',{icon:2});
			 return false;
		 }
		 $.post('/index.php/reward_commentDo',{content:content,q_id:q_id,_token:token},function(info){
		    if(info.status == 1){
				layer.msg(info.msg,{icon:1},function(){
				    location.href="/as?status=1";
				})
			}else{
			   layer.msg(info.msg,{icon:2});	
			}
		 },'json')
	     
	  })
	</script>