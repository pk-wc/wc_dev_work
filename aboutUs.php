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
getPageTitle("ABOUT US");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("aboutUs");
loadLoginModal();

if($wc_uid){
	echo '<div class="container" style="margin-top: 50px;">';
}else{
	echo '<div class="container" style="margin-top: 50px;">';
}
checkPageMessages();
echo '    </div>';

if($wc_uid){
        echo '  <div class="container-fluid">';/*ravi*/
        echo '  <div class="row">';/*ravi*/
	showSidebarTop("");
	echo '<div class="col-sm-9 col-lg-10 col-md-10 col-xs-12 main pull-right">';/*ravi*/
	
	
}else{
	echo ' <div class="">';
}
echo '<div class="row">';
echo '	<div class="col-md-12">';
echo ' 	<img src="custom/images/1_b.png" alt="About Us!" class="img-responsive center-block">';
echo '	</div>';
echo '</div>';

echo '<section id="how_we_started">
         <h2 style="margin-bottom: 40px;">HOW WE STARTED?</h2>
				 	<div class=" col2 col2s col3">
						<div class="col-lg-3 col-sm-3 col-md-4 col-xs-12">
								<div class=""><img src="custom/images/2_b.png" alt="How We Started!" class="img-responsive"></div>
						</div>
						<div class="col-lg-6 col-sm-6 col-md-4 col-xs-12" style="text-align: justify">
							 <p>Most of the business ideas are output of experiences. Most of us try to look for “jugaad” or simpler solutions. The story of our journey started with one problem faced by all but ignored by many. One day one among us stood up and explained the idea to another one and both started building the architecture. We now shared our idea across a wider team. Then finally we all sat together and finalized the key points and values to deliver to our users through WeCarriers.com</p>
						</div>
				 		<div class="col-lg-3 col-sm-3 col-md-4 col-xs-12">
								<div class=""><img src="custom/images/3_b.png"" class="img-responsive"> </div>
						</div>
					</div>
			</section>
				 ';
//here small images are of size 140px by 140px
echo '<section id="what_we_do">
         <h2 style="margin-bottom: 40px;">WHAT WE DO?</h2>
				 		<div class="col-lg-6 col-sm-5 col-md-5 col-xs-12">
							<div class="img_rt"><img src="custom/images/4_b.png"" class="img-responsive"> </div>
					 	</div>
					 	<div class="col-lg-6 col-sm-7 col-md-7 col-xs-12 col2 col2s">
               <div class="row col3 col5">
                  <div class="colg_1">
                     <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 col5">
                        <h3>PLATFORM</h3>
                        <p>We provide a platform to all who want to help and get helped at times when needed. We connect the commuters/travellers to the people who need to send their parcels. It is a unique model where everybody can be part of it to be benefitted in many ways.</p>
                     </div>
										 <div class="col-md-4 col-xs-12 col5 col54"><img src="custom/images/5_b.png" class="img-responsive"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="colg_1">
                     <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 col5">
                        <h3>PAISA VASOOL</h3>
                        <p>It is economic to use WeCarriers.com for both travellers as well as senders. Travellers will get money for carrying the parcels and senders end up paying less. Parcels will be delivered faster as compared to “the” conventional way.</p>
                     </div>
										 <div class="col-md-4  col-xs-12 col5 col54"><img src="custom/images/6_b.png" class="img-responsive"></div>
                  </div>
               </div>
               <div class="row col3 col5">
                  <div class="colg_1">
                     <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 col5">
                        <h3>Reliable</h3>
                        <p>Delivery of parcel is done faster, better and in a smarter way as compared to others. The reason being, we do not delay by keeping the parcels in various stores.</p>
                     </div>
										 <div class="col-md-4  col-xs-12 col5 col54"><img src="custom/images/7_b.png" class="img-responsive"></div>
                  </div>
               </div>
						</div>
      </section>';
			echo '<section id="who_we_are">
			         <h2 style="margin-bottom: 40px;">WHO WE ARE?</h2>
							 
							 	<div class="col2 col2s col3">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
											<div class=""><img src="custom/images/8_b.png" alt="Who We Are!" class="img-responsive"></div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="text-align: justify">
										 <p>We are young experienced enthusiasts, who are working towards making a well-connected, technology-friendly, and a better Nation so that we all are less worried, favourable, profitable and affined. We are mainly connected by two things:</p>
										 <ul>
										 	<li>Our aspirations, ideas, aim</li>
											<li>Our Alma-mater, yes we are IITians</li>
										 </ul>
										 <h3>Your Satisfaction is Our Success.</h3>
									</div>
								</div>
							
						</section>
							 ';

if($wc_uid){
	showSidebarBottom();
	
	echo '</div>';
	echo '</div>';
}
	
if(!$wc_uid){
	showFooter();
}

echo '</div>';
loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
