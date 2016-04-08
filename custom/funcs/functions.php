<?php

function runQuery($str){
  $con = connectDB();

  $fres = mysqli_query($con,$str);
  if(!$fres){
    generateLog("Query Error! '".$str."' Description: ".mysqli_error($con));
  }

  closeDB($con);
  return $fres;
}

function connectDB(){
  //generateLog("\n================================== ".date('d-m-Y')." ".date('H:i:s')." ==================================\n");
  //generateLog("Connecting to Database...\n");
  $dbIP = "localhost";
  $username = "wecarysa";
  $password = "?4UeY0H9%0%b";
  $dbName = "wecarysa_wecarriers";
  $con = mysqli_connect($dbIP,$username,$password,$dbName);
  if(!$con){
    generateLog("Connection Error!\nDescription: ".mysqli_connect_error());
  }/*else{
    generateLog("Connection Established successfully!\n Returning connection string...");
  }*/

  return $con;
}

function closeDB($c){
  if($c){
    //generateLog("\nClosing Database connection...\n");
    if(!mysqli_close($c)){
      generateLog("Error while closing database connection\nDescription: ".mysqli_error($c));
    }/*else{
      generateLog("Database connection closed successfully!\n");
    }*/
    //generateLog("================================================================================\n");
  }
}

function generateLog($info){
	$today = date("d-m-Y");
	$fpath = "/home/wecarysa/public_html/dev_work/log_info/".$today.".txt";
	if(!fopen($fpath, 'r')){
		$fh = fopen($fpath, 'w') or die("Can't log at: ".$fpath);
		fclose($fh);
	}
	if(fopen($fpath, 'r')){
		$fh = fopen($fpath, 'a') or die("Can't append at: ".$fpath);
		$info = "|".date('d-m-Y')."|".date('H:i:s')."|".$info."\n";
		fwrite($fh, $info);
		fclose($fh);
	}
}

function getPageTitle($title){
	echo '    <title>WeCarriers | '.$title.'</title>';
}

function loadCSSFiles(){
	echo '    <link href="custom/css/bootstrap.min.css" rel="stylesheet">';
	echo '    <link rel="stylesheet" type="text/css" href="custom/css/bootstrap.min.css" />';
	echo '    <link rel="stylesheet" type="text/css" href="custom/css/font-awesome.min.css" />';
	echo '    <link href="custom/css/carousel.css" rel="stylesheet">';
	echo '    <link href="custom/css/dashboard.css" rel="stylesheet">';
	echo '    <link href="custom/css/custom.css" rel="stylesheet">';
	echo '    <link href="custom/css/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
	echo '    <link href="custom/css/style.css" rel="stylesheet">
		  <link rel="stylesheet" href="custom/css/bootstrap.offcanvas.css">';
}

function loadJSFiles(){

	echo '    <script type="text/javascript" src="custom/js/jquery/jquery-1.12.2.min.js"></script>';
	echo '	  <script type="text/javascript" src="custom/js/bootstrap.min.js"></script>';
	echo '    <script src="custom/js/ie-emulation-modes-warning.js"></script>';
	echo '    <script type="text/javascript">
	            function updateSessionData() {
	              var xhttp = new XMLHttpRequest();
	              xhttp.open("GET", "updateSessionDetails.php", true);
	              xhttp.send();
	            }

	            function updateSession(){
	            	updateSessionData();
	            	setTimeout(updateSession, 1000);
	            }

	            window.onload = function(){updateSession()};
	          </script>
	     ';
}

function loadLaterJSFiles(){

	echo '    <script src="custom/js/holder.min.js"></script>';
	echo '    <script src="custom/js/ie10-viewport-bug-workaround.js"></script>';
	echo '    <script src="custom/js/transition.js"></script>';
	echo '    <script src="custom/js/tooltip.js"></script>';
	echo '    <script src="custom/js/popover.js"></script>';
	echo '    <script src="custom/js/jquery-ui-1.10.4.custom.min.js"></script>';
	echo '    <script src="custom/js/style.js"></script>';
        echo '    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
                  <script src="custom/js/bootstrap.offcanvas.js"></script>
                  ';
}

