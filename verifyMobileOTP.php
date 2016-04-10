<?php
/*
 *  CR 44
 *  - To verify mobile number through OTP.
 *  Fix BEGIN
 */

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if(!$wc_uid){
		$input_mobile = mres_ss($_POST['input_verify_mobile']);
		$input_otp    = mres_ss($_POST['input_otp']);

		$res = runQuery("select * from users where mobile_no='$input_mobile' and mobile_no_code='$input_otp'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			generateLog("User with ID = ".$row['user_id']."has provided a valid SMS code");
			$res1 = runQuery("update users set mobile_no_status='1' where user_id='".$row['user_id']."'");
			$_SESSION['wc_uid'] = $row['user_id'];
			$data["success"] = true;
			$page_message = buildMessage("Success!", "Your Mobile Number has verified successfully.");
			setPageSuccessMessage($page_message);
			generateLog("All verification has been completed successfully");
		}else{
			generateLog("User with ID = ".$row['user_id']."has failed SMS verification");
			$data["success"] = false;
			$errors["submit"] = "The OTP provided is Invalid!";
			$data["errors"]  = $errors;
		}
		echo json_encode($data);
}
/*  Fix END - 44  */

?>