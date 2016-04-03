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
getPageTitle("My Settings");
loadCSSFiles();
loadJSFiles();
echo '  </head>';
echo '  <body>';

showHeader("user");
loadLoginModal();
loadRegisterModal();

if($wc_uid){
	$res = runQuery("select * from users where user_id='$wc_uid'");
	$row = mysqli_fetch_array($res);
	$file_path_id = "images/".$row['mobile_no']."_".$row['user_id']."_id";
	$file_path_addr = "images/".$row['mobile_no']."_".$row['user_id']."_address";
	if(file_exists($file_path_id)){
		loadImageModal("myModalIDImage", $file_path_id);
	}
	if(file_exists($file_path_addr)){
		loadImageModal("myModalAddressImage", $file_path_addr);
	}

	echo '    <div class="container" style="margin-top: 50px;"></div>';
	echo '  <div class="container">';/*ravi*/
	echo '  <div class="row">';/*ravi*/
	echo '<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 main" style="padding:0px 10px 0px 10px">';/*ravi*/
	echo '    <h1 class="page-header">My Settings</h1>';
	checkPageMessages();
	echo '    <div class="panel panel-primary">';
	echo '      <div class="panel-heading">';
	echo '        <h3 class="panel-title">Change Password</h3>';
	echo '      </div>';
	echo '      <div class="panel-body">';
	echo '        <form class="form-signin" action="userSettings.php" method="post">';
	echo '          <div style="width: 100%;">';
	echo '            <div style="width: 100%;">';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                Current Password';
	echo '              </div>';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                <div style="padding-bottom: 10px; width: 100%;">';
	echo '                  <label for="inputPassword" class="sr-only">Current Password</label>';
	echo '                  <input type="password" name="input_old_password" class="form-control" placeholder="Enter Current Password" required autofocus>';
	echo '                </div>';
	echo '              </div>';
	echo '            </div>';
	echo '            <div style="width: 100%;">';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                New Password';
	echo '              </div>';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                <div style="padding-bottom: 10px; width: 100%;">';
	echo '                  <label for="inputPassword" class="sr-only">New Password</label>';
	echo '                  <input type="password" name="input_new_password" class="form-control" placeholder="Enter New Password" required autofocus>';
	echo '                </div>';
	echo '              </div>';
	echo '            </div>';
	echo '            <div style="width: 100%;">';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                Re-Type New Password';
	echo '              </div>';
	echo '              <div style="width: 30%; display: inline-block; vertical-align: top;">';
	echo '                <div style="padding-bottom: 10px; width: 100%;">';
	echo '                  <label for="inputPassword" class="sr-only">Re-Type New Password</label>';
	echo '                  <input type="password" name="input_re_new_password" class="form-control" placeholder="Re-Type New Password" required autofocus>';
	echo '                </div>';
	echo '              </div>';
	echo '            </div>';
	echo '            <hr>';
	echo '            <div align="center" style="width: 100%;">';
	echo '              <button class="btn btn-lg btn-primary btn-block" style="width: 30%;" type="submit">Save Changes</button>';
	echo '            </div>';
	echo '          </div>';
	echo '        </form>';
	echo '      </div>';
	echo '    </div>';
	showSidebarBottom();
	echo '    </div>';
	echo '    </div>';
	echo '    </div>';
}else{
	echo '    <div class="container" style="margin-top: 120px;">';
	checkPageMessages();
	echo '    </div>';
	showFooter();
}

loadLaterJSFiles();

echo '  </body>';
echo '</html>';

?>
