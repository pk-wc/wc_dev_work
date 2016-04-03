<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 
$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if (empty($_POST['input_address_label']))
        	$errors["input_address_label"] = "Label is required.";
        if (empty($_POST['input_pincode']))
        	$errors["input_pincode"] = "Pincode is required.";
        else if (!isValidPincode($_POST['input_pincode']))
        	$errors["input_pincode"] = "Invalid Pincode.";
        if (empty($_POST['input_address']))
        	$errors["input_address"] = "Address is required.";
        
        if (!empty($errors)) {
        	$data["success"] = false;
        	$data["errors"]  = $errors;
    	}else{
    		$input_address_label = mres_ss($_POST['input_address_label']);
		$input_pincode       = mres_ss($_POST['input_pincode']);
		$input_address       = mres_ss($_POST['input_address']);
		$city                = mres_ss($_POST['city']);
		$state               = mres_ss($_POST['state']);
		
		$res = runQuery("select address_id from address where address_label='$input_address_label' and address_id in (select address_id from user_address where user_id='$wc_uid')");
		
		if($res && mysqli_num_rows($res)){
			$data["success"] = false;
			$errors["input_address_label"] = "Duplicate Label";
        		$data["errors"]  = $errors;
		}else{
			$con = connectDB();
			$res = mysqli_query($con, "insert into address (address_label,pincode,address,city,state) values ('$input_address_label','$input_pincode','$input_address','$city','$state')");
			if(!$res){
				  $data["success"] = false;
				  $errors["submit"] = "Server is busy!";
				  $data["errors"]  = $errors;
			}else{
				$get_id = mysqli_insert_id($con);
				$res = runQuery("insert into user_address (user_id,address_id) values ('$wc_uid','$get_id')");
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;
				}else{
					$data["success"] = true;
		        		$page_message = buildMessage("Success!", "Your address has been saved successfully");
					setPageSuccessMessage($page_message);
				}
			}
			closeDB($con);
		}
    	}
    	echo json_encode($data);
}

?>