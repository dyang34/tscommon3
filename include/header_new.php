<?php
	  $root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
    require_once $root_dir."/tscommon3/include/common.php";
  

	if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']=="") {
		$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("Location: $redirect");
	}

	$sql="select * from site_option where 1=1 and member_no = "._TOURSAFE_MEMBER_NO."";
	$result=mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($result);

function isMobile() {
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

    $mobileAgents = array(
        'iphone',
        'ipod',
        'ipad',
        'android',
        'blackberry',
        'windows ce',
        'nokia',
        'webos',
        'opera mini',
        'sonyericsson',
        'opera mobi',
        'iemobile'
    );

    foreach($mobileAgents as $agent) {
        if (strpos($userAgent, $agent) !== false) {
            return true;
        }
    }

    return false;
}

if (isMobile()) {
    header("Location: /main/main_new_m.php");    
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width">

  <title>여행자보험 간편가입 - 메리츠화재 | 유다이렉트</title>
  
  <meta name="title" content="" />
  <meta name="description" content="" />
  <meta name="author" content="비아이에스">
  <meta name="keywords" content="여행자보험, 여행자보험추천, 여행자보험비교, 국내여행자보험, 여행보험, 해외여행자보험, 해외여행보험, 여행, 해외여행, 국내여행, 휴가, 출장, 유학, 유학생보험, 유학보험, 메리츠화재">

  <link rel="stylesheet" type="text/css" href="/tscommon/css/style.ver1.css?v=<?=time()?>">
  <link rel="stylesheet" type="text/css" href="/tscommon/css/swiper-bundle.min.css?v=<?=time()?>">
  <link rel="stylesheet" type="text/css" href="/tscommon/css/basic.ver1.css?v=<?=time()?>">
  <link rel="stylesheet" type="text/css" href="/tscommon/css/modal.ver1.css?v=<?=time()?>">
  <link rel="stylesheet" type="text/css" href="/tscommon/css/button.ver1.css?v=<?=time()?>">

  <script type="text/javascript" src="/tscommon/js/jquery-3.6.1.min.js?v=<?=time()?>"></script>
  <script type="text/javascript" src="/tscommon/js/swiper-bundle.min.js?v=<?=time()?>"></script>
  <script type="text/javascript" src="/tscommon/js/common.js?v=<?=time()?>"></script>

  <script>
	function go_page(type) {

		$("#loading_area").css({"display":"block"});
		$.ajax({
			type : "POST",
			url : "/tscommon/src/type_check.php",
			data :  { "type" : type , "auth_token" : auth_token },
			success : function(data, status) {
				var json = eval("(" + data + ")");

				if (json.result=="true") {
					if (type=="1") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="2") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="3") {
						location.href="/tscommon/study_abroad/01_longterm.php";
					} else if (type=="4") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="5") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="6") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="7") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="8") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="9") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="10") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="11") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="12") {
						location.href="/tscommon/trip/01.php";
					} else if (type=="13") {
						location.href="/tscommon/trip/01.php";
					}

					return false;
				} else {
					alert("qwer");
					alert(json.msg);
					$("#loading_area").delay(100).fadeOut();
					return false;
				}
				
			},
			error : function(err)
			{
				alert(err.responseText);
				$("#loading_area").delay(100).fadeOut();
				return false;
			}
		});
	}

	$(document).ready(function() {
	});
</script>

</head>
<body>
<!-- Header start -->
    <header>
        <div class="head-wrap">
            <h1>
                <a href="/index_longterm.php"><img src="/tscommon/img/common/udirect-travel-white-logo.png" alt="유다이렉트 여행자 보험 로고"></a>
            </h1>
            <nav>
                <div class="dropdown">보험료 계산/가입
                    <div class="dropdown-menu">
                        <a href="javascript:void(0);" onclick="go_page('1');">국내 여행자보험</a>
                        <a href="javascript:void(0);" onclick="go_page('2');">해외 여행자보험(단기)</a>
                        <a href="javascript:void(0);" onclick="go_page('3');">해외 여행자보험(장기)</a>
                    </div>
                </div>
                <a href="/tscommon/check/01.php" class="<?=($menuNo[0]==2)?"active":""?>">가입조회</a>
                <a href="/tscommon/life/life_list.php" class="<?=($menuNo[0]==3)?"active":""?>">라이프</a>
                <a href="/tscommon/service/faq.php" class="<?=($menuNo[0]==4)?"active":""?>">FAQ</a>
            </nav>
        </div>
    </header>
<!-- Header end -->