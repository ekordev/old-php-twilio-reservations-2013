<?php
/********** get the short URLs **********/
	function get_shortUrls( $domain, $venue ){
		include('DB/conn.php');
		if(!isset($venue)){ $venue = "killjoy"; }
		$venue = '%' . $venue . '%';
		$tsql 		= ('{ CALL get_ShortUrl(?,?) }');
		$params		= array(
						array(utf8_encode($domain),SQLSRV_PARAM_IN)
						, array(utf8_encode( strtolower($venue) ),SQLSRV_PARAM_IN)
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
		return json_encode($rows);

		sqlsrv_free_stmt($stmt);
//		sqlsrv_close($conn);
	}
