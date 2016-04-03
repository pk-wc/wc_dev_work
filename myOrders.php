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
getPageTitle("My Orders");
loadCSSFiles();
loadJSFiles();
echo '    <script>
		    function addAddressToField(addr_id, addr_label, field){
		      if(field.localeCompare("pickup") == 0){
			    document.getElementById("pickup_address_id").value = addr_id;
			    document.getElementById("pickupAddressLink").innerHTML = addr_label;
			  }else{
			  	document.getElementById("delivery_address_id").value = addr_id;
			  	document.getElementById("deliveryAddressLink").innerHTML = addr_label;
			  }
			}

			function deleteOrder(oid){
				if(confirm("Are you sure you want to delete this order?")){
					window.location.href = "deleteOrders.php?oid=" + oid;
				}
			}
			function validateForm()
		        {
				var x = document.getElementById("pickupAddressLink").innerHTML;
				var y = document.getElementById("deliveryAddressLink").innerHTML;
				x=x.trim();
				y=y.trim();
				if(x=="Select Address from list")
				{
					alert("Please select Pickup Address!");
   					return false;
				}
				if(y=="Select Address from list")
				{
					alert("Please select Delivery Address!");
   					return false;
				}
				if(x==y)
				{
				 	alert("Pickup Address and Delivery Address must be different!")
					return false;
				}

			}
		  </script>';
echo '  </head>';
echo '  <body>';

showHeader("my_orders");
loadLoginModal();
echo ' <div id="content">';
echo '    <div class="container">';
echo '    </div>';

