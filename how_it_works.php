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
getPageTitle("How It Works");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("how_it_works");
loadLoginModal();
echo ' <div id="content">';
echo '<div class="container">';
checkPageMessages();
echo '    </div>';

echo '  <div class="">';
echo '			<div class="row">';
echo '        <div class="jumbotron" style="margin-bottom:0px">';
echo '  				<div class="container">';
echo '          <h1>Some Video / Our Moto</h1>';
echo '          <p>SHARE <> CARRY <> EARN</p>';
echo '					</div>';
echo '        </div>';
echo '			</div>';
//here each media is of size 64 by 64px

echo '
			<section id="how_it_works">
				 <h2 style="margin-bottom: 40px;">HOW IT WORKS?</h2>
				 	<div class="container">
						 <ul class="nav nav-tabs" role="tablist" style="text-align: center;">
						 	<li role="presentation" style="width: 50%;" class="active"><a aria-controls="wesender" role="tab" data-toggle="tab" href="#wesender">Do You Want to send the Parcel? (Become WeSender)</a></li>
							<li role="presentation" style="width: 50%;"><a aria-controls="wecarrier" role="tab" data-toggle="tab" href="#wecarrier">Do You Want to carry the Parcel? (Become WeCarrier)</a></li>
						 </ul>
						 <div class="tab-content">
						 	<div role="tabpanel" class="col-lg-6 col-sm-6 col-md-6 col-xs-12 tab-pane fade in active" id="wesender">
								 <p>Find a trustworthy WeCarrier and save money.</p>
								 <ul class="media-list">
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/details.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Enter Parcel details:</h4>
											 <ul>
												 <li>Source and Destination place</li>
												 <li>Required Delivery date</li>
												 <li>Weight and Dimensions of the parcel</li>
												 <li>Price you want to quote</li>
											 </ul>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/search.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Find the WeCarrier:</h4>
											 <p>Based on details entered, find a suitable WeCarrier. Take a look at reviews, comments and information about the WeCarrier.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/contact.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Get In Contact:</h4>
											 <p>Get in touch with your selected WeCarrier and finalize the delivery date, time, place, and parcel delivery charges. Also confirm the delivery time and place to the end Receiver.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/collect_parcel.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Handover Parcel and Pay Money:</h4>
											 <p>Be at your planned time and place to hand over the parcel and pay the money to the WeCarrier. Ensure that you bring exact change to pay, as agreed earlier. Avoid meeting at suspicious locations.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/review.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Review the WeCarrier:</h4>
											 <p>Don’t forget to review the WeCarrier after the scheduled delivery is complete. Your review will help other users and you too in future to pick the best.</p>
										 </div>
									 </li>
								 </ul>
						 	 </div>
						 	<div role="tabpanel" class="tab-pane fade col-lg-6 col-sm-6 col-md-6 col-xs-12 pull-right" id="wecarrier">
								 <p>Find a suitable Parcel and save money on your travel.</p>
								 <ul class="media-list">
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/details.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Enter Journey details:</h4>
											 <ul>
												 <li>Source and Destination place</li>
												 <li>Journey date</li>
												 <li>Preferable Weight of the parcel you can carry</li>
												 <li>Price you want to quote</li>
											 </ul>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/select_parcel.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Select the Parcel:</h4>
											 <p>Based on requests received, find the suitable and convenient parcel. Take a look at reviews, comments and information about that WeSender.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/contact.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Get In Contact:</h4>
											 <p>Get in touch with your selected WeSender when they contact you and finalize about the pickup date, time, place and parcel delivery charges. Also confirm the delivery time and place to the end Receiver.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/collect_parcel.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Collect Parcel and Money:</h4>
											 <p>Reach the source point at your planned time. Your WeSender will pay the agreed amount for the safe and assured delivery of the parcel. It might be useful to have a bit of change with you. Avoid meeting at suspicious locations.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/deliver_parcel.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Deliver the Parcel to Receiver:</h4>
											 <p>Deliver the parcel to the end receiver at the destination place on pre-defined time. Avoid meeting at suspicious locations.</p>
										 </div>
									 </li>
									 <li class="media">
										 <a class="pull-left" href="#">
											 <img class="media-object" src="custom/images/review.png" alt="Enter The Details!">
										 </a>
										 <div class="media-body">
											 <h4 class="media-heading">Review the WeSender:</h4>
											 <p>Don’t forget to review the WeSender after the scheduled delivery is complete. Your review will help other users and you too in future to pick the best.</p>
										 </div>
									 </li>
								 </ul>
						 	 </div>
							</div>

	       	</div>
				
			</section>
';

echo '	</div>';
echo '</div>';
showFooter();
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
