<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$ifsc          = mres_ss($_POST['ifsc']);

$wc_uid = getSessionUID();

if($wc_uid){
	$res = runQuery("select * from banks_branch_info where ifsc='$ifsc'");
	if($res && mysqli_num_rows($res)){
		$data["success"] = true;
	}else{
		$data["success"] = false;
		$errors["ifsc"] = "Invalid IFSCode!";
		$data["errors"]  = $errors;
	}
	echo json_encode($data);
}
 
?>