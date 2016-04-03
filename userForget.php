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
		if(res && mysqli_num_rows($res)){
				$randomString = "http://wecarriers.com/ravi_4/regConfirm.php?verifyString=".$input_email."_wecarrier_".$newRand;

				$subject = "Activation Request from WeCarriers";
				$message = "Welcome ".$input_username.",<br/>".
						   "Please <a href=\"".$randomString."\">Click Here</a> to confirm your Subscription<br/>".
						   "<br/>".
						   "Thank You";
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
		        		$page_message = buildMessage("Congratulations!", "Your Registration is successfull. Please verify both your Mobile Number and Email Address.");
					setPageSuccessMessage($page_message);
				}
		}else{
			$data["success"] = false;
			$errors["submit"] = "Email Address is not registered!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);
}

?>