<? 
	include ("../include/top.php"); 
	include ("../include/link_session_check.php");
	include ("../include/plan_gift_check.php"); 
	include_once $root_dir."/config/get_site_config_member_no.php";

$sql="select 
		*
	  from
		hana_plan
	  where
		no='".$num."'
		and member_no='".$member_no."'
		and join_name='".$_SESSION['gift_check_1']."'
		and join_hphone='".$_SESSION['gift_check_2']."'
	 ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if ($row['no']=="") {
?>
<script>
	alert('신청내역이 없습니다.');
	history.go(-1);
</script>
<?
	exit;
}

if ($row['nation_no']=="0") {
	$nation_text="국내";
} else {
	$nation_row=sql_one_one("nation","nation_name"," and no='".$row['nation_no']."'");
	$nation_text=stripslashes($nation_row['nation_name']);
}

$sql_mem="select 
		*
	  from
		hana_plan_member
	  where
		hana_plan_no='".$num."'
		and main_check='Y'
	 ";
$result_mem=mysql_query($sql_mem);
$row_mem=mysql_fetch_array($result_mem);

$plan_code_row=sql_one_one("plan_code_hana","plan_title"," and company_type = 1 and member_no='".$site_config_member_no."' and plan_code='".$row_mem['plan_code']."'");
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
				<ul class="step4_step three">
					<li>
						<div class="box">보험기간<span class="ico"><img src="../img/pages/step4_ico07.png" alt=""></span>
							<p class="table"><span class="point_c"><span class="ib"><?=date("Y년 m월 d일",strtotime($row['start_date']))?> <?=$row['start_hour']?>시 ~ </span><span class="ib"><?=date("Y년 m월 d일",strtotime($row['end_date']))?> <?=$row['end_hour']?>시</span></span></p>
						</div>
					</li>
					<li>
						<div class="box">여행지 <span class="ico"><img src="../img/pages/step4_ico03.png" alt=""></span>
							<p class="table"><span class="point_c"><?=$nation_text?> </span></p>
						</div>
					</li>

					<li>
						<div class="box">보험상품<span class="ico"><img src="../img/pages/step4_ico06.png" alt=""></span>
							<p class="table"><span class="point_c">CHUBB <?=$type_array[$row['trip_type']]?> <?=stripslashes($plan_code_row['plan_title'])?></span></p>
						</div>
					</li>
				</ul>

				<h3 class="s_tit">피보험자 정보</h3>
				<div class="table_overflow">

					<div class="table_line2 overlayer">
						<table class="board-list">
							<colgroup>
								<col class="w_cell" width="5%">
								<col width="9%">
								<col width="9%">
								<col width="13%">
								<col width="%">
								<col width="13%">
								<col width="13%">
								<col class="m_th_s" width="12%">
								<col class="m_th_s" width="12%">
							</colgroup>
							<thead>
								<tr>
									<th class="w_cell">NO</th>
									<th>피보험자명</th>
									<th>보험나이</th>
									<th>휴대폰번호</th>
									<th>이메일</th>
									<th>보험금액</th>
									<th>선물번호</th>
									<th>확인상태</th>
									<th>진행상태</th>
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
		hana_plan_no='".$row['no']."'
	 ";
	$result_mem=mysql_query($sql_mem);
	while($row_mem=mysql_fetch_array($result_mem)) {
?>
								<tr>
									<td class="w_cell"><?=$i?></td>
									<td><?=stripslashes($row_mem['name'])?></td>
									<td><?=stripslashes($row_mem['age'])?>세</td>
									<td><? if ($row_mem['hphone']!='') { ?><?=decode_pass($row_mem['hphone'],$pass_key)?><? } ?></td>
									<td><? if ($row_mem['email']!='') { ?><?=decode_pass($row_mem['email'],$pass_key)?><? } ?></td>
									<td><strong class="point_c"><?=number_format($row_mem['plan_price'])?>원</strong></td>
									<td><?=$row_mem['gift_key']?></td>    
									<td><?=$gift_state_array[$row_mem['gift_state']]?></td>
									<td><?=$gift_bill_state_text_array[$row_mem['plan_state']]?></td>
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
</div>
<!-- //wrap -->


</body>

</html>