function showHeader($page){
	$wc_uid = getSessionUID();
	echo '<div id="wrapper">';//its closing is in footer
	echo ' <header>';
	echo '      <div class="container">';
	if($wc_uid){
		echo '    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">';
	}else{
		echo '    <nav class="navbar navbar-default navbar-fixed-top">';
	}
	echo '          <div class="container">';
	echo '            <div class="navbar-header">';
	echo '              <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#navbar" style="float:left;">';
	echo '                <span class="sr-only">Toggle navigation</span>';
	echo '                <span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
		                      <span class="icon-bar"></span>
	                      </span>';
	echo '              </button>';
	echo '              <a class="navbar-brand" href="index.php">';
	if($wc_uid){
		echo '            <img src="custom/images/logo.png" class="img-responsive" alt="Logo">';
	}else{
		echo '            <img src="custom/images/logo.png" class="img-responsive" alt="Logo">';
	}
	echo '              </a>';
	echo '            </div>';
	echo '            <div id="navbar" class="navbar-offcanvas navbar-offcanvas-touch navbar-right">';
	echo '              <ul class="nav navbar-nav">';
	if($wc_uid){
		if(strstr($page, "my_dashboard")){
			echo '    <li class="active"><a href="myDashboard.php">Dashboard</a></li>';
		}else{
			echo '    <li><a href="myDashboard.php">Dashboard</a></li>';
		}
		if(strstr($page, "my_journeys")){
			echo '    <li class="active"><a href="myJourneys.php">Journeys</a></li>';
		}else{
			echo '    <li><a href="myJourneys.php">Journeys</a></li>';
		}
		if(strstr($page, "my_orders")){
			echo '    <li class="active"><a href="myOrders.php">Parcels</a></li>';
		}else{
			echo '    <li><a href="myOrders.php">Parcels</a></li>';
		}
		if(strstr($page, "my_requests")){
			echo '    <li class="active"><a href="myRequests.php">Requests</a></li>';
		}else{
			echo '    <li><a href="myRequests.php">Requests</a></li>';
		}

		$wc_uid = getSessionUID();
		$res = runQuery("select * from users where user_id='$wc_uid'");
		$row = mysqli_fetch_array($res);
		$pending_items = 0;
		if($row['mobile_no_status'] == 0){
			$pending_items++;
		}
		if(strlen($row['email_id']) == 0){
			$pending_items++;
		}else{
			if($row['email_id_status'] == 0){
				$pending_items++;
			}
		}
		if($row['id_proof_name'] == 0){
			$pending_items++;
		}else{
			if($row['id_proof_status'] == 0){
				$pending_items++;
			}
		}
		if($row['address_proof_name'] == 0){
			$pending_items++;
		}else{
			if($row['address_proof_status'] == 0){
				$pending_items++;
			}
		}
		$pending_items_str = "";
		if($pending_items > 0){
			$pending_items_str = ' <span class="badge">'.$pending_items.'</span>';
		}

		if(strstr($page, "my_profile")){
			echo '    <li class="active"><a href="myProfile.php">Profile'.$pending_items_str.'</a></li>';
		}else{
			echo '    <li><a href="myProfile.php">Profile'.$pending_items_str.'</a></li>';
		}
		$res = runQuery("select username from users where user_id='$wc_uid'");
		$row = mysqli_fetch_array($res);
		if(strstr($page, "user")){
			echo '        <li class="dropdown" class="active">';
		}else{
			echo '        <li class="dropdown">';
		}
		echo '              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-				expanded="false">'.$row['username'].'<span class="caret"></span></a>';
		echo '          <ul class="dropdown-menu">
					<li><a href="myProfile.php?as_a=personal">Personal Information</a></li>
			                <li><a href="myProfile.php?as_a=address">Address</a></li>
			                <li><a href="myProfile.php?as_a=account">Account</a></li>
			                <li><a href="myProfile.php?as_a=settings">Settings</a></li>
		        	        <li><a href="userLogout.php">Logout</a></li>
		              	</ul>';
		echo '            </li>';
	}
	else{
		if(strstr($page, "how_it_works")){
			echo '            <li class="active"><a href="how_it_works.php">How It Works</a></li>';
		}else{
			echo '            <li><a href="how_it_works.php">How It Works</a></li>';
		}
		if(strstr($page, "aboutUs")){
			echo '            <li class="active"><a href="aboutUs.php">About Us</a></li>';
		}else{
			echo '            <li><a href="aboutUs.php">About Us</a></li>';
		}
		if(strstr($page, "contactUs")){
			echo '            <li class="active"><a href="contactUs.php">Contact Us</a></li>';
		}else{
			echo '            <li><a href="contactUs.php">Contact Us</a></li>';
		}
		if(!$wc_uid)
			echo '            <li id="loginLink"><a href="#loginModal" data-target="#loginModal" data-toggle="modal">LOGIN/SIGNUP</a></li>';

	}

	echo '              </ul>';
	echo '            </div>';
	echo '          </div>';
	echo '        </nav>';
	echo '    </div>';
	echo ' </header>';
}

function showFooter(){

	echo ' <footer>';
	echo '      <div class="container">
			<div class="row">
				<div class="col-md-4 col-lg-4 col-xs-12">
					<p style="color:#fff">Copyright &copy; 2016 WEcarriers . All rights Reserved .</p>
				</div>
				<div class="col-md-3 col-lg-4 col-xs-12 text-center">
					<a style="color:#fff" href="#"><i class="fa fa-3x fa-facebook-square"></i></a>
					<a style="color:#fff" href="#"><i class="fa fa-3x fa-twitter-square"></i></a>
					<a style="color:#fff" href="#"><i class="fa fa-3x fa-instagram"></i></a>
					<a style="color:#fff" href="#"><i class="fa fa-3x fa-linkedin-square"></i></a>
					<a style="color:#fff" href="#"><i class="fa fa-3x fa-youtube-square"></i></a>
				</div>
				<div class="col-md-5 col-lg-4 col-xs-12">
					<a style="color:#fff" href="privacy.php">Privacy</a>  &#124  <a style="color:#fff" href="terms.php">Terms</a>
					  &#124  <a style="color:#fff" href="aboutUs.php">About Us</a>  &#124  <a style="color:#fff" href="contactUs.php">Contact Us</a>
					    &#124  <a style="color:#fff" href="how_it_works.php">How It Works</a>
				</div>
			</div>
		    </div>';
	echo ' </footer>';
	echo '</div>';//it is closing of wrapper div of header

}

