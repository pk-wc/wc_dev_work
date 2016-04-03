<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$isValidOp = false;
$op = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_GET['op']) && isset($_GET['rid']) ){
		$request_id = mres_ss($_GET['rid']);
		$op         = mres_ss($_GET['op']);

		if( (strlen($request_id) > 0) && isValidRequestOp($op)){
			$res = runQuery("select * from requests where request_id='$request_id' and status_id in (select status_id from status where status='in-progress')");
			if($res && mysqli_num_rows($res)){
				$row = mysqli_fetch_array($res);
				if($row['is_carrier']){
					/*
					 *  If owner is a CARRIER then the SENDER must be allowed to accept or decline
					 *  the requests.
					 */
					$res1 = runQuery("select * from order_sender where order_id='".$row['order_id']."' and user_id='".$wc_uid."'");
					if($res1 && mysqli_num_rows($res1)){
						$isValidOp = true;
					}
				}else{
					/*
					 *  If owner is a SENDER then the CARRIER must be allowed to accept or decline
					 *  the requests.
					 */
					$res1 = runQuery("select * from carrier_journeys where journey_id='".$row['journey_id']."' and user_id='".$wc_uid."'");
					if($res1 && mysqli_num_rows($res1)){
						$isValidOp = true;
					}
				}
				if($isValidOp){
					if($op == 1){
						$res = runQuery("select status_id from status where status='accepted'");
					}else{
						$res = runQuery("select status_id from status where status='declined'");
					}
					if($res){
						$row = mysqli_fetch_array($res);
						$res = runQuery("update requests set status_id='".$row['status_id']."' where request_id='$request_id'");
						if(!$res){
							$page_message = buildMessage("Operation Failed!", "An error occurred while processing your request");
						}
					}
				}else{
					$page_message = buildMessage("Forbidden Operation!", "You are not authorized to perform this operation");
				}
			}else{
				$page_message = buildMessage("Forbidden Operation!", "You are not authorized to perform this operation");
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
		if($op == 1){
			$page_message = buildMessage("Success!", "The request has been Accepted successfully");
		}else{
			$page_message = buildMessage("Success!", "The request has been Declined successfully");
		}
		setPageSuccessMessage($page_message);
	}
}

header("location: myRequests.php");

?>