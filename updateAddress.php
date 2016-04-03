<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$address_id = "";

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
    	} else {
		$address_id          = mres_ss($_POST['address_id']);
		$input_address_label = mres_ss($_POST['input_address_label']);
		$input_pincode       = mres_ss($_POST['input_pincode']);
		$input_address       = mres_ss($_POST['input_address']);
		
		$res = runQuery("select * from address where address_label='$input_address_label' and address_id in (select address_id from user_address where user_id='$wc_uid')");
		
		if($res && mysqli_num_rows($res) ){
			$row = mysqli_fetch_array($res);
			if($row['address_id'] != $address_id){
				$data["success"] = false;
				$errors["input_address_label"] = "Duplicate Label";
	        		$data["errors"]  = $errors;
			}
			else
			{
				$q = "update address set address_label='$input_address_label',pincode='$input_pincode',address='$input_address' ".
			     "where address_id='$address_id'";
				$res = runQuery($q);
				if(!$res){
					$data["success"] = false;
					$errors["submit"] = "Server is busy!";
					$data["errors"]  = $errors;
				}else{
					$data["success"] = true;
		        		$page_message = buildMessage("Success!", "Your address has been updated successfully");
					setPageSuccessMessage($page_message);
				}
			}

		}else{
			$q = "update address set address_label='$input_address_label',pincode='$input_pincode',address='$input_address' ".
			     "where address_id='$address_id'";
			$res = runQuery($q);
			if(!$res){
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				$data["success"] = true;
	        		$page_message = buildMessage("Success!", "Your address has been updated successfully");
				setPageSuccessMessage($page_message);
			}
		}
		closeDB($con);
	}
	echo json_encode($data);
}

?>