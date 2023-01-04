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

	<link type="text/css" rel="stylesheet" href="../css1/ui.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/swiper.min.css"/>
	<link type="text/css" rel="stylesheet" href="../css1/responsive.css"/>
	<style>
		a {
			cursor: pointer;
		}
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
		
		#tabMenu-wrap li:first-child { height:60px; }
		#tabMenu-wrap li {
			width: 230px;
		}
		#tabMenu-wrap li:last-child a {
			width: 330px;
		}
		
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
		<h2>장기체류(유학, 주재원) 여행자 보험</h2>
		<h3>안전한 해외출장의 시작, 여행자보험은 필수!</h3>
		<img src="images/sub_images_long_stay.png">
	</div>
	<!-- /* Visual Area **************/ -->

	<!-- /******** Contents Menu Area */ -->
	<div id="tabMenu-wrap">
		<ul>
			<li><span>장기체류(유학, 주재원) 여행자 보험</span></li>
			<li>
				<a href="#top"><span class="icon1"></span>보장내용</a>
			</li>
			<li>
				<a href="#know"><span class="icon3"></span>알아두실 사항</a>
			</li>
			<li>
				<a onclick="go_page('3');" class="subNavBtn extLink end"><span class="icon4"></span>보험료 계산/가입</a>
			</li>
		</ul>
	</div>
	<!-- /* Contents Menu Area **************/ -->

	
