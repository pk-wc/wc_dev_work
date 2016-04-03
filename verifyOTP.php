<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_email      = mres_ss($_POST['input_email']);
		$input_otp      = mres_ss($_POST['input_otp']);

		$res = runQuery("select * from users where email_id='$input_email' and binary email_verify_code='$input_otp'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$hash = md5($input_otp);
			$res = runQuery("update users set password='$hash' where email_id='$input_email'");
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				$_SESSION['wc_uid'] = $row['user_id'];
				$data["success"] = true;
				$page_message = buildMessage("Success!", "Your current password is OTP sent to your email.");
				setPageSuccessMessage($page_message);
			}	
		}else{
			$data["success"] = false;
			$errors["submit"] = "OTP is incorrect!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);
}

?>