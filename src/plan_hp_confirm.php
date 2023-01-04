<?php
session_start();
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";

$phone_c=addslashes(fnFilterString(strip_tags($_POST['phone_c'])));
//$phone_c="736769";

if($phone_c=="") {
	$json_code = array('result'=>'false','msg'=>'인증번호를 정확히 입력하세요.');
	exit;
} else {

	if($phone_c == $_SESSION['phone_check_session']) {
		$json_code = array('result'=>'true','msg'=>'','phone_c'=>$phone_c);
		echo json_encode($json_code);
		exit;
	} else {
		$json_code = array('result'=>'false','msg'=>'','phone_c'=>$phone_c);
		echo json_encode($json_code);
		exit;
	}
}
?>