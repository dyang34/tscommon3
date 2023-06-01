<?
    $root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
    require_once $root_dir."/tscommon3/include/common.php";
    include_once $root_dir."/config/get_site_config_member_no.php";    

	/* ============================================================================== */
    /* =   PAGE : 지불 요청 및 결과 처리 PAGE                                       = */
    /* = -------------------------------------------------------------------------- = */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : http://kcp.co.kr/technique.requestcode.do                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2016  NHN KCP Inc.   All Rights Reserverd.                = */
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   환경 설정 파일 Include                                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.php파일을 수정하시기 바랍니다.     = */
    /* = -------------------------------------------------------------------------- = */

    include $root_dir."/tscommon3/bill_kcp/cfg/site_conf_inc.php";       // 환경설정 파일 include
    require	$root_dir."/tscommon3/bill_kcp/pp_cli_hub_lib.php";              // library [수정불가]

    /* = -------------------------------------------------------------------------- = */
    /* =   환경 설정 파일 Include END                                               = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   POST 형식 체크부분                                                       = */
    /* = -------------------------------------------------------------------------- = */
    if ( $_SERVER['REQUEST_METHOD'] != "POST" )
    {
        echo("잘못된 경로로 접속하였습니다.");
        exit;
    }
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   01. 지불 요청 정보 설정                                                  = */
    /* = -------------------------------------------------------------------------- = */
    $req_tx         = $_POST[ "req_tx"         ]; // 요청 종류
    $tran_cd        = $_POST[ "tran_cd"        ]; // 처리 종류
    /* = -------------------------------------------------------------------------- = */
    $cust_ip        = getenv( "REMOTE_ADDR"    ); // 요청 IP
    $ordr_idxx      = $_POST[ "ordr_idxx"      ]; // 쇼핑몰 주문번호
    $good_name      = $_POST[ "good_name"      ]; // 상품명
    /* = -------------------------------------------------------------------------- = */
    $res_cd         = "";                         // 응답코드
    $res_msg        = "";                         // 응답메시지
    $res_en_msg     = "";                         // 응답 영문 메세지
    $tno            = $_POST[ "tno"            ]; // KCP 거래 고유 번호
    /* = -------------------------------------------------------------------------- = */
    $buyr_name      = $_POST[ "buyr_name"      ]; // 주문자명
    $buyr_tel1      = $_POST[ "buyr_tel1"      ]; // 주문자 전화번호
    $buyr_tel2      = $_POST[ "buyr_tel2"      ]; // 주문자 핸드폰 번호
    $buyr_mail      = $_POST[ "buyr_mail"      ]; // 주문자 E-mail 주소
    /* = -------------------------------------------------------------------------- = */
    $use_pay_method = $_POST[ "use_pay_method" ]; // 결제 방법
    $bSucc          = "";                         // 업체 DB 처리 성공 여부
    /* = -------------------------------------------------------------------------- = */
    $app_time       = "";                         // 승인시간 (모든 결제 수단 공통)
    $amount         = "";                         // KCP 실제 거래 금액
    $total_amount   = 0;                          // 복합결제시 총 거래금액
    $coupon_mny     = "";                         // 쿠폰금액
    /* = -------------------------------------------------------------------------- = */
    $card_cd        = "";                         // 신용카드 코드
    $card_name      = "";                         // 신용카드 명
    $app_no         = "";                         // 신용카드 승인번호
    $noinf          = "";                         // 신용카드 무이자 여부
    $quota          = "";                         // 신용카드 할부개월
    $partcanc_yn    = "";                         // 부분취소 가능유무
    $card_bin_type_01 = "";                       // 카드구분1
    $card_bin_type_02 = "";                       // 카드구분2
    $card_mny       = "";                         // 카드결제금액
    /* = -------------------------------------------------------------------------- = */
    $bank_name      = "";                         // 은행명
    $bank_code      = "";                         // 은행코드
    $bk_mny         = "";                         // 계좌이체결제금액
    /* = -------------------------------------------------------------------------- = */
    $bankname       = "";                         // 입금할 은행명
    $depositor      = "";                         // 입금할 계좌 예금주 성명
    $account        = "";                         // 입금할 계좌 번호
    $va_date        = "";                         // 가상계좌 입금마감시간
    /* = -------------------------------------------------------------------------- = */
    $pnt_issue      = "";                         // 결제 포인트사 코드
    $pnt_amount     = "";                         // 적립금액 or 사용금액
    $pnt_app_time   = "";                         // 승인시간
    $pnt_app_no     = "";                         // 승인번호
    $add_pnt        = "";                         // 발생 포인트
    $use_pnt        = "";                         // 사용가능 포인트
    $rsv_pnt        = "";                         // 총 누적 포인트
    /* = -------------------------------------------------------------------------- = */
    $commid         = "";                         // 통신사 코드
    $mobile_no      = "";                         // 휴대폰 번호
    /* = -------------------------------------------------------------------------- = */
    $shop_user_id   = $_POST[ "shop_user_id"   ]; // 가맹점 고객 아이디
    $tk_van_code    = "";                         // 발급사 코드
    $tk_app_no      = "";                         // 상품권 승인 번호
    /* = -------------------------------------------------------------------------- = */
    $cash_yn        = $_POST[ "cash_yn"        ]; // 현금영수증 등록 여부
    $cash_authno    = "";                         // 현금 영수증 승인 번호
    $cash_tr_code   = $_POST[ "cash_tr_code"   ]; // 현금 영수증 발행 구분
    $cash_id_info   = $_POST[ "cash_id_info"   ]; // 현금 영수증 등록 번호
    $cash_no        = "";                         // 현금 영수증 거래 번호    

    /* ============================================================================== */

    /* ============================================================================== */
    /* =   02. 인스턴스 생성 및 초기화                                              = */
    /* = -------------------------------------------------------------------------- = */
    /* =       결제에 필요한 인스턴스를 생성하고 초기화 합니다.                     = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus = new C_PP_CLI;

    $c_PayPlus->mf_clear();
    /* ------------------------------------------------------------------------------ */
    /* =   02. 인스턴스 생성 및 초기화 END                                          = */
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   03. 처리 요청 정보 설정                                                  = */
    /* = -------------------------------------------------------------------------- = */

    /* = -------------------------------------------------------------------------- = */
    /* =   03-1. 승인 요청                                                          = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "pay" )
    {
            /* 1 원은 실제로 업체에서 결제하셔야 될 원 금액을 넣어주셔야 합니다. 결제금액 유효성 검증 */
            $c_PayPlus->mf_set_ordr_data( "ordr_mony",  $_POST['good_mny']);                                   

            $c_PayPlus->mf_set_encx_data( $_POST[ "enc_data" ], $_POST[ "enc_info" ] );
    }
    /* ------------------------------------------------------------------------------ */
    /* =   03.  처리 요청 정보 설정 END                                             = */
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   04. 실행                                                                 = */
    /* = -------------------------------------------------------------------------- = */
    if ( $tran_cd != "" )
    {
        $c_PayPlus->mf_do_tx( "", $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
                              $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
                              $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

        $res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
        $res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
        /* $res_en_msg = $c_PayPlus->mf_get_res_data( "res_en_msg" );  // 결과 영문 메세지 */ 
    }
    else
    {
        $c_PayPlus->m_res_cd  = "9562";
        $c_PayPlus->m_res_msg = "연동 오류 tran_cd값이 설정되지 않았습니다.";
    }


    /* = -------------------------------------------------------------------------- = */
    /* =   04. 실행 END                                                             = */
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   05. 승인 결과 값 추출                                                    = */
    /* = -------------------------------------------------------------------------- = */
    if ( $req_tx == "pay" )
    {
        if( $res_cd == "0000" )
        {
            $tno       = $c_PayPlus->mf_get_res_data( "tno"       ); // KCP 거래 고유 번호
            $amount    = $c_PayPlus->mf_get_res_data( "amount"    ); // KCP 실제 거래 금액
            $pnt_issue = $c_PayPlus->mf_get_res_data( "pnt_issue" ); // 결제 포인트사 코드
            $coupon_mny = $c_PayPlus->mf_get_res_data( "coupon_mny" ); // 쿠폰금액

    /* = -------------------------------------------------------------------------- = */
    /* =   05-1. 신용카드 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "100000000000" )
            {
                $card_cd   = $c_PayPlus->mf_get_res_data( "card_cd"   ); // 카드사 코드
                $card_name = $c_PayPlus->mf_get_res_data( "card_name" ); // 카드 종류
                $app_time  = $c_PayPlus->mf_get_res_data( "app_time"  ); // 승인 시간
                $app_no    = $c_PayPlus->mf_get_res_data( "app_no"    ); // 승인 번호
                $noinf     = $c_PayPlus->mf_get_res_data( "noinf"     ); // 무이자 여부 ( 'Y' : 무이자 )
                $quota     = $c_PayPlus->mf_get_res_data( "quota"     ); // 할부 개월 수
                $partcanc_yn = $c_PayPlus->mf_get_res_data( "partcanc_yn" ); // 부분취소 가능유무
                $card_bin_type_01 = $c_PayPlus->mf_get_res_data( "card_bin_type_01" ); // 카드구분1
                $card_bin_type_02 = $c_PayPlus->mf_get_res_data( "card_bin_type_02" ); // 카드구분2
                $card_mny = $c_PayPlus->mf_get_res_data( "card_mny" ); // 카드결제금액

                /* = -------------------------------------------------------------- = */
                /* =   05-1.1. 복합결제(포인트+신용카드) 승인 결과 처리               = */
                /* = -------------------------------------------------------------- = */
                if ( $pnt_issue == "SCSK" || $pnt_issue == "SCWB" )
                {
                    $pnt_amount   = $c_PayPlus->mf_get_res_data ( "pnt_amount"   ); // 적립금액 or 사용금액
                    $pnt_app_time = $c_PayPlus->mf_get_res_data ( "pnt_app_time" ); // 승인시간
                    $pnt_app_no   = $c_PayPlus->mf_get_res_data ( "pnt_app_no"   ); // 승인번호
                    $add_pnt      = $c_PayPlus->mf_get_res_data ( "add_pnt"      ); // 발생 포인트
                    $use_pnt      = $c_PayPlus->mf_get_res_data ( "use_pnt"      ); // 사용가능 포인트
                    $rsv_pnt      = $c_PayPlus->mf_get_res_data ( "rsv_pnt"      ); // 총 누적 포인트
                    $total_amount = $amount + $pnt_amount;                          // 복합결제시 총 거래금액
                }
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-2. 계좌이체 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "010000000000" )
            {
                $app_time  = $c_PayPlus->mf_get_res_data( "app_time"   );  // 승인 시간
                $bank_name = $c_PayPlus->mf_get_res_data( "bank_name"  );  // 은행명
                $bank_code = $c_PayPlus->mf_get_res_data( "bank_code"  );  // 은행코드
                $bk_mny = $c_PayPlus->mf_get_res_data( "bk_mny" ); // 계좌이체결제금액
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-3. 가상계좌 승인 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "001000000000" )
            {
                $bankname  = $c_PayPlus->mf_get_res_data( "bankname"  ); // 입금할 은행 이름
                $depositor = $c_PayPlus->mf_get_res_data( "depositor" ); // 입금할 계좌 예금주
                $account   = $c_PayPlus->mf_get_res_data( "account"   ); // 입금할 계좌 번호
                $va_date   = $c_PayPlus->mf_get_res_data( "va_date"   ); // 가상계좌 입금마감시간
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-4. 포인트 승인 결과 처리                                               = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000100000000" )
            {
                $pnt_amount   = $c_PayPlus->mf_get_res_data( "pnt_amount"   ); // 적립금액 or 사용금액
                $pnt_app_time = $c_PayPlus->mf_get_res_data( "pnt_app_time" ); // 승인시간
                $pnt_app_no   = $c_PayPlus->mf_get_res_data( "pnt_app_no"   ); // 승인번호 
                $add_pnt      = $c_PayPlus->mf_get_res_data( "add_pnt"      ); // 발생 포인트
                $use_pnt      = $c_PayPlus->mf_get_res_data( "use_pnt"      ); // 사용가능 포인트
                $rsv_pnt      = $c_PayPlus->mf_get_res_data( "rsv_pnt"      ); // 적립 포인트
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-5. 휴대폰 승인 결과 처리                                              = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000010000000" )
            {
                $app_time  = $c_PayPlus->mf_get_res_data( "hp_app_time"  ); // 승인 시간
                $commid    = $c_PayPlus->mf_get_res_data( "commid"       ); // 통신사 코드
                $mobile_no = $c_PayPlus->mf_get_res_data( "mobile_no"    ); // 휴대폰 번호
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-6. 상품권 승인 결과 처리                                              = */
    /* = -------------------------------------------------------------------------- = */
            if ( $use_pay_method == "000000001000" )
            {
                $app_time    = $c_PayPlus->mf_get_res_data( "tk_app_time"  ); // 승인 시간
                $tk_van_code = $c_PayPlus->mf_get_res_data( "tk_van_code"  ); // 발급사 코드
                $tk_app_no   = $c_PayPlus->mf_get_res_data( "tk_app_no"    ); // 승인 번호
            }

    /* = -------------------------------------------------------------------------- = */
    /* =   05-7. 현금영수증 결과 처리                                               = */
    /* = -------------------------------------------------------------------------- = */
            $cash_authno  = $c_PayPlus->mf_get_res_data( "cash_authno"  ); // 현금 영수증 승인 번호
            $cash_no      = $c_PayPlus->mf_get_res_data( "cash_no"      ); // 현금 영수증 거래 번호       
        }
    }
    /* = -------------------------------------------------------------------------- = */
    /* =   05. 승인 결과 처리 END                                                   = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   06. 승인 및 실패 결과 DB처리                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =       결과를 업체 자체적으로 DB처리 작업하시는 부분입니다.                 = */
    /* = -------------------------------------------------------------------------- = */

    if ( $req_tx == "pay" )
    {
        if( $res_cd == "0000" ) {
            // 06-1-1. 신용카드
            if ( $use_pay_method == "100000000000" ) {
               if($_POST['session_key']=="") {

				    $c_PayPlus->mf_clear();

					$tran_cd = "00200000";

					$c_PayPlus->mf_set_modx_data( "tno",      $tno                         );  // KCP 원거래 거래번호
					$c_PayPlus->mf_set_modx_data( "mod_type", "STSC"                       );  // 원거래 변경 요청 종류
					$c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip                     );  // 변경 요청자 IP
					$c_PayPlus->mf_set_modx_data( "mod_desc", "세션 종료" );  // 변경 사유

					$c_PayPlus->mf_do_tx( "", $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
								  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
								  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

					$res_cd  = $c_PayPlus->m_res_cd;
					$res_msg = $c_PayPlus->m_res_msg;
?>
<script>
	alert("세션이 종료되었습니다. 다시 시도해 주세요.");
	location.href="/main/main.php";
</script>
<?
					exit;
			   } else {
					$sql_check="select * from hana_plan_tmp where session_key='".$_POST['session_key']."' and order_type='1'";
					$result_check=mysql_query($sql_check);
					$row_check=mysql_fetch_array($result_check);

					if ($row_check['no']=='') {

						$c_PayPlus->mf_clear();

						$tran_cd = "00200000";

						$c_PayPlus->mf_set_modx_data( "tno",      $tno                         );  // KCP 원거래 거래번호
						$c_PayPlus->mf_set_modx_data( "mod_type", "STSC"                       );  // 원거래 변경 요청 종류
						$c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip                     );  // 변경 요청자 IP
						$c_PayPlus->mf_set_modx_data( "mod_desc", "세션 종료" );  // 변경 사유

						$c_PayPlus->mf_do_tx( "", $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
									  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
									  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

						$res_cd  = $c_PayPlus->m_res_cd;
						$res_msg = $c_PayPlus->m_res_msg;
	?>
<script>
	alert("세션정보가 삭제 되었습니다. 다시 시도해 주세요.");
	location.href="/main/main.php";
</script>
<?
						exit;
					} else {
						$sql_tmp="insert into hana_plan set
									member_no='".$member_no."',
									session_key='".$_POST['session_key']."',
									order_type='1',
									trip_type='".$row_check['trip_type']."',
									nation_no='".$row_check['nation_no']."',
									trip_purpose='".$row_check['trip_purpose']."',
									start_date='".$row_check['start_date']."',
									start_hour='".$row_check['start_hour']."',
									end_date='".$row_check['end_date']."',
									end_hour='".$row_check['end_hour']."',
									term_day='".$row_check['term_day']."',
									join_cnt='".$row_check['join_cnt']."',
									plan_type='".$row_check['plan_type']."',
									check_type_1='".$row_check['check_type_1']."',
									check_type_2='".$row_check['check_type_2']."',
									check_type_3='".$row_check['check_type_3']."',
									check_type_4='".$row_check['check_type_4']."',
									check_type_5='".$row_check['check_type_5']."',
									check_type_marketing='".$row_check['check_type_marketing']."',
									select_agree='".$row_check['select_agree']."',
									order_no='".$ordr_idxx."',
									card_cd='".$card_cd."',
									card_name='".$card_name."',
									tno='".$tno."',
									app_no='".$app_no."',
                                    referer_type='".$row_check['referer_type']."',
									regdate='".time()."'

								";	
						mysql_query($sql_tmp);
						$hana_plan_no = mysql_insert_id();

						$all_price=0;
						
						$sql_mem="select* from hana_plan_member_tmp where tmp_no='".$row_check['no']."' order by main_check asc";
						$result_mem=mysql_query($sql_mem);
						while($row_mem=mysql_fetch_array($result_mem)) {

							$sql_mem="insert into hana_plan_member set
								hana_plan_no='".$hana_plan_no."',
								member_no='".$member_no."',
								main_check='".$row_mem['main_check']."',
								name='".$row_mem['name']."',
                                name_eng='".$row_mem['name_eng']."',
								jumin_1='".$row_mem['jumin_1']."',
								jumin_2='".$row_mem['jumin_2']."',
								hphone='".$row_mem['hphone']."',
								email='".$row_mem['email']."',
								plan_code='".$row_mem['plan_code']."',
								plan_price='".$row_mem['plan_price']."',
								sex='".$row_mem['sex']."',
								age='".$row_mem['age']."',
                                plan_title='".$row_mem['plan_title']."',
                                plan_title_src='".$row_mem['plan_title_src']."',
                                thai_chk='".$row_mem['thai_chk']."',
                                nation_name='".$row_mem['nation_name']."'
							";	
							mysql_query($sql_mem);

							$all_price=$all_price+$row_mem['plan_price'];

							if ($row_mem['main_check']=="Y") {
								$mem_update="update hana_plan set 
												join_name='".$row_mem['name'].($row_mem['name_eng']?" / ".$row_mem['name_eng']:"")."'
											where no='".$hana_plan_no."'
											";
								mysql_query($mem_update);

								$kakao_phone="82".substr(decode_pass($row_mem['hphone'],$pass_key), 1,10);

								$plan_code_row=sql_one_one("plan_code_hana","plan_title"," and company_type=1 and member_no='".$site_config_member_no."' and plan_code='".$row_mem['plan_code']."'");

								if ($row_check['nation_no']=="0") {
									$nation_text="국내";
								} else {
									$nation_row=sql_one_one("nation","nation_name"," and no='".$row_check['nation_no']."'");
									$nation_text=stripslashes($nation_row['nation_name']);
								}

								if ($row_check['join_cnt']=="1") {
									$name_text=$row_mem['name'];
								} else {
									$name_text=$row_mem['name']." 외 ".($row_check['join_cnt']-1)."명";
								}

	$msg=$row_mem['name']." 고객님! 투어세이프 입니다.
에이스손해보험 여행보험 가입 감사드립니다.

▶ 가입상품 : ".$type_text_array[$row_check['trip_type']]."여행보험
▶ 보험기간 : ".date("Y.m.d",strtotime($row_check['start_date']))." ".$row_check['start_hour']."시 ~ ".date("Y.m.d",strtotime($row_check['end_date']))." ".$row_check['end_hour']."시
▶ 가입자 : ".$name_text."
▶ 가입플랜 : ".stripslashes($plan_code_row['plan_title'])."
▶ 보험료 : ".number_format($all_price)."원

상세 가입내역은 아래 가입조회 URL을 통해 확인 가능합니다.
안전하고 즐거운 여행 되시길 바랍니다.

(가입조회)
https://".$_SERVER['HTTP_HOST']."/tscommon/check/01.php

* 사고접수/계약취소/정보변경 등은 투어세이프 여행보험 콜센터 1800-9010(평일09~18시)로 연락주시기 바랍니다.
* 해외여행 중 현지에서 사고 발생 시 24시간 한국어 안내가 지원되는 에이스손해보험 긴급지원서비스 센터 82-1588-1983로 연락주시면 도움 받으실 수 있습니다.";

								sendTalk_common_notice($kakao_phone, "tour_common_notice2", $msg, "https://".$_SERVER['HTTP_HOST']."/tscommon/check/01.php");

							}
						}

						$sql_mem="select com_percent from toursafe_members where no='".$member_no."'";
						$result_mem=mysql_query($sql_mem);
						$row_mem=mysql_fetch_array($result_mem);

							$com_percent=$row_mem['com_percent'];

						$sql_insert_change="insert into hana_plan_change set
												hana_plan_no='".$hana_plan_no."',
												change_type='1',
												change_price='".$all_price."',
												in_price='".$all_price."',
												change_date='',
												com_percent='".$com_percent."',
												regdate='".time()."'
												";
						mysql_query($sql_insert_change);
 

						$sql_delete="delete from hana_plan_tmp where session_key='".$_POST['session_key']."'";
						mysql_query($sql_delete);

						$sql_delete="delete from hana_plan_member_tmp where tmp_no='".$row_check['no']."'";
						mysql_query($sql_delete);

						$session_val=time()."_".$row_check['trip_type']."_".$_SERVER[REMOTE_ADDR];
						$session_key =encode_pass($session_val,$pass_key);
						$_SESSION['s_session_key']=$session_key;
?>
<script>
	location.href="../trip/complete.php?check=<?=$_POST['session_key']?>";
</script>
<?
						exit;
					}
			   }
            }
         
        } else if ( $res_cd != "0000" ) {

			$sql_insert="insert into hana_bill_fail set
							session_key='".$_POST['session_key']."',
							error_code='".$res_cd."',
							error_msg='".mb_convert_encoding($res_msg, "UTF-8", "EUC-KR")."',
							regdate='".time()."'
						";
			mysql_query($sql_insert);
?>
<script>
	alert("결제에 실패했습니다. 다시 시도해 주세요.");
	location.href="../trip/step05.php";
</script>
<?
			exit;
        }
    }
?>