<?php

session_start();
require_once("custom/funcs/functions.php");

$wc_uid = getSessionUID();

if($wc_uid){
	$timestamp = date("Y-m-d H:i:s");
	$res = runQuery("update users set last_login_timestamp='$timestamp' where user_id='$wc_uid'");
}

?>