function loadReferralModal($referral_code){
	$wc_uid = getSessionUID();
	if($wc_uid){
	echo '
		<div class="container">
		  <div id="myModalReferral" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title" id="myModalLabel">Share Referral Code</h4>
		        </div>
		        <div class="modal-body">
		        	<div class="row">
		        		<div class="col-xs-12">
		        		<form>
		        			<div class="input-group">
					                <div class="input-group-addon"><i class="fa fa-fw fa-mobile icon"></i></div>
					                <label for="inputText" class="sr-only">Mobile Number</label>
					                <input type="text" id="input_mobile" name="input_mobile" class="form-control" placeholder="Enter Mobile Number" autofocus>
				                </div>
				              	<div style="text-align:center"><h4>OR / AND</h4></div>
		        			<div class="input-group" style="padding-bottom: 10px;">
							<div class="input-group-addon"><i class="fa fa-fw fa-envelope icon"></i></div>
							<label for="inputEmail" class="sr-only">Email Address</label>
					                <input type="email" id="input_email" name="input_email" class="form-control" placeholder="Enter Email Address">
					                	             								        </div>

				                <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="submit_status" class="error-status"></span></div>
			              	        <div class="text-center"><button class="btn btn-lg btn-primary" id="referralForm" type="submit"><i class="fa fa-fw fa-share-alt"></i>Share</button></div>
			            	</form>
		        		</div>
		        	</div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>';
	}

}

function loadReviewModal($req_id){
	$wc_uid = getSessionUID();
	if($wc_uid){
		if(verifyUserProfile($wc_uid) == 0){
			header("location: myProfile.php");
		}
	echo '
		<div class="container">
		  <div id="myModalReview'.$req_id.'" class="modal fade review_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title" id="myModalLabel">Review</h4>
		        </div>
		        <div class="modal-body">
		        	<div class="row">';
		        $res = runQuery("select * from reviews where user_id='".$wc_uid."' and review_id in (select review_id from request_reviews where request_id='".$req_id."')");
			$comment = null;
			$rating = null;
			if($res && mysqli_num_rows($res)){
				$row = mysqli_fetch_array($res);
				$rev_id    = $row['review_id'];
				$rating    = $row['rating'];
				$comment   = $row['comment'];
				$posted_on = $row['timestamp'];
			}
			if(!$rating && !$comment){
		        echo '			<form id="'.$req_id.'" class="userReviews">';
		        }else{
		        echo '			<form id="'.$req_id.'" class="updateReviews">
		        				<input type="hidden" id="review'.$req_id.'" name="review'.$req_id.'" value="'.$rev_id.'">';
		        }
			echo '				<div class="col-xs-12">';
			echo '					<div style="width: 100%; padding-bottom: 5px; border-bottom: 1px solid #fac106; font-weight: bold;">Rating</div>';
			echo '					<div style="padding: 10px 0px 0px 10px;">';
			echo '	<div id="rating_stars'.$req_id.'" class="rateit bigstars" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-value="'.$rating.'"></div>';
			echo '						<input type="hidden" id="user_rating'.$req_id.'" name="input_user_rating'.$req_id.'">';
			echo '					</div>';
			echo '				</div>';

			echo '				<div class="col-xs-12">';
			echo '					<div style="width: 100%; padding-bottom: 5px; border-bottom: 1px solid #fac106; font-weight: bold;">Comments (Max. 1000 Characters)</div>';
			echo '					<div style="padding-top: 5px;">';
			echo '						<textarea id="input_user_comment'.$req_id.'" name="input_user_comment'.$req_id.'" class="form-control" rows="4" placeholder="Enter Comment">'.$comment.'</textarea>';
			echo '					</div>';
			echo '					<div style="padding-top: 5px; text-align: right;">';
			echo '						<div style="font-size: 10px;">Reviewed '.time_elapsed_string($posted_on).'</div>';
			echo '					</div>';
			echo '					<div><span id="submit_status'.$req_id.'" class="error-status"></span></div>';
			echo '					<div style="padding-top: 5px;text-align:center">';
			echo '						<button type="submit" class="btn btn-primary">';
			if(!$rating && !$comment){
			echo '							Post Rating';
			}else{
			echo '							Update Rating';
			}
			echo '						</button>';
			echo '					</div>';
			echo '				</div>';
			echo '			</form>';

			echo '   </div>
		        </div>
	';

	echo '
		      </div>
		    </div>
		  </div>
		</div>
	';
	}
}

function loadChatModal($req_id){
	$wc_uid = getSessionUID();
	if($wc_uid){
		if(verifyUserProfile($wc_uid) == 0){
			header("location: myProfile.php");
		}
	echo '
		<div class="container">
		  <div id="myModalChat'.$req_id.'" class="modal fade chat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		    <div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          <h4 class="modal-title" id="myModalLabel">Chat History</h4>
		        </div>
		        <div class="modal-body">
		        	<div class="row">';
		        echo '			<form id="'.$req_id.'" class="userChats">';
			echo '				<div class="col-xs-12">';
			echo '					<div style="padding-bottom: 5px; font-weight:bold;border-bottom: 1px solid #fac106;">Messages</div>';
			echo '					<div id="your_div'.$req_id.'" style="padding: 2px;height:200px;overflow: auto;">';
			$res1 = runQuery("select * from chats where request_id='".$req_id."'");
			if($res1 && mysqli_num_rows($res1)){
				while($row1 = mysqli_fetch_array($res1)){
					$res2 = runQuery("select username from users where user_id='".$row1['user_id']."'");
					$row2 = mysqli_fetch_array($res2);
					echo '				<div style="width: 80%; display: inline-block">';
					if($row1['user_id']==$wc_uid)
						echo '				<label style="">me</label>:';
					else
						echo '				<label style="">'.$row2['username'].'</label>:';
					echo '					<label style="font-weight: normal;">'.$row1['message'].'</label>';
					echo '				</div>';
					echo '				<div style="width: 18%; display: inline-block">';
					echo '					<label style="font-weight: normal; float: right; font-size: 10px;">'.time_elapsed_string($row1['timestamp']).'</label>';
					echo '				</div>';
				}
			}else{
				echo '					<div align="center" style="padding: 5px; color: silver;">No messages found</div>';
			}
			echo '					</div>';
			echo '				</div>';

			echo '				<div class="col-xs-12">';
			echo '					<div style="padding-bottom: 5px; font-weight:bold;border-bottom: 1px solid #fac106;">New Message</div>';
			echo '					<div style="padding-top: 5px;">';
			echo '						<textarea name="input_message'.$req_id.'" id="input_message'.$req_id.'" class="form-control" rows="2" placeholder="Enter Message"></textarea>';
			echo '					<span id="submit_status'.$req_id.'" class="error-status"></span></div>';
			echo '					<div style="padding-top: 5px;padding-bottom: 5px;text-align:center">';
			echo '						<button type="submit" class="btn btn-primary">Post Message</button>';
			echo '					</div>';
			echo '				</div>';

			echo '			</form>';

			echo '   </div>
		        </div>
	';

	echo '
		      </div>
		    </div>
		  </div>
		</div>
	';
	}
}

