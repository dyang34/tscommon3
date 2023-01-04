<?php
//if($_SESSION['login_check_key_name']=="" || $_SESSION['login_check_key_1']=="" || $_SESSION['login_check_key_2']=="") {
if($_SESSION['phone_check_session']=="") {
?>
<script>
	alert('세션이 종료되었습니다. 다시 시도해 주세요.');
	location.href="/tscommon/check/01.php";
</script>
<?php
	exit;
}

?>