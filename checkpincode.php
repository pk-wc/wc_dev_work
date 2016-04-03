<?php
session_start();
require_once("custom/funcs/functions.php");

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$input_pincode = mres_ss($_POST['input_pincode']);

$wc_uid = getSessionUID();

if($wc_uid){
	if (empty($input_pincode)){
	        $errors["input_pincode"] = "Pincode is required.";
	        $data["success"] = false;
        	$data["errors"]  = $errors;
        }else{
		$res = runQuery(" SELECT pincode FROM pincodes WHERE pincode='$input_pincode' ");
		if($res && mysqli_num_rows($res) ){	
			$data["success"] = true;
		}else{
			$data["success"] = false;
			$errors["input_pincode"] = "Invalid Pincode!";
        		$data["errors"]  = $errors;
		}
	}
	echo json_encode($data);
}

 
?>