<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";

$search_name=addslashes(fnFilterString(strip_tags($_POST['search_name'])));
$search_hphone=addslashes(fnFilterString(strip_tags($_POST['search_hphone'])));

if($search_name=="" || $search_hphone=="") {
	$json_code = array('result'=>'false','msg'=>'정보를 정확히 입력하세요.');
	echo json_encode($json_code);
	exit;
} else {

	$hphone =encode_pass($search_hphone,$pass_key);

	$sel_q="select * from hana_plan where member_no='".$member_no."' and join_name='".$search_name."' and join_hphone='".$hphone."'";
	$sel_e=mysql_query($sel_q) or die(mysql_error());
	$sel=mysql_fetch_array($sel_e);

	if($sel[no] != "") {
		session_start("gift_check_1, gift_check_2");
		$_SESSION['gift_check_1']=$search_name;
		$_SESSION['gift_check_2']=$hphone;

		$json_code = array('result'=>'true','msg'=>'');
		echo json_encode($json_code);
		exit;
	} else {
		$json_code = array('result'=>'false','msg'=>'');
		echo json_encode($json_code);
		exit;
	}
}
?>
