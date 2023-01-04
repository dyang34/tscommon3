<?php
if($_SESSION['gift_check_1']=="" || $_SESSION['gift_check_2']=="") {
?>
<script>
	alert('세션이 종료되었습니다. 다시 시도해 주세요.');
	location.href="/tscommon/gift/02.php";
</script>
<?php
	exit;
}

?>