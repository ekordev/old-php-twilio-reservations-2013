<?php
	// functions for the dashboard right-side slider
	function get_Venues( $venue_id, $venue, $application ){
		include( 'DB/conn.php' );
		$tsql 		= ('{ CALL get_Venues(?) }');
		$params		= array(
						array(utf8_encode($application),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		$str = '';
		if($row_count >= 1){
			if($venue_id == 0){
				$str = '<option value="0" selected>All Venues</option>';
				while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
					$friendly_name = str_replace(" ","",$row["friendly_name"]);
					$str .= '<option id="' . strtolower($friendly_name) . '" value="';
					$str .= $row['venue_id'];
					if( strtolower($venue) == strtolower($row['friendly_name']) ){
						$str .= '" selected>';
					}else{
						$str .= '">';
					}
					$str .= $row['venue_name'];
					$str .= '</option>';
				}
			}else{
				$str = '';
				while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
					if($venue_id == $row['venue_id']){
						$str .= $row['venue_name'];
					}
				}
			}
		}
		return trim($str); exit;
	}
