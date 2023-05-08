function insuterminator() {
	var frm=document.send_form;

		if(frm.nation.value=="" && frm.nation_search.value != ""){
				alert('입력하신 여행국가는 인수제한 국가이거나, 국가명 오류 입력으로 확인됩니다.\n인수제한 국가 확인 및 정확한 국가명 입력을 부탁드립니다.');
			return false;
		} else if (frm.nation.value=="" && frm.nation_search.value == "") {
			alert('여행국가를 선택해 주세요.');
			return false;
		}

	if (frm.trip_purpose.value=="") {
		alert('여행목적을 선택해 주세요.');
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

	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	view_reset();

	$.ajax({
		type : "POST",
		url : "/tscommon/srclt/insurance_cal.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");

			if (json.result=="true") {
				$(".last_selec,#showplan").show();

				$("#cal_type_id_1").html(json.cal_type_id_1);
				$("#cal_type_id_2").html(json.cal_type_id_2);
				$("#cal_type_id_3").html(json.cal_type_id_3);
				$("#cal_type_id_4").html(json.cal_type_id_4);

				cal_type_id[1]=json.cal_type_id_1;
				cal_type_id[2]=json.cal_type_id_2;
				cal_type_id[3]=json.cal_type_id_3;
				cal_type_id[4]=json.cal_type_id_4;

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

function plan_code_select(plan_code,cal_type,select_num) {
	if (cal_type_id[cal_type]==0) {
		alert('해당 연령의 가입자가 없습니다.');
		return false;
	}
	cal_type_code[cal_type]=plan_code;

	$(".plan_col_sel_"+cal_type).removeClass("on");
	$("#btob_"+select_num).addClass("on");

	$("#cal_type_"+cal_type+"_code").val(plan_code);

	price_cal();
}

function price_cal() {

	var frm=document.send_form;

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
	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	$.ajax({
		type : "POST",
		url : "/tscommon/srclt/price_cal.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");
			
			if (json.result=="true") {
				total_won=json.total_price_val;

				$("#b2b_price_table").html(json.b2b_price_table);

				$(".total_won_1").html(json.total_price);
				$(".total_won_2").html(json.total_price+"원");
				$("#select_cnt").html(json.select_cnt+"명");

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


function submitInsu(){
	var frm=document.send_form;

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

	if (frm.trip_purpose.value=="") {
		alert('여행목적을 선택해 주세요.');
		return false;
	}

/*
	if (frm.trip_purpose.value=="3") {
		alert('운동경기/위험활동/기타의 경우는 보험인수가 거절됩니다.\n\n다음 단계로 진행이 불가합니다.');
		return false;
	}
*/
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
	for (var i=1;i<5;i++ ) {
		if (cal_type_id[i]!=0) {
			if (cal_type_code[i]=="") {
				alert('보험상품을 선택해 주세요.');
				return false;
			}
		}
	}

	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	$.ajax({
		type : "POST",
		url : "../srclt/tmp_process.php",
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