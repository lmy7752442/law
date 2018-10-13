<!DOCTYPE HTML>
<html>
<head>
	<meta charset="gbk" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>仿找法网触屏手机wap法律网站模板律师正文-【shenghuofuwu/chaxun/】</title>
	<meta name="keywords" content="找律师，律师电话" /><meta name="description" content="欢迎光临广东广州刘小丽律师的网上法律咨询室。刘小丽律师法律咨询电话:15322380728，同时您也可以选择在线免费法律咨询刘小丽律师。" />	<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
	<script type="text/javascript" src="/law_css/mobi.min.js" charset="gbk"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link type="text/css" href="/layer/theme/default/layer.css" rel="stylesheet" />
	<script type="text/javascript" src="/layer/layer.js"></script>
</head>
<body>
<header class="sub_header">
	<a class="b_link" href="as?status=1">首页</a>
	<ul class="top_nav">
		<li><a href="ask">发咨询</a></li>
		<li><a href="lawyer">找律师</a></li>
		<li><a href="fagui">查法规</a></li>
	</ul>
	<h1 class="sub_title">个人中心</h1>
</header>
<div class="f16">
	
	<div class="plpr10 item_bt item_bb">
		<h3 class="mt10 mb10 f18 fb cf60">{{$reward_problem['q_title']}}</h3>
		<?php if(!empty($reward_comment)) {?>
		@foreach($reward_comment as $v)
		<p class="mt10 mb10 c666 l26">{{$v['username']}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($v['is_best'] == 1)<span style="color:red">最佳答案</span>@endif @if($is_best > 0) @else<a href="javascript:;" onclick="isbest($(this))" data-rcid="{{$v['rc_id']}}" data-q_id="{{$v['rp_id']}}">设置为最佳答案</a>@endif<br/>&nbsp;&nbsp;&nbsp;&nbsp;{{$v['content']}}</p>
		@endforeach
		<?php }else{ ?>
		 还没有人评论~
		<?php } ?>
	</div>
	
</div>
<div class="search_bar fl_form pt item_bt">
	<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
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
	function isbest(obj){
	  var id = obj.data('rcid');
	  var q_id = obj.data('q_id');
	  var token = $('#token').val();
      $.post('/index.php/select_best',{rc_id:id,q_id:q_id,_token:token},function(info){
		    if(info.status == 1){
				layer.msg(info.msg,{icon:1},function(){
				   location.href="/index.php/person";
				});
			}else{
			   layer.msg(info.msg,{icon:2});	
			}
		 },'json')
	}
</script>