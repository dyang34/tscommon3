<? 
	include ("../include/top.php"); 
	//include ("../include/hana_check.php");
	include_once $root_dir."/config/get_site_config_member_no.php";

	$sql_check="select * from hana_plan where member_no='".$member_no."' and session_key='".$check."'";
	$result_check=mysql_query($sql_check);
	$row_check=mysql_fetch_array($result_check);
/*
	if ($row_check['no']=='') {
?>
<!--
<script>
	alert('세션이 종료되었습니다.\n\n다시 시도해 주세요.');
	history.go(-1);
</script>
-->
<?
		exit;
	}
*/
	$sql_mem="select sum(plan_price) as mem_price from hana_plan_member where hana_plan_no='".$row_check['no']."' group by hana_plan_no";
	$result_mem=mysql_query($sql_mem);
	$row_mem=mysql_fetch_array($result_mem);

	$tripType=$row_check['trip_type'];
	$nation_no=$row_check['nation_no'];
	$plan_type=$row_check['plan_type'];
	
	if ($tripType=="2") {
		$sql_nation="select * from nation where no='".$nation_no."' and use_type='Y'";
		$result_nation=mysql_query($sql_nation) or die(mysql_error());
		$row_nation=mysql_fetch_array($result_nation);
	} else {
		$row_nation['nation_name']="국내";
	}

	$sql_code="select plan_title from plan_code_hana where trip_type='".$tripType."' and company_type=1 and member_no='".$site_config_member_no."' and plan_type='".$plan_type."'";
	$result_code=mysql_query($sql_code) or die(mysql_error());
	$row_code=mysql_fetch_array($result_code);

	$sql_kakao="select * from hana_plan_member where hana_plan_no='".$row_check['no']."' and main_check='Y'";
	$result_kakao=mysql_query($sql_kakao);
	$row_kakao=mysql_fetch_array($result_kakao);
?>

<script>
	var oneDepth = 1; //1차 카테고리
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
					
					<div class="complete_box">
						<p class="txt"><strong>감사합니다.</strong><br>여행자보험 가입신청이 완료되었습니다.</p>
					</div>
					
					<div class="gray_box mt30">
						<h4 class="ss_tit mt0">여행자보험 가입신청정보</h4>
						<ul class="step4_step">
							<li>
								<div class="box">출발일시<span class="ico"><img src="../img/pages/step4_ico01.png" alt=""></span>
									<p class="table"><span class="point_c"><?=$row_check['start_date']?><br><?=$row_check['start_hour']?>시</span></p>
								</div>
							</li>
							<li>
								<div class="box">도착일시 <span class="ico"><img src="../img/pages/step4_ico02.png" alt=""></span>
									<p class="table"><span class="point_c"><?=$row_check['end_date']?><br><?=$row_check['end_hour']?>시</span></p>
								</div>
							</li>
							<li>
								<div class="box">지역 <span class="ico"><img src="../img/pages/step4_ico03.png" alt=""></span>
									<p class="table"><span class="point_c"><?=$row_nation['nation_name']?> </span></p>
								</div>
							</li>
							<li>
								<div class="box">인원 <span class="ico"><img src="../img/pages/step4_ico04.png" alt=""></span>
									<p class="table"><span class="point_c"><?=number_format($row_check['join_cnt'])?>명</span></p>
								</div>
							</li>
							<li>
								<div class="box">총금액 <span class="ico"><img src="../img/pages/step4_ico05.png" alt=""></span>
									<p class="table"><span class="point_c"><?=number_format($row_mem['mem_price'])?>원 </span></p>
								</div>
							</li>
							<li>
								<div class="box">상품유형<span class="ico"><img src="../img/pages/step4_ico06.png" alt=""></span>
									<p class="table"><span class="point_c"><?=$type_array[$tripType]?><br><?=$row_code['plan_title']?></span></p>
								</div>
							</li>
						</ul>
					</div>

					<div class="complete_box" style="text-align:left;">
						<p class="pt10 fcor0" style="font-size:0.6em; line-height:120%;">* 가입확인서는 휴대폰으로 카카오톡 또는 문자메세지로 발송해 드립니다.</p>
						<p class="pt10 fcor0" style="font-size:0.6em; line-height:120%;">* 사고접수/계약취소/정보변경 등은 투어세이프 여행보험 콜센터 1800-9010(평일09~18시)로 연락주시기 바랍니다.</p>
						<p class="pt10 fcor0" style="font-size:0.6em; line-height:120%;">* 해외여행 중 현지에서 사고 발생 시 24시간 한국어 안내가 지원되는 에이스손해보험 긴급지원서비스 센터 82-2-3449-3500로 연락주시면 도움 받으실 수 있습니다.</p>
					</div>


					<div style="text-align:center;"><a href="https://pf.kakao.com/_xaxmDCK" onclick="getOutboundLink('https://pf.kakao.com/_xaxmDCK'); return false;" target="_blank" ><img src="../img/main/dusitprincess_ad.jpg"></a></div>


					<div class="btn-tc">
					   <a href="../check/01.php" class="btnBig m_block"><span>보험가입내용 조회</span></a>
					</div>

			</div>

	</div>
	<!-- //container -->
</div>
<!-- //wrap -->


</body>

</html>
