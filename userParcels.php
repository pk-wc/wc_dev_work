<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if($wc_uid){
	
		$input_pickup_address_id   = mres_ss($_POST['input_pickup_address_id']);
		$input_delivery_address_id = mres_ss($_POST['input_delivery_address_id']);
		$input_delivery_date       = mres_ss($_POST['input_delivery_date']);
		$input_weight              = mres_ss($_POST['input_weight']);
		$input_price               = mres_ss($_POST['input_price']);
		$input_headline            = mres_ss($_POST['input_headline']);
		$input_notes               = mres_ss($_POST['input_notes']);

		//if(verifyUserProfile($wc_uid) != 0){
			$con = connectDB();
			$timestamp = date("Y-m-d H:i:s");
			$q = "insert into orders (pickup_address_id,delivery_address_id,delivery_date,headline,weight,price,notes,posted_on) values ('$input_pickup_address_id','$input_delivery_address_id','$input_delivery_date','$input_headline','$input_weight','$input_price','$input_notes','$timestamp')";
			$res = mysqli_query($con, $q);
			if($res){
				$get_id = mysqli_insert_id($con);
				$res = runQuery("insert into order_sender (order_id,user_id) values ('$get_id','$wc_uid')");
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;	
				}else{
					$data["success"] = true;
			        	$page_message = buildMessage("Success!", "Your Parcel has been saved successfully");
					setPageSuccessMessage($page_message);
				}
			}else{
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;	
			}
			closeDB($con);
		/*}else{
			$data["success"] = false;
			$errors["registration"] = "Registration Incomplete!", "Please complete your profile.";
			$data["errors"]  = $errors;	
			$data["location"] = "pendingProfile.php";
		}*/
		echo json_encode($data);
}

?>