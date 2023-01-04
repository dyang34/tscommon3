<?php
@ session_start();

header("Content-Type:text/html; charset=UTF-8");
extract($_POST);
extract($_GET);
extract($_SERVER);
extract($_FILES);
extract($_ENV);
extract($_COOKIE);
extract($_SESSION);

/*
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
*/
ini_set("display_errors","0");

$root_dir=$_SERVER['DOCUMENT_ROOT'];

include_once $root_dir."/include/dbconn.php";
include_once $root_dir."/include/option_config.php";
include_once $root_dir."/lib/function.php";
include_once $root_dir."/lib/function_xss.php";
include_once $root_dir."/lib/function_thumbnail.php";
include_once $root_dir."/config/site_config.php";

if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']=="") {
	$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location: $redirect");
}
$thai_pass="";

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다!');
	echo json_encode($json_code);
	exit;
}

$code=addslashes(fnFilterString($_REQUEST['code']));
$trip_type=addslashes(fnFilterString($_REQUEST['trip_type']));

if ($code=="" || $trip_type=="") {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$msg=array();
$plan_array=array();
$x=0;

if(strcmp($thai_chk,'thaiPass') !== 0 && strcmp($thai_chk,'kamboPass') !== 0 && strcmp($thai_chk,'indonPass') !== 0 && strcmp($thai_chk,'philPass') !== 0 && strcmp($thai_chk,'malaPass') !== 0 && strcmp($thai_chk,'thaiPass5') !== 0 && strcmp($thai_chk,'thaiPass1') !== 0){ 
	$sql="select * from plan_code_hana where plan_code='".$code."' and company_type = '".$company_type."' and member_no='".$select_member_no."' ";
}

if(strcmp($thai_chk,'thaiPass') === 0) {
	$sql="select * from plan_code_hana_thai where plan_code='".$code."'  ";
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

if(strcmp($thai_chk,'malaPass') === 0) {
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
	$sql_title="select * from plan_code_type_hana where trip_type='".$trip_type."' and company_type = '".$company_type."' and member_no='".$select_member_no."'";
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
	
	if($row_title['title']) {
		$msg[$x]['content']=stripslashes($row_title['title']);
		
		if ($plan_array[$row_title['plan_type']]!='' && $plan_array[$row_title['plan_type']]!='0') {
			$table_price=kor_won($plan_array[$row_title['plan_type']]);
		} else {
			$table_price="";
		}

		$msg[$x]['price']=$table_price;

		$x++;
	}
}

$json_code = array('result'=>'true','msg'=>$msg,'msg_title'=>stripslashes($row['plan_title']));
echo json_encode($json_code);
exit;
?>