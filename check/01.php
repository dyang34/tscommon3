<? 
	include ("../include/top.php"); 
	include ("../include/link_session_check.php");
	$rand_num = sprintf("%06d",rand(000000,999999));
	$_SESSION['phone_check_session']=$rand_num;
?>

<script>
	var oneDepth = 3; //1차 카테고리

	function check_form() {

		var frm=document.send_form;

		if(frm.phone1.value=='') {
			alert('휴대폰 번호를 정확하게 입력해 주세요.');
			frm.phone1.focus();
			return false;
		}

		if(frm.phone2.value=='') {
			alert('휴대폰 번호를 정확하게 입력해 주세요.');
			frm.phone2.focus();
			return false;
		}

		if(frm.phone3.value=='') {
			alert('휴대폰 번호를 정확하게 입력해 주세요.');
			frm.phone3.focus();
			return false;
		}

		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "../src/plan_hp_check.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					alert('인증번호를 입력해 주세요.'); 
					$("#loading_area").css({"display":"none"});
					$("#r_hp").css({"display":"block"});
					var time = 180; //3분 설정
					var min = "";
					var sec = "";
					var x = setInterval(function() {
						min = parseInt(time/60); 
						sec = time%60; 
						document.getElementById("demo").innerHTML = min + "분" + sec + "초";
						time--;

						if (time < 0) {
							clearInterval(x); //setInterval() 실행을 끝냄
							document.getElementById("demo").innerHTML = "시간초과";
							alert('3분이 초과 되었습니다. 처음부터 다시 진행해 주세요'); 
							$("#r_hp").css({"display":"none"});
						}
					}, 1000);

					return false;
				} else {
					alert('일치하는 정보가 없습니다'); 
					 console.log('aaaaaaaaaaaaaa');
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

	function check_phone (){
		
		$("#loading_area").css({"display":"block"});
		$.ajax({
			type : "POST",
			url : "../src/plan_hp_confirm.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");
				if (json.result=="true") {
					alert('인증되었습니다.'); 
					location.href="list.php";
					$("#loading_area").css({"display":"none"});
					return false;
				} else {
					alert('인증번호가 일치하지 않습니다.'); 
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
<!-- //container -->
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
		<!-- //header -->

		<!-- container -->
		<div id="container">
			<h3 class="step_tit"><strong>가입내역 조회</strong></h3>
			<div class="gray_box">
				<form name="send_form" id="send_form">
				<input type="hidden" name="" value="<?=$rand_num?>">

				<div class="step_select one search">
					<div class="select_ds">
						<label class="ss_tit db">인증받으실 전화번호를 입력해 주세요</label>
						<div class="col-sm-3">
							<div class="select_ds pr10">
								<select class="select" name="phone1" id="phone1">
									<option value="010">010</option>
									<option value="011">011</option>
									<option value="016">016</option>
									<option value="017">017</option>
									<option value="018">018</option>
									<option value="019">019</option>
								</select>
								<span class="pa_minus">-</span>
							</div>							
							<div class="select_ds pl5 pr10">
								<input type="number" name="phone2" id="phone2" placeholder="" class="onlyNumber input" maxlength="5">
								<span class="pa_minus">-</span>
							</div>
							<div class="select_ds pl5">
								<input type="number" name="phone3" id="phone3" placeholder="" class="onlyNumber input" maxlength="5">
							</div>
						</div>
					</div>
					<div class="btn-tc">
						<a href="javascript:void(0);" onclick="check_form();" class="btnBig m_block"><span>인증번호받기</span></a>
					</div>

					<div class="select_ds search" id="r_hp" style="display:none">
						<label class="ss_tit db">수신받은 인증번호를 3분 이내로 입력해 주세요<div id="demo"></div></label>
						<div class="col-sm-2">
							<div class="select_ds pr10">
								<input type="number" oninput="maxLengthCheck(this)" name="phone_c" id="phone_c" placeholder="" class="onlyNumber input" maxlength="6" value="">
							</div>
							<div class="select_ds">
								<a href="javascript:void(0);" onclick="check_phone();" class="btnBig m_block"><span>인증</span></a>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- //container -->
	</div>
<? include ("../include/footer.php"); ?>
</div>
<!-- //wrap -->
</body>
</html>