function loadLoginModal(){
	$wc_uid = getSessionUID();
	if(!$wc_uid){
	echo '
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content login-modal">
	      		<div class="modal-header login-modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title text-center" id="loginModalLabel">USER AUTHENTICATION</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="text-center">
		      			<div role="tabpanel" class="login-tab">
					  	<!-- Nav tabs -->
					  	<ul class="nav nav-tabs" role="tablist" style="width:100%;">
					    	<li role="presentation" class="active"><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab"><span style="margin-right:5px;"><i class="fa fa-sign-in"></i></span>Sign In</a></li>
					    	<li role="presentation"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab"><span style="margin-right:5px;"><i class="fa fa-pencil-square-o"></i></span>Sign Up</a></li>
					    	<li role="presentation"><a href="#forget" aria-controls="forget" role="tab" data-toggle="tab"><span style="margin-right:5px;"><i class="fa fa-lock"></i></span>Forget Password</a></li>
					  	</ul>

					 	<div class="tab-content">
					    	<div role="tabpanel" class="tab-pane active text-center" id="signin">
					    		&nbsp;&nbsp;
					    		<form class="form-signin"  id="loginform">
						            <div class="row">
						            	<div class="col-md-12">
							              <div class="input-group" style="padding-bottom: 10px;">
							                <div class="input-group-addon"><i class="fa fa-fw fa-mobile icon"></i></div>
							                <label for="inputText" class="sr-only">Mobile Number</label>
							                <input type="text" id="input_login_mobile" name="input_login_mobile" class="form-control" placeholder="Enter Mobile Number" autofocus>
							              </div>
							              <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="login_mobile_status" class="error-status"></span></div>
							              <div class="input-group" style="padding-bottom: 10px;">
							                <div class="input-group-addon"><i class="fa fa-fw fa-key icon"></i></div>
							                <label for="inputPassword" class="sr-only">Password</label>
							                <input type="password" id="input_login_password" name="input_login_password" class="form-control" placeholder="Enter Password">
							              </div>
						                      <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="login_password_status" class="error-status"></span></div>
						                      <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="login_submit_status" class="error-status"></span></div>
							              <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
							              <div class="text-left" style="margin-left:10px;font-size:10px"><span>By Logging in you agree to our <a href="terms.php">Terms & Conditions</a> and <a href="privacy.php">Privacy Policy</a></span></div>
								</div>
							   </div>
							   <div class="login-modal-footer">
				  				<div class="row">
									<div class="col-xs-8 col-sm-8 col-md-8">
										<i class="fa fa-lock  icon"></i>
										<a href="#forget" class="forgetpass-tab" data-toggle="tab"> Forgot password? </a>

									</div>

									<div class="col-xs-4 col-sm-4 col-md-4">
										<i class="fa fa-pencil-square-o  icon"></i>
										<a href="#signup" class="signup-tab" data-toggle="tab"> Sign Up </a>
									</div>
								</div>
				  			   </div>
						      </form>

					    	</div>
					    	<div role="tabpanel" class="tab-pane" id="signup">
					    	    &nbsp;&nbsp;
					            <div class="row">
						    	    <form class="form-signin" id="registerform">
						            	<div class="col-md-12" id="reg_form">
                            				<div class="input-group" style="padding-bottom: 10px;">
                              					<div class="input-group-addon"><i class="fa fa-fw fa-user icon"></i></div>
                              					<label for="inputText" class="sr-only">Name</label>
                              					<input type="text" id="input_username" name="input_username" class="form-control" placeholder="Enter Name">
                            				</div>
                            				<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="username_status" class="error-status"></span></div>
							              	<div class="input-group" style="padding-bottom: 10px;">
							                	<div class="input-group-addon"><i class="fa fa-fw fa-envelope icon"></i></div>
							                	<label for="inputEmail" class="sr-only">Email Address</label>
							                	<input type="email" id="input_email" name="input_email" class="form-control" placeholder="Enter Email Address">
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="email_status" class="error-status"></span></div>
                            				<div class="input-group" style="padding-bottom: 10px;">
							                	<div class="input-group-addon"><i class="fa fa-fw fa-mobile icon"></i></div>
							                	<label for="inputMobile" class="sr-only">Mobile Number</label>
							                	<input type="text" id="input_mobile" name="input_mobile" class="form-control" placeholder="Enter Mobile Number" autofocus>
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="mobile_status" class="error-status"></span></div>
							  	          	<div class="input-group" style="padding-bottom: 10px;">
							                	<div class="input-group-addon"><i class="fa fa-fw fa-key icon"></i></div>
							                	<label for="inputPassword" class="sr-only">Password</label>
							                	<input type="password" id="input_password" name="input_password" class="form-control" placeholder="Enter Password">
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="password_status" class="error-status"></span></div>
							              	<div class="input-group" style="padding-bottom: 10px;">
							                	<div class="input-group-addon"><i class="fa fa-fw fa-key icon"></i></div>
							                	<label for="inputPassword" class="sr-only">Re-type Password</label>
							                	<input type="password" id="input_repassword" name="input_repassword" class="form-control" placeholder="Re-type Password">
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="repassword_status" class="error-status"></span></div>
							              	<div class="input-group" style="padding-bottom: 10px;">
							                	<div class="input-group-addon"><i class="fa fa-fw fa-share icon"></i></div>
							                	<label for="inputCode" class="sr-only">Referral Code</label>
							                	<input type="text" id="input_code" name="input_code" class="form-control" placeholder="Referral Code (optional)">
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="code_status" class="error-status"></span></div>
							              	<div class="input-group" style="padding-bottom: 10px;">
							                	<input type="checkbox" id="input_register_checkbox" name="input_register_checkbox"><span style="margin-left:5px;font-size:10px">I hereby certify that I am atleast 18 years of age.</span>
							              	</div>
							              	<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="submit_status" class="error-status"></span></div>
							              	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
							              	<div class="text-left" style="margin-left:10px;font-size:10px"><span>By registering you agree to our <a href="terms.php">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span></div>
							    		</div>
							    	</form>';
							    	/*
							    	 *  CR 44
							    	 *  - To include a text box to specify the OTP.
							    	 *  Fix BEGIN
									 */
	echo					    	'<form class="form-signin" id="verifyotpform">
								    	<div id="reg_otp" style="display: none;">
											<div class="text-left" style="font-size: 12px; padding-bottom: 10px;">
												An OTP has been sent to your mobile number. Please provide the code sent in the text box shown below.
											</div>
											<div class="input-group" style="padding-bottom: 10px;">
												<div class="input-group-addon"><i class="fa fa-fw fa-key icon"></i></div>
												<label for="inputOTP" class="sr-only">OTP</label>
												<input type="text" id="input_otp" name="input_otp" class="form-control" placeholder="Enter OTP">
											</div>
											<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="otp_status" class="error-status"></span></div>
											<div class="input-group" style="padding-bottom: 10px; display: none;">
												<div class="input-group-addon"><i class="fa fa-fw fa-mobile icon"></i></div>
												<label for="inputVerifyMobile" class="sr-only">Verify Mobile</label>
												<input type="text" id="input_verify_mobile" name="input_verify_mobile" class="form-control" placeholder="Enter Mobile Number">
											</div>
											<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="verify_mobile_status" class="error-status"></span></div>
											<div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="verify_status" class="error-status"></span></div>
											<button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
										</div>
									</form>';
									/*  Fix END - 44  */
	echo						'</div>
						    	<div class="login-modal-footer">
			  						<div class="row">
										<div class="col-xs-8 col-sm-8 col-md-8">
											<i class="fa fa-lock icon"></i>
											<a href="#forget" class="forgetpass-tab" data-toggle="tab"> Forgot password? </a>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4">
											<i class="fa fa-sign-in icon"></i>
											<a href="#signin" class="signin-tab" data-toggle="tab"> Sign In </a>
										</div>
				  					</div>
			  			    	</div>
					    	</div>
					    	<div role="tabpanel" class="tab-pane text-center" id="forget">
					    		&nbsp;&nbsp;
								<div class="row">
									<form class="form-signin" id="forgetform">
						            		<div class="col-md-12" id="forget_email" style="">
						            		      <div class="input-group" style="padding-bottom: 10px;">
								                <div class="input-group-addon"><i class="fa fa-fw fa-envelope icon"></i></div>
								                <label for="inputEmail" class="sr-only">Email Address</label>
								                <input type="email" id="input_forget_email" name="input_forget_email" class="form-control" placeholder="Enter Email Address">
								              </div>
								              <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="forget_email_status" class="error-status"></span></div>
								              <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="forget_submit_status" class="error-status"></span></div>
							              	      <button class="btn btn-lg btn-primary btn-block" type="submit">Forget Password</button>
						            		</div>
						            		</form>
						            		<form class="form-signin" id="otpform">
						            		<input type="hidden" id="otpEmail" name="otpEmail">
						            		<div class="col-md-12" id="forget_otp" style="display: none;">
								              <div class="input-group" style="padding-bottom: 10px;">
								                <div class="input-group-addon"><i class="fa fa-fw fa-key icon"></i></div>
								                <input type="text" id="input_forget_otp" name="input_forget_otp" class="form-control" placeholder="One Time Password(case-sensitive)">
								              </div>
								              <div class="text-left" style="margin-top:-10px;padding-bottom:10px;"><span id="otp_submit_status" class="error-status"></span></div>
							              	      <span><a href="#" onclick="sendOTP()"> Resend OTP </a></span><button class="btn btn-lg btn-primary" type="submit">Verify</button>
						            		</div>
						            		</form>
						            	</div>
								<div class="login-modal-footer">
					  				<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<i class="fa fa-fw fa-sign-in icon"></i>
											<a href="#signin" class="signin-tab" data-toggle="tab"> Sign In </a>

										</div>

										<div class="col-xs-6 col-sm-6 col-md-6">
											<i class="fa fa-fw fa-pencil-square-o icon"></i>
											<a href="#signup" class="signup-tab" data-toggle="tab"> Sign Up </a>
										</div>
									</div>
					  			</div>
						 </div>
						 </div>
					</div>
		      		</div>
		      	</div>

		  </div>
		  </div>
	 </div>

	';
	}
}



