<?php

session_start();
require_once("custom/funcs/functions.php");

$page_message = "";
$file_name = "pincodes/IN.txt";

/*
$subject = "abcdef";
$pattern = '/^def/';
preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
print_r($matches);
*/

$wc_uid = getSessionUID();

if($wc_uid){
	if(isset($_GET['input_pincode'])){
		$input_pincode     = mres_ss($_GET['input_pincode']);

		if(strlen($input_pincode) > 0){
			if( file_exists($file_name) && ($fp = fopen($file_name, "r")) ){
				//echo fread($fp, filesize($file_name));
				//while(!feof($fp)){
				while ($userinfo = fscanf($fp, "%s\t%s\t%s\t%s\t%s\t%s")){
					list ($country_code, $pincode, $temp, $state, $temp, $city) = $userinfo;
					echo "Country Code = $country_code ; Pincode = $pincode ; City = $city ; State = $state ; <br/>";
				}
				fclose($fp);
			}else{
				$page_message = buildMessage("Operation Failed!", "An error occurred while fetching pincode info");
			}
		}else{
			$page_message = buildMessage("Operation Failed!", "Please provide a valid Pincode ..1..");
		}
	}else{
		$page_message = buildMessage("Operation Failed!", "Please provide a valid Pincode ..2..");
	}

	if(strlen($page_message) > 0){
		//generateLog($page_message);
		setPageErrorMessage($page_message);
	}else{
		//$page_message = buildMessage("Success!", "Your profile has been updated successfully");
		setPageSuccessMessage($page_message);
	}
	echo $page_message;
}

//header("location: myProfile.php");

?>