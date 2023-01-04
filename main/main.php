<?
require_once $_SERVER['DOCUMENT_ROOT']."/include/common_siteinfo.php";

if (_TOURSAFE_SUBSITE_SERVICE=='2') {
?>
<form  action="/tscommon/main/main2.php" method="POST" name="serviceForm" id="sendForm">
    <input type="hidden" name="toursafe_member_no" value="<?=_TOURSAFE_MEMBER_NO?>" />
</form>
<script type="text/javascript">
    document.serviceForm.submit();
</script>
<?
} else {
?>
<meta http-equiv="refresh" content="0;URL=https://<?=_TOURSAFE_SUBSITE_NAME?>.toursafe.co.kr/main/main.php">
<?
}
?>