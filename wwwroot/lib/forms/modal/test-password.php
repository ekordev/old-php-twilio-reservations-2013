<?php
	session_start();
	// constants
	include('DB/constants.php');

	$json 			= json_decode($_POST["data"], true);
	$mobile 		= $json['mobile_number'];
	$password	= $json['current_password'];

	print( json_encode( get_pwdCheck($mobile, $password) ) );
/********************************* GET USER LOGIN *********************************/
	function get_pwdCheck($mobile, $password){
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
				$rows[] = $row;
			}
		}else{
			$rows[] = array(
				"contact_id" => 0
			);
		}
		return $rows;
	}
