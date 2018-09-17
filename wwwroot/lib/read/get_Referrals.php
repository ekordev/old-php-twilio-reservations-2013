<?php
	// list of possible advertising referrals
	function get_Referral($json_file){
		$json	= json_decode(file_get_contents($json_file), true);
		$venue = str_replace(" guestlist", "", strtolower($json["Request"][5]) );
		$venue = str_replace(" guest list", "", strtolower($venue) );
		$str = '';
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_Referrals(?) }');
		$params		= array(
						array(utf8_encode(null),SQLSRV_PARAM_IN)
					);
		$options	= array( "Scrollable" => "buffered" );
		$stmt 		= sqlsrv_query( $conn, $tsql, $params, $options);
		$row_count = sqlsrv_num_rows( $stmt );
		if($row_count >= 1){
			while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
				$str .= '<option id="' . strtolower($row["referral_shortcode"]) . '" value="' . $row["referral_id"];
				if( strtolower($venue) == strtolower($row["referral_shortcode"]) ){
					$str .= '" selected="selected">';
				}else{
					$str .= '">';
				}
				$str .= $row["referral_source"];
				$str .= '</option>';
			}
		}else{
			$str .= '<option> no referrals in database </option>';
		}
		return trim($str);
	}
