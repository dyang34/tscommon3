<? 
	include ("../include/top.php"); 
	include ("../include/hana_check.php"); 
?>

<script>
	var oneDepth = 2; //1차 카테고리

	function form_submit() {
		var frm=document.send_form;

		if (frm.start_date.value=="") {
			alert('출발일을 선택해 주세요.');
			return false;
		}

		if (frm.end_date.value=="") {
			alert('도착일을 선택해 주세요.');
			return false;
		}

		if (frm.birth_date.value=="") {
			alert('생년월일을 입력하세요.');
			frm.birth_date.focus();
			return false;
		}

		if ($("#birth_date").val().length!="8") {
			alert('생년월일을 정확히 입력하세요.');
			return false;
		}

		if (frm.name.value=="") {
			alert('이름을 입력하세요.');
			frm.name.focus();
			return false;
		}

		if (frm.jumin_1.value=="") {
			alert('주민등록번호(외국인등록번호) 앞자리를 입력하세요.');
			frm.jumin_1.focus();
			return false;
		}

		if ($("#jumin_1").val().length!="6") {
			alert('주민등록번호(외국인등록번호) 앞자리를 정확히 입력하세요.');
			return false;
		}

		if (frm.jumin_2.value=="") {
			alert('주민등록번호(외국인등록번호) 뒷자리를 입력하세요.');
			frm.jumin_2.focus();
			return false;
		}

		if ($("#jumin_2").val().length!="7") {
			alert('주민등록번호(외국인등록번호) 뒷자리를 정확히 입력하세요.');
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

		if(frm.email1.value=='') {
			alert('이메일을 입력하여 주십시오.');
			frm.email1.focus();
			return false;
		}

		var eamil_address = frm.email1.value+"@"+frm.email2.value;

		if(!emailCheck(eamil_address)){
			alert("이메일을 정확히 입력해 주세요.");
			$('input[name=email2]').focus();
			return false; 
		}

		if(frm.cur_nation.value=='') {
			alert('현재 체류지를 선택하세요.');
			frm.cur_nation.focus();
			return false;
		}

		if(frm.cur_nation.value=='2') {
			alert('현재 해외에 체류중인 경우 가입이 불가합니다.');
			frm.cur_nation.focus();
			return false;
		}

		if(frm.trip_purpose.value=='') {
			alert('여행목적을 선택하세요.');
			frm.trip_purpose.focus();
			return false;
		}

		if(frm.trip_purpose.value=='3') {
			alert("운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.");
			frm.trip_purpose.focus();
			return false;
		}

		if(frm.nation.value=='') {
			alert('여행국가/지역을 선택하세요.');
			frm.nation.focus();
			return false;
		}

		if(frm.nation_etc.value=='') {
			alert('여행국가/지역 지역명을 입력하세요.');
			frm.nation_etc.focus();
			return false;
		}

		$("#auth_token").val(auth_token);
		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "../src/study_abroad_process.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					location.href="complete.php";
					$("#loading_area").delay(300).fadeOut();
					return false;
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
		var today = new Date();
		var tomorrow = new Date(Date.parse(today) + (1000 * 60 * 60 * 24));

		$("#start_date").datepicker({
			showOn: "both",
			dateFormat: "yy-mm-dd",
			buttonImage: "../img/common/ico_cal.png",
			buttonImageOnly: true,
			showOtherMonths: true,
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			buttonText: "Select date",
			minDate: today,
			onClose: function( selectedDate ) {    
				$("#end_date").val("");
				$("#end_date").datepicker("enable");
				//$("#end_date").datepicker( "option", "minDate", new Date(Date.parse(selectedDate) + (1000 * 60 * 60 * 24)) );
				$("#end_date").datepicker( "option", "minDate", new Date(Date.parse(treemonthcal(selectedDate,'3'))));
			}         
		});

		$(" #end_date").datepicker({
			showOn: "both",
			dateFormat: "yy-mm-dd",
			buttonImage: "../img/common/ico_cal.png",
			buttonImageOnly: true,
			showOtherMonths: true,
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			buttonText: "Select date",
			minDate: tomorrow              
		});

		$("#end_date").datepicker("disable");
	});


	function trip_purpose_change(select_val) {
		if (select_val=="3") {
			alert("운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.");
			return false;
		}
	}


	function curr_stay_change(select_val) {
		if (select_val=="2") {
			alert("현재 해외에 체류중인 경우 보험가입이 불가합니다.");
			return false;
		}
	}

	function treemonthcal(kind, kind1){
		var start_date = kind;
		var data_arr = start_date.split('-');
		var hap_year;
		var hap_month;
		var gap_month;
		var enddate;
		var gap_day;

		 hap_month = Number(data_arr[1]) + Number(kind1);
		 //console.log(hap_month);
		 if(hap_month > 12){
			//gap_month = hap_month - Number(data_arr[1]);
			gap_month = hap_month - 12;

			//console.log('차이: '+gap_month);
		  hap_year = Number(data_arr[0]) + 1;
		 } else {
			gap_month = hap_month;
		  hap_year = Number(data_arr[0]);
		 }
		
		// 2019-08-21 추가 분 -  월을 분리해서 사용하는 중에 10보다 작은 월에 0을 붙여야 한다. (안붙이면 오류)	
		 if(gap_month < 10){
			gap_month = "0"+gap_month;
		 } 

		var lastDay = ( new Date(hap_year, gap_month,'')).getDate().toString();

		if(data_arr[2] > lastDay){
			gap_day = lastDay;
		} else {
			gap_day = data_arr[2];
		}
		//console.log('종료 일자 : '+lastDay);
		enddate = hap_year+"-"+gap_month+"-"+gap_day;
		//console.log('종료일 : '+enddate);
		return enddate;
	}
	
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include ("../include/header.php"); ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<h3 class="step_tit">신청서를 작성해주세요</h3>


