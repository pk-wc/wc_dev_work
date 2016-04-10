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
echo '<script>
function sendWecarrierToDashboard(){
	var pickup = $("input[name=pickup]").val();
	var delivery = $("input[name=delivery]").val();
	location.href = "myDashboard.php?as_a=sender&input_journey_source_pincode_search=" + pickup + "&input_journey_destination_pincode_search=" + delivery;
	return false;
}
function sendWesenderToDashboard(){
	var source = $("input[name=source]").val();
	var destination = $("input[name=destination]").val();
	location.href = "myDashboard.php?as_a=carrier&input_order_source_pincode_search=" + source + "&input_order_destination_pincode_search=" + destination;
	return false;
}
</script>';
echo '  </head>';
echo '  <body>';

showHeader("home");
loadLoginModal();
echo ' <div id="content">';
	echo '<section class="index_first_element">';
	echo '<div class="container">';
	checkPageMessages();
	$as_a = "wecarrier";
	if(isset($_GET['as_a'])){
		$as_a = mres_ss($_GET['as_a']);
	}
	if(strstr($as_a, "wecarrier")){
	echo '<h3 id="search_wesender_text">Search parcels(from WEsender) for your journey.</h3>';
	}else{
	echo '<h3 id="search_wecarrier_text">Search WEcarriers for your parcel.</h3>';
	}
	echo '<div role="tabpanel" class="search-tab login-tab">
	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist" style="width:100%;">';
	  	if(strstr($as_a, "wecarrier")){
		echo '    <li class="active" style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wecarrier"><span style="margin-right:5px;"><i class="fa fa-suitcase"></i></span>Parcels</a></li>';
		}else{
		echo '    <li style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wecarrier"><span style="margin-right:5px;"><i class="fa fa-suitcase"></i></span>Parcels</a></li>';
		}
		if(strstr($as_a, "wesender")){
		echo '    <li class="active" style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wesender"><span style="margin-right:5px;"><i class="fa fa-motorcycle"></i></span>Journeys</a></li>';
		}else{
		echo '    <li style="width:50%;"><a href="'.$_SERVER['PHP_SELF'].'?as_a=wesender"> <span style="margin-right:5px;"><i class="fa fa-motorcycle"></i></span>Journeys</a></li>';
		}
	echo '
	  	</ul>
	  	<div class="tab-content">';
	if(strstr($as_a, "wecarrier")){
  		echo ' <div role="tabpanel" class="tab-pane fad in active" id="wecarrier">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fad" id="wecarrier">';
	}
	echo '
		    		&nbsp;&nbsp;	
		    		<form onsubmit="return sendWecarrierToDashboard()">			 
				      <div class="row">
				      	<div class="col-xs-12">
				      		<div class="text-center floating-label-form-group">
						<input style="color:#fff;" class="form-control" type="tel" id="pincode4" name="pickup" placeholder="Pickup address pincode" onkeyup="showPincode()" autocomplete="off">
						</div>
				      	</div>
				      	<div class="col-xs-12">
				      		<div class="text-center floating-label-form-group">
						<input style="color:#fff" class="form-control" type="tel" id="pincode5" name="delivery" placeholder="Delivery address pincode" onkeyup="showPincode()" autocomplete="off">
						</div>
				      	</div>
				      	<div class="col-xs-12" style="padding-top:20px">
				      		<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Find</button>
				      	</div>
				      </div>
				 </form>
			</div>';
	if(strstr($as_a, "wesender")){
  		echo ' <div role="tabpanel" class="tab-pane fad in active" id="wesender">';
  	}else{
		echo ' <div role="tabpanel" class="tab-pane fad" id="wesender">';
	}
	echo '
		    		&nbsp;&nbsp;	
		    		<form onsubmit="return sendWesenderToDashboard()">			
				      <div class="row">
				      	<div class="col-xs-12">
				      		<div class="text-center floating-label-form-group">
						<input style="color:#fff;" class="form-control" type="tel" id="pincode6" name="source" placeholder="Source address pincode" onkeyup="showPincode()" autocomplete="off">
						</div>
				      	</div>
				      	<div class="col-xs-12">
				      		<div class="text-center floating-label-form-group">
						<input style="color:#fff" class="form-control" type="tel" id="pincode7" name="destination" placeholder="Destination address pincode" onkeyup="showPincode()" autocomplete="off">
						</div>
				      	</div>
				      	<div class="col-xs-12" style="padding-top:20px">
				      		<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Find</button>
				      	</div>
				      </div>
				 </form>
			</div>
		</div>
	      </div>
				      ';
	echo '</div>';
	echo '</section>';
	echo '	<section id="how_it_works">
			<h2 style="margin-bottom: 40px;">HOW IT WORKS?</h2>
			<div class="container">
				<div class="row text-center">
				<h3 style="color:#009688;">Do you have parcel to send?(Become WEsender)</h3>
				</div>
				<div class="row">
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					<div id="round_div"><span><i class="fa fa-pencil-square-o fa-4x"></i></span></div>
					
					<h4>Enter Parcel Detail</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-20px;margin-right:-40px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					<div id="round_div"><span><i class="fa fa-search fa-4x"></i></span></div>
					<h4>Find WEcarrier</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-20px;margin-right:-40px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					<div id="round_div"><span><i class="fa fa-mobile fa-5x"></i></span></div>
					<h4>Contact WEcarrier</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-20px;margin-right:-40px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-suitcase fa-2x"></i> <i class="fa fa-plus fa-1x"> </i><i class="fa fa-inr fa-2x"></i></span></div>
					<h4>Handover Parcel and Pay Money</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-20px;margin-right:-40px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-star-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i></span></div>
					<h4>Review WEcarrier</h4>
					</div>
				</div>
				<div class="row text-center">
				<h3 style="color:#009688;">Travelling somewhere?(Become WEcarrier)</h3>
				</div>
				<div class="row">
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-pencil-square-o fa-4x"></i></span></div>
					<h4>Enter Journey Detail</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-40px;margin-right:-60px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-search fa-4x"></i></span></div>
					<h4>Find Parcel</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-40px;margin-right:-60px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-mobile fa-5x"></i></span></div>
					<h4>Contact WEsender</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-40px;margin-right:-60px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-suitcase fa-2x"></i> <i class="fa fa-plus fa-1x"> </i><i class="fa fa-inr fa-2x"></i></span></div>
					<h4>Collect Parcel and Money</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-40px;margin-right:-60px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px">
					
					<div id="round_div"><span><i class="fa fa-truck fa-flip-horizontal fa-4x"></i></span></div>
					<h4>Deliver Parcel</h4>
					</div>
					<div class="col-md-1 hide-fa-vertical" style="color:#009688;padding-top:50px;margin-left:-40px;margin-right:-60px"><span><i class="fa fa-chevron-right fa-4x"></i></span></div>
					<div class="col-md-2 col-xs-12 text-center" style="margin-top:20px;">
					
					<div id="round_div"><span><i class="fa fa-star-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i></span></div>
					<h4>Review WEsender</h4>
					</div>
				</div>
				
			</div>
		</section>';
	echo '	<section id="what_we_do">
						<h2 style="margin-bottom: 40px;">WHY WE?</h2>
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<span class="fa-stack fa-5x fa-pull-right">
									  <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
									  <i class="fa fa-inr fa-stack-1x"></i>
									</span>
									<h3 style="color:#009688;text-align:right">Earn More</h3>
									<p>WEcarrier will earn in form of cash for carrying Parcels and WEsender will earn by saving a lot.</p>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<span class="fa-stack fa-5x fa-pull-left">
									  <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
									  <i class="fa fa-trophy fa-stack-1x"></i>
									</span>
									<h3 style="color:#009688;text-align:left">Fayde ka Sauda</h3>
									<p>For WEsender, lesser time and Lesser money spend for Parcels. For WEcarrier, more money Earned while travelling.</p>
								</div>
								
							</div>
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<span class="fa-stack fa-5x fa-pull-right">
									  <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
									  
									  <i class="fa fa-rocket fa-stack-1x"></i>
									</span>
									<h3 style="color:#009688;text-align:right">Best and Quickest</h3>
									<p>No wait for bulk parcels, no multiple warehouse transition of Parcels. Just share, care and deliver.</p>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<span class="fa-stack fa-5x fa-pull-left">
									  <i class="fa fa-circle hello fa-stack-2x" style="color:#eee"></i>
									  <i class="fa fa-cogs fa-stack-1x"></i>
									</span>
									<h3 style="color:#009688;text-align:left">Easy Process</h3>
									<p>Hasle free process, Smart people, More choices and better than "the" conventional methods of parcelling.</p>
								</div>
								
							</div>
						</div>
		</section>';
	
	
echo ' </div>';
showFooter();
loadLaterJSFiles();
echo '  </body>';
echo '</html>';

?>