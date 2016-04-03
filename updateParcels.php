<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$order_id = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if($wc_uid){
		$order_id                  = mres_ss($_POST['order_id']);
		$input_pickup_address_id   = mres_ss($_POST['input_pickup_address_id']);
		$input_delivery_address_id = mres_ss($_POST['input_delivery_address_id']);
		$input_delivery_date       = mres_ss($_POST['input_delivery_date']);
		$input_weight              = mres_ss($_POST['input_weight']);
		$input_price               = mres_ss($_POST['input_price']);
		$input_headline            = mres_ss($_POST['input_headline']);
		$input_notes               = mres_ss($_POST['input_notes']);

		//if(verifyUserProfile($wc_uid) != 0){
			$q = "update orders set pickup_address_id='$input_pickup_address_id',".
			     "delivery_address_id='$input_delivery_address_id',delivery_date='$input_delivery_date',weight='$input_weight',".
			     "price='$input_price',headline='$input_headline',notes='$input_notes' where order_id='$order_id'";
			$res = runQuery($q);
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;	
			}else{
				$data["success"] = true;
		        	$page_message = buildMessage("Success!", "Your Parcel has been updated successfully.");
				setPageSuccessMessage($page_message);
			}
		/*}else{
			$data["success"] = false;
			$errors["registration"] = "Registration Incomplete!", "Please complete your profile.";
			$data["errors"]  = $errors;	
			$data["location"] = "pendingProfile.php";
		}*/
		echo json_encode($data);
		
}

?>