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
echo '
		<script>

			function deleteAddress(aid){
				if(confirm("Are you sure you want to delete this Address?")){
					window.location.href = "deleteAddress.php?aid=" + aid;
				}
			}
		</script>
	 ';
echo '  </head>';
echo '  <body>';

showHeader("user");
loadLoginModal();

if($wc_uid){
	echo '    <div class="container" style="margin-top: 50px;"></div>';
	$eid = null;
	if(isset($_GET['eid'])){
		$eid = mres_ss($_GET['eid']);
	}
	$valid_address = false;
	echo '  <div class="container">';/*ravi*/
	echo '  <div class="row">';/*ravi*/
	echo '<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 main" style="padding:0px 10px 0px 10px">';/*ravi*/
	echo '    <h1 class="page-header">My Address</h1>';
	checkPageMessages();

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
		echo '						<a href="'.$_SERVER['PHP_SELF'].'" style="text-decoration: none;">';
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
			echo '    					<label ><a href="'.$_SERVER['PHP_SELF'].'?eid='.$row['address_id'].'"><button type="button" class="btn btn-primary">Edit</button></a></label>';
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
