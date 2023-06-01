<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include_once $root_dir."/config/get_site_config_member_no.php";

$jumin_1=addslashes(fnFilterString(strip_tags($_POST['jumin_1'])));
$jumin_2=addslashes(fnFilterString(strip_tags($_POST['jumin_2'])));

if($_SESSION['login_check_key_1']=="" || $_SESSION['login_check_key_2']=="" || $_SESSION['login_check_key_3']=="" || $_SESSION['login_check_key_4']=="") {
	$json_code = array('result'=>'false','msg'=>'세션이 종료되었습니다. 다시 시도해 주세요.');
	echo json_encode($json_code);
	exit;
}


if($jumin_1=="" || $jumin_2=="") {
	$json_code = array('result'=>'false','msg'=>'정보를 정확히 입력하세요.');
	echo json_encode($json_code);
	exit;
} else {

    if (substr($jumin_2,0,1) == "1" || substr($jumin_2,0,1) == "2"
        || substr($jumin_2,0,1) == "3" || substr($jumin_2,0,1) == "4"){
            
            $jumin_check=resnoCheck($jumin_1,$jumin_2);
            
    } else {
        $jumin_check=foreignerCheck($jumin_1,$jumin_2);
    }

	if ($jumin_check==false) {
		$json_code = array('result'=>'false','msg'=>'주민등록번호를 확인해 주세요.');
		echo json_encode($json_code);
		exit;
	}

	$sql="select 
		*
	  from
		hana_plan_member
	  where
	    gift_key='".$_SESSION['login_check_key_1']."'
		and name='".$_SESSION['login_check_key_2']."'
		and jumin_1='".$_SESSION['login_check_key_3']."'
		and hphone='".$_SESSION['login_check_key_4']."'
	 ";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);

	if ($row['no']=="") {
		$json_code = array('result'=>'false','msg'=>'신청내역이 없습니다.');
		echo json_encode($json_code);
		exit;
	}

	$jumin_1 =encode_pass($jumin_1,$pass_key);
	$jumin_2 =encode_pass($jumin_2,$pass_key);

	$sql_update="update hana_plan_member set 
					jumin_1='".$jumin_1."',
					jumin_2='".$jumin_2."',
					gift_state='2'
				where
					member_no='".$member_no."'
					and gift_key='".$_SESSION['login_check_key_1']."'
					and name='".$_SESSION['login_check_key_2']."'
					and jumin_1='".$_SESSION['login_check_key_3']."'
					and hphone='".$_SESSION['login_check_key_4']."'
				 ";
	$success=mysql_query($sql_update);
	$kakao_phone="82".substr(decode_pass($row['hphone'],$pass_key), 1,10);

	
	$sql_mem="select 
		*
	  from
		hana_plan
	  where
	    no='".$row['hana_plan_no']."'
	 ";
	$result_mem=mysql_query($sql_mem);
	$row_mem=mysql_fetch_array($result_mem);

	$plan_code_row=sql_one_one("plan_code_hana","plan_title"," and company_type=1 and member_no='".$site_config_member_no."' and plan_code='".$row['plan_code']."'");

	if ($row_mem['nation_no']=="0") {
		$nation_text="국내";
	} else {
		$nation_row=sql_one_one("nation","nation_name"," and no='".$row_mem['nation_no']."'");
		$nation_text=stripslashes($nation_row['nation_name']);
	}


	$msg=$row['name']." 고객님! 투어세이프 입니다.
에이스손해보험 여행보험 가입 감사드립니다.

▶ 가입상품 : ".$type_text_array[$row_mem['trip_type']]."여행보험
▶ 보험기간 : ".date("Y.m.d",strtotime($row_mem['start_date']))." ".$row_mem['start_hour']."시 ~ ".date("Y.m.d",strtotime($row_mem['end_date']))." ".$row_mem['end_hour']."시
▶ 가입자 : ".$row['name']."
▶ 가입플랜 : ".stripslashes($plan_code_row['plan_title'])."
▶ 보험료 : ".number_format($row['plan_price'])."원

상세 가입내역은 아래 가입조회 URL을 통해 확인 가능합니다.
안전하고 즐거운 여행 되시길 바랍니다.

(가입조회)
https://"._TOURSAFE_SUBSITE_NAME.".toursafe.co.kr/check/01.php

* 사고접수/계약취소/정보변경 등은 투어세이프 여행보험 콜센터 1800-9010(평일09~18시)로 연락주시기 바랍니다.
* 해외여행 중 현지에서 사고 발생 시 24시간 한국어 안내가 지원되는 에이스손해보험 긴급지원서비스 센터 82-1588-1983로 연락주시면 도움 받으실 수 있습니다.";
								
    sendTalk_common_notice($kakao_phone, "tour_common_notice2", $msg, "https://"._TOURSAFE_SUBSITE_NAME.".toursafe.co.kr/check/01.php");

	$_SESSION['login_check_key_1']="";
	$_SESSION['login_check_key_2']="";
	$_SESSION['login_check_key_3']="";
	$_SESSION['login_check_key_4']="";


	if ($success) {
		$json_code = array('result'=>'true','msg'=>'처리되었습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$json_code = array('result'=>'false','msg'=>'다시 시도해 주세요.');
		echo json_encode($json_code);
		exit;
	}
}
?>
