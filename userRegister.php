<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_mobile     = mres_ss($_POST['input_mobile']);
		$input_email      = mres_ss($_POST['input_email']);
		$input_username   = mres_ss($_POST['input_username']);
		$input_password   = mres_ss($_POST['input_password']);
		$input_repassword = mres_ss($_POST['input_repassword']);

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

				/* SMS Code generation */
				$min_range = 1000;
				$max_range = 9999;
				$sms_code = rand($min_range, $max_range);

				$con = connectDB();
				$res = mysqli_query($con,"insert into users (mobile_no,mobile_no_code,username,password,email_id,email_verify_code) values ('$input_mobile','$sms_code','$input_username','$hash','$input_email','$newRand')");
				closeDB($con);
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;
				}else{
					/* Mobile No Verification */
					$sms_txt = "The SMS verification code is ".$sms_code.". Please complete your mobile verfication with the code sent above.";
					$sms_res = sendSMS($sms_txt, $input_mobile);
					if(strcmp($sms_res, "Sent.") != 0){
						generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
					}

					/* Email Verification */
					$randomString = "http://wecarriers.com/prasad_1/regConfirm.php?verifyString=".$input_email."_wecarrier_".$newRand;

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