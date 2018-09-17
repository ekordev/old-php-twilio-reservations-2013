<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="translucent">

    <title>Donnelly Group</title>

    <!-- Bootstrap core CSS -->
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="public/css/master.css" rel="stylesheet">
    <link href="public/css/signin.css" rel="stylesheet">
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

<div class="container">
	<div id="login-form">
		<div id="title-section"></div>
		<form name="login-form" class="form-signin" method="POST" action="login.php">
			<h3 class="form-signin-heading">Please Login</h3>
			<input type="hidden" name="pid" id="pid">
			<input type="hidden" name="a" id="a">
			<input type="text" pattern="[0-9]*" name="tel" class="form-control" placeholder="Mobile Number" autofocus>
			<input type="password" name="pwd" class="form-control" placeholder="Password">
			<!--label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
			</label -->
			<button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
		</form>
	</div>

</div> <!-- /container -->

<!-- css only spinning loader -->
<div id="loading"></div>


	<!-- Bootstrap core JavaScript ================================================== -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="public/js/respond.min.js"></script>
	<!-- Extra Javascript ================================ -->
	<script src="public/js/jquery/jquery.mobile.custom.min.js"></script>
	<script src="public/js/jquery/jquery.easing.min.js"></script>
	<script src="public/js/plugins/jquery.cookie.js"></script>
	<script src="public/js/plugins/serializeForm.min.js"></script>
	<script src="public/js/plugins/snap.min.js"></script>
	<!-- Login.js ====================================== -->
	<script src="public/js/login.js"></script>
    <script type="javascript">
    /********** manage the difference in window location by appliance ***********/
    var page = document.getElementById('container'),
        ua = navigator.userAgent,
        iphone = ~ua.indexOf('iPhone') || ~ua.indexOf('iPod'),
        ipad = ~ua.indexOf('iPad'),
        ios = iphone || ipad,
        fullscreen = window.navigator.standalone,
        android = ~ua.indexOf('Android'),
        lastWidth = 0;

    if (android) {
      window.onscroll = function() {
        page.style.height = window.innerHeight + 'px'
      }
    }
    var setupScroll = window.onload = function() {
      if (ios) {
        var height = document.documentElement.clientHeight;
        if (iphone && !fullscreen) height += 100;
        page.style.height = height + 'px';
      } else if (android) {
        page.style.height = (window.innerHeight + 75) + 'px'
      }
      setTimeout(scrollTo, 0, 0, 1);
    };
    (window.onresize = function() {
      var pageWidth = page.offsetWidth;
      if (lastWidth == pageWidth) return;
      lastWidth = pageWidth;
      setupScroll();
    })();
    </script>
    <script>
		/* AJAX Start Loader */
		$(document).ajaxStart(function(){
			console.log('ajaxStart');
			$("#loading").show();
		});
		/* AJAX Complete Loader Hide */
		$(document).ajaxStop(function(){
			console.log('ajaxStop');
			$("#loading").hide();
		});
    /********************** jquery actions **********************/
    $(document).ready(function(){
    	/* disable ajax caching */
    	$.ajaxSetup({ cache: false });
    	var strUrl;
    	/* check the querystring request if it exists */
    	if( GetQueryStringParams('pid') ){
    		$("#pid").val(GetQueryStringParams('pid'));
	    	console.log( GetQueryStringParams('pid') );
    	}
    	if( GetQueryStringParams('a') ){
    		$("#a").val(GetQueryStringParams('a'));
	    	console.log( GetQueryStringParams('a') );
    	}
    	/* check the login credentials */
    	if( $.cookie("_uuid") ){
//    		alert($.cookie("_uuid"));
    		if( GetQueryStringParams('pid') ){
    			strUrl = '../guest-list.php?pid=' + GetQueryStringParams('pid') + '&a=' + GetQueryStringParams('a');
    		}else{
    			strUrl = '../dashboard.php';
    		}
//    		console.log(strUrl);
			document.location.href = strUrl;
    	}
    	/* set the page to function as an app viewport */
		window.addEventListener("load", function () {
			// Set a timeout...
			setTimeout(function () {
				// Hide the address bar!
				window.scrollTo(0, 1);
			}, 0);
		});
		/* form login response */
    	$("form[name='login-form']").submit(function(e){
    		e.preventDefault();
    		var formName = $(this).attr('name'), json,
    			formUrl = 'lib/forms/'+ $(this).attr('action'),
    			formMethod = $(this).attr('method'),
    			formData = $(this).serializeForm(),
    			jsonData = JSON.stringify(formData),
    			submitJSON = '{ "name": '+formName+', "data": '+jsonData+' }';
    		$.ajax({
				dataType:"json",
				type: formMethod,
				url: formUrl,
				data: { data: jsonData },
                complete: function( results ){
                	console.log( results );
					$.map(results, function(value,key){
						if(key == 'responseText'){
							json = eval('(' + value + ')');
							page_redirect( json );
						}
					});
                }
    		});
    	});
    });
    </script>
  </body>
</html>
