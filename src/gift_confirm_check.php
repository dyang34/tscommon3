<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";

$search_key=addslashes(fnFilterString(strip_tags($_POST['search_key'])));
$search_name=addslashes(fnFilterString(strip_tags($_POST['search_name'])));
$search_birth=addslashes(fnFilterString(strip_tags($_POST['search_birth'])));
$hphone=addslashes(fnFilterString(strip_tags($_POST['hphone1']))).addslashes(fnFilterString(strip_tags($_POST['hphone2']))).addslashes(fnFilterString(strip_tags($_POST['hphone3'])));

if($search_key=="" || $search_name=="" || $search_birth=="") {
	$json_code = array('result'=>'false','msg'=>'정보를 정확히 입력하세요.');
	echo json_encode($json_code);
	exit;
} else {

	$jumin_1 =encode_pass($search_birth,$pass_key);
	$hphone =encode_pass($hphone,$pass_key);

	$sel_q="select * from hana_plan_member where member_no='".$member_no."' and gift_key='".$search_key."' and name='".$search_name."' and hphone='".$hphone."'";
	$sel_e=mysql_query($sel_q) or die(mysql_error());
	$sel=mysql_fetch_array($sel_e);

	if($sel[no] != "") {

		if ($sel['gift_state']!="1") {
			$json_code = array('result'=>'false','msg'=>'이미 승인된 선물 내역 입니다. 가입내역조회에서 확인 가능합니다.');
			echo json_encode($json_code);
			exit;
		}

		if ($sel['plan_state']!="1") {
			$json_code = array('result'=>'false','msg'=>'선물내역이 취소되었습니다. 확인 부탁드립니다.');
			echo json_encode($json_code);
			exit;
		}

		if ($sel['jumin_1']!=$jumin_1) {
			$json_code = array('result'=>'false','msg'=>'일치하는 정보가 없습니다.');
			echo json_encode($json_code);
			exit;
		}

		session_start("login_check_key_1, login_check_key_2,login_check_key_3,login_check_key_4");
		$_SESSION['login_check_key_1']=$search_key;
		$_SESSION['login_check_key_2']=$search_name;
		$_SESSION['login_check_key_3']=$jumin_1;
		$_SESSION['login_check_key_4']=$hphone;

		$json_code = array('result'=>'true','msg'=>'');
		echo json_encode($json_code);
		exit;
	} else {
		$json_code = array('result'=>'false','msg'=>'일치하는 정보가 없습니다.');
		echo json_encode($json_code);
		exit;
	}
}
?>
