<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$retLocation = "myRequests.php";
$opValid = false;
$is_carrier = false;
$loc = "";
$wc_uid = getSessionUID();

if($wc_uid){
	if( (isset($_GET['oid']) && isset($_POST['input_journey_id'])) || (isset($_GET['jid']) && isset($_POST['input_order_id'])) ){

		if(isset($_GET['oid']) && isset($_POST['input_journey_id'])){
			$order_id = mres_ss($_GET['oid']);
			$res = runQuery("select * from orders where order_id='$order_id'");
			if($res && mysqli_num_rows($res)){
				$input_journey_id = mres_ss($_POST['input_journey_id']);
				$res = runQuery("select * from journeys where journey_id='$input_journey_id'");
				if($res && mysqli_num_rows($res)){
					$opValid = true;
					$is_carrier = true;
				}else{
					$page_message = buildMessage("Invalid Journey!", "Please select a valid Journey");
				}
			}else{
				$page_message = buildMessage("Invalid Order!", "Please select a valid order");
			}
			if(strlen($page_message) > 0){
				$retLocation = $retLocation."?as_a=carrier&oid=".$order_id;
			}
			$loc=carrier;
		}else if(isset($_GET['jid']) && isset($_POST['input_order_id'])){
			$journey_id = mres_ss($_GET['jid']);
			$res = runQuery("select * from journeys where journey_id='$journey_id'");
			if($res && mysqli_num_rows($res)){
				$input_order_id = mres_ss($_POST['input_order_id']);
				$res = runQuery("select * from orders where order_id='$input_order_id'");
				if($res && mysqli_num_rows($res)){
					$opValid = true;
					$is_carrier = false;
				}else{
					$page_message = buildMessage("Invalid Order!", "Please select a valid order");
				}
			}else{
				$page_message = buildMessage("Invalid Journey!", "Please select a valid Journey");
			}
			if(strlen($page_message) > 0){
				$retLocation = $retLocation."?as_a=sender&jid=".$journey_id;
			}
			$loc=sender;
		}

		if($opValid){
			$res = runQuery("select status_id from status where status='in-progress'");
			if($res && mysqli_num_rows($res)){
				$row = mysqli_fetch_array($res);
				$status_id = $row['status_id'];
				$timestamp = date("Y-m-d H:i:s");
				if($is_carrier){
					$q = "insert into requests (is_carrier, order_id, journey_id, status_id, posted_on) values ('$is_carrier', '$order_id', '$input_journey_id', '$status_id', '$timestamp')";
					$res = runQuery($q);
					if(!$res){
						$page_message = buildMessage("Operation Failed!", "An error occurred while placing your request ..1..");
					}
				}else{
					$q = "insert into requests (is_carrier, order_id, journey_id, status_id, posted_on) values ('$is_carrier', '$input_order_id', '$journey_id', '$status_id', '$timestamp')";
					$res = runQuery($q);
					if(!$res){
						$page_message = buildMessage("Operation Failed!", "An error occurred while placing your request ..2..");
					}
				}
			}else{
				$page_message = buildMessage("Operation Failed!", "An error occurred while placing your request ..3..");
			}
		}else{
			if(strlen($page_message) == 0){
				$page_message = buildMessage("Operation Failed!", "Please provide valid input values");
				if(isset($_GET['oid'])){
					$retLocation = $retLocation."?as_a=carrier&oid=".$_GET['oid'];
				}
				if(isset($_GET['jid'])){
					$retLocation = $retLocation."?as_a=sender&jid=".$_GET['jid'];
				}
			}
		}
	}else{
		$page_message = buildMessage("Operation Failed!", "Please provide valid input values");
		if(isset($_GET['oid'])){
			$retLocation = $retLocation."?as_a=carrier&oid=".$_GET['oid'];
		}
		if(isset($_GET['jid'])){
			$retLocation = $retLocation."?as_a=sender&jid=".$_GET['jid'];
		}
	}

	if(strlen($page_message) > 0){
		generateLog($page_message);
		setPageErrorMessage($page_message);
	}else{
		$page_message = buildMessage("Success!", "Your request has been posted successfully");
		setPageSuccessMessage($page_message);
		/* On successfull operation, send an Email & SMS to both Sender & the Carrier */
		if($is_carrier){
			/* This is a request from Carrier for carrying the parcel */

			/* Fetch Carrier Details */
			$res = runQuery("select username,email_id,mobile_no from users where user_id in (select user_id from carrier_journeys where journey_id='$input_journey_id')");
			$row = mysqli_fetch_array($res);
			$username = $row['username'];
			/* Send SMS to Carrier */
			$mobile_no = $row['mobile_no'];
			$sms_txt = "Hi ".$username.", your request for carrying the parcel with id ".$order_id." has been sent successfully. Pls visit wecarriers.com for more details";
			//$sms_txt = "Hi ".$username;
			$sms_res = sendSMS($sms_txt, $mobile_no);
			if(strcmp($sms_res, "Sent.") != 0){
				generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
			}
			/* Send Email to the Carrier */

			/* Fetch Sender Details */
			$res = runQuery("select username,email_id,mobile_no from users where user_id in (select user_id from order_sender where order_id='$order_id')");
			$row = mysqli_fetch_array($res);
			$username = $row['username'];
			/* Send SMS to Sender */
			$mobile_no = $row['mobile_no'];
			$sms_txt = "Hi ".$username.", your parcel order with id ".$order_id." has received a request of carrying the parcel. Pls visit wecarriers.com for more details";
			//$sms_txt = "Hi ".$username;
			$sms_res = sendSMS($sms_txt, $mobile_no);
			if(strcmp($sms_res, "Sent.") != 0){
				generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
			}
			/* Send Email to the Sender */

		}else{
			/* This is a request from Sender for the delivery of parcel */

			/* Fetch Carrier Details */
			$res = runQuery("select username,email_id,mobile_no from users where user_id in (select user_id from carrier_journeys where journey_id='$journey_id')");
			$row = mysqli_fetch_array($res);
			$username = $row['username'];
			/* Send SMS to Carrier */
			$mobile_no = $row['mobile_no'];
			$sms_txt = "Hi ".$username.", your journey id ".$journey_id." has received a request for parcel delivery. Pls visit wecarriers.com for more details";
			//$sms_txt = "Hi ".$username;
			$sms_res = sendSMS($sms_txt, $mobile_no);
			if(strcmp($sms_res, "Sent.") != 0){
				generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
			}
			/* Send Email to the Carrier */

			/* Fetch Sender Details */
			$res = runQuery("select username,email_id,mobile_no from users where user_id in (select user_id from order_sender where order_id='$input_order_id')");
			$row = mysqli_fetch_array($res);
			$username = $row['username'];
			/* Send SMS to Sender */
			$mobile_no = $row['mobile_no'];
			$sms_txt = "Hi ".$username.", your request for the delivery of parcel with id ".$input_order_id." has been sent successfully. Pls visit wecarriers.com for more details";
			//$sms_txt = "Hi ".$username;
			$sms_res = sendSMS($sms_txt, $mobile_no);
			if(strcmp($sms_res, "Sent.") != 0){
				generateLog("SMS Failed with Response = ".$sms_res.";Text = ".$sms_txt);
			}
			/* Send Email to the Sender */
		}
	}
}

header("location: ".$retLocation."?as_a=".$loc);

?>