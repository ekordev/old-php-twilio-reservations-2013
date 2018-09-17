<?php
/********** return the twilio sms response text **********/
	function twilio_sms_response($steps, $domain, $token, $from, $patron, $cipher){
		$twilio_msg		= "";
		$json_path		= 'sms/'.$domain.'/';
		$json_file		= $json_path . $token . ".json";
		$json			= json_decode(file_get_contents($json_file), true);
		$sms_type	= strtolower($json["Sms"]);
		$json_length	= count($json["Request"]);
		$json_length	= $json_length - 1;
		$json_steps		= count($steps) - 1;

		if( $json_length == $json_steps ){
			// we are on the last step
			$lastStep = 1;
			$keyword = $json["Request"][0];
			array_shift( $json["Request"] );
			array_push($json["Request"],$keyword);
			file_put_contents( $json_file, json_encode($json) );
			// return final sms message
			$json2 = json_decode(file_get_contents($json_file), true);
			$count2 = count($json["Request"]) - 1;
			$last_msg = strtok( strtolower($json["Request"][$count2]), " " );
			if( strpos(strtolower($last_msg), "bn") !== False || strpos(strtolower($last_msg), "qr") !== False || strpos(strtolower($last_msg), "kj") !== False  ){
				// grab the key_code
				$twilio_msg = "Your request has been received, and valid until 11 PM.";
			}else{
				$twilio_msg = $steps[$json_length]["step_question"];
			}
			if( strpos($twilio_msg, '{guest}') !== False ){
				// insert guest name;
				if( strlen($patron[0]["id"]) > 1){ $insert_guest = $json["Patron"][0]["first_name"]; }else{ $insert_guest = strtok($json["Request"][0], " "); }
				$twilio_msg = str_replace( "{guest}", $insert_guest, $twilio_msg );
			}

			if( strpos($twilio_msg, '{venue}') !== False ){
				if( strlen($patron[0]["id"]) > 1){
						$insert_venue = $json["Request"][0];
				}else{
						$insert_venue = $json["Request"][1];
				}
				$twilio_msg = str_replace( "{venue}", $insert_venue, $twilio_msg );
			}

			if(!isset($insert_venue)){ $insert_venue = "killjoy"; }

			// sms the request
			sms_Request( $json_file, $domain, $insert_venue, $patron, $cipher );
			// now insert into the database
//			data_Insert($json_file, $patron);
		}else if( $json_length < $json_steps ){
			// return sms message
			if( @$steps[$json_length]["step_question"] ){
				$twilio_msg = $steps[$json_length]["step_question"];
				if( strpos($twilio_msg, '{guest}') !== False ){
					// insert guest name;
					if( strlen($patron[0]["id"]) > 1){ $insert_guest = $json["Patron"][0]["first_name"]; }else{ $insert_guest = $json["Request"][1]; }
					$twilio_msg = str_replace( "{guest}", $insert_guest, $twilio_msg );
				}
			}else{
				$list = $_SESSION["keywords"];
				$i = count($list)-1;
				$twilio_msg = "Please text ";
				for($j = 0; $j <= $i; $j++){
					if($j == $i){
						$twilio_msg .= " or " . $list[$j]["sms_keyword"];
					}else{
						$twilio_msg .= $list[$j]["sms_keyword"] . ", ";
					}
				}
				$twilio_msg .= " for a quick connect!";
				session_destroy();
				$past = time() - 3600;
				foreach ( $_COOKIE as $key => $value ){
					setcookie( $key, $value, $past, '/' );
				}
			}
		}

		// send client sms message
		$sid = TWILIO_SID;
		$token = TWILIO_AUTH_TOKEN;
		$client = new Services_Twilio($sid, $token);

		if( $json_length == $json_steps ){
			$data = $json['Request'];
			if( strlen($patron[0]["id"]) > 1 ){
				$venue = $data[0];
			}else{
				$venue = $data[1];
			}
			if($sms_type == 'openhouse'){
				$venue = "killjoy";
			}
			$url = json_decode( get_shortUrls( $domain, $venue ), true );
			$short_url = $url[0]["short_url"];
			$friendly_name = $url[0]["venue_name"];

			$sms_type = strtolower( $json["Sms"] );
			switch( $sms_type ){
				case "openhouse";
					$twilio_advert = "\n View Killjoy events --> http://j.mp/18gcXGs";
				break;
				default:
					$twilio_advert = "\n View " . $friendly_name . " events --> " . $short_url;
			}

//			$twilio_MediaUrl = CONFIRM_URL . "lib/sms/advert/Killjoy_Yelloween_DonnellyWeb291x450.jpg";
//			$twilio_MediaTrailer = "Order KillJoy Halloween Tickets!! \n http://tinyurl.com/halloween-at-killjoy";

//			$message = $client->account->messages->sendMessage("+14158141829", "+15558675309", "Jenny please?! I love you <3", "http://www.example.com/hearts.png");
			$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, $from, $twilio_msg, null);
			$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, $from, $twilio_advert, null);
//			$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, $from, $twilio_MediaTrailer, $twilio_MediaUrl );
		}else{
			$message = $client->account->messages->sendMessage( TWILIO_SMS_NUMBER, $from, $twilio_msg, null );
		}
	}
