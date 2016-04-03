<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();

if($wc_uid){
		$rid                = mres_ss($_POST['rid']);
		$input_user_rating  = mres_ss($_POST['input_user_rating']);
		$input_user_comment = mres_ss($_POST['input_user_comment']);

		$q = "update reviews set rating='$input_user_rating', comment='$input_user_comment' where review_id='$rid'";
		$res = runQuery($q);
		if(!$res){
			$data["success"] = false;
			$errors["submit"] = "Server is busy!";
			$data["errors"]  = $errors;
		}else{
			$data["success"] = true;
        		$page_message = buildMessage("Success!", "Your review has been updated successfully");
			setPageSuccessMessage($page_message);
		}
		echo json_encode($data);
}

?>