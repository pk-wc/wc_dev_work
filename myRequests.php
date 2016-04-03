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
getPageTitle("My Requests");
loadCSSFiles();
loadJSFiles();
echo '    <link href="custom/css/rateit.css" rel="stylesheet">';
echo '    <link href="custom/css/rating.css" rel="stylesheet">';
echo '    
<script>
	function addJourneyToField(j_id, j_label,j_notes,j_date,j_source1,j_source2,j_source3,j_source4,j_destination1,j_destination2,j_destination3,j_destination4){
			    document.getElementById("journey_id").value = j_id;
			    document.getElementById("myJourneysLink").innerHTML = "Select another Journey from my Travel List";
			    document.getElementById("journey_label").innerHTML = j_label;
			    document.getElementById("journey_date").innerHTML = j_date;
			    document.getElementById("journey_notes").innerHTML = j_notes;
			    document.getElementById("journey_source_address").innerHTML = j_source1;
			    document.getElementById("journey_source_city").innerHTML = j_source2;
			    document.getElementById("journey_source_state").innerHTML = j_source3;
			    document.getElementById("journey_source_pincode").innerHTML = j_source4;
			    document.getElementById("journey_destination_address").innerHTML = j_destination1;
			    document.getElementById("journey_destination_city").innerHTML = j_destination2;
			    document.getElementById("journey_destination_state").innerHTML = j_destination3;
			    document.getElementById("journey_destination_pincode").innerHTML = j_destination4;
			    document.getElementById("journey_info").style.display = "block"; 
			}
			
	function addOrderToField(o_id,o_label,o_price,o_date,o_source1,o_source2,o_source3,o_source4,o_destination1,o_destination2,o_destination3,o_destination4){
			    document.getElementById("order_id").value = o_id;
			    document.getElementById("myOrdersLink").innerHTML = "Select another Parcel from my Parcels List";
			    document.getElementById("order_label").innerHTML = o_label;
			    document.getElementById("order_date").innerHTML = o_date;
			    document.getElementById("order_price").innerHTML = o_price;
			    document.getElementById("order_source_address").innerHTML = o_source1;
			    document.getElementById("order_source_city").innerHTML = o_source2;
			    document.getElementById("order_source_state").innerHTML = o_source3;
			    document.getElementById("order_source_pincode").innerHTML = o_source4;
			    document.getElementById("order_destination_address").innerHTML = o_destination1;
			    document.getElementById("order_destination_city").innerHTML = o_destination2;
			    document.getElementById("order_destination_state").innerHTML = o_destination3;
			    document.getElementById("order_destination_pincode").innerHTML = o_destination4;
			    document.getElementById("order_info").style.display = "block";
			}
	function deleteRequest(req_id){
		if(confirm("Are you sure you wanna delete this request?")){
			window.location.href="deleteRequest.php?rid=" + req_id;
		}
	}
	function handleRequest(req_id, op){
		if(op == 1){
			str = "Are you sure you wanna accept this request?";
		}else{
			str = "Are you sure you wanna decline this request?";
		}
		if(confirm(str)){
			window.location.href="handleRequest.php?op=" + op + "&rid=" + req_id;
		}
	}

</script>';
echo '  </head>';
echo '  <body>';

showHeader("my_requests");
loadLoginModal();
echo ' <div id="content">';
echo '    <div class="container">';
checkPageMessages();
echo '    </div>';

