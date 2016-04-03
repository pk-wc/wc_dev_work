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
getPageTitle("Privacy");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("privacy");
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
	echo '<div class="col-sm-9 col-lg-10 col-md-10 col-xs-12 main pull-right" style="padding:10px">';/*ravi*/
	
	
}else{
	echo ' <div class="container">';
}

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


