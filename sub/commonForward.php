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
<? echo "<!--";
echo $_SERVER['PHP_SELF'] ;
echo "-->";
?>

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

	<!-- /** 21.12.21 추가작업 -->
	<link type="text/css" rel="stylesheet" href="common/css/layout_211221.css"/>
	<link type="text/css" rel="stylesheet" href="common/css/button.css"/>
	<link type="text/css" rel="stylesheet" href="common/css/mobile.css"/>
	<!-- 21.12.21 추가작업 **/ -->

	<!--link type="text/css" rel="stylesheet" href="../css1/sub_com.css"/-->
	<link type="text/css" rel="stylesheet" href="../css1/ui.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/swiper.min.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/responsive.css"/>
	<style>
		a {cursor: pointer;}
		.container { min-height: 800px; padding-bottom: 226px; }
		header:after { opacity: 0.55; }
		header.fixed:after { box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, .25); }
		#tabMenu-wrap li:first-child { height:60px; }

		@media (max-width: 1080px) {
			.container {
				padding-bottom: 60px;
			}
			header .wrap {
				height: 50px;
			}
		}
	</style>
	<script type="text/javascript">
		$(document).ready( function() {
			$('.subMenu').smint({
				'scrollSpeed' : 1000
			});
		});
	</script>
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

	<!-- /******** Visual Area */ -->
	<div class="Visual-wrap">
		<h2>해외여행자보험</h2>
		<h3>사고 질병 도난 걱정은 투어세이프에 맡기고, 당신은 여행만 즐기세요.</h3>
		<img src="images/sub_images_overseas_traveler.png">
	</div>
	<!-- /* Visual Area **************/ -->

	<!-- /******** Contents Menu Area */ -->
	<div id="tabMenu-wrap">
		<ul>
			<li><span>해외여행자보험</span></li>
			<li>
				<a href="#top"><span class="icon1"></span>보장내용</a>
			</li>
			<li>
				<a href="#join_example"><span class="icon2"></span>가입 예시</a>
			</li>
			<li>
				<a href="#know"><span class="icon3"></span>알아두실 사항</a>
			</li>
			<li>
