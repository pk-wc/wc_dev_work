<?php

session_start();
require_once("custom/funcs/functions.php");
require_once('custom/funcs/send_mail/mailsend.php');

$page_message = "";
$target_dir = "images/";
$emailChanged = false;

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_POST['input_email']) && isset($_POST['input_id_proof_type']) && isset($_POST['input_address_proof_type']) ){
		$input_email              = mres_ss($_POST['input_email']);
		$input_id_proof_type      = mres_ss($_POST['input_id_proof_type']);
		$input_address_proof_type = mres_ss($_POST['input_address_proof_type']);
		$input_id_proof_file      = $_FILES['input_id_proof_file'];
		$input_address_proof_file = $_FILES['input_address_proof_file'];

		$updateStr = "";
		$res = runQuery("select * from users where user_id='$wc_uid'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			if(validEmail($input_email)){
				if(isValidProof("id", $input_id_proof_type)){
					if(isValidProof("address", $input_address_proof_type)){
						if(strcmp($row['email_id'], $input_email)){
							$updateStr .= "email_id='$input_email', email_id_status='0'";
							$emailChanged = true;
						}
						if(strcmp($row['id_proof_name'], $input_id_proof_type)){
							$id_proof_changed = true;
							if(strlen($updateStr) > 0){
								$updateStr .= ", ";
							}
							$updateStr .= "id_proof_name='$input_id_proof_type', id_proof_status='0'";
							if($input_id_proof_file['size'] > 0){
								if(!file_exists($target_dir)){
									$page_message = buildMessage("Update Failed!", "Failed to upload your ID Proof");
									goto exit_point;
								}
								if(!isValidProofImage($input_id_proof_file)){
									$page_message = buildMessage("Update Failed!", "Pls provide a valid ID Proof Image");
									goto exit_point;
								}
							}else{
								$page_message = buildMessage("Update Failed!", "Pls provide a valid ID Proof Image");
								goto exit_point;
							}
						}
						if(strcmp($row['address_proof_name'], $input_address_proof_type)){
							$address_proof_changed = true;
							if(strlen($updateStr) > 0){
								$updateStr .= ", ";
							}
							$updateStr .= "address_proof_name='$input_address_proof_type', address_proof_status='0'";
							if($input_address_proof_file['size'] > 0){
								if(!file_exists($target_dir)){
									$page_message = buildMessage("Update Failed!", "Failed to upload your Address Proof");
									goto exit_point;
								}
								if(!isValidProofImage($input_address_proof_file)){
									$page_message = buildMessage("Update Failed!", "Pls provide a valid Address Proof Image");
									goto exit_point;
								}
							}else{
								$page_message = buildMessage("Update Failed!", "Pls provide a valid Address Proof Image");
								goto exit_point;
							}
						}
						if(strlen($updateStr) > 0){
							if($emailChanged){
								$length = 13;
								$rangeMin = pow(36, $length-1);
								$rangeMax = pow(36, $length)-1;
								//$base10Rand = mt_rand($rangeMin, $rangeMax);
								$base10Rand = mt_rand();
								$newRand = base_convert($base10Rand, 10, 36);
								if(strlen($updateStr) > 0){
									$updateStr .= ", ";
								}
								$updateStr .= "email_verify_code='$newRand'";
							}
							$res = runQuery("update users set ".$updateStr." where user_id='$wc_uid'");
							if(!$res){
								$page_message = buildMessage("Update Failed!", "An error occurred while updating your profile");
								goto exit_point;
							}
							if($emailChanged){
								$randomString = "http://wecarriers.com/dev_work/regConfirm.php?verifyString=".$input_email."_wecarrier_".$newRand;

								$subject = "Activation Request from WeCarriers";
								$message = "Welcome ".$row['username'].",<br/>".
										   "Please <a href=\"".$randomString."\">Click Here</a> to confirm your Subscription<br/>".
										   "<br/>".
										   "Thank You";
								$headers  = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
								$headers .= 'From: WeCarriers <no-reply@wecarriers.com>' . "\r\n";
								$mailSent = mail($input_email, $subject, $message, $headers);
								//$mailSent = SendMail($input_email, $subject, $message);
								if(!$mailSent){
									$page_message = buildMessage("Update Failed!", "Failed to Register the specified Email ID<br/>");
									goto exit_point;
								}
							}
							if($id_proof_changed){
								//$image_file_type = pathinfo(basename($input_id_proof_file['input_id_proof_file']), PATHINFO_EXTENSION);
								$target_file = $target_dir.$row['mobile_no']."_".$wc_uid."_id";
								//$image_name_hash = md5($target_file);
								//$final_image_name = $image_name_hash.$image_file_type;
								$final_image_name = $target_file;
								if(!move_uploaded_file($input_id_proof_file['tmp_name'], $final_image_name)){
									$page_message = buildMessage("Update Failed!", "Failed to upload your ID Proof");
									goto exit_point;
								}
							}
							if($address_proof_changed){
								//$image_file_type = pathinfo(basename($input_address_proof_file['input_address_proof_file']), PATHINFO_EXTENSION);
								$target_file = $target_dir.$row['mobile_no']."_".$wc_uid."_address";
								//$image_name_hash = md5($target_file);
								//$final_image_name = $image_name_hash.$image_file_type;
								$final_image_name = $target_file;
								if(!move_uploaded_file($input_address_proof_file['tmp_name'], $final_image_name)){
									$page_message = buildMessage("Update Failed!", "Failed to upload your Address Proof");
									goto exit_point;
								}
							}
						}else{
							$page_message = buildMessage("Nothing to Update!", "No changes were found in your profile");
						}
					}else{
						$page_message = buildMessage("Update Failed!", "Please provide a valid Address Proof Type");
					}
				}else{
					$page_message = buildMessage("Update Failed!", "Please provide a valid ID Proof Type");
				}
			}else{
				$page_message = buildMessage("Update Failed!", "Please provide a valid Email Address");
			}
		}else{
			$page_message = buildMessage("Update Failed!", "An error occurred while updating your profile");
		}
	}else{
		$page_message = buildMessage("Update Failed!", "An error occurred while updating your profile");
	}


	exit_point:
	if(strlen($page_message) > 0){
		//generateLog($page_message);
		setPageErrorMessage($page_message);
	}else{
		$page_message = buildMessage("Success!", "Your profile has been updated successfully");
		setPageSuccessMessage($page_message);
	}
}

//echo $page_message;
header("location: myProfile.php");

?>