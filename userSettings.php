<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_POST['input_old_password']) && isset($_POST['input_new_password']) && isset($_POST['input_re_new_password']) ){
		$input_old_password    = mres_ss($_POST['input_old_password']);
		$input_new_password    = mres_ss($_POST['input_new_password']);
		$input_re_new_password = mres_ss($_POST['input_re_new_password']);

		$res = runQuery("select password from users where user_id='$wc_uid'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			if(isValidPassword($input_old_password) && isValidPassword($input_new_password) && isValidPassword($input_re_new_password)){
				$string = md5($input_old_password);
				$subs = substr($string, 0, strlen($row['password']));
				if($subs == $row['password']){
					if(strcmp($input_new_password, $input_re_new_password) == 0){
						$hash = md5($input_new_password);
						$q = "update users set password='$hash' where user_id='$wc_uid'";
						$res = runQuery($q);
						if(!$res){
							$page_message = buildMessage("Update Failed!", "An error occurred while updating your settings");
						}
					}else{
						$page_message = buildMessage("Update Failed!", "The new and re-typed new password do not match");
					}
				}else{
					$page_message = buildMessage("Update Failed!", "Your current password does not match with our records");
				}
			}else{
				$page_message = buildMessage("Update Failed!", "Please provide appropriate values");
			}
		}else{
			$page_message = buildMessage("Update Failed!", "An error occurred while updating your settings");
		}
	}else{
		$page_message = buildMessage("Update Failed!", "Please provide appropriate values");
	}

	if(strlen($page_message) > 0){
		//generateLog($page_message);
		setPageErrorMessage($page_message);
	}else{
		$page_message = buildMessage("Success!", "Your settings have been updated successfully");
		setPageSuccessMessage($page_message);
	}
}

//echo $page_message;
header("location: mySettings.php");

?>