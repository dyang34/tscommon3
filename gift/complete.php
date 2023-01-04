<? 
	include ("../include/top.php"); 
	include ("../include/hana_check.php");
	include_once $root_dir."/config/get_site_config_member_no.php";

	$sql_check="select * from hana_plan where member_no='".$member_no."' and session_key='".$check."'";
	$result_check=mysql_query($sql_check);
	$row_check=mysql_fetch_array($result_check);

	if ($row_check['no']=='') {
?>
<script>
	alert('세션이 종료되었습니다.\n\n다시 시도해 주세요.');
	history.go(-1);
</script>
<?
		exit;
	}

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

	$sql_code="select plan_title from plan_code_hana where trip_type='".$tripType."' and company_type = 1 and member_no='".$site_config_member_no."' and plan_type='".$plan_type."'";
	$result_code=mysql_query($sql_code) or die(mysql_error());
	$row_code=mysql_fetch_array($result_code);

?>

<script>
	var oneDepth = 4; //1차 카테고리
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">

					<div class="complete_box">
						<p class="txt"><strong>감사합니다.</strong><br>여행자보험 선물등록이 완료되었습니다.</p>
						<p class="pt10 fcor0" style="font-size:0.7em; line-height:140%;">선물받으시는 분의 SMS로 선물등록 URL과 선물번호, 선물 메세지를 발송하였습니다.</p>
					</div>
					<h3 class="s_tit">신청자 정보</h3>

					<div class="table_line ">
						<table cellspacing="0" cellpadding="0" summary="회원정보입력" class="board-write ">
							<caption>
								회원정보입력
							</caption>
							<colgroup>
								<col class="m_th" width="180px;">
								<col width="%;">
							</colgroup>
							<tbody>

								<tr>
									<th>신청자명 </th>
									<td><?=stripslashes($row_check['join_name'])?></td>
								</tr>
								<tr>
									<th>연락처 </th>
									<td><?=stripslashes(decode_pass($row_check['join_hphone'],$pass_key))?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--
					<h3 class="s_tit">선물메세지</h3>
					<p>선물메세지 출력선물메세지 출력선물메세지 출력</p>
					-->
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

					<div class="btn-tc">
					   
						<a href="02.php" class="btnBig m_block"><span>선물한 내역조회</span></a>
					</div>

			</div>

	</div>
	<!-- //container -->
</div>
<!-- //wrap -->


<?
	$i=1;
	$sql_sms="select * from hana_plan_member where hana_plan_no='".$row_check['no']."' and sms_send='N'";
	$result_sms=mysql_query($sql_sms);
	while($row_sms=mysql_fetch_array($result_sms)) {

		if ($row_sms['hphone']!='') {
?>
<iframe id='ifrclassify_<?=$i?>' name="ifrclassify_<?=$i?>" width=0 height=0 frameborder=0 ></iframe>
<form id='vistasms_<?=$i?>' method='POST' ENCTYPE="multipart/form-data" action = "https://www.vistaweb.co.kr/sms/sms_utf8_snd.php" target="ifrclassify_<?=$i?>">
<input type="hidden" name="com_uid" value="<?=$sms_key?>"/>
<input type="hidden" name="com_key" value="<?=$sms_pass?>"/>
<input type="hidden" name="sms_type" value="2"/>
<input type='hidden' name='return_url' value="">
<input type='hidden' name='subject' value="투어세이프">
<input type='hidden' name='send_phone' value="<?=$sms_send_phone_no?>">
<input type='hidden' name='receive_phone' value="<?=decode_pass($row_sms['hphone'],$pass_key)?>">
<input type='hidden' name='receive_name' value="<?=$row_sms['name']?>">
<textarea name="content" id="sms_send_content" style="display:none;">
안녕하세요! <?=$row_sms['name']?> 고객님, 투어세이프 여행자보험 센터입니다.<?=$row_check['join_name']?> 님으로부터 고객님의 안전한 여행을 위한 여행자보험 선물이 도착했습니다.

		선물번호 : <?=$row_sms['gift_key']?>
		아래 링크에 접속하여 선물번호를 등록해 주세요.
		https://<?=_TOURSAFE_SUBSITE_NAME?>.toursafe.co.kr/accept/01.php

		여행지: <?=$row_nation['nation_name']?> / 보험기간: ><?=str_replace("-", "/",$row_check['start_date'])?> <?=$row_check['start_hour']?>시 ~ <?=str_replace("-", "/",$row_check['end_date'])?> <?=$row_check['end_hour']?>시 / 여행인원: <?=$row_sms['name']?> <?=($row_check['join_cnt'] > 1)?" 외 ".($row_check['join_cnt'] - 1):$row_check['join_cnt'];?>명
		
		* 여행자 보험 선물 등록 필수확인사항 (중요!!) *
		1.	여행 출발 전 수령하신 선물 번호로 반드시 등록해 주세요. 
		여행 출발 전 미등록 시 자동 취소되며 여행자보험 보장을 받을 수 없습니다.
		2.	여행 인원이 다수일 경우 모두 여행자보험 선물을 반드시 등록해 주세요.
		선물 받은 일행 중 한 명이라도 미등록 시 자동 취소되며 여행자보험 보장을 받을 수 없습니다.
</textarea>
</form>
<script>
	document.getElementById('vistasms_<?=$i?>').submit();
</script>
<?
			$i++;
		}

		$sql_update="update hana_plan_member set sms_send='Y' where no='".$row_sms['no']."'";
		mysql_query($sql_update);
	}

?>

</body>

</html>
<?
	/*
		
		안녕하세요! <?=$row_sms['name']?> 고객님, 투어세이프 여행자보험 센터입니다.
		<?=$row_check['join_name']?> 님으로부터 <?=$row_sms['name']?> 고객님의 안전한 여행을 위한 
		여행자보험 선물이 도착했습니다.

		선물번호 : <?=$row_sms['gift_key']?>
		아래 링크에 접속하여 선물번호를 등록해 주세요.
		https://<?=_TOURSAFE_SUBSITE_NAME?>.toursafe.co.kr/accept/01.php

		여행지: <?=$row_nation['nation_name']?> / 보험기간: ><?=str_replace("-", "/",$row_check['start_date'])?> <?=$row_check['start_hour']?>시 ~ <?=str_replace("-", "/",$row_check['end_date'])?> <?=$row_check['end_hour']?>시 / 여행인원: <?=$row_sms['name']?> <?=($row_check['join_cnt'] > 1)?" 외 ".($row_check['join_cnt'] - 1):$row_check[join_cnt'];?>명
		
		필수 확인 사항
		1.	여행 출발 전 수령하신 선물 번호로 반드시 등록해 주세요. 
		여행 출발 전 미등록 시 자동 취소되며 여행자보험 보장을 받을 수 없습니다.
		2.	여행 인원이 다수일 경우 모두 여행자보험 선물을 반드시 등록해 주세요.
		선물 받은 일행 중 한 명이라도 미등록 시 자동 취소되며 여행자보험 보장을 받을 수 없습니다.

	*/

	/*
	<?=$row_sms['name']?> 고객님! 투어세이프 입니다.
<?=$row_check['join_name']?> 님으로부터 여행자보험 선물이 도착했습니다.

선물번호 : [<?=$row_sms['gift_key']?>]

아래 링크에 접속하여 선물을 등록해 주세요.

https://<?=_TOURSAFE_SUBSITE_NAME?>.toursafe.co.kr/accept/01.php
*/
?>