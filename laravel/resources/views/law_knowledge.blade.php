<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="法律咨询，律师，法律咨询电话" /><meta name="description" content="找法网手机版为您提供法律咨询、找律师、查询法律法规，各地区律师电话咨询服务" />	<link type="text/css" href="law_css/law_touch.css" rel="stylesheet" />
    <script type="text/javascript" src="law_css/mobi.min.js" charset="gbk"></script>

</head>
<body>
<header>
    <div class="logo fl"><a class="fl" href="default.htm">手机找法网</a></div>
    <div class="change_city fr f14 cfff">
        <span class="mr5">广州</span>
        <a class="cfff" href="area">[切换]</a>
    </div>
</header>	<nav class="pt20">
    <ul>
        <li><a class="ask" href="ask">发咨询</a></li>
        <li><a class="findlawyers" href="lawyer">找律师</a></li>
        <li><a class="fagui" id="tougao">律师投稿</a></li>
    </ul>
</nav>
<script>
    $('#tougao').on('click',function(){
        $.get("/user_role_type",
                function(data){
                    console.log(data);
//                    alert(data);
                    var res=JSON.parse(data);
                    if(res.code == 1){
                        var r = confirm('是否输入方便，如果方便，您即将进入到投稿页面;如果输入不方便可以选择投稿栏目');
                        if (r==true){
                            location.href="/tougao";
                        }else{
                            location.href="/tiaozhuan";
                        }
                    }else if(res.code == 2){
                        alert(res.msg);
                        location.href='/tiaozhuan';
                    }else if(res.code == 3){
                        alert(res.msg);
                        location.href='/tiaozhuan';
                    }
                }
        )
    })
</script>
<div class="new_ask">
    <h2 class="hd"><a href="ask">最新法律咨询</a></h2>
    <div class="bd f17">
        <ul class="fl_list">
            <li><a href="ask/question_26648000.html">劳动法退休赔偿<span>回复数: 0</span></a></li>
            <li><a href="ask/question_26647996.html">因工受伤不解除劳动关系的应<span>回复数: 0</span></a></li>
            <li><a href="ask/question_26647995.html">我家前面盖的是点式楼低层9<span>回复数: 0</span></a></li>
            <li><a href="ask/question_26648002.html">淘宝兼职刷信誉维权<span>回复数: 0</span></a></li>
            <li><a href="ask/question_26647992.html">您好，我想咨询下抢劫几千元<span>回复数: 0</span></a></li>
        </ul>
    </div>
    <div class="ft item_bt">
        <a class="aw_link" href="ask">进入咨询中心>></a>
    </div>
</div>

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

<div class="new_article">
    <h2 class="hd"><a href="hot">时事热点</a></h2>
    <div class="bd f17">
        <ul class="fl_list">
            @foreach($hot_data as $k=>$v)
                <li>
                    <a href="/hot_detail?h_id={{$v->h_id}}">{{$v->h_title}}<span>回复数: 0</span></a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="ft item_bt">
        <a class="aw_link" href="/all_hot">进入咨询中心>></a>
    </div>
</div>

<div class="rec_lawyer">
    <h2 class="hd"><a href="lawyer">推荐广州律师</a></h2>
    <div class="ly_list bd f17">
        <ul>
            <li class="clearfix">
                <a href="lawyer/person_isaacchanlaw.html">
                    <p class="hs_link"><img alt="陳樂超" src="http://d01.findlawimg.com/my/photo/20130115165256.gif"></p>
                    <p><span class="ly_name">陳樂超</span>广东 - 广州</p>
                    <p>专长： 损害赔偿 经济纠...</p>
                    <p>电话：<span class="cf60">13427813313</span></p>
                </a>
            </li><li class="clearfix">
                <a href="lawyer/person_zzhylawyer.html">
                    <p class="hs_link"><img alt="邹宙阳" src="http://d03.findlawimg.com/my/photo/20130827225336.jpg"></p>
                    <p><span class="ly_name">邹宙阳</span>广东 - 广州</p>
                    <p>专长： 损害赔偿 刑事辩...</p>
                    <p>电话：<span class="cf60">13711506518</span></p>
                </a>
            </li><li class="clearfix">
                <a href="lawyer/person_legohe.html">
                    <p class="hs_link"><img alt="何丽国" src="http://d03.findlawimg.com/my/photo/20130901214937.jpg"></p>
                    <p><span class="ly_name">何丽国</span>广东 - 广州</p>
                    <p>专长： 经济纠纷 刑事辩...</p>
                    <p>电话：<span class="cf60">15622757788</span></p>
                </a>
            </li>        </ul>
    </div>
    <div class="ft item_bt">
        <a class="aw_link" href="lawyer">进入律师中心>></a>
    </div>
</div>
<a class="tips_box" href="tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
<footer class="f16 tc c666">
    <div class="footer_bar">
        <a href="login">登录</a>
        <a href="register">注册</a>			<!--<a href="http://m.findlaw.cn/shortcut">下载到手机桌面</a>-->
        <a href="#" class="to_top tl">TOP</a>
    </div>
    <div class="footer_version">
        <a href="../3g.findlaw.cn/default.htm">普通版</a>
        <a href="default.htm">触屏版</a>
        <a href="../china.findlaw.cn/default.htm">电脑版</a>
    </div>
    <div class="footer_nav">
        <a href="default.htm">首页</a>
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