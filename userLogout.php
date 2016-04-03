<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";

$wc_uid = getSessionUID();
if($wc_uid){
	deleteSessionUID();
}

header("location: index.php");

?>