<?php

session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$address_id          = mres_ss($_POST['address_id']);
$input_address_label = mres_ss($_POST['input_address_label']);

$wc_uid = getSessionUID();

if($wc_uid){
	if (empty($input_address_label)){
	        $errors["input_address_label"] = "Label is required.";
	        $data["success"] = false;
        	$data["errors"]  = $errors;
        }else{
		$res = runQuery("select * from address where address_label='$input_address_label' and address_id in (select address_id from user_address where user_id='$wc_uid')");
		
		if($res && mysqli_num_rows($res) ){
			$row = mysqli_fetch_array($res);
			if($row['address_id'] != $address_id){
				$data["success"] = false;
				$errors["input_address_label"] = "Duplicate Label!";
	        		$data["errors"]  = $errors;
			}else{
				$data["success"] = true;
			}
		}
	}
	echo json_encode($data);
}
 
?>