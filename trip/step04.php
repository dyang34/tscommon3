<? 
include "../include/top.php";
include "../include/hana_check.php";

	$sql_check="select * from hana_plan_tmp where member_no='".$member_no."' and session_key='".$_SESSION['s_session_key']."'";
	$result_check=mysql_query($sql_check);
	$row_check=mysql_fetch_array($result_check);

	if ($row_check['no']=='') {
?>
<script>
	alert('세션정보가 삭제 되었습니다.\n다시 시도해 주세요.');
	history.go(-1);
</script>
<?
		exit;
	}
	
	$sql_nation="select * from nation where use_type='N'";
	$result_nation=mysql_query($sql_nation) or die(mysql_error());
	while($row_nation=mysql_fetch_array($result_nation)) {
		if ($no_nation_text=="") {
			$no_nation_text=stripslashes($row_nation['nation_name']);
		} else {
			$no_nation_text=$no_nation_text.", ".stripslashes($row_nation['nation_name']);
		}
	}
?>
<script>
	var oneDepth = 1; //1차 카테고리

	$(document).ready(function() {
		$(".join_step > ol > li:nth-child(3)").addClass("on");
		
		$('#all_no').click(function() {
			if ($(this).is(":checked")) {
				$('.aa_no').prop("checked", true);
				$('.aa_no').parent().parent().addClass("ez-selected");
				$('.aa_ok').parent().parent().removeClass("ez-selected");
				$('.aa_ok').prop("checked", false);
			} else {
				$('.aa_no').prop("checked", false);
				$('.aa_no').parent().parent().removeClass("ez-selected");
			}
		})

		$('.aa_ok').click(function() {
			$('#all_no').prop("checked", false);
			$('#all_no').parent().removeClass("ez-checked");
		})
		
		$('.aa_no').change(function(){
			if ($('.aa_no:checked').length == $('.aa_no').length) {
				$('#all_no').prop("checked", true);
				$('#all_no').parent().addClass("ez-checked");
			}
		});
		
		$('#allagree').click(function() {
			if ($(this).is(":checked")) {
				$('.agree').prop("checked", true);
				$('.agree').parent().addClass("ez-checked");

			} else {
				$('.agree').prop("checked", false);
				$('.agree').parent().removeClass("ez-checked");
			}
		})

		$('.agree_for_cnt').change(function(){
			chk_all_agree();
		});

		$(document).on('change','input[name=chk3]',function() {
			if ($(this).is(":checked")) {
				$('.chk3_agree').prop("checked", true);
				$('.chk3_agree').parent().addClass("ez-checked");

			} else {
				$('.chk3_agree').prop("checked", false);
				$('.chk3_agree').parent().removeClass("ez-checked");
			}

			chk_all_agree();
		});

		$(document).on('change','.chk3_agree_duty',function() {
			chk3_agree_all_agree();
		});

	});

	var chk_all_agree = function() {
		if ($('.agree_for_cnt:checked').length == $('.agree_for_cnt').length) {
			$('#allagree').prop("checked", true);
			$('#allagree').parent().addClass("ez-checked");
		}else {
			$('#allagree').prop("checked", false);
			$('#allagree').parent().removeClass("ez-checked");
		}
	}

	var chk3_agree_all_agree = function() {
		if ($('.chk3_agree_duty:checked').length == $('.chk3_agree_duty').length) {
			$('input[name=chk3]').prop("checked", true);
			$('input[name=chk3]').parent().addClass("ez-checked");
		} else {
			$('input[name=chk3]').prop("checked", false);
			$('input[name=chk3]').parent().removeClass("ez-checked");
		}

		chk_all_agree();
	}

	function f_pop(page,name){
		
		$("#yak_tit").html(name);
		$('#yak_area').load(page, function(){
			ViewlayerPop(0);
		});
		
	}
	
	
	function v_pop(num){
		if(num == 1) {
			$("#pop_title").html("입원, 수술, 질병확진");
			$("#viewPop").html("암, 백혈병, 협심증, 심근경색, 심장판막증, 간경화증, 뇌졸중증(뇌출혈, 뇌경색), 에이즈 및 HIV");
		}else if (num == 2) {
			$("#pop_title").html("여행금지 및 인수제한국가");
			$("#viewPop").html("<strong>아시아</strong><p>아프가니스탄, 이스라엘, 이라크, 이란, 북한, 레바논, 파키스탄, 팔레스타인 자치구, 시리아, 타지키스탄, 예멘<br/><br/>");
			$("#viewPop").append("<strong>아프리카</strong><p>부르키나파소, 부룬디, 콩고(자이레), 중앙아프리카, 콩고, 코트디브와르, 알제리, 이집트, 기니, 리비아, 말리, 나이지리아, 수단, 시에라리온, 소말리아, 챠드, 자이레<br/><br/>");
			$("#viewPop").append("<strong>유럽</strong><p>우크라이나, 크림반도<br/><br/>");
			$("#viewPop").append("<strong>북아메리카</strong><p>쿠바, 니카라과<br/><br/>");
			$("#viewPop").append("<strong>남아메리카</strong><p>아이티, 베네수엘라<br/><br/>");
			$("#viewPop").append("<strong>기타</strong><p>남극<br/><br/>");
			$("#viewPop").append("* 외교부의 여행금지대상 국가정보는 수시로 변경됩니다. 여행금지대상국가의 경우 가입이 불가하거나 또는 보상 대상에서 제외될 수 있습니다.<br/><br/>");
			$("#viewPop").append("<a href=\"http://www.0404.go.kr/dev/main.mofa\" style=\"text-decoration: underline;\" target=\"_blank\" title=\"외교부 홈페이지 새창열림\">외교부 해외안전여행 여행제한 및 금지구역 확인</a>");
		}else if (num == 3) {
			$("#pop_title").html("특정질병");
			$("#viewPop").html("암, 백혈병, 협심증, 심근경색, 심장판막증, 간경화증, 뇌졸중(뇌출혈, 뇌경색), 당뇨병, 에이즈(AIDS) 및 HIV보균");
		}else if (num == 4) {
			$("#pop_title").html("위험한 레포츠");
			$("#viewPop").html("스쿠버다이빙, 행글라이딩/패러글라이딩, 스카이다이빙, 수상스키, 자동차/오토바이경주, 번지점프, 빙벽/암벽등반, 제트스키, 래프팅, 이와 비슷한 위험도가 높은 활동");
		}
		ViewlayerPop(1);
	}

	function go_submit() {
		var frm = document.send_form;
		
		if ("<?=$tripType?>"=="2") {
			var check_type_1 = $("input:radio[name=check_type_1]:checked").val();
			var check_type_2 = $("input:radio[name=check_type_2]:checked").val();
			var check_type_3 = $("input:radio[name=check_type_3]:checked").val();
			var check_type_4 = $("input:radio[name=check_type_4]:checked").val();
			
			if (check_type_1=="" || check_type_1==null || check_type_2=="" || check_type_2==null || check_type_3=="" || check_type_3==null || check_type_4=="" || check_type_4==null) {
				alert('여행 출발전 고지사항을 체크해 주세요.');
				return false;
			}

			if (check_type_1=="Y" || check_type_2=="Y" || check_type_3=="Y" || check_type_4=="Y") {
				alert('여행 출발전 고지사항 중 예가 선택되어 있으면 다음단계로 진행 할 수 없습니다.');
				return false;
			}
		} else if ("<?=$tripType?>"=="1") {
			var check_type_1 = $("input:radio[name=check_type_1]:checked").val();
			var check_type_2 = $("input:radio[name=check_type_2]:checked").val();
			var check_type_3 = $("input:radio[name=check_type_3]:checked").val();
			var check_type_4 = $("input:radio[name=check_type_4]:checked").val();
			var check_type_5 = $("input:radio[name=check_type_5]:checked").val();
			
			if (check_type_1=="" || check_type_1==null || check_type_2=="" || check_type_2==null || check_type_3=="" || check_type_3==null || check_type_4=="" || check_type_4==null || check_type_5=="" || check_type_5==null) {
				alert('여행 출발전 고지사항을 체크해 주세요.');
				return false;
			}

			if (check_type_1=="Y" || check_type_2=="Y" || check_type_3=="Y" || check_type_4=="Y" || check_type_5=="Y") {
				alert('여행 출발전 고지사항 중 예가 선택되어 있으면 다음단계로 진행 할 수 없습니다.');
				return false;
			}
		}

		if ($("input:checkbox[name='chk1']").is(":checked") == false) {
			alert('이용약관에 동의해 주세요.');
			$(this).focus();
			return false;
		}

		if ($("input:checkbox[name='select_agree']").is(":checked") == false) {
			alert('개인정보 수집 및 이용에 동의해 주세요.');
			$(this).focus();
			return false;
		}

//		if ($("input:checkbox[name='chk3']").is(":checked") == false) {
		if ($("input:checkbox[name='chk3_1']").is(":checked") == false && $("input:checkbox[name='chk3_2']").is(":checked") == false && $("input:checkbox[name='chk3_3']").is(":checked") == false) {
			alert('개인정보 처리 및 단체가입규약에  동의해 주세요.');
			return false;
		}

		if ($("input:checkbox[name='chk3_1']").is(":checked") == false) {
			alert('단체규약(단체가입규약)에  동의해 주세요.');
			$(this).focus();
			return false;
		}

		if ($("input:checkbox[name='chk3_2']").is(":checked") == false) {
			alert('단체규약(개인정보 수집 및 이용 및 제3자 제공)에  동의해 주세요.');
			$(this).focus();
			return false;
		}

		if ($("input:checkbox[name='chk3_3']").is(":checked") == false) {
			alert('단체규약(고유식별 정보 수집 및 이용제공 및 제3자 제공)에  동의해 주세요.');
			$(this).focus();
			return false;
		}

		if ($("input:checkbox[name='chk2']").is(":checked") == false) {
			alert('보험약관에  동의해 주세요.');
			$(this).focus();
			return false;
		}

		$("#auth_token").val(auth_token);
		$("#loading_area").css({"display":"block"});

		$.ajax({
			type : "POST",
			url : "/tscommon/src/tmp_check_process.php",
			data :  $("#send_form").serialize(),
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					
					if( isMobile.any() ) {
						location.href="step05_mobile.php";
					} else {
						location.href="step05.php";
					}					

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
</script>

<div id="wrap">
	<div id="inner_wrap">
		<!-- header -->
		<? include $common_root_dir."/include/header.php"; ?>
			<!-- //header -->
			<!-- container -->
			<div id="container">
				<? include ("step.php"); ?>


<form id="send_form" name="send_form">
<input type="hidden" id="auth_token" name="auth_token" readonly>
					<h3 class="step_tit"><strong>STEP 3.</strong> 약관 및 고지사항을 체크하여 주세요</h3>
					<h3 class="s_tit">여행 출발전 고지사항</h3>
					<div class="gray_box">
						<? if ($tripType=="2") { ?>
						<ol class="notice_list">
							<li><strong>1. 현재 해외 체류중이신가요? <span class="red"><br />(해외 체류시 가입 불가. 국내 전 보험사 공통사항)</span></strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_1" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_1" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>2. 최근 3개월 내에 <a href="javascript:void(0);" onclick="v_pop(1);"><span class="red">입원, 수술, 질병확진[보기]</span></a>을 받은 사실이 있나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_2" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_2" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>3. 위험한 운동이나 전문적인 체육활동을 목적으로 출국하시나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_3" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_3" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>4. 여행지역이 <a href="javascript:void(0);" onclick="v_pop(2);"><span class="red">여행금지국가[보기]</span></a>인가요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_4" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_4" class="aa_no">아니오</label></li>
								</ul>
							</li>
						</ol>
						
						<? } elseif ($tripType=="1") { ?>
						<ol class="notice_list">
							<li><strong>1. 최근 5년 내에 <a href="javascript:void(0);" onclick="v_pop(3);"><span class="blue">특정질병[보기]</span></a>에 대한 확진 또는 치료를 받은 적이 있나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_1" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_1" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>2. 기능장애 또는 유전성 질환을 갖고 계시나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_2" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_2" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>3. 현재 외국에 거주중이거나 가입하는 장소가 외국이신가요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_3" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_3" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li><strong>4. 금강산, 개성공단 등 북한지역으로 여행을 가시나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_4" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_4" class="aa_no">아니오</label></li>
								</ul>
							</li>
							<li class="one"><strong>5. 여행중 직업, 직무 또는 동호회 활동으로 <a href="javascript:void(0);" onclick="v_pop(4);"><span class="blue">위험한 레포츠 등[보기]</span></a>을 하시나요?</strong>
								<ul class="box_radio small full">
									<li><label><input type="radio" value="Y" name="check_type_5" class="aa_ok">예</label></li>
									<li><label><input type="radio" value="N" name="check_type_5" class="aa_no">아니오</label></li>
								</ul>
							</li>
						</ol>
						<? } ?>
						
						<div class="tc f115 pt10 mt20 all_check" style="border-top:1px dashed #ccc">
							<label><input type="checkbox" id="all_no" value="" name=""> <strong>모든항목 아니오</strong></label>
						</div>


					</div>

					<h3 class="s_tit">가입/이용동의</h3>
					<div class="table_line">
						
        <!-- /** 2022.09.20 동의 약관 추가 수정 작업 -->
        <ul class="faq">
          <li>
            <div class="question">
                <span class="point_q">이용약관</span>
            </div>
            <div class="btnConfirm">
                <a href="javascript:void(0)" onclick="f_pop('../include/clause1.php', '이용약관');" class="btnNormalB line radius"><span>내용확인</span></a>
            </div>
            <div class="agree">
                <label><input type="checkbox" name="chk1" class="agree agree_for_cnt">동의합니다.</label>
            </div>
          </li>
          <li>
            <div class="question">
                <span class="point_q">개인정보수집 및 이용 동의</span>
            </div>
            <div class="btnConfirm">
                <a href="javascript:void(0)" onclick="f_pop('../include/clause4.php', '개인정보 수집 및 이용');" class="btnNormalB line radius"><span>내용확인</span></a>
            </div>
            <div class="agree">
                <label><input type="checkbox" name="select_agree" class="agree agree_for_cnt" value="Y">동의합니다.</label>
            </div>
          </li>
          <li>
            <div class="question">
                <span class="point_q">개인정보 처리 및 단체가입규약 동의</span>
                <div class="plus-minus-toggle collapsed"></div>
            </div>
            <div class="act btnConfirm">
                <a href="javascript:void(0)" onclick="f_pop('../include/clause3.php', '단체규약');" class="btnNormalB line radius"><span>내용확인</span></a>
            </div>
            <div class="act agree">
                <label><input type="checkbox" name="chk3" class="agree agree_for_cnt">동의합니다.</label>
            </div>
            <div class="answer">
                <ul>
                    <li>
                        <span class="point_q">단체가입규약 동의</span>
                    </li>
                    <li>
                        <label><input type="checkbox" name="chk3_1" class="agree chk3_agree chk3_agree_duty agree_for_cnt">동의합니다.</label>
                    </li>
                    
                    <li>
                        <span class="point_q">개인정보 수집 및 이용 및 제3자 제공 동의 </span>
                    </li>
                    <li>
                        <label><input type="checkbox" name="chk3_2" class="agree chk3_agree chk3_agree_duty agree_for_cnt">동의합니다.</label>
                    </li>
                    
                    <li>
                        <span class="point_q">고유식별 정보 수집 및 이용제공 및 제3자 제공 동의</span>
                    </li>
                    <li class="mobile">
                        <label><input type="checkbox" name="chk3_3" class="agree chk3_agree chk3_agree_duty agree_for_cnt">동의합니다.</label>
                    </li>
                    
                    <li>
                        <span class="point_q">마케팅 활용을 위한 개인정보 수집 및 이용 동의(선택)</span>
                    </li>
                    <li class="mobile">
                        <label><input type="checkbox" name="check_type_marketing" class="agree chk3_agree chk3_agree_duty agree_for_cnt" value="Y">동의합니다.</label>
                    </li>
                </ul>
            </div>
          </li>
          <li>
            <div class="question terms">
                <span class="point_q">보험약관</span>
                <? if ($tripType=="1") { ?>
                <a href="../doc/domestic.pdf" target="_blank" class="btnTiny"><span>국내여행보험약관</span></a> 
                <? } else { ?>
                <a href="../doc/overseas.pdf" target="_blank" class="btnTiny"><span>해외여행보험약관</span></a>
                <? } ?>
                </span>
            </div>
            <div class="btnConfirm terms">
                <a href="javascript:void(0)" onclick="f_pop('../include/clause2.php', '보험약관');" class="btnNormalB line radius"><span>내용확인</span></a>
            </div>
            <div class="agree terms">
                <label><input type="checkbox" name="chk2" class="agree agree_for_cnt">동의합니다.</label>
            </div>
          </li>
        </ul>
        <!-- 2022.09.20 동의 약관 추가 수정 작업 **/ -->
		
		
<?/*					
					<table class="table_style1">
							<colgroup>

								<col width="%">
								<col class="m_th_b" width="200">
								<col class="m_th_s" width="200">
							</colgroup>

							<tbody>
								<tr>
									<td class="tl ">
										<span class="point_c">[필수] 이용약관</span>
									</td>
									<td>
										<label><input type="checkbox" name="chk1" class="agree">동의합니다.</label>
									</td>
									<td>
										<a href="javascript:void(0)" onclick="f_pop('../include/clause1.php', '이용약관');" class="btnNormalB line radius"><span>내용확인</span></a>
									</td>
									
								</tr>
								<tr>
									<td class="tl ">
										<span class="point_c">[필수] 보험약관</span> &nbsp;&nbsp;&nbsp;<span class="ib">
										<? if ($tripType=="1") { ?>
										<a href="../doc/domestic.pdf" target="_blank" class="btnTiny"><span>국내여행보험약관</span></a> 
										<? } else { ?>
										<a href="../doc/overseas.pdf" target="_blank" class="btnTiny"><span>해외여행보험약관</span></a>
										<? } ?>
										</span>
									</td>
									<td>
										<label><input type="checkbox" name="chk2" class="agree">동의합니다.</label>
									</td>
									<td>
										<a href="javascript:void(0)" onclick="f_pop('../include/clause2.php', '보험약관');" class="btnNormalB line radius"><span>내용확인</span></a>
									</td>
									
								</tr>
								<tr>
									<td class="tl ">
										<span class="point_c">[필수] 단체규약</span>
									</td>
									<td>
										<label><input type="checkbox" name="chk3" class="agree">동의합니다.</label>
									</td>
									<td>
										<a href="javascript:void(0)" onclick="f_pop('../include/clause3.php', '단체규약');" class="btnNormalB line radius"><span>내용확인</span></a>
									</td>
									
								</tr>
								<tr>
									<td class="tl ">
										<span class="point_c">[필수] 개인정보 수집 및 이용</span>
									</td>
									<td>
										<label><input type="checkbox" name="select_agree" class="agree" value="Y">동의합니다.</label>
									</td>
									<td>
										<a href="javascript:void(0)" onclick="f_pop('../include/clause4.php', '개인정보 수집 및 이용');" class="btnNormalB line radius"><span>내용확인</span></a>
									</td>
									
								</tr>
							</tbody>
						</table>
*/?>
					</div>
					<div class="tc f115 pt10 mt20 all_check" style="border-top:1px dashed #ccc">
						<label><input type="checkbox" id="allagree" class="" value="" name=""> <strong>전체 약관에 동의합니다.</strong></label>
					</div>
					<div class="btn-tc"><a href="javascript:void(0);" onclick="go_submit();" class="btnBig m_block"><span>보험료 결제하기</span></a></div>


				</form>

			</div>

	</div>
	<!-- //container -->
	<? include $common_root_dir."/include/footer.php"; ?>
</div>
<!-- //wrap -->

<div id="layerPop0" class="layerPop" style="display: none;">
	<div class="layerPop_inner">
		<div class="pop_wrap">
			<div class="pop_wrap_in " style="max-width:700px;">
				<div class="pop_head">
					<p class="title" id="yak_tit"></p>
					<p class="x_btn" onclick="CloselayerPop();"><img src="../img/common/close3.png" alt="닫기"></p>
				</div>
				<div id="yak_area" class="pop_body ">
					
				</div>

			</div>
		</div>
	</div>
</div>

<div id="layerPop1" class="layerPop" style="display: none;">
	<div class="layerPop_inner">
		<div class="pop_wrap">
			<div class="pop_wrap_in " style="max-width:600px;">
				<div class="pop_head">
					<p class="title" id="pop_title"></p>
					<p class="x_btn" onclick="CloselayerPop();"><img src="../img/common/close3.png" alt="닫기"></p>
				</div>
				<div id="viewPop" class="pop_body ">
					
				</div>

			</div>
		</div>
	</div>
</div>
</body>

<script>
//** 2022.09.20 dropdown FAQ script
$('.faq li .question').click(function () {
	$(this).find('.plus-minus-toggle').toggleClass('collapsed');
	$(this).parent().toggleClass('active');
});
</script>

</html>