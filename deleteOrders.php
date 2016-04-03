<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_GET['oid']) ){
		$order_id = mres_ss($_GET['oid']);

		if(strlen($order_id) > 0){
			$res = runQuery("select * from order_sender where order_id='$order_id' and user_id='$wc_uid'");
			if($res && mysqli_num_rows($res)){
				$res = runQuery("delete from orders where order_id='$order_id'");
				if(!$res){
					$page_message = buildMessage("Operation Failed!", "An error occurred while deleting your order");
				}
			}else{
				$page_message = buildMessage("Invalid Order!", "You are not authorized to access this order");
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
		$page_message = buildMessage("Success!", "Your order has been deleted successfully");
		setPageSuccessMessage($page_message);
	}
}

header("location: myOrders.php");

?>