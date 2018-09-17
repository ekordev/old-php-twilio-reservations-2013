<?php
/* return the json data */
	function get_Patrons( $mobile, $json_file ){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_Patrons(?) }');
		$params		= array(
						array(utf8_encode( $mobile ),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$rows[] = $row;
			}
		}else{
			$rows = json_decode( file_get_contents( $json_file ), true );
		}
		return $rows;
	}
