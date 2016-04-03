<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_email      = mres_ss($_POST['input_email']);

		$res = runQuery("select email_id from users where email_id='$input_email'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$base10Rand = mt_rand();
			$newRand = base_convert($base10Rand, 10, 36);
			$res = runQuery("update users set email_verify_code='$newRand' where email_id='$input_email'");
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				$subject = "OTP for Forget Password from WeCarriers";
				$message = "Hello ".$row['username'].",<br/>".
						   "Your One Time Password for password recovery is<br/>".
						   "<br/>".$newRand;
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
		}else{
			$data["success"] = false;
			$errors["submit"] = "Email Address is not registered!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);
}

?>