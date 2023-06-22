<?php

  $root_dir = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos(substr($_SERVER['DOCUMENT_ROOT'], 0, strlen($_SERVER['DOCUMENT_ROOT'])-1),'/',0));
  require_once $root_dir."/tscommon3/include/common.php";

	if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS']=="") {
		$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("Location: $redirect");
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>

<title><?=$shop_name?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="ALV Generator" />
<meta name="description" content="국내외 어디든 간편하게 가입하는 여행자보험, 투어세이프">
<meta property="og:description" content="국내외 어디든 간편하게 가입하는 여행자보험, 투어세이프">
<meta name="keywords" content="투어세이프, 여행자보험, 여행자보험추천, 여행자보험비교, 국내여행자보험, 여행보험, 해외여행자보험, 해외여행보험, 여행, 해외여행, 국내여행, 휴가, 출장, 유학, 유학생보험, 유학보험">
<meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width">

<style>
  :root {
    --bis-color-point: <?=_TOURSAFE_SUBSITE_COLOR?>;
  }
</style>

<link rel="icon" type="image/png" sizes="32x32" href="/tscommon/img/ico/favicon.ico">
<link rel="stylesheet" type="text/css" href="/tscommon/css/basefont.css?v=<?=time()?>">
<link rel="stylesheet" type="text/css" href="/tscommon/css/base.css?v=<?=time()?>">
<link rel="stylesheet" type="text/css" href="/tscommon/css/bbs.css?v=<?=time()?>">
<link rel="stylesheet" type="text/css" href="/tscommon/css/btn.css?v=<?=time()?>">
<link rel="stylesheet" type="text/css" href="/tscommon/css/layout.css?v=<?=time()?>">
<link rel="stylesheet" type="text/css" href="/tscommon/css/jquery-ui.css?v=<?=time()?>">

<script type="text/javascript" src="/tscommon/js/jquery.min.js?v=<?=time()?>"></script>
<script type="text/javascript" src="/tscommon/js/jquery-ui.custom.js?v=<?=time()?>"></script>
<script type="text/javascript" src="/tscommon/js/design.js?v=<?=time()?>"></script>
<script type="text/javascript" src="/tscommon/js/common.js?v=<?=time()?>"></script>
<script type="text/javascript" src="/tscommon/js/placeholders.min.js?v=<?=time()?>"></script> 
<?
if (_TOURSAFE_SUBSITE_NAME=="ts1") {
?>
<!-- Mirae Script Ver 2.0 -->
<script async="true" src="//log1.toup.net/mirae_log_chat_common.js?adkey=rl1gkMj" charset="UTF-8"></script>
<!-- Mirae Script END Ver 2.0 -->
<?
}
?>

<?php /*
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140688000-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-140688000-1');

 var getOutboundLink = function(url) {
  gtag('event', 'click', {
    'event_category': 'dusitprincess_ad',
    'event_label': url,
    'transport_type': 'beacon',
    'event_callback': function(){document.location = url;}
  });
}
</script>
*/?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-57SSLHD');</script>
<!-- End Google Tag Manager -->"

</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-57SSLHD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<ul id="skipToContent">
  <li><a href="#container">본문 바로가기</a></li>
  <li><a href="#gnbW">주메뉴 바로가기</a></li>
</ul>
<!-- loading -->
<div class="loading_area" id="loading_area" style="display:none">
    <div class="loader"></div>
    <div id="bg"></div>
</div>
<!-- //loading -->