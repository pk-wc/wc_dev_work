<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

	
if($wc_uid){
		$input_message = mres_ss($_POST['input_message']);
		$request_id    = mres_ss($_POST['rid']);

		
		$res = runQuery("select * from requests where request_id='$request_id'");
		if($res && mysqli_num_rows($res)){
			$q = "insert into chats (request_id, user_id, message) values ('$request_id', '$wc_uid', '$input_message')";
			$res = runQuery($q);
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				$data["success"] = true;
			}
		}else{
			$data["success"] = false;
			$errors["submit"] = "Invalid Request!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);
}

?>