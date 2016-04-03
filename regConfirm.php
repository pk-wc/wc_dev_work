<?php

session_start();
require_once('custom/funcs/functions.php');
$page_message = "";

if(isset($_GET['verifyString'])){
	$vs = $_GET['verifyString'];
	$exp = explode("_wecarrier_", $vs);
	if(count($exp)==2){
		$q = "update users set email_id_status=1 where email_id='$exp[0]' and email_verify_code='$exp[1]'";
		$res = runQuery($q);
		if(!$res){
			$page_message = buildMessage("Activation Failed!", "An error was encountered while activating your account");
		}
	}else{
		$page_message = buildMessage("Activation Failed!", "Invalid Activation Link");
	}
}else{
	$page_message = buildMessage("Activation Failed!", "Invalid Activation Link");
}

if(strlen($page_message) > 0){
	//generateLog($page_message);
	setPageErrorMessage($page_message);
}else{
	$page_message = buildMessage("Activation Successfull!", "Your Account has been activated successfully.");
	setPageSuccessMessage($page_message);
}

//echo "<br/>".$page_message;
header("location: index.php");

?>
