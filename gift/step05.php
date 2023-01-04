<? 
	include ("../include/top.php"); 
	include ("../include/hana_check.php");
	include_once $root_dir."/config/get_site_config_member_no.php";

	$o_num = time()."_".rand(10000,99999);

	$sql_check="select * from hana_plan_tmp where member_no='".$member_no."' and session_key='".$_SESSION['s_session_key']."'";
	$result_check=mysql_query($sql_check);
	$row_check=mysql_fetch_array($result_check);

	if ($row_check['no']=='') {
?>
<script>
	alert('세션정보가 삭제 되었습니다.\n다시 시도해 주세요.');
	location.href="../gift/01.php";
</script>
<?
		exit;
	}

	$join_hphone=decode_pass($row_check['join_hphone'],$pass_key);
	
	$x=0;
	$plan_price=0;

	$sql_mem="select name,hphone,plan_price from hana_plan_member_tmp where tmp_no='".$row_check['no']."' order by no asc";
	$result_mem=mysql_query($sql_mem);
	while($row_mem=mysql_fetch_array($result_mem)) {
		$plan_price=$plan_price+$row_mem['plan_price'];

		if ($bill_name=="") {
			$bill_name=$row_mem['name'];
		}

		if ($bill_hphone=="") {
			$bill_hphone=decode_pass($row_mem['hphone'],$pass_key);
		}
	}

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
	

	 include "../bill_kcp/cfg/site_conf_inc.php";
?>
<script type="text/javascript">
		function m_Completepayment( FormOrJson, closeEvent ) 
        {
            var frm = document.send_form; 
            GetField( frm, FormOrJson ); 
          
            if( frm.res_cd.value == "0000" ) {
                frm.submit(); 
            } else  {
                alert( "[" + frm.res_cd.value + "] " + frm.res_msg.value );
                closeEvent();
            }
        }
</script>
<script type="text/javascript" src='<?=$g_conf_js_url?>'></script>
<script type="text/javascript">
	/* 표준웹 실행 */
	function jsf__pay( form )
	{
		try
		{
			KCP_Pay_Execute( form ); 
		}
		catch (e)
		{
			/* IE 에서 결제 정상종료시 throw로 스크립트 종료 */ 
		}
	}             
</script>
<script>
	var oneDepth = 4; //1차 카테고리

	$(document).ready(function() {
		$(".join_step > ol > li:nth-child(4)").addClass("on");
	});
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<? include ("step.php"); ?>

<form id="send_form" name="send_form" action="../src/gift_bill_hub.php" method="post">
<input type="hidden" id="auth_token" name="auth_token" readonly>

<input type="hidden" id="pay_method" name="pay_method" value="100000000000" readonly>
<input type="hidden" name="ordr_idxx" value="<?=$o_num?>" maxlength="40" readonly/>
<input type="hidden" name="good_name" value="투어세이프 여행자보험" readonly/>
<input type="hidden" name="good_mny" value="<?=$plan_price?>" maxlength="9" readonly/>
<input type="hidden" name="buyr_name" value="<?=stripslashes($bill_name)?>" readonly/>
<input type="hidden" name="buyr_mail" value="" maxlength="30" readonly>
<input type="hidden" name="buyr_tel1" value="<?=$bill_hphone?>" readonly>
<input type="hidden" name="buyr_tel2" value="" readonly/>
<input type="hidden" name="req_tx"          value="pay" />
<input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
<input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />
<input type="hidden" name="quotaopt"        value="12"/>
<input type="hidden" name="currency"        value="WON"/>
<input type="hidden" name="module_type"     value="<?=$module_type ?>"/>
<input type="hidden" name="res_cd"          value=""/>
<input type="hidden" name="res_msg"         value=""/>
<input type="hidden" name="enc_info"        value=""/>
<input type="hidden" name="enc_data"        value=""/>
<input type="hidden" name="ret_pay_method"  value=""/>
<input type="hidden" name="tran_cd"         value=""/>
<input type="hidden" name="use_pay_method"  value=""/>
<input type="hidden" name="ordr_chk"        value=""/>
<input type="hidden" name="cash_yn"         value=""/>
<input type="hidden" name="cash_tr_code"    value=""/>
<input type="hidden" name="cash_id_info"    value=""/>
<input type="hidden" name="session_key"    value="<?=$_SESSION['s_session_key']?>"/>
<input type="hidden" name="good_expr" value="0">
<input type="hidden" name="used_card_YN" value="Y"/>

<?
$billing_card_val = $billing_card_company_common;
if (defined('_TOURSAFE_SUBSITE_BILLING_CARD')) {
	if (_TOURSAFE_SUBSITE_BILLING_CARD=="TYPE_1") {
		$billing_card_val = $billing_card_company;
	}
}
?>
<input type="hidden" name="used_card" value="<?=$billing_card_val?>"/>

					<h3 class="step_tit"><strong>STEP 4.</strong> 보험료 결제를 하여 주세요. </h3>
					<div class="gray_box">
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
									<p class="table"><span class="point_c"><?=number_format($plan_price)?>원 </span></p>
								</div>
							</li>
							<li>
								<div class="box">상품유형<span class="ico"><img src="../img/pages/step4_ico06.png" alt=""></span>
									<p class="table"><span class="point_c"><?=$type_array[$tripType]?><br><?=$row_code['plan_title']?></span></p>
								</div>
							</li>
						</ul>
					</div>
					<div class="btn-tc">
						<input name="" type="button" class="btnBig m_block" value="카드 결제하기" onclick="jsf__pay(this.form);"/>
					</div>
</form>

			</div>

	</div>
	<!-- //container -->
	<? include ("../include/footer.php"); ?>
</div>
<!-- //wrap -->


</body>

</html>
