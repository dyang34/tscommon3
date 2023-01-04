<? 
	include ("../include/top.php"); 
	include ("../include/link_session_check.php");
?>
<script>
	var oneDepth = 4; //1차 카테고리
	
	function check_form() {

		var frm=document.send_form;

		if (frm.search_name.value=="") {
			alert('이름을 입력하세요.');
			$("#search_name").focus();
			return false;
		}

		if(frm.search_hphone.value=='') {
			alert('휴대폰번호를 입력하여 주십시오.');
			frm.search_hphone.focus();
			return false;
		}

		if(frm.search_hphone.value.length < 11) {
			alert('휴대폰번호를 정확히 입력하여 주십시오.');
			frm.search_hphone.focus();
			return false;
		}


		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "../src/gift_plan_login_check.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					location.href="list.php";
					$("#loading_area").css({"display":"none"});
					return false;
				} else {
					alert('일치하는 정보가 없습니다'); 
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
				<h3 class="step_tit"><strong>내가 선물한 내역 확인하기</strong></h3>
				
				
<form name="send_form" id="send_form">				
				<div class="gray_box">

					<div class="step_select one" style="max-width:500px; margin:0 auto;">
						<div class="select_ds">
							<label class="ss_tit db mt0">신청자명</label>
							<input type="text" class="input" placeholder="" name="search_name" id="search_name">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">휴대폰번호</label>
						   <input type="number" oninput="maxLengthCheck(this)" class="input onlyNumber" value="" name="search_hphone" id="search_hphone" maxlength="11" placeholder="01000000000">
						</div>
					</div>
				</div>
				<div class="btn-tc">
					<a href="javascript:void(0);" onclick="check_form();" class="btnBig m_block"><span>조회하기</span></a>
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
