<!DOCTYPE HTML>
<html>
<head>
    <meta charset="gbk" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>仿找法网触屏手机wap法律网站模板律师在线-【shenghuofuwu/chaxun/】</title>
    <meta name="keywords" content="广州律师  广州律师在线 广州法律咨询  律师" /><meta name="description" content="找法网广州律师网为您提供广州律师在线法律咨询服务和法律法规、法律知识查询。解决法律难题 请找广州律师，专业律师在线为您提供全面的广州法律咨询服务。" />		<link type="text/css" href="/law_css/law_touch.css" rel="stylesheet" />
    {{--<script type="text/javascript" src="/law_css/mobi.min.js" charset="gbk"></script>--}}
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    {{--<link rel="stylesheet" href="https://weui.io/weui.css">--}}

</head>
<body>
<style>
    .s{
        margin-top:10px;
    }
</style>
<header class="sub_header">
    {{--<a href="/" class="b_link">首页</a>--}}
    <h1 class="sub_title">时事热点展示</h1>
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
<div style="width:100%;height:100%;margin-left:0%; " id="text"  >
    {{--<div style=" overflow:scroll; width:400px; height:400px;”>  overflow-y:auto; overflow-x:auto; --}}
    <table>
        <input type="hidden" id="h_id" value="{{$data->h_id}}">
        <tr>
            <td>
                标题：
            </td>
            <td >
                {{$data->h_title}}
            </td>
        </tr>
        <tr>
            <td>
               热点 信息：
            </td>
            <td>
               {{$data->h_content}}
            </td>
        </tr>
    </table>

       <div class="s">
                <textarea name="" id="area" style="width:80%;height:70px;"></textarea>
                {{--<textarea class="weui-textarea" placeholder="请输入文本" rows="3"></textarea>--}}
       </div>
        <tr>
            <td>
                {{--<a href="javascript:;" class="weui-btn weui-btn_mini weui-btn_primary" id="bu">评论</a>--}}
                <input type="button" value="评论" id="bu">
            </td>
        </tr>


</div>
<div class="s">
     @foreach($arr as $k=>$v)
    <div class="s" style="color:blue;">
            <img src="{{$v->headimg}}" alt="" style="width:40px;height:40px;">
                {{$v->username}}{{$v->ctime1}}{{$v->m_id}}
     </div>
    <div class="s">
     {{$v->content}}
        <div style="margin-left:20px;" class="s">
            @if($v->res)
                @foreach($v->res as $key=>$val)
                    <div class="s" >
                        <div style="color:blue;">
                            <a href="javascript:;" >
                                <img src="{{$val->headimg}}" alt="" style="width:40px;height:40px;">
                                {{$val->username}}{{$val->ctime1}}{{$val->m_id}}
                            </a>
                        </div>
                        <div >
                            <a href="javascript:;" style="margin-left:20px;">{{$val->content}}</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
     </div>
    <div class="s">
             <input type="hidden" value="{{$v->comment_id}}" id="comment{{$v->comment_id}}">
             {{--<input type="hidden" value="{{$v->id}}" id="pid{{$v->comment_id}}">--}}
    </div>
   <div class="s">
            <input type="button" value="评论" onclick="but({{$v->comment_id}})">
            <div style="display: none;" class="div"class="s">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                {{--class="weui-btn weui-btn_mini weui-btn_primary"--}}
            </div>
    </div>
        <hr>
     @endforeach
</div>
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
<script>
    function but(i){
        // document.getElementsByClassName('div')[i].style.display='block';
        var comment_id = $('#comment'+i).val();
        // var pid = $('#pid'+i).val();
        location.href='/comment_do?pid='+comment_id;

    }
</script>
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
<script>
    $('#bu').on('click',function(){
        var id = $('#h_id').val();// 热点 id
        var area = $('#area').val();// 评论 内容
        $.get('/comment',
            {
                id:id,
                area:area
            },function(data){
            // alert(data);
               if(data == 1){
                   location.href='/hot_detail/?h_id='+id;
               }else{
                   alert('失败');
               }
            })
    })
</script>