function loadAddressModal($link_id, $input_id){
	$wc_uid = getSessionUID();
	echo '
		<div class="container">
		   <div id="'.$link_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		      <div class="modal-dialog">
		          <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">My Addresses</h4>
				</div>
				<div class="modal-body">
					<div class="row">';
					$q = "select * from address where address_id in (select address_id from user_address where user_id='".$wc_uid."')";
					$res = runQuery($q);
					if($res && mysqli_num_rows($res) > 0){
					   while($row = mysqli_fetch_array($res)){
					   	$pincode = $row['pincode'];
						$res1 = runQuery("select * from pincodes where pincode='$pincode'");
						$row1 = mysqli_fetch_array($res1);
					   echo '<div class="col-md-6">';
						echo '<div data-dismiss="modal" class="panel panel-primary" style=" cursor: pointer; overflow: auto;" onclick="addAddressToField(\''.$row['address_id'].'\', \''.$row['address_label'].'\', \''.$input_id.'\')">
							<div class="panel-heading" style="text-align: center;">
								<h3 class="panel-title">'.$row['address_label'].'</h3>
							</div>

							<div class="panel-body">

								<div style="">'.$row['address'].'</div>
								<div style=""><label style="width: 30%;font-weight: bold;">Pincode</label><label style="font-weight: normal;">'.$row['pincode'].'</label></div>

								<div style=""><label style="width: 30%;font-weight: bold;">City</label><label style="font-weight: normal;"></label>'.$row1['city'].'</div>
								<div style=""><label style="width: 30%;font-weight: bold;">State</label><label style="font-weight: normal;"></label>'.$row1['state'].'</div>
								<div style=""><label style="width: 30%;font-weight: bold;">Country</label><label style="font-weight: normal;"></label>India</div>
						 	</div>
						    </div>
						</div>';
						}
					}else{
						echo 'No Addresses found';
					}
			echo '		</div>
					<hr>

					<div style="text-align:center"><a href="myProfile.php?as_a=address"><button type="button" class="btn btn-link">Add New Address</button></a></div>
				</div>
			</div>
		      </div>
		   </div>
		</div>
	';
}



