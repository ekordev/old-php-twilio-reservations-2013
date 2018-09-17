<?php
/* get guest date */
	function get_dateRequest( $guest_date, $domain, $json_file){
		$guest_date = strtolower( $guest_date );
		$today = new DateTime( "today", new DateTimeZone( 'America/Vancouver'));
		// today
		if( strpos($guest_date, 'now') !== False || strpos($guest_date, 'tonight') !== False || strpos($guest_date, 'today') !== False ){
			$guest_date = $today;
		// tomorrow
		}elseif( strpos($guest_date, 'tomorrow') !== False ){
			$guest_date = new DateTime('tomorrow');
		// this thursday
		}elseif( strpos($guest_date, 'thursday') !== False || strpos($guest_date, 'thurs') !== False ){
			// find thurs date from today
			$guest_date = new DateTime('next thursday');
		// this friday
		}elseif( strpos($guest_date, 'friday') !== False || strpos($guest_date, 'fri') !== False ){
			// find friday's date from today
			$guest_date = new DateTime('next friday');
		// this saturday
		}elseif( strpos($guest_date, 'saturday') !== False ||  strpos($guest_date, 'sat') !== False){
			$guest_date = new DateTime('next saturday');
		// user selected date
		}else{
			$date = date_parse($guest_date);
			if (checkdate($date["year"], $date["month"], $date["day"])){
//				echo "Valid date";
				$guest_date = str_replace('/', '-', $guest_date);
				$guest_date = str_replace('/', '-', $guest_date);
				$guest_date = $guest_date . " 18:00:00";
				$guest_date = new DateTime($guest_date);
			}else{
				// parse out the json file
				$json_path	= 'sms/' . $domain . '/';
				$json_file		= $json_path . $token . ".json";
				$json			= json_decode(file_get_contents($json_file), true);
				$guest_date = date( "Y-m-d H:i:s", strtotime($today) );
			}
		}
		$rtn = $guest_date->format('Y-m-d H:i:s');
		return $rtn;
	}