if($wc_uid){
	if(verifyUserProfile($wc_uid) == 0){
		header("location: pendingProfile.php");
	}
	loadAddressModal("myModalPickupAddress", "pickup");
	loadAddressModal("myModalDeliveryAddress", "delivery");
	$order_type = 0;
	if(isset($_GET['order_type'])){
		$order_type = mres_ss($_GET['order_type']);
	}
	$eid = null;
	$from = null;
	if(isset($_GET['from'])){
		$from = mres_ss($_GET['from']);
	}
	if(isset($_GET['eid'])){
		$eid = mres_ss($_GET['eid']);
	}
	$valid_order = false;
	echo ' <div class="container">';/*ravi*/
	echo ' <h1 class="page-header">My Parcels</h1>';
	echo ' <div class="row" style="">';
	checkPageMessages();
	
	if($eid){
		$valid_order = false;
		$res = runQuery("select * from orders where order_id='$eid' and order_id in (select order_id from order_sender where user_id='$wc_uid')");
		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_array($res);
			$valid_order = true;
		}else{
			$message = buildMessage("Invalid Order!", "Please select a valid Order");
			setPageErrorMessage($message);
			checkPageMessages();
		}
	}
	echo '	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top:0px">';
	echo '		<div class="panel panel-primary">';
	if($valid_order){
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center;">';
		echo '			<h3 class="panel-title">Edit Parcel</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse in" id="pContent">';
	}else{
		if($from)
		{
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center;">';
		echo '			<h3 class="panel-title">Add New Parcel</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse in" id="pContent">';
		}else{
		echo '		<div class="panel-heading clickable" data-toggle="collapse" data-target="#pContent" id="pTiltle" style="cursor: pointer;text-align:center">';
		
		echo '			<h3 class="panel-title">Add New Parcel</h3>';
		echo '                  	<span class="pull-right "><i class="glyphicon glyphicon-plus"></i></span>
				</div>';
		echo '		<div class="panel-body panel-collapse collapse" id="pContent">';
		}
	}
	if($valid_order){
		echo '			<form class="form-signin" onsubmit="return updateParcels()">';
	}else{
	
		echo '			<form class="form-signin" onsubmit="return userParcels()">';
	}
	echo '					<div class="row" style="border-bottom: 1px solid #009688; padding-bottom: 4px;">
							<input type="hidden" id="order_id" name="order_id" value="'.$eid.'">';
	echo '						<div class="col-xs-12">';
	echo '							<div style="border-bottom: 1px solid #fac106; font-weight: bold; padding-bottom: 5px;">Pickup Address</div>';
	echo '							<div style="">';
	echo '								<button id="pickupAddressLink" style="padding: 0px; margin-top: 4px;" type="button" class="btn btn-link" data-target="#myModalPickupAddress" data-toggle="modal">';
	if($valid_order){
		$res1 = runQuery("select address_label from address where address_id='".$row['pickup_address_id']."'");
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
	if($valid_order){
		echo '							<input type="hidden" id="pickup_address_id" name="input_pickup_address_id" value="'.$row['pickup_address_id'].'"/>';
	}else{
		echo '							<input type="hidden" id="pickup_address_id" name="input_pickup_address_id"/>';
	}
	echo '							</div>';
	echo '						</div>
							<div class="col-xs-12"><span id="pickup_address_status" class="error-status"></span></div>';
	echo '						<div class="col-xs-12">';
	echo '							<div style="border-bottom: 1px solid #fac106; font-weight: bold; padding-bottom: 5px; ">Delivery Address</div>';
	echo '							<div style="">';
	echo '								<button id="deliveryAddressLink" style="padding: 0px; margin-top: 4px;" type="button" class="btn btn-link" data-target="#myModalDeliveryAddress" data-toggle="modal">';
	
	if($valid_order){
		$res1 = runQuery("select address_label from address where address_id='".$row['delivery_address_id']."'");
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
	if($valid_order){
		echo '							<input type="hidden" id="delivery_address_id" name="input_delivery_address_id" value="'.$row['delivery_address_id'].'" />';
	}else{
		echo '							<input type="hidden" id="delivery_address_id" name="input_delivery_address_id" />';
	}
	echo '							</div>';
	echo '						</div>
							<div class="col-xs-12"><span id="delivery_address_status" class="error-status"></span></div>';
	echo '					</div>';
	echo '					<div class="row" style="margin-bottom: 10px;">';
	echo '						<div class="col-xs-12">';
	echo '							<div style="padding-top:10px;">';
	echo '								<div style="width: 49%; display: inline-block; ">';
	echo '									<div style="font-weight: bold; padding-bottom: 2px;">Delivery Date</div>';
	echo '									<div style="">';
	echo '										<label for="inputDate" class="sr-only">Delivery Date</label>';
	if($valid_order){
		echo '									<input type="text" id="datepicker" name="input_delivery_date" value="'.$row['delivery_date'].'" class="form-control" placeholder="Enter Delivery Date">';
		
	}else{
		echo '									<input type="text" id="datepicker" name="input_delivery_date" class="form-control" placeholder="Enter Delivery Date">';
	}
	echo '									<span id="date_status" class="error-status"></span></div>';
	echo '								</div>';
	echo '								<div style="width: 49%; display: inline-block; float: right;">';
	echo '									<div style="font-weight: bold; padding-bottom: 2px;">Weight (in Kgs)</div>';
	echo '									<div style="">';
	echo '										<label for="inputText" class="sr-only">Weight</label>';
	if($valid_order){
		echo '									<input type="text" id="input_weight" name="input_weight" value="'.$row['weight'].'" class="form-control" placeholder="Enter Weight">';
	}else{
		echo '									<input type="text" id="input_weight" name="input_weight" class="form-control" placeholder="Enter Weight">';
	}
	echo '									<span id="weight_status" class="error-status"></span></div>';
	echo '								</div>';
	echo '							</div>
							</div>';
	echo '						<div class="col-xs-12">';
	echo '							<div style="padding-top:10px;">';
	echo '								<div style="width: 49%; display: inline-block; ">';
	echo '									<div style="font-weight: bold; padding-bottom: 2px;">Price Quote</div>';
	echo '									<div style="">';
	echo '										<label for="inputText" class="sr-only">Price Quote</label>';
	if($valid_order){
		echo '								<input type="text" id="input_price" name="input_price" value="'.$row['price'].'" class="form-control" placeholder="Enter Price">';
	}else{
		echo '									<input type="text" id="input_price" name="input_price" class="form-control" placeholder="Enter Price">';
	}
	echo '									<span id="price_status" class="error-status"></span></div>';
	echo '								</div>';
	echo '								<div style="width: 49%; display: inline-block; float: right; ">';
	echo '									<div style="font-weight: bold; padding-bottom: 2px;">Headline</div>';
	echo '									<div style="">';
	echo '										<label for="inputText" class="sr-only">Headline</label>';
	if($valid_order){
		echo '									<input type="text" id="input_headline" name="input_headline" value="'.$row['headline'].'" class="form-control" maxlength=100 placeholder="Enter Headline">';
	}else{
		echo '									<input type="text" id="input_headline" name="input_headline" class="form-control" maxlength=100 placeholder="Enter Headline">';
	}
	echo '									<span id="headline_status" class="error-status"></span></div>';
	echo '								</div>';
	echo '							</div>';
	echo '						</div>';
	echo '						<div class="col-xs-12">';
	echo '							<div style="font-weight: bold; padding-top: 10px;">Additional Notes (Max. 300 Characters)</div>';
	echo '							<div class="form-group">';
	if($valid_order){
		echo '							<textarea name="input_notes" class="form-control" rows="3" placeholder="Enter Addtional Notes">'.$row['notes'].'</textarea>';
	}else{
		echo '							<textarea name="input_notes" class="form-control" rows="3" placeholder="Enter Addtional Notes"></textarea>';
	}
	echo '							<span id="notes_status" class="error-status"></span></div>';
	echo '						</div>';
	echo '					</div>
						<div><span id="submit_status" class="error-status"></span></div>';
	echo '					<div  class="row" style="border-top: 1px solid #009688; padding-top: 10px;" align="center">';
	if($valid_order){
		echo '    				<label style="width: 50%;">';
	}else{
		echo '    				<label style="width: 50%;">';
	}
	echo '						<button class="btn btn-lg btn-primary btn-block" style="" type="submit">';
	if($valid_order){
		echo '						Update Parcel';
	}else{
		echo '						Add Parcel';
	}
	echo '						</button>';
	echo '    					</label>';
	if($valid_order){
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
	echo '			<div style="border-bottom: 1px solid #fac106; padding-bottom: 2px; font-size: 24px; margin-bottom: 10px;">Parcel List</div>';
	echo '			<div style="border: 1px solid #009688">';
	$res = runQuery("select * from orders where order_id in (select order_id from order_sender where user_id='$wc_uid') order by delivery_date");
	if($res && mysqli_num_rows($res)){
		while($row = mysqli_fetch_array($res)){
			echo '	<div style="padding: 10px; border-bottom: 1px solid #009688;">';
			echo '		<div style="border-bottom: 1px solid #fac106;">';
			echo '				<label style=""><h4 class="list-group-item-heading">'.$row['headline'].'</h4></label>';
			echo '				<label style="font-size: 12px; font-weight: normal; float: right;">Last Update: '.time_elapsed_string($row['timestamp']).'</label>';
			echo '		</div>';
			echo '		<div class="row" style="padding-top:10px">';
			echo '			<div class="col-xs-12 col-md-4">';
			echo '					<div style="">';
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
			$source_pincode = $row1['pincode'];
			echo '					</div>';
			echo '			</div>';
			echo '			<div class="col-xs-12 col-md-4">';
			echo '					<div style="">';
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
			$destination_pincode = $row1['pincode'];
			echo '					</div>';
			echo '			</div>';
			echo '			<div class="col-xs-12 col-md-4">';
			echo '					<div style="">';
			echo '						<div style="display: inline-block;">';
			echo '							<label style="">Delivery Date</label>:';
			echo '							<label style="font-weight: normal;">'.$row['delivery_date'].'</label>';
			echo '						</div>';
			echo '						<div style="display: inline-block; width: 5%;"></div>';
			echo '						<div style="display: inline-block;">';
			echo '							<label style="">Price Quote</label>:';
			echo '							<label style="font-weight: normal;">'.$row['price'].'</label> bucks';
			echo '						</div>';
			echo '						<div style="display: inline-block; width: 5%;"></div>';
			echo '						<div style="display: inline-block;">';
			echo '							<label style="">Weight</label>:';
			echo '							<label style="font-weight: normal;">'.$row['weight'].'</label> Kgs';
			echo '						</div>';
			echo '					</div>';
			echo '					<div style="">';
			echo '						<div style="">';
			echo '							<label style="">Additional Notes</label>:';
			echo '							<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '						</div>';
			echo '					</div>';
			echo '					<div class="row"><div class="col-xs-6"><a href="'.$_SERVER['PHP_SELF'].'?eid='.$row['order_id'].'"<button type="button" class="btn btn-primary" style="width: 100%;">Edit</button></a></div>';
			echo '				<div class="col-xs-6"><button type="button" class="btn btn-primary" style="width: 100%;" onclick="deleteOrder(\''.$row['order_id'].'\');">Delete</button></div></div>';
			echo '						<div style="margin-top:5px">
										<a href="myDashboard.php?as_a=carrier&input_order_source_pincode_search='.$source_pincode.'&input_order_destination_pincode_search='.$destination_pincode.'"<button type="button" style="width: 100%;" class="btn btn-primary">Find a weCarrier</button></a>
									</div>';
									
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
		}
	}else{
		echo '          <div style="text-align: center; padding: 10px; font-weight: bold; color: silver;">No Parcel found in this region</div>';
	}
	echo '			</div>';
	echo '		</div>';
	echo '	</div>';
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
