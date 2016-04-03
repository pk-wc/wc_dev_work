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
getPageTitle("My Journeys");
loadCSSFiles();
loadJSFiles();
echo '    <script>
		    function addAddressToField(addr_id, addr_label, field){
		      if(field.localeCompare("source") == 0){
			    document.getElementById("source_address_id").value = addr_id;
			    document.getElementById("sourceAddressLink").innerHTML = addr_label;
			  }else{
			  	document.getElementById("destination_address_id").value = addr_id;
			  	document.getElementById("destinationAddressLink").innerHTML = addr_label;
			  }
			}

			function deleteJourney(jid){
				if(confirm("Are you sure you want to delete this journey?")){
					window.location.href = "deleteJourneys.php?jid=" + jid;
				}
			}

			
		  </script>';
		  
echo '  </head>';
echo '  <body>';

showHeader("my_journeys");
loadLoginModal();

echo '    <div class="container" style="margin-top: 50px;">';
echo '    </div>';

if($wc_uid){
	if(verifyUserProfile($wc_uid) == 0){
		header("location: pendingProfile.php");
	}
	loadAddressModal("myModalSourceAddress", "source");
	loadAddressModal("myModalDestinationAddress", "destination");
	$journey_type = 0;
	if(isset($_GET['journey_type'])){
		$journey_type = mres_ss($_GET['journey_type']);
	}
	$eid = null;
	$from = null;
	if(isset($_GET['from'])){
		$from = mres_ss($_GET['from']);
	}
	if(isset($_GET['eid'])){
		$eid = mres_ss($_GET['eid']);
	}
	$valid_journey = false;
	
	echo '  <div class="container">';/*ravi*/
	echo '  <div class="row">';/*ravi*/
	echo '<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 main"  style="padding:0px 10px 0px 10px">';/*ravi*/
	echo '<h1 class="page-header">My Journeys</h1>';
	echo '<div class="row" style="">';
	checkPageMessages();

	if($eid){
		$valid_journey = false;
		$res = runQuery("select * from journeys where journey_id='$eid' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') ".
						"and journey_date >= '".date('Y-m-d')."'");
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_array($res);
			$valid_journey = true;
		}else{
			$message = buildMessage("Invalid Journey!", "Please select a valid Journey");
			setPageErrorMessage($message);
			checkPageMessages();
		}
	}
	echo '	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:0px">';
	echo '		<div class="panel panel-primary">';
	if($valid_journey){
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center;">';
		echo '			<h3 class="panel-title">Edit Journey</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse in" id="pContent">';
	}else{
		if($from)
		{
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center;">';
		echo '			<h3 class="panel-title">Add New Journey</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse in" id="pContent">';
		}else{
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center;">';
		echo '			<h3 class="panel-title">Add New Journey</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-plus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse" id="pContent">';
		}
	}
	                       
	
	if($valid_journey){
		echo '			<form class="form-signin" onsubmit="return updateJourneys()">';
	}else{
		echo '			<form class="form-signin" onsubmit="return userJourneys()">';
	}
	echo '					<div class="row" style="border-bottom: 1px solid #009688; padding-bottom: 4px;">
							<input type="hidden" id="journey_id" name="journey_id" value="'.$eid.'">';
	echo '						<div class="col-xs-12">';
	echo '							<div style="border-bottom: 1px solid #fac106; padding-bottom: 5px; font-weight: bold;">Source Address</div>';
	echo '							<div style="">';
	echo '								<button id="sourceAddressLink" type="button" style="padding: 0px; margin-top: 4px;" class="btn btn-link" data-target="#myModalSourceAddress" data-toggle="modal">';
	if($valid_journey){
		$res1 = runQuery("select address_label from address where address_id='".$row['source_address_id']."'");
		if($res1 && mysqli_num_rows($res1)){
			$row1 = mysqli_fetch_array($res1);
			echo $row1['address_label'];
		}else{
			echo 'Select Address from list';
		}
	}else{
		echo 'Select Address from list';
	}
	echo '								</button>';
	
	if($valid_journey){
		echo '							<input type="hidden" id="source_address_id" name="input_source_address_id" value="'.$row['source_address_id'].'" />';
	}else{
		echo '							<input type="hidden" id="source_address_id" name="input_source_address_id" />';
	}
	echo '							</div>';
	echo '						</div>
							<div class="col-xs-12"><span id="source_address_status" class="error-status"></span></div>';
	echo '						<div class="col-xs-12">';
	echo '							<div style="border-bottom: 1px solid #fac106; padding-bottom: 5px; font-weight: bold;">Destination Address</div>';
	echo '							<div style="">';
	echo '								<button id="destinationAddressLink" type="button" style="padding: 0px; margin-top: 4px;" class="btn btn-link" data-target="#myModalDestinationAddress" data-toggle="modal">';
	if($valid_journey){
		$res1 = runQuery("select address_label from address where address_id='".$row['destination_address_id']."'");
		if($res1 && mysqli_num_rows($res1)){
			$row1 = mysqli_fetch_array($res1);
			echo $row1['address_label'];
		}else{
			echo 'Select Address from list';
		}
	}else{
		echo 'Select Address from list';
	}
	echo '								</button>';
	if($valid_journey){
		echo '							<input type="hidden" id="destination_address_id" name="input_destination_address_id" value="'.$row['destination_address_id'].'" />';
	}else{
		echo '							<input type="hidden" id="destination_address_id" name="input_destination_address_id" />';
	}
	echo '							</div>';
	echo '						</div>
							<div class="col-xs-12"><span id="destination_address_status" class="error-status"></span></div>';
	echo '					</div>';
	echo '					<div class="row" style="margin-bottom: 10px;">';
	echo '						<div class="col-xs-12">';
	echo '							<div style="padding-top: 10px;">';
	echo '								<div style="font-weight: bold; padding-bottom: 5px;">Journey Date</div>';
	echo '								<div style="">';
	echo '									<label for="inputDate" class="sr-only">Journey Date</label>';
	if($valid_journey){
		echo '								<input type="text" id="datepicker" name="input_journey_date" value="'.$row['journey_date'].'" class="form-control" placeholder="Enter Journey Date">';
	}else{
		echo '								<input type="text" id="datepicker" name="input_journey_date" class="form-control" placeholder="Enter Journey Date"> '
		;
	}
	
	echo '								<span id="date_status" class="error-status"></span></div>';
	echo '							</div>';
	echo '							<div style="padding-top: 5px;">';
	echo '								<div style="font-weight: bold; padding-bottom: 5px;">Headline (Max. 100 Characters)</div>';
	echo '								<div style="">';
	echo '									<label for="inputText" class="sr-only">Headline</label>';
	if($valid_journey){
		echo '								<input type="text" id="input_headline" name="input_headline" value="'.$row['headline'].'" class="form-control" maxlength=100 placeholder="Enter Headline">';
	}else{
		echo '								<input type="text" id="input_headline" name="input_headline" class="form-control" maxlength=100 placeholder="Enter Headline">';
	}
	echo '								<span id="headline_status" class="error-status"></span></div>';
	echo '							</div>';
	echo '						</div>';
	echo '						<div class="col-xs-12">';
	echo '							<div style="padding-top: 10px;">';
	echo '								<div style="font-weight: bold; padding-bottom: 5px;">Additional Notes (Max. 300 Characters)</div>';
	echo '								<div class="form-group">';
	if($valid_journey){
		echo '								<textarea name="input_notes" class="form-control" rows="4" placeholder="Enter Addtional Notes">'.$row['notes'].'</textarea>';
	}else{
		echo '								<textarea name="input_notes" class="form-control" rows="4" placeholder="Enter Addtional Notes"></textarea>';
	}
	echo '								<span id="notes_status" class="error-status"></span></div>';
	echo '							</div>';
	echo '						</div>';
	echo '					</div>
						<div><span id="submit_status" class="error-status"></span></div>';
	echo '					<div class="row" style="border-top: 1px solid #009688; padding-top: 10px;" align="center">';
	if($valid_journey){
		echo '    				<label style="width: 50%;">';
	}else{
		echo '    				<label style="width: 50%;">';
	}
	echo '						<button class="btn btn-lg btn-primary btn-block" style="" type="submit">';
	if($valid_journey){
		echo '						Update Journey';
	}else{
		echo '						Add Journey';
	}
	echo '						</button>';
	echo '    					</label>';
	if($valid_journey){
		echo '    				<label style="width: 25%;">';
		echo '						<a href="'.$_SERVER['PHP_SELF'].'" style="text-decoration: none;">';
		echo '							<button type="button" class="btn btn-link">Cancel</button>';
		echo '						</a>';
		echo '    				</label>';
	}
	echo '					</div>';
	echo '				</form>';
	echo '			</div>';
	echo '		</div>';
	echo '	</div>';
	echo '	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="">';
	echo '		<div style="width: 100%;">';
	echo '			       <div style="border-bottom: 1px solid #fac106; padding-bottom: 2px; font-size: 24px; margin-bottom: 10px;">Journey List</div>';
	echo '			       <div style="border: 1px solid #009688;border-radius: 0px">';
	$res = runQuery("select * from journeys where journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') and journey_date >= '".
					date('Y-m-d')."' order by journey_date desc");
	if($res && mysqli_num_rows($res)){
		while($row = mysqli_fetch_array($res)){
			echo '			<div style="padding: 10px; border-bottom: 1px solid #009688;">';
			echo '				<div style="border-bottom: 1px solid #fac106;">';
			echo '					<label style=""><h4 class="list-group-item-heading">'.$row['headline'].'</h4></label>';
			echo '					<label style="font-size: 12px; font-weight: normal; float: right;">Last Update: '.time_elapsed_string($row['timestamp']).'</label>';
			echo '				</div>';
			echo '				<div class="row" style="padding-top:10px">';
			echo '					<div style="" class="col-md-4 col-xs-12">';
			echo '						<div style="border-bottom: 1px solid #fac106;"><label>Source Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['source_address_id']."'");
			
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row1['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row1['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
			$source_pincode = $row1['pincode'];
			echo '					</div>';
			echo '					<div style="" class="col-md-4 col-xs-12">';
			echo '						<div style="border-bottom: 1px solid #fac106;"><label>Destination Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['destination_address_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row1['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row1['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
			$destination_pincode = $row1['pincode'];
			echo '					</div>';
			echo '					<div class="col-md-4 col-xs-12">';
			echo '						<div style="">';
			echo '							<label style="width: 50%">Journey Date</label>';
			echo '							<label style="font-weight: normal;">'.$row['journey_date'].'</label>';
			echo '						</div>';
			echo '						<div style="">';
			echo '							<label style="width: 50%">Additional Notes</label>';
			echo '							<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '						</div>';
			echo '						<div class="row"><div class="col-xs-6"><a href="'.$_SERVER['PHP_SELF'].'?eid='.$row['journey_id'].'"<button type="button" style="width: 100%;" class="btn btn-primary">Edit</button></a></div>';
			
			echo '						<div class="col-xs-6"><button type="button" style="width: 100%;" class="btn btn-primary" onclick="deleteJourney(\''.$row['journey_id'].'\');">Delete</button></div></div>';
			echo '						<div style="margin-top:5px">
										<a href="myDashboard.php?as_a=sender&input_journey_source_pincode_search='.$source_pincode.'&input_journey_destination_pincode_search='.$destination_pincode.'"<button type="button" style="width: 100%;" class="btn btn-primary">Find a weSender</button></a>
									</div>';
									
			
			
			echo '				       </div>';
			echo '			       </div>';
			echo '		       </div>';
		}
	}else{
			echo '       	       <div style="text-align: center; padding: 10px; font-weight: bold; color: silver;">No Journeys found in this region</div>';
	}
	                echo '		</div>';
	echo '		</div>';
	echo '	</div>';
	
        echo '</div>';
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
