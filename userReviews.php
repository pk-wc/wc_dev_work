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

		$con = connectDB();
		$q = "insert into reviews (user_id,rating,comment) values ('$wc_uid','$input_user_rating','$input_user_comment')";
		$res = mysqli_query($con, $q);
		if($res){
			$get_review_id = mysqli_insert_id($con);
			$res = runQuery("insert into request_reviews (request_id,review_id) values ('$rid','$get_review_id')");
			if(!$res){
				$res = runQuery("delete from reviews where review_id='$get_review_id'");
				$data["success"] = false;
				$errors["submit"] = "Server is busy!";
				$data["errors"]  = $errors;
			}else{
				$data["success"] = true;
	        		$page_message = buildMessage("Success!", "Your review has been posted successfully");
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