<!DOCTYPE HTML>
<html>
<head>
	<meta charset="gbk" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>仿找法网触屏手机wap法律网站模板律师正文-【shenghuofuwu/chaxun/】</title>
	<meta name="keywords" content="找律师，律师电话" /><meta name="description" content="欢迎光临广东广州刘小丽律师的网上法律咨询室。刘小丽律师法律咨询电话:15322380728，同时您也可以选择在线免费法律咨询刘小丽律师。" />	<link type="text/css" href="law_css/law_touch.css" rel="stylesheet" />
	<script type="text/javascript" src="law_css/mobi.min.js" charset="gbk"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

</head>
<body>
<header class="sub_header">
	<a class="b_link" href="as?status=1">首页</a>
	<ul class="top_nav">
		<li><a href="ask.html">发咨询</a></li>
		<li><a href="../lawyer/lawyer.html">找律师</a></li>
		<li><a href="../fagui/fagui.html">查法规</a></li>
	</ul>
	<h1 class="sub_title">个人中心</h1>
</header>
<div class="f16">
	<div class="ly_info f17">
		<p class="hs_link"><img alt="刘小丽" src="{{$user->headimg}}" /></p>
		<p><span class="ly_name">{{$user->username}} (<?php if($user->role_type==1){echo '用户';}else{echo '律师';}?>)</span>勋章等级：<?php if($user->m_id==''){echo '暂无';}else{echo $user->m_id;} ?></p>
		{{--<p><a href="tel_3A15322380728" class="ly_mp_num">15322380728</a></p>--}}
		<p>账户余额：{{$user->money}}</p>
		<div style="margin-left: 70px"><button id="chongzhi" >充值</button>  <button id="tixian">提现</button></div>
	</div>

	<script>
		$('#chongzhi').click(function(){
		    location.href = 'chongzhi';
        })
        $('#tixian').click(function(){
            location.href = 'tixian';
        })
	</script>
	@if($user->role_type == 1)
	<div class="plpr10 item_bt item_bb">
		<h3 class="mt10 mb10 f18 fb cf60">悬赏问题</h3>
		 @foreach($reward_problem as $v)
			<p class="mt10 mb10 c666 l26"><a href="/index.php/person_reward_detail?q_id={{$v['q_id']}}">{{$v['q_title']}}</a></p>@if($v['pay_status'] == 1)<a href="/index.php/pay_reward?order_no={{$v['order_no']}}}">（待支付）</a>@endif
		@endforeach
	</div>
	@endif
	@if($user->role_type == 1)
		<a href="/index.php/postReward">发布悬赏</a>
	@endif
	<div class="plpr10 item_bt item_bb">
		<h3 class="mt10 mb10 f18 fb cf60">擅长专业</h3>
		<p class="mt10 mb10 c666 l26">婚姻家庭 公司法 企业法律顾问 债务债权 婚姻家庭 合同纠纷 交通事故 继承 工伤赔偿</p>
	</div>
	<div class="plpr10 item_bt item_bb">
		<h3 class="mt10 mb10 f18 fb cf60">个人简介</h3>
		<div class="mt10 mb10 c666 l26">刘小丽律师，中华全国律师协会会员，暨南大学法律硕士，现执业于广东高睿律师事务所。

			刘律师从事法律工作多年，拥有多年大型知名企业的法律管理和律师行业的工作经验，执业至今，积累了丰富的诉讼和非诉讼经验和技巧，善于抓住案件的关键问题并综合运用法律知识和技巧为企业及个人提供有价值的、高效率的、可信赖的法律服务。工作责任心强，逻辑严谨、办案细致，勤于思考，尤其擅长处理合同及经济纠纷、公司法律顾问、股权纠纷、婚姻继承、劳资纠纷、债权债务、交通事故等方面案件。


			“受人之托，忠人之事，勤勉尽责，专业专注”是刘律师一直秉承的法律服务理念，在办案过程中坚持从委托人的立场出发，敏锐地捕捉到案件的关键信息，寻找突破口，善于根据委托人要求及客观情况的变化及时调整办案策略，力求在法律许可的范围内最大限度地维护委托人的利益。从业期间以其精湛的法律水平、严谨的工作作风和务实的态度赢得当事人的一致好评。


			自由的职业、富有挑战性的法律工作，刘律师一直享受其中，更希望通过自己的工作能帮助有需要的人，因此，刘律师工作之余，积极参加司法局、律协组织的法律咨询活动、社区法律咨询活动等。


			法庭的审判，需要灵巧的智慧、敏捷的思路以及决定应对的能力。优柔寡断，往往会招致失败。有时候，场上的情况又要求律师要有自控能力，不论你的内心多么焦急忧虑，外表上必须像平静的池水一样沉着冷静。
			---------------Clarence Darrow（美国历史上最伟大的律师）






			部分业务介绍：



			公司常年法律顾问方面：为企业建立、修订和完善人力资源、行政、财务、资产及合同管理等方面的管理制度；审查各种日常性的法律文书；审查和修订各种合同，建立合同管理制度；通过法律途径催收账款；为企业提供应急事件、诉讼风险等各个方面的管理制度和服务。






			婚姻家庭方面：以女性律师特有的视角和洞察力，为客户提供专业的个性化的法律服务。先后承办了大量国内及涉外婚姻家庭诉讼、非诉讼业务，对离婚财产分配、子女抚养、遗产继承等婚姻家庭领域诉讼及非诉讼业务具有丰富的实践经验。





			合同争议、劳动纠纷、债权债务方面：代理仲裁、诉讼、谈判、起草协议等诉讼与非诉等法律事务。



			交通事故方面：可以全面代理咨询、调解、计算赔偿数额、立案、开庭等业务，为您腾出更多时间处理自己事务。</div>
	</div>
</div>
<div class="search_bar fl_form pt item_bt">
	<form action="http://m.findlaw.cn/?m=Findlawyer&a=search" name="form1" method="post">
		<input class="txt_ipt mr10" type="text" name="kw" x-webkit-speech="x-webkit-speech"/><input class="btn" value="搜律师" type="submit" />
		<input type="hidden" name="__hash__" value="f0ea8a5f5e5ae888a3c9df988a4d1d2a" /></form>
</div>
<a class="tips_box" href="tel_3A400-676-8333"><div class="tips_inbox"><span class="tips_tel">400-676-8333</span><span class="tips_inbox-text">点击免费咨询律师</span></div></a>
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