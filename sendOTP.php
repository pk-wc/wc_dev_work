<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_email      = mres_ss($_POST['input_email']);

		$res = runQuery("select * from users where email_id='$input_email'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$subject = "OTP for Forget Password from WeCarriers";
			$message = "Hello ".$row['username'].",<br/>".
					   "Your One Time Password for password recovery is<br/>".
					   "<br/>".$row['email_verify_code'];
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: WeCarriers <no-reply@wecarriers.com>' . "\r\n";
			$mailSent = mail($input_email, $subject, $message, $headers);	
			if(!$mailSent){
				$data["success"] = false;
				$errors["submit"] = "Unable to send reset password code to email address!";
				$data["errors"]  = $errors;
			}else{
				$data["success"] = true;
			}	
		}
		echo json_encode($data);
}

?>