<?/*				
				<a id="popup_open"><span class="icon4"></span>보험료 계산/가입</a>
*/?>				
				<a onclick="go_page('2');" class="subNavBtn extLink end" ><span class="icon4"></span>보험료 계산/가입</a>
			</li>
		</ul>
	</div>
	<!-- /* Contents Menu Area **************/ -->

	
    <section>
        <div class="inner">
			<h2>보장내용</h2>
			<h3 class="first">기본계약</h3>
			<p class="explanation">
				기준 : BASIC+_H 플랜
			</p>

			<table class="table-basic">
				<thead>
					<tr>
						<th>담보</th>
						<th>보장내용</th>
						<th>보험가입금액</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>해외여행중 상해사망</td>
						<td>해외여행 중에 상해의 직접결과로써 사망한 경우 보험가입금액 전액 지급</td>
						<td>2.5억원</td>
					</tr>
					<tr>
						<td>해외여행중 상해후유장해</td>
						<td>해외여행 중 상해로 장해분류표에서 정한 각 장해지급률에 해당하는 장해상태가 되었을 때 보험가입금액x장해지급률로 산출한 금액 지급<br>(장애 정도에 따라 보험가입금액의 3%~100% 지급)</td>
						<td>2.5억원</td>
					</tr>
				</tbody>
			</table>


			<h3>선택특약</h3>
			<p class="explanation">
				기준 : BASIC+_H 플랜
			</p>
			
			<table class="table-basic">
				<thead>
					<tr>
						<th>보장명(담보명)</th>
						<th>보장내용</th>
						<th>보험가입금액</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>해외의료비 (상해_해외여행실손_기본)</td>
						<td>
							해외여행 중에 상해를 입고, 이로 인해 해외의료기관에서 의사(치료받는 국가의 법에서 정한 병원 및 의사의 자격을 가진 자에 한함)의 치료를 받은 때에는 보험가입금액을 한도로 피보험자가 실제 부담한 의료비 전액(단, 척추지압술, 침술의 경우 사고당 U$1,000 한도)을 보상(치료를 받던중 보험기간 만료시 종료일부터 180일 한도)
						</td>
						<td>5,000만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해 급여_입원_해외여행실손_기본)</td>
						<td>
							해외여행 중에 상해를 입고 이로 인해 국내 의료기관에 입원하여급여 치료를 받은 경우 국민건강보험법에서 정한 요양급여 또는 의료급여법에서 정한 의료급여 중 본인부담금(본인이 실제로 부담한 금액)의80％(다만, 20％ 해당액이 계약일 또는매년 계약해당일부터 연간 200만원을 초과하는 경우 그 초과금액은 보상)를 보험가입금액을 한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여 입원 보험가입금액을 한도로 하며, 입원 치료중 보험기간 종료시 계속중인 입원에 대해 종료일 다음날부터180일까지 보상)
						</td>
						<td>3,000만원</td>
					</tr>
					<tr>
						<td>국내의료비 (상해 급여_통원_해외여행실손_기본)</td>
						<td>
							해외여행 중에 상해를 입고 이로 인해 국내 의료기관에 통원하여급여 치료를 받거나 급여 처방조제를 받은 경우, 통원 1회당(외래 및 처방조제 합산) 국민건강보험법에서 정한 요양급여 또는의료급여법에서 정한 의료급여 중 본인부담금(본인이 실제로 부담한 금액)에서 보건소, 병원, 의원급에서의외래 및 그에 따른 약국에서의 처방조제에 대해 1만원과 보장대상의료비의 20％중 큰 금액, 전문요양기관,상급종합병원, 종합병원에서의 외래 및 그에 따른 약국에서의 처방조제에 대해 2만원과 보장대상의료비의 20％중 큰 금액을 차감한 후 보험가입금액을한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을합산하여 입원 보험가입금액을 한도로 하며, 통원 치료중 보험기간 종료시 계속중인 통원에 대해 종료일다음날부터 180일 이내의 통원 90회까지 보상)
						</td>
						<td>15만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해 비급여_입원_해외여행실손_특약)</td>
						<td>
							해외여행 중에 상해를 입고 이로 인해 국내 의료기관에 입원하여비급여 치료를 받은 경우 국민건강보험법 또는 의료급여법에 따른 비급여의료비(단, 3대비급여 제외)로 본인이 실제로 부담한 금액의 70％(단, 상급병실료차액의경우 1일 평균금액 10만원을 한도로 비급여 병실료의 50%, 1일 평균금액은 입원기간 동안 비급여 병실료 전체를 총 입원일수로 나누어 산출)를 보험가입금액을 한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여 입원 보험가입금액을한도로 하며, 입원 치료중 보험기간 종료시 계속중인 입원에 대해 종료일 다음날부터 180일까지 보상)
						</td>
						<td>3,000만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해 비급여_통원_해외여행실손_특약)</td>
						<td>
							해외여행 중에 상해를 입고 이로 인해 국내 의료기관에 통원하여비급여 치료를 받거나 비급여 처방조제를 받은 경우, 통원 1회당(외래 및 처방조제 합산) 국민건강보험법 또는 의료급여법에 따른비급여의료비(단, 3대 비급여 및 상급병실료차액 제외)로 본인이 실제로 부담한 금액에서 보건소, 병원 등 의료기관에서의외래 및 그에 따른 약국에서의 처방조제에 대해 3만원과 보장대상의료비의 30％중 큰 금액을 차감한 후 보험가입금액을 한도로 연간 통원 100회까지보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여입원 보험가입금액을 한도로 하며, 통원 치료중 보험기간 종료시 계속중인 통원에 대해 종료일 다음날부터 180일 이내의 통원 90회까지 보상)
						</td>
						<td>15만원</td>
					</tr>
					<tr>
						<td>해외의료비(질병_해외여행실손_기본)</td>
						<td>
							해외여행 중에 질병으로 인하여 해외의료기관에서 의사(치료받는 국가의 법에서 정한 병원 및 의사의 자격을 가진 자에 한함)의치료를 받은 때에는 보험가입금액을 한도로 피보험자가 실제 부담한 의료비 전액(단, 척추지압술, 침술의 경우 질병당 U$1,000 한도)을 보상(치료를받던중 보험기간 만료시 종료일부터 180일 한도)
						</td>
						<td>5,000만원</td>
					</tr>
					<tr>
						<td>국내의료비(질병 급여_입원_해외여행실손_기본)</td>
						<td>
							해외여행 중에 질병으로 인하여 국내 의료기관에 입원하여 급여치료를 받은 경우 국민건강보험법에서 정한 요양급여 또는 의료급여법에서 정한 의료급여 중 본인부담금(본인이 실제로 부담한 금액)의80％(다만, 20％ 해당액이 계약일 또는매년 계약해당일부터 연간 200만원을 초과하는 경우 그 초과금액은 보상)를 보험가입금액을 한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여 입원 보험가입금액을 한도로 하며, 입원 치료중 보험기간 종료시 계속중인 입원에 대해 종료일 다음날부터180일까지 보상)
						</td>
						<td>5,000만원</td>
					</tr>
					<tr>
						<td>국내의료비(질병 급여_통원_해외여행실손_기본)</td>
						<td>
							해외여행 중에 질병으로 인하여 국내 의료기관에 통원하여 급여치료를 받거나 급여 처방조제를 받은 경우, 통원 1회당(외래 및 처방조제 합산) 국민건강보험법에서 정한 요양급여 또는의료급여법에서 정한 의료급여 중 본인부담금(본인이 실제로 부담한 금액)에서 보건소, 병원, 의원급에서의외래 및 그에 따른 약국에서의 처방조제에 대해 1만원과 보장대상의료비의 20％중 큰 금액, 전문요양기관,상급종합병원, 종합병원에서의 외래 및 그에 따른 약국에서의 처방조제에 대해 2만원과 보장대상의료비의 20％중 큰 금액을 차감한 후 보험가입금액을한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을합산하여 입원 보험가입금액을 한도로 하며, 통원 치료중 보험기간 종료시 계속중인 통원에 대해 종료일다음날부터 180일 이내의 통원 90회까지 보상)
						</td>
						<td>20만원</td>
					</tr>
					<tr>
						<td>국내의료비(질병 비급여_입원_해외여행실손_특약)</td>
						<td>
							해외여행 중에 질병으로 인하여 국내 의료기관에 입원하여 비급여치료를 받은 경우 국민건강보험법 또는 의료급여법에 따른 비급여의료비(단, 3대비급여 제외)로 본인이 실제로 부담한 금액의 70％(단, 상급병실료차액의경우 1일 평균금액 10만원을 한도로 비급여 병실료의 50%, 1일 평균금액은 입원기간 동안 비급여 병실료 전체를 총 입원일수로 나누어 산출)를 보험가입금액을 한도로 보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여 입원 보험가입금액을한도로 하며, 입원 치료중 보험기간 종료시 계속중인 입원에 대해 종료일 다음날부터 180일까지 보상)
						</td>
						<td>5,000만원</td>
					</tr>
					<tr>
						<td>국내의료비(질병 비급여_통원_해외여행실손_특약)</td>
						<td>
							해외여행 중에 질병으로 인하여 국내 의료기관에 통원하여 비급여치료를 받거나 비급여 처방조제를 받은 경우, 통원 1회당(외래 및 처방조제 합산) 국민건강보험법 또는 의료급여법에 따른비급여의료비(단, 3대 비급여 및 상급병실료차액 제외)로 본인이 실제로 부담한 금액에서 보건소, 병원 등 의료기관에서의외래 및 그에 따른 약국에서의 처방조제에 대해 3만원과 보장대상의료비의 30％중 큰 금액을 차감한 후 보험가입금액을 한도로 연간 통원 100회까지보상(다만, 연간 보상한도는 입원과 통원 보상금액을 합산하여입원 보험가입금액을 한도로 하며, 통원 치료중 보험기간 종료시 계속중인 통원에 대해 종료일 다음날부터 180일 이내의 통원 90회까지 보상)
						</td>
						<td>20만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병 3대비급여 _도수,체외충격파,증식치료_해외여행실손_특약)</td>
						<td>
							해외여행 중에 상해 또는 질병의 치료목적으로 국내 의료기관에입원 또는 통원하여 비급여「도수치료·체외충격파치료·증식치료」를받은 경우 본인이 실제로 부담한 비급여 의료비(행위료, 약제비, 치료재료대 포함)에서 공제금액(1회당 3만원과 보장대상의료비의 30％ 중 큰 금액)을 뺀 금액을 계약일부터 1년 단위로 350만원 이내에서 도수치료·증식치료의 각 치료횟수를 합산하여 최초 10회 보장하고, 이후 객관적이고 일반적으로 인정되는 검사결과 등을 토대로 증상의 개선, 병변호전등이 확인된 경우에 한하여 10회 단위로 연간 50회까지보상
						</td>
						<td>350만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병 3대비급여_주사치료_해외여행실손_특약)</td>
						<td>
							해외여행 중에 상해 또는 질병의 치료목적으로 국내 의료기관에입원 또는 통원하여 주사치료를 받아 본인이 실제로 부담한 비급여 주사료에서 공제금액(1회당 3만원과 보장대상의료비의 30％중 큰 금액)을 뺀 금액을 보상한도(계약일부터 1년 단위로 각 상해·질병 치료행위를 합산하여 250만원 이내에서 50회까지)내에서보상
						</td>
						<td>250만원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병 3대비급여_자기공명영상진단_해외여행실손_특약)</td>
						<td>
							해외여행 중에 상해 또는 질병의 치료목적으로 국내 의료기관에입원 또는 통원하여 자기공명영상진단(MRI, MRA)을 받아 본인이 실제로 부담한 비급여 의료비(조영제, 판독료 포함)에서공제금액(1회당 3만원과 보장대상의료비의 30％ 중 큰 금액)을 뺀 금액을 보상한도(계약일부터 1년 단위로 각 상해·질병치료행위를 합산하여 연간 300만원 한도)내에서 보상
						</td>
						<td>300만원</td>
					</tr>
					<tr>
						<td>해외여행중 질병사망 및 질병 80%이상 후유장해</td>
						<td>
							해외여행 도중에 질병으로 보험기간 중 또는 보험기간종료후 30일 이내에 사망하거나 장해지급률이 80％이상에 해당하는 장해상태가 되었을 때 가입금액 전액 보상
						</td>
						<td>1,000만원</td>
					</tr>
					<tr>
						<td>해외여행중 배상책임(자기부담금 1만원)</td>
						<td>
							해외여행도중에 생긴 우연한 사고로 타인의 신체의 장해 또는 재물의 손해에 대한 법률상의 배상책임을 부담함으로써 입은 손해를 보상(자기부담금1만원),단 친족간 사고, 호텔이나 객실내의 동산을 제외한 피보험자가 소유, 사용 또는 관리하는 재물배상, 차량(원동력이 인력에 의한 것을 제외) 및 카트사고 등은 제외됩니다. (기타 약관참조)
						</td>
						<td>2,000만원</td>
					</tr>
					<tr>
						<td>해외여행중 휴대품손해(분실제외, 자기부담금1만원, 보상한도 개당20만원(단, 이동통신단말기10만원))</td>
						<td>
							해외여행도중에 생긴 우연한 사고에 의하여 보험의 목적(여행도중에 휴대하는 피보험자 소유,사용,관리의 휴대품)에 입은 손해를 보상함.(1회의 사고에 대하여 자기부담금 1만원을 공제한 금액으로 하며, 보험의 목적의 1개 또는 1조, 1쌍의 지급 보험금은 20만원(단, 이동통신단말기(공단말기 포함)에 대해서는 10만원을 한도로 함)을 한도로 함. 단 통화, 신용카드, 항공권, 의치, 의수족, 콘택트렌즈 등은 제외하며 보험의 목적인 액체의 유출로 인한 사고 등은 제외됩니다.(기타 약관참조)
						</td>
						<td>20만원</td>
					</tr>
					<tr>
						<td>해외여행중 중대사고 구조송환비용</td>
						<td>
							해외여행도중에 피보험자가 탑승한 항공기, 선박의 행방불명, 조난 또는 피보험자가 사망하거나 14일 이상 입원할 경우 피보험자 또는 피보험자의 법정상속인이 부담하는 비용인 수색구조비용, 항공운임 등 교통비 (2명한도), 숙박비 (1명당 14박 한도), 이송비용, 제잡비를 약관에서 정한 바에 따라 보상
						</td>
						<td>3,000만원</td>
					</tr>
					<tr>
						<td>해외여행중 여권분실후 재발급비용</td>
						<td>
							피보험자가 해외여행 도중에 여권을 분실하거나 도난당하여 재외공간에 여권분실신고를 하고 여행증명서를 발급받은 경우, 여행증명서 발급비용과 여권재발급 비용을 보험수익자에게 지급
						</td>
						<td>6만7천원</td>
					</tr>
					<tr>
						<td>해외여행중 중단사고발생 추가비용</td>
						<td>
							피보험자가 해외여행 도중에 아래의 여행중단 사유 발생 이전에 귀국항공 또는 선박 운임비용 및 숙박비용을 미리 지급한 경우에 한하여 여행중단 사유 발생으로 여행을 중단하고 일정을 변경하여 귀국함으로서 미리 지급한 운임비용(항공 또는 선박) 및 숙박비용을 초과하여 피보험자에게 추가로 발생하는 운임비용(항공 또는 선박) 및 2박 이내의 숙박비용을 보험가입금액을 한도로 보상함<br>
							＜여행중단 사유＞<br>
							1. 피보험자 및 여행동반 가족이 상해 또는 질병으로 3일 이상 입원한 경우<br>
							2. 피보험자의 3촌 이내의 친족 또는 여행동반자의 사망<br>
							3. 지진, 분화, 해일, 태풍, 홍수 또는 이와 비슷한 천재지변, 전쟁, 외국의 무력행사, 혁명, 내란, 사변, 테러, 기타 이들과 유사한 사태
						</td>
						<td>100만원</td>
					</tr>
					<tr>
						<td>항공기 및 수화물 지연에 따른 추가비용</td>
						<td>
							아래의 보험사고로 인하여 피보험자가 추가로 지출한 비용(아래 가. 나.의 경우 식사비, 숙박이 필요한 경우 숙박비, 다. 라.의 경우 비상의복과 생활필수품 구입비, 기타 약관 참조)에 대하여 1사고당 보험가입금액을 한도로 약관에 따라 보상(유료승객으로서 정기항공편을 이용한 경우에만 적용)<br>
							가. 연결항공편이 결항되어 실제 도착시간의 4시간 내에 피보험자에게 대체적인 항공운송수단이 제공되지 못할 경우<br>
							나. 항공편이 4시간이상 지연, 취소되거나 또는 피보험자가 과적에 의해 탑승이 거부되어 예정시간으로부터 4시간 내에 대체적인 수단이 제공되지 못하는 경우<br>
							다. 피보험자의 수화물이 항공편의 예정된 도착시간으로부터 6시간 이내에 도착하지 못하는 경우<br>
							라. 피보험자의 수화물이 손실되거나 또는 피보험자가 목적지에 도착한 후 24시간 내에 등록된 수화물이 피보험자에게 도착하지 못하는 경우
						</td>
						<td>50만원</td>
					</tr>
					<tr>
						<td>해외여행중 식중독 입원일당 (4일이상 120일한도)</td>
						<td>
							해외여행도중의 음식물 섭취로 인해 중독이 발생하고, 그 식중독의 치료를 직접적인 목적으로 4일 이상 입원치료를 받은 경우 3일 초과 1일당 식중독입원일당을 120일 한도로 지급.
						</td>
						<td>2만원</td>
					</tr>
					<tr>
						<td>해외여행중 특정 전염병 치료비</td>
						<td>
							해외여행도중에 특정전염병에 감염되어 특정전염병 환자로 진단받아 치료를 받을 경우 보험가입금액을 지급
						</td>
						<td>20만원</td>
					</tr>
					<tr>
						<td>해외여행중 상해입원일당 (4일이상 30일한도)</td>
						<td>
							피보험자가 해외여행 도중에 상해를 입고 그 직접결과로써 생활기능 또는 업무능력에 지장을 가져와 병원 또는 의원(한방병원 또는 한의원을 포함)에 4일 이상 입원하여 의사의 치료를 받은 경우 3일 초과 입원 1일당 해외여행상해입원일당을 30일을 한도로 지급함
						</td>
						<td>5만원</td>
					</tr>
					<tr>
						<td>해외여행중 질병입원일당 (4일이상 30일한도)</td>
						<td>피보험자가 해외여행 도중에 진단확정된 질병의 치료를 직접적인 목적으로 병원 또는 의원(한방병원 또는 한의원 포함)에 4일 이상 입원하여 의사의 치료를 받은 경우 3일 초과 입원 1일당 해외여행질병입원일당을 30일을 한도로 지급함</td>
						<td>5만원</td>
					</tr>
					<tr>
						<td>해외여행중 항공기납치</td>
						<td>
							해외여행 도중에 피보험자가 탑승한 항공기가 납치됨에따라 예정목적지에 도착할 수 없게 된 동안 매일 70,000원씩 지급(항공기의 목적지 도착예정시간에서 12시간이 지난 이후부터 시작되는 24시간을 1일로 보아 20일을 한도)
						</td>
						<td>140만원</td>
					</tr>
					<tr>
						<td>아파트내 가재 화재손해</td>
						<td>
							보험기간 중에 보험목적(아파트내 가재)이 화재(벼락 포함), 폭발 및 파열로 입은 직접손해, 소방손해 및 피난손해를 아래와 같이 보상.<br>
							1. 보험가입금액이 보험가액의 80％이상일때 : 보험가입금액을 한도로 손해액 전액 (그러나 보험가입금액이 보험가액보다 클 때에는 보험가액 한도)<br>
							2. 보험가입금액이 보험가액의 80％보다 작을 때 : 보험가입금액을 한도로 아래의 금액<br>
							손해액 x [ 보험가입금액 / 보험가액의 80％해당액 ]<br>
							3. 기타 추가비용(약관 참조) : 잔존물제거비용(손해액의 10％한도), 손해방지비용, 대위권 보전비용, 잔존물 보전비용, 기타 협력비용<br>
							※ 보험의 목적인 아파트내 가재는 건물(건물의 부속물, 부착물, 부속설비 포함)이외의 것으로 피보험자 또는 그와 같은 세대에 속하는 사람의 소유물(생활용품, 집기,비품 등)을 말합니다.<br>
							※ 보험목적물 제외 대상 : 통화, 유가증권, 인지, 우표, 귀금속, 귀중품 (휴대할 수 있으며 점당 300만원 이상), 보옥, 보석, 글, 그림, 골동품, 조각물, 원고, 설계서, 도안, 물건의 원본, 모형, 증서, 소프트웨어 등 이외 비슷한 것, 실외 또는 옥외에 쌓아둔 동산 및 자동차(자동2륜차 포함)은 보상하지 않습니다.
						</td>
						<td>5,000만원</td>
					</tr>
					<tr>
						<td>아파트내 가재 도난손해(자기부담금 10만원)</td>
						<td>
							보험기간 중에 보험목적(아파트내 가재)이 보험증권에 기재된 아파트 구내에 보관되어 있는 동안에 강도, 절도(미수 포함)로 생긴 도난, 훼손 또는 망가진 손해(1사고당 10만원 공제)를 아래와 같이 보상<br>
							1. 보험가입금액이 보험가액의 80％이상일때 : 보험가입금액을 한도로 손해액 전액<br>
							2. 보험가입금액이 보험가액의 80％보다 작을 때 : 보험가입금액을 한도로 아래의 금액<br>
							손해액 x [ 보험가입금액 / 보험가액의 80％해당액 ]<br>
							※ 보험의 목적인 아파트내 가재는 건물(건물의 부속물, 부착물, 부속설비 포함)이외의 것으로 피보험자 또는 그와 같은 세대에 속하는 사람의 소유물(생활용품, 집기,비품 등)을 말합니다.<br>
							※ 보험목적물 제외 대상 : 통화, 유가증권, 인지, 우표, 귀금속, 귀중품 (휴대할 수 있으며 점당 300만원 이상), 보옥, 보석, 글, 그림, 골동품, 조각물, 원고, 설계서, 도안, 물건의 원본, 모형, 증서, 소프트웨어 등 이외 비슷한 것 및 자동차는 보상하지 않습니다.
						</td>
						<td>1,000만원</td>
					</tr>
				</tbody>
			</table>

			<ul class="row-highlight">
				<li>
					특정전염병치료비 특약에 해당되는 질병은 제1군전염병(콜레라, 장티푸스, 파라티푸스, 상세불명의 시겔라증,장출혈성대장균감염,페스트), 제2군전염병(파상풍,디프테리아,백일해,급성 회색질척수염,일본뇌염,홍역,풍진(독일홍역),볼거리), 제3군전염병(탄저병,브루셀라병,렙토스피라병,성홍열,수막구균 수막염,기타 그람음성균에 의한 패혈증,재향군인병,비폐렴성 재향군인병[폰티액열],발진티푸스,리케차 티피에 의한 발진티푸스,리케차 쯔쯔가무시에 의한 발진티푸스,광견병,신장(콩팥)증후군을 동반한 출혈열,말라리아) 입니다.
				</li>
			</ul>

			<div class="join-notice">
				※ 가입시 유의사항
				<ul>
					<li>1. 해외여행보험은 상해사망, 후유장해를 기본계약으로 하여 계약자가 필요한 담보를 선택하여 가입할 수 있습니다.</li>
					<li>2. 질병이력이 있는 경우에도 해외여행보험을 가입하실 수 있습니다. (다만, 질병이력과 관련된 담보의 경우에는 가입이 제한될 수 있습니다)</li>
					<li>3. 실손의료보험에 이미 가입하였다면 해외여행보험의 국내치료 보장에 가입할 실익이 낮습니다.</li>
					<li>4. 해외여행 중 배상책임 (자기부담금 1만원) 및 해외여행 중 휴대품손해(분실제외, 자기부담금 1만원, 보상한도 개당20만원(단, 이동통신단말기10만원) 해외여행 실손의료비 특별약관, 해외여행 비급여 의료비 추가 특별약관, 해외여행 중 중대사고 구조송환비용, 해외여행 중 여권분실 후 재발급비용, 해외여행 중 중단사고발생 추가비용, 항공기 및 수화물 지연에 따른 추가비용, 아파트 내  화재손해, 아파트 내 기재 도난 손해 (자기부담금 10만원) 특별약관의 경우 보험금을 지급할 다수계약이 체결되어 있는 경우에는 약관에 따라 실손 비례보상합니다.</li>
				</ul>
			</div>

			<ul class="box-cont">
				<li>주 계약은 상해사망 및 후유 장해이며 그 외에는 기타 특약 입니다.</li>
				<li>천재지변으로 인한 상해 사망, 후유 장해 및 상해 치료비 또한 상해 담보금액과 동일하게 보상됩니다.</li>
				<li>위 담보 항목 중 보험 증권에 가입 금액이 기재된 담보 항목에 한하여 보상하여 드립니다.</li>
				<li>보상 내용에 관한 자세한 사항은 해당 약관을 참조 하시기 바랍니다.</li>
				<li>지급한도 및 면책사항 등에 따라 보험금 지급이 제한될 수 있습니다.</li>
				<li>상해담보의 경우 암벽등반, 스카이다이빙 등 직업, 직무, 동호회 활동 중 발생한 사고는 보상하지 않습니다.</li>
				<li>동 상품은 순수보장형 상품으로 만기환급금이 발생하지 않습니다.</li>
			</ul>

			<div class="terms-area">
				<span>자세한 설명은 아래 약관 및 상품 요약서를 참고하시기 바랍니다.</span>
				<ul class="clearfix">
					<li>
						<p>약관</p>
						<a href="https://www.acedirect.co.kr/jsp/pdf/2020/DirectaOTA_P.pdf" title="Chubb 해외여행보험 약관 pdf 새창열림" target="_blank" class="btn down">Chubb 해외여행보험</a>
					</li>
					<li>
						<p>상품요약서</p>
						<a href="https://www.acedirect.co.kr/jsp/pdf/2020/DirectaOTA_S.pdf" title="Chubb 해외여행보험 상품소개서 pdf 새창열림" target="_blank" class="btn down">상품요약서</a>
					</li>
				</ul>
			</div>

		</div>
    </section>

    <section id="join_example">
        <div class="inner" style="min-height:800px;">
			<h2>가입예시</h2>

			<h3 class="first">가입안내</h3>
			<table class="table-basic1">
				<tbody>
					<tr>
						<th>가입연령</th>
						<td>0세 ~ 70세 (보험연령기준)</td>
					</tr>
					<tr>
						<th>보험유형</th>
						<td>순수보장형</td>
					</tr>
					<tr>
						<th>보험기간</th>
						<td>2일 ~ 최대 3개월</td>
					</tr>
					<tr>
						<th>납입기간</th>
						<td>일시납</td>
					</tr>
					<tr>
						<th>여행목적</th>
						<td>일반 관광 및 연수, 교육, 출장 (운동 경기 참여 및 기타 관련 목적인 경우 가입 불가합니다.)</td>
					</tr>
				</tbody>
			</table>

			<h3>보험료 예시 > 남자</h3>
			<p class="explanation">
				기준 : 3박 4일 해외여행 시 (Basic+_H 플랜), 일시납, 아파트 층수 10층
			</p>
			<table class="table-basic2">
				<thead>
					<tr>
						<th colspan="2" rowspan="2">구분</th>
						<th rowspan="2">가입금액</th>
						<th colspan="3">남자</th>
					</tr>
					<tr>
						<th>30세</th>
						<th>40세</th>
						<th>50세</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>기본</th>
						<td>해외여행중상해사망후유장해</td>
						<td class="txt-R">2.5억원</td>
						<td class="txt-R">5,128원</td>
						<td class="txt-R">5,128원</td>
						<td class="txt-R">5,128원</td>
					</tr>
					<tr>
						<th rowspan="28">선택</th>
						<td>해외의료비(상해_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">1,715원</td>
						<td class="txt-R">2,065원</td>
						<td class="txt-R">2,310원</td>
					</tr>
					<tr>
						<td>국내의료비(상해급여_입원_해외여행실손_기본_S)</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">274원</td>
						<td class="txt-R">254원</td>
						<td class="txt-R">309원</td>
					</tr>
					<tr>
						<td>국내의료비(상해급여_통원_해외여행실손_기본_S)</td>
						<td class="txt-R">15만원</td>
						<td class="txt-R">82원</td>
						<td class="txt-R">73원</td>
						<td class="txt-R">79원</td>
					</tr>
					<tr>
						<td>해외의료비(질병_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">2,485원</td>
						<td class="txt-R">3,850원</td>
						<td class="txt-R">8,365원</td>
					</tr>
					<tr>
						<td>국내의료비(질병급여_입원_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">191원</td>
						<td class="txt-R">281원</td>
						<td class="txt-R">453원</td>
					</tr>
					<tr>
						<td>국내의료비(질병급여_통원_해외여행실손_기본_S)</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">144원</td>
						<td class="txt-R">172원</td>
						<td class="txt-R">238원</td>
					</tr>
					<tr>
						<td>국내의료비(상해비급여_입원_해외여행실손_특약_S)</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">261원</td>
						<td class="txt-R">255원</td>
						<td class="txt-R">280원</td>
					</tr>
					<tr>
						<td>국내의료비(상해비급여_통원_해외여행실손_특약_S)</td>
						<td class="txt-R">15만원</td>
						<td class="txt-R">65원</td>
						<td class="txt-R">57원</td>
						<td class="txt-R">59원</td>
					</tr>
					<tr>
						<td>국내의료비(질병비급여_입원_해외여행실손_특약_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">180원</td>
						<td class="txt-R">248원</td>
						<td class="txt-R">383원</td>
					</tr>
					<tr>
						<td>기본</td>
						<td class="txt-R">기본</td>
						<td class="txt-R">기본</td>
						<td class="txt-R">기본</td>
						<td class="txt-R">기본</td>
					</tr>
					<tr>
						<td>국내의료비(질병비급여_통원_해외여행실손_특약_S)</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">90원</td>
						<td class="txt-R">99원</td>
						<td class="txt-R">116원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_도수,체외충격파,증식치료_해외여행실손_특약_S)</td>
						<td class="txt-R">350만원</td>
						<td class="txt-R">12원</td>
						<td class="txt-R">13원</td>
						<td class="txt-R">16원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_주사치료_해외여행실손_특약_S)</td>
						<td class="txt-R">250만원</td>
						<td class="txt-R">4원</td>
						<td class="txt-R">5원</td>
						<td class="txt-R">7원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_자기공명영상진단_해외여행실손_특약_S)</td>
						<td class="txt-R">300만원</td>
						<td class="txt-R">12원</td>
						<td class="txt-R">14원</td>
						<td class="txt-R">19원</td>
					</tr>
					<tr>
						<td>해외여행중질병사망 및 질병 80％이상후유장해</td>
						<td class="txt-R">1,000만원</td>
						<td class="txt-R">34원</td>
						<td class="txt-R">34원</td>
						<td class="txt-R">34원</td>
					</tr>
					<tr>
						<td>해외여행중배상책임(자기부담금1만원)</td>
						<td class="txt-R">2,000만원</td>
						<td class="txt-R">50원</td>
						<td class="txt-R">50원</td>
						<td class="txt-R">50원</td>
					</tr>
					<tr>
						<td>해외여행중휴대품손해(분실제외,자기부담금1만원,보상한도개당20만원(단,이동통신단말기10만원))</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">751원</td>
						<td class="txt-R">751원</td>
						<td class="txt-R">751원</td>
					</tr>
					<tr>
						<td>해외여행중중대사고 구조송환비용</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">405원</td>
						<td class="txt-R">405원</td>
						<td class="txt-R">405원</td>
					</tr>
					<tr>
						<td>해외여행중항공기납치</td>
						<td class="txt-R">140만원</td>
						<td class="txt-R">22원</td>
						<td class="txt-R">22원</td>
						<td class="txt-R">22원</td>
					</tr>
					<tr>
						<td>해외여행중여권분실후 재발급비용</td>
						<td class="txt-R">6만7천원</td>
						<td class="txt-R">17원</td>
						<td class="txt-R">17원</td>
						<td class="txt-R">17원</td>
					</tr>
					<tr>
						<td>해외여행중중단사고발생 추가비용</td>
						<td class="txt-R">100만원</td>
						<td class="txt-R">367원</td>
						<td class="txt-R">367원</td>
						<td class="txt-R">367원</td>
					</tr>
					<tr>
						<td>항공기및 수화물 지연에 따른 추가비용</td>
						<td class="txt-R">50만원</td>
						<td class="txt-R">1,482원</td>
						<td class="txt-R">1,482원</td>
						<td class="txt-R">1,482원</td>
					</tr>
					<tr>
						<td>해외여행중식중독입원일당(4일이상120일한도)</td>
						<td class="txt-R">2만원</td>
						<td class="txt-R">8원</td>
						<td class="txt-R">7원</td>
						<td class="txt-R">8원</td>
					</tr>
					<tr>
						<td>해외여행중특정전염병치료비</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">10원</td>
						<td class="txt-R">11원</td>
						<td class="txt-R">18원</td>
					</tr>
					<tr>
						<td>해외여행상해입원일당(4일이상30일한도)</td>
						<td class="txt-R">5만원</td>
						<td class="txt-R">998원</td>
						<td class="txt-R">998원</td>
						<td class="txt-R">998원</td>
					</tr>
					<tr>
						<td>해외여행질병입원일당(4일이상30일한도)</td>
						<td class="txt-R">5만원</td>
						<td class="txt-R">219원</td>
						<td class="txt-R">232원</td>
						<td class="txt-R">293원</td>
					</tr>
					<tr>
						<td>아파트내가재 화재손해</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">571원</td>
						<td class="txt-R">571원</td>
						<td class="txt-R">571원</td>
					</tr>
					<tr>
						<td>아파트내가재 도난손해(자기부담금10만원)</td>
						<td class="txt-R">1,000만원</td>
						<td class="txt-R">377원</td>
						<td class="txt-R">377원</td>
						<td class="txt-R">377원</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3" class="txt-C">합계보험료</th>
						<td class="txt-R">15,954원</td>
						<td class="txt-R">17,839원</td>
						<td class="txt-R">23,156원</td>								
					</tr>
				</tfoot>
			</table>

			<h3>보험료 예시 > 여자</h3>
			<p class="explanation">
				기준 : 3박 4일 해외여행 시 (Basic+_H 플랜), 일시납, 아파트 층수 10층
			</p>
			<table class="table-basic2">
				<thead>
					<tr>
						<th colspan="2" rowspan="2">구분</th>
						<th rowspan="2">가입금액</th>
						<th colspan="3">여자</th>
					</tr>
					<tr>
						<th>30세</th>
						<th>40세</th>
						<th>50세</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row" class="txt-C">기본</th>
						<td>해외여행중상해사망후유장해</td>
						<td class="txt-R">2.5억원 </td>
						<td class="txt-R">5,128원</td>
						<td class="txt-R">5,128원</td>
						<td class="txt-R">5,128원</td>
					</tr>
					<tr>
						<th rowspan="27" scope="row" class="txt-C">선택</th>
						<td>해외의료비(상해_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">1,715원</td>
						<td class="txt-R">2,065원</td>
						<td class="txt-R">2,310원</td>
					</tr>
					<tr>
						<td>국내의료비(상해급여_입원_해외여행실손_기본_S)</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">274원</td>
						<td class="txt-R">254원</td>
						<td class="txt-R">309원</td>
					</tr>
					<tr>
						<td>국내의료비(상해급여_통원_해외여행실손_기본_S)</td>
						<td class="txt-R">15만원</td>
						<td class="txt-R">82원</td>
						<td class="txt-R">73원</td>
						<td class="txt-R">79원</td>
					</tr>
					<tr>
						<td>해외의료비(질병_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">2,485원</td>
						<td class="txt-R">3,850원</td>
						<td class="txt-R">8,365원</td>
					</tr>
					<tr>
						<td>국내의료비(질병급여_입원_해외여행실손_기본_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">191원</td>
						<td class="txt-R">281원</td>
						<td class="txt-R">453원</td>
					</tr>
					<tr>
						<td>국내의료비(질병급여_통원_해외여행실손_기본_S)</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">144원</td>
						<td class="txt-R">172원</td>
						<td class="txt-R">238원</td>
					</tr>
					<tr>
						<td>국내의료비(상해비급여_입원_해외여행실손_특약_S)</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">261원</td>
						<td class="txt-R">255원</td>
						<td class="txt-R">280원</td>
					</tr>
					<tr>
						<td>국내의료비(상해비급여_통원_해외여행실손_특약_S)</td>
						<td class="txt-R">15만원</td>
						<td class="txt-R">65원</td>
						<td class="txt-R">57원</td>
						<td class="txt-R">59원</td>
					</tr>
					<tr>
						<td>국내의료비(질병비급여_입원_해외여행실손_특약_S)</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">180원</td>
						<td class="txt-R">248원</td>
						<td class="txt-R">383원</td>
					</tr>
					<tr>
						<td>국내의료비(질병비급여_통원_해외여행실손_특약_S)</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">90원</td>
						<td class="txt-R">99원</td>
						<td class="txt-R">116원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_도수,체외충격파,증식치료_해외여행실손_특약_S)</td>
						<td class="txt-R">350만원</td>
						<td class="txt-R">12원</td>
						<td class="txt-R">13원</td>
						<td class="txt-R">16원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_주사치료_해외여행실손_특약_S)</td>
						<td class="txt-R">250만원</td>
						<td class="txt-R">4원</td>
						<td class="txt-R">5원</td>
						<td class="txt-R">7원</td>
					</tr>
					<tr>
						<td>국내의료비(상해질병3대비급여_자기공명영상진단_해외여행실손_특약_S)</td>
						<td class="txt-R">300만원</td>
						<td class="txt-R">12원</td>
						<td class="txt-R">14원</td>
						<td class="txt-R">19원</td>
					</tr>
					<tr>
						<td>해외여행중질병사망 및 질병 80％이상후유장해</td>
						<td class="txt-R">1,000만원</td>
						<td class="txt-R">34원</td>
						<td class="txt-R">34원</td>
						<td class="txt-R">34원</td>
					</tr>
					<tr>
						<td>해외여행중배상책임(자기부담금1만원)</td>
						<td class="txt-R">2,000만원</td>
						<td class="txt-R">50원</td>
						<td class="txt-R">50원</td>
						<td class="txt-R">50원</td>
					</tr>
					<tr>
						<td>해외여행중휴대품손해(분실제외,자기부담금1만원,보상한도개당20만원(단,이동통신단말기10만원))</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">751원</td>
						<td class="txt-R">751원</td>
						<td class="txt-R">751원</td>
					</tr>
					<tr>
						<td>해외여행중중대사고 구조송환비용</td>
						<td class="txt-R">3,000만원</td>
						<td class="txt-R">405원</td>
						<td class="txt-R">405원</td>
						<td class="txt-R">405원</td>
					</tr>
					<tr>
						<td>해외여행중항공기납치</td>
						<td class="txt-R">140만원</td>
						<td class="txt-R">22원</td>
						<td class="txt-R">22원</td>
						<td class="txt-R">22원</td>
					</tr>
					<tr>
						<td>해외여행중여권분실후 재발급비용</td>
						<td class="txt-R">6만7천원</td>
						<td class="txt-R">17원</td>
						<td class="txt-R">17원</td>
						<td class="txt-R">17원</td>
					</tr>
					<tr>
						<td>해외여행중중단사고발생 추가비용</td>
						<td class="txt-R">100만원</td>
						<td class="txt-R">367원</td>
						<td class="txt-R">367원</td>
						<td class="txt-R">367원</td>
					</tr>
					<tr>
						<td>항공기및 수화물 지연에 따른 추가비용</td>
						<td class="txt-R">50만원</td>
						<td class="txt-R">1,482원</td>
						<td class="txt-R">1,482원</td>
						<td class="txt-R">1,482원</td>
					</tr>
					<tr>
						<td>해외여행중식중독입원일당(4일이상120일한도)</td>
						<td class="txt-R">2만원</td>
						<td class="txt-R">8원</td>
						<td class="txt-R">7원</td>
						<td class="txt-R">8원</td>
					</tr>
					<tr>
						<td>해외여행중특정전염병치료비</td>
						<td class="txt-R">20만원</td>
						<td class="txt-R">10원</td>
						<td class="txt-R">11원</td>
						<td class="txt-R">18원</td>
					</tr>
					<tr>
						<td>해외여행상해입원일당(4일이상30일한도)</td>
						<td class="txt-R">5만원</td>
						<td class="txt-R">998원</td>
						<td class="txt-R">998원</td>
						<td class="txt-R">998원</td>
					</tr>
					<tr>
						<td>해외여행질병입원일당(4일이상30일한도)</td>
						<td class="txt-R">5만원</td>
						<td class="txt-R">219원</td>
						<td class="txt-R">232원</td>
						<td class="txt-R">293원</td>
					</tr>
					<tr>
						<td>아파트내가재 화재손해</td>
						<td class="txt-R">5,000만원</td>
						<td class="txt-R">571원</td>
						<td class="txt-R">571원</td>
						<td class="txt-R">571원</td>
					</tr>
					<tr>
						<td>아파트내가재 도난손해(자기부담금10만원)</td>
						<td class="txt-R">1,000만원</td>
						<td class="txt-R">377원</td>
						<td class="txt-R">377원</td>
						<td class="txt-R">377원</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" class="txt-C">합계보험료</td>
						<td class="txt-R">15,954원</td>
						<td class="txt-R">17,839원</td>
						<td class="txt-R">23,156원</td>
					</tr>
				</tfoot>
			</table>

			<p class="row-prec">
				보험료는 여행 기간/나이/성별에 따라 달라질 수 있으며, 최단 2일부터 최장 3개월까지 보험 가입이 가능합니다.<br>
				질병으로 인한 입원, 수술, 투약경험의 경우 질병이력과 관련된 보장을 제외하고 가입하실 수 있습니다.
			</p>

		</div>
    </section>

    <section id="know">
        <div class="inner" style="min-height:800px;">
			<h2>알아두실 사항</h2>

			<div class="common-type">
				<ul class="row-bor">
					<p class="sub_ttl">보험가입 전 유의사항</p>
					<li>보험계약 체결 전 상품설명서 및 약관을 반드시 읽어보시기 바랍니다.</li>
					<li>보험계약자가 기존 보험계약을 해지하고 새로운 보험계약을 체결하는 경우, 보험인수가 거절되거나 보험료가 인상 될 수 있으며, 보장내용(면책기간 재적용 등)이 달라질 수 있습니다.</li>
					<li>보험료를 내신 후에는 회사가 발행한 소정의 양식을 받으시기 바랍니다.</li>
					<li>보험료가 납입 되지 않을 경우 손해발생시 보상을 받을 수 없습니다.</li>
					<li>보험계약 청약 시 기재사항을 사실대로 빠짐없이 작성하고 자필 서명하셔야 합니다.</li>
					<li>보험기간 중에 발생한 사고 및 질병에 한하여 보상하며, 보상받을 수 있는 경우와 보상받을 수 없는 경우를 확인하셔야 합니다.</li>
					<li>당사는 해당 상품에 대해 충분히 설명할 의무가 있으며, 가입자는 가입에 앞서 이에 대한 충분한 설명을 받으시기 바랍니다.</li>
					<li>본 광고물은 법령 및 내부통제기준을 준수한 보험상품 광고물 입니다.</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">알릴 의무</p>
				<ul class="row-numlist">
					<p class="ssub_ttl">계약 후 알릴 의무</p>
					<p class="type-prectxt">
						보험계약자 또는 피보험자는 보험기간 중 아래와 같은 변경이 발생한 경우 지체 없이 회사에 알려야 합니다. 알리지 않은 경우 보험금 지급이 제한될 수 있습니다.
					</p>
					<li>
						1. 보험증권 등에 기재된 직업 또는 직무의 변경
						<ul>
							<li>가. 현재의 직업 또는 직무가 변경된 경우</li>
							<li>나. 직업이 없는 자가 취직한 경우</li>
							<li>다. 현재의 직업을 그만둔 경우</li>
						</ul>
					</li>
					<li>
						2. 보험증권 등에 기재된 피보험자의 운전 목적이 변경된 경우 (자가용에서 영업용으로 변경, 영업용에서 자가용으로 변경 등)
					</li>
					<li>
						3. 보험증권 등에 기재된 피보험자의 운전여부가 변경된 경우 (비운전자에서 운전자로 변경, 운전자에서 비운전자로 변경 등)
					</li>
					<li>
						4. 이륜자동차 (자동차관리법상 이륜차로 분류되는 삼륜 또는 사륜의 자동차를 포함) 또는 원동기장치 자전거(전동킥보드, 전동이륜평행차, 전동기의 동력만으로 움직일 수 있는 자전거 등 개인형 이동장치를 포함)를 계속적으로 사용(직업, 직무 또는 동호회 활동과 출퇴근용도 등으로 주로 사용하게 되는 경우에 한함)하게 된 경우 (다만, 전동휠체어, 의료용 스쿠터 등 보행보조용 의지차는 제외합니다.) 위험이 감소된 경우 보험료를 감액하고 이후 기간 보장을 위한 재원인 책임준비금 등의 차이로 인하여 발생한 정산금액을 환급하여 드립니다. 위험이 증가된 경우 보험료의 증액 또는 정산금액의 추가 납입을 요구할 수 있습니다.<br>
						"회사는 계약 후 알릴 의무를 이행하지 않았을 때 손해의 발생여부에 관계없이 그 사실을 안 날부터 1개월 이내에 이 계약을 해지할 수 있습니다."
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">계약 전 알릴 의무를 준수하셔야 합니다.</p>
				<ul>
					<li>
						계약 전 알릴 의무사항은 회사가 보험계약의 청약을 인수하는데 필요한 자료이므로 보험계약자 및 피보험자는 사실대로 알려야 합니다. 위 사항에 대하여 만약 사실대로 알리지 않거나 사실과 다르게 알린 경우에는 보험가입이 거절될 수 있으며, 특히 그 내용이 [중요한 사항]에 해당하는 경우에는 보험계약자 또는 피보험자의 의사와 관계없이 보험약관상 [계약 전 알릴 의무 위반의 
						효과]조항에 의해 계약이 해지되거나 보장이 제한될 수 있습니다. 단, 전화를 이용하여 청약한 경우 청약의 전 과정이 음성 녹음되므로 구두로만 알렸더라도 계약 전 알릴 의무를 이행한 것으로 간주됩니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">청약의 철회</p>
				<ul>
					<li>
						일반금융소비자인 계약자는 ｢금융소비자 보호에 관한 법률｣ 제46조, 동법 시행령 제37조, 동법 감독규정 제30조에서 정하는 바에 따라 보험증권을 받은 날부터 15일 이내(청약을 한 날부터 30일 이내에 한하며 만 65세 이상 계약자가 전화를 이용하여 체결한 계약은 45일)에 청약을 철회할 수 있으며, 이 경우 철회를 접수한 날부터 3영업일 이내에 보험료를 돌려드립니다. 다만, 회사가 건강상태 진단을 지원하는 계약, 보장기간이 90일 이내인 계약 또는 전문금융소비자가 체결한 계약은 청약을 철회할 수 없습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">보험금을 지급하는 사유</p>
				<ul>
					<li>
						피보험자가 보험증권에 기재된 여행을 목적으로 주거지를 출발하여 여행을 마치고 주거지에 도착할 때까지의 보험기간 중에 상해의 직접결과로써 사망한 경우(질병으로 인한 사망은 제외)<br>
						사망보험을 지급하고 장해지급률에 해당하는 장해상태가 되었을 때 후유장해보험금 (장해분류표에서 정한 지급률을 보험가 입금액에 곱하여 산출한 금액) 지급하여 드립니다. 다수계약이 체결되어 있는 경우에는 회사는 해당약관에 따라 비례 보상합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">보험금을 지급하지 아니하는 사유</p>
				<ul class="row-bor">
					<li>계약자, 피보험자, 보험 수익자의 고의</li>
					<li>피보험자의 임신, 출산(제왕절개 포함), 산후기</li>
					<li>전쟁, 외국의 무력행사, 혁명, 내란, 사변, 폭동</li>
					<li>전문등반, 글라이더 조종, 스카이다이빙, 스쿠버다이빙, 행글라이딩, 수상보트, 패러글라이딩</li>
					<li>모터보트, 자동차 또는 오토바이에 의한 경기, 시범, 흥행 또는 시운전 등</li>
					<li>선박에 탑승하는 것을 직무로 하는 사람이 직무상 선박에 탑승하고 있는 동안</li>
					<li>※ 기타 세부 담보별 보험금을 지급하지 않는 사유는 반드시 약관을 참조하시기 바랍니다.</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">계약의 무효</p>
				<ul class="row-bor">
					<p class="type-prectxt">
						다음 중 한 가지에 해당되는 경우에는 계약을 무효로 하며 이미 납입한 보험료를 돌려드립니다.
					</p>
					<li>만 15세 미만자, 심신상실자 또는 심신박약자의 사망을 보험금 지급사유로 한 경우</li>
					<li>타인의 사망을 보험금 지급사유로 하는 계약에서 계약을 체결할 때까지 피보험자의 서면에 의한 동의를 얻지 않은 경우</li>
					<li>계약을 체결할 때 계약에서 정한 피보험자의 나이에 미달되었거나 초과되었을 경우</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">계약의 취소</p>
				<ul>
					<li>
						계약체결 시 약관 및 계약자 보관용 청약서를 청약할 때 계약자에게 전달하지 않거나 약관의 중요한 내용을 설명하지 않은 때 또는 계약을 체결할 때 계약자가 청약서에 자필서명(날인(도장을 찍음) 하지 않은 때에는 계약이 성립한 날부터 3개월 이내에 계약을 취소할 수 있습니다. 계약이 취소된 경우에는 회사는 이미 납입한 보험료를 계약자에게 돌려 드리며, 보험료를 받은 기간에 대하여 ‘보험개발원이공시하는 보험계약대출이율’을 연단위 복리로 계산한 금액을 더하여 지급합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">예금자보호 안내</p>
				<ul>
					<li>
						이 보험계약은 예금자보호법에 따라 예금보험공사가 보호하되, 보호 한도는 본 보험회사에 있는 귀하의 모든 예금보호 대상 금융상품의 해약환급금(또는 만기 시 보험금이나 사고보험금)에 
						기타지급금을 합하여 1인당 “최고 5천만원”이며, 5천만원을 초과하는 나머지 금액은 보호하지 않습니다. 다만, 보험계약자 및 보험료 납부자가 법인인 보험계약은 예금자보호법에 따라
						예금보험공사가 보호하지 않습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">보험품질보증제도</p>
				<ul>
					<li>
						회사가 보험약관 및 계약자 보관용 청약서를 청약할 때 보험계약자에게 전달하지 않거나 약관의 중요한 내용을 설명하지 않은 때 또는 계약을 체결할 때 계약자가 청약서에 자필서명 (날인 (도장을 찍음) 및 전자서명법 제2조 제2호에 따른 전자서명을 포함합니다)을 하지 않은 때 (전화를 이용하여 계약을 체결하는 경우 자필서명을 생략할 수 있음)에는 계약자는 계약이 성립한 날부터 3개월 이내 계약을 취소할 수 있습니다. 이 경우 회사는 계약자에게 이미 납입한 보험료를 돌려드리며, 보험료를 받은 기간에 대하여 보험계약대출이율을 연단위 복리로 계산한 금액을 더하여 지급합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">개인정보 보호안내</p>
				<ul>
					<li>
						보험계약자에게는 법에서 정한 경우를 제외하고 본인의 동의없이 본인의 개인정보가 제3자에게 제공 이용되지 않을 권리가 있습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">의료급여 수급권자 보험료 할인안내</p>
				<ul>
					<li>
						의료급여 수급권자에 해당하는 피보험자가 실손의료보험(담보) 가입시 보험료 10%할인 적용 됩니다.<br>
						단, 의료급여 수급권자를 증명할 수 있는 서류를 제출한 경우에 한함.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">전환 계약 시 유의사항</p>
				<ul>
					<li>
						보험계약자가 기존 보험계약을 해지하고 새로운 보험계약을 체결하는 경우, 보험인수가 거절되거나 보험료가 인상 될 수 있으며, 보장내용(면책기간 재 적용 등)이 달라질 수 있습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">비급여 진료비 비교 관련 안내</p>
				<ul>
					<li>
						비급여 진료비 가격은 의료기관별로 상이하므로 가격비교를 통해 실손의료보험에서 고객님이 부담하시는 비용을 절감하실 수 있습니다. 의료기관별 비급여 진료비 가격은 건강보험심사 평가원 홈페이지에서 확인 가능합니다.<br>
						인터넷 : <a href="http://www.hira.or.kr" target="_blank" class="link">www.hira.or.kr</a> → 정보→ 비급여 진료비 정보
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">해지환급금이 적거나 없는 이유</p>
				<ul>
					<li>
						보험계약자는 계약이 소멸하기 전에 언제든지 계약을 해지할 수 있으며 계약해지 시 보험기간 중 남은 미경과 기간에 대해 단기요율을 적용하여 해지환급금을 돌려 드리므로 납입하신 보험료보다 적거나 없을 수 있습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">위법계약을 해지할 수 있는 권리</p>
				<ul>
					<li>
						계약자는 보험회사가 ｢금융소비자 보호에 관한 법률｣ 제17조내지 제21조를 위반하여 계약을 체결한 경우, 동법 제47조(위법계약의 해지) 제1항, 동법 시행령 제38조 및 동법 감독규정 제31조에서 정하는 바에 따라, 계약체결일부터 5년을 초과하지 않는 범위 내에서 계약체결에 대한 회사의 위반사항을 안 날부터 1년 이내에 서면 등으로 해당 계약의 해지를 요구할 수 있습니다. 이때 계약자는 해지요구서에 위반사실을 증명하는 서류를 첨부하여 보험사에 제출하여야 합니다. 이 경우 보험사에 해지를 요구하신 날부터 10일 이내에 수락여부를 통지(거절할 때에는 거절사유를 함께 포함하여 통지)받으실 수 있습니다. 다만, 법률에 따라 가입의무가 부과되고 그 해제·해지도 해당 법률에 따라 가능한 보장성 상품에 대해 계약의 해지를 요구하려는 경우에는 동종의 다른 보험에 가입되어 있어야 합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">상담안내 및 분쟁조정</p>
				<ul>
					<li>
						보험에 관한 분쟁이 있을 때에는 금융감독원에 진정 또는 분쟁조정을 신청하시면 도와 드립니다.
					</li>
				</ul>

				<ul class="row-bor">
					<p class="ssub_ttl">금융감독원</p>
					<li>전화 : 1332</li>
					<li>홈페이지 : <a href="http://www.fss.or.kr" target="_blank" class="link">www.fss.or.kr</a></li>
				</ul>

				<ul class="row-bor">
					<p class="ssub_ttl">한국소비자보호원</p>
					<li>주소 : 충청북도 음성군 맹동면 용두로 54</li>
					<li>전화 : 1372</li>
					<li>홈페이지 : <a href="http://www.kca.go.kr" target="_blank" class="link">www.kca.go.kr </a></a></li>
				</ul>
			</div>

		</div>
    </section>

<!-- /******** Foter Area **************/ -->
	<footer>
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
<!-- /* Foter Area End **************/ -->

</div>

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

<script src="../js1/jquery-3.1.1.min.js"></script>
<script src="../js1/jquery-ui-1.12.1.js"></script>
<script src="../js1/ui.js"></script>
<script src="../js1/swiper.min.js"></script>

	<!-- * 해당 위치 이동 JS
	<script src='onepage-jquery.js'></script>
	 -->

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

<script>
/* section Menu 이동 */
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 70 || document.documentElement.scrollTop > 70) {
    document.getElementById("tabMenu-wrap").className="fix_height1";
  } else {
    document.getElementById("tabMenu-wrap").className="fix_height2";
  }
}
</script>




<!--레이어 스타트-->
<script>
	$(document).ready(function(){
		$("#3").click(function(){
			$("#popup_wrap").css("display", "block");
			$("#mask").css("display", "block");
		});

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