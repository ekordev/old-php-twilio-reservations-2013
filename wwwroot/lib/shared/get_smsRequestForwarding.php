<?php
/*** DETERMINE WHO RECEIVES THE ALERTS/EMAILS FOR THIS REQUEST ***/
	//unassigned
	function get_smsRequestForwardingUnassigned($key_word, $key_venue, $key_tag ){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_smsRequestForwardingUnassigned(?,?,?) }');
		$params		= array(
						array(utf8_encode( $key_word ),SQLSRV_PARAM_IN)
						, array(utf8_encode( $key_venue ),SQLSRV_PARAM_IN)
						, array(utf8_encode( $key_tag ),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
//		var_dump($stmt);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$rows[] = $row;
			}
		}
		return $rows;

		sqlsrv_free_stmt($stmt);
//		sqlsrv_close($conn);
	}
	// assigned
	function get_smsRequestForwarding($key_code, $key_word, $key_venue, $key_tag ){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_smsRequestForwarding(?,?,?,?) }');
		$params		= array(
						array(utf8_encode( $key_code ),SQLSRV_PARAM_IN)
						, array(utf8_encode( $key_word ),SQLSRV_PARAM_IN)
						, array(utf8_encode( $key_venue ),SQLSRV_PARAM_IN)
						, array(utf8_encode( $key_tag ),SQLSRV_PARAM_IN)
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
			$rows = get_smsRequestForwardingUnassigned($key_word, $key_venue, $key_tag);
		}
		return json_encode($rows);

		sqlsrv_free_stmt($stmt);
//		sqlsrv_close($conn);
	}
