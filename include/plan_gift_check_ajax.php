<?php
if($_SESSION['gift_check_1']=="" || $_SESSION['gift_check_2']=="") {
	$json_code = array('result'=>'false','msg'=>'세션이 종료되었습니다. 다시 시도해 주세요.');
	echo json_encode($json_code);
	exit;
}
?>