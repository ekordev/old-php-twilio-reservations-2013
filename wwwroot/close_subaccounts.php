<?php
// Get the PHP helper library from twilio.com/docs/php/install
	require('Services/Twilio.php');
	define( "TWILIO_SID",			"AC96f5c8b37b9c0705321fd6bddc07bdfc" );
	define( "TWILIO_AUTH_TOKEN",	"154c8013c59fce583331c4dcd97ef657" );
	define( "TWILIO_SMS_NUMBER",	"+16042431115" );
	define( "CONFIRM_URL",			"http://dg.ireserv.it/redirect.php" );
//	define( "TWILIO_SMS_NUMBER",	"+1".$json[0]['sms_number'] );
	define( "AUTH_CODE_LENGTH",		4 );

	$client = new Services_Twilio(TWILIO_SID, TWILIO_AUTH_TOKEN);

// Get an object from its sid. If you do not have a sid,
// check out the list resource examples on this page
$account = $client->accounts->get($_REQUEST["account"]);
$account->update(array(
        "Status" => "closed"
    ));
echo $account->date_created;
