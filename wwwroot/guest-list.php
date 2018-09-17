<?php
	session_start();
	// include constants
	include('DB/constants.php');
	include('DB/_cipher.php');
	include('lib/read/get_Patrons.php');
	include( 'lib/read/get_Referrals.php' );
	include( 'lib/read/get_Venues.php' );
	$http_host = strtolower( $_SERVER["HTTP_HOST"] );

	// decrypt the rules
	$cipher = new Cipher( $_COOKIE["_coid"] );

	if( !isset($_COOKIE['start_date']) ){
		header( "location: ../" );
	}else{
		$application	= str_replace( 'http://','',$http_host );
		$application	= str_replace( '.ireserv.it','',$application);

		$_uuid	=	$cipher->decrypt($_COOKIE["_uuid"]);
		$mobile	=	$cipher->decrypt($_COOKIE["_muid"]);
		$name	=	$cipher->decrypt($_COOKIE["_suid"]);
		$email	=	$cipher->decrypt($_COOKIE["_euid"]);

		$str = $cipher->decrypt($_COOKIE["_auid"]);
		$arr = explode( ':', $str );

		$credentials_id	=	$arr[0];
		$venue_id		=	$arr[1];
		$position_id	=	$arr[2];
	}

	if( isset( $_GET["pid"] ) ){
		$gl_request	= trim( $_GET["pid"] );
	}else{
		$gl_request = 0;
	}
	if( isset($_GET["a"]) ){
		$gl_request_type = intval( $_GET["a"] );
	}else{
		$gl_request_type = 0;
	}

	$domain		= $application;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="translucent">

    <title><?=$_COOKIE["_coid"]; ?> Guest List</title>

		<script type="text/javascript">
			(function(document,navigator,standalone) {
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
		<!-- Bootstrap core CSS -->
		<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/flatly/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="public/css/font-awesome.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="/public/css/snap.css" rel="stylesheet">
		<link href="public/css/master.css" rel="stylesheet">
		<link href="public/css/guest-list.css" rel="stylesheet">
		<link href="public/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="public/css/bootstrap-switch.css" rel="stylesheet">
		<link href="public/css/flat-ui-fonts.css" rel="stylesheet">
</head>
<body>
	<!-- slide_panels -->
  	<div class="snap-drawers full-height">
        <div class="snap-drawer snap-drawer-left full-height">
        	<div class="full-height container">
				<div class="full-height nav nav-tabs nav-stacked">
					<div id="menu-title" class="clearfix">
						<h4 class="pull-left">Menu</h4>
						<a href="javascript:void(0);" class="drawer-close pull-right">
							<i class="close-drawer fa fa-chevron-right fa-icon-border"></i>
						</a>
					</div>
					<div id="menu-items" class="list-group">
						<a class="list-group-item" href="../dashboard.php"><i class="icon-home"></i> Dashboard </a>
						<a class="list-group-item active" href="../guest-list.php"><i class="icon-group icon-border"></i> Guest List </a>
						<? if( $position_id < 4 ){ ?>
						<a class="list-group-item" href="javascript:void(0);"><i class="fa fa-globe"></i> Promoters </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="fa fa-building-o"></i> Venues </a>
						<? } ?>
						<? if( $position_id < 5 ){?>
						<a class="list-group-item" href="javascript:void(0);"><i class="fa fa-bar-chart-o"></i> Reports </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="fa fa-user"></i> Users </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="fa fa-wrench"></i> Settings </a>
						<? } ?>
						<a class="list-group-item" href="../logout.php"><i class="fa fa-lock"></i> Logout </a>
					</div>
					<br>
				</div>
            </div>
        </div>
        <div class="snap-drawer snap-drawer-right full-height">
        	<div class="full-height well">
				<div class="full-height nav nav-tabs nav-stacked">
					<? if( isset($_GET["pid"]) ){ ?>
					<div id="search-title" class="clearfix">
						<a href="javascript:void(0);" class="drawer-close pull-left">
							<i class="close-drawer fa fa-chevron-left fa-icon-border"></i>
						</a>
						<h4 class="pull-right">Guest Data</h4>
					</div>
					<? include('HTML/forms/patron-data-form.php'); ?>
				<? }else{ ?>
				<div class="full-height nav nav-tabs nav-stacked">
					<div id="search-title" class="clearfix">
						<a href="javascript:void(0);" class="drawer-close pull-left">
							<i class="close-drawer fa fa-chevron-left fa-icon-border"></i>
						</a>
						<h4 class="pull-right">Search</h4>
					</div>
					<!--div class="clearfix">
						<button name="add-patron-data" disabled id="add_data" class="form-control btn btn-success" data-toggle="modal" data-target="#modalWidget">Add Data</button>
					</div -->
					<form id="search-form" name="search-form" method="post" action="search.php">
						<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
						<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
					<ul id="search-form" class="list-group">
						<!--li class="list-group-item">
							<select name="event" size="1" class="form-control">
								<option value="0">Search by Event...</option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
							</select>
						</li -->
						<li class="list-group-item">
							<input type="text" pattern="[0-9]*" name="mobile" id="mobile" class="mobile form-control" placeholder="search by mobile...">
						</li>
						<li class="list-group-item">
							<input type="text"  name="name" id="name" class="form-control" placeholder="search by name...">
						</li>
					</ul>
					<div class="button-group btn-group-justified">
						<a href="javascript:void(0);" name="guest_reset" id="guest_reset" class="btn btn-default">Reset</a>
						<a href="javascript:void(0);" name="guest_submit" id="guest_submit" class="btn btn-primary">Submit</a>
					</div>
					</form>
					<br>
					<form id="quick-jump" onsubmit="return false;">
						<div class="button-group btn-group-justified">
							<a href="#a" class="sort-by btn btn-default">ABC</a>
							<a href="#d" class="sort-by btn btn-default">DEF</a>
							<a href="#g" class="sort-by btn btn-default">GHI</a>
						</div>
						<div class="button-group btn-group-justified">
							<a href="#j" class="sort-by btn btn-default">JKL</a>
							<a href="#m" class="sort-by btn btn-default">MNO</a>
							<a href="#p" class="sort-by btn btn-default">PQR</a>
						</div>
						<div class="button-group btn-group-justified">
							<a href="#s" class="sort-by btn btn-default">STU</a>
							<a href="#v" class="sort-by btn btn-default">VWX</a>
							<a href="#y" class="sort-by btn btn-default">YZ</a>
						</div>
					</form>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
				<? } ?>
            </div>
        </div>
    </div>
    <!-- // -->
	<!-- page -->
	<div id="content" class="full-height snap-content">
		<!-- navbar -->
		<div id="page-nav" class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div id="toolbar" class="container clearfix">
					<a href="javascript:void(0);" id="open-left" class="pull-left"></a>
					<h1 id="title-section"></h1>
					<a href="javascript:void(0);" id="open-right" class="pull-right">
						<? if( !isset($_GET["pid"]) ){ ?>
						<i class="fa fa-search fa-muted"></i>
						<? }else{ ?>
							<? if( !isset($_GET["a"]) ){ ?>
								<i class="fa fa-cog"></i>
							<? }else{ ?>
								<i class="fa fa-info-circle"></i>
							<? } ?>
						<? } ?>
					</a>
				</div>
			</div>
		</div>
		<!-- content -->
		<div id="main-content">
			<div id="slider">
				<? if( !isset($_GET["pid"]) ){ ?>
				<div class="container"><? include("lib/read/page.guestlist.php"); ?></div>
				<? }else{ ?>
				<div class="container">
				<?php
					switch( intval($gl_request_type) ){
						case 1:
							include('lib/forms/gl-pending.php');
							break;
						case 2:
							echo "fwd this gl request";
							break;
						default:
							include('lib/forms/gl-existing.php');
					}
				?>
				</div>
				<? } ?>
			</div>
		</div>
	</div>
	<!-- // -->
<!-- ******************** modal ******************** -->
	<div id="modalWidget" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title">Add Patron Info</h4>
			</div>
			<div class="modal-body"><? include('/lib/forms/patron-data-form.php'); ?></div>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
<!-- ************************************************ -->
<!-- css only spinning loader -->
	<div id="loading"></div>
	<? include('lib/shared/javascript.php'); ?>
	<script src="public/js/bootstrap-switch.min.js"></script>
	<script src="public/js/bootstrap-select.min.js"></script>
	<script type="text/javascript">
		var page = document.getElementById('content'),
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
			if (iphone && !fullscreen) height += 60;
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
		// define the primary-content
		var snapper = new Snap({
			element: document.getElementById('content')
		});
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
            $(document).ready(function(){
            	$("#guestlist-tabs").click(function(e){
            		e.preventDefault();
            		$("ul#guestlist-tabs li").removeClass("active");
            		$(this).tab('show');
            	});
            	$("li.list-column").bind('click', function(e){
            		var id = $(this).data('id');
//            		console.log(id);
            		document.location = '../guest-list.php?pid=' + id;
            	});
				$("button.count-plus").bind("click",function(e){
					e.preventDefault();
					var el = $(this).data("id");
					var fld = $(this).data("fld");
					var oVal = $('input[name="'+fld+'"]').val();
					var nVal = parseFloat(oVal) + 1;
					$(el).html(nVal);
					$('input[name="'+fld+'"]').val(nVal);
				});
				$("button.count-minus").bind("click",function(e){
					e.preventDefault();
					var el = $(this).data("id");
					var fld = $(this).data("fld");
					var oVal = $('input[name="'+fld+'"]').val();
					if(oVal > 0){
						nVal = parseFloat(oVal) - 1;
					}else{
						nVal = 0;
					}
					$(el).html(nVal);
					$('input[name="'+fld+'"]').val(nVal);
				});
            	$("button.edit_item").bind("click", function(e){
            		e.preventDefault();
            		console.log( $(this).attr("id") );
            	});
				/* deal with the guest list requests */
				$("button.btn-guestlist").bind("click", function(e){
					e.preventDefault();
					var id = $(this).attr('id');
					console.log( id );
					var data = $("#guest_list_info").serializeForm();
					console.log( data );
				});
            	// check-in guest
            	$("button[name='edit-guest']").bind('click',function(e){
            		e.preventDefault();
            		var pid = $(this).data("id");
            		document.location.href = "?pid=" + pid;
            	});
            	// mobile height
            	var viewportHeight = $(window).height();
            	$("#slider").css("height",(viewportHeight-25)+"px");
            	// scroll to top
				$("#slider").scroll(function(){
					if ($(this).scrollTop() > 100) {
						$('.scrollup').fadeIn();
					} else {
						$('.scrollup').fadeOut();
					}
				});
				// test slider distance
				$("#slider").scroll(function(){
					var scrollDistance = $(this).scrollTop();
					if(scrollDistance <= -30){
						document.location.href = document.location.href;
					}
				});
				// scroll to top
				$('a.scrollup').click(function(){
					$("#slider").animate({ scrollTop: 0 }, 600);
					return false;
				});
            	// slide panel left
            	$("#open-left").bind('click',function(){
            		snapper.open('left');
            	});
            	// slide panel right
            	$("#open-right").bind('click',function(){
            		snapper.open('right');
            	});
            	// close slide panel
            	$(".close-drawer").bind('click',function(){
            		snapper.close();
            	});
            	// alphabet slider
				$("a.sort-by").click(function(e) {
					e.preventDefault();
					location.hash = $(this).attr('href');
					snapper.close();
				});
				// guest quick details
				$(".show-info").click(function(e){
					var info = "#"+$(this).data('id');
					if( $(info).is(':visible') ){
						$(info).hide();
					}else{
						$("ul.breadcrumb").hide();
						$(info).show();
					}
				});
            	// search button
            	$("#search-button").bind('click',function(e){
            		e.preventDefault();
            		var form = JSON.stringify($("#search-form").serializeForm()),
            			url = $("#search-form").attr('action');
            		alert(form);
            		alert(url);
            		snapper.close();
            	});
            });
	</script>
</body>
</html>