function loadJourneyModal($link_id){
	$wc_uid = getSessionUID();
	echo '
	<div class="container">
	   <div id="'.$link_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
		   <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">My Journeys<a href="myJourneys.php?from=modal"><button type="button" class="btn btn-link">Add New Journey</button></a></h4>
			</div>
			<div class="modal-body">
			   <div style="">';
				$q = "select * from journeys where journey_id in (select journey_id from carrier_journeys where user_id='".$wc_uid."')";
				$res = runQuery($q);
				if($res && mysqli_num_rows($res) > 0){
					echo '<div class="row">';
					while($row = mysqli_fetch_array($res)){
						$res1 = runQuery("select * from address where address_id='".$row['source_address_id']."'");
						$row1 = mysqli_fetch_array($res1);
						$res2 = runQuery("select * from address where address_id='".$row['destination_address_id']."'");
						$row2 = mysqli_fetch_array($res2);
						$pincode = $row1['pincode'];
						$res3 = runQuery("select * from pincodes where pincode='$pincode'");
						$row3 = mysqli_fetch_array($res3);
						$pincode = $row2['pincode'];
						$res4 = runQuery("select * from pincodes where pincode='$pincode'");
						$row4 = mysqli_fetch_array($res4);
						echo '<div style="" class="col-md-6">
							<div data-dismiss="modal" class="panel panel-primary" style=" cursor: pointer; overflow: auto;" onclick="addJourneyToField(\''.$row['journey_id'].'\', \''.$row['headline'].'\',\''.$row['notes'].'\',\''.$row['journey_date'].'\',\''.$row1['address'].'\',\''.$row3['city'].'\',\''.$row3['state'].'\',\''.$row1['pincode'].'\',\''.$row2['address'].'\',\''.$row4['city'].'\',\''.$row4['state'].'\',\''.$row2['pincode'].'\')">

							<div class="panel-heading" style="text-align: center;">
								<h3 class="panel-title">'.$row['headline'].'</h3>
							</div>

							<div class="panel-body">
								<div style="border-bottom: 1px solid #fac106;">
									<label>Journey Date</label>
							   	</div>
							   	<div style="">
									<label style="font-weight: normal;">'.$row['journey_date'].'</label>
								</div>
								<div style="border-bottom: 1px solid #fac106;">
									<label>Source Address</label>
								</div>
								<div style="">';

							echo '
									<label style="font-weight: normal;">'.$row1['address'].'</label>,
									<label style="font-weight: normal;">'.$row3['city'].'</label>,
									<label style="font-weight: normal;">'.$row3['state'].'</label>,
									<label style="font-weight: normal;">India</label>
									<label style="font-weight: normal;">'.$row1['pincode'].'</label>
								</div>
								<div style="border-bottom: 1px solid #fac106;">
									<label>Destination Address</label>
								</div>
								<div style="">';
					                echo '
									<label style="font-weight: normal;">'.$row2['address'].'</label>,
									<label style="font-weight: normal;">'.$row4['city'].'</label>,
									<label style="font-weight: normal;">'.$row4['state'].'</label>,
									<label style="font-weight: normal;">India</label>,
									<label style="font-weight: normal;">'.$row2['pincode'].'</label>
								</div>
								<div style="border-bottom: 1px solid #fac106;">
									<label>Additional Notes</label>
							   	</div>
							   	<div style="">
									<label style="font-weight: normal;">'.$row['notes'].'</label>
								</div>
							</div>
						     </div>
						     </div>';
					}
					echo '</div>';
				}else{
					echo '<div style="">No Journeys found</div>';
				}
echo '
				<div style="">
					<div style=""></div>
				</div>
			   </div>
			   <hr>
			   <div style="text-align:center">
			   </div>
			</div>
		   </div>
		</div>
	   </div>
	</div>
	';
}

