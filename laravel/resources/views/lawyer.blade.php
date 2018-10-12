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
</style>
<body>
<header class="sub_header">
    <a href="../default.htm" class="b_link">首页</a>
    <ul class="top_nav">
        <li><a href="ask.html">发咨询</a></li>
        <li><a href="lawyer">找律师</a></li>
        <li><a href="../fagui/fagui.html">查法规</a></li>
    </ul>
    <h1 class="sub_title">找律师</h1>
</header>
<div class="f16">
<!--     <p class="city_bar dash_bb bgcfff c666">地区：广州 [<a class="fl_link" href="../area/@ar=a_7C1702">切换城市</a>]</p> -->
<!--     <dl class="tag_box bar c666 bgcfff dash_bb clearfix"> -->
<!--         <dt>专长：</dt> -->
<!--         <dd><a class="cur" href="../lawyer/default.htm">全部</a></dd> -->
<!--         <dd><a href="../lawyer/a1702_p17" >婚姻家庭</a></dd><dd><a href="../lawyer/a1702_p22" >合同纠纷</a></dd><dd><a href="../lawyer/a1702_p25" >医疗事故</a></dd>        <dd><a href="../ask/sort@ar=a_7C1702,p_7Call">更多</a></dd> -->
<!--     </dl> -->
    <div class="ly_list bd f17">
        <ul>
		    @foreach($law_data as $v)
            <li class="clearfix">
                <a href="javascript:;">
                    <p class="hs_link">@if($v->ID_Photo == '')<img src="/images/empty.jpg">@else<img alt="{{$v->username}}" src="{{$v->ID_Photo}}">@endif</p>
                    <p><span class="ly_name">{{$v->username}}</span><a href="javascript:;" style="padding-left:180px"  onclick="consult($(this))" data-uid="{{$v->id}}" data-phone="{{$v->mobile}}">咨询</a></p>
                    <p style="padding-top:3px">已帮助：<span class="cf60">{{$v->help_count}}人</span><span style="padding-left:10px;padding-right:10px">|</span>好评数：<span class="cf60">{{$v->help_count}}条</span></p>
					<p style="padding-top:3px">{{$v->introduce}}</p>
                </a>
            </li>
			@endforeach
			</ul>
    </div>
</div>
<div class="page_control item_bt c666">
<p class="mb10" style="text-align:center">{{ $law_data->links() }}{{--<a class="next_p page_btn mr10" href="/index.php/lawyer?page=">下一页</a><span>(1/15)</span></p><p><form id="pagesForm" action="http://m.findlaw.cn/lawyer/a1702" method="get">跳到第<input class="txt_ipt" type="number" max="15" min="1" name="page">页<input class="page_btn ml10" type="submit" value="跳转">--}}<input type="hidden" name="__hash__" value="ea4937e1ba27c6d1054b1e13223f5949" /></form></p> 
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
	</div>
	<div class="search_bar fl_form" style="text-align:center">
	<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
    {{--<form action="http://m.findlaw.cn/?m=Findlawyer&a=search" name="form1" method="post">
        <input class="txt_ipt mr10" type="text" name="kw" x-webkit-speech="x-webkit-speech"/><input class="btn" value="搜律师" type="submit" />
        <input type="hidden" name="__hash__" value="ea4937e1ba27c6d1054b1e13223f5949" /></form>--}}
</div>

<a class="tips_box" href="../tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
<div style="margin-top:50px"><input type="button" value="撤销" id="rock"></div>
<div style="margin-top:20px"><a href="/index.php/relayconsult?consult_id=3">咨询回复(律师进行回复)</a></div>
<div style="margin-top:20px"><a href="/index.php/reward_problem_list">悬赏问题列表</a></div>
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
<script type="text/javascript">
   function consult(obj){
      var uid = obj.data('uid');
	  var mobile = obj.data('phone');
	  var token = $('#token').val();
      layer.confirm('请选择咨询方式',{
		  btn: ['电话咨询','在线咨询'] //按钮
		}, function(){
			$.post('/index.php/check',{uid:uid,_token:token},function(res){
			  if(res.status == 1){
                 window.location.href = 'tel://' + res.data;
			  }else{
			     window.location.href = '/index.php/obtain_contact?uid='+uid;
			  }
			},'json')
		   
		}, function(){
		  window.location.href = '/index.php/consult?id='+uid;
		});
   }
 
   $('#rock').click(function(){
	  var q_id = 3;
	  var token = $('#token').val();
      $.post('/index.php/revoke',{q_id:q_id,_token:token},function(info){
		    if(info.status == 1){
				layer.msg(info.msg,{icon:1});
			}else{
			   layer.msg(info.msg,{icon:2});	
			}
		 },'json')
   })
</script>