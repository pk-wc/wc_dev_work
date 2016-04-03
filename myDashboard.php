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
echo '  </head>';
echo '  <body>';

showHeader("my_dashboard");
loadLoginModal();
echo ' <div id="content">';
if($wc_uid){
	echo '    <div class="container">';
	checkPageMessages();
	echo '    </div>';
	if(verifyUserProfile($wc_uid) == 0){
		header("location: pendingProfile.php");
	}
	$order_type = 0;
	if(isset($_GET['order_type'])){
		$order_type = mres_ss($_GET['order_type']);
	}
	$journey_type = 0;
	if(isset($_GET['journey_type'])){
		$journey_type = mres_ss($_GET['journey_type']);
	}
	$input_order_source_pincode_search = null;
	if(isset($_GET['input_journey_source_pincode_search'])){
		$input_order_source_pincode_search = mres_ss($_GET['input_journey_source_pincode_search']);
	}
	if(isset($_POST['input_order_source_pincode_search'])){
		$input_order_source_pincode_search = mres_ss($_POST['input_order_source_pincode_search']);
	}
        $input_order_destination_pincode_search = null;
        if(isset($_GET['input_journey_destination_pincode_search'])){
		$input_order_destination_pincode_search = mres_ss($_GET['input_journey_destination_pincode_search']);
	}
	if(isset($_POST['input_order_destination_pincode_search'])){
		$input_order_destination_pincode_search = mres_ss($_POST['input_order_destination_pincode_search']);
	}
        $input_journey_source_pincode_search = null;
        if(isset($_GET['input_order_source_pincode_search'])){
		$input_journey_source_pincode_search = mres_ss($_GET['input_order_source_pincode_search']);
	}
	if(isset($_POST['input_journey_source_pincode_search'])){
		$input_journey_source_pincode_search = mres_ss($_POST['input_journey_source_pincode_search']);
	}
        $input_journey_destination_pincode_search = null;
        if(isset($_GET['input_order_destination_pincode_search'])){
		$input_journey_destination_pincode_search = mres_ss($_GET['input_order_destination_pincode_search']);
	}
	if(isset($_POST['input_journey_destination_pincode_search'])){
		$input_journey_destination_pincode_search = mres_ss($_POST['input_journey_destination_pincode_search']);
	}
        $as_a = "sender";
	if(isset($_GET['as_a'])){
		$as_a = mres_ss($_GET['as_a']);
	}
	echo '<div class="container">';
        echo '      <h1 class="page-header">Dashboard</h1>';
        echo ' 	    <ul class="nav nav-tabs" style="background-color:white">';
        if(strstr($as_a, "sender")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=sender">Parcels List from weSenders</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=sender">Parcels List</a></li>';
	}
	if(strstr($as_a, "carrier")){
			echo '    <li class="active"><a href="'.$_SERVER['PHP_SELF'].'?as_a=carrier">Journeys List from weCarriers</a></li>';
	}else{
			echo '    <li><a href="'.$_SERVER['PHP_SELF'].'?as_a=carrier">Journeys List</a></li>';
	}
  
  	echo '
		   </ul>
		   <div class="tab-content">';
		
	if(strstr($as_a, "sender")){
  		echo ' <div id="sender" class="tab-pane fade in active">';
  	}else{
		echo ' <div id="sender" class="tab-pane fade">';
	}
	echo '				<div class="panel panel-primary">';
	echo '					<div class="panel-body" style="padding: 0px;">';
 	echo '						<div style="padding: 5px; border-bottom: 1px solid #009688;">';
 	echo '							<form action="" method="post">';
	echo '								<div class="row">';
	echo '                                                           <div class="col-xs-12 col-md-4 ui-widget" style="margin-bottom:2px">';
	echo '								  <input type="text" id="pincode0" name="input_order_source_pincode_search" value="'.$input_order_source_pincode_search.'"" class="form-control" placeholder="Pincode of Pickup address" onkeyup="showPincode()">';
 	echo '								 </div>';
	echo '								 <div class="col-xs-12 col-md-4 ui-widget" style="margin-bottom:2px">';
	echo '								  <input type="text" id="pincode1" name="input_order_destination_pincode_search" value="'.$input_order_destination_pincode_search.'"" class="form-control" placeholder="Pincode of Delivery address" onkeyup="showPincode()">';
	echo '								 </div>';
	echo '								 <div class="col-xs-12 col-md-4" style="text-align:center">';
	echo '								  <button class="btn btn-primary" type="submit">Search Parcel</button>';
	echo '								 </div>';
 	echo '								</div>';
	echo '							</form>';
	echo '						</div>';
	if($input_order_source_pincode_search || $input_order_destination_pincode_search){
	$q = "select a.order_id,a.pickup_address_id,a.delivery_address_id,a.delivery_date,a.headline,a.weight,a.price,a.notes,a.posted_on,a.timestamp from (select * from orders where pickup_address_id in (select address_id from address where ".
		 	 "pincode like '".$input_order_source_pincode_search."%') and order_id in (select order_id from order_sender where user_id!='$wc_uid') and order_id not in (select order_id from requests where status_id not in (select status_id from status where status='in-progress'))) a join ".
			 "(select * from orders where delivery_address_id in (select address_id from address where ".
		 	 "pincode like '".$input_order_destination_pincode_search."%') and order_id in (select order_id from order_sender where user_id!='$wc_uid') and order_id not in (select order_id from requests where status_id not in (select status_id from status where status='in-progress'))) b on a.order_id = b.order_id";
	}else{
		$q = "select * from orders where order_id in (select order_id from order_sender where user_id!='$wc_uid') and order_id not in (select order_id from requests where status_id not in (select status_id from status where status='in-progress'))";
	}
	$res = runQuery($q);
	if($res && mysqli_num_rows($res)){
		while($row = mysqli_fetch_array($res)){
		$res1 = runQuery("select user_id,username from users where user_id in (select user_id from order_sender where order_id='".$row['order_id']."')");
		$row1 = mysqli_fetch_array($res1);
			 echo '				<div style="padding: 10px; border-bottom: 1px solid #009688;">';
			 echo '					<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px;">';
			 echo '						<div style="font-weight: bold; font-size: 16px;">'.$row['headline'].'</div>';
			 echo '						<div style="font-size: 12px;">';
                        $order_user_id=$row1['user_id'];
			if(isUserCompletelyVerified($order_user_id)){
		         echo '							<div style="display: inline-block;">By '.$row1['username'].' <label class="label-user-verified">Verified</label></div>';
			}else{
 			 echo '							<div style="display: inline-block;">By '.$row1['username'].' <label class="label-user-not-verified">Not Verified</label></div>';
			}
			echo '							<div style="display: inline-block; float: right;">'.time_elapsed_string($row['posted_on']).'</div>';
 			echo '						</div>';
 			echo '					</div>';
                        echo '                             <div class="row" style="margin-top:10px">';
			echo '					<div class="col-md-4 col-xs-12">';
                        echo '						<div style="border-bottom: 1px solid #fac106;"><label >Pickup Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['pickup_address_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			$pincode = $row1['pincode'];
			$res2 = runQuery("select * from pincodes where pincode='$pincode'");
			$row2 = mysqli_fetch_array($res2);
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row2['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row2['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
                        echo '					</div>';
                        echo '					<div class="col-md-4 col-xs-12">';
                        echo '						<div style="border-bottom: 1px solid #fac106;"><label >Delivery Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['delivery_address_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			$pincode = $row1['pincode'];
			$res2 = runQuery("select * from pincodes where pincode='$pincode'");
			$row2 = mysqli_fetch_array($res2);
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row2['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row2['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
			echo '					</div>';
 			echo '					<div class="col-md-4 col-xs-12">';
			echo '						<div style="">';
			echo '							<label style="">Deadline</label>:';
			echo '							<label style="font-weight: normal;">'.$row['delivery_date'].'</label>';
			echo '						</div>';
			echo '						<div style="">';
			echo '							<label style="">Price Quote</label>:';
			echo '							<label style="font-weight: normal;">'.$row['price'].'</label> bucks';
			echo '						</div>';
                        echo '					<div style="text-align:center">';
			
			echo '					<span style="margin-right: 5px;"><a href="myRequests.php?as_a=carrier&oid='.$row['order_id'].'"><button type="button" class="btn btn-xs btn-info">I am interested in carrying this Parcel</button></a></span>';
				//echo '					<span style="margin-right: 5px;"><button type="button" class="btn btn-xs btn-info">Wanna Carry?</button></span>';
				//echo '					<span style="margin-right: 5px;"><button type="button" class="btn btn-xs btn-info">Have a Chat</button></span>';
			echo '					</div>';
			echo '					</div>';
                        echo '                            </div>';
			echo '				</div>';
}
	}else{
		 echo '					<div style="margin: 10px 0px 10px 0px; font-weight: bold; color: silver; text-align: center;">';
 		echo '						Oops! No Orders found in this region';
		echo '					</div>';
	}
	echo '					</div>';
 	echo '				</div>';
	echo '         </div>';
	if(strstr($as_a, "carrier")){
  		echo ' <div id="carrier" class="tab-pane fade in active">';
  	}else{
		echo ' <div id="carrier" class="tab-pane fade">';
	}
	echo '				<div class="panel panel-primary">';
	
 	echo '					<div class="panel-body" style="padding: 0px;">';
	echo '						<div style="padding: 5px; border-bottom: 1px solid #009688;">';
	echo '							<form action="" method="post">';
	echo '							<div class="row">';	
	echo '									<div class="col-xs-12 col-md-4 ui-widget" style="margin-bottom:2px">';
	echo '										<input type="text" name="input_journey_source_pincode_search" value="'.$input_journey_source_pincode_search.'" id="pincode2" class="form-control" placeholder="Source Pincode" onkeyup="showPincode()">';
	echo '									</div>';					
	echo '									<div class="col-xs-12 col-md-4 ui-widget" style="margin-bottom:2px">';
	echo '									<input type="text" name="input_journey_destination_pincode_search" id="pincode3" value="'.$input_journey_destination_pincode_search.'" class="form-control" placeholder="Destination Pincode" onkeyup="showPincode()">';
	echo '									</div>';
	echo '									<div class="col-xs-12 col-md-4" style="text-align:center">';
	echo '										<button class="btn btn-primary" type="submit">Search Journey</button>';
	echo '									</div>';
	echo '								</div>';
	echo '							</form>';
	echo '						</div>';
	if($input_journey_source_pincode_search || $input_journey_destination_pincode_search){
	$q = "select a.journey_id,a.source_address_id,a.destination_address_id,a.journey_date,a.headline,a.notes,a.posted_on,a.timestamp from (select * from journeys where source_address_id in (select address_id from address where "."pincode like '".$input_journey_source_pincode_search."%') and journey_id in (select journey_id from carrier_journeys where user_id!='$wc_uid') and journey_id not in (select journey_id from requests where status_id not in (select status_id from status where status='in-progress'))) a join ".
			 "(select * from journeys where destination_address_id in (select address_id from address where ".
		 	 "pincode like '".$input_journey_destination_pincode_search."%') and journey_id in (select journey_id from carrier_journeys where user_id!='$wc_uid') and journey_id not in (select journey_id from requests where status_id not in (select status_id from status where status='in-progress'))) b on a.journey_id = b.journey_id";
	}else{
	$q = "select * from journeys where journey_id in (select journey_id from carrier_journeys where user_id!='$wc_uid') and journey_id not in (select journey_id from requests where status_id not in (select status_id from status where status='in-progress'))";
	}
	$res = runQuery($q);
	if($res && mysqli_num_rows($res)){
		while($row = mysqli_fetch_array($res)){
			$res1 = runQuery("select user_id,username from users where user_id in (select user_id from carrier_journeys where journey_id='".$row['journey_id']."')");
			$row1 = mysqli_fetch_array($res1);
			echo '				<div style="padding: 10px; border-bottom: 1px solid #009688;">';
			echo '					<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px;">';
			echo '						<div style="font-weight: bold; font-size: 16px;">'.$row['headline'].'</div>';
			echo '						<div style="font-size: 12px;">';
                        $journey_user_id=$row1['user_id'];
			if(isUserCompletelyVerified($journey_user_id)){
				echo '							<div style="display: inline-block;">By '.$row1['username'].' <label class="label-user-verified">Verified</label></div>';
			}else{
				echo '							<div style="display: inline-block;">By '.$row1['username'].' <label class="label-user-not-verified">Not Verified</label></div>';
			}
			echo '							<div style="display: inline-block; float: right;">'.time_elapsed_string($row['posted_on']).'</div>';
			echo '						</div>';
			echo '					</div>';
			echo '                             <div class="row" style="margin-top:10px">';
			echo '					<div class="col-md-4 col-xs-12">';
                        echo '						<div style="border-bottom: 1px solid #fac106;"><label >Source Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['source_address_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			$pincode = $row1['pincode'];
			$res2 = runQuery("select * from pincodes where pincode='$pincode'");
			$row2 = mysqli_fetch_array($res2);
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row2['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row2['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
                        echo '					</div>';
                        echo '					<div class="col-md-4 col-xs-12">';
                        echo '						<div style="border-bottom: 1px solid #fac106;"><label >Destination Address</label></div>';
			$res1 = runQuery("select * from address where address_id='".$row['destination_address_id']."'");
			$row1 = mysqli_fetch_array($res1);
			echo '                  			<div style="">'.$row1['address'].'</div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row1['pincode'].'</label></div>';
			$pincode = $row1['pincode'];
			$res2 = runQuery("select * from pincodes where pincode='$pincode'");
			$row2 = mysqli_fetch_array($res2);
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">City</label><label style="font-weight: normal;">'.$row2['city'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">State</label><label style="font-weight: normal;">'.$row2['state'].'</label></div>';
			echo '                  			<div style=""><label style="width: 30%; font-weight: bold;">Country</label><label style="font-weight: normal;">India</label></div>';
                        echo '					</div>';
                        echo '					<div class="col-md-4 col-xs-12">';
			echo '						<div style="">';
			echo '							<label style="">Journey Date</label>:';
			echo '							<label style="font-weight: normal;">'.$row['journey_date'].'</label>';
			echo '						</div>';
                        echo '						<div style="">';
			echo '							<label style="">Additional Notes</label>:';
			echo '							<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '						</div>';
                        echo '                                          <div align="center">';
			
				echo '					<span style="margin-right: 5px;"><a href="myRequests.php?as_a=sender&jid='.$row['journey_id'].'"><button type="button" class="btn btn-xs btn-info">Request for a Parcel Delivery</button></a></span>';
				//echo '					<span style="margin-right: 5px;"><button type="button" class="btn btn-xs btn-info">Request a Delivery</button></span>';
				//echo '					<span style="margin-right: 5px;"><button type="button" class="btn btn-xs btn-info">Have a Chat</button></span>';
			echo '					        </div>';
			echo '					</div>';				
			echo '				</div>';
			echo '			</div>';
}	
}else{
		echo '					<div style="margin: 10px 0px 10px 0px; font-weight: bold; color: silver; text-align: center;">';
		echo '						Oops! No Orders found in this region';
		echo '					</div>';
	}
	echo '					</div>';
	echo '				</div>';
	echo '         </div>';
	echo '	</div>';


echo ' </div>';
}else{
header("location: index.php");
}
echo ' </div>';
showFooter();
loadLaterJSFiles();
echo '  </body>';
echo '</html>';

?>
