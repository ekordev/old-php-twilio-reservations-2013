<?php
	/***************************************************************************
	   Create Date:	Sun Aug 18, 2013  12:21 AM
	   Author:		James Van Leuven
	   File:		conn.php
	   Description:	database-connectivity
	********************************* SQLSRV *********************************/
	define( "MSSQL_UID",	"sa" );
	define( "MSSQL_PWD",	"HFymc$@svn#1" );
	define( "MSSQL_DB",		"tt_ireserv_it" );
	define( "MSSQL_SVR",	"173.248.141.3,1533" );

	$connectionInfo = array(
		"UID"=> MSSQL_UID
		, "PWD"=> MSSQL_PWD
		, "Database"=> MSSQL_DB
		, "CharacterSet" => SQLSRV_ENC_CHAR
		, "CharacterSet" => "UTF-8"
		, "ReturnDatesAsStrings" => 1
	);

	$conn = sqlsrv_connect( MSSQL_SVR, $connectionInfo );

	if( !$conn ){
		 echo "Connection could not be established.\n";
		 echo "<pre>";
		 die( print_r( sqlsrv_errors(), true));
		 echo "</pre>";
	}
