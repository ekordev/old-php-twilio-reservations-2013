<?php
	session_start();
	// definition file
	// client directory = 'C:\inetpub\Brooklyn-Only\wwwroot\lib\clients\'.$http_host;
	$http_host = strtolower( $_SERVER["HTTP_HOST"] );
	$http_host = str_replace( "dev2", "", $http_host );

	if( !isset($_GET["d"]) ){
		$d	= $http_host;
	}else{
		$d	= strtolower( $_GET["d"] );
	}

	DEFINE( "CLIENT_DIRECTORY", "/lib/clients/".$d);
