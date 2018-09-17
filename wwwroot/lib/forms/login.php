<?php
	session_start();
	// constants
	include('DB/constants.php');
	include('DB/_cipher.php');

	$json 		= json_decode($_POST["data"], true);
	$mobile 	= $json['tel'];
	$password	= $json['pwd'];

	header('Content-type: application/json');
	print( json_encode( get_UserLogin($mobile, $password) ) );
/********************************* GET USER LOGIN *********************************/
	function get_UserLogin($mobile, $password){
		include('DB/conn.php');

		$tsql 		= ('{ CALL get_userLogin(?,?) }');
		$params		= array(
						array(utf8_encode($mobile),SQLSRV_PARAM_IN)
						, array(utf8_encode($password),SQLSRV_PARAM_IN)
					);

//		print_r($params);

		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
//				$rows[] = $row;
				$_uuid			= $row["contact_id"];
				$_cuid			= $row["company_id"];
				$_suid			= $row["contact_name"];
				$_muid			= $row["contact_mobile"];
				$cid				= $row["permission_id"];
				$_vuid			= $row["venue_id"];
				$pid				= $row["position_id"];
				$company		= $row["company_name"];
				$email			= $row["contact_email"];

				$cipher = new Cipher( $company );

				$_auid = $cid . ':' . $_vuid . ':' . $pid;

//				$encryptedtext = $cipher->encrypt($_auid);

				$rows[] = array(
					"_uuid"	=>	$cipher->encrypt($_uuid),
					"_auid"	=>	$cipher->encrypt($_auid),
					"_vuid"	=>	$cipher->encrypt($_vuid),
					"_cuid"	=>	$cipher->encrypt($_cuid),
					"_suid"	=>	$cipher->encrypt($_suid),
					"_muid"	=>	$cipher->encrypt($_muid),
					"_euid"	=>	$cipher->encrypt($email),
					"_coid"	=>	$company,
				);
			}

				$today = new DateTime('today');
				$today = $today->format('Y-m-d 15:30:00');

				$tomorrow = new DateTime('tomorrow');
				$tomorrow = $tomorrow->format('Y-m-d 04:30:00');

				setcookie("start_date",$today, strtotime($tomorrow), "/");
				setcookie("end_date",$tomorrow, strtotime($tomorrow), "/");
				setcookie( "_uuid", $cipher->encrypt($_uuid), strtotime($tomorrow), "/" );
				setcookie( "_auid", $cipher->encrypt($_auid), strtotime($tomorrow), "/" );
				setcookie( "_vuid", $cipher->encrypt($_vuid), strtotime($tomorrow), "/" );
				setcookie( "_cuid", $cipher->encrypt($_cuid), strtotime($tomorrow), "/" );
				setcookie( "_suid", $cipher->encrypt($_suid), strtotime($tomorrow), "/" );
				setcookie( "_muid", $cipher->encrypt($_muid), strtotime($tomorrow), "/" );
				setcookie( "_euid", $cipher->encrypt($email), strtotime($tomorrow), "/" );
				setcookie( "_coid", $company, strtotime($tomorrow), "/" );
		}else{
			$rows[] = array(
				"_uuid" => 0
			);
		}
		return $rows;

//		mssql_free_statement($stmt);
	}
