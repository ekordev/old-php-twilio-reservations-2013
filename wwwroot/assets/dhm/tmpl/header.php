<?php
	session_start();
	$http_host = strtolower( $_SERVER["HTTP_HOST"] );
	$application	= str_replace( 'http://','',$http_host );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="translucent">

    <title>GLVIP Sign-In</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/css/snap.css" rel="stylesheet" rel="stylesheet">
    <link href="public/css/master.css" rel="stylesheet">
    <link href="public/css/dashboard.css" rel="stylesheet">
    <script type="javascript">
/********** force the links to open as an app on standalone **********/
	(function(document,navigator,standalone) {
//		document.ontouchmove = function(e) {e.preventDefault()};
		if ((standalone in navigator) && navigator[standalone]) {
			var curnode, location=document.location, stop=/^(a|html)$/i;
			document.addEventListener('click', function(e) {
				curnode=e.target;
				while (!(stop).test(curnode.nodeName)) {
					curnode=curnode.parentNode;
				}
				if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
					e.preventDefault();
					location.href = curnode.href;
				}
			},false);
		}
	})(document,window.navigator,'standalone');
    </script>
  </head>

  <body>
