<?php
	session_start();
	// default timezone
	date_default_timezone_set( 'America/Vancouver' );
	/***************************** SQL SERVER ******************************/
	define( "MSSQL_UID",	"sa" );
	define( "MSSQL_PWD",	"Ch@NgEmE789" );
	define( "MSSQL_DB",		"tt_ireserv_it" );
	define( "MSSQL_SVR",	"64.27.59.144,1533" );
	/******************************** BIT.LY ***********************************/
	define( "BITLY_LOGIN",	"jvanleuven" );
	define( "BITLY_KEY",	"R_bf3ee40fd9d47f287a64d7fad8786065" );
	/********************************* TWILIO *********************************/
	require('Services/Twilio.php');
	define( "TWILIO_SID",			"AC96f5c8b37b9c0705321fd6bddc07bdfc" );
	define( "TWILIO_AUTH_TOKEN",	"154c8013c59fce583331c4dcd97ef657" );
	define( "TWILIO_SMS_NUMBER",	"6042431115" );
	define( "CONFIRM_URL",			"https://dg.ireserv.it/redirect.php" );
//	define( "TWILIO_SMS_NUMBER",	"+1".$json[0]['sms_number'] );
	define( "AUTH_CODE_LENGTH",		4 );
	include "_cls/_cipher.php";
	define("CIPHER_KEY", "donnellygroupnightclubs");
	$cipher = new Cipher( CIPHER_KEY );
	/******************************* phpMailer *********************************/
	require_once('Services/PHPMailer/class.phpmailer.php');
	/****************************** header info ********************************/
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header("Content-type: application/json");
	/******************************* GET COMPANY *******************************/

	/****************************** SMS FUNCTIONS ******************************/
	include "put_approvedRequest.php";
	include "get_userExists.php";
	include "get_referralStatus.php";
	include "email_Request.php";
	include "sms_Request.php";
	include "twilio_sms_response.php";
	include "create_userJson.php";
	include "get_keywordProcess.php";
	include "get_keywordList.php";
	include "get_shortUrls.php";
	include "get_smsRequestForwarding.php";

	// return the variables
	$domain		= $_REQUEST['d'];
	$sms		= $_REQUEST['sms'];
	$date		= date('dS M Y g:ia');
	$time		= strtotime($date);
	$from		= $_REQUEST['From'];
	$from		= substr($from, -10);
	$to			= $_REQUEST['To'];
	$request	= $_REQUEST['Body'];
	$request	= htmlspecialchars( $request, ENT_QUOTES );
	// patron request array
	if( isset($_SESSION["patron"]) ){
		$patron = $_SESSION["patron"];
	}else{
		$_SESSION["patron"] = get_userExists( $from );
		$patron = $_SESSION["patron"];
	}
	// get the referrals array
	/*
	if( isset($_SESSION["referral_list"]) ){
		$referral_list = $_SESSION["referral_list"];
	}else{
		$initial_request = $
		$_SESSION["referral_list"] = get_referralList($domain);
	}
	*/
//	print_r($patron);
//	echo "\n";
	// create the keyword_list array
	if( isset($_SESSION["keywords"]) ){
		$keywords = $_SESSION["keywords"];
	}else{
		$_SESSION["keywords"] = get_keywordList($domain);
		$keywords = $_SESSION["keywords"];
	}
	// return the keyword list for this domain
	$length = count($keywords);
	// check for commas in the sms request body
	$comma = substr_count($request,",");
	// return the keyword by comparing to the list
	if( $comma > 0 ){
		$element = str_getcsv($request,",");
		$keyword = strtolower($request[$comma]);
		for($i=0; $i<$length; $i++){
			if ( strtolower($keywords[$i]["sms_keyword"]) == strtolower($element[0]) ) {
				$keyword = array( $keywords[$i]["sms_keyword"] );
			}
		}
		// increment the current step to the end
		$_SESSION["current_step"] = $comma;
		$current_step = $_SESSION["current_step"];
	}else{
		// increment the current step by 1
		$_SESSION["current_step"] = $comma;
		$current_step = $_SESSION["current_step"];
		for($i=0; $i<$length; $i++){
			/* test for the keyword in the string */
			if (strpos( strtolower($request), strtolower($keywords[$i]["sms_keyword"])) !== false) {
				// echo 'true';
				$keyword = array( $keywords[$i]['sms_keyword'] );
			}
		}
	}

	if( isset($keyword) ){
		if( isset($_SESSION["keyword"]) ) {
			if( $_SESSION["keyword"] !== $keyword ){
				$_SESSION["keyword"] = $keyword;
			}
		}else{
			$_SESSION["keyword"] = $keyword;
		}
	}else{
		@$keyword = $_SESSION["keyword"];
	}

	// return the keyword steps
	$steps = get_keywordProcess($keyword,$domain, $patron);
	if( isset($_SESSION["steps"]) ){
		$steps = $_SESSION["steps"];
	}else{
		$_SESSION["steps"] = $steps;
	}

	// return the number of steps
	$counter = count($steps);
	if( isset($_SESSION["counter"]) ){
		$counter = $_SESSION["counter"];
	}else{
		$_SESSION["counter"] = $counter;
	}

	// return the current step
	if( isset($_SESSION["current_step"]) ){
		$current_step = $_SESSION["current_step"];
	}else{
		$current_step = 0;
		$_SESSION["current_step"] = $current_step;
	}

	// return the session token
	if( isset($_SESSION["token"]) ){
		$token = $_SESSION["token"];
	}else{
		$token = uniqid( md5( rand() ), true );
		$_SESSION["token"] = $token;
	}

/********** deal with the json file now that we have all the arrays created **********/
	// manage the json file
	create_userJson($current_step, $counter, $token, $to, $from, $date, $time, $sms, $domain, $request, $comma, $patron, $cipher);

	// respond with the correct step question
	twilio_sms_response($steps, $domain, $token, $from, $patron, $cipher);
/********** Sanitize the sms string **********/
   function checkInput($str) {
        $str = @strip_tags($str);
        $str = @stripslashes($str);
//        $str = mysql_real_escape_string($str);
        return $str;
    }
/********** FORMAT PHONE ************/
	/* fix the phone number */
function cleanString( $str ){
	$str = str_replace( "(", "", $str );
	$str = str_replace( ")", "", $str );
	$str = str_replace( "-", "", $str );
	$str = str_replace( ".", "", $str );
	$str = str_replace( " ", "", $str );
	$str = str_replace( "+", "", $str );
	$str = str_replace( "-", "", $str );
	return $str;
}
function format_phone($phone){
    $phone = preg_replace("/[^0-9]/", "", cleanString($phone));
    $phone = substr($phone, -10);

    if(strlen($phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
    elseif(strlen($phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
    else
        return $phone;
}
