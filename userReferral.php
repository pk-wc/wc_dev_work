<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 
$errors["submit"] = "Unable to send referral code to ";
$temp=1;
$wc_uid = getSessionUID();

if($wc_uid){
		$input_email      = mres_ss($_POST['email']);
		$input_phone      = mres_ss($_POST['phone']);
	
		$res = runQuery("select * from users where user_id='$wc_uid'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$name = $row['username'];
			$email = $row['email_id'];
			if($input_email){
				$subject = "Referral Code for WeCarriers";
				$message = "Hello,<br/><br/>".
						   "Use my referral code ".$row['referral_code']." to sign up for wecarriers.com and get 60 WEpoints.<br/>".
						   "<br/>Regards,<br/>".$name."<br/>".$row['mobile_no']."<br/>".$email;
				$headers  = "MIME-Version: 1.0" . "\r\n";
				
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: WeCarriers <no-reply@wecarriers.com>' . "\r\n";
				$mailSent = mail($input_email, $subject, $message, $headers);
				if(!$mailSent){
					$data["success"] = false;
					$errors["submit"] .= " email address ";
					$data["errors"]  = $errors;
					$temp=0;
				}
			}
			if($input_phone){
				$sms_txt = "Use my referral code ".$row['referral_code']." to sign up for wecarriers.com and get 60 WEpoints."." Regards, ".$name."(".$row['mobile_no'].")";
				$sms_res = sendSMS($sms_txt, $input_phone);
				if(strcmp($sms_res, "Sent.") != 0){
					generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
					$data["success"] = false;
					$errors["submit"] .= " mobile number ";
					$data["errors"]  = $errors;
					$temp=0;
				}
			}
		}
		if($temp==1){
			$data["success"] = true;
			$page_message = buildMessage("Congratulations!", "Your Referral code is sent to your given email address or/and mobile number.");			
			setPageSuccessMessage($page_message);
		}
		echo json_encode($data);
}

?>