<?php
if ($_SESSION['s_session_key']!='') {
	$typeCheckArr=explode("_",decode_pass($_SESSION['s_session_key'],$pass_key));
	$tripType=$typeCheckArr[1];
}
?>