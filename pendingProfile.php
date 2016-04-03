<?php

session_start();
require_once("custom/funcs/functions.php");

$wc_uid = getSessionUID();

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '  <head>';
echo '    <meta charset="utf-8">';
echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1">';
echo '    <meta name="description" content="">';
echo '    <meta name="author" content="">';
echo '    <link rel="icon" href="../../favicon.ico">';
getPageTitle("Welcome");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("");
loadLoginModal();
loadRegisterModal();

echo '    <div class="container" style="margin-top: 50px;">';
checkPageMessages();
echo '    </div>';

if($wc_uid){
	$isProfileComplete = true;
	echo '  <div class="container-fluid">';/*ravi*/
	echo '  <div class="row">';/*ravi*/
	showSidebarTop("pending_profile");
	echo '<div class="col-sm-9 col-md-10 col-xs-12 col-lg-10 main pull-right" style="padding:0px 10px 0px 10px">';/*ravi*/
	echo '      <h1 class="page-header">Pending Profile</h1>';
	$res = runQuery("select * from users where user_id='$wc_uid'");
	$row = mysqli_fetch_array($res);
	if($row['mobile_no_status'] == 0){
		echo '  <div class="alert alert-danger" role="alert">';
        echo '    <strong>Alert!</strong> Please verify your Mobile Number <label style="float: right; font-weight: normal;"><a href="myProfile.php">View Profile</a></label>';
		echo '  </div>';
		$isProfileComplete = false;
	}
	if(strlen($row['email_id']) == 0){
		echo '  <div class="alert alert-danger" role="alert">';
        echo '    <strong>Alert!</strong> Please provide your Email ID <label style="float: right; font-weight: normal;"><a href="myProfile.php">View Profile</a></label>';
		echo '  </div>';
		$isProfileComplete = false;
	}else{
		if($row['email_id_status'] == 0){
			echo '  <div class="alert alert-danger" role="alert">';
	        echo '    <strong>Alert!</strong> Your Email ID is yet to be verified. Please check your Email Account for the Activation Link. <strong>Also check the Spam folder</strong>.</label>';
			echo '  </div>';
			$isProfileComplete = false;
		}
	}
	if($row['id_proof_name'] == 0){
		echo '  <div class="alert alert-warning" role="alert">';
        echo '    <strong>Warning!</strong> Please upload your ID proof <label style="float: right; font-weight: normal;"><a href="myProfile.php">View Profile</a></label>';
		echo '  </div>';
		$isProfileComplete = false;
	}else{
		if($row['id_proof_status'] == 0){
			echo '  <div class="alert alert-warning" role="alert">';
	        echo '    <strong>Warning!</strong> Your ID Proof is yet to be verified';
			echo '  </div>';
			$isProfileComplete = false;
		}
	}
	if($row['address_proof_name'] == 0){
		echo '  <div class="alert alert-warning" role="alert">';
        echo '    <strong>Warning!</strong> Please upload your Address proof <label style="float: right; font-weight: normal;"><a href="myProfile.php">View Profile</a></label>';
		echo '  </div>';
		$isProfileComplete = false;
	}else{
		if($row['address_proof_status'] == 0){
			echo '  <div class="alert alert-warning" role="alert">';
	        echo '    <strong>Warning!</strong> Your Address Proof is yet to be verified';
			echo '  </div>';
			$isProfileComplete = false;
		}
	}
	if($isProfileComplete){
		echo '  <div class="alert alert-success" role="alert">';
        echo '    <strong>Congratulations!</strong> Your Profile is Complete <label style="float: right; font-weight: normal;"><a href="myProfile.php">View Profile</a></label>';
		echo '  </div>';
	}
	showSidebarBottom();
	echo '</div>';
	echo '</div>';
	echo '</div>';
}else{
	showFooter();
}

loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
