<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include_once $root_dir."/config/get_site_config_member_no.php";

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$plan_type=addslashes(fnFilterString($_POST['plan_type']));
$tripType=addslashes(fnFilterString($_POST['tripType']));
$thai_chk=addslashes(fnFilterString($_POST['thai_chk']));

if ($plan_type=="") {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
	$sql="select * from plan_code_type_hana where trip_type='".$tripType."' and company_type = 1 and member_no='".$site_config_type_member_no."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'thaiPass') === 0) {
	$sql="select * from plan_code_type_hana_thai where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'kamboPass') === 0) {
	$sql="select * from plan_code_type_hana_kam where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'indonPass') === 0) {
	$sql="select * from plan_code_type_hana_indonesia where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'philPass') === 0) {
	$sql="select * from plan_code_type_hana_phil where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'malaPass') === 0) {
	$sql="select * from plan_code_type_hana_mala where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'thaiPass5') === 0) {
	$sql="select * from plan_code_type_hana_thai_5 where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

if(strcmp($thai_chk,'thaiPass1') === 0) {
	$sql="select * from plan_code_type_hana_thai_1 where trip_type='".$tripType."' and plan_type='".$plan_type."' ";
}

$result=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);

$json_code = array('result'=>'true','msg'=>nl2br(stripslashes($row['content'])),'msg_title'=>nl2br(stripslashes($row['title'])));
echo json_encode($json_code);
exit;
?>