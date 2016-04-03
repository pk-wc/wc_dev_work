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
echo '  </head>';
echo '  <body style="background-color:#eee">';

showHeader("home");
loadLoginModal();
if($wc_uid){
		
	echo '
		<div class="container" style="margin-top: 50px;background-color:#fff;box-shadow: 0 2px 5px black;">
			<div class="row">
			     	
			     	<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top: 20px;text-align:center">
			     	<a href="myDashboard.php?as_a=sender"><button type="button" class="btn index-btn" style="width:80%">Find a weSender</button></a>
			     	</div>
			     	<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top: 20px;text-align:center">
			     		<a href="myDashboard.php?as_a=carrier"><button type="button" class="btn index-btn"  style="width:80%">Find a weCarrier</button></a>
			     	</div>
			</div>
			<div class="row" style="margin-bottom:250px">
			     	<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top: 20px;text-align:center">
			     		<a href="myOrders.php?from=index"><button type="button" class="btn index-btn"  style="width:80%">Enter a new Parcel</button></a>
			     	</div>
			     	<div class="col-xs-12 col-md-6 col-lg-6" style="margin-top: 20px;text-align:center">
			     		<a href="myJourneys.php?from=index"><button type="button" class="btn index-btn"  style="width:80%">Enter a new Journey</button></a>
			     	</div>
			</div>';	
	        	showFooter();	
	 echo '   </div>';

	
				
}else{

	echo '	<section style="margin-top: 50px">';
	checkPageMessages();
	echo '			<div class="row">';
	echo '				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">';
	echo '					<img src="custom/images/banner.jpg" class="img-responsive" alt="Banner Image!!!">';
	echo '				</div>';
	echo '		</div>';
	echo '	</section>';
	echo '	<section id="how_it_works">
						<h2 style="margin-bottom: 40px;">HOW IT WORKS?</h2>
						<div class="container">
							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
									<a href="how_it_works.php">
											<img class="img-responsive" src="custom/images/HIW_main.png">
									</a>
								</div>
							</div>
						</div>
					</section>';

	echo '	<section id="what_we_do">
						<h2 style="margin-bottom: 40px;">WHAT WE DO?</h2>
						<div class="container">
							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
									<a href="aboutUs.php">
											<img class="img-responsive" src="custom/images/4_b.png">
									</a>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 col3">
												<p class="text-justify">
												We provide a platform to all who want to help and get helped at times when needed.
						 						We connect the commuters/travellers to those who need to send their parcels. It is a unique model
					 	 						where everybody can be part of it to be benefitted in many ways. It is economic to use WeCarriers.com for
					   						both travellers as well as senders, travellers will get money for carrying the parcels and senders can pay
					   						less and parcels will be delivered faster as compared to the conventional way.
												</p>
								</div>
							</div>
						</div>
					</section>';
	showFooter();
}

loadLaterJSFiles();
echo '  </body>';
echo '</html>';

?>