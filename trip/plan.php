<script>
	function view_pop(plan_type,tripType,thai_chk) {
		$.ajax({
			type : "POST",
			url : "../src/plan_type_view.php",
			data :  { "plan_type" : plan_type , "tripType" : tripType , "thai_chk" : thai_chk , "auth_token" : auth_token },
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					$("#pop_title").html(json.msg_title);
					$("#pop_content").html(json.msg);
					ViewlayerPop(0);

					$("#loading_area").delay(100).fadeOut();
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
		if( isMobile.any() ) {
			$(".plan_s_width").css("width","160px");
			$(".m_view_p").css("display","block");

			$(".plan_tr").css("width","20%");
		}
	});

	function f_toggle(){
		if ($(".toggle_layer").css('display') != "none") {
			$(".toggle_bt > button").addClass("on").html("열기");		
			$(".toggle_layer").slideUp(300);	
		} else {
			$(".toggle_bt > button").removeClass("on").html("닫기");
			$(".toggle_layer").slideDown(300);
		}
	}
</script>

<script>
//  function delete_row() {
//    var my_tbody = document.getElementById('my-tbody');
//    if (my_tbody.rows.length < 1) return;
//	  my_tbody.deleteRow(0); // 상단부터 삭제
//    my_tbody.deleteRow( my_tbody.rows.length-1 ); // 하단부터 삭제
//  }

	function dis(id){
//		alert(id);
//	if($('#dis').css('display') == 'none'){
//	$('#dis').show();
// }else{
//            $('#id').hide();
//			$('#id').attr('style', "display:none;");  //숨기기
		con=document.getElementById(id);
		con.style.display='none';
//	}
        }	
</script>

	<div id="showplan" style="display:none;">
	<p class="toggle_bt">
		<button type="button" onclick="f_toggle();" class="on">열기</button>
	</p>
	<p id="hiddenplan" class="m_view_p" style="display:none;">* 좌우로 드래그하여 보장금액을 확인해 주세요.</p>
	<div class="toggle_layer" style="display:none;">
	
		<div class="table_line2" style="min-width:100%;">
			<table class="table_style1 plan_table" style="font-size:0.95em" id="my-tbody">
				
				<thead>
					<tr>
						<th style="width:%;" class="plan_s_width">
							플랜명 (보험나이)
						</th>
	<? 

		include_once $root_dir."/config/get_site_config_member_no.php";

		$td_cnt=1;
		$plan_array=array();

		if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
			$sql_code="select * from plan_code_hana where trip_type='".$tripType."' and company_type = 1 and member_no='".$site_config_member_no."'";
		}

		if(strcmp($thai_chk,'thaiPass') === 0){
			$sql_code="select * from plan_code_hana_thai where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'kamboPass') === 0){
			$sql_code="select * from plan_code_hana_kam where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'indonPass') === 0){
			$sql_code="select * from plan_code_hana_indonesia where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'philPass') === 0){
			$sql_code="select * from plan_code_hana_phil where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'malaPass') === 0) {
			$sql_code="select * from plan_code_hana_mala where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'thaiPass5') === 0) {
			$sql_code="select * from plan_code_hana_thai_5 where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'thaiPass1') === 0) {
			$sql_code="select * from plan_code_hana_thai_1 where trip_type='".$tripType."' ";
		}