function loadOrderModal($link_id){


	$wc_uid = getSessionUID();
	echo '
	<div class="container">
	   <div id="'.$link_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
		   <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">My Parcels<a href="myOrders.php?from=modal"><button type="button" class="btn btn-link">Add New Parcel</button></a></h4>
			</div>
			<div class="modal-body">
			   <div style="">';
				$q = "select * from orders where order_id in (select order_id from order_sender where user_id='".$wc_uid."')";
				$res = runQuery($q);
				if($res && mysqli_num_rows($res) > 0){
					echo '<div class="row">';
					while($row = mysqli_fetch_array($res)){
								$res1 = runQuery("select * from address where address_id='".$row['pickup_address_id']."'");
								$row1 = mysqli_fetch_array($res1);
								$res2 = runQuery("select * from address where address_id='".$row['delivery_address_id']."'");
								$row2 = mysqli_fetch_array($res2);
								$pincode = $row1['pincode'];
								$res3 = runQuery("select * from pincodes where pincode='$pincode'");
								$row3 = mysqli_fetch_array($res3);
								$pincode = $row2['pincode'];
								$res4 = runQuery("select * from pincodes where pincode='$pincode'");
								$row4 = mysqli_fetch_array($res4);
						echo '<div style="" class="col-md-6">
							<div data-dismiss="modal" class="panel panel-primary" style=" cursor: pointer; overflow: auto;" onclick="addOrderToField(\''.$row['order_id'].'\', \''.$row['headline'].'\',\''.$row['price'].'\',\''.$row['journey_date'].'\',\''.$row1['address'].'\',\''.$row3['city'].'\',\''.$row3['state'].'\',\''.$row1['pincode'].'\',\''.$row2['address'].'\',\''.$row4['city'].'\',\''.$row4['state'].'\',\''.$row2['pincode'].'\')">
						  	<div class="panel-heading" style="text-align: center;">
						  		<h3 class="panel-title">'.$row['headline'].'</h3>
						  	</div>
							<div class="panel-body">
							   <div style="border-bottom: 1px solid #fac106;">
									<label>Delivery Date</label>
							   </div>
							   <div style="">
								<label style="font-weight: normal;">'.$row['delivery_date'].'</label>
							   </div>
							   <div style="border-bottom: 1px solid #fac106;">
									<label>Source Address</label>
							   </div>
							   <div style="">';
				echo '
								<label style="font-weight: normal;">'.$row1['address'].'</label>,
								<label style="font-weight: normal;">'.$row3['city'].'</label>,
								<label style="font-weight: normal;">'.$row3['state'].'</label>,
								<label style="font-weight: normal;">India</label>,
								<label style="font-weight: normal;">'.$row1['pincode'].'</label>
							   </div>
							   <div style="border-bottom: 1px solid #fac106;">
									<label>Source Address</label>
							   </div>
							   <div style="">';

				echo '
								<label style="font-weight: normal;">'.$row2['address'].'</label>,
								<label style="font-weight: normal;">'.$row4['city'].'</label>,
								<label style="font-weight: normal;">'.$row4['state'].'</label>,
								<label style="font-weight: normal;">India</label>,
								<label style="font-weight: normal;">'.$row2['pincode'].'</label>
							   </div>
							   <div style="border-bottom: 1px solid #fac106;">
									<label>Price Quote</label>
							   </div>
							   <div style="">
								<label style="font-weight: normal;">'.$row['price'].' bucks</label>
							   </div>
							</div>
						  </div>
						  </div>';
					}
					echo '</div>';
				}else{
					echo '<div style="">No Parcel found</div>';
				}
echo '
				<div style="">
					<div style=""></div>
				</div>
			   </div>
			   <div style="text-align:center">

			   </div>
			</div>
		   </div>
		</div>
	   </div>
	</div>
	';
}

function loadImageModal($link_id, $path){
	$temp = substr($link_id,7,2);
	echo '
		<div class="container">
			<div id="'.$link_id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">';
						if($temp=="ID"){
							echo 'ID';
						}else{
							echo 'Address';
						}
	echo '						Proof
						</h4>
					</div>
					<div align="center" class="modal-body">

							<img src="'.$path.'" style="width: 80%; height: 80%;"/>

					</div>
				</div>
				</div>

			</div>
		</div>
	';
}

function verifyUserProfile($uid){
	$res = runQuery("select * from users where user_id='$uid'");
	$row = mysqli_fetch_array($res);
	if( ($row['mobile_no_status'] == 0) || (strlen($row['email_id']) == 0) || ($row['email_id_status'] == 0) ){
		return 0;
	}
	return 1;
}

function isUserCompletelyVerified($uid){
	if(verifyUserProfile($uid)){
		$res = runQuery("select * from users where user_id='$uid'");
		$row = mysqli_fetch_array($res);
		if( ($row['id_proof_status'] == 1) && ($row['address_proof_status'] == 1) ){
			return 1;
		}
	}
	return 0;
}

