<? 
	include "../include/top.php";
	include_once $root_dir."/config/get_site_config_member_no.php";
	
	if(empty($_SESSION['s_session_key'])) {
		$_SESSION['s_session_key'] = $_POST[ "param_opt_1"     ];
	}

	include "../include/hana_check.php";

	$o_num = time()."_".rand(10000,99999);

	$sql_check="select * from hana_plan_tmp where member_no='".$member_no."' and session_key='".$_SESSION['s_session_key']."'";
	$result_check=mysql_query($sql_check);
	$row_check=mysql_fetch_array($result_check);

	if ($row_check['no']=='') {
?>
<script>
	alert('세션정보가 삭제 되었습니다.\n다시 시도해 주세요.');
	location.href="../trip/01.php";
</script>
<?
		exit;
	}

	//2020-02-06 결제일이 여행 시작일 보다 이후 이면 안됨 필터링 박우철
	$dateover = true;
	$compa_start = strtotime($row_check['start_date']);
	$compare_date = mktime(0,0,0,date('m'), date('d'), date('Y'));	
	if($compa_start < $compare_date){
		$dateover = false;
	} 
	//2020-02-06 결제일이 여행 시작일 보다 이후 이면 안됨 필터링 박우철
	
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
	 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
		$sql_code="select plan_title from plan_code_hana where trip_type='".$tripType."' and company_type=1 and member_no='".$site_config_member_no."' and plan_type='".$plan_type."'";
	 }
	 
	if(strcmp($thai_chk,'thaiPass') === 0) {
		$sql_code="select plan_title from plan_code_hana_thai where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'kamboPass') === 0){	
		$sql_code="select plan_title from plan_code_hana_kam where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'indonPass') === 0){	
		$sql_code="select plan_title from plan_code_hana_indonesia where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'philPass') === 0){			
		$sql_code="select plan_title from plan_code_hana_phil where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'malaPass') === 0){			
		$sql_code="select plan_title from plan_code_hana_mala where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'thaiPass5') === 0) {
		$sql_code="select plan_title from plan_code_hana_thai_5 where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	if(strcmp($thai_chk,'thaiPass1') === 0) {
		$sql_code="select plan_title from plan_code_hana_thai_1 where trip_type='".$tripType."' and plan_type='".$plan_type."'";
	}

	$result_code=mysql_query($sql_code) or die(mysql_error());
	$row_code=mysql_fetch_array($result_code);

	$pattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]+/u';
	if(strcmp($thai_chk,'thaiPass1') === 0) {
		$plan_title = $row_code['plan_title'];
	}else{
		preg_match_all($pattern, $row_code['plan_title'], $match);
		$plan_title = implode('', $match[0]);
	}
	include "../bill_kcp/cfg/site_conf_inc.php";

	/* kcp와 통신후 kcp 서버에서 전송되는 결제 요청 정보 */
	$req_tx          = $_POST[ "req_tx"         ]; // 요청 종류         
	$res_cd          = $_POST[ "res_cd"         ]; // 응답 코드         
	$tran_cd         = $_POST[ "tran_cd"        ]; // 트랜잭션 코드     
	$ordr_idxx       = $_POST[ "ordr_idxx"      ]; // 쇼핑몰 주문번호   
	$good_name       = $_POST[ "good_name"      ]; // 상품명            
	$good_mny        = $_POST[ "good_mny"       ]; // 결제 총금액       
	$buyr_name       = $_POST[ "buyr_name"      ]; // 주문자명          
	$buyr_tel1       = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호   
	$buyr_tel2       = $_POST[ "buyr_tel2"      ]; // 주문자 핸드폰 번호
	$buyr_mail       = $_POST[ "buyr_mail"      ]; // 주문자 E-mail 주소
	$use_pay_method  = $_POST[ "use_pay_method" ]; // 결제 방법         
	$enc_info        = $_POST[ "enc_info"       ]; // 암호화 정보       
	$enc_data        = $_POST[ "enc_data"       ]; // 암호화 데이터     
	$cash_yn         = $_POST[ "cash_yn"        ];
	$cash_tr_code    = $_POST[ "cash_tr_code"   ];
	/* 기타 파라메터 추가 부분 - Start - */
	$param_opt_1    = $_POST[ "param_opt_1"     ]; // 기타 파라메터 추가 부분
	$param_opt_2    = $_POST[ "param_opt_2"     ]; // 기타 파라메터 추가 부분
	$param_opt_3    = $_POST[ "param_opt_3"     ]; // 기타 파라메터 추가 부분
	/* 기타 파라메터 추가 부분 - End -   */

	$tablet_size     = "1.0"; // 화면 사이즈 고정
	$url = $site_ssl."://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<script type="text/javascript" src="../js/approval_key.js"></script>
<script type="text/javascript">
	function call_pay_form() {
		var v_frm = document.order_info;
		
		if(v_frm.encoding_trans == undefined) {
			v_frm.action = PayUrl;
		} else {
			if(v_frm.encoding_trans.value == "UTF-8") {
				v_frm.action = PayUrl.substring(0,PayUrl.lastIndexOf("/")) + "/jsp/encodingFilter/encodingFilter.jsp";
				v_frm.PayUrl.value = PayUrl;
			} else {
				v_frm.action = PayUrl;
			}
		}

		if (v_frm.Ret_URL.value == "") {
			alert("연동시 Ret_URL을 반드시 설정하셔야 됩니다.");
			return false;
		} else {
			v_frm.submit();
		}
	}

	function chk_pay() {
		self.name = "tar_opener";
		var pay_form = document.pay_form;

		if (pay_form.res_cd.value == "3001" ) {
			alert("사용자가 취소하였습니다.");
			pay_form.res_cd.value = "";
		}

//		alert("here"+pay_form.ordr_idxx.value);
		if (pay_form.enc_info.value)
			pay_form.submit();
	}