<!-- /************** Contents Area*/ -->
	<!-- /************** 보장내용 Start */ -->
    <section>
        <div class="inner">
			<h2>보장내용</h2>
			<h3 class="first">기본계약</h3>

			<table class="table-basic">
				<thead>
					<tr>
						<th>담보</th>
						<th>보장내용</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>해외장기체류중 상해사망 후유장해</td>
						<td class="txt-L">해외장기체류 중 급격하고도 우연한 외래의 사고로 피보험자가 사망하거나 후유장해가 발생하였을 경우, 사망시에는 가입금액 전액, 후유장해시에는 약관상의 후유장해지급율표에 따라 가입금액의 3%~100%를 지급</td>
					</tr>
				</tbody>
			</table>


			<h3>선택특약</h3>
			
			<table class="table-basic">
				<thead>
					<tr>
						<th>보장명(담보명)</th>
						<th>보장내용</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>해외여행중 질병사망 및 질병 80%이상 후유장해</td>
						<td class="txt-L">
							해외장기체류중 질병으로 보험기간 중 또는 보험기간종료후 30일 이내에 사망하거나 약관에서 정한 80%이상 고도후유장해를 당하였을 경우 가입금액 전액 보상
						</td>
					</tr>
					<tr>
						<td>해외여행중 배상책임 (자기부담금 1만원)</td>
						<td class="txt-L">
							해외장기체류중 타인의 신체나 재물에 손해를 가하여 법률상 배상책임을 부담하는 경우 보상한도액내에서 보상(자기부담금 1만원)
						</td>
					</tr>
					<tr>
						<td>해외여행중 중대사고 구조송환비용</td>
						<td class="txt-L">
							불의의 사고로 행방불명이나 조난된 경우 사망하거나 14일이상 입원치료하는 경우<br>
							- 수색구조비용, 항공운임 등 교통비, 숙박비, 이송비용, 제잡비
						</td>
					</tr>
				</tbody>
			</table>

		</div>
    </section>
	<!-- /* 보장내용 End **************/ -->

	<!-- /******** 알아두실 사항 Start */ -->
    <section id="know">
        <div class="inner" style="min-height:800px;">
			<h2>알아두실 사항</h2>

			<div class="common-type">
				<ul>
					<p class="sub_ttl">계약 전 알릴 의무</p>
					<li>
						계약자 또는 피보험자는 청약할 때(진단계약의 경우에는 건강진단을 할 때를 말합니다) 청약서에서 질문한 사항에 대하여 알고 있는 사실을 반드시 사실대로 알려야(상법에 따른고지의무와 같으며, 이하 계약 전 알릴 의무라 합니다) 합니다. 다만, 진단계약의 경우 의료법 제3조(의료기관)에 따른 종합병원이나 병원에서 직장 또는 개인이 실시한 건강진단서 사본 등 건강상태를 판단할 수 있는 자료로 건강진단을 대신할 수 있습니다
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">계약 후 알릴 의무</p>
				<ul class="row-numlist">
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
						4. 이륜자동차 (자동차관리법상 이륜차로 분류되는 삼륜 또는 사륜의 자동차를 포함) 또는 원동기장치 자전거(전동킥보드, 전동이륜평행차, 전동기의 동력만으로 움직일 수 있는 자전거 등 개인형 이동장치를 포함)를 계속적으로 사용(직업, 직무 또는 동호회 활동과 출퇴근용도 등으로 주로 사용하게 되는 경우에 한함)하게 된 경우 (다만, 전동휠체어, 의료용 스쿠터 등 보행보조용 의지차는 제외합니다.)<br>
						위험이 감소된 경우 보험료를 감액하고 이후 기간 보장을 위한 재원인 책임준비금 등의 차이로 인하여 발생한 정산금액을 환급하여 드립니다. 위험이 증가된 경우 보험료의 증액 또는 정산금액의 추가 납입을 요구할 수 있습니다.<br>
						"회사는 계약 후 알릴 의무를 이행하지 않았을 때 손해의 발생여부에 관계없이 그 사실을 안 날부터 1개월 이내에 이 계약을 해지할 수 있습니다."
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">청약 시에는 보험계약의 기본사항을 반드시 확인하시기 바랍니다.</p>
				<ul>
					<li>
						계약자[피보험자]께서는 보험계약 청약 시에 보험상품명, 보험 기간, 보험료, 보험료납입기간, 피보험자 등을 반드시 확인하시고 보험상품 내용을 설명 받으시기 바랍니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">계약 전 알릴 의무를 준수하셔야 합니다.</p>
				<ul>
					<li>
						계약 전 알릴 의무사항은 회사가 보험계약의 청약을 인수하는데 필요한 자료이므로 보험계약자 및 피보험자는 사실대로 알려야 합니다. 위 사항에 대하여 만약 사실대로 알리지 않거나 사실과 다르게 알린 경우에는 보험가입이 거절될 수 있으며, 특히 그 내용이 [중요한 사항]에 해당하는 경우에는 보험계약자 또는 피보험자의 의사와 관계없이 보험약관상 [계약 전 알릴 의무 위반의 효과]조항에 의해 계약이 해지되거나 보장이 제한될 수 있습니다. 단, 전화를 이용하여 청약한 경우 청약의 전 과정이 음성 녹음되므로 구두로만 알렸더라도 계약 전 알릴 의무를 이행한 것으로 간주됩니다.
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
				<p class="sub_ttl">보험료를 납입하시지 않을 경우 보험계약은 해지 됩니다.</p>
				<ul>
					<li>
						보험계약자가 제2회 이후 보험료를 납입기일까지 납입하지 아니한 때에는 납입기일 다음날부터 납입기일이 속하는 달의 다음다음달 14일까지 납입을 최고(독촉)하고(납입최고기간의 종료 일이 토요일 또는 공휴일에 해당한 때에는 기간은 그 익일로 만료합니다), 그 때까지 보험료를 납입하지 않을 경우 납입최고(독촉)기간이 끝나는 날의 다음날 계약이 해지됩니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">배당에 관한 안내</p>
				<ul>
					<li>
						이 상품은 무배당보험으로 배당이 없는 대신 같은 조건의 유배당 상품과 비교하여 보험료가 저렴합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">예금자보호안내</p>
				<ul class="row-bor">
					<li>
						이 보험계약은 예금자보호법에 따라 예금보험공사가 보호하되, 보호 한도는 본 보험회사에 있는 귀하의 모든 예금보호 대상 금융상품의 해약환급금(또는 만기 시 보험금이나 사고보험금)에 기타지급금을 합하여 1인당 “최고 5천만원”이며, 5천만원을 초과하는 나머지 금액은 보호하지 않습니다. 다만, 보험계약자 및 보험료 납부자가 법인인 보험계약은 예금자보호법에 따라 예금보험공사가 보호하지 않습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">보험료의 납입연체로 인한 해지계약의 부활(효력회복)</p>
				<ul>
				<ul class="row-bor">
					<li>
						계약이 해지되었으나 해지환급금을 받지 않은 경우(보험계약대출 등에 따라 해지환급금이 차감되었으나 받지 않은 경우 또는 해지환급금이 없는 경우를 포함합니다) 계약자는 해지된 날부터 3년 이내에 회사가 정한 절차에 따라 계약의 부활(효력회복)을 청약할 수 있습니다. 회사가 부활(효력회복)을 승낙한 때에 계약자는 부활(효력회복)을 청약한 날까지의 연체된 보험료에 평균공시이율 +1% 범위 내에서 각 상품별로 회사가 정하는 이율로 계산한 금액을 더하여 납입하여야 합니다. 다만 금리연동형보험은 각 상품별 사업방법서에서 별도로 정한 이율로 계산 합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">보험품질보증제도</p>
				<ul class="row-bor">
					<li>
						회사가 보험약관 및 계약자 보관용 청약서를 청약할 때 보험계약자에게 전달하지 않거나 약관의 중요한 내용을 설명하지 않은 때 또는 계약을 체결할 때 계약자가 청약서에 자필서명 (날인 (도장을 찍음) 및 전자서명법 제2조 제2호에 따른 전자서명을 포함합니다)을 하지 않은 때 (전화를 이용하여 계약을 체결하는 경우 자필서명을 생략할 수 있음)에는 계약자는 계약이 성립한 날부터 3개월 이내 계약을 취소할 수 있습니다. 이 경우 회사는 계약자에게 이미 납입한 보험료를 돌려드리며, 보험료를 받은 기간에 대하여 보험계약대출이율을 연단위 복리로 계산한 금액을 더하여 지급합니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">가입불가대상 및 인수제한</p>
				<ul class="row-bor">
					<li>
						회사는 합리적인 사유 없이 특정 직업 또는 직종에 종사한다는 사실 만으로 보험가입을 거절하지 않습니다. 단, 병력에 따라 인수가 불가능할 수 있으며 경우에 따라서는 건강진단결과를 요구할 수 있습니다. 보험계약 청약 시 보험계약자 및 피보험자는 청약서상의 질문사항(고지사항)에 대하여 사실대로 알려야 합니다. 만일 허위 또는 부실하게 알렸을 경우에는 보험금이 지급되지 않거나, 보험계약이 해지될 수 있습니다.
					</li>
				</ul>
			</div>

			<div class="common-type">
				<p class="sub_ttl">해지환급금이 적거나 없는 이유</p>
				<ul class="row-bor">
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
	<!-- /* 알아두실 사항 End **************/ -->

<!-- /* Contents Area End **************/ -->


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
	<!-- 
	<div class="Top_wrap">
		<ul>
			<li>
				<a onclick="go_page('3');"><img src="../img1/btn_premium.png"></a>
			</li>
			<li>
				<a href="#top"><img src="../img1/btn_top.png"></a>
			</li>
		</ul>
	</div>
	 -->

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