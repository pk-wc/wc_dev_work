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

echo '  <div class="jumbotron"  style="margin-bottom:0px;border-bottom:1px solid #009688">';
echo '  	<div class="container">';
echo '          	<h1>Some Video / Our Moto</h1>';
echo '          	<p>SHARE <> CARRY <> EARN</p>';
echo '        	</div>';
echo '	</div>';

echo '<section id="how_it_works">
	<h2>HOW IT WORKS?</h2>
	<div class="container">';
	$as_a = "wesender";
	if(isset($_GET['as_a'])){
		$as_a = mres_ss($_GET['as_a']);
	}
	if(strstr($as_a, "wesender")){
	echo '<h3 id="become_wesender_text">Do you have Parcel to send? Find a trustworthy WEcarrier and save money.</h3>';
	}else{
	echo '<h3 id="become_wecarrier_text">Are you going somewhere? Carry a suitable Parcel and earn money.</h3>';
	}
	echo '<div role="tabpanel" class="work-tab">
	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist" style="width:100%;">';
	  	if(strstr($as_a, "wesender")){
		echo '    <li class="active" style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?"><span style="margin-right:5px;"><i class="fa fa-suitcase"></i></span>Become WEsender</a></li>';
		}else{
		echo '    <li style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wesender"><span style="margin-right:5px;"><i class="fa fa-suitcase"></i></span>Become WEsender</a></li>';
		}
		if(strstr($as_a, "wecarrier")){
		echo '    <li class="active" style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wecarrier"><span style="margin-right:5px;"><i class="fa fa-motorcycle"></i></span>Become WEcarrier</a></li>';
		}else{
		echo '    <li style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wecarrier"> <span style="margin-right:5px;"><i class="fa fa-motorcycle"></i></span>Become WEcarrier</a></li>';
		}
	echo '
	  	</ul>
	  	<div class="tab-content">';
		if(strstr($as_a, "wesender")){
	  	echo ' <div role="tabpanel" class="tab-pane fad in active" id="wesender">';
	  	}else{
		echo ' <div role="tabpanel" class="tab-pane fad" id="wesender">';
		}
	
	
	echo '			<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse" style="font-size:64px"></i>
						</span>
						<h4 style="color:#009688;text-align:right">Enter Parcel detail</h4>
						<ul class="detail_right">
							 <li>Pickup and Delivery address</li>
							 <li>Expected Delivery date</li>
							 <li>Weight and Dimensions of the parcel</li>
							 <li>Quote your Price</li>
						 </ul>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-left">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-search fa-stack-1x fa-inverse" style="font-size:60px"></i>
						</span>
						<h4 style="color:#009688;text-align:left">Find WEcarrier</h4>
						<p>Based on your Parcel detail entered, find a suitable WEcarrier. Take a look at reviews, comments and information about the WEcarrier.</p>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
						</span>
						<h4 style="color:#009688;text-align:right">Contact WEcarrier</h4>
						<p>Get in touch with your selected WEcarrier and finalize the delivery date, time, place, and parcel delivery charges. Also confirm the delivery time and place to the end Receiver.</p>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-left">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <span class="work-span">
							  <i class="fa fa-suitcase fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-plus fa-inverse work-icon" style="font-size:16px;"></i><i class="fa fa-inr fa-inverse work-icon" style="font-size:32px;"></i>  
						  </span>
						</span>
						<h4 style="color:#009688;text-align:left">Handover Parcel and Pay Money</h4>
						<p>Be at your planned time and place to hand over the parcel and pay the money to the WEcarrier. Ensure that you bring exact change to pay, as agreed earlier. Avoid meeting at suspicious locations.</p>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <span class="work-span">
							  <i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i>  
						  </span>
						</span>
						<h4 style="color:#009688;text-align:right">Review WEcarrier</h4>
						<p>Don’t forget to review the WEcarrier after the scheduled delivery is complete. Your review will help other users and you too in future to pick the best.</p>
					</div>
					
				</div>	
		</div>';
	       if(strstr($as_a, "wecarrier")){
	       echo ' <div role="tabpanel" class="tab-pane fad in active" id="wecarrier">';
	       }else{
	       echo ' <div role="tabpanel" class="tab-pane fad" id="wecarrier">';
	       }
	       echo '			<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse" style="font-size:64px"></i>
						</span>
						<h4 style="color:#009688;text-align:right">Enter Journey detail</h4>
						<ul class="detail_right">
							 <li>Source and Destination address</li>
							 <li>Journey date</li>
							 <li>Preferable Weight of the parcel you can carry</li>
							 <li>Quote your Price</li>
						 </ul>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-left">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-search fa-stack-1x fa-inverse" style="font-size:60px"></i>
						</span>
						<h4 style="color:#009688;text-align:left">Find Parcel</h4>
						<p>Based on your journey detail entered, find the suitable and convenient parcel. Take a look at reviews, comments and information about that WEsender</p>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
						</span>
						<h4 style="color:#009688;text-align:right">Contact WEsender</h4>
						<p>Get in touch with your selected WEsender when they contact you and finalize about the pickup date, time, place and parcel delivery charges. Also confirm the delivery time and place to the end Receiver.</p>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-left">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <span class="work-span">
							  <i class="fa fa-suitcase fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-plus fa-inverse work-icon" style="font-size:16px;"></i><i class="fa fa-inr fa-inverse work-icon" style="font-size:32px;"></i>
							  
						  </span>
						</span>
						<h4 style="color:#009688;text-align:left">Collect Parcel and Money</h4>
						<p>Reach the source point at your planned time. Your WEsender will pay the agreed amount for the safe and assured delivery of the parcel. It might be useful to have a bit of change with you. Avoid meeting at suspicious locations.</p>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-right">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <i class="fa fa-truck fa-flip-horizontal fa-stack-1x fa-inverse"></i>
						</span>
						<h4 style="color:#009688;text-align:right">Deliver Parcel</h4>
						<p>Deliver the parcel to the end receiver at the destination place on pre-defined time. Avoid meeting at suspicious locations.</p>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<span class="fa-stack fa-5x fa-pull-left">
						  <i class="fa fa-circle fa-stack-2x" style="color:#009688"></i>
						  <span class="work-span">
							  <i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i><i class="fa fa-star-o fa-inverse work-icon" style="font-size:32px;"></i>  
						  </span>
						</span>
						<h4 style="color:#009688;text-align:left">Review WEsender</h4>
						<p>Don’t forget to review the WEsender after the scheduled delivery is complete. Your review will help other users and you too in future to pick the best.</p>
					</div>
					
				</div>	
		</div>';
	echo '</div>
	</div>
</section>
';
echo '</div>';
showFooter();
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