/* sms to guest list managers */
	function sms_Request( $json_file, $domain, $venue, $patron, $cipher ){
		$json = json_decode(file_get_contents($json_file), true);
		$sms_type = strtolower( $json["Sms"] );
		$patron = $json["Patron"];
		$request = $json["Request"];

		echo "\n";
		print_r( $json );
		echo "\n";

		// the request keycode, keyword, and venue
		if( strlen($patron[0]["id"]) > 1 ){
			// existing patron
			$request_type = strtoupper($request[3]);
			$key_code = strtok( strtolower($request[3]), " " );
			$key_word = str_replace( $key_code . " ", "", strtolower($request[3]) );
			$key_venue = strtolower($request[0]);

			if( $patron[0]["full_name"] == "{guest_name}" ){
				$guest_name = "";
				$guest_email = "";
				$guest_mobile = "";
			}else{
				$guest_name = $patron[0]["full_name"];
				$guest_email = $patron[0]["email_address"];
				$guest_mobile = $patron[0]["mobile_number"];
			}
		}else{
			// new patron
			$request_type = strtoupper($request[5]);
			$key_code = strtok( strtolower($request[5]), " " );
			$key_word = str_replace( $key_code . " ", "", strtolower($request[5]) );
			$key_venue = strtolower($request[1]);
			$guest_name = ucwords($request[0]);
			$guest_email = strtolower($request[4]);
			$guest_mobile = $json["From"];
		}

		echo "\n line 82";
		echo "\n request_type: " . $request_type;
		echo "\n key_code: " . $key_code;
		echo "\n key_word: " . $key_word;
		echo "\n key_venue: " . $key_venue;
		echo "\n";

		$key_tag = str_replace( " ", "", strtolower($key_word) );
		if( strlen($key_tag) == 0 ){
			if( strlen($patron[0]["id"]) > 1 ){
				$key_tag = strtolower($request[3]);
			}else{
				$key_tag = $strtolower($request[5]);
			}
		}

		echo "\n line 91: ";
		echo "key_tag: " . $key_tag;

		switch($key_tag){
			case "guestlist":
				$key_word = "guestlist";
				$contact_tag = "guest";
				$definition = "GUEST LIST";
				$key_venue = strtolower($key_venue);
			break;
			case "tableservice":
				$key_word = "tableservice";
				$contact_tag = "table";
				$definition = "VIP TABLE SERVICE";
				$key_venue = strtolower($key_venue);
				break;
		}
		// pull the sms forwarding information
		echo "\n patron: \n";
		print_r($patron);
		$referrer = json_decode(get_smsRequestForwarding($key_code, $key_word, $key_venue, $contact_tag), true);
		echo "\n referrer: \n";
		print_r($referrer);
		// determine the referrer information
		if( $referrer[0]["referral_name"] == "{guest_name}"){ // this is a self referred request
			// referral
			$referral_keycode = "";
			$referral_name = $guest_name;
			$referral_email = $guest_email;
			$referral_mobile = format_phone($guest_mobile);
		}else{ // keycode request
			// referral
			if( strtolower($key_code) == 'qr' || strtolower($key_code) == 'bn' || strtolower($key_code) == 'kj' || strtolower($key_code) == 'wgyc' ){
				$referral_keycode = $referrer[0]["referral_keycode"];
				$referral_name = $guest_name;
				$referral_email = $guest_email;
				$referral_mobile = $guest_mobile;
			}else{
				$referral_keycode = $referrer[0]["referral_keycode"];
				$referral_name = ucwords($referrer[0]["referral_name"]);
				$referral_email = strtolower($referrer[0]["referral_email"]);
				$referral_mobile = $referrer[0]["referral_mobile"];
			}
		}
		// return the receipt mobile number and email
		$venue_mobile	= $referrer[0]["venue_mobile"];
		$venue_email	= $referrer[0]["venue_email"];
		// recipient
		$recipient_keycode = $referrer[0]["recipient_keycode"];
		$recipient_title = ucwords($referrer[0]["recipient_title"]);
		$recipient_name = ucwords($referrer[0]["recipient_name"]);
		$recipient_email = strtolower($referrer[0]["recipient_email"]);
		$recipient_mobile = $referrer[0]["recipient_mobile"];

		// retrieve user data
		if( strlen($patron[0]["id"]) > 1 ){
			// existing patron data
			$guest_keycode = $patron[0]["key_code"];
			$guest_guests = $request[1];
			$guest_venue = $request[0];
			$guest_date		= strtolower($request[2]);
			$guest_date = get_dateRequest( $guest_date, $domain, $json_file);
			$json["Request"][2] = $guest_date;
			file_put_contents( $json_file, json_encode($json) );
		}else{
			// new patron data
			$guest_keycode = "";
			$guest_guests = $request[2];
			$guest_venue = $request[1];
			$guest_date		= $request[3];
			$guest_date = get_dateRequest( $guest_date, $domain, $json_file);
			$json["Request"][3] = $guest_date;
			file_put_contents( $json_file, json_encode($json) );
		}
		$display_date = str_replace("00:00:00", "", $guest_date);
		$display_date = new DateTime($display_date);
		$display_date = $display_date->format('Y-m-d h:i:s');
		echo "\n display_date: " . $display_date . "\n";

		$sms_request = "Guest: " . ucwords($guest_name);
		$sms_request .= "\nMobile: " . format_phone($guest_mobile);
		$sms_request .= "\nEmail: " . strtolower($guest_email);
		$sms_request .= "\nVenue: " . ucwords($guest_venue);
		$sms_request .= "\nGuests: " . $guest_guests;
		$sms_request .= "\nDate: " . date('M d', strtotime($display_date));
		// recipient
		$sms_recipient = "Send To: " . ucwords($recipient_title);
		$sms_recipient .= "\nName: ". ucwords($recipient_name);
		$sms_recipient .= "\nMobile: " . format_phone($recipient_mobile);
		$sms_recipient .= "\nEmail: " . strtolower($recipient_email);
		// is approved
		$is_approved = null;
		$approval = null;
		$referral_status = get_ReferralStatus( $key_code );
//		print_r( $referral_status );
		// this is a hack to for the key_words
		$keyword_list = ['qr','bn','kj','fb','hush','insta','tw','wgyc'];
		$vip_list = ['cc','bm','ji','db','mc','ac','jy','wv','jo','ps','da'];
		if( $contact_tag == "tableservice"){
			$approval = "Pending";
		}elseif( $contact_tag == "guestlist"){
			if(in_array( strtolower($key_code), $keyword_list, true) ){
				if( strtolower($key_code) == 'qr' || strtolower($key_code) == 'bn' || strtolower($key_code) == 'kj' || strtolower($key_code) == 'wgyc' ){
					if( strtolower($key_code) == 'wgyc' ){
						$approval = strtoupper($key_code) . " Promotion.";
						$approval .= "\nValid Until Midnight";
					}else{
						$approval = strtoupper($key_code) . " Promotion.";
						$approval .= "\nValid Until 11 PM";
					}
				}else{
					$approval = strtoupper($key_code) . " Referral.";
					$approval .= "\nValid Until 11 PM";
				}
			}elseif(in_array( strtolower($key_code), $vip_list, true) ){
				$approval = strtoupper($key_code);
				$approval .= "\nValid All Night - " . $display_date;
			}elseif( strtolower($key_code) == strtolower($key_word) ){
				$approval = "Pending";
			}else{
				$approval = "Pending";
			}
		}else{
			if( strlen($patron[0]["id"]) == 1 ){
				// HARDED CODED HACK FOR STREET TEAMS
				if(in_array( strtolower($key_code), $keyword_list, true) ){
					if( strtolower($key_code) == 'wgyc' ){
						$approval = strtoupper($key_code) . " Promotion.";
						$approval .= "\nValid until Midnight" . $display_date;
					}else{
						$approval = strtoupper($key_code) . " Promotion.";
						$approval .= "\nValid Until 11 PM";
					}
				}elseif(in_array( strtolower($key_code), $vip_list, true) ){
					$approval = strtoupper($key_code);
					$approval .= "\nValid All Night - " . $display_date;
				}elseif( strtolower($key_code) == strtolower($key_word) ){
					$approval = "Pending";
				}else{
					$approval = "Pending";
				}
			}else{
				if( strlen($referral_status[0]["referral_id"]) > 1){
					if( strtolower($referrer[0]["referral_keycode"]) == strtolower($key_code) ){
						$approval = $referral_status[0]["referral_status"];
					}elseif( strtolower($referrer[0]["recipient_keycode"]) == strtolower($key_code) ){
						$approval = $referral_status[0]["referral_status"];
					}else{
						$approval = "Pending";
					}
				}elseif( strtolower($key_code) == strtolower($key_word) ){
					$approval = "Pending";
				}else{
					$approval = "Pending";
				}
			}
		}

		// email approval
		$email_approved = $approval;

		if( $email_approved == "Pending" ){
			$is_approved = 0;
		}else{
			$is_approved = 1;
		}

		// referred_by
		if(!strtolower($key_code) == "guestlist" || !strtolower($key_code) == "tableservice"){
			$sms_referral = "Self Referred";
			$sms_referral .= $approval;
		}else{
			if(!strtolower( $referrer[0]["referral_keycode"] ) == ""){
				$sms_referral = "Referral: " . ucwords($referral_name);
				$sms_referral .= $approval;
			}
		}

		// sms send request
		$sentBy = "";
		$sentBy .= "\n" . $sms_request;
//		$sentBy .= "\nApproval: " . $approval;
		print($sentBy);
//		echo "\n";
//		echo "\n";
		// sms send recipient
		$sendTo = "";
		$sendTo .= $sms_recipient;
//		print($sendTo);
//		echo "\n";
		// sms referred by
		$referredBy = "";
		$referredBy .= $sms_referral;
//		print($referredBy);
//		echo "\n";
		/* test character length - if > 160 send generic message
		if( strlen($str) > 1600 ){
			$str = 'Guestlist details from ' . $json["From"] . ' exceed the character limit. Please check your email.';
		}
		*/
		$sid = TWILIO_SID;
		$token = TWILIO_AUTH_TOKEN;
		$client = new Services_Twilio($sid, $token);

		switch( strtolower($guest_venue) ){
			case "barnone":
				$venue_mobile = "7788758339";
				$venue_email = "barnone@ireserv.it";
			break;
			case "killjoy":
				$venue_mobile = "7788799618";
				$venue_email = "killjoy@ireserv.it";
			break;
			default: // assume queens republic
				$venue_mobile = "7788756963";
				$venue_email = "queensrepublic@ireserv.it";
		}
		$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, $venue_mobile, $sentBy, null ); // send to glist girl
		$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, "7788225850", $sentBy, null ); // Carissa Campeotto
		$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, "6047215474", $sentBy, null ); // James Van Leuven

		email_Request( $json_file, $domain, $venue, $patron, $referrer, $email_approved, $cipher, $referral_status, $is_approved, $venue_email, $keyword_list, $vip_list );
	}
