<?php
/* email to guest list managers */
	function email_Request( $json_file, $domain, $venue, $patron, $referrer, $email_approved, $cipher, $referral_status, $is_approved, $venue_email, $keyword_list, $vip_list ){
		$json			= json_decode( file_get_contents($json_file), true );
		$sms_type	= strtolower($json["Sms"]);
		$Id				= $json["token"];
		$data			= $json["Request"];

		echo "\n";
		print_r( $json );

		echo "\n referral_status: " . $referral_status[0]["referral_status"];

		if( isset($referral_status[0]["referral_status"]) ){
			if( $referral_status[0]["referral_status"] == "Valid All Night" ){
				$is_approved = 1;
				$email_approved = "Valid All Night";
			}elseif( $referral_status[0]["referral_status"] == "Valid Until 11 PM" ){
				$is_approved = 1;
				$email_approved = "Valid Until 11 PM";
			}elseif( $referral_status[0]["referral_status"] == "Valid Until Midnight" ){
				$is_approved = 1;
				$email_approved = "Valid Until Midnight";
			}elseif( $referral_status[0]["referral_status"] == "Pending" ){
				$is_approved = 0;
				$email_approved = "Pending";
			}else{
				$is_approved = 0;
				$email_approved = "Pending";
			}
		}else{
			$is_approved = 0;
			$email_approved = "Pending";
		}

		echo "\n msg: " . $email_approved;
		echo "\n status: " . $is_approved;
		echo "\n";

		$approval_status = [
			"status" => $is_approved,
			"msg"=> $email_approved,
		];
		$json			= json_decode(file_get_contents($json_file), true);
		array_push($json["Referrer"], $referrer[0] );
		array_push($json["Status"], $referral_status[0]);
		array_push($json["Approved"], $approval_status);
		file_put_contents( $json_file, json_encode($json) );

		// the request keycode, keyword, and venue
		if( strlen($patron[0]["id"]) > 1 ){
			// existing patron
			$request_type = strtoupper($data[3]);
			$key_code = strtok( strtolower($data[3]), " " );
			$key_word = str_replace( $key_code . " ", "", strtolower($data[3]) );
			$key_venue = strtolower($data[0]);
			$guest_name = $patron[0]["full_name"];
			$guest_email = $patron[0]["email_address"];
			$guest_mobile = $patron[0]["mobile_number"];
		}else{
			// new patron
			$request_type = strtoupper($data[5]);
			$key_code = strtok( strtolower($data[5]), " " );
			$key_word = str_replace( $key_code . " ", "", strtolower($data[5]) );
			$key_venue = strtolower($data[1]);
			$guest_name = $data[0];
			$guest_email = $data[4];
			$guest_mobile = $json["From"];
		}

		$key_tag = str_replace( " ", "", strtolower($key_word) );
		if( strlen($key_tag) == 0 ){
			if( strlen($patron[0]["id"]) > 1 ){
				$key_tag = strtolower($data[3]);
			}else{
				$key_tag = $strtolower($data[5]);
			}
		}
		switch($key_tag){
			case "guestlist": $contact_tag = "guest"; $definition = "GUEST LIST"; break;
			case "tableservice": $contact_tag = "table"; $definition = "VIP TABLE SERVICE"; break;
		}

		if( strlen($patron[0]["id"]) > 1 ){
			// existing patron
			$request_venue		= htmlspecialchars( ucwords($data[0]), ENT_QUOTES );

			$request_name		= htmlspecialchars( $patron[0]["full_name"], ENT_QUOTES );
			$request_email		= htmlspecialchars( $patron[0]["email_address"], ENT_QUOTES );

			$request_guests	= htmlspecialchars( $data[1], ENT_QUOTES );
			$request_date		= htmlspecialchars( date('M d', strtotime($data[2])), ENT_QUOTES );
			$request_mobile	= $patron[0]["mobile_number"];
		}else{
			// new patron
			$request_venue		= htmlspecialchars( $data[1], ENT_QUOTES );

			$request_name		= htmlspecialchars( $data[0], ENT_QUOTES );
			$request_email		= htmlspecialchars( $data[4], ENT_QUOTES );

			$request_guests	= htmlspecialchars( $data[2], ENT_QUOTES );
			$request_date		= htmlspecialchars( date('M d', strtotime($data[3])), ENT_QUOTES );
			$request_mobile	= format_phone($json["From"]);
		}
		$requested_on	= $json["Request_Date"];
		$request_domain	= $json["Domain"];
		// request
		$email_request = "<p>" . $request_type;
		$email_request .= "<br><strong>Guest:</strong> " . $request_name;
		$email_request .= "<br><strong>Mobile: </strong>" . $request_mobile;
		$email_request .= "<br><strong>Email: </strong>" . $request_email;
		$email_request .= "<br><strong>Guests: </strong>" . $request_guests;
		$email_request .= "<br><strong>Date: </strong>" . $request_date . "</p>";
		$email_request .= "<p><strong>Request </strong>" . $email_approved . "</p><p>&nbsp;</p>";
		// recipient
		$email_recipient = "<p><strong>Send To: </strong>" . $referrer[0]['recipient_title'];
		$email_recipient .= "<br><strong>Name: </strong>" . $referrer[0]['recipient_name'];
		$email_recipient .= "<br><strong>Mobile: </strong>" . format_phone($referrer[0]["recipient_mobile"]);
		$email_recipient .= "<br><strong>Email: </strong>" . $referrer[0]['recipient_email'] . "</p><p>&nbsp;</p>";
		$recipient_venue = ucwords($referrer[0]["key_venue"]);
		// referrer
		if( $referrer[0]["referral_name"] == "{guest_name}"){
			$email_referral = "Self Referred";
		}else{
			$email_referral = "<p><strong>Referred By: </strong>" . $referrer[0]['referral_name'];
			$email_referral .= "<br><strong>Mobile: </strong>" . format_phone($referrer[0]["referral_mobile"]);
			$email_referral .= "<br><strong>Email: </strong>" . $referrer[0]['referral_email'] . "</p><p>&nbsp;</p>";
		}

		// encrypt the callback string for the management of this request
		$manageRedirect = "puid=" . $Id;
		$reviewRedirect = "puid=" . $Id;
//		$encryptUrl = $cipher->encrypt( $manageRedirect );

		$emailFriendlyName = $recipient_venue . " " . $definition . " Request";
		$emailFromAddress = $venue_email;
//		$emailFromAddress = "queensrepublic@ireserv.it";
		$emailFromPwd = "DonnellyGroup#1";
		// html string
		$html = '<div id="gl_info">';
		$html .= '<h3>' . $emailFriendlyName . '</h3>';
		$html .= $email_recipient;
//		$html .= $email_referral;
		$html .= $email_request;
		// deal with the dynamic BIT.LY URL
//		if( $is_approved == 0){
//			$html .= '<p><a title="approve request" href="' . CONFIRM_URL . '?' .$manageRedirect . '"> Manage </a>';
//		}else{
//			$html .= '<p><a title="review request" href="' . CONFIRM_URL . '?' .$reviewRedirect . '"> Review </a>';
//		}
		$html .= '</div>';

//		print($html);
		// create & send the email
		$mail	= new PHPMailer();
		$body	= $html;

		$mail->IsSMTP();
		$mail->SMTPAuth		= true;
		$mail->Host				= "127.0.0.1";
		$mail->SMTPDebug	= 0;
		$mail->Port				= 25;
		$mail->Username		= $emailFromAddress;
		$mail->Password		= $emailFromPwd;
		$mail->SetFrom( $emailFromAddress,  $emailFriendlyName );
		$mail->Subject			= "re: " . $emailFriendlyName;
		$mail->MsgHTML($body);

		$address					= $emailFromAddress;
//			$mail->AddAddress("jjramendham@gmail.com");
			$mail->AddAddress("cc@donnellygroup.ca");
			$mail->AddAddress( $emailFromAddress );
			$mail->AddAddress( $venue_email );

		if(!$mail->Send()) {
			echo $mail->IsSMTP();
			echo "Mailer Error: " . $mail->ErrorInfo;
		}

		if($is_approved == 1){
			// add to the database
			put_approvedRequest($domain, $json_file);
		}else{
			// move the file
			$date = new DateTime();
			$result = 'pending/' . $json["token"];
			$file = $json_file;
			echo "\n" . $result . "\n";
			echo "\n" . $file ."\n";
			$newfile = str_replace($json["token"], $result, $file);
			if (!copy($file, $newfile)) {
				echo "failed to copy $file...\n";
				echo "\n" . $newfile . "\n";
			}else{
				echo "\n" . $newfile . "\n";
					unlink( $json_file );
			}
			session_destroy();
			$_SESSION = array();
		}
	}
