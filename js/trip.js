var regExpEmail = /^([\w\.\_\-])*[a-zA-Z0-9]+([\w\.\_\-])*([a-zA-Z0-9])+([\w\.\_\-])+@([a-zA-Z0-9]+\.)+[a-zA-Z0-9]{2,8}$/;
var regExpHp = /^\d{3}-\d{3,4}-\d{4}$/;

function price_cal() {

	var frm=document.send_form;

	if (tripType=="2") {
		
		 if(frm.nation.value=="" && frm.nation_search.value != ""){
				alert('입력하신 여행국가는 인수제한 국가이거나, 국가명 오류 입력으로 확인됩니다.\n인수제한 국가 확인 및 정확한 국가명 입력을 부탁드립니다.');
			return false;
		} else if (frm.nation.value=="" && frm.nation_search.value == "") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}
	}

	if (frm.trip_purpose.value=="") {
		alert('여행목적을 선택해 주세요.');
		return false;
	}

	if (frm.trip_purpose.value=="3") {
		alert('운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.\n\n다음 단계로 진행이 불가합니다.');
		return false;
	}

	if (frm.start_date.value=="") {
		alert('출발일을 선택해 주세요.');
		return false;
	}

	if (frm.end_date.value=="") {
		alert('도착일을 선택해 주세요.');
		return false;
	}

	var input_length=$("input[name='input_name[]']").length;
	
	for (var i=0;i<input_length;i++) {
		if ($("input[name='input_name[]']").eq(i).val()=="") {
			alert('이름을 입력하세요.');
			return false;
		}

		str = $("input[name='input_name[]']").eq(i).val();
		check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if (!check.test(str)) {
			alert("한글이름을 입력하세요.");
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('주민번호 앞자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="6") {
			alert('주민번호 앞자리를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val()=="") {
			alert('주민번호 뒷자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val().length!="7") {
			alert('주민번호 뒷자리를 정확히 입력하세요.');
			return false;
		}
	}
/*
	if ($("input[name='hphone1[]']").eq(0).val()=="" || $("input[name='hphone2[]']").eq(0).val()=="" || $("input[name='hphone3[]']").eq(0).val()=="") {
		alert('대표가입자 연락처를 입력하세요.');
		return false;
	}

	if ($("input[name='hphone1[]']").eq(0).val().length < 3) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone2[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone3[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}
*/

	let hp_check_txt =  $("select[name=hphone1] option:selected").val() + "-" + $("input[name='hphone2[]']").eq(0).val() + "-" + $("input[name='hphone3[]']").eq(0).val();

	if (!regExpHp.test(hp_check_txt)) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	let email_txt = $("input[name='email1[]']").eq(0).val() + "@" + $("input[name='email2[]']").eq(0).val();

	if (!regExpEmail.test(email_txt)) {
		alert('대표가입자 이메일을 정확히 입력하세요.');
		return false;
	}

	var plan_type=$(":input:radio[name=plan_type]:checked").val();

	if (plan_type=="") {
		alert('보험 종류를 선택해 주세요.');
		return false;
	}
	
	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	$.ajax({
		type : "POST",
		url : "/tscommon/src/price_cal.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");

			if (json.result=="true") {

				total_won=json.total_price_val;

				$(".total_won_1").html(json.total_price);
				$(".total_won_2").html(json.total_price+"원");
				$("#select_cnt").html(input_length+"명");

				$(".plan_tr").removeClass("tr_select");

				if( isMobile.any() ) {
					$(".plan_tr").css("display","none");
				}

				var sel_cnt=0;

				$.each(json.msg,function(key,state){
					$(".pl_code").eq(key).html(state.plan_title);
					$(".pl_price").eq(key).html(state.price+"원");

					$("."+state.plan_code).addClass("tr_select");

					if( isMobile.any() ) {
						$("."+state.plan_code).css("display","");
					}

					sel_cnt++;
				});
				
				if( isMobile.any() ) {
					if (sel_cnt > 1) {
						var min_width = 160 + (parseInt(sel_cnt)*130);
						$(".table_line2").css("min-width",min_width+"px");
					}
				}


				$(".last_selec, #showplan").show();
				$(".hiddenplan").hide();
				var aa = $(".last_selec").offset().top;

				$("#loading_area").delay(300).fadeOut();
				return false;
			} else {
				alert(json.msg);
				view_reset();
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

function insuterminator() {
	var frm=document.send_form;

	if (tripType=="2") {
		/*
		if (frm.nation.value=="") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}
		*/

		if(frm.nation.value=="" && frm.nation_search.value != ""){
				alert('입력하신 여행국가는 인수제한 국가이거나, 국가명 오류 입력으로 확인됩니다.\n인수제한 국가 확인 및 정확한 국가명 입력을 부탁드립니다.');
			return false;
		} else if (frm.nation.value=="" && frm.nation_search.value == "") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}
	}


	if (frm.trip_purpose.value=="") {
		alert('여행목적을 선택해 주세요.');
		return false;
	}

	if (frm.trip_purpose.value=="3") {
		alert('운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.\n\n다음 단계로 진행이 불가합니다.');
		return false;
	}

	if (frm.start_date.value=="") {
		alert('출발일을 선택해 주세요.');
		return false;
	}

	if (frm.end_date.value=="") {
		alert('도착일을 선택해 주세요.');
		return false;
	}

	var input_length=$("input[name='input_name[]']").length;
	
	for (var i=0;i<input_length;i++) {
		if ($("input[name='input_name[]']").eq(i).val()=="") {
			alert('이름을 입력하세요.');
			return false;
		}

		str = $("input[name='input_name[]']").eq(i).val();
		check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if (!check.test(str)) {
			alert("한글이름을 입력하세요.");
			return false;
		}
		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('주민번호 앞자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="6") {
			alert('주민번호 앞자리를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val()=="") {
			alert('주민번호 뒷자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val().length!="7") {
			alert('주민번호 뒷자리를 정확히 입력하세요.');
			return false;
		}

		/* 영주권자 해당국가 입력 처리*/
			a = $("input[name='jumin_2[]']").eq(i).val().substring(0,1);
//			alert(a);
			if ((a==5 || a==6 ||a==7 || a==8)&&($("input[name='nation_name[]']").eq(i).val()==""))
			{
				alert('영주권자 혹은 이중국적자의 경우 해당국가을 입력하여 주시기 바랍니다.');
				return false;
			}
		/* 영주권자 해당국가 입력 처리 끝*/

	}
/*	
	if ($("input[name='hphone1[]']").eq(0).val()=="" || $("input[name='hphone2[]']").eq(0).val()=="" || $("input[name='hphone3[]']").eq(0).val()=="") {
		alert('대표가입자 연락처를 입력하세요.');
		return false;
	}

	if ($("input[name='hphone1[]']").eq(0).val().length < 3) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone2[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone3[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}
*/
	let hp_check_txt =  $("select[name=hphone1] option:selected").val() + "-" + $("input[name='hphone2[]']").eq(0).val() + "-" + $("input[name='hphone3[]']").eq(0).val();

	if (!regExpHp.test(hp_check_txt)) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	let email_txt = $("input[name='email1[]']").eq(0).val() + "@" + $("input[name='email2[]']").eq(0).val();

	if (!regExpEmail.test(email_txt)) {
		alert('대표가입자 이메일을 정확히 입력하세요.');
		return false;
	}
	
	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	view_reset();

	$.ajax({
		type : "POST",
		url : "/tscommon/src/insurance_cal.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");

			if (json.result=="true") {
				var add_html="";

				$.each(json.msg,function(key,state){
					add_html=add_html+"<li><label><input type=\"radio\" value=\""+state.plan_type+"\" name=\"plan_type\">"+state.plan_title+"</label></li>";
				});
				
				$("#insurance_type").html(add_html).promise().done(function(){
					$('input[type="radio"]').ezMark();

					//2022-03-28 - 기본으로 첫번재 값이 출력되도록 추가
					$(":input:radio[name=plan_type]").eq(0).prop('checked', true);
					$("#insurance_type li").children('label').eq(0).addClass('ez-selected');
					//보험료 계산
					price_cal();
					//2022-03-28 - 보장내용 기본으로 보여주기
					$(".toggle_bt > button").removeClass("on").html("닫기");
					$(".toggle_layer").slideDown(300);
					//2022-03-28 수정 끝

					$(":input:radio[name=plan_type]").click(function() {
						//유형 선택시 보험료 재계산
						price_cal();
					});
					
					$(".join_step > ol > li:nth-child(1)").removeClass("on");
					$(".join_step > ol > li:nth-child(2)").addClass("on");
					$(".join_type").show();
					$(".execute_bt > button").addClass("disable");

					$(".last_selec, #showplan").hide();
					$(".hiddenplan").show();

				});

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

function submitInsu(){
	var frm=document.send_form;

	if (tripType=="2") {
		/*
		if (frm.nation.value=="") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}
		*/
			 if(frm.nation.value=="" && frm.nation_search.value != ""){
				alert('입력하신 여행국가는 인수제한 국가이거나, 국가명 오류 입력으로 확인됩니다.\n인수제한 국가 확인 및 정확한 국가명 입력을 부탁드립니다.');
			return false;
		} else if (frm.nation.value=="" && frm.nation_search.value == "") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}
	}

	if (frm.trip_purpose.value=="") {
		alert('여행목적을 선택해 주세요.');
		return false;
	}

	if (frm.trip_purpose.value=="3") {
		alert('운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.\n\n다음 단계로 진행이 불가합니다.');
		return false;
	}

	if (frm.start_date.value=="") {
		alert('출발일을 선택해 주세요.');
		return false;
	}

	if (frm.end_date.value=="") {
		alert('도착일을 선택해 주세요.');
		return false;
	}

	var input_length=$("input[name='input_name[]']").length;
	
	for (var i=0;i<input_length;i++) {
		if ($("input[name='input_name[]']").eq(i).val()=="") {
			alert('이름을 입력하세요.');
			return false;
		}

		str = $("input[name='input_name[]']").eq(i).val();
		check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if (!check.test(str)) {
			alert("한글이름을 입력하세요.");
			return false;
		}
		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('주민번호 앞자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="6") {
			alert('주민번호 앞자리를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val()=="") {
			alert('주민번호 뒷자리를 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_2[]']").eq(i).val().length!="7") {
			alert('주민번호 뒷자리를 정확히 입력하세요.');
			return false;
		}
	}
/*
	if ($("input[name='hphone1[]']").eq(0).val()=="" || $("input[name='hphone2[]']").eq(0).val()=="" || $("input[name='hphone3[]']").eq(0).val()=="") {
		alert('대표가입자 연락처를 입력하세요.');
		return false;
	}

	if ($("input[name='hphone1[]']").eq(0).val().length < 3) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone2[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	if ($("input[name='hphone3[]']").eq(0).val().length < 4) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}
*/

	let hp_check_txt =  $("select[name=hphone1] option:selected").val() + "-" + $("input[name='hphone2[]']").eq(0).val() + "-" + $("input[name='hphone3[]']").eq(0).val();

	if (!regExpHp.test(hp_check_txt)) {
		alert('대표가입자 연락처를 정확히 입력하세요.');
		return false;
	}

	let email_txt = $("input[name='email1[]']").eq(0).val() + "@" + $("input[name='email2[]']").eq(0).val();

	if (!regExpEmail.test(email_txt)) {
		alert('대표가입자 이메일을 정확히 입력하세요.');
		return false;
	}

	var plan_type=$(":input:radio[name=plan_type]:checked").val();

	if (plan_type=="") {
		alert('보험 종류를 선택해 주세요.');
		return false;
	}

	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	$.ajax({
		type : "POST",
		url : "/tscommon/src/tmp_process.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");

			if (json.result=="true") {
				location.href="step04.php";

				$("#loading_area").delay(300).fadeOut();
				return false;
			} else {
				alert(json.msg);
				view_reset();
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