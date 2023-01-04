<? include ("../include/top_main.php"); ?>
<?
	$sql="select * from site_option where 1=1 and member_no = '".$member_no."'";
	$result=mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($result);
?>
<script>
	function go_page(type) {
		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "../src/type_check.php",
			data :  { "type" : type , "auth_token" : auth_token },
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					if (type=="1") {
						location.href="../trip/01.php";
					} else if (type=="2") {
						location.href="../trip/01.php";
					} else if (type=="3") {
						location.href="../study_abroad/01.php";
					} else if (type=="4") {
						location.href="../trip/01.php";
					} else if (type=="5") {
						location.href="../trip/01.php";
					} else if (type=="6") {
						location.href="../trip/01.php";
					} else if (type=="7") {
						location.href="../trip/01.php";
					} else if (type=="8") {
						location.href="../trip/01.php";
					} else if (type=="9") {
						location.href="../trip/01.php";
					} else if (type=="10") {
						location.href="../trip/01.php";
					}

					return false;
				} else {
					alert(json.msg);
					$("#loading_area").delay(100).fadeOut();
					return false;
				}
				
			},
			error : function(err)
			{
				alert(err.responseText);
				$("#loading_area").delay(100).fadeOut();
				return false;
			}
		});
	}

	$(document).ready(function() {
	});
</script>

<script>
	function f_pop2(page,name){
		
		$("#yak_tit2").html(name);
		$('#yak_area2').load(page, function(){
			ViewlayerPop(20);
		});
		/*$.ajax({
			url: page,
			success: function(data) {
				$('#yak_area2').html(data);
				$("#yak_tit2").html(name);
			}
		})*/
		
	}

	function notice_pop(page,name){
		$("#yak_tit3").html(name);
		$('#yak_area3').load(page, function(){
			ViewlayerPop(21);
		});
	}

	$(document).ready(function(){
			//var noticeCookie = getCookie("startb_event");  // 쿠기 가져오기
			//if (noticeCookie != "OK"){     
			<?
				if($_SERVER['PHP_SELF'] == '/main/main.php'){
					if(time() < strtotime('2021-07-31 12:59:59')  ){
			?>
				notice_pop('../include/notice.php', 'NOTICE');
			//} 
			<?
					} else {
				//echo date("Y-m-d H:i:s", time());
			?>
				notice_pop('../include/notice1.php', 'NOTICE');	
			<?
					}
			}
			?>
		});

			function CloselayerPop_notice(){
		/*
			if(confirm('오늘 하루동안 창을 보지 않으시겠습니까?')){
				setCookie('startb_event','OK', '24');
				CloselayerPop();
			} else {
		*/
				CloselayerPop();
			//}
	}
</script>

<!DOCTYPE html>
<html lang="ko">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	  content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<head>
	<meta charset="UTF-8">
	<title>CHUBB</title>
	<link type="text/css" rel="stylesheet" href="../css1/reset.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/style.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/sub.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/ui.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/swiper.min.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/responsive.css"/>
	<style>
		.container {
			min-height: 800px;
			padding-bottom: 226px;
		}
		header:after {
			opacity: 0.55;
		}
		header.fixed:after {
			box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .25);
		}
		
		.sub_visual2_wrap:after {
			height: 250px;
			top: 0px;
		}

		@media (max-width: 1080px) {
			.container {
				min-height:90%;
				padding-bottom: 0px;
			}
			header .wrap {
				height: 50px;
			}
			.sub_visual2_wrap:after {
				top: 0px;
				height: 200px;
			}
		}
	</style>
</head>
<body>

<div class="container">
	<header class="">
		<div class="wrap inner relative">

			<h1 class="logo">
				<a href="/main/main.php">CHUBB 여행자보험</a>
			</h1>

			<a href="#none" class="mobile-menu"></a>
			<nav class="">
				<div class="gnb-wrap">
					<div class="gnb-btn-box">
						<a href="javascript:void(0);" onclick="go_page('4');" class="gnb-btn">태국 입국용</a>
					</div>
