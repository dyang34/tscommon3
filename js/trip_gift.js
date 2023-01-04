function price_cal() {

	var frm=document.send_form;

	if (tripType=="2") {
		if (frm.nation.value=="") {
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

		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('생년월일을 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="8") {
			alert('생년월일을 정확히 입력하세요.');
			return false;
		}


		if ($(".jumin_2").eq(i).val()=="") {
			alert('성별을 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val()=="" || $("input[name='hphone2[]']").eq(i).val()=="" || $("input[name='hphone3[]']").eq(i).val()=="") {
			alert('연락처를 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val().length < 3) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone2[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone3[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}
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
		if (frm.nation.value=="") {
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

		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('생년월일을 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="8") {
			alert('생년월일을 정확히 입력하세요.');
			return false;
		}

		if ($(".jumin_2").eq(i).val()=="") {
			alert('성별을 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val()=="" || $("input[name='hphone2[]']").eq(i).val()=="" || $("input[name='hphone3[]']").eq(i).val()=="") {
			alert('연락처를 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val().length < 3) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone2[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone3[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}
	}

	
	$("#auth_token").val(auth_token);
	$("#loading_area").css({"display":"block"});

	view_reset();

	$.ajax({
		type : "POST",
		url : "/tscommon/src/insurance_cal.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			console.log(data);
			var json = eval("(" + data + ")");

			if (json.result=="true") {
				var add_html="";

				$.each(json.msg,function(key,state){
					add_html=add_html+"<li><label><input type=\"radio\" value=\""+state.plan_type+"\" name=\"plan_type\">"+state.plan_title+"</label></li>";
				});
				
				$("#insurance_type").html(add_html).promise().done(function(){
					$('input[type="radio"]').ezMark();
					$(":input:radio[name=plan_type]").click(function() {
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
		if (frm.nation.value=="") {
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

		if ($("input[name='jumin_1[]']").eq(i).val()=="") {
			alert('생년월일을 입력하세요.');
			return false;
		}

		if ($("input[name='jumin_1[]']").eq(i).val().length!="8") {
			alert('생년월일을 정확히 입력하세요.');
			return false;
		}

		if ($(".jumin_2").eq(i).val()=="") {
			alert('성별을 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val()=="" || $("input[name='hphone2[]']").eq(i).val()=="" || $("input[name='hphone3[]']").eq(i).val()=="") {
			alert('연락처를 입력하세요.');
			return false;
		}

		if ($("input[name='hphone1[]']").eq(i).val().length < 3) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone2[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}

		if ($("input[name='hphone3[]']").eq(i).val().length < 4) {
			alert('연락처를 정확히 입력하세요.');
			return false;
		}
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
		url : "/tscommon/src/gift_tmp_process.php",
		data :  $("#send_form").serialize(),
		success : function(data, status) {
			var json = eval("(" + data + ")");

			if (json.result=="true") {
				location.href="step04.php";

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