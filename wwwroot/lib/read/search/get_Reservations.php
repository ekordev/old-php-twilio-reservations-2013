<?php
	session_start();
	// constants
	include('DB/constants.php');
	include('DB/_cipher.php');

	header('Content-type: application/json');
	print( json_encode( get_Reservation($venue_id, $today) ) );
/********************************* GET USER LOGIN *********************************/
	function get_Reservations($venue_id, $today){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_Reservation(?,?) }');
		$params		= array(
						array(utf8_encode($venue_id),SQLSRV_PARAM_IN)
						, array(utf8_encode($today),SQLSRV_PARAM_IN)
					);

		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$rows[] = $row;
			}
		}else{
			$rows[] = array(
				"_ruid" => 0
			);
		}
		return json_encode($rows);
	}
