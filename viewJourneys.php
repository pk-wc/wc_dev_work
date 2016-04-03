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
getPageTitle("View Journeys");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("");
loadLoginModal();
loadRegisterModal();

echo '    <div class="container" style="margin-top: 50px;">';
echo '    </div>';

if($wc_uid){
	if(verifyUserProfile($wc_uid) == 0){
		header("location: pendingProfile.php");
	}
	$journey_id = null;
	if(isset($_GET['jid'])){
		$journey_id = mres_ss($_GET['jid']);
	}
	showSidebarTop("view_journeys");
	echo '<h1 class="page-header">My Journeys</h1>';
	echo '<div style="">';
	checkPageMessages();
	if($journey_id){
		$res = runQuery("select * from journeys where journey_id='$journey_id'");
		if($res && mysqli_num_rows($res)){
			$row = mysqli_fetch_array($res);
			echo '	<div style="">';
			echo '		<div class="panel panel-primary">';
			echo '			<div class="panel-heading">';
			echo '				<h3 class="panel-title">View Journey</h3>';
			echo '			</div>';
			echo '			<div class="panel-body">';
			echo '				<div style="border-bottom: 1px solid #eee;">';
			echo '				<div style="">';
			echo '					<label style="width: 20%;">Journey Type</label>';
			echo '					<label style="font-weight: normal;">'.getInterTypeStr($row['journey_type']).'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 20%;">Headline</label>';
			echo '					<label style="font-weight: normal;">'.$row['headline'].'</label>';
			echo '				</div>';
			$res1 = runQuery("select * from address where address_id='".$row['source_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '			<div style="">';
				echo '				<label style="width: 20%;">Source Address</label>';
				echo '				<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				echo '				<label style="font-weight: normal;">'.$row1['city'].'</label>, ';
				echo '				<label style="font-weight: normal;">'.$row1['state'].'</label>';
				echo '			</div>';
				echo '			<div style="">';
				echo '				<label style="width: 20%;"></label>';
				echo '				<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '			</div>';
			}
			$res1 = runQuery("select * from address where address_id='".$row['destination_address_id']."'");
			if($res1 && mysqli_num_rows($res1)){
				$row1 = mysqli_fetch_array($res1);
				echo '			<div style="">';
				echo '				<label style="width: 20%;">Destination Address</label>';
				echo '				<label style="font-weight: normal;">'.$row1['address'].'</label>, ';
				echo '				<label style="font-weight: normal;">'.$row1['city'].'</label>, ';
				echo '				<label style="font-weight: normal;">'.$row1['state'].'</label>';
				echo '			</div>';
				echo '			<div style="">';
				echo '				<label style="width: 20%;"></label>';
				echo '				<label style="font-weight: normal;">'.$row1['pincode'].'</label>';
				echo '			</div>';
			}
			echo '				<div style="">';
			echo '					<label style="width: 20%;">Journey Date</label>';
			echo '					<label style="font-weight: normal;">'.$row['journey_date'].'</label>';
			echo '				</div>';
			echo '				<div style="">';
			echo '					<label style="width: 20%;">Additional Notes</label>';
			echo '					<label style="font-weight: normal;">'.$row['notes'].'</label>';
			echo '				</div>';
			echo '				</div>';
			echo '				<div style="margin-top: 10px; text-align: center;">';
			$res = runQuery("select * from carrier_journeys where journey_id='".$row['journey_id']."' and user_id='".$wc_uid."'");
			if($res && mysqli_num_rows($res)){
				echo '				<label style="width: 15%;">';
				echo '					<a href="myJourneys.php?eid='.$row['journey_id'].'">';
				echo '						<button type="button" style="width: 100%;" class="btn btn-primary">Edit Journey</button>';
				echo '					</a>';
				echo '				</label>';
			}
			$res = runQuery("select * from carrier_journeys where journey_id='".$row['journey_id']."' and user_id='".$wc_uid."'");
			if(!($res && mysqli_num_rows($res))){
				echo '				<label style="width: 15%;">';
				echo '					<a href="myRequests.php?eid='.$row['journey_id'].'" style="width: 20%;">';
				echo '						<button type="button" style="width: 100%;" class="btn btn-primary">Request Delivery?</button>';
				echo '					</a>';
				echo '				</label>';
			}
			echo '				</div>';
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
		}
	}

	showSidebarBottom();
}else{
	showFooter();
}

loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>