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
getPageTitle("CONTACT US");
loadCSSFiles();
loadJSFiles();
echo '  <style>
		@import url("http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");
		@import url("http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700");
	</style>
	</head>';
echo '  <body>';

showHeader("contactUs");
loadLoginModal();

echo ' <div id="content">';
echo '<div class="container">';
checkPageMessages();
echo '</div>';
echo '<section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Us</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form id="contactForm">
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                               <label for="name">Name</label>
                               <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                            </div>
                       	    <div class="col-xs-12">
                       	    	<span id="name_status" class="error-status"></span>
                       	    </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email">
                            </div>
                            <div class="col-xs-12">
                       	    	<span id="email_status" class="error-status"></span>
                       	    </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="phone">Mobile Number</label>
                                <input type="tel" class="form-control" placeholder="Mobile Number" id="phone" name="phone">
                            </div>
                            <div class="col-xs-12">
                       	    	<span id="phone_status" class="error-status"></span>
                       	    </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="message">Message</label>
                                <textarea rows="4" class="form-control" placeholder="Message" id="message" name="message"></textarea>
                            </div>
                            <div class="col-xs-12">
                       	    	<span id="message_status" class="error-status"></span>
                       	    </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12" style="text-align:center">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                                <span id="submit_status" class="error-status"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </section>';
echo '</div>';    
showFooter();
loadLaterJSFiles();
echo '  </body>';
echo '</html>';

?>