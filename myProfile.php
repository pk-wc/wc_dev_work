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
getPageTitle("My Profile");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("my_profile");
loadLoginModal();

if($wc_uid){

	echo '    <div class="container" style="margin-top: 50px;"></div>';
	echo '  <div class="container">';/*ravi*/
	echo '  <div class="row">';/*ravi*/
	echo '<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 main" style="padding:0px 10px 0px 10px">';/*ravi*/
	echo '    <h1 class="page-header">My Profile</h1>';
	checkPageMessages();
	
		$isProfileComplete = true;
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
        echo '    <strong>Congratulations!</strong> Your Profile is Complete';
		echo '  </div>';
	}
	
	$file_path_id = "images/".$row['mobile_no']."_".$row['user_id']."_id";
	$file_path_addr = "images/".$row['mobile_no']."_".$row['user_id']."_address";
	if(file_exists($file_path_id)){
		loadImageModal("myModalIDImage", $file_path_id);
	}
	if(file_exists($file_path_addr)){
		loadImageModal("myModalAddressImage", $file_path_addr);
	}
	
	echo '    <form enctype="multipart/form-data" class="form-signin" action="userProfile.php" method="post">';
	echo '        <div style="width: 100%;">';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            Email Address';
	echo '          </div>';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            <div style="padding-bottom: 10px; width: 100%;">';
	echo '              <label for="inputEmail" class="sr-only">Email Address</label>';
	echo '              <input type="email" name="input_email" value="'.$row['email_id'].'" class="form-control" placeholder="Enter Email Address" required autofocus>';
	echo '            </div>';
	echo '          </div>';
	echo '        </div>';
	echo '        <div style="width: 100%;">';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            ID Proof';
	echo '          </div>';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            <div style="padding-bottom: 10px; display: inline-block; vertical-align: top; width: 100%;">';
	echo '              <select class="form-control" name="input_id_proof_type">';
	echo '                <option value="0">(Select ID Proof Type)</option>';
	if($row['id_proof_name'] == 1){
		echo '            <option value="1" selected>Voter ID</option>';
	}else{
		echo '            <option value="1">Voter ID</option>';
	}
	if($row['id_proof_name'] == 2){
		echo '            <option value="2" selected>Aadhar Card</option>';
	}else{
		echo '            <option value="2">Aadhar Card</option>';
	}
	if($row['id_proof_name'] == 3){
		echo '            <option value="3" selected>Passport</option>';
	}else{
		echo '            <option value="3">Passport</option>';
	}
	echo '              </select>';
	echo '            </div>';
	echo '          </div>';
	if(file_exists($file_path_id)){
		echo '      <div style="width: 30%; display: inline-block; vertical-align: top;">';
		echo '          <button type="button" class="btn btn-link" data-target="#myModalIDImage" data-toggle="modal">';
		echo '          	View Image';
		echo '          </button>';
		echo '      </div>';
	}
	echo '        </div>';
	echo '        <div style="width: 100%;">';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top; font-size: 12px;">';
	echo '            (Max File Size 500KB, Only JPEGs allowed)';
	echo '          </div>';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            <div style="padding-bottom: 10px;">';
	echo '              <div><input name="input_id_proof_file" type="file" /></div>';
	echo '            </div>';
	echo '          </div>';
	echo '        </div>';
	echo '        <div style="width: 100%;">';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            Address Proof';
	echo '          </div>';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '            <div style="padding-bottom: 10px;">';
	echo '              <select class="form-control" name="input_address_proof_type">';
	echo '                <option value="0">(Select Address Proof Type)</option>';
	if($row['address_proof_name'] == 1){
		echo '            <option value="1" selected>Voter ID</option>';
	}else{
		echo '            <option value="1">Voter ID</option>';
	}
	if($row['address_proof_name'] == 2){
		echo '            <option value="2" selected>Aadhar Card</option>';
	}else{
		echo '            <option value="2">Aadhar Card</option>';
	}
	if($row['address_proof_name'] == 3){
		echo '            <option value="3" selected>Passport</option>';
	}else{
		echo '            <option value="3">Passport</option>';
	}
	echo '              </select>';
	echo '            </div>';
	echo '          </div>';
	if(file_exists($file_path_addr)){
		echo '      <div style="width: 30%; display: inline-block; vertical-align: top;">';
		echo '          <button type="button" class="btn btn-link" data-target="#myModalAddressImage" data-toggle="modal">';
		echo '          	View Image';
		echo '          </button>';
		echo '      </div>';
	}
	echo '        </div>';
	echo '        <div style="width: 100%;">';
	echo '          <div style="width: 30%; display: inline-block; vertical-align: top; font-size: 12px;">';
	echo '            (Max File Size 500KB, Only JPEGs allowed)';
	echo '          </div>';
	echo '          <div style="width: 49%; display: inline-block; vertical-align: top;">';
	echo '            <div style="padding-bottom: 10px;">';
	echo '              <div><input name="input_address_proof_file" type="file" /></div>';
	echo '            </div>';
	echo '          </div>';
	echo '        </div>';
	echo '        <hr>';
	echo '        <div style="text-align:center;">';
	echo '          <button class="btn btn-primary" style="width: 40%;" type="submit">Save Changes</button>';
	echo '        </div>';
	echo '    </form>';
	showSidebarBottom();
	echo '</div>';
	echo '</div>';
	echo '</div>';
}else{
	echo '    <div class="container" style="margin-top: 120px;">';
	checkPageMessages();
	echo '    </div>';
	showFooter();
}

loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
