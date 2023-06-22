<div id="footer_wrap">
	<div class="footer">

		<ul class="f_navi">
			<li><a href="javascript:void(0)" onclick="f_pop2('/tscommon/include/clause1.php', '이용약관');">이용약관</a></li>
			<li><a href="javascript:void(0)" onclick="f_pop2('/tscommon/include/clause5.php', '개인정보 취급방침');">개인정보취급방침</a></li>
			<?  if ($row['type_check_2']=="Y") {  ?>
			<li><a href="/tscommon/doc/overseas.pdf" target="_blank">해외여행보험약관</a></li>
			<?	}
			if ($row['type_check_1']=="Y") {  ?>
			<li><a href="/tscommon/doc/domestic.pdf" target="_blank">국내여행보험약관</a></li>
			<?
			}
				?>
		</ul>
		<address>
			<span>주소 서울특별시 중구 퇴계로 324 성우빌딩 10F</span><span class="line"></span><span>대표 김정훈</span><span class="line"></span><span>사업자등록번호 118-88-00158  </span><span class="line"></span><span>통신판매신고 번호: 2023-서울중구-0011</span><br><span>이메일 <a href="mailto:toursafe@bis.co.kr">toursafe@bis.co.kr</a> </span><span class="line"></span><span>전화 <a href="tel:1800-9010">1800-9010</a> </span><span class="line"></span><span>팩스 02-2088-1673 </span>
			</address>
			<p class="copy">COPYRIGHT ⓒ TOURSAFE Co., Ltd. ALL RIGHTS RESERVED </p>
			<p class="copy">준법감시인 심의필  OTA-2022-004 (2022.01.17.~2023.01.16)</p>
<?/*			
			<p class="copy">손해보험협회 심의필 제 36745호 (2020.12.04)</p>
*/?>			
	</div>
</div>
<script>
	function f_pop2(page,name){
		
		$("#yak_tit2").html(name);
		$('#yak_area2').load(page, function(){
			ViewlayerPop(20);
		});
		/*$.ajax({
			url: page,
			success: function(data) {
				$('#yak_area2').html(data);
				$("#yak_tit2").html(name);
			}
		})*/
		
	}

	<?
		//if(isset($_GET['kozin'])){
	?>
			function notice_pop(page,name){
		
				$("#yak_tit3").html(name);
				$('#yak_area3').load(page, function(){
					ViewlayerPop(21);
				});
			}
		$(document).ready(function(){
			//var noticeCookie = getCookie("startb_event");  // 쿠기 가져오기
			//if (noticeCookie != "OK"){       
			<?
				if($_SERVER['PHP_SELF'] == '/main/main.php'){
					if(time() < strtotime('2021-07-31 12:59:59')  ){
			?>
				notice_pop('/tscommon/include/notice.php', 'NOTICE');
			//} 
			<?
					} else {
				//echo date("Y-m-d H:i:s", time());
			?>
				notice_pop('/tscommon/include/notice1.php', 'NOTICE');	
			<?
					}
			}
			?>

			
		});
	<?
		//}
	?>
	function CloselayerPop_notice(){
		/*
			if(confirm('오늘 하루동안 창을 보지 않으시겠습니까?')){
				setCookie('startb_event','OK', '24');
				CloselayerPop();
			} else {
		*/
				CloselayerPop();
			//}
	}
</script>
<div id="layerPop20" class="layerPop" style="display: none;">
	<div class="layerPop_inner">
		<div class="pop_wrap">
			<div class="pop_wrap_in " style="max-width:700px;">
				<div class="pop_head">
					<p class="title" id="yak_tit2"></p>
					<p class="x_btn" onclick="CloselayerPop();"><img src="/tscommon/img/common/close3.png" alt="닫기"></p>
				</div>
				<div id="yak_area2" class="pop_body ">
					
				</div>

			</div>
		</div>
	</div>
</div>
<!--
<div id="layerPop21" class="layerPop" style="display: none;">
	<div class="layerPop_inner">
		<div class="pop_wrap">
			<div class="pop_wrap_in " style="max-width:700px;">
				<div class="pop_head">
					<p class="title" id="yak_tit3"></p>
					<p class="x_btn" onclick="CloselayerPop_notice();"><img src="/tscommon/img/common/close3.png" alt="닫기"></p>
				</div>
				<div id="yak_area3" class="pop_body ">
					
				</div>

			</div>
		</div>
	</div>
</div>
-->