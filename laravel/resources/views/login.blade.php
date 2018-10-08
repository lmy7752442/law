<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>欢迎登录后台</title>
    <link rel="stylesheet" href="/css/course.css"/>
    <link rel="stylesheet" href="/css/register-login.css"/>
    <script src="/js/jquery-1.8.0.min.js"></script>
    <link rel="stylesheet" href="/css/tab.css" media="screen">
    <script src="/js/jquery.tabs.js"></script>
    <script src="/js/mine.js"></script>
    <script src="/layer/layer.js"></script>
</head>

<body>


<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" style="background:url(/images/12.jpg) right center no-repeat #fff">
    <h2>登录</h2>
    <form style="width:600px">
        <div>
            <p class="formrow">
                <label class="control-label">帐号</label>
                <input type="text" name="user" value="xiaoxiaochengxuyuan">
            </p>
            <span class="text-danger">请输入账号/用户名</span>
        </div>
        <div>
            <p class="formrow">
                <label class="control-label" >密码</label>
                <input type="password" name="pwd" value="123456">
            </p>
            <p class="help-block"><span class="text-danger">密码错误</span></p>
        </div>
        <div class="loginbtn">
            <label><input type="checkbox"  checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
            <button type="button" class="uploadbtn ub1" name="btn">登录</button>

        </div>
        <div class="loginbtn lb">
            <a href="#" class="link-muted">还没有账号？立即免费注册</a>
            <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
            <a href="forgetpassword.html" class="link-muted">找回密码</a>
        </div>
    </form>
    <div class="hezuologo">
        <span class="hezuo">使用合作网站账号登录</span>
        <div class="hezuoimg">
            <img src="/images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40"/>
            <img src="/images/hezuowb.png" class="hzwb" title="微博" width="40" height="40"/>
        </div>

    </div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>
<div class="foot">
    <div class="fcontainer">
        <div class="fwxwb">
            <div class="fwxwb_1">
                <span>关注微信</span><img width="95" alt="" src="/images/num.png">
            </div>
            <div>
                <span>关注微博</span><img width="95" alt="" src="/images/wb.png">
            </div>
        </div>
        <div class="fmenu">
            <p><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">优秀讲师</a> | <a href="#">帮助中心</a> | <a href="#">意见反馈</a> | <a href="#">加入我们</a></p>
        </div>
        <div class="copyright">
            <div><a href="/">谋刻网</a>所有&nbsp;晋ICP备12006957号-9</div>
        </div>
    </div>
</div>
<!--右侧浮动-->
<div class="rmbar">
	<span class="barico qq" style="position:relative">
	<div  class="showqq">
        <p>官方客服QQ:<br>335049335</p>
    </div>
	</span>
	<span class="barico em" style="position:relative">
	  {{--<img src="law/laravel/public/ images/num.png" width="75" class="showem">--}}
	</span>
	<span class="barico wb" style="position:relative">
	  {{--<img src="law/laravel/public/ images/wb.png" width="75" class="showwb">--}}
	</span>
    <span class="barico top" id="top">置顶</span>
</div>
</body>

<!-- InstanceEnd --></html>
<script>
    $('[name=btn]').on('click',function(){
        var user = $('[name=user]').val();
        var pwd = $('[name=pwd]').val();
        if(  user == ''){
            layer.msg('账号不能为空');
            return false;
        }
        if(  pwd == ''){
            layer.msg('账号不能为空');
            return false;
        }
        $.ajax({
            url:"{:U('Login/login_do')}",
            type:"post",
            data:{user:user,pwd:pwd},
            dataType:'json',
            success:function(json_info){
                if(json_info.status == 1000){
                    layer.msg(json_info.data,{icon:1,time:500},function(){
                        window.location.href="{:U('Index/index')}";
                    });
                }else{
                    layer.msg(json_info.msg);
                }
            }
        })
    })
</script>
