<? include ("../include/top.php"); ?>

    <script>
        var oneDepth = 5; //1차 카테고리

        $(document).ready(function() {


            $('#allagree').click(function() {
                if ($(this).is(":checked")) {
                    $('.agree').prop("checked", true);
                    $('.agree').parent().addClass("ez-checked");

                } else {
                    $('.agree').prop("checked", false);
                    $('.agree').parent().removeClass("ez-checked");
                }
            })

            $('.agree').click(function() {
                if ($(this).is(":checked")) {
                    if ($("#ok_check").is(":checked") && $("#ok_check2").is(":checked")) {

                        $('#allagree').prop("checked", true);
                        $('#allagree').parent().addClass("ez-checked");

                    }
                } else {
                    $('#allagree').prop("checked", false);
                    $('#allagree').parent().removeClass("ez-checked");

                }
            })

        });


        function f_pop(page, name) {


            $.ajax({
                url: page,
                success: function(data) {
                    $('#yak_area').html(data);
                    $("#yak_tit").html(name);
                }
            })

            ViewlayerPop(0);

        }

    </script>

    <div id="wrap">
        <div id="inner_wrap">
            <!-- header -->
            <? include ("../include/header.php"); ?>
                <!-- //header -->
                <!-- container -->
                <div id="container">
                    <div class="complete_box">
                        <p class="txt"><strong>감사합니다.</strong><br>여행자보험 선물등록이 완료되었습니다.</p>
                        <p class="pt10 fcor0" style="font-size:0.7em; line-height:140%;">상세내용은 가입조회에서 확인하실 수 있습니다.</p>
						<p class="pt10 fcor0" style="font-size:0.6em; line-height:120%;">* 사고접수/계약취소/정보변경 등은 투어세이프 여행보험 콜센터 1800-9010(평일09~18시)로 연락주시기 바랍니다.</p>
						<p class="pt10 fcor0" style="font-size:0.6em; line-height:120%;">* 해외여행 중 현지에서 사고 발생 시 24시간 한국어 안내가 지원되는 에이스손해보험 긴급지원서비스 센터 82-2-3449-3500로 연락주시면 도움 받으실 수 있습니다.</p>
                    </div>
				
					<div class="complete_box" style="text-align:left;">
						
					</div>
                </div>

        </div>
        <!-- //container -->
    </div>
    <!-- //wrap -->

    <div id="layerPop0" class="layerPop" style="display: none;">
        <div class="layerPop_inner">
            <div class="pop_wrap">
                <div class="pop_wrap_in " style="max-width:1000px;">
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


    </body>

    </html>