</script>

<script>
	var oneDepth = 1; //1차 카테고리

	$(document).ready(function() {
		$(".join_step > ol > li:nth-child(4)").addClass("on");
		chk_pay();
	});
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include "../include/header.php"; ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<? include ("step.php"); ?>

<form name="order_info" method="post">
<input type="hidden" name="encoding_trans" value="UTF-8" readonly>
<input type="hidden" name="PayUrl"> 
<input type="hidden" id="pay_method" name="pay_method" value="CARD" readonly>
<input type="hidden" name="ordr_idxx" value="<?=$o_num?>" maxlength="40"/>
<input type="hidden" name="good_name" value="투어세이프 여행자보험"/>
<input type="hidden" name="good_mny" value="<?=$plan_price?>" maxlength="9"/>
<input type="hidden" name="buyr_name" value="<?=stripslashes($bill_name)?>"/>
<input type="hidden" name="buyr_mail" value="" maxlength="30">
<input type="hidden" name="buyr_tel1" value="<?=$bill_hphone?>">
<input type="hidden" name="buyr_tel2" value=""/>

<input type="hidden" name="req_tx"          value="pay">                           <!-- 요청 구분 -->
<input type="hidden" name="shop_name"       value="<?= $g_conf_site_name ?>">      <!-- 사이트 이름 --> 
<input type="hidden" name="site_cd"         value="<?= $g_conf_site_cd   ?>">      <!-- 사이트 코드 -->
<input type="hidden" name="currency"        value="410"/>                          <!-- 통화 코드 -->
<input type="hidden" name="eng_flag"        value="N"/>                            <!-- 한 / 영 -->
<!-- 결제등록 키 -->
<input type="hidden" name="approval_key"    id="approval">
<!-- 인증시 필요한 파라미터(변경불가)-->
<input type="hidden" name="escw_used"       value="N">
<input type="hidden" name="van_code"        value="">
<!-- 신용카드 설정 -->
<input type="hidden" name="quotaopt"        value="12"/>                           <!-- 최대 할부개월수 -->
<!-- 가상계좌 설정 -->
<input type="hidden" name="ipgm_date"       value=""/>
<!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
<input type="hidden" name="shop_user_id"    value=""/>
<!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
<input type="hidden" name="pt_memcorp_cd"   value=""/>
<!-- 현금영수증 설정 -->
<input type="hidden" name="disp_tax_yn"     value="Y"/>
<!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
<input type="hidden" name="Ret_URL"         value="<?=$url?>">
<!-- 화면 크기조정 -->
<input type="hidden" name="tablet_size"     value="<?=$tablet_size?>">

<!-- 추가 파라미터 ( 가맹점에서 별도의 값전달시 param_opt 를 사용하여 값 전달 ) -->
<input type="hidden" name="param_opt_1"     value="<?=$_SESSION['s_session_key']?>">
<input type="hidden" name="param_opt_2"     value="">
<input type="hidden" name="param_opt_3"     value="">
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
									<p class="table"><span class="point_c"><?=$type_array[$tripType]?><br>
									<? if(strcmp($thai_chk,'thaiPass') === 0) {
									echo "thai";
									}else{
									echo $plan_title;
									}
									?>
									</span></p>
								</div>
							</li>
						</ul>
					</div>

					<div class="btn-tc">
						<?
							if(!$dateover){
						?>
							<input name="" type="button" class="btnBig m_block" value="결제하기" onclick="alert('결제일시는 여행시작일보다 이전이어야 합니다. 여행시작일을 다시 체크해 주세요. ');history.go(-2);"/>
						<?
							} else {
						?>
						<input name="" type="button" class="btnBig m_block" value="카드 결제하기" onclick="alert('2020년 상반기 보안 프로토콜 업데이트에 따라서\n최신 버전이 아닌 브라우저에서는 결제 오류가\n발생 할 수 있습니다.\n최신버전의 브라우저를 사용해 주시기 바랍니다.');kcp_AJAX();"/>
						<?
						}
						?>
					</div>
</form>
			</div>
	</div>
	<!-- //container -->
	<? include "../include/footer.php"; ?>
</div>
<!-- //wrap -->

<form name="pay_form" method="post" action="../src/bill_hub_mobile.php">
    <input type="hidden" name="req_tx"         value="<?=$req_tx?>">               <!-- 요청 구분          -->
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">               <!-- 결과 코드          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">              <!-- 트랜잭션 코드      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">            <!-- 주문번호           -->
    <input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- 휴대폰 결제금액    -->
    <input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- 상품명             -->
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">            <!-- 주문자명           -->
    <input type="hidden" name="buyr_tel1"      value="<?=$buyr_tel1?>">            <!-- 주문자 전화번호    -->
    <input type="hidden" name="buyr_tel2"      value="<?=$buyr_tel2?>">            <!-- 주문자 휴대폰번호  -->
    <input type="hidden" name="buyr_mail"      value="<?=$buyr_mail?>">            <!-- 주문자 E-mail      -->
	<input type="hidden" name="cash_yn"		   value="<?=$cash_yn?>">              <!-- 현금영수증 등록여부-->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">
    <input type="hidden" name="use_pay_method" value="<?=$use_pay_method?>">
    <input type="hidden" name="cash_tr_code"   value="<?=$cash_tr_code?>">
    <!-- 추가 파라미터 -->
	<input type="hidden" name="param_opt_1"	   value="<?=$param_opt_1?>">
	<input type="hidden" name="param_opt_2"	   value="<?=$param_opt_2?>">
	<input type="hidden" name="param_opt_3"	   value="<?=$param_opt_3?>">
</form>

</body>
</html>