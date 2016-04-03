<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 
$new_user_points = 30;//points added to new user account if referral code is not used
$old_user_points = 0;

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_mobile     = mres_ss($_POST['input_mobile']);
		$input_email      = mres_ss($_POST['input_email']);
		$input_username   = mres_ss($_POST['input_username']);
		$input_password   = mres_ss($_POST['input_password']);
		$input_repassword = mres_ss($_POST['input_repassword']);
		$code		  = mres_ss($_POST['input_code']);

		$res = runQuery("select mobile_no from users where mobile_no='$input_mobile'");
		if($res && mysqli_num_rows($res)){
			$data["success"] = false;
			$errors["submit"] = "Mobile number is already registered!";
			$data["errors"]  = $errors;
		}else{
			$con = connectDB();
			$res = mysqli_query($con,"select email_id from users where email_id='$input_email'");
			closeDB($con);
			if(res && mysqli_num_rows($res)){
				$data["success"] = false;
				$errors["submit"] = "Email Address is already registered!";
				$data["errors"]  = $errors;
			}else{
				if($code)
				{
					$new_user_points = 60;//points added to new user account if referral code is correct
					$old_user_points = 30;//points added to user account whose referral code is used
				}
				//$salt = substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22);
				//$hash = crypt($input_password, '$2a$12$' . $salt);
				//$cost = 10;
				//$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
				//$salt = sprintf("$2a$%02d$", $cost) . $salt;
				//$hash = crypt($input_password, $salt);
				//$hash = crypt($input_password);
				$hash = md5($input_password);

				$length = 13;
				$rangeMin = pow(36, $length-1);
				$rangeMax = pow(36, $length)-1;
				//$base10Rand = mt_rand($rangeMin, $rangeMax);
				$base10Rand = mt_rand();
				$newRand = base_convert($base10Rand, 10, 36);

				$con = connectDB();
				$res = mysqli_query($con,"insert into users (mobile_no,username,password,email_id,email_verify_code,referral_code,points) values ('$input_mobile','$input_username','$hash','$input_email','$newRand','$newRand','$new_user_points')");
				closeDB($con);
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;
				}else{
					$res1 = runQuery("select * from users WHERE referral_code='$code'");
					if($res1){
						$row1 = mysqli_fetch_array($res1);
						$oldPoints = $row1['points'];
						$newPoints = $oldPoints + $old_user_points;
						$res1 = runQuery("update users set points = '$newPoints' where referral_code='$code'");
						if(!$res1){
							$data["success"] = false;
							$errors["submit"] = "Unable to update WEpoints in main user!";
							$data["errors"]  = $errors;
						}
					}
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
					//$mailSent = SendMail($input_email, $subject, $message);
					if(!$mailSent){
						$data["success"] = false;
						$errors["submit"] = "Unable to send Email verification code!";
						$data["errors"]  = $errors;
					}else{
						$data["success"] = true;
			        		$page_message = buildMessage("Congratulations!", "Your Registration is successfull. Please verify both your Mobile Number and Email Address.");
						setPageSuccessMessage($page_message);
					}
				}
			}
		}
		echo json_encode($data);
}

?>