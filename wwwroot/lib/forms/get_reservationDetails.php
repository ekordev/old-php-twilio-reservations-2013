<?php
	include('DB/_cipher.php');
//	print( json_encode( get_Reservation($venue_id, $today) ) );
/********************************* GET USER LOGIN *********************************/
	function get_reservationDetails( $reservation_id ){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_reservationDetails(?) }');
		$params		= array(
						array(utf8_encode($reservation_id),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$rows[] = $row;
			}
		}else{
			$rows[] = null;
		}
		 return $rows;
	}
