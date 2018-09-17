<?php
	include('DB/constants.php');
	include('DB/_cipher.php');
	/* APPLICATION LOGOUT */
	$http_host = strtolower( $_SERVER["HTTP_HOST"] );
	$cookie = $_COOKIE;
	foreach ($cookie as $cname=>$cvalue) {
		$cvalue = "";
		setcookie( $cname, "", time()+3600, "/", $domain );
	}
	// Unset all of the session variables.
	$_SESSION = array();
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	// Finally, destroy the session.
	session_destroy();
	if( isset($_GET["_puid"]) ){
		header( "location: http://" . $http_host . "/?" . $_SERVER["QUERY_STRING"] );
	}else{
		header( "location: http://" . $http_host . "/" );
	}
