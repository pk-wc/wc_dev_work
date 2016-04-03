<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$target_dir = "images/";
$emailChanged = false;

$wc_uid = getSessionUID();

if($wc_uid){
	if(isset($_POST['input_id_proof_type']) && isset($_POST['input_address_proof_type']) ){
		$input_id_proof_type      = mres_ss($_POST['input_id_proof_type']);
		$input_address_proof_type = mres_ss($_POST['input_address_proof_type']);
		
		$input_id_proof_file      = $_FILES['input_id_proof_file'];
		$input_address_proof_file = $_FILES['input_address_proof_file'];

		$updateStr = "";
		$res = runQuery("select * from users where user_id='$wc_uid'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			if(isValidProof("id", $input_id_proof_type)){
				if(isValidProof("address", $input_address_proof_type)){
					
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
					
					
					//$image_file_type = pathinfo(basename($input_id_proof_file['input_id_proof_file']), PATHINFO_EXTENSION);
					$target_file = $target_dir.$row['mobile_no']."_".$wc_uid."_id";
					//$image_name_hash = md5($target_file);
					//$final_image_name = $image_name_hash.$image_file_type;
					$final_image_name = $target_file;
					if(!move_uploaded_file($input_id_proof_file['tmp_name'], $final_image_name)){
						$page_message = buildMessage("Update Failed!", "Failed to upload your ID Proof");
						goto exit_point;
					}
				
					//$image_file_type = pathinfo(basename($input_address_proof_file['input_address_proof_file']), PATHINFO_EXTENSION);
					$target_file = $target_dir.$row['mobile_no']."_".$wc_uid."_address";
					//$image_name_hash = md5($target_file);
					//$final_image_name = $image_name_hash.$image_file_type;
					$final_image_name = $target_file;
					if(!move_uploaded_file($input_address_proof_file['tmp_name'], $final_image_name)){
						$page_message = buildMessage("Update Failed!", "Failed to upload your Address Proof");
						goto exit_point;
					}
					$res = runQuery("update users set id_proof_name='$input_id_proof_type',address_proof_name='$input_address_proof_type' where user_id='$wc_uid'");
				}else{
					$page_message = buildMessage("Update Failed!", "Please provide a valid Address Proof Type");
				}
			}else{
				$page_message = buildMessage("Update Failed!", "Please provide a valid ID Proof Type");
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
header("location: myProfile.php?as_a=personal");

?>