<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 
$page_message = "";
$journey_id = "";

$wc_uid = getSessionUID();

if($wc_uid){
		$journey_id                   = mres_ss($_POST['journey_id']);
		$input_source_address_id      = mres_ss($_POST['input_source_address_id']);
		$input_destination_address_id = mres_ss($_POST['input_destination_address_id']);
		$input_journey_date           = mres_ss($_POST['input_journey_date']);
		$input_headline               = mres_ss($_POST['input_headline']);
		$input_notes                  = mres_ss($_POST['input_notes']);

		//if(verifyUserProfile($wc_uid) != 0){
			$q = "update journeys set source_address_id='$input_source_address_id',".
			     "destination_address_id='$input_destination_address_id',journey_date='$input_journey_date',".
			     "headline='$input_headline',notes='$input_notes' where journey_id='$journey_id'";
			$res = runQuery($q);
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;	
			}else{
				$data["success"] = true;
		        	$page_message = buildMessage("Success!", "Your Journey has been updated successfully.");
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