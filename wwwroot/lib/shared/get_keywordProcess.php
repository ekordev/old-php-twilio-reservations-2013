<?php
/********** get the keyword steps **********/
	function get_keywordProcess($keyword,$domain, $patron){
		include('DB/conn.php');
		$patron_id = $patron[0]['id'];
		if( strlen($patron_id) > 1){
			$tsql 		= ('{ CALL get_keywordSmsSteps_Alternate(?) }');
		}else{
			$tsql 		= ('{ CALL get_keywordSmsSteps(?) }');
		}

		$params		= array(
						array(utf8_encode($keyword[0]),SQLSRV_PARAM_IN)
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
			$rows = get_keywordList($domain);
		}
		return $rows;

		sqlsrv_free_stmt($stmt);
//		sqlsrv_close($conn);
	}
