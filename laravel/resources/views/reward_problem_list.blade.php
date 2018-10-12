<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板律师在线-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="广州律师  广州律师在线 广州法律咨询  律师" /><meta name="description" content="找法网广州律师网为您提供广州律师在线法律咨询服务和法律法规、法律知识查询。解决法律难题 请找广州律师，专业律师在线为您提供全面的广州法律咨询服务。" />		<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
    <script type="text/javascript" src="/law_css/mobi.min.js" charset="gbk"></script>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<link type="text/css" href="/layer/theme/default/layer.css" rel="stylesheet" />
	<script type="text/javascript" src="/layer/layer.js"></script>
</head>
<style>
.page-item{
  width:20px;
  float:left;
  margin-left:2px;
}
.ly_list ul li{
  line-height:30px;
  padding-left:15px;
}
</style>
<body>
<header class="sub_header">
    <a href="../default.htm" class="b_link">首页</a>
    <ul class="top_nav">
        <li><a href="ask.html">发咨询</a></li>
        <li><a href="lawyer">找律师</a></li>
        <li><a href="../fagui/fagui.html">查法规</a></li>
    </ul>
    <h1 class="sub_title">悬赏列表</h1>
</header>
<div class="f16" style="margin-top:10px">
    <div class="ly_list bd f17">
        <ul>
		    @foreach($reward_problem as $v)
            <a href="/index.php/reward_comment?q_id={{$v->q_id}}"><li class="clearfix">
                <P style="float:left"><?php echo str_limit($v->q_title, $limit = 40, $end = '...');?></P>
            </li>
			</a>
			@endforeach
			</ul>
    </div>
</div>
<div class="page_control item_bt c666" style="margin-bottom:40px">
<p class="mb10" style="text-align:center">{{ $reward_problem->links() }}</p> 
<script type="text/javascript"> 
        $('#pagesForm').submit(function(){
            var page = $(this).children('input[name=page]').val();
            if (page <= 0) {
                alert('请填写一个大于 0 的页码！');
                return false;
            } else if (page > 15) {
                alert('跳转页码不能超过最大页码 15！');
                return false;
            }
        });
    </script>
	<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
</div>

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
        <a href="../default.htm">首页</a>
        <a href="../ask/ask.php">发咨询</a>
        <a href="../lawyer">找律师</a>
        <a href="../fagui">查法规</a>
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
