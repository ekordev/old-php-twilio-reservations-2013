<?php
	// put the approved request into the approved table
	function put_approvedRequest($domain, $json_file){
		include('DB/conn.php');
		$json		= json_decode( file_get_contents($json_file), true );
		$token		= $json["token"];
		$request	= $json["Request"];
		$patron		= $json["Patron"][0];
		$referrer	= $json["Referrer"][0];
		$status		= $json["Status"][0];

//		print_r($request);
//		print_r($referrer);

		// referrer - recipient
		$key_word	= $referrer["key_word"];
		$venue_id		= $referrer["venue_id"];
		$company_id	= $referrer["company_id"];
		$recipient_id	= $referrer["recipient_contact_id"];
		if( isset($status["referral_id"]) ){
			$referrer_id	= $status["referral_id"];
		}else{
			$referrer_id	= null;
		}
		// patron
		if( strlen($patron["id"]) > 1){
			// legit patron record - return basic info
			$patron_id = $patron["id"];
			$patron_name = $patron["full_name"];
			$patron_mobile = $patron["mobile_number"];
			$patron_email = $patron["email_address"];
			$num_gls	= $patron["guestlists"];
			if( strtolower($key_word) == "guestlist" ){ $num_gls = (int)$num_gls + 1; }
			$num_vip	= $patron["vip"];
			if( strtolower($key_word) == "tableservice" ){ $num_vip = (int)$num_vip + 1; }
			$num_data = null;
		}else{
			$patron_id = "new patron insert required";
			$patron_name = ucwords($request[0]);
			$patron_mobile = $json["From"];
			$patron_email = strtolower($request[4]);
			$num_data = 1;
			$num_gls = 0;
			$num_vip = 0;
		}
		// status
		if( strlen($status["referral_id"]) > 1){
			$referral_id	= $status["referral_id"];
			$status		= $status["referral_status"];
		}
		// request details
		$count = count($request);
		if( $count = 6){ // new patron
			$num_guests 		= $request[2];
			$request_date		= $request[3];
			$request_date		= date( "Y-m-d H:i:s.0000000 +00:00", strtotime($request_date) );
		}elseif($count = 4){ // existing patron
			$num_guests 		= $request[1];
			$request_date		= $request[2];
			$request_date		= date( "Y-m-d H:i:s.0000000 +00:00", strtotime($request_date) );
		}
		// when does the request expire?
		if( strpos($status, '11') !== False ){
			// cut this off at 11PM
			if( $count = 6){
				$expire_date 		= date('Y-m-d 23:00:00.0000000 +00:00', strtotime("$request[3]"));
			}elseif( $count = 4 ){
				$expire_date 		= date('Y-m-d 23:00:00.0000000 +00:00', strtotime("$request[2]"));
			}
		}
		if( strpos($status, 'All Night') !== False ){
			// cut this off at 4AM tomorrow
			if( $count = 6){
				$expire_date	= date('Y-m-d 04:00:00.0000000 +00:00', strtotime("$request[3] +1 days"));
			}elseif( $count = 4 ){
				$expire_date	= date('Y-m-d 04:00:00.0000000 +00:00', strtotime("$request[2] +1 days"));
			}
		}
		if( strlen($patron["id"]) == 1 ){
			// new user
			$tsql= "INSERT INTO [dbo].[crm_patrons] (
				patron_name,patron_email,ttl_data_points,ttl_vip_points,ttl_gl_points,white_list,black_list,
				create_date,patron_active,patron_dob,patron_mobile,patron_gender,key_code,company_id
				) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);
				SELECT convert(nvarchar(50),patron_id) AS [patron_id], convert(nvarchar(50), company_id) AS company_id from  [dbo].[crm_patrons]
				where convert(nvarchar(20),patron_mobile) = "  . $patron_mobile . ";";
			$params = array( $patron_name,$patron_email,$num_data,$num_vip,$num_gls,false,false,null,true,null,$patron_mobile,null,null,$company_id  );
			$stmt = sqlsrv_query($conn, $tsql, $params);
			$next_result = sqlsrv_next_result($stmt);
			if( $next_result ) {
			   while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
				  $rows[] = $row;
			   }
			} else {
				 die(print_r(sqlsrv_errors(), true));
			}
			print_r( $rows );
			echo "\n";
			$patron_id = $rows[0]["patron_id"];
			$company_id = $rows[0]["company_id"];
		}
		// now insert the new reservation
		$tsql = "";
		$tsql = "INSERT INTO dbo.rms_reservations (
           patron_id,company_id,venue_id,referral_id,recipient_id,request_date,expire_date,num_guests) VALUES (?,?,?,?,?,?,?,?)";
		$vars = array( $patron_id,$company_id,$venue_id,$referral_id,$recipient_id,$request_date,$expire_date,$num_guests );
		if ( !sqlsrv_query($conn, $tsql, $vars) ) {
			$response = array(
				array(
					"error"=> true,
					"msg"=> json_encode( var_dump( $vars ), true ),
				),
			);
		}else{
			$response = array(
				array(
					"error" => false,
				),
			);
		}
		// unlink($json_file);
	}
