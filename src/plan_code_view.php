<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include_once $root_dir."/config/get_site_config_member_no.php";

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$code=addslashes(fnFilterString($_POST['code']));
$trip_type=addslashes(fnFilterString($_POST['trip_type']));

if ($code=="" || $trip_type=="") {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$msg=array();
$plan_array=array();
$x=0;

	 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
	$sql="select * from plan_code_hana where plan_code='".$code."' and company_type = 1 and member_no='".$site_config_member_no."' ";
}

if(strcmp($thai_chk,'thaiPass') === 0) {
	$sql="select * from plan_code_hana_thai where plan_code='".$code."' ";
}

if(strcmp($thai_chk,'kamboPass') === 0) {
	$sql="select * from plan_code_hana_kam where plan_code='".$code."' ";
}

if(strcmp($thai_chk,'indonPass') === 0) {
	$sql="select * from plan_code_hana_indonesia where plan_code='".$code."' ";
}

if(strcmp($thai_chk,'philPass') === 0) {
	$sql="select * from plan_code_hana_phil where plan_code='".$code."' ";
}

if(strcmp($thai_chk,'malaPass') === 0){			
	$sql="select * from plan_code_hana_mala where plan_code='".$code."' ";
	}

if(strcmp($thai_chk,'thaiPass5') === 0) {
	$sql="select * from plan_code_hana_thai_5 where plan_code='".$code."' ";
	}

if(strcmp($thai_chk,'thaiPass1') === 0) {
	$sql="select * from plan_code_hana_thai_1 where plan_code='".$code."' ";
	}
$result=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);

for ($i=1;$i<35;$i++) { 
	$plan_array['type_'.$i]=$row['type_'.$i];
}

	 if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
	$sql_title="select * from plan_code_type_hana where trip_type='".$trip_type."' and company_type = 1 and member_no='".$site_config_type_member_no."'";
}

if(strcmp($thai_chk,'thaiPass') === 0) {
	$sql_title="select * from plan_code_type_hana_thai where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'kamboPass') === 0) {
	$sql_title="select * from plan_code_type_hana_kam where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'indonPass') === 0) {
	$sql_title="select * from plan_code_type_hana_indonesia where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'philPass') === 0) {
	$sql_title="select * from plan_code_type_hana_phil where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'malaPass') === 0) {
	$sql_title="select * from plan_code_type_hana_mala where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'thaiPass5') === 0) {
	$sql_title="select * from plan_code_type_hana_thai_5 where trip_type='".$trip_type."' ";
}

if(strcmp($thai_chk,'thaiPass1') === 0) {
	$sql_title="select * from plan_code_type_hana_thai_1 where trip_type='".$trip_type."' ";
}

$result_title=mysql_query($sql_title);
while($row_title=mysql_fetch_array($result_title)) {
	
	$msg[$x]['content']=stripslashes($row_title['title']);
	
	if ($plan_array[$row_title['plan_type']]!='' && $plan_array[$row_title['plan_type']]!='0') {
		$table_price=kor_won($plan_array[$row_title['plan_type']]);
	} else {
		$table_price="";
	}

	$msg[$x]['price']=$table_price;

	$x++;
}

$json_code = array('result'=>'true','msg'=>$msg,'msg_title'=>stripslashes($row['plan_title']));
echo json_encode($json_code);
exit;
?>