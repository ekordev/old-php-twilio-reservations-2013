<?php
	function put_approvedRequest($domain, $json_file){
		include('DB/conn.php');
		$json		= json_decode( file_get_contents($json_file), true );
		$token		= $json["token"];
		$sms_type= strtolower($json["Sms"]);
		$request	= $json["Request"];
		$patron		= $json["Patron"][0];
		$referrer	= $json["Referrer"][0];
		$status		= $json["Status"][0];
		$approval	= $json["Approved"][0];

//		print_r( $json );
//		echo "\n ";

		// ALL INSERTS
		$creation_date 	= $json["Request_Date"];
		$creation_date		= date( "Y-m-d H:i:s", strtotime($creation_date) );
		$company_id 	= $referrer["company_id"];
		$venue_id			= $referrer["venue_id"];
		$referral_id		= $status["referral_id"];
		$recipient_id		= $referrer["recipient_contact_id"];
		// NEW USER INSERTS
		if( strlen($patron["id"]) == 1 ){
			$patron_name	= ucwords( $request[0] );
			$patron_email	= strtolower( $request[4] );
			$ttl_data			= 1;
			$ttl_vip				= 0;
			$ttl_gl				= 0;
			$white_list			= false;
			$black_list		= false;
			$patron_active	= true;
			$patron_dob		= null;
			$patron_mobile	= $json["From"];
			$patron_gender	= 0;
			$key_code		= null;
			$company_id		= $company_id;
			$sms_request	= strtoupper($request[5]);
			$num_guests 	= $request[2];
			$request_date	= $request[3];
			// reservation data
			$start_date		= date( "Y-m-d 18:00:00", strtotime($request_date) );
			if(!isset($status["referral_status"])){
				$unix_time = strtotime($start_date);
				$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
			}else{
				switch($status["referral_status"]){
					case "Valid Until 11 PM":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
					break;
					case "Valid Until Midnight":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+6 hours', $unix_time ));
					break;
					case "Valid All Night":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+9 hours', $unix_time ));
					break;
					default:
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
				}
			}
			// update the anonomous stats on the referral table
			$updTable		= "[dbo].[tt_referrals]";
			$updCon		= "referral_shortcode";
			$updParam	= "'" . $referrer["referral_keycode"] . "'";
			$updField		= "referral_count";
			$updVal		= "((SELECT referral_count FROM [dbo].[tt_referrals] ";
			$updVal		.= "WHERE referral_shortcode = '";
			$updVal		.= $referrer["referral_keycode"] . "')+1)";

		}elseif( strlen($patron["id"]) > 1 ){
			$patron_id			= $patron["id"];
			$ttl_data			= 1;
			$ttl_gl				= (int)$patron["guestlists"]+1;
			$ttl_vip				= (int)$patron["vip"]+1;
			$num_guests	= $request[1];
			$request_date	= $request[2];
			$sms_request	= $request[3];
			$start_date		= date( "Y-m-d 18:00:00", strtotime($request_date) );
			if(!isset($status["referral_status"])){
				$unix_time = strtotime($start_date);
				$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
			}else{
				switch($status["referral_status"]){
					case "Valid Until 11 PM":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
					break;
					case "Valid Until Midnight":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+6 hours', $unix_time ));
					break;
					case "Valid All Night":
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+9 hours', $unix_time ));
					break;
					default:
						$unix_time = strtotime($start_date);
						$end_date = date('Y-m-d H:i:s', strtotime( '+5 hours', $unix_time ));
				}
			}
			echo "\n Creation Date: " . $creation_date;
			echo "\n referral_status: " . $status["referral_status"];
			echo "\n Start Date: " . $start_date;
			echo "\n End Date: " . $end_date;
			echo "\n ";

			switch( $patron["is_contact"]){
				case "0": // patron
					// update patron metrics
					switch( strtolower($referrer["key_word"]) ){
						case "guestlist":
							$updTable		= "[dbo].[crm_patrons]";
							$updCon		= "CONVERT(NVARCHAR(50), patron_id)";
							$updParam	= "'" . $patron["id"] . "'";
							$updField		= "ttl_gl_points";
							$updVal		= (int)$patron["guestlists"] + 1;
						break;
						case "tableservice":
							$updTable		= "[dbo].[crm_patrons]";
							$updCon		= "CONVERT(NVARCHAR(50), patron_id)";
							$updParam	= "'" . $patron["id"] . "'";
							$updField = "ttl_vip_points";
							$updVal = (int)$patron["vip"] + 1;
						break;
					}
				break;
				case "1": // contact
					// update referrer metrics
					$contact_id		= $referrer["referral_contact_id"];
					switch( strtolower($referrer["key_word"]) ){
						case "guestlist":
							$updTable		= "[dbo].[crm_contacts]";
							$updCon		= "CONVERT(NVARCHAR(50), contact_id)";
							$updParam	= "'" . $patron["id"] . "'";
							$updField	= "ttl_gl_points";
							$updVal	= (int)$patron["guestlists"] + 1;
						break;
						case "tableservice":
							$updTable		= "[dbo].[crm_contacts]";
							$updCon		= "CONVERT(NVARCHAR(50), contact_id)";
							$updParam	= "'" . $patron["id"] . "'";
							$updField = "ttl_vip_points";
							$updVal = (int)$patron["vip"] + 1;
						break;
					}
				break;
			}
		}

		if( strlen($patron["id"]) == 1 ){
			// new user
			$tsql= "INSERT INTO [dbo].[crm_patrons] (
						patron_name,patron_email,ttl_data_points,ttl_vip_points,ttl_gl_points,white_list,black_list,
						create_date,patron_active,patron_dob,patron_mobile,patron_gender,key_code,company_id
						) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?); SELECT convert(nvarchar(50),patron_id) AS [patron_id] from  [dbo].[crm_patrons] where convert(nvarchar(20),patron_mobile) = "  . $patron_mobile . ";";
			$params = array( $patron_name,$patron_email,1,$ttl_vip,$ttl_gl,false,false,$creation_date,true,null,$patron_mobile,null,null,$company_id  );
			$stmt = sqlsrv_query($conn, $tsql, $params);
			$next_result = sqlsrv_next_result($stmt);
			if( $next_result ) {
			   while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
				  $rows[] = $row;
			   }
			} else {
				 die(print_r(sqlsrv_errors(), true));
			}
