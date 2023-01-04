<? 
	include ("../include/top.php"); 
	include ("../include/link_session_check.php");

	$_SESSION['login_check_key_1']="";
	$_SESSION['login_check_key_2']="";
	$_SESSION['login_check_key_3']="";
	$_SESSION['login_check_key_4']="";
?>
<script>
	var oneDepth = 5; //1차 카테고리

	function check_form() {

		var frm=document.send_form;

		if (frm.search_key.value=="") {
			alert('선물번호를 입력하세요.');
			$("#search_key").focus();
			return false;
		}

		if (frm.search_name.value=="") {
			alert('이름을 입력하세요.');
			$("#search_name").focus();
			return false;
		}

		if(frm.search_birth.value=='') {
			alert('생년월일을 입력하여 주십시오.');
			frm.search_birth.focus();
			return false;
		}

		if(frm.search_birth.value.length != 8) {
			alert('생년월일을 정확히 입력하여 주십시오.');
			frm.search_birth.focus();
			return false;
		}

		if(frm.hphone1.value=='' || frm.hphone2.value=='' || frm.hphone3.value=='') {
			alert('휴대폰 번호를 입력하여 주십시오.');
			frm.hphone1.focus();
			return false;
		}

		if(frm.hphone1.value.length < 3) {
			alert('휴대폰 번호를 정확히 입력하여 주십시오.');
			frm.hphone1.focus();
			return false;
		}

		if(frm.hphone2.value.length < 3) {
			alert('휴대폰 번호를 정확히 입력하여 주십시오.');
			frm.hphone2.focus();
			return false;
		}

		if(frm.hphone3.value.length < 4) {
			alert('휴대폰 번호를 정확히 입력하여 주십시오.');
			frm.hphone3.focus();
			return false;
		}


		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "../src/gift_confirm_check.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					location.href="02.php";
					$("#loading_area").css({"display":"none"});
					return false;
				} else {
					alert(json.msg); 
					$("#loading_area").css({"display":"none"});
					return false;
				}
				
			},
			error : function(err)
			{
				alert(err.responseText);
				$("#loading_area").css({"display":"none"});
				return false;
			}
		});
	}
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<h3 class="step_tit"><strong>받은 선물 등록하기</strong></h3>
				<div class="gray_box">

<form name="send_form" id="send_form">

					<div class="step_select one" style="max-width:500px; margin:0 auto;">
						<div class="select_ds">
							<label class="ss_tit db mt0">선물번호</label>
							<input type="text" name="search_key" id="search_key" class="input" placeholder="">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">이름</label>
						   <input type="text" name="search_name" id="search_name" class="input" value="" name="">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">생년월일</label>
						   <input type="text" class="input" value="" name="search_birth" id="search_birth" placeholder="생년월일 (19900101)" maxlength="8">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">휴대폰 번호</label>
						   <div class="col-sm-3 tel">
								<div class="select_ds pr10">
									<input type="number" oninput="maxLengthCheck(this)" class="input onlyNumber" size="9" title="휴대전화 식별번호를 넣어주세요." maxlength="4" id="hphone1" style="width:100%" value="" name="hphone1">
									<span class="pa_minus">-</span> </div>
								<div class="select_ds pl5 pr10">
									<input type="number" oninput="maxLengthCheck(this)" class="input onlyNumber" size="9" title="휴대전화 앞자리를 넣어주세요." maxlength="4" value="" style="width:100%" name="hphone2">
									<span class="pa_minus">-</span>
								</div>
								<div class="select_ds pl5">
									<input type="number" oninput="maxLengthCheck(this)" class="input onlyNumber" size="9" title="휴대전화 뒷자리를 넣어주세요." maxlength="4" value="" style="width:100%" name="hphone3">
								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="btn-tc">
					<a href="javascript:void(0);" onclick="check_form();" class="btnBig m_block"><span>다음</span></a>
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