<form id="send_form" name="send_form">
<input type="hidden" id="auth_token" name="auth_token" readonly>

				<div class="gray_box">
					<div class="step_select two">
						<div class="select_ds cb">
							<label class="ss_tit">출발일</label>
							<div class="col-sm-2">
								<div class="select_ds pr10" style="width:65%;">
									<div class="date_picker">
										<input type="text" class="input" name="start_date" id="start_date" readonly>
									</div>
								</div>
								<div class="select_ds pl10" style="width:35%;">
									<select name="start_hour" id="start_hour" class="select">
										 <? for ($i=0;$i<24;$i++) { ?>
										 <option value="<?=sprintf("%02d", $i)?>"><?=sprintf("%02d", $i)?>시</option>
										 <? } ?>
									</select>
								</div>

							</div>
						</div>
						<div class="select_ds cb">
							<label class="ss_tit">도착일</label>
							<div class="col-sm-2">
								<div class="select_ds pr10" style="width:65%;">
									<div class="date_picker">
										<input type="text" class="input" name="end_date" id="end_date" readonly>
									</div>
								</div>
								<div class="select_ds pl10" style="width:35%;">
									<select name="end_hour" id="end_hour" class="select">
										 <? for ($i=1;$i<25;$i++) { ?>
										 <option value="<?=sprintf("%02d", $i)?>"><?=sprintf("%02d", $i)?>시</option>
										 <? } ?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="step_select two">
						<div class="select_ds cb">
							<label class="ss_tit db">생년월일</label>
							<input type="text" class="input" name="birth_date" id="birth_date" placeholder="생년월일 (19900101)" maxlength="8">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">성별</label>
							<ul class="radio_group pt10">
								<li><label class="radio"><input type="radio" name="sex" value="1" checked="">남자</label></li>
								<li><label class="radio"><input type="radio" name="sex" value="2">여자</label></li>

							</ul>
						</div>
					</div>

					<div class="step_select two">
						<div class="select_ds cb">
							<label class="ss_tit db">이름</label>
							<input type="text" class="input" name="name" placeholder="이름">
						</div>
						<div class="select_ds">
							<label class="ss_tit db">주민등록번호 (외국인등록번호)</label>
							<div class="col-sm-2">
								<div class="select_ds pr10">
									<input type="tel" name="jumin_1" id="jumin_1" value="" placeholder="" class="onlyNumber input" maxlength="6">
									<span class="pa_minus">-</span>
								</div>
								<div class="select_ds pl5">
									<input type="password" name="jumin_2" id="jumin_2" value="" placeholder="" class="onlyNumber input" maxlength="7">
								</div>

							</div>
						</div>
					</div>

					<div class="step_select two">
						<div class="select_ds cb">
							<label class="ss_tit db">휴대폰 번호</label>
							<div class="col-sm-3 tel">
								<div class="select_ds pr10">
									<input type="text" class="input onlyNumber" size="9" title="휴대전화 식별번호를 넣어주세요." maxlength="4" id="hphone1" style="width:100%" value="" name="hphone1">
									<span class="pa_minus">-</span> </div>
								<div class="select_ds pl5 pr10">
									<input type="text" class="input onlyNumber" size="9" title="휴대전화 앞자리를 넣어주세요." maxlength="4" value="" style="width:100%" name="hphone2">
									<span class="pa_minus">-</span>
								</div>
								<div class="select_ds pl5">
									<input type="text" class="input onlyNumber" size="9" title="휴대전화 뒷자리를 넣어주세요." maxlength="4" value="" style="width:100%" name="hphone3">
								</div>


							</div>
						</div>
						<div class="select_ds">
							<label class="ss_tit db">이메일</label>
							<div class="col-sm-2">
								<div class="select_ds pr15">
									<input name="email1" value="" id="email1" class="input" style="width:100%;" placeholder="이메일" type="email">
									<span class="pa_minus">@</span> </div>
								<div class="select_ds pl5">
									<input name="email2" value="" id="email2" class="input" style="width:100%;" type="email">
								</div>

							</div>
						</div>
					</div>

					<div class="step_select two">
						<div class="select_ds cb">
							<label class="ss_tit db">현재 체류지</label>
							<select name="cur_nation" id="cur_nation" class="select" onchange="curr_stay_change(this.value);">
									<option value="">선택해주세요</option>
									<option value="1">국내</option>
									<option value="2">해외</option>
								</select>
							<p class="pt10"><strong><font color="red">* 현재 체류지가 해외일 경우 국내 보험사 인수 불가합니다.</font></strong></p>
						</div>
						<div class="select_ds">
							<label class="ss_tit db">여행목적</label>
							<select name="trip_purpose" id="trip_purpose" class="select" onchange="trip_purpose_change(this.value);">
								<option value="">선택해주세요</option>