<?/*					
					<div class="gnb-btn-box">
						<a id="popup_open3" class="gnb-btn">아시아 입국용</a>
					</div>
*/?>					
					<div class="gnb-btn-box">
						<a href="javascript:void(0);" onclick="go_page('2');" class="gnb-btn">해외여행자보험</a>
					</div>
					<div class="gnb-btn-box">
						<a href="javascript:void(0);" onclick="go_page('1');" class="gnb-btn">국내여행자보험</a>
					</div>
					<div class="gnb-btn-box">
						<a href="javascript:void(0);" onclick="go_page('3');" class="gnb-btn">장기체류(유학,주재원) 여행자 보험</a>
					</div>
					<!--div class="gnb-btn-box">
						<a href="#none" class="gnb-btn type-logout">종료</a>

					</div-->

				</div>
			</nav>

		</div>

	</header>

<!-- /******** Sub Visual Area*/ -->
	<div class="sub_visual2_wrap">
		<h2>24시간 SOS 서비스</h2>
		<p>해외여행자 보험 가입자의 안전을 위해 24시간 의료지원 서비스를 운영합니다.</p>
	</div>
<!-- /* Sub Visual Area **************/ -->

<!-- /******** Contents Area*/ -->
	<div class="cont_sub">
		<h2 class="title">
			<span><strong>해외여행자 보험 가입자</strong>의 안전에 </span>
			<span>더욱 만전을 기하기 위하여 세계 각지에 </span>
			<span>의료서비스를 갖춘 비행기<br></span>
			<span>헬리콥터 및 긴급 수송차량 등이 연중무휴</span>
			<span>상시(24시간)대기하고 있는 의료지원<br></span>
			<span>서비스를 세계 어느 곳에서나 받을 수 있습니다.</span>
		</h2>
		<div class="row1">

			<div class="col_2">
				<span class="number">01</span>
				<p>
					연중무휴<br>24시간<br>의료지원서비스<br>
					<em>24Hours SOS service</em>
				</p>
			</div>
			<div class="col_2 ty2">
				<div class="call_box">
					82-2-3449-3500 <span>(한국어 가능)</span>
				</div>
				<ul class="clearfix">
					<li>01 의사 및 병원 소개 서비스</li>
					<li>가장 적정하고 가까운 병원 및 의사를 필요로 할 때 전화를 통하여 무료로 병원 및 의사를 소개받을 수 있습니다.</li>

					<li>02 긴급의료이송 서비스</li>
					<li>만약 의료시설이 빈약한 지역이라면 보다 나은 시설을 갖춘 인근지역으로 의료진의 보호 및 최상의 여건하에 치료를 받을 수 있도록 조치합니다.</li>

					<li>03 귀국후송 서비스</li>
					<li>의사가 환자의 안정 후에도 환자의 거주지에서 계속적인 치료가 필요하다고 결정하면 거주지까지 환자를 의료진의 보호아래 모든 교통수단을 이용하여 안전하게 후송합니다.</li>

					<li>04 유해본국송환 서비스</li>
					<li>해외에서 사망 시 유해 송환에 따른 모든 절차를 도와 유해를 본국까지 송환합니다.</li>

					<li>미국 및 캐나다 지원센터</li>
					<li>
						<p>미주지역(미국, 캐나다, 괌, 하와이) 보험금 현지 심사 및 지급 서비스 제공</p></p>
						<p>전화 : 1-800-262-8028 (무료, 영어로 제공) / 302-476-6131</p>
						<p>팩스 : 302-476-6154</p>
						<p>주소 : Wilmington DE 19850, PO Box 15417, USA</p>
					</li>
				</ul>
			</div>

		</div>
		<div class="row2">

			<div class="col_2">
				<span class="number">02</span>
				<p>
					혜택<br>
					<em>Benefit</em>
				</p>
			</div>
			<div class="col_2 ty1">
				<ul>
					<li>연중 무휴 상시대기</li>
					<li>의료서비스를 갖춘 헬리콥터, 비행기 및 긴급 수송차량 제공</li>
				</ul>
			</div>

		</div>

		<div class="row1">

			<div class="col_2">
				<span class="number">03</span>
				<p>
					적용범위<br>
					<em>Scope of application</em>
				</p>
			</div>
			<div class="col_2 ty1">
				<ul>
					<li>의사 및 병원 소개 서비스</li>
					<li>긴급의료이송 서비스</li>
					<li>귀국후송 서비스</li>
					<li>유해본국송환 서비스</li>
				</ul>
			</div>

		</div>
	</div>
