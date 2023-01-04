<?
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";
include $root_dir."/tscommon3/include/hana_check_ajax.php";

$msg=array();
$x=0;

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$join_name = addslashes(fnFilterString($_POST['join_name']));
$join_hphone = addslashes(fnFilterString($_POST['join_hphone']));

$join_hphone =encode_pass($join_hphone,$pass_key);

$check_type_1 = addslashes(fnFilterString($_POST['check_type_1']));
$check_type_2 = addslashes(fnFilterString($_POST['check_type_2']));
$check_type_3 = addslashes(fnFilterString($_POST['check_type_3']));
$check_type_4 = addslashes(fnFilterString($_POST['check_type_4']));
$check_type_5 = addslashes(fnFilterString($_POST['check_type_5']));
$check_type_marketing = addslashes(fnFilterString($_POST['check_type_marketing']));
$select_agree = addslashes(fnFilterString($_POST['select_agree']));

if(empty($check_type_marketing)) {
	$check_type_marketing = "N";
}

$sql_check="select * from hana_plan_tmp where session_key='".$_SESSION['s_session_key']."'";
$result_check=mysql_query($sql_check);
$row_check=mysql_fetch_array($result_check);

if ($row_check['no']=='') {
	$json_code = array('result'=>'false','msg'=>'세션정보가 삭제 되었습니다. 다시 시도해 주세요.');
	echo json_encode($json_code);
	exit;
} else {
	$sql_tmp="update hana_plan_tmp set
			join_name='".$join_name."',
			join_hphone='".$join_hphone."',
			check_type_1='".$check_type_1."',
			check_type_2='".$check_type_2."',
			check_type_3='".$check_type_3."',
			check_type_4='".$check_type_4."',
			check_type_5='".$check_type_5."',
			check_type_marketing='".$check_type_marketing."',
			select_agree='".$select_agree."'
		where session_key='".$_SESSION['s_session_key']."'";
	mysql_query($sql_tmp);
}

$json_code = array('result'=>'true','msg'=>'success');
echo json_encode($json_code);
exit;

?>
