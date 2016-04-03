<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_GET['aid']) ){
		$address_id = mres_ss($_GET['aid']);

		if(strlen($address_id) > 0){
			$res = runQuery("select * from user_address where address_id='$address_id' and user_id='$wc_uid'");
			if($res && mysqli_num_rows($res)){
				$res = runQuery("delete from address where address_id='$address_id'");
				echo $address_id;
				if(!$res){
					$page_message = buildMessage("Operation Failed!", "An error occurred while deleting your address");
				}
			}else{
				$page_message = buildMessage("Invalid Address!", "You are not authorized to access this address");
			}
		}else{
			$page_message = buildMessage("Operation Failed!", "Please provide valid input values");
		}
	}else{
		$page_message = buildMessage("Operation Failed!", "Please provide valid input values");
	}

	if(strlen($page_message) > 0){
		//generateLog($page_message);
		setPageErrorMessage($page_message);
	}else{
		$page_message = buildMessage("Success!", "Your address has been deleted successfully");
		setPageSuccessMessage($page_message);
	}
}

//header("location: myAddress.php");

?>