<!-- /* Contents Area **************/ -->



	<footer>

<div id="layerPop20" class="layerPop" style="display: none;">
	<div class="layerPop_inner">
		<div class="pop_wrap">
			<div class="pop_wrap_in " style="max-width:700px;">
				<div class="pop_head">
					<p class="title" id="yak_tit2"></p>
					<p class="x_btn" onclick="CloselayerPop();"><img src="../img/common/close3.png" alt="닫기"></p>
				</div>
				<div id="yak_area2" class="pop_body ">					
				</div>

			</div>
		</div>
	</div>
</div>

		<div class="top-footer">
			<div class="inner wrap">

				<div class="menu-list">
					<a href="http://bis.co.kr/company/greeting.php" target="_blank">회사소개</a>
					<a href="http://www.bis.co.kr" target="_blank">BIS 기업홈페이지</a>
				</div>

				<div class="menu-list">
					<a href="javascript:void(0)" onclick="f_pop2('../include/clause1.php', '이용약관');">이용약관</a>
					<a href="javascript:void(0)" onclick="f_pop2('../include/clause4.php', '개인정보 수집 및 이용');">개인정보취급방침</a>
					<span class="mobile-enter">
						<a href="../doc/overseas.pdf" target="_blank">해외여행보험약관</a>
						<a href="../doc/domestic.pdf" target="_blank">국내여행보험약관</a>
					</span>

				</div>

			</div>
		</div>

		<div class="bottom-footer">

			<div class="inner wrap relative">

				<a href="#none" class="footer-logo"></a>
				<div class="txt-box">
					대표자: 김정훈 사업자등록번호 :  118-88-00158  고객센터 : 1800-9010<br/>
					주소 서울특별시 중구 광희동2가 266 성우빌딩 10<br/>
					<div class="copyright">
						COPYRIGHT ⓒ TOURSAFE Co., Ltd. ALL RIGHTS RESERVED
					</div>

				</div>

			</div>
		</div>
	</footer>

</div>
<script src="../js1/jquery-3.1.1.min.js"></script>
<script src="../js1/jquery-ui-1.12.1.js"></script>
<script src="../js1/ui.js"></script>
<script src="../js1/swiper.min.js"></script>


<script>
	$('header .mobile-menu').on('click',function (){
		if($('header').hasClass('menu')){
			$('header').removeClass('menu');
		}else{
			$('header').addClass('menu');
		}
	})

	$('.main__visual .menu-group a').mouseenter(function () {
		var _idx = $(this).parent().index();
		$('.bg-group .bg-box').removeClass('on');
		$('.bg-group .bg-box').eq(_idx).addClass('on');
	}).mouseleave(function () {
	});
	$(function () {
		$(window).on('scroll', function () {
			var _current = $(document).scrollTop();
			var _header = $('header');
			if (_current > 30) {
				_header.addClass('fixed');
			} else {
				_header.removeClass('fixed');
			}
		});
	})
</script>



<!--레이어 스타트-->
<script>
	$(document).ready(function(){
		$("#popup_open3").click(function(){
			$("#popup_wrap3").css("display", "block");
			$("#mask").css("display", "block");
		});
	});
</script>

<script> 
$(document).ready(function(){ 
	$("#popup_close3").click(function(){ 
		$("#popup_wrap3").css("display", "none"); 
		$("#mask").css("display", "none"); 
	});

}); 
</script>