function checkPageMessages(){
	$page_error_message = null;
	if(isset($_SESSION['page_error_message'])){
		$page_error_message = $_SESSION['page_error_message'];
		unset($_SESSION['page_error_message']);
	}

	$page_success_message = null;
	if(isset($_SESSION['page_success_message'])){
		$page_success_message = $_SESSION['page_success_message'];
		unset($_SESSION['page_success_message']);
	}

	if($page_success_message){
		echo '<div class="alert alert-success" role="alert">'.$page_success_message.'</div>';
	}else if($page_error_message){
		echo '<div class="alert alert-danger" role="alert">'.$page_error_message.'</div>';
	}
}

function setPageErrorMessage($message){
	$_SESSION['page_error_message'] = $message;
}

function setPageSuccessMessage($message){
	$_SESSION['page_success_message'] = $message;
}

function getModalBack($message){
	//$('#myModalRegister').modal('show');
}


function getSessionUID(){
	$uid = null;
	if(isset($_SESSION['wc_uid'])){
		$uid = $_SESSION['wc_uid'];
	}

	return $uid;
}

function deleteSessionUID(){
	if(isset($_SESSION['wc_uid'])){
		unset($_SESSION['wc_uid']);
	}

	return $uid;
}

function buildMessage($error_head, $message){
	return "<strong>".$error_head."</strong> ".$message;
}

function isValidMobileNumber($mob_no){
	if(strlen($mob_no) == 10){
		return true;
	}

	return false;
}

function isValidUsername($user_name){
	if((strlen($user_name) >= 3) && (strlen($user_name) <= 20)){
		return true;
	}

	return false;
}

function isValidPassword($password){
	if((strlen($password) >= 3) && (strlen($password) <= 20)){
		return true;
	}

	return false;
}

function isValidDate($str){
	if(strlen($str) > 0){
		return true;
	}

	return false;
}

function isValidWeight($str){
	if(is_numeric($str)){
		return true;
	}

	return false;
}

function isValidPrice($str){
	if(is_numeric($str)){
		return true;
	}

	return false;
}

function isValidHeadline($str){
	if( (strlen($str) > 0) && (strlen($str) <= 100) ){
		return true;
	}

	return false;
}

function isValidInterType($str){
	if($str == 0 || $str == 1 || $str == 2){
		return true;
	}

	return false;
}

function isValidAddressLabel($str){
	if( (strlen($str) > 0) && (strlen($str) <= 30) ){
		return true;
	}

	return false;
}

function isValidAddress($str){
	if( (strlen($str) > 0) && (strlen($str) <= 300) ){
		return true;
	}

	return false;
}

function isValidNote($str){
	if( (strlen($str) >= 0) && (strlen($str) <= 300) ){
		return true;
	}

	return false;
}

function isValidPincode($str){
	if( (strlen($str) == 6) ){
		return true;
	}

	return false;
}

function isValidChatMessage($str){
	if( (strlen($str) > 0) && (strlen($str) <= 200) ){
		return true;
	}

	return false;
}

function isValidProof($type, $val){
	if(is_numeric($val)){
		if(strcmp($type, "id") == 0){
			if( ($val >= 1) && ($val <= 4) ){
				return true;
			}
		}else if(strcmp($type, "address") == 0){
			if( ($val >= 1) && ($val <= 3) ){
				return true;
			}
		}
	}

	return false;
}

function isValidProofImage($image){
	$target_file = basename($image['name']);
	$image_file_type = pathinfo($target_file, PATHINFO_EXTENSION);
	if($image_file_type == "jpg" || $image_file_type == "jpeg"){
		$check = getimagesize($image["tmp_name"]);
		if($check !== false){
			$size = $image["size"];
			if($size <= 500000){
				return true;
			}
		}
	}

	return false;
}

function isValidRequestOp($str){
	if($str == 1 || $str == 2){
		return true;
	}

	return false;
}

function isValidRating($str){
	if((floatval($str) >= 0) && (floatval($str) <= 5)){
		return true;
	}

	return false;
}

function isValidUserComment($str){
	if((strlen($str) > 0) && (strlen($str) <= 1000)){
		return true;
	}

	return false;
}

function mres_ss($txt){
	$con = connectDB();
	$txt = htmlspecialchars(stripslashes($txt),ENT_QUOTES);
	$txt = str_ireplace("script", "blocked", $txt);
	$txt = mysqli_real_escape_string($con,$txt);
	return $txt;
}

function validEmail($email){
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	if(preg_match($regex, $email)){
		return true;
	}
	return false;
}

function time_elapsed_string($ptime){
	$ptime = strtotime($ptime);
	$etime = time()-$ptime;
	if($etime < 1){
		return '0 seconds ago';
	}
	$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
				30 * 24 * 60 * 60       =>  'month',
				24 * 60 * 60            =>  'day',
				60 * 60                 =>  'hour',
				60                      =>  'minute',
				1                       =>  'second'
			);
	foreach($a as $secs => $str){
		$d = $etime / $secs;
		if($d >= 1){
			$r = round($d);
			return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
		}
	}
}

function getInterTypeStr($val){
	if($val == 0){
		$str = "Intra-City";
	}else if($val == 1){
		$str = "Inter-City";
	}else{
		$str = "Inter-National";
	}

	return $str;
}
function sendSMS($message, $mobile_no){
	$msg_url = "http://203.212.70.200/smpp/sendsms";
    $get_params = array('username'=>'wecary', 'password'=>'carywe@987', 'text'=>$message, 'from'=>'WeCary', 'to'=>$mobile_no);
	$url = $msg_url.'?'.http_build_query($get_params, '', '&');
	generateLog("SMS URL = ".$url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
	return $response;
}

?>
