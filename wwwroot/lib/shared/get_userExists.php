<?php
/****** CHECK TO SEE IF THE USER EXISTS *********************************/
	function get_userExists( $from ){
		include('DB/conn.php');
		$from = substr($from, -10);
		$tsql 		= ('{ CALL get_testReservationPhoneNumber(?) }');
		$params		= array(
						array(utf8_encode($from),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
//		var_dump($stmt);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$rows[] = $row;
			}
		}else{
			$rows[] = [
				"id"=>"0",
			];
		}
		return $rows;

		sqlsrv_free_stmt($stmt);
	}
