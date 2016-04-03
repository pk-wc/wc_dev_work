<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$wc_uid = getSessionUID();

if(!$wc_uid){
	$code = mres_ss($_POST['input_code']);
	
	$res = runQuery("select * from users where binary referral_code='$code'");
	
	if($res && mysqli_num_rows($res) ){
		$data["success"] = true;
	}else{
		$data["success"] = false;
	}
	echo json_encode($data);
}
 
?>