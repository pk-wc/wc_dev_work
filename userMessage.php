<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data 

$wc_uid = getSessionUID();


$input_name     = mres_ss($_POST['name']);
$input_email      = mres_ss($_POST['email']);
$input_phone   = mres_ss($_POST['phone']);
$input_message   = mres_ss($_POST['message']);

$dest_email = "support@wecarriers.com";
$subject = substr($input_message,0,30);
$message = '<html><body><h4>';
$message .= wordwrap($input_message,70);
$message .= '</h4><br><br><br><h3>';
$message .= "Regards";
$message .= '</h3><br><h4>'.$input_name.'</h4><h4>'.$input_phone.'</h4></body></html>';
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From:".$input_name."<".$input_email.">\r\n";
$mailSent = mail($dest_email, $subject, $message, $headers);
//$mailSent = SendMail($input_email, $subject, $message);
if(!$mailSent){
	$data["success"] = false;
	$errors["submit"] = "Unable to send Message!";
	$data["errors"]  = $errors;
}else{
	$data["success"] = true;
	$page_message = buildMessage("Congratulations!", "Your Message has been sent successfully.");
	setPageSuccessMessage($page_message);
}

echo json_encode($data);

?>