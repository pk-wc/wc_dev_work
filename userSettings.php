<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$wc_uid = getSessionUID();

if($wc_uid){
		$input_old_password    = mres_ss($_POST['input_old_password']);
		$input_new_password    = mres_ss($_POST['input_new_password']);
		$input_re_new_password = mres_ss($_POST['input_re_new_password']);

		$res = runQuery("select password from users where user_id='$wc_uid'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$string = md5($input_old_password);
			$subs = substr($string, 0, strlen($row['password']));
			if($subs == $row['password']){
				$hash = md5($input_new_password);
				if($hash==$subs){
					$data["success"] = false;
					$errors["submit"] = "Current and New password must be different!";
					$data["errors"]  = $errors;
				}else{
					$q = "update users set password='$hash' where user_id='$wc_uid'";
					$res = runQuery($q);
					if(!$res){
						$data["success"] = false;
						$errors["submit"] = "Server is busy!";
						$data["errors"]  = $errors;
					}else{
						$data["success"] = true;
						$page_message = buildMessage("Success!", "Your password have been updated successfully");
						setPageSuccessMessage($page_message);
					}	
				}	
			}else{
				$data["success"] = false;
				$errors["submit"] = "Your current password does not match with our records!";
				$data["errors"]  = $errors;
			}
		}else{
			$data["success"] = false;
			$errors["submit"] = "Server is busy!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);	
}

?>