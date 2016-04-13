<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if($wc_uid){
		$mobile  = mres_ss($_POST['mobile']);
		$points  = mres_ss($_POST['points']);
		$balance = mres_ss($_POST['balance']) - $points;

		$timestamp = date("Y-m-d H:i:s");
		
		$con = connectDB();
		$q = "insert into redeems (user_id,options,points,status,timestamp) values ('$wc_uid',2,'$points',0,'$timestamp')";
		$res = mysqli_query($con, $q);
		if($res){
			$get_redeem_id = mysqli_insert_id($con);
			$res = runQuery("insert into paytm (mobile,redeem_id) values ('$mobile','$get_redeem_id')");
			if(!$res){
			
				$res = runQuery("delete from redeems where redeem_id='$get_redeem_id'");
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				
				$res = runQuery("update users set points='$balance' where user_id='$wc_uid'");
				
				$data["success"] = true;
	        		$page_message = buildMessage("Success!", "Your WEpoints redeem request has been posted successfully");
				setPageSuccessMessage($page_message);
			}
		}else{
			$data["success"] = false;
			$errors["submit"] = "Server is busy!";
			$data["errors"]  = $errors;
		}
		closeDB($con);
		echo json_encode($data);
}

?>