<style>
	#popup_wrap, #popup_wrap2 {width:500px; height:350px;  position:fixed;  top:calc(50% - 175px); left:calc(50% - 250px);  z-index:9999; display:none; text-align: center;}
	#popup_wrap1, #popup_wrap3 {width:500px; height:550px;  position:fixed; top:calc(50% - 275px); right:calc(50% - 250px);  z-index:9999; display:none; text-align: center;}
	#mask {width:100%; height:100%; position:fixed; background:rgba(0,0,0,0.7) repeat; top:0; left:0; z-index:999; display:none;}
	#popup-cont001 {width:100%; margin: 0px auto; text-align: center; color: #7930d1; font-size: 12px; box-shadow:0px 0px 10px 0px rgba(0, 0, 0, .5); position: relative; }
	#popup-cont001 .button_warp {position:absolute; bottom: 60px; left: 50px;}
	#popup-cont001 .button_warp li{float:left; margin-left: 10px;}
	#popup-cont001 .button_warp li:first-child {margin-left:0px;}
	#popup-cont001 a, #popup-cont001 a:hover{cursor: pointer;}


	#popup_wrap1 #popup-cont001,
	#popup_wrap3 #popup-cont001 { width: 100%; text-align: right; position: relative; }
	#popup-cont001 .button_warp1 { width:100%; }
	#popup-cont001 .button_warp1 li a.btn_white { padding: 0 0; text-align:center; }
	#popup-cont001 .button_warp1 li {display: flex; }
	#popup-cont001 .button_warp1 li:nth-child(1) {position:absolute; top: 162px; right:30px}
	#popup-cont001 .button_warp1 li:nth-child(1) a.btn_white { width: 180px; }
	#popup-cont001 .button_warp1 li:nth-child(2) {position:absolute; top: 250px; right:30px; }
	#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width: 130px; }
	#popup-cont001 .button_warp1 li:nth-child(3) {position:absolute; top: 340px; right:30px; }
	#popup-cont001 .button_warp1 li:nth-child(3) a.btn_white { margin-right:2%; width:270px; }
	#popup-cont001 .button_warp1 li:nth-child(3) a.btn_white:first-child { width:130px; }
	#popup-cont001 .button_warp1 li:nth-child(4) {position:absolute; top: 460px; right:30px; }
	#popup-cont001 .button_warp1 li:nth-child(4) a.btn_white { width: 180px; }
	#popup-cont001 .button_warp1 li a.btn_white:hover { color: #0ab3c6;}

	#popup-cont001 .button_warp2 {position:absolute; top: 260px; left: 50px;}
	#popup-cont001 .button_warp2 li{float:left; width:130px; margin-left: 10px;}
	#popup-cont001 .button_warp2 li:first-child {margin-left:0px;  width:140px}

	.btn_white{border:2px  solid #fff;  height:32px; line-height:28px; font-size:14px; font-weight:500;  color:#fff; cursor: pointer; padding:0 20px; }
	.btn_white:hover { background-color:#fff; color: #7930d1; font-weight:bold; cursor: pointer;}
	.btn_white:active { position:relative; top:1px;cursor: pointer; }

	#toggle  { position:absolute;  top:0px; right:0px;}
	@media all and (min-width:320px) and (max-width:1023px) { 
		#popup_wrap, #popup_wrap1, #popup_wrap3 {width:90%; height:auto;  position:fixed;  top:28%; left: 5%; right:5%;  z-index:9999; display:none; text-align: center;}
		#popup_wrap2 {width:90%; height:480px;  position:fixed;  top:30%; left: 5%; right:5%;  z-index:9999; display:none; text-align: center;}
		#popup-cont001 img {width:100%;}
		#popup-cont001 .button_warp { bottom: 20px; left: 10%; width: 90%; }
		
		#popup-cont001 .button_warp1 { bottom: 220px; left: 5%; width: 95%; }
		/* #popup-cont001 .button_warp1 li{ margin-left: 5px; width: 55%; } */
		#popup-cont001 .button_warp1 li:nth-child(1) { margin-left:0px; width: 35%; top: 82px; right: 5%; }
		#popup-cont001 .button_warp1 li:nth-child(2) { position: absolute; top: 130px; right: 5%; }
		#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width:80px }
		#popup-cont001 .button_warp1 li:nth-child(3) { position: absolute; top: 180px; right: 5%; /* width: 91%; */ }
		#popup-cont001 .button_warp1 li:nth-child(3) a.btn_white:first-child { width: 90px; margin-right: 2%; }
		#popup-cont001 .button_warp1 li:nth-child(3) a.btn_white { width: 60%; }
		#popup-cont001 .button_warp1 li:nth-child(4) { position: absolute; top: 248px; right: 5%; }
		#popup-cont001 .button_warp1 li:nth-child(4) a.btn_white { width: 130px; }
		#popup-cont001 .button_warp1 li a { font-size:.75em; font-weight:400; }
		
		#popup-cont001 .button_warp2 {position:absolute; top: 150px; left: 28px;}
		#popup-cont001 .button_warp2 li { width: 110px; }
		#popup-cont001 .button_warp2 li:first-child { width: 110px; }
		#popup-cont001 .button_warp2 .btn_white { font-size: 12px; }

	}
	@media all and (min-width:320px) and (max-width:359px) { 
	}
	@media all and (min-width:360px) and (max-width:374px) { 
		#popup-cont001 .button_warp { bottom: 20px; left: 10%; width: 90%; }
		#popup-cont001 .button_warp li{ margin-left: 5px; }
		#popup-cont001 .button_warp li:nth-child(3) {width:140px; margin:5px 0;}

		#popup-cont001 .button_warp1 li:nth-child(1) { top: 94px; }
		#popup-cont001 .button_warp1 li:nth-child(2) { top: 153px; }
		#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width: 90px; }
		#popup-cont001 .button_warp1 li:nth-child(3) { top: 208px; }
		#popup-cont001 .button_warp1 li:nth-child(4) { top: 283px; }
	}
	@media all and (min-width:375px) and (max-width:409px) { 		
		#popup-cont001 .button_warp { bottom: 20px; left: 10%; width: 90%; }
		#popup-cont001 .button_warp li{ margin-left: 5px; }
		#popup-cont001 .button_warp li:nth-child(3) {width: 140px; margin:5px 0;}
		
		#popup-cont001 .button_warp1 li:nth-child(1) { top: 100px; }
		#popup-cont001 .button_warp1 li:nth-child(2) { top: 160px; }
		#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width: 90px; }
		#popup-cont001 .button_warp1 li:nth-child(3) { top: 221px; }
		#popup-cont001 .button_warp1 li:nth-child(4) { top: 294px; }
	}
	@media all and (min-width:410px) and (max-width:500px) { 	
		#popup-cont001 .button_warp { bottom: 20px; left: 10%; width: 90%; }
		#popup-cont001 .button_warp li{ margin-left: 5px; }
		#popup-cont001 .button_warp li:nth-child(3) {width: 140px; margin:5px 0;}
		
		#popup-cont001 .button_warp1 li:nth-child(1) { top: 113px; }
		#popup-cont001 .button_warp1 li:nth-child(2) { top: 179px; }
		#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width: 90px; }
		#popup-cont001 .button_warp1 li:nth-child(3) { top: 244px; }
		#popup-cont001 .button_warp1 li:nth-child(4) { top: 328px; }

	}
	@media all and (min-width:768px) and (max-width:1023px) { 
		#popup-cont001 .button_warp { bottom: 80px; left: 10%; width: 90%; }
		#popup-cont001 .button_warp li { width: 200px; margin-left: 5px;}
		#popup-cont001 .button_warp li:first-child {margin-left:0px; width:200px;}
		#popup-cont001 .button_warp li:nth-child(3) {width:160px; }
		.btn_white { height: 52px; line-height: 48px; font-size: 22px; }
		
		#popup_wrap, #popup_wrap1, #popup_wrap3 { top: 14%; }
		#popup-cont001 .button_warp1 li a.btn_white { font-size: 1.55em; }
		#popup-cont001 .button_warp1 li:nth-child(1) { top: 29%; }
		#popup-cont001 .button_warp1 li:nth-child(1) a.btn_white { width: 100%; }
		#popup-cont001 .button_warp1 li:nth-child(2) { top: 45%; }
		#popup-cont001 .button_warp1 li:nth-child(2) a.btn_white { width: 90px; }
		#popup-cont001 .button_warp1 li:nth-child(3) { top: 64%; }
		#popup-cont001 .button_warp1 li:nth-child(4) { top: 81%; }
	}
</style>
<!-- /* 아시아 입국용 gnb click -->
<div id="popup_wrap3">
	<div id="popup-cont001">
		<img src="../img1/popup/popUp_Asia_22.0503.png">
		<div class="button_warp1">
			<ul>
				<li><a class="btn_white" onclick="go_page('6');">인도네시아</a></li>
				<li><a class="btn_white" onclick="go_page('10');">필리핀</a></li>

				<li>
					<a class="btn_white" onclick="go_page('8');">베트남</a>
				</li>

				<!--li><a class="btn_white" onclick="go_page('11');">말레이시아</a></li-->
			</ul>
		</div>
		<div id="toggle"><a id="popup_close3"><img src="../img1/popup/close_btn_white.png"></a></div>
	</div>
</div>
<!-- 아시아 입국용 gnb click */ -->
</body>
</html>