//			echo "line: 179";
//			print_r( $rows );
			$patron_id = $rows[0]["patron_id"];
//			echo "\n patron_id: " . $patron_id;
		}

		if( $approval["status"] == 1 ){
			if( $company_id != "" || $venue_id != ""){
				$approval_status = $approval["status"];
				// now insert the new reservation
				$tsql1 = "INSERT INTO [dbo].[rms_reservations] (patron_id, company_id, venue_id, referral_id, recipient_id, start_date, end_date, num_guests, is_approved, sms_request, check_in, checkin_date, create_date ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); UPDATE " . $updTable . " SET " . $updField . " = " . $updVal . " WHERE " . $updCon . " = " . $updParam . ";";
//				echo "\n line 180";
//				echo "\n" . $tsql1;
				$params1 = array(
											array( $patron_id, null )
											, array( $company_id, null )
											, array( $venue_id, null )
											, array( $referral_id, null )
											, array( $recipient_id, null )
											, array( $start_date, null, null, SQLSRV_SQLTYPE_DATETIME )
											, array( $end_date, null, null, SQLSRV_SQLTYPE_DATETIME )
											, array( $num_guests, null, null, SQLSRV_SQLTYPE_TINYINT )
											, array( $approval_status, null, null, SQLSRV_SQLTYPE_TINYINT )
											, array( strtoupper($sms_request), null )
											, array( null, null )
											, array( null, null, null, SQLSRV_SQLTYPE_DATETIME )
											, array( $creation_date, null, null, SQLSRV_SQLTYPE_DATETIME )
				);
//				echo "\n";
//				print_r($params1);
//				echo "\n";
				$stmt1 = sqlsrv_query($conn, $tsql1, $params1);
				if( !$stmt1 ) {
//					echo "\n line 202";
					die( print_r( sqlsrv_errors(), true));
//					echo "\n";
				}
				$next_result1 = sqlsrv_next_result($stmt1);
				if( !$next_result1 ) {
//					echo "\n line 209";
					die( print_r( sqlsrv_errors(), true));
				}else{
				   while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC)){
					  $rows[] = $row1;
//					  print_r($rows);
				   }
				}

				sqlsrv_free_stmt($stmt1);
				sqlsrv_close($conn);
				// move the file
				$date = new DateTime();
				$result = 'approved/' . $token;
				$file = $json_file;
				echo $result . "\n";
				echo $file ."\n";
				$newfile = str_replace($json["token"], $result, $file);

				if (!copy($file, $newfile)) {
					echo "failed to copy $file...\n";
//					echo $newfile . "\n";
				}else{
//					echo $newfile . "\n";
					unlink( $json_file );
				}
			}
		}
		session_destroy();
		$_SESSION = array();
	}