//		echo $sql_code;
		$result_code=mysql_query($sql_code);
		while($row_code=mysql_fetch_array($result_code)) {

			$plan_array[$td_cnt]['plan_code']=$row_code['plan_code'];
						
			if( strtotime('2021-08-17 21:59:59') <= time() ) {
				$type_count = 35;
			} else {
				$type_count = 27; //27
			}

			for ($i=1;$i<$type_count;$i++) { 
				$plan_array[$td_cnt]['type_'.$i]=$row_code['type_'.$i];
			}

		//한글만 나오게
		$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';		
		if(strcmp($thai_chk,'thaiPass1') === 0) {
			$plan_title = $row_code['plan_title'];
		}else{
			preg_match_all($pattern, $row_code['plan_title'], $match);
			$plan_title = implode('', $match[0]);
		}

	?>
						<th style="text-align:center;width:10%;" class="plan_tr <?=$row_code['plan_code']?>">
							<?=stripslashes($plan_title)?> (<?=stripslashes($row_code['plan_start_age'])?>~<?=stripslashes($row_code['plan_end_age'])?>)
						</th>
	<?
			$td_cnt++;
		}
	?>

					</tr>
				</thead>
				<tbody>
	<? 
		$tr_cnt=1;
		$tr_cnt1=1;		
		if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
			$sql_title="select * from plan_code_type_hana where trip_type='".$tripType."' and company_type = 1 and member_no='".$site_config_type_member_no."'";
		}

		if(strcmp($thai_chk,'thaiPass') === 0) {
			$sql_title="select * from plan_code_type_hana_thai where trip_type='".$tripType."' ";
		}
		if(strcmp($thai_chk,'kamboPass') === 0){
			$sql_title="select * from plan_code_type_hana_kam where trip_type='".$tripType."' ";
		}
		if(strcmp($thai_chk,'indonPass') === 0){
			$sql_title="select * from plan_code_type_hana_indonesia where trip_type='".$tripType."' ";
		}
		if(strcmp($thai_chk,'philPass') === 0){
			$sql_title="select * from plan_code_type_hana_phil where trip_type='".$tripType."' ";
		}
		if(strcmp($thai_chk,'malaPass') === 0){
			$sql_title="select * from plan_code_type_hana_mala where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'thaiPass5') === 0){
			$sql_title="select * from plan_code_type_hana_thai_5 where trip_type='".$tripType."' ";
		}

		if(strcmp($thai_chk,'thaiPass1') === 0){
			$sql_title="select * from plan_code_type_hana_thai_1 where trip_type='".$tripType."' ";
		}

		$result_title=mysql_query($sql_title);
		while($row_title=mysql_fetch_array($result_title)) {
			$total_table_price = 0;
			$total_table_price1 = 0;

			for ($i=1;$i<$td_cnt;$i++) { 
					$table_price1=kor_won($plan_array[$i]['type_'.$tr_cnt]);
					$total_table_price1 = $total_table_price1+$table_price1;
					$tr_cnt1++;
//					echo $total_table_price1;
//					echo "<br>";
				}
		if ($total_table_price1 > 0)
			{
	?>
					<tr id="deltr<?=$tr_cnt?>">
						<td class="tl plan_s_width"><button type="button" class="q_bt" onclick="view_pop('<?=$row_title[plan_type]?>','<?=$tripType?>','<?=$thai_chk?>');"><?=stripslashes($row_title['title'])?></button> </td>
	<?
			for ($i=1;$i<$td_cnt;$i++) { 
				if ($plan_array[$i]['type_'.$tr_cnt]=="0" || $plan_array[$i]['type_'.$tr_cnt]=="") {
					$table_price="";
				} else {
					/*
					if ($plan_array[$i]['type_'.$tr_cnt]>=100000000) {
						$table_price=kor_won($plan_array[$i]['type_'.$tr_cnt]);
					} else {
						$table_price=number_format($plan_array[$i]['type_'.$tr_cnt]);
					}
					*/

					$table_price=kor_won($plan_array[$i]['type_'.$tr_cnt]);
					$total_table_price = $total_table_price+$table_price;

				}
	?>
						<td style="text-align:right;width:10%;" class="plan_tr <?=$plan_array[$i]['plan_code']?>"><?=$table_price?></td>
	<?
			}
	?>
					</tr>
					<?}?>
	<?
			if ($total_table_price==0)
			{
			$deltrid="deltr".$tr_cnt;
?>
	<script>
//		delete_row();
//		dis('<?=$deltrid?>');
	</script>
	<?}?>
		<?
			$tr_cnt++;
		}
	?>

				</tbody>
			</table>
		</div>
	</div>
</div>