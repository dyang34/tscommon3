<?php
if($_SESSION['s_session_key']=="") {
	$json_code = array('result'=>'false','msg'=>'세션이 종료되었습니다. 다시 시도해 주세요.');
	echo json_encode($json_code);
	exit;
}
$typeCheckArr=explode("_",decode_pass($_SESSION['s_session_key'],$pass_key));
$tripType=$typeCheckArr[1];

if(in_array('4860', $typeCheckArr)){
	$thai_chk = 'thaiPass';
	$nation_chk = '';
} else if(in_array('4630', $typeCheckArr)){
	$thai_chk = 'kamboPass';
	$nation_chk = '';
} else if(in_array('4550', $typeCheckArr)){
	$thai_chk = 'indonPass';
	$nation_chk = '';
} else if(in_array('48600', $typeCheckArr)){
	$thai_chk = 'indonPass';
	$nation_chk = 'indonesia';
} else if(in_array('4790', $typeCheckArr)){
	$thai_chk = 'philPass';
	$nation_chk = 'phil';
} else if(in_array('4760', $typeCheckArr)){
	$thai_chk = 'malaPass';
	$nation_chk = 'mala';
} else if(in_array('47600', $typeCheckArr)){
	$thai_chk = 'thaiPass5';
	$nation_chk = 'thai';
} else if(in_array('486000', $typeCheckArr)){
	$thai_chk = 'thaiPass1';
	$nation_chk = 'thai';
} else {
	$thai_chk = '';
	$nation_chk = '';
}



$sql="select * from site_option where 1=1 and member_no='".$member_no."'";
$result=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);

if ($tripType=="1") {
	if ($row['type_check_1']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
} elseif ($tripType=="2") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
} elseif ($tripType=="3") {
	if ($row['type_check_3']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
}
?>