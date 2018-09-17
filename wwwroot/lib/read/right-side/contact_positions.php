<?php
	// functions for the dashboard right-side slider
	function get_positionCredentials($position_id){
		include( 'DB/conn.php' );
		$tsql 		= ('{ CALL get_positionCredentials(?) }');
		$params		= array(
						array(utf8_encode($position_id),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			$str = '';
			if( $position_id >= 4 ){
				while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
					if($position_id == $row['position_id']){
						$str .= $row['position_name'];
					}
				}
			}else{
				while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
					$str .= '<option value="';
					$str .= $row['position_id'];
					if($position_id == $row['position_id']){
						$str .= '" selected>';
					}else{
						$str .= '">';
					}
					$str .= $row['position_name'];
					$str .= '</option>';
				}
			}
		}
		return trim($str); exit;
	}
