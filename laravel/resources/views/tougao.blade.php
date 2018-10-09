<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板律师在线-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="广州律师  广州律师在线 广州法律咨询  律师" /><meta name="description" content="找法网广州律师网为您提供广州律师在线法律咨询服务和法律法规、法律知识查询。解决法律难题 请找广州律师，专业律师在线为您提供全面的广州法律咨询服务。" />		<link type="text/css" href="law_css/law_touch.css" rel="stylesheet" />
    <script type="text/javascript" src="law_css/mobi.min.js" charset="gbk"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<header class="sub_header">
    <a href="law_knowledge" class="b_link">首页</a>
    <h1 class="sub_title">律师投稿</h1>
</header>
<style>
    #text{
        margin-left:28px;
    }
    #title{
        margin-left:45px;
        margin-top:10px;
    }
    #content{
        margin-left:45px;
        margin-top:10px;
    }

    #submit{
        margin-left:45px;
        margin-top:10px;
    }
</style>
<div style="border:solid red 1px;width:1300px;height:1700px;" id="text">
    {{--<div style=" overflow:scroll; width:400px; height:400px;”>  overflow-y:auto; overflow-x:auto; --}}
    <table>
        <tr>
            <td>
                <input type="text" name="title" style="border:solid yellow 1px;width:1200px;height:70px;" id="title" placeholder="请输入稿子标题">
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="content" style="border:solid blue 1px;width:1200px;height:1400px;" id="content">
                </textarea>
            </td>
        </tr>
        <tr>
            <td>
                <a style="margin-left:45px;margin-top: 10px;">稿子类型</a>&nbsp;&nbsp;
                <select name="cate_id" style="margin-top: 10px;">
                    @foreach($cate_data as $k=>$v)
                        <li>
                            <option value="{{$v->cate_id}}" id="cate_id">{{$v->catename}}</option>
                        </li>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" value="提交稿子" id="submit">
            </td>
        </tr>
    </table>
</div>
<script>
    $("#submit").click(function() {
        //获取稿子标题
        var title = $("[name=title]").val();
//        console.log(title);
        //获取稿子内容
        var content = $("[name=content]").val();
//        console.log(content);
        //获取稿子类型
        var cate_id = $("#cate_id").val();
//        console.log(cate_id);
        $.ajax({
            url:"/gaozi_add",
            type:'get',
            data:{title:title,content:content,cate_id:cate_id},
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.msg == '投稿成功') {
                    alert('投稿成功');
                    window.location.href="tiaozhuan";
                }else{
                    alert('投稿失败');
                    window.location.href="/tougao";
                }
            }
        });
    })
</script>
<a class="tips_box" href="../tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
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