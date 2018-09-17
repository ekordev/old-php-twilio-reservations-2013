<?php
/********** get the keywords list **********/
	function get_keywordList($domain){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_SMS_Keywords_List(?) }');
		$params		= array(
						array(utf8_encode($domain),SQLSRV_PARAM_IN)
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
