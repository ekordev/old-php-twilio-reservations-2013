<?php
	session_start();

	define( "BITLY_LOGIN",	"jvanleuven" );
	define( "BITLY_KEY",	"R_bf3ee40fd9d47f287a64d7fad8786065" );
	define( "CLIENT_ID", "781d1ef0fd617db22312328ae15c5baa4674064d" );
	define( "CLIENT_SECRET", "b7241c4f84b587268fcec882146dffc17719511c" );
	define( "ACCESS_TOKEN", "d4a9d87ddcff11dfaca0472e66c80b9b29306b0d" );

	$URL = $_REQUEST["url"];

/* returns the shortened url */
function get_bitly_short_url($url,$login,$appkey,$format='json') {
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.rawurlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

/* returns expanded url */
function get_bitly_long_url($url,$login,$appkey,$format='json') {
	$connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.rawurlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

/* returns a result form url */
function curl_get_result($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


// header('Content-type: text/json');
/* get the short url */
$short_url = get_bitly_short_url($URL, BITLY_LOGIN, BITLY_KEY);

/* get the long url from the short one */
$long_url = get_bitly_long_url($short_url, BITLY_LOGIN, BITLY_KEY);

 header('Content-type: application/json');
 print_r( json_decode($short_url,true) );
 print_r( json_decode($long_url, true) );
