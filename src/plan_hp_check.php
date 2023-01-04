<?php
session_start();
$root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
require_once $root_dir."/tscommon3/include/common.php";

$phone1=addslashes(fnFilterString(strip_tags($_POST['phone1'])));
$phone2=addslashes(fnFilterString(strip_tags($_POST['phone2'])));
$phone3=addslashes(fnFilterString(strip_tags($_POST['phone3'])));

$phone=$phone1.$phone2.$phone3;
if($phone1=="" || $phone2=="" || $phone3=="") {
	$json_code = array('result'=>'false','msg'=>'정보를 정확히 입력하세요.');
	exit;
} else {

	$phoneencode =encode_pass($phone,$pass_key);

//	$sel_q="select * from hana_plan_member where member_no='".$member_no."' and name='".$search_name."' and jumin_1='".$jumin_1."' and jumin_2='".$jumin_2."'";
	$sel_q="select * from hana_plan_member where member_no='".$member_no."' and hphone='".$phoneencode."'";
	$sel_e=mysql_query($sel_q) or die(mysql_error());
	$sel=mysql_fetch_array($sel_e);

	if($sel[no] != "") {

// 메시지발송
function SendMesg($url) {
    // 테스트 후, 서버 상태에 따라 원활한 접속 방법을 이용해주세요.
    //$fp = fsockopen("ssl:munjanara.co.kr", 443, $errno, $errstr, 10);
    $fp = fsockopen("munjanara.co.kr", 80, $errno, $errstr, 10);
    //$fp = fsockopen("munjanara.co.kr", 443, $errno, $errstr, 10);

	if(!$fp){
		echo "$errno : $errstr";
		exit;
	}

	fwrite($fp, "GET $url HTTP/1.0\r\nHost: 211.233.20.184\r\n\r\n"); 
	$flag = 0;

	while(!feof($fp)){
		$row = fgets($fp, 1024);

		if($flag) $out .= $row;
		if($row=="\r\n") $flag = 1;
	}

    fclose($fp);
    return $out;
}

// 장문허용유무
$allowMms = $_POST[allow_mms];

if($allowMms != "1") $allowMms = "0";


// 문자나라 아이디
$userid = "bis18009010";

// 문자나라 2차 비밀번호
// 문자나라 웹사이트 '개인정보변경'에서 2차 비밀번호 설정 후, 동일하게 지정
$passwd = "bis18009010";

// 발신번호사전등록제에 따라 문자나라에 인증확인된 발신번호(핸드폰 또는 일반전화)
$hpSender = "18009010";

// 문자메시지를 실제로 수신할 전화번호
$hpReceiver = $phone;

// 비상시 문자나라에서 문자알림 또는 연락가능한 번호 
$adminPhone = "01092927770";

// 수신메시지설정, allow_mms 에 따라 내용이 짤릴 수 있음
// 발신번호 사정등록제에 따라 '고객문의형태'의 경우 입력받은 번호를 발신번호로
// 사용할 수 없으므로 메시지 앞부분에 입력번호를 추가하는 형태
$hpMesg = "[투어세이프] 인증번호 [".$_SESSION['phone_check_session']."]를 입력해 주세요.";

// UTF-8 글자셋 이용으로 한글이 깨지는 경우에만 주석을 푸세요
 $hpMesg = iconv("UTF-8", "EUC-KR","$hpMesg");

// 특수문자 사용에 따른 메시지 인코딩
$hpMesg = urlencode($hpMesg);

// 최종 전송 완료후, 자동으로 완료창을 띄울 것인지 결정 (1:띄움, 0:안띄움)
$endAlert = 1;

// 전송
$url = "/MSG/send/web_admin_send.htm?userid=$userid&passwd=$passwd&sender=$hpSender&receiver=$hpReceiver&encode=1&message=$hpMesg&end_alert=$endAlert&allow_mms=$allowMms";

SendMesg($url);

	$_SESSION['phone_check']=$phoneencode;

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