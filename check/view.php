<? 
	include ("../include/top.php"); 
	include ("../include/link_session_check.php");
	include ("../include/plan_check.php"); 
	include_once $root_dir."/config/get_site_config_member_no.php";

$sql="select 
		*
	  from
		hana_plan_member
	  where
		no='".$num."'
		and hphone='".$_SESSION['phone_check']."'
	 ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//		and name='".$_SESSION['login_check_key_name']."' 쿼리에 이부분 삭제 이름때문에 검색이 안됨
if ($row['no']=="") {
?>
<script>
	alert('신청내역이 없습니다.');
	history.go(-1);
</script>
<?
	exit;
}

$sql_trip="select 
		*
	  from
		hana_plan
	  where
		no='".$row['hana_plan_no']."'
	 ";
$result_trip=mysql_query($sql_trip);
$row_trip=mysql_fetch_array($result_trip);

if ($row_trip['nation_no']=="0") {
	$nation_text="국내";
} else {
	$nation_row=sql_one_one("nation","nation_name"," and no='".$row_trip['nation_no']."'");
	$nation_text=stripslashes($nation_row['nation_name']);
}

$plan_code_row=sql_one_one("plan_code_hana","plan_title"," and company_type = 1 and member_no='".$site_config_member_no."' and plan_code='".$row['plan_code']."'");
$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';
preg_match_all($pattern, $plan_code_row['plan_title'], $match);
$plan_title = implode('', $match[0]);
?>

<script>
	var oneDepth = 3; //1차 카테고리
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<ul class="step4_step three">
					<li>
						<div class="box">보험기간<span class="ico"><img src="../img/pages/step4_ico07.png" alt=""></span>
							<p class="table"><span class="point_c"><span class="ib"><?=date("Y년 m월 d일",strtotime($row_trip['start_date']))?> <?=$row_trip['start_hour']?>시 ~ </span><span class="ib"><?=date("Y년 m월 d일",strtotime($row_trip['end_date']))?> <?=$row_trip['end_hour']?>시</span></span></p>
						</div>
					</li>
					<li>
						<div class="box">여행지 <span class="ico"><img src="../img/pages/step4_ico03.png" alt=""></span>
							<p class="table"><span class="point_c"><?=$nation_text?> </span></p>
						</div>
					</li>

					<li>
						<div class="box">보험상품<span class="ico"><img src="../img/pages/step4_ico06.png" alt=""></span>
							<p class="table"><span class="point_c">CHUBB <?=$type_array[$row_trip['trip_type']]?> <?=stripslashes($plan_code_row['plan_title'])?></span></p>
						</div>
					</li>
				</ul>

				<h3 class="s_tit">피보험자 정보</h3>
				<div class="table_overflow">

					<div class="table_line2 overlayer">
						<table class="board-list">
							<colgroup>
								<col class="w_cell" width="5%">
								<col width="11%">
								<col width="10%">
								<col width="9%">
								<col width="13%">
								<col width="20%">
								<col width="10%">
								<col class="m_th_s" width="%">
								<col class="m_th_s" width="13%">
							</colgroup>
							<thead>
								<tr>
									<th class="w_cell">NO</th>
									<th>구분</th>
									<th>피보험자명</th>
									<th>보험나이</th>
									<th>휴대폰번호</th>
									<th>이메일</th>
									<th>보험금액</th>
									<th>진행상태</th>
									<th>가입확인서</th>
								</tr>
							</thead>
							<tbody>
							<?
								$i=1;

								$sql_mem="select 
									*
								  from
									hana_plan_member
								  where
									hana_plan_no='".$row['hana_plan_no']."'
								 ";
								$result_mem=mysql_query($sql_mem);
								while($row_mem=mysql_fetch_array($result_mem)) {
							?>
								<tr>
									<td class="w_cell"><?=$i?></td>
									<td>
									<? if ($row_mem['main_check']=="Y") { ?>
									대표피보험자
									<? } else { ?>
									피보험자
									<? } ?>
									</td>
									<td><?=stripslashes($row_mem['name'])?></td>
									<td><?=stripslashes($row_mem['age'])?>세</td>
									<td><? if ($row_mem['hphone']!='') { ?><?=decode_pass($row_mem['hphone'],$pass_key)?><? } ?></td>
									<td><? if ($row_mem['email']!='') { ?><?=decode_pass($row_mem['email'],$pass_key)?><? } ?></td>
									<td><strong class="point_c"><?=number_format($row_mem['plan_price'])?>원</strong></td>
									<td><?=$plan_state_array[$row_mem['plan_state']]?></td>
									<td>
									<? if ($row_mem['plan_state']=="1" && ($row['no']==$row_mem['no'] || $row['main_check']=="Y")) { ?>
										<p class="pt5"><a href="javascript:void(0);" onclick="window.open('confirmation.php?num=<?=$row_mem['no']?>&check1=<?=$row_mem['jumin_1']?>&check2=<?=$row_mem['jumin_2']?>', 'confirmation', 'width=900,height=650,left=100,top=0,scrollbars=yes')" class="btnNormal radius"><span class="f095">확인</span></a></p>
									<? } ?>
									</td>
								</tr>
							<?
									$i++;
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="btn-tc"> <a href="list.php" class="btnStrong m_block "><span>목록으로</span></a> </div>
			</div>
	</div>
	<!-- //container -->
	<? include ("../include/footer.php"); ?>
</div>
<!-- //wrap -->
</body>
</html>