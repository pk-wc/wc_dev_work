<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_mobile     = mres_ss($_POST['input_mobile']);
		$input_password   = mres_ss($_POST['input_password']);

		$res = runQuery("select * from users where mobile_no='$input_mobile'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			$string = md5($input_password);
			$subs = substr($string,0,strlen($row['password']));
			if($subs == $row['password']){
				if($row['mobile_no_status'] == 1){
					$_SESSION['wc_uid'] = $row['user_id'];
					$data["success"] = true;
				}else{
					$data["success"] = false;
					$errors["submit"] = "Registration Incomplete! Please validate your Mobile No.";
					$data["errors"]  = $errors;
				}
			}else{
				$data["success"] = false;
				$errors["submit"] = "Password is incorrect!";
				$data["errors"]  = $errors;
			}
		}else{
			$data["success"] = false;
			$errors["submit"] = "Mobile Number is not registered!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);	
}

?>