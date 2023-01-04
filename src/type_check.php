<?php

$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";

if (!chkToken($_REQUEST['auth_token'])) {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$type=addslashes(fnFilterString($_POST['type']));

if ($type=="") {
	$json_code = array('result'=>'false','msg'=>'잘못된 접속 입니다.');
	echo json_encode($json_code);
	exit;
}

$sql="select * from site_option where 1=1 and member_no = "._TOURSAFE_MEMBER_NO;
$result=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);

if ($type=="1") {
	if ($row['type_check_1']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
} elseif ($type=="2") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
} elseif ($type=="3") {
	if ($row['type_check_3']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	}
} elseif ($type=="4") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '4860';		
	}

} elseif ($type=="5") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '4630';
		
	}
} elseif ($type=="6") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '4550';
		
	}
}elseif ($type=="7") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '48600';
		
	}
}elseif ($type=="8") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		$thai_pass = '4940';
		
	}
}elseif ($type=="9") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		$thai_pass = '49400';
		
	}
}elseif ($type=="10") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		$thai_pass = '4790';
		
	}
} elseif ($type=="11") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '4760';		
	}
} elseif ($type=="12") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '47600';		
	}
} elseif ($type=="13") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		//$thai_pass = mb_convert_encoding("thaiPass","UTF-8","EUC-KR");
		$thai_pass = '486000';		
	}
} elseif ($type=="14") {
	if ($row['type_check_2']!="Y") {
		$json_code = array('result'=>'false','msg'=>'지금은 신청할수 없습니다.');
		echo json_encode($json_code);
		exit;
	} else {
		$type = "2";
		$thai_pass = '5630';		
	}
}

session_start("s_session_key");
$thai_pass = iconv('UTF-8', 'ASCII//TRANSLIT',$thai_pass);
if($thai_pass != ''){
	$thaival = $thai_pass;
} else {
	$thaival = 'nonn';	
}

$session_val=time()."_".$type."_".$_SERVER[REMOTE_ADDR]."_".$thaival."_";
$session_key =encode_pass($session_val,$pass_key);
$_SESSION['s_session_key']=$session_key;

$json_code = array('result'=>'true','msg'=>"success");
echo json_encode($json_code);
exit;
?>