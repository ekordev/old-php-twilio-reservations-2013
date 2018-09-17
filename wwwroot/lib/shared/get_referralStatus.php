<?php
/****** CHECK TO SEE IF THE USER EXISTS *********************************/
	function get_ReferralStatus( $key_code ){
		include('DB/conn.php');
		$tsql 		= ('{ CALL get_ReferralApprovalDuration(?) }');
		$params		= array(
						array(utf8_encode($key_code),SQLSRV_PARAM_IN)
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
				"referral_id"=>"0",
			];
		}
		return $rows;

		sqlsrv_free_stmt($stmt);
	}
