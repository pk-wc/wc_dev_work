<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 
$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	
		$input_source_address_id      = mres_ss($_POST['input_source_address_id']);
		$input_destination_address_id = mres_ss($_POST['input_destination_address_id']);
		$input_journey_date           = mres_ss($_POST['input_journey_date']);
		$input_headline               = mres_ss($_POST['input_headline']);
		$input_notes                  = mres_ss($_POST['input_notes']);

		//if(verifyUserProfile($wc_uid) != 0){
			$timestamp = date("Y-m-d H:i:s");
			$con = connectDB();
			$res = mysqli_query($con,"insert into journeys (source_address_id,destination_address_id,headline,journey_date,notes,posted_on) values ('$input_source_address_id','$input_destination_address_id','$input_headline','$input_journey_date','$input_notes','$timestamp')");
			
			if($res){
				$get_id = mysqli_insert_id($con);
				$res = runQuery("insert into carrier_journeys (user_id,journey_id) values ('$wc_uid','$get_id')");
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;			
				}else{
					$data["success"] = true;
			        	$page_message = buildMessage("Success!", "Your Journey has been saved successfully");
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