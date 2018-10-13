<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="法律咨询，律师，法律咨询电话" /><meta name="description" content="找法网手机版为您提供法律咨询、找律师、查询法律法规，各地区律师电话咨询服务" />	<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
    <script type="text/javascript" src="/law_css/mobi.min.js" charset="gbk"></script>

</head>
<body>

<div class="new_article">
    <h2 class="hd"><a href="article">最新律师稿子</a></h2>
    <div class="bd f17">
        <ul class="fl_list">
            @foreach($gaozi_data as $k=>$v)
                <li>
                    <a href="/gaozi_detail?art_id={{$v->art_id}}">{{$v->title}}<span>回复数: 0</span></a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="ft item_bt">
        <a class="aw_link" href="/all_gaozi">进入咨询中心>></a>

    </div>
</div>

<a class="tips_box" href="tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
<footer class="f16 tc c666">
    <div class="footer_bar">
        {{--<a href="login">登录</a>--}}
        {{--<a href="register">注册</a>			<!--<a href="http://m.findlaw.cn/shortcut">下载到手机桌面</a>-->--}}
        <a href="#" class="to_top tl">TOP</a>
    </div>
    <div class="footer_version">
        <a href="../3g.findlaw.cn/default.htm">普通版</a>
        <a href="default.htm">触屏版</a>
        <a href="../china.findlaw.cn/default.htm">电脑版</a>
    </div>
    <div class="footer_nav">
        <a href="as?status=1">首页</a>
        <a href="ask">发咨询</a>
        <a href="lawyer">找律师</a>
        <a id="pc_tougao">律师投稿(使用电脑输入)</a>
    </div>
    <script>
        $('#pc_tougao').on('click',function(){
            alert('http://ruirui.jinxiaofei.xyz/pc_tougao');
        })
    </script>
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