if($wc_uid){
	if(verifyUserProfile($wc_uid) == 0){
		header("location: pendingProfile.php");
	}
	loadJourneyModal("myModalJourneys");
	loadOrderModal("myModalOrders");
	$order_id = null;
	if(isset($_GET['oid'])){
		$order_id = mres_ss($_GET['oid']);
	}
	$journey_id = null;
	if(isset($_GET['jid'])){
		$journey_id = mres_ss($_GET['jid']);
	}
	echo '  <div class="container">';/*ravi*/
	echo '<h1 class="page-header">My Requests</h1>';
	echo '	<div style="">';
	if($order_id){
		$res = runQuery("select * from orders where order_id='$order_id'");
		if($res && mysqli_num_rows($res)){
			echo '<div class="row" style="z-index:10;border:1px solid #eee;box-shadow: 0 2px 5px black;border-radius: 5px;margin-bottom:10px;padding-top:10px">';
			$row = mysqli_fetch_array($res);
			echo '	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">';
			echo '		<div class="panel panel-primary">';
			echo '			<div class="panel-heading">';
			echo '				<h3 class="panel-title">Parcel Details</h3>';
			echo '			</div>';
			echo '			<div class="panel-body">';
			echo '				<div style="">';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Headline</label>';
			echo '						<label style="font-weight: normal;">'.$row['headline'].'</label>';
			echo '					</div>';
			$res1 = runQuery("select * from address where address_id='".$row['pickup_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '				<div style="">';
				echo '					<label style="width: 30%;">Pickup Address</label>';
				echo '					<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				$pincode = $row1['pincode'];
				$res2 = runQuery("select * from pincodes where pincode='$pincode'");
				$row2 = mysqli_fetch_array($res2);
				echo '					<label style="font-weight: normal;">'.$row2['city'].'</label>, ';
				echo '					<label style="font-weight: normal;">'.$row2['state'].'</label>,
									<label style="font-weight: normal;">India</label>';
				echo '				</div>';
				echo '				<div style="">';
				echo '					<label style="width: 30%;"></label>';
				echo '					<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '				</div>';
			}
			$res1 = runQuery("select * from address where address_id='".$row['delivery_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '				<div style="">';
				echo '					<label style="width: 30%;">Delivery Address</label>';
				echo '					<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				$pincode = $row1['pincode'];
				$res2 = runQuery("select * from pincodes where pincode='$pincode'");
				$row2 = mysqli_fetch_array($res2);
				echo '					<label style="font-weight: normal;">'.$row2['city'].'</label>, ';
				echo '					<label style="font-weight: normal;">'.$row2['state'].'</label>,
				                                        <label style="font-weight: normal;">India</label>';
				echo '				</div>';
				echo '				<div style="">';
				echo '					<label style="width: 30%;"></label>';
				echo '					<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '				</div>';
			}
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Delivery Date</label>';
			echo '						<label style="font-weight: normal;">'.$row['delivery_date'].'</label>';
			echo '					</div>';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Weight</label>';
			echo '						<label style="font-weight: normal;">'.$row['weight'].' Kgs</label>';
			echo '					</div>';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Price</label>';
			echo '						<label style="font-weight: normal;">'.$row['price'].' bucks</label>';
			echo '					</div>';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Additional Notes</label>';
			echo '						<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '					</div>';
			echo '				</div>';
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
			echo '	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">';
			echo '		<form action="userRequests.php?oid='.$order_id.'" method="post">';
			echo '			<div class="panel panel-primary">';
			echo '				<div class="panel-heading">';
			echo '					<h3 class="panel-title">Journey Details</h3>';
			echo '				</div>';
			echo '				<div class="panel-body">';
			echo '					<div style="">';
			echo '						<div id="journey_info" style="display: none;">';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Headline</label>';
					echo '						<label style="font-weight: normal;" id="journey_label"></label>';
					echo '					</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;">Pickup Address</label>';
						echo '					<label style="font-weight: normal;" id="journey_source_address"></label>, ';
						echo '					<label style="font-weight: normal;" id="journey_source_city"></label>, ';
						echo '					<label style="font-weight: normal;" id="journey_source_state"></label>,
											<label style="font-weight: normal;">India</label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;"></label>';
						echo '					<label style="font-weight: normal;" id="journey_source_pincode"></label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;">Delivery Address</label>';
						echo '				<label style="font-weight: normal;" id="journey_destination_address"></label>, ';
						echo '				<label style="font-weight: normal;" id="journey_destination_city"></label>, ';
						echo '				<label style="font-weight: normal;" id="journey_destination_state"></label>,
						                                    	<label style="font-weight: normal;">India</label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;"></label>';
						echo '					<label style="font-weight: normal;" id="journey_destination_pincode"></label>';
						echo '				</div>';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Journey Date</label>';
					echo '						<label style="font-weight: normal;" id="journey_date"></label>';
					echo '					</div>';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Additional Notes</label>';
					echo '						<label style="font-weight: normal;" id="journey_notes"></label>';
					echo '					</div>';
			
			echo '						</div>';
			
			echo '						<div style="text-align:center">';
			echo '							<button id="myJourneysLink" style="padding: 0px; margin-top: 4px;" type="button" class="btn btn-link" data-target="#myModalJourneys" data-toggle="modal">';
			echo '								Select Journey from my Travel List';
			echo '							</button>';
			echo '							<input type="hidden" id="journey_id" name="input_journey_id"/>';
			echo '						</div>';
			echo '					</div>';
			echo '				</div>';
			echo '			</div>';
			echo '	</div>';
			echo '			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="text-align:center;margin-bottom:10px">';
			echo '				<button class="btn btn-primary" style="" type="submit">';
			echo '					Send Request';
			echo '				</button>';
			echo '			</div>';
			echo '		</form>';
			echo '</div>';
		}else{
		
			$page_message = buildMessage("Invalid Request!", "Please select a valid request");
			setPageErrorMessage($page_message);
			checkPageMessages();
		}
	}else if($journey_id){
		$res = runQuery("select * from journeys where journey_id='$journey_id'");
		if($res && mysqli_num_rows($res)){
			echo '<div class="row" style="z-index:10;border:1px solid #eee;box-shadow: 0 2px 5px black;border-radius: 5px;margin-bottom:10px;padding-top:10px">';
			$row = mysqli_fetch_array($res);
			echo '	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">';
			echo '		<div class="panel panel-primary">';
			echo '			<div class="panel-heading">';
			echo '				<h3 class="panel-title">Journey Details</h3>';
			echo '			</div>';
			echo '			<div class="panel-body">';
			echo '				<div style="">';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Headline</label>';
			echo '						<label style="font-weight: normal;">'.$row['headline'].'</label>';
			echo '					</div>';
			$res1 = runQuery("select * from address where address_id='".$row['source_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '				<div style="">';
				echo '					<label style="width: 30%;">Source Address</label>';
				echo '					<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				$pincode = $row1['pincode'];
				$res2 = runQuery("select * from pincodes where pincode='$pincode'");
				$row2 = mysqli_fetch_array($res2);
				echo '					<label style="font-weight: normal;">'.$row2['city'].'</label>, ';
				echo '					<label style="font-weight: normal;">'.$row2['state'].'</label>,
									<label style="font-weight: normal;">India</label>';
				echo '				</div>';
				echo '				<div style="">';
				echo '					<label style="width: 30%;"></label>';
				echo '					<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '				</div>';
			}
			$res1 = runQuery("select * from address where address_id='".$row['destination_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '				<div style="">';
				echo '					<label style="width: 30%;">Destination Address</label>';
				echo '					<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				$pincode = $row1['pincode'];
				$res2 = runQuery("select * from pincodes where pincode='$pincode'");
				$row2 = mysqli_fetch_array($res2);
				echo '					<label style="font-weight: normal;">'.$row2['city'].'</label>, ';
				echo '					<label style="font-weight: normal;">'.$row2['state'].'</label>,
									<label style="font-weight: normal;">India</label>';
				echo '				</div>';
				echo '				<div style="">';
				echo '					<label style="width: 30%;"></label>';
				echo '					<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '				</div>';
			}
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Journey Date</label>';
			echo '						<label style="font-weight: normal;">'.$row['journey_date'].'</label>';
			echo '					</div>';
			echo '					<div style="">';
			echo '						<label style="width: 30%;">Additional Notes</label>';
			echo '						<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '					</div>';
			echo '				</div>';
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
			echo '	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">';
			echo '		<form action="userRequests.php?jid='.$journey_id.'" method="post">';
			echo '			<div class="panel panel-primary">';
			echo '				<div class="panel-heading">';
			echo '					<h3 class="panel-title">Parcel Details</h3>';
			echo '				</div>';
			echo '				<div class="panel-body">';
			echo '					<div style="">';
			echo '						<div id="order_info" style="display: none;">';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Headline</label>';
					echo '						<label style="font-weight: normal;" id="order_label"></label>';
					echo '					</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;">Pickup Address</label>';
						echo '					<label style="font-weight: normal;" id="order_source_address"></label>, ';
						echo '					<label style="font-weight: normal;" id="order_source_city"></label>, ';
						echo '					<label style="font-weight: normal;" id="order_source_state"></label>,
											<label style="font-weight: normal;">India</label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;"></label>';
						echo '					<label style="font-weight: normal;" id="order_source_pincode"></label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;">Delivery Address</label>';
						echo '				<label style="font-weight: normal;" id="order_destination_address"></label>, ';
						echo '				<label style="font-weight: normal;" id="order_destination_city"></label>, ';
						echo '				<label style="font-weight: normal;" id="order_destination_state"></label>,
						                                    	<label style="font-weight: normal;">India</label>';
						echo '				</div>';
						echo '				<div style="">';
						echo '					<label style="width: 30%;"></label>';
						echo '					<label style="font-weight: normal;" id="order_destination_pincode"></label>';
						echo '				</div>';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Journey Date</label>';
					echo '						<label style="font-weight: normal;" id="order_date"></label>';
					echo '					</div>';
					echo '					<div style="">';
					echo '						<label style="width: 30%;">Price</label>';
					echo '						<label style="font-weight: normal;" id="order_price"></label>';
					echo '					</div>';
			
			echo '						</div>';
			echo '						<div style="text-align:center">';
			echo '							<button id="myOrdersLink" style="padding: 0px; margin-top: 4px;" type="button" class="btn btn-link" data-target="#myModalOrders" data-toggle="modal">';
			echo '								Select Parcel from my Parcels List';
			echo '							</button>';
			echo '							<input type="hidden" id="order_id" name="input_order_id" />';
			echo '						</div>';
			echo '					</div>';
			echo '				</div>';
			echo '			</div>';
			echo '	</div>';
			echo '			<div class="col-md-12" style="text-align:center;margin-bottom:10px">';
			echo '				<button class="btn btn-primary" style="" type="submit">';
			echo '					Send Request';
			echo '				</button>';
			echo '			</div>';
			echo '		</form>';
			echo '</div>';
		}else{
			$page_message = buildMessage("Invalid Request!", "Please select a valid request");
			setPageErrorMessage($page_message);
			checkPageMessages();
		}
	}
	echo '	</div>';
	
	$as_a = "carrier";
	if(isset($_GET['as_a'])){
		$as_a = mres_ss($_GET['as_a']);
	}
	if(strcmp($as_a, "carrier") == 0){
		$is_carrier = 1;
	}else{
		$is_carrier = 0;
	}

	$status = "in-progress";
	if(isset($_GET['status'])){
		$status = mres_ss($_GET['status']);
	}
	echo '	<div style="border: 1px solid #009688">';
	echo '		<div style="border-bottom: 1px solid #009688">';
	echo '			<ul class="nav nav-tabs" role="tablist" style="text-align: center;">';
	$q = "select * from requests where is_carrier='1' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid')".
	     " union ".
	     "select * from requests where is_carrier='1' and order_id in (select order_id from order_sender where user_id='$wc_uid')";
	$res = runQuery($q);
	$no_of_requests = 0;
	if($res){
		$no_of_requests = mysqli_num_rows($res);
	}
	if(strcmp($as_a, "carrier") == 0){
    	echo '			<li role="presentation" class="active" style="width: 50%;">';
    }else{
    	echo '			<li role="presentation" style="width: 50%;">';
    }
	echo '					<a href="'.$_SERVER['PHP_SELF'].'?as_a=carrier&status='.$status.'">Requests as Carrier ';
	if($no_of_requests > 0){
		echo '					<span class="badge">'.$no_of_requests.'</span></a>';
	}
	echo '					</a>';
	echo '				</li>';

	$q = "select * from requests where is_carrier='0' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid')".
	     " union ".
	     "select * from requests where is_carrier='0' and order_id in (select order_id from order_sender where user_id='$wc_uid')";
	$res = runQuery($q);
	$no_of_requests = 0;
	if($res){
		$no_of_requests = mysqli_num_rows($res);
	}
    if(strcmp($as_a, "sender") == 0){
    	echo '			<li role="presentation" class="active" style="width:50%;">';
    }else{
    	echo '			<li role="presentation" style="width: 50%;">';
    }
	echo '					<a href="'.$_SERVER['PHP_SELF'].'?as_a=sender&status='.$status.'">Requests as Sender ';
	if($no_of_requests > 0){
		echo '					<span class="badge">'.$no_of_requests.'</span></a>';
	}
	echo '					</a>';
	echo '				</li>';
	echo '			</ul>';
	echo '		</div>';

	echo '		<div style="border-bottom: 1px solid #009688; padding: 5px 2px 5px 2px;">';
	echo '			<ul class="nav nav-pills" role="tablist" style="text-align: center;">';
	
	$q = "select * from requests where is_carrier='$is_carrier' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') and status_id in (select status_id from status where status='in-progress')".
	     " union ".
	     "select * from requests where is_carrier='$is_carrier' and order_id in (select order_id from order_sender where user_id='$wc_uid') and status_id in (select status_id from status where status='in-progress')";
	$res = runQuery($q);
	$no_of_requests = 0;
	if($res){
		$no_of_requests = mysqli_num_rows($res);
	}
	if(strcmp($status, "in-progress") == 0){
    	echo '			<li role="presentation" class="active" style="width: 33%;">';
    }else{
    	echo '			<li role="presentation" style="width: 33%;">';
    }
	echo '					<a href="'.$_SERVER['PHP_SELF'].'?as_a='.$as_a.'&status=in-progress">In-Progress ';
	if($no_of_requests > 0){
		echo '					<span class="badge">'.$no_of_requests.'</span></a>';
	}
	echo '					</a>';
	echo '				</li>';
    
    $q = "select * from requests where is_carrier='$is_carrier' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') and status_id in (select status_id from status where status='accepted')".
         " union ".
         "select * from requests where is_carrier='$is_carrier' and order_id in (select order_id from order_sender where user_id='$wc_uid') and status_id in (select status_id from status where status='accepted')";
    $res = runQuery($q);
    $no_of_requests = 0;
    if($res){
    	$no_of_requests = mysqli_num_rows($res);
    }
    if(strcmp($status, "accepted") == 0){
    	echo '			<li role="presentation" class="active" style="width: 33%;">';
    }else{
    	echo '			<li role="presentation" style="width: 33%;">';
    }
	echo '					<a href="'.$_SERVER['PHP_SELF'].'?as_a='.$as_a.'&status=accepted">Accepted ';
	if($no_of_requests > 0){
		echo '					<span class="badge">'.$no_of_requests.'</span></a>';
	}
	echo '					</a>';
	echo '				</li>';

    $q = "select * from requests where is_carrier='$is_carrier' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') and status_id in (select status_id from status where status='declined')".
         " union ".
         "select * from requests where is_carrier='$is_carrier' and order_id in (select order_id from order_sender where user_id='$wc_uid') and status_id in (select status_id from status where status='declined')";
    $res = runQuery($q);
    $no_of_requests = 0;
    if($res){
    	$no_of_requests = mysqli_num_rows($res);
    }
    if(strcmp($status, "declined") == 0){
    	echo '			<li role="presentation" class="active" style="width: 33%;">';
    }else{
    	echo '			<li role="presentation" style="width: 33%;">';
    }
	echo '					<a href="'.$_SERVER['PHP_SELF'].'?as_a='.$as_a.'&status=declined">Declined ';
	if($no_of_requests > 0){
		echo '					<span class="badge">'.$no_of_requests.'</span></a>';
	}
	echo '					</a>';
	echo '				</li>';

	echo '			</ul>';
	echo '		</div>';

	echo '		<div style="">';
	$q = "select * from requests where is_carrier='$is_carrier' and journey_id in (select journey_id from carrier_journeys where user_id='$wc_uid') and status_id in (select status_id from status where status='$status')".
	     " union ".
	     "select * from requests where is_carrier='$is_carrier' and order_id in (select order_id from order_sender where user_id='$wc_uid') and status_id in (select status_id from status where status='$status')";
	$res = runQuery($q);
	if($res && mysqli_num_rows($res)){
		while($row = mysqli_fetch_array($res)){
			echo '	<div class="row" style="border-bottom: 1px solid #009688; padding-top: 10px;padding-bottom: 10px;margin-right: 0px;margin-left: 0px">';
			echo '		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">';
			
			echo '			<div class="row" style="border-bottom: 1px solid #fac106">';
			
			echo '				<div class="col-xs-6" style="font-weight: bold;">';
			echo '					Carrier Details';
			echo '				</div>';
			echo '				<div class="col-xs-6" style="font-size: 10px;padding-left: 0px">';
			$res1 = runQuery("select user_id,username from users where user_id in (select user_id from carrier_journeys where journey_id='".$row['journey_id']."')");
			$row1 = mysqli_fetch_array($res1);
			if($row1['user_id'] == $wc_uid){
				echo '				<label style="font-weight: normal;">By me</label>';
			}else{
				echo '				<label style="font-weight: normal;">By '.$row1['username'].'</label>';
			}
			$res1 = runQuery("select posted_on from journeys where journey_id='".$row['journey_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '					<label style="font-weight: normal;">, Posted '.time_elapsed_string($row1['posted_on']).'</label>';
			echo '				</div>';
			
			echo '			</div>';
			$res1 = runQuery("select * from journeys where journey_id='".$row['journey_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '			<div style="font-size: 12px; padding: 5px;">';
			/*
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Journey Type</label>';
			echo '					<label style="font-weight: normal;">'.getInterTypeStr($row1['journey_type']).'</label>';
			echo '				</div>';
			*/
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Headline</label>';
			echo '					<label style="font-weight: normal;">'.$row1['headline'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Additional Notes</label>';
			echo '					<label style="font-weight: normal;">'.$row1['notes'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Source Address</label>';
			$res2 = runQuery("select * from address where address_id='".$row1['source_address_id']."'");
			$row2 = mysqli_fetch_array($res2);
			$pincode = $row2['pincode'];
			$res3 = runQuery("select * from pincodes where pincode='$pincode'");
			$row3 = mysqli_fetch_array($res3);
			echo '					<label style="font-weight: normal;">'.$row2['address'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['city'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['state'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;"></label>';
			echo '					<label style="font-weight: normal;">'.$row2['pincode'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Destination Address</label>';
			$res2 = runQuery("select * from address where address_id='".$row1['destination_address_id']."'");
			$row2 = mysqli_fetch_array($res2);
			$pincode = $row2['pincode'];
			$res3 = runQuery("select * from pincodes where pincode='$pincode'");
			$row3 = mysqli_fetch_array($res3);
			echo '					<label style="font-weight: normal;">'.$row2['address'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['city'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['state'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;"></label>';
			echo '					<label style="font-weight: normal;">'.$row2['pincode'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Journey Date</label>';
			echo '					<label style="font-weight: normal;">'.$row1['journey_date'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;"></label>';
			echo '					<label style="font-weight: normal;"></label>';
			echo '				</div>';
			echo '			</div>';
			echo '		</div>';
			echo '		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">';
			echo '			<div class="row" style="border-bottom: 1px solid #fac106">';
			echo '				<div class="col-xs-6" style="font-weight: bold;">';
			echo '					Sender Details';
			echo '				</div>';
			echo '				<div class="col-xs-6" style="font-size: 10px;padding-left: 0px">'; 
		$res1 = runQuery("select user_id,username from users where user_id in (select user_id from order_sender where order_id='".$row['order_id']."')");
			
			$row1 = mysqli_fetch_array($res1);
			if($row1['user_id'] == $wc_uid){
				echo '				<label style="font-weight: normal;">By me</label>';
			}else{
				echo '				<label style="font-weight: normal;">By '.$row1['username'].'</label>';
			}
			$res1 = runQuery("select posted_on from orders where order_id='".$row['order_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '					<label style="font-weight: normal;">, Posted '.time_elapsed_string($row1['posted_on']).'</label>';
			echo '				</div>';
			echo '			</div>';
			$res1 = runQuery("select * from orders where order_id='".$row['order_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '			<div style="font-size: 12px; padding: 5px;">';
			/*
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Order Type</label>';
			echo '					<label style="font-weight: normal;">'.getInterTypeStr($row1['order_type']).'</label>';
			echo '				</div>';
			*/
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Headline</label>';
			echo '					<label style="font-weight: normal;">'.$row1['headline'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Additional Notes</label>';
			echo '					<label style="font-weight: normal;">'.$row1['notes'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Pickup Address</label>';
			$res2 = runQuery("select * from address where address_id='".$row1['pickup_address_id']."'");
			$row2 = mysqli_fetch_array($res2);
			$pincode = $row2['pincode'];
			$res3 = runQuery("select * from pincodes where pincode='$pincode'");
			$row3 = mysqli_fetch_array($res3);
			echo '					<label style="font-weight: normal;">'.$row2['address'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['city'].'</label>, ';
			echo '					<label style="font-weight: normal;">'.$row3['state'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;"></label>';
			echo '					<label style="font-weight: normal;">'.$row2['pincode'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Delivery Address</label>';
			$res2 = runQuery("select * from address where address_id='".$row1['delivery_address_id']."'");
			$row2 = mysqli_fetch_array($res2);
			$pincode = $row2['pincode'];
			$res3 = runQuery("select * from pincodes where pincode='$pincode'");
			$row3 = mysqli_fetch_array($res3);
			echo '					<label style="font-weight: normal;">'.$row2['address'].'</label>';
			echo '					<label style="font-weight: normal;">'.$row3['city'].'</label>';
			echo '					<label style="font-weight: normal;">'.$row3['state'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;"></label>';
			echo '					<label style="font-weight: normal;">'.$row2['pincode'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Delivery Date</label>';
			echo '					<label style="font-weight: normal;">'.$row1['delivery_date'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 30%;">Price Quote</label> ';
			echo '					<label style="font-weight: normal;">'.$row1['price'].' bucks</label>';
			echo '					<label style="width: 10%;"></label>';
			echo '					<label style="width: 30%;">Weight</label> ';
			echo '					<label style="font-weight: normal;">'.$row1['weight'].' Kgs</label>';
			echo '				</div>';
			echo '			</div>';
			echo '		</div>';
			echo '		<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">';
			echo '			<div class="row" style=" border-bottom: 1px solid #fac106">';
			echo '				<div class="col-xs-6" style="font-weight: bold;">';
			echo '					Request Details';
			echo '				</div>';
			echo '				<div class="col-xs-6" style="font-size: 10px;">';
			echo '					<label class="pull-right" style="font-weight: normal;">Id: '.$row['request_id'].'</label>';
			echo '				</div>';
			echo '			</div>';
			if($is_carrier){
				$q = "select * from carrier_journeys where journey_id='".$row['journey_id']."' and user_id='$wc_uid'";
			}else{
				$q = "select * from order_sender where order_id='".$row['order_id']."' and user_id='$wc_uid'";
			}
			$res1 = runQuery($q);
			loadReviewModal($row['request_id']);
			loadChatModal($row['request_id']);
			echo '		<div style="">';
			echo '			<div style="margin-top: 10px;text-align:center">';
			echo '				<button type="button" data-target="#myModalChat'.$row['request_id'].'" data-toggle="modal" class="btn btn-primary">Send Message</button>';
			echo '			</div>';
			if(!($res1 && mysqli_num_rows($res1))){
				if(strcmp($status, "in-progress") == 0){
					echo '	<div style="margin-top: 10px;text-align:center">';
					echo '		<button type="button" class="btn btn-primary" style="" onclick="handleRequest(\''.$row['request_id'].'\', 1);">Accept Request</button></a>';
					echo '	</div>';
					echo '	<div style="margin-top: 10px;text-align:center">';
					echo '		<button type="button" class="btn btn-primary" style="" onclick="handleRequest(\''.$row['request_id'].'\', 2);">Decline Request </button>';
					echo '	</div>';
				}else{
			echo '			<div style="margin-top: 10px;text-align:center">';
			echo '				<button type="button" data-target="#myModalReview'.$row['request_id'].'" data-toggle="modal" class="btn btn-primary">Post Review</button>';
			echo '			</div>';
				}
			}
			
			if($res1 && mysqli_num_rows($res1)){
				if(strcmp($status, "in-progress") == 0){
			echo '			<div style="margin-top: 10px;text-align:center">';
			echo '				<button type="button" class="btn btn-primary" onclick="deleteRequest(\''.$row['request_id'].'\');">Delete Request</button>';
			echo '			</div>';
				}else{
			echo '			<div style="margin-top: 10px;text-align:center">';
			echo '				<button type="button" data-target="#myModalReview'.$row['request_id'].'" data-toggle="modal" class="btn btn-primary">Post Review</button>';
			echo '			</div>';
				}
				
			}
			echo '		</div>';
			echo '		</div>';
			echo '	</div>';
		}
	}else{
	
		echo '		<div style="font-weight: bold; color: silver; padding: 10px;" align="center">No requests found</div>';
	}
	echo '		</div>';
	echo '	</div>';
	echo '</div>';
}else{
header("location: index.php");
}
echo ' </div>';
showFooter();

loadLaterJSFiles();
echo '		<script src="custom/js/jquery/jquery.rateit.js"></script>';
echo '  </body>';
echo '</html>';

?>
