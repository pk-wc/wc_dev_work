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
echo ' <div id="content">';
if($wc_uid){
	$as_a = "personal";
	if(isset($_GET['as_a'])){
		$as_a = mres_ss($_GET['as_a']);
	}
	echo '    <div class="container">';
	checkPageMessages();
	echo '    </div>';
	echo '  <div class="container" style="padding-bottom:10px">';/*ravi*/
	echo '    <h1 class="page-header">My Profile</h1>';
	$res = runQuery("select * from users where user_id='$wc_uid'");
	$row = mysqli_fetch_array($res);
	echo ' <div id="msform">
			<!-- progress bar -->
			  <ul id="progressbar">
			    <li class="active">Registered</li>';
	if($row['mobile_no_status'] == 0){
		
	}else{
	
	}
	
	if($row['email_id_status'] == 0){
		
	}else{
	
	}
	
	if($row['id_proof_name'] == 0){
	echo '		    <li>Upload ID Proof</li>';	
	}else{
	echo '		    <li class="active">Upload ID Proof</li>';
	}
	if($row['address_proof_name'] == 0){
	echo '		    <li>Upload Address Proof</li>';
	}else{
	echo '		    <li class="active">Upload Address Proof</li>';
	}
	if($row['id_proof_status'] == 0 && $row['address_proof_status'] == 0){
	echo '		    <li>Verified By Admin</li>';
	}else{
	echo '		    <li class="active">Verified By Admin</li>';
	}
	echo '		  </ul>
	       </div>';
	
	echo ' <div role="tabpanel" class="profile_tab">
	
	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist" style="width:100%;">';
	if(strstr($as_a, "personal")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=personal"><span style="margin-right:5px;"><i class="fa fa-user"></i></span>Personal Information</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=personal"><span style="margin-right:5px;"><i class="fa fa-user"></i></span>Personal Information</a></li>';
	}
	if(strstr($as_a, "address")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=address"><span style="margin-right:5px;"><i class="fa fa-map-marker"></i></span>Address</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=address"><span style="margin-right:5px;"><i class="fa fa-map-marker"></i></span>Address</a></li>';
	}
	if(strstr($as_a, "account")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=account"><span style="margin-right:5px;"><i class="fa fa-inr"></i></span>Account</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=account"><span style="margin-right:5px;"><i class="fa fa-inr"></i></span>Account</a></li>';
	} 	
	if(strstr($as_a, "settings")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=settings"><span style="margin-right:5px;"><i class="fa fa-cog"></i></span>Settings</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=settings"><span style="margin-right:5px;"><i class="fa fa-cog"></i></span>Settings</a></li>';
	} 	
	echo '  </ul>

	 	<div class="tab-content">';
	if(strstr($as_a, "personal")){
  		echo ' <div role="tabpanel" class="tab-pane fad in active" id="personal">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fad" id="personal">';
	}
	echo '		&nbsp;&nbsp;';				
	$file_path_id = "images/".$row['mobile_no']."_".$row['user_id']."_id";
	$file_path_addr = "images/".$row['mobile_no']."_".$row['user_id']."_address";
	if(file_exists($file_path_id)){
		loadImageModal("myModalIDImage", $file_path_id);
	}
	if(file_exists($file_path_addr)){
		loadImageModal("myModalAddressImage", $file_path_addr);
	}
	echo ' 	<div class="row">
    			<div class="col-xs-4 col-md-2">
    				<p>Name</p>
    			</div>
    			<div class="col-xs-3 col-md-2">';
    	echo $row['username'];
    	echo '		</div>
    		</div>
    		<div class="row" style="padding-top:5px">
    			<div class="col-xs-4 col-md-2">
    				<p>Email Address</p>
    			</div>
    			<div class="col-xs-4 col-md-2">';
    	echo $row['email_id'];
    	echo '		</div>
    		</div>
    		<div class="row" style="padding-top:5px">
    			<div class="col-xs-4 col-md-2">
    				<p>Mobile Number</p>
    			</div>
    			<div class="col-xs-4 col-md-2">';
    	echo $row['mobile_no'];
    	echo '		</div>
    		</div>';
	echo '    <form enctype="multipart/form-data" class="form-signin" action="userProfile.php" method="post">';
	echo '        <div class="row" style="padding-bottom: 10px;">';
	echo '          <div class="col-xs-4 col-md-2">';
	echo '            ID Proof';
	echo '          </div>';
	echo '          <div class="col-xs-4 col-md-2">';
	if(!$row["id_proof_name"]){
	echo '            <div style="padding-bottom: 10px; display: inline-block; vertical-align: top; width: 100%;">';
		echo '              <select class="form-control" name="input_id_proof_type">';
		echo '                <option value="0">(Select ID Proof Type)</option>';
		echo '                <option value="1">Voter ID</option>';
		echo '                <option value="2">Aadhar Card</option>';
		echo '                <option value="3">Passport</option>';
		echo '                <option value="4">Pan Card</option>';
		echo '              </select>';
	echo '            </div>';
	}else{
		if($row["id_proof_name"]==1){
			echo 'Voter ID';
		}
		if($row["id_proof_name"]==2){
			echo 'Aadhar Card';
		}
		if($row["id_proof_name"]==3){
			echo 'Passport';
		}
		if($row["id_proof_name"]==4){
			echo 'Pan Card';
		}
	}
	echo '          </div>';
	if(file_exists($file_path_id)){
		echo '      <div class="col-xs-4 col-md-2">';
		echo '          <a data-target="#myModalIDImage" data-toggle="modal">';
		echo '          	View Proof';
		echo '          </a>';
		echo '      </div>';
	}
	echo '        </div>';
	if(!$row["id_proof_name"]){
	echo '        <div class="row">';
	echo '          <div class="col-xs-12 col-md-2 col-xs-offset-4 col-md-offset-2">';
	echo '            <div style="padding-bottom: 10px;">';
	echo '              <div><input name="input_id_proof_file" type="file" /></div>';
	echo '            </div>';
	echo '          </div>';
	echo '          <div class="col-xs-12  col-xs-offset-4 col-md-offset-0 col-md-4">';
	echo '            (Max Size 500KB, Only JPEGs allowed)';
	echo '          </div>';
	echo '        </div><br/>';
	}
	echo '        <div class="row">';
	echo '          <div class="col-xs-4 col-md-2">';
	echo '            Address Proof';
	echo '          </div>';
	echo '          <div class="col-xs-4 col-md-2">';
	if(!$row["address_proof_name"]){
		echo '            <div style="padding-bottom: 10px;">';
		echo '              <select class="form-control" name="input_address_proof_type">';
		echo '                <option value="0">(Select Address Proof Type)</option>';
		echo '                <option value="1">Voter ID</option>';
		echo '                <option value="2">Aadhar Card</option>';
		echo '                <option value="3">Passport</option>';
		echo '              </select>';
		echo '            </div>';
	}else{
		if($row["address_proof_name"]==1){
			echo 'Voter ID';
		}
		if($row["address_proof_name"]==2){
			echo 'Aadhar Card';
		}
		if($row["address_proof_name"]==3){
			echo 'Passport';
		}
	}
	echo '          </div>';
	if(file_exists($file_path_addr)){
		echo '      <div class="col-xs-4 col-md-2">';
		echo '          <a data-target="#myModalAddressImage" data-toggle="modal">';
		echo '          	View Proof';
		echo '          </a>';
		echo '      </div>';
	}
	echo '        </div>';
	if(!$row["address_proof_name"]){
	echo '        <div class="row">';
	echo '          <div class="col-xs-12 col-md-2 col-xs-offset-4 col-md-offset-2">';
	echo '            <div style="padding-bottom: 10px;">';
	echo '              <div><input name="input_address_proof_file" type="file" /></div>';
	echo '            </div>';
	echo '          </div>';
	echo '          <div class="col-xs-12  col-xs-offset-4 col-md-offset-0 col-md-4">';
	echo '            (Max Size 500KB, Only JPEGs allowed)';
	echo '          </div>';
	echo '        </div>';
	}
	if(!$row["id_proof_name"] || !$row["address_proof_name"]){
	echo '        <hr>';
	echo '        <div style="text-align:center">';
	echo '          <button class="btn btn-primary" type="submit">Save Changes</button>';
	echo '        </div>';
	}
	echo '    </form>';
	echo '	&nbsp;&nbsp;';	
	echo '</div>';
	if(strstr($as_a, "account")){
  		echo ' <div role="tabpanel" class="tab-pane fade in active" id="account">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fade" id="account">';
	}
	echo ' 	&nbsp;&nbsp;	';	
    	echo ' 	<div class="row">
    			<div class="col-xs-4 col-md-2">
    				<p>Referral Code</p>
    			</div>
    			<form>
    			<div class="col-xs-3 col-md-2">';
    	echo $row['referral_code'];
    	loadReferralModal($row['referral_code']);
    	echo '		</div>
    			<div class="col-xs-5 col-md-2">
    				<a data-target="#myModalReferral" data-toggle="modal">Share with friends</a>
    			</div>
    			</form>
    			
    		</div>
    		<div class="row" style="padding-top:10px">
    			<div class="col-xs-4 col-md-2">
    				<p>WEpoints</p>
    			</div>
    			<div class="col-xs-4 col-md-2">';
    	echo $row['points'];
    	loadRedeemModal($row['points']);
    	echo '		</div>
    			<div class="col-xs-4 col-md-2">
    				<a data-target="#myModalRedeem" data-toggle="modal">Redeem</a>
    			</div>
    		</div>';
	echo ' </div>';
	if(strstr($as_a, "address")){
  		echo ' <div role="tabpanel" class="tab-pane fade in active" id="address">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fade" id="address">';
	}
	echo ' 	&nbsp;&nbsp;	';	
	$eid = null;
	if(isset($_GET['eid'])){
		$eid = mres_ss($_GET['eid']);
	}
	$valid_address = false;
	if($eid){
		$valid_address = false;
		$res = runQuery("select * from address where address_id='$eid' and address_id in (select address_id from user_address where user_id='$wc_uid')");
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_array($res);
			$valid_address = true;
		}else{
			$message = buildMessage("Invalid Address!", "Please select a valid Address");
			setPageErrorMessage($message);
			checkPageMessages();
		}
	}
	
	echo '    <div class="row">';
	echo '    	<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" style="z-index:10;border:1px solid #eee;box-shadow: 0 2px 5px black;border-radius: 5px;">';
	if($valid_address){
		echo '<form id="addressform" class="form-signin" onsubmit="return updateAddress()">';
	}else{
		echo '<form id="addressform" class="form-signin" onsubmit="return userAddress()">';
	}
	echo '    		<div style=""><input type="hidden" id="address_id" name="address_id" value='.$row['address_id'].' >';
	if($valid_address){
		echo '    		<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px; font-size: 24px; margin-bottom: 10px;">Edit Address</div>';
	}else{
	echo '    		<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px; font-size: 24px; margin-bottom: 10px;">Add New Address</div>';
	}

	echo '    				<div style="margin-bottom: 5px;">';
	echo '    					<div style="width: 100%; display: inline-block;">';
	echo '    						<div style="margin-top: 5px;">';
	echo '    							<label for="inputText" class="sr-only">Label</label>';
	if($valid_address){
		echo '    						<input type="text" id="input_address_label" name="input_address_label" value="'.$row['address_label'].'" class="form-control" placeholder="Enter Address Label" onblur="return checklabel()">';	
	}else{
		echo '    						<input type="text" id="input_address_label" name="input_address_label" class="form-control" placeholder="Enter Address Label" onblur="return checklabel()">';
	}
	echo '    						<span id="label_status" class="error-status"></span></div>';
	echo '    						<div style="margin-top: 5px;" class="ui-widget">';
	echo '    							<label for="inputText" class="sr-only">Pincode</label>';
	if($valid_address){
		echo '    						<input type="text" name="input_pincode" value="'.$row['pincode'].'" class="form-control" placeholder="Enter Pincode" id="input_pincode" onkeyup="fillAddress()" onblur="checkpincode()" autocomplete="off">';
	}else{
		echo '    						<input type="text" id="input_pincode" name="input_pincode" class="form-control" placeholder="Enter Pincode" onkeyup="fillAddress()" onblur="checkpincode()" autocomplete="off">';
	}
	
	echo '    						<span id="pincode_status" class="error-status"></span></div>';
	echo '    						<div style="margin-top: 5px;">';
	echo '    							<div class="form-group">';
	if($valid_address){
		echo '    							<textarea name="input_address" class="form-control" rows="2" onblur="checkaddress()" id="comment" placeholder="Enter Address">'.$row['address'].'</textarea>';
	}else{
		echo '    							<textarea name="input_address" class="form-control" rows="2" onblur="checkaddress()" id="comment" placeholder="Enter Address"></textarea>';
	}
	echo '    							<span id="address_status" class="error-status"></span></div>';
	echo '    						</div>';
	echo '    						<div style="margin-top: 5px;">';
	$pincode = $row['pincode'];
	$res1 = runQuery("select * from pincodes where pincode='$pincode'");
	$row1 = mysqli_fetch_array($res1);
        if($valid_address){
        echo '    						        <input type="text" id="city" name="city" class="form-control" placeholder="City" value="'.$row1['city'].'" disabled>';
        }else{
	echo '  						        <input type="text" id="city" name="city" class="form-control" placeholder="City" disabled>';
        }
	echo '    						</div>';
	echo '    						<div style="margin-top: 5px;">';
        if($valid_address){
        echo '    						<input type="text" id="state" name="state" class="form-control" placeholder="State" value="'.$row1['state'].'" disabled>';
        }else{
	echo '    						<input type="text" id="state" name="state" class="form-control" placeholder="State" disabled>';
        }
	echo '    						</div>';
	echo '    						<div style="margin-top: 15px;">';
	echo '    							<label style="width: 30%;">Country</label>';
	echo '    							<label style="font-weight: normal;">India</label>';
	echo '    						</div>';
	echo '    					</div>';
	echo '    				</div>';
	echo '					<div><span id="submit_status" class="error-status"></span></div>';
	echo '    				<div style="border-top: 1px solid #fac106;padding-top: 10px;" align="center">';
	if($valid_address){
		echo '    				<label style="">';
	}else{
		echo '    				<label style="">';
	}
	echo '    						<button class="btn btn-lg btn-primary btn-block" style="" type="submit">';
	if($valid_address){
		echo '    						Update Address';
	}else{
		echo '    						Add Address';
	}
	echo '    						</button>';
	echo '    					</label>';
	if($valid_address){
		echo '    				<label style="">';
		echo '						<a href="'.$_SERVER['PHP_SELF'].'?as_a=address" style="text-decoration: none;">';
		echo '							<button type="button" class="btn btn-link">Cancel</button>';
		echo '						</a>';
		echo '    				</label>';
	}
	echo '    				</div>';
	echo '    		  </div>';
	echo '    	</form>';
	echo '    	</div>';
	echo '    	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">';
	echo '    		<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px; font-size: 24px; margin-bottom: 10px;">Saved Addresses</div>';
	 echo '    			<div class="row">';
	$res = runQuery("select * from address where address_id in (select address_id from user_address where user_id='$wc_uid')");
	if($res && mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_array($res)){
			$pincode = $row['pincode'];
			$res1 = runQuery("select * from pincodes where pincode='$pincode'");
			$row1 = mysqli_fetch_array($res1);
                        echo '    		<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">';
			echo '    			<div class="panel panel-primary" >';
			echo '    				<div class="panel-heading" style="text-align: center;">';
			echo '    					<h3 class="panel-title">'.$row['address_label'].'</h3>';
			echo '    				</div>';
			echo '    				<div class="panel-body" style="padding: 10px; border-bottom: 1px solid #009688;">';
			echo '    					<div style="font-size: 12px; overflow: auto; width: 180px; height: 130px;">';
			echo '                  		<div style="">'.$row['address'].'</div>';
			echo '                  		<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row['pincode'].'</label></div>';
			echo '                  		<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row1['city'].'</label></div>';
			echo '                  		<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row1['state'].'</label></div>';
			echo '                  		<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
			echo '    					</div>';
			echo '    				</div>';
			echo '    				<div style="text-align: center; margin-top: 5px;">';
			echo '    					<label ><a href="'.$_SERVER['PHP_SELF'].'?as_a=address&eid='.$row['address_id'].'"><button type="button" class="btn btn-primary">Edit</button></a></label>';
			echo '    					<label ><button type="button" class="btn btn-primary" onclick="deleteAddress('.$row['address_id'].')">Delete</button></label>';
			echo '    				</div>';
			echo '    			</div>';
                        echo '    		</div>';
		}
	}else{
		echo '    			<div class="col-xs-12">';
		echo '                No Addresses found';
		echo '    			</div>';
	}
	echo '    			</div>';
	echo '    		</div>';
	echo '    	</div>';
	
	echo ' </div>';
	
	if(strstr($as_a, "settings")){
  		echo ' <div role="tabpanel" class="tab-pane fade in active" id="settings">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fade" id="settings">';
	}
	echo ' 	&nbsp;&nbsp;	';	
    	echo '  <div class="row">';
    	echo '   <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">';
    	echo '    <div class="panel panel-primary">';
	echo '      <div class="panel-heading">';
	echo '        <h3 class="panel-title">Change Password</h3>';
	echo '      </div>';
	echo '      <div class="panel-body">';
	echo '        <form class="form-signin" id="changePasswordForm">';
	echo '                <div style="padding-bottom: 10px;">';
	echo '                  <label for="inputPassword" class="sr-only">Current Password</label>';
	echo '                  <input type="password" id="input_old_password" name="input_old_password" class="form-control" placeholder="Enter Current Password" autofocus>';
	echo '    		<span id="change_password_old_status" class="error-status"></span>';
	echo '                </div>';
	echo '                <div style="padding-bottom: 10px;">';
	echo '                  <label for="inputPassword" class="sr-only">New Password</label>';
	echo '                  <input type="password" id="input_new_password" name="input_new_password" class="form-control" placeholder="Enter New Password">';
	echo '    		<span id="change_password_new_status" class="error-status"></span>';
	echo '                </div>';
	echo '                <div style="padding-bottom: 10px;">';
	echo '                 <label for="inputPassword" class="sr-only">Re-Type New Password</label>';
	echo '                 <input type="password" id="input_re_new_password" name="input_re_new_password" class="form-control" placeholder="Re-Type New Password">';
	echo '    	       <span id="change_password_re_new_status" class="error-status"></span>';
	echo '                </div>';
	echo '		      <div><span id="change_password_submit_status" class="error-status"></span></div>';
	echo '                <hr>';
	echo '                <div align="center">';
	echo '                  <button class="btn btn-lg btn-primary" type="submit">Save Changes</button>';
	echo '                </div>';
	echo '        </form>';
	echo '      </div>';
	echo '    </div>';
	echo '   </div>';
	echo '  </div>';
	echo ' </div>';
	
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
}else{
header("location: index.php");
}
echo ' </div>';
showFooter();

loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
