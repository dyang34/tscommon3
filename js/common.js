var auth_token="asdf340jfaiofasdfsadf";
//var site_url="http://ts.toursafe.co.kr";

function dateDiff(_date1, _date2) {
	var diffDate_1 = _date1 instanceof Date ? _date1 : new Date(_date1);
	var diffDate_2 = _date2 instanceof Date ? _date2 : new Date(_date2);
 
//	diffDate_1 = new Date(diffDate_1.getFullYear(), diffDate_1.getMonth()+1, diffDate_1.getDate());
//	diffDate_2 = new Date(diffDate_2.getFullYear(), diffDate_2.getMonth()+1, diffDate_2.getDate());
 
	var diff = Math.abs(diffDate_2.getTime() - diffDate_1.getTime());
	diff = Math.ceil(diff / (1000 * 3600 * 24));

	console.log(diffDate_1);
	console.log(diffDate_2);
	console.log(diff);

	return diff;
}

var isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };

function maxLengthCheck(object){
	if (object.value.length > object.maxLength){
	  object.value = object.value.slice(0, object.maxLength);
	}    
}

function maxLengthCheck(object, nextFocus){
	if (object.value.length > object.maxLength){
	  object.value = object.value.slice(0, object.maxLength);
	}    
	
	if (object.value.length >= object.maxLength){
	  $("#"+nextFocus).focus();
	}
	
}

// 이중국적자 국가 추가
function F_Nation_Check(object){
	if (object.value.length == 7)
	{
		a=object.value.substring(0,1);
			if (a==5 || a==6 ||a==7 ||a==8)
			{
				alert("영주권자 혹은 이중국적자의 경우 해당국가을 입력하여 주시기 바랍니다.");
				$("#f_country_show").show();
			}else{
				$("#f_country_show").hide();
			}
	}
}
// 이중국적자 국가 추가

/* 팝업 */
function win_pop(url,width,height) {
	var newwin = window.open(url,'','width='+width+',height='+height+',left=0,top=0, scrollbars=yes, resizable=yes');
	newwin.focus();
}

function idCheck(uid){ 
	email_regex = /^[a-zA-Z0-9._]{4,14}$/;

	if(!email_regex.test(uid)){ 
		return false; 
	}else{
		return true;
	}
}

function emailCheck(email_address){ 
	email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
	if(!email_regex.test(email_address)){ 
		return false; 
	}else{
		return true;
	}
}

function chkPwd(str){
	var pw = str;
	var num = pw.search(/[0-9]/g);
	var eng = pw.search(/[a-z]/ig);


	if(pw.length < 6 || pw.length > 10){
		return false;
	}
	if(pw.search(/\s/) != -1){
		return false;
	}
	if(num < 0 && eng < 0){
		return false;
	}
	return true;
}

function email_input(id_name,name) {
	$("#"+id_name).val(name);
}

function makeComma(val){
	return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function uncomma(str) {
	str = String(str);
	return str.replace(/[^\d]+/g, '');
}

$(document).ready(function(){
	$(".onlyNumber").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^0-9]/gi,''));
		}
	});

	$(".onlyAlphabet").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^a-z]/gi,''));    
		}
	});		

	$(".notHangul").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^a-z0-9]/gi,''));
		}
	});	

	$(".onlyHangul").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[a-z0-9]/gi,''));
		}
	});

	$(".onlyID").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^a-zA-Z0-9._]/gi,''));    
		}
	});	

	$(".name_check").keyup(function(event){
		if (!(event.keyCode >=37 && event.keyCode<=40)) {
			var inputVal = $(this).val();
			$(this).val(inputVal.replace(/[^ㄱ-ㅎ|ㅏ-ㅣ|가-힣a-zA-Z]/gi,''));    
		}
	});
});

function cutMaxTripday(stdate, enddate, maxdate, sthour, edhour, triptypeval){
	var end_gap_term; 
	var ret_val = true;
				if (triptypeval == '2'){ 	
					end_gap_term = new Date(Date.parse(treemonthcal(stdate, '3')));
				 } else {
					end_gap_term = new Date(Date.parse(treemonthcal(stdate, '1')));
				 }
				var date_term=dateDiff(stdate ,end_gap_term);
				var max_date_term = dateDiff(stdate,enddate);
				console.log(date_term+'|'+max_date_term);

				var startHour;
				var endHour;

				startHour = sthour;
				endHour = edhour;
				
				if (triptypeval=="1") {
					if (parseInt(date_term) == parseInt(max_date_term)) {
						if(Number(endHour) > Number(startHour)){
							//alert('30일 해당 기간까지만 보장됩니다');
							//alert('도착일 시간이 출발일 시간과 동일하거나 경과되었을 경우 계약기간이 계약이 성립되지 않습니다.');
							ret_val = false;
						}
					}
				} else if (triptypeval=="2") {
					if (parseInt(date_term) == parseInt(max_date_term)) {
						if(Number(endHour) > Number(startHour)){
							//alert('90일 해당 기간까지만 보장됩니다');
							//alert('도착일 시간이 출발일 시간과 동일하거나 경과되었을 경우 계약기간이 계약이 성립되지 않습니다.');
							ret_val = false;
						}
					}
				}
	return ret_val;				
}

function getCookie(name) {
	var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
	return value? value[2] : null;
};

function setCookie (name, value, exp) {
	var date = new Date();
	date.setTime(date.getTime() + exp*24*60*60*1000);
	document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
};