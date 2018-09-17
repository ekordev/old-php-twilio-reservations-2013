<?php
/********** create the Json File **********/
	function create_userJson($current_step, $counter, $token, $to, $from, $date, $time, $sms, $domain, $request, $comma, $patron, $cipher){
		$patron = $patron;
		$json_path	= 'sms/'.$domain.'/';
		$json_file		= $json_path . $token . ".json";
		// create the json array request
		// test to see if its a csv
		if( $comma == 0 ){
			$insert = array( $request );
		}else{
			$insert = str_getcsv($request,",");
			$current_step++;
		}

		$referrer = [];
		$referral_status = [];
		$approval_status = [];

		$sms = "true";

		// create the json file
		$data =  array(
				"token"					=>	$token,
				"session_id"			=>	session_id(),
				"counter"				=>	$counter,
				"current_step"		=>	$current_step,
				"From"					=>	$from,
				"To"						=>	$to,
				"Domain"				=>	$domain,
				"Sms"					=>	$sms,
				"Request_Date"		=>	$date,
				"Request_Time"	=>	$time,
				"Request"				=>	$insert,
				"Patron"				=>	$patron,
				"Referrer"				=>	$referrer,
				"Status"				=>	$referral_status,
				"Approved"			=> 	$approval_status,
		);
		// this is the first step
		if( !file_exists($json_file) ) {
			file_put_contents($json_file, json_encode($data));
		}else{ // this file already exists
			$json	= json_decode(file_get_contents($json_file), true);
			$json_length = count($json["Request"]);
//			echo "<br> json_length: " . $json_length;
//			echo "<br>push_array: <pre>";
//			print_r($json["Request"]);
//			echo "</pre>";
			array_push( $json["Request"], $request );
//			echo "<br>new_array: <pre>";
//			print_r($json);
//			echo "<br>";
			file_put_contents( $json_file, json_encode($json) );
		}
	}
