<? 

	include ("../include/top.php"); 
	include ("../include/link_session_check.php");
	include ("../include/plan_check.php"); 

	include_once $root_dir."/config/get_site_config_member_no.php";

if (!$page) $page = 1;
$num_per_page = 5;
$num_per_page_start = $num_per_page*($page-1);
$page_per_block = 5;

$hphone1=addslashes(fnFilterString(strip_tags($_POST['hphone1'])));
$hphone2=addslashes(fnFilterString(strip_tags($_POST['hphone2'])));
$hphone3=addslashes(fnFilterString(strip_tags($_POST['hphone3'])));
/*
$sql="select 
		*, a.no as plan_hana_no, b.no as num
	  from
		hana_plan_member a
		left join hana_plan b on a.hana_plan_no=b.no
	  where
		b.member_no='".$member_no."'
		and name='".$_SESSION['login_check_key_name']."'
		and jumin_1='".$_SESSION['login_check_key_1']."'
		and jumin_2='".$_SESSION['login_check_key_2']."'
	  order by a.no desc
	 ";

$sql="select 
		*, a.no as plan_hana_no, b.no as num
	  from
		hana_plan_member a
		left join hana_plan b on a.hana_plan_no=b.no
	  where
		b.member_no='".$member_no."'
		and jumin_1='".$_SESSION['login_check_key_1']."'
		and jumin_2='".$_SESSION['login_check_key_2']."'
	  order by a.no desc
	 ";
*/

$sql="select 
		*, a.no as plan_hana_no, b.no as num
	  from
		hana_plan_member a
		left join hana_plan b on a.hana_plan_no=b.no
	  where
		b.member_no='".$member_no."'
		and a.hphone='".$_SESSION['phone_check']."'
	  order by a.no desc
	 ";

$result=mysql_query($sql);
$total_record=mysql_num_rows($result);
$sql=$sql." limit $num_per_page_start, $num_per_page";
$result=mysql_query($sql) or die(mysql_error());

$list_page=list_page($num_per_page,$page,$total_record);//function_query
$total_page	= $list_page['0'];
$first		= $list_page['1'];
$last		= $list_page['2'];
$article_num = $total_record - $num_per_page*($page-1);
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
				<div class="table_overflow">
					<div class="table_line2 overlayer">
						<table class="board-list">
							<colgroup>
								<col class="w_cell" width="7%">
								<col width="13%">
								<col width="12%">
								<col width="12%">
								<col width="%">
								<col width="11%">
								<col width="15%">
							</colgroup>
							<thead>
								<tr>
									<th class="w_cell">NO</th>
									<th>가입신청일</th>
									<th>가입자(인원)</th>
									<th>보험상품</th>
									<th>여행정보</th>
									<th>결제금액</th>
									<th>진행상태</th>
								</tr>
							</thead>
							<tbody>
<?
	$cur_time=time();

	while($row=mysql_fetch_array($result)) {
		$total_price=0;
		$total_cnt=0;
		$plan_state_1=0;
		$plan_state_2=0;
		$plan_state_3=0;
		$plan_state_4=0;
		$del_check="Y";

		$sql_mem="select * from hana_plan_member where hana_plan_no='".$row['num']."'";
		$result_mem=mysql_query($sql_mem);
		while($row_mem=mysql_fetch_array($result_mem)) {
			if ($row_mem['main_check']=="Y") {
				$d_name=stripslashes($row_mem['name']);
			}

			$total_price=$total_price+$row_mem['plan_price'];

			${"plan_state_".$row_mem['plan_state']}++;

			$total_cnt++;
		}


		if ($row['join_cnt']=="1") {
			$join_text=$d_name;
		} else {
			$join_text=$d_name." 외 ".($row['join_cnt']-1)."명";
		} 

		$plan_code_row=sql_one_one("plan_code_hana","plan_title"," and company_type = 1 and member_no='".$site_config_member_no."' and plan_code='".$row['plan_code']."'");

		$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';
		preg_match_all($pattern, $plan_code_row['plan_title'], $match);
		$plan_title = implode('', $match[0]);

		if ($row['nation_no']=="0") {
			$nation_text="국내";
		} else {
			$nation_row=sql_one_one("nation","nation_name"," and no='".$row['nation_no']."'");
			$nation_text=stripslashes($nation_row['nation_name']);
		}

		$start_time=strtotime($row['start_date']." ".$row['start_hour']."0000");
		if (($start_time-$cur_time)<"7200") {
			$del_check="N";
		}
?>
								<tr>
									<td class="w_cell"><?=$article_num?></td>
									<td><a href="view.php?num=<?=$row['plan_hana_no']?>"><?=date("Y-m-d",$row['regdate'])?></a>
									<? if ($row['order_type']=="2") { ?><img src="../img/pages/ico_gift.png" style="width:30px;">
									<br>신청자 : <?=stripslashes($row['join_name'])?>
									<? } ?>
									</td>
									<td><a href="view.php?num=<?=$row['plan_hana_no']?>"><?=$join_text?></a></td>
									<td><a href="view.php?num=<?=$row['plan_hana_no']?>"><?=$type_text_array[$row['trip_type']]?>여행<br><?=stripslashes($plan_code_row['plan_title'])?></a></td>
									<td><a href="view.php?num=<?=$row['plan_hana_no']?>"><strong class="point_c">[ <?=$nation_text?> ]</strong><br><?=$row['start_date']?> <?=$row['start_hour']?>시 <br>~ <?=$row['end_date']?> <?=$row['end_hour']?>시</a></td>
									<td><a href="view.php?num=<?=$row['plan_hana_no']?>"><strong class="point_c"><?=number_format($total_price)?>원</strong></a></td>
									<td>총 <strong class="point_c"><?=$total_cnt?></strong>건<br>(완료 <strong class="fcor0"><?=$plan_state_1+$plan_state_4?></strong>건 / 취소 <strong class="red"><?=$plan_state_2+$plan_state_3?></strong>건)
									</td>
								</tr>
<?
		$article_num--;
	}
?>
							</tbody>
						</table>
					</div>
				</div>

<?
	list_page_numbering_div($page_per_block,$page,$total_page,$where);
?>
			</div>

	</div>
	<!-- //container -->
	<? include ("../include/footer.php"); ?>
</div>
<!-- //wrap -->


</body>

</html>
