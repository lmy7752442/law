<!DOCTYPE HTML>
<html>
<head>
	<meta charset="gbk" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>仿找法网触屏手机wap法律网站模板法律咨询-【shenghuofuwu/chaxun/】</title>
	<meta name="keywords" content="法律咨询" /><meta name="description" content="输入标题和内容就可以免费免注册发布您的法律咨询，手机一号登陆方便快捷查看回复" />	<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
	<script type="text/javascript" src="/law_css/mobi.min.js" charset="gbk"></script>

</head>
<body>
<header class="sub_header">
	<a href="as?status=1" class="b_link">首页</a>
	<ul class="top_nav">
		<li><a href="ask">发咨询</a></li>
		<li><a href="lawyer">找律师</a></li>
		<li><a href="fagui">查法规</a></li>
	</ul>
	<h1 class="sub_title">手机发布</h1>
</header>
<div class="fl_form">
	<form action="http://m.findlaw.cn/index.php?m=Ask&a=post" method="post">
		<input type="hidden" name="submit" value="1" />
		<p><label>内容：</label><textarea class="txt_ipt" name="qcontent" id="qcontent"></textarea></p>
		<p><label>手机号：</label><input class="txt_ipt" type="text" name="qmobile" id="qmobile" /></p>
		<p class="c666">地区：广州 [<a class="fl_link" id="changecity" href="../area">切换城市</a>]</p>
		<p><input class="btn" value="提交咨询" type="submit" /></p>
		<a class="fl_form_link f14 cf60" href="ask">咨询列表&gt;&gt;</a>
		<input type="hidden" name="__hash__" value="6d60365cb2659dde41d9a1f47b99ba9c" /></form>
</div>
<script>
    $('#changecity').click(function(){
        var val = $('#qcontent').val() + '###' + $('#qmobile').val();
        document.cookie = "askcontentmobile=" + escape(val);
    });
    (function(){
        var arrStr = document.cookie.split("; ");
        for(var i = 0;i < arrStr.length;i ++) {
            var temp = arrStr[i].split("=");
            if(temp[0] == 'askcontentmobile') {
                var val = unescape(temp[1]);
                var valarr = val.split('###');
                $('#qcontent').val(valarr[0]);
                $('#qmobile').val(valarr[1]);
            }
        }
    })();
</script>

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