<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";

$wc_uid = getSessionUID();

if($wc_uid){
	if( isset($_GET['jid']) ){
		$journey_id = mres_ss($_GET['jid']);

		if(strlen($journey_id) > 0){
			$res = runQuery("select * from carrier_journeys where journey_id='$journey_id' and user_id='$wc_uid'");
			if($res && mysqli_num_rows($res)){
				$res = runQuery("delete from journeys where journey_id='$journey_id'");
				if(!$res){
					$page_message = buildMessage("Operation Failed!", "An error occurred while deleting your journey");
				}
			}else{
				$page_message = buildMessage("Invalid Journey!", "You are not authorized to access this journey");
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
		$page_message = buildMessage("Success!", "Your journey has been deleted successfully");
		setPageSuccessMessage($page_message);
	}
}

header("location: myJourneys.php");

?>