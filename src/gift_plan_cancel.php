<?php
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include $root_dir."/tscommon3/include/plan_gift_check_ajax.php"; 

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$num=addslashes(fnFilterString($_POST['num']));

if ($num=="") {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$sql="select 
		*
	  from
		hana_plan_gift
	  where
		no='".$num."'
		and join_name='".$_SESSION['gift_check_1']."'
		and join_hphone='".$_SESSION['gift_check_2']."'
	 ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if ($row['no']=="") {
	$json_code = array('result'=>'false','msg'=>'신청내역이 없습니다.');
	echo json_encode($json_code);
	exit;
}

$cur_time=time();
$start_time=strtotime($row['start_date']." ".$row['start_hour']."0000");
		
if (($start_time-$cur_time)<"7200") {
	$json_code = array('result'=>'false','msg'=>'여행 2시간 전까지 취소 가능합니다.');
	echo json_encode($json_code);
	exit;
}

$sql="update 
		hana_plan_gift
	  set
		gift_bill_state='2'
	  where
		no='".$num."'
		and member_no='".$member_no."'
		and join_name='".$_SESSION['gift_check_1']."'
		and join_hphone='".$_SESSION['gift_check_2']."'
	 ";
$result=mysql_query($sql);

$sql="update 
		hana_plan_gift_member
	  set
		plan_state='2'
	  where
		hana_plan_no='".$row['no']."'
	 ";
$result=mysql_query($sql);

$json_code = array('result'=>'true','msg'=>"취소되었습니다.");
echo json_encode($json_code);
exit;
?>