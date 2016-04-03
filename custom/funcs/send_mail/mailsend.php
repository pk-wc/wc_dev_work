<?php

	function SendMail( $ToEmail, $subject, $MessageHTML) {
	  require_once ( 'class.phpmailer.php' ); // Add the path as appropriate
	  $Mail = new PHPMailer();
	  $Mail->IsSMTP(); // Use SMTP
	  $Mail->Host        = "smtp.wecarriers.com"; // Sets SMTP server
	  $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
	  $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
	  $Mail->SMTPSecure  = "tls"; //Secure conection
	  $Mail->Port        = 587; // set the SMTP port
	  $Mail->Username    = 'admin@wecarriers.com'; // SMTP account username
	  $Mail->Password    = 'weadmin@fun'; // SMTP account password
	  $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
	  $Mail->CharSet     = 'UTF-8';
	  $Mail->Encoding    = '8bit';
	  $Mail->Subject     = $subject;
	  $Mail->ContentType = 'text/html; charset=utf-8\r\n';
	  $Mail->From        = 'no-reply@wecarriers.com';
	  $Mail->FromName    = 'No Reply';
	  $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line
	
	  $Mail->AddAddress( $ToEmail ); // To:
	  $Mail->isHTML( TRUE );
	  $Mail->Body    = $MessageHTML;
	  //$Mail->AltBody = $MessageTEXT;
	  $Mail->Send();
	  $Mail->SmtpClose();
	
	  if ( $Mail->IsError() ) { // ADDED - This error checking was missing
	    return FALSE;
	  }
	  else {
	    return TRUE;
	  }
	}
?>