<? for ($i=1;$i<=count($trip_purpose_long_term_array);$i++) { ?>
								<option value="<?=$i?>"><?=$trip_purpose_long_term_array[$i]?></option>
<? } ?>
							</select>
						</div>
					</div>

					<div class="step_select one">
						<div class="select_ds cb">
							<label class="ss_tit db">여행국가/지역</label>
							<div class="col-sm-2">
								<div class="select_ds pr10">
									<select name="nation" id="nation" class="select">
										<option value="">선택해주세요</option>
<?
	$sql_nation="select * from nation where use_type='Y' order by nation_name asc";
	$result_nation=mysql_query($sql_nation) or die(mysql_error());
	while($row_nation=mysql_fetch_array($result_nation)) {
?>
										<option value="<?=$row_nation['no']?>"><?=$row_nation['nation_name']?></option>
<?
	}
?>
									</select>
								</div>
								<div class="select_ds pl10">
									<input type="text" name="nation_etc" id="nation_etc" class="input" placeholder="지역명을 직접 입력하여 주세요">
								</div>

							</div>
						</div>

					</div>
					
					<div class="step_select one">
						<div class="select_ds cb">
							<label class="ss_tit db">추가 요청사항 (요청 담보 있을 경우 / 가족 단위 설계 시 기재)</label>
							<textarea name="content" class="textarea" rows="6" cols="100" style="width:100%; height:100px;"></textarea>
						</div>

					</div>

				</div>

				<div class="btn-tc">

					<a href="javascript:void(0);" onclick="form_submit();" class="btnBig m_block"><span>신청</span></a>
				</div>
</form>

			</div>

	</div>
	<!-- //container -->
	<? include $common_root_dir."/include/footer.php"; ?>
</div>
<!-- //wrap -->

</body>
</html>