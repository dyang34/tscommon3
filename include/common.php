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

require_once $_SERVER['DOCUMENT_ROOT']."/include/common_siteinfo.php";
/*
if (_TOURSAFE_SUBSITE_SERVICE != '1') {
	header("Location: https://".$_SERVER['HTTP_HOST']."/tscommon/main/main2.php");
}
*/
$root_dir=str_replace(_TOURSAFE_SUBSITE_DIR,"",$_SERVER['DOCUMENT_ROOT']);
$common_root_dir = $root_dir."/tscommon3";
$member_no=_TOURSAFE_MEMBER_NO;
//$site_config_company_type = "1";

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
?>