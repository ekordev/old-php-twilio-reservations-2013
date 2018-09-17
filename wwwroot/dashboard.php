<?php
	session_start();
	// include constants
	include('DB/constants.php');
	include('DB/_cipher.php');

	// decrypt the rules
	$cipher = new Cipher( $_COOKIE["_coid"] );

	if( !isset($_COOKIE['_uuid']) ){
		header( "location: ../logout.php" );
	}else{
		$http_host = strtolower( $_SERVER["HTTP_HOST"] );
		$application	= str_replace( 'http://','',$http_host );
		$application	= str_replace( '.ireserv.it','',$application);

		$_uuid	=	$cipher->decrypt($_COOKIE["_uuid"]);
		$mobile	=	$cipher->decrypt($_COOKIE["_muid"]);
		$name	=	$cipher->decrypt($_COOKIE["_suid"]);
		$email	=	$cipher->decrypt($_COOKIE["_euid"]);

		$str = $cipher->decrypt($_COOKIE["_auid"]);
		$arr = explode( ':', $str );

		$credentials_id	=	$arr[0];
		$venue_id			=	$arr[1];
		$position_id		=	$arr[2];

		include( 'lib/read/right-side/contact_positions.php' );
		// determine if this user is assigned venue(s)
		include( 'lib/read/get_Venues.php' );
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="translucent">

	<title><?=$_COOKIE["_coid"]; ?> Dashboard</title>

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
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="/public/css/snap.css" rel="stylesheet" rel="stylesheet">
	<link href="public/css/master.css" rel="stylesheet">
	<link href="public/css/dashboard.css" rel="stylesheet">
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
							<i class="close-drawer icon-chevron-right icon-border"></i>
						</a>
					</div>
					<div id="menu-items" class="list-group">
						<a class="list-group-item active" href="../dashboard.php"><i class="icon-home"></i> Dashboard </a>
						<a class="list-group-item" href="../guest-list.php"><i class="icon-group icon-border"></i> Guest List </a>
						<? if( $position_id < 4 ){ ?>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-globe"></i> Promoters </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-building"></i> Venues </a>
						<? } ?>
						<? if( $position_id < 5 ){?>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-bar-chart"></i> Reports </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-user"></i> Users </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-wrench"></i> Settings </a>
						<? } ?>
						<a class="list-group-item" href="../logout.php"><i class="icon-lock"></i> Logout </a>
					</div>
					<br>
				</div>
            </div>
        </div>
        <div class="snap-drawer snap-drawer-right">
        	<div class="full-height">
				<div class="nav nav-tabs nav-stacked">
					<div id="search-title" class="clearfix">
						<a href="javascript:void(0);" class="drawer-close pull-left">
							<i class="close-drawer icon-chevron-left icon-border"></i>
						</a>
						<h4 class="pull-right">Profile</h4>
					</div>
	<!-- dashboard controller -->
					<ul id="dashboard_manager" class="nav nav-tabs">
						<li class="active"><a href="#settings" data-toggle="tab"><i class="icon-cog"></i> Settings</a></li>
						<li><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Profile</a></li>
					</ul>
					<div class="tab-content">
							<? include('lib/read/right-side/dashboard.preferences.php'); ?>
							<? include('lib/read/right-side/dashboard.profile.php'); ?>
					</div>
				</div>
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
						<i class="icon icon-user icon-muted"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- content -->
		<div id="main-content" style="scroll-y: scroll;">
			<a href="#" class="scrollup">Top</a>
			<div id="slider">
				<div id="slider-content" class="container">
<!-- ************************************************************************************ -->
					<div class="col-xs-12">
						<h4>Dashboard</h4>
						<div class="panel-group" id="accordion">
<!-- guest lists 1 -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											<i class="icon-star icon-border"></i> Guest Lists
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <7 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<!--select name="guest_venues" class="form-control clearfix">
												<?//=get_Venues( $venue_id, $application ); ?>
											</select-->>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<div id="guest_venues" class="panel-scroller clearfix">
											<table class="table table-striped table-condensed">
												<thead>
													<tr>
														<th>Item (All Venues)</th>
														<th>Amnt</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Requested</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Approved</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Denied</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Arrived</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Pending</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Collected</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Outstanding</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>SMS %</td>
														<td>xx%</td>
													</tr>
													<tr>
														<td>Email %</td>
														<td>xx%</td>
													</tr>
													<tr>
														<td>Staff %</td>
														<td>xx%</td>
													</tr>
													<tr>
														<td>Promoter %</td>
														<td>xx%</td>
													</tr>
													<tr>
														<td>Street Team %</td>
														<td>xx%</td>
													</tr>
													<tr>
														<td>TTL Returning Customers</td>
														<td>xx</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
<!-- Table Service 1 -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<i class="icon-glass icon-border"></i> Table Service
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id < 7 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<!--select name="tableservice_venues" class="form-control clearfix">
												<?//=get_Venues( $venue_id, $application ); ?>
											</select-->
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<div id="guest_venues" class="panel-scroller clearfix">
											<table class="table table-striped table-condensed">
												<thead>
													<tr>
														<th>Item (All Venues)</th>
														<th>Amnt</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Guests</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Arrived</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Pending</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Acquired</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Pending</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>TTL Returning Customers</td>
														<td>xx</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
<!-- Promoters 1 -->
<? if($position_id < 4 ){ ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
											<i class="icon-globe icon-border"></i> Promoter's
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <= 0 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<select name="promoters_venues" class="form-control clearfix">
												<?=get_Venues( $venue_id, $application ); ?>
											</select>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<div id="guest_venues" class="panel-scroller clearfix">
											<table class="table table-striped table-condensed">
												<thead>
													<tr>
														<th>Item (All Venues)</th>
														<th>Amnt</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Guests</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Arrived</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Pending</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Acquired</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>Data Pending</td>
														<td>xx</td>
													</tr>
													<tr>
														<td>TTL Returning Customers</td>
														<td>xx</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
<!-- Venues 1 -->
<? if($position_id >= 3){ ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
											<i class="icon-building icon-border"></i> Venues
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <= 0 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<select name="venues_venues" class="form-control clearfix">
												<?=get_Venues( $venue_id, $application ); ?>
											</select>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<div id="guest_venues" class="panel-scroller clearfix">
											<table class="table table-striped table-condensed">
												<thead>
													<tr>
														<th>Venue</th>
														<th>Amnt</th>
														<th>+/- Ratio's</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>The Academic</td>
														<td>xx</td>
														<td> (+) xx% </td>
													</tr>
													<tr>
														<td>Hooker's Green</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Bimini</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Calling</td>
														<td>xx</td>
														<td> (+) xx% </td>
													</tr>
													<tr>
														<td>Cinema</td>
														<td>xx</td>
														<td> (+) xx% </td>
													</tr>
													<tr>
														<td>The Lamplighter</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>Library Square</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>Metropole Community Pub</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The New Oxford</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Butcher & Bollock</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Queen's Republic</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Portside Pub</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>Bar None</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Annex</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>Killjoy</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>Clough Club</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
													<tr>
														<td>The Granville Room</td>
														<td>xx</td>
														<td> (-) xx% </td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
<!-- Reports 1 -->
	<? } ?>
<? } ?>
<? if($position_id <= 4 ){ ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
											<i class="icon-bar-chart icon-border"></i> Reports
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <= 0 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<select name="report_venues" class="form-control clearfix">
												<?=get_Venues( $venue_id, $application ); ?>
											</select>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?> - <?=date('M Y');?></h4>
									<? } ?>
										<div id="charts" class="panel-scroller">
											<div id="guest_venues" class="chart-container clearfix">
												<canvas id="guest_chart" class="chart"></canvas>
											</div>
											<div id="table_venue_chart" class="chart-container clearfix">
												<canvas id="table_chart" class="chart"></canvas>
											</div>
											<div id="table_venue_chart" class="chart-container clearfix">
												<canvas id="sms_chart" class="chart"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
<!-- Users 1 -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
											<i class="icon-user icon-border"></i> Users
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseSix" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <= 0 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<select name="user_venues" class="form-control clearfix">
												<?=get_Venues( $venue_id, $application ); ?>
											</select>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<br>
										<div class="panel-group" id="accordion-staff">
<!-- guest list staff 1.1 -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-staff" href="#guestlist-One">
															Guest List Staff
															<span class="icon-caret-down pull-right"></span>
														</a>
													</h4>
												</div>
												<div id="guestlist-One" class="panel-scroller panel-collapse collapse" style="height: 0px;">
													<div class="list-group">
														<div class="list-group-item">
															<p class="list-group-item-text">
																<ul class="list-group">
																	<li class="list-group-item">
																		<strong>Venue</strong>: Academic<br>
																		<strong>Position: </strong>: Guest List Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Alice Academic</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Hookers Green<br>
																		<strong>Position: </strong>: Guest List Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Gail Green</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Bimini<br>
																		<strong>Position: </strong>: Guest List Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Betty Bimini</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																</ul>
															</p>
														</div>
													</div>
												</div>
											</div>
<!-- vip staff 1.2 -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-staff" href="#guestlist-Two">
															VIP Staff
															<span class="icon-caret-down pull-right"></span>
														</a>
													</h4>
												</div>
												<div id="guestlist-Two" class="panel-scroller panel-collapse collapse" style="height: 0px;">
													<div class="list-group">
														<div class="list-group-item">
															<p class="list-group-item-text">
																<ul class="list-group">
																	<li class="list-group-item">
																		<strong>Venue</strong>: Academic<br>
																		<strong>Position: </strong>: VIP Hostess<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Alice Academic</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Hookers Green<br>
																		<strong>Position: </strong>: VIP Hostess<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Gail Green</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Bimini<br>
																		<strong>Position: </strong>: VIP Hostess<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Betty Bimini</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Checked-in</strong>: 74<br>
																		<strong>Data-Collected</strong>: 22<br>
																		<strong>Ratio</strong>: 29.7%<br>
																		<strong>New Requests</strong>: 3<br>
																	</li>
																</ul>
															</p>
														</div>
													</div>
												</div>
											</div>
<!-- data staff 1.3 -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-staff" href="#guestlist-Three">
															Data Staff
															<span class="icon-caret-down pull-right"></span>
														</a>
													</h4>
												</div>
												<div id="guestlist-Three" class="panel-scroller panel-collapse collapse" style="height: 0px;">
													<div class="list-group">
														<div class="list-group-item">
															<p class="list-group-item-text">
																<ul class="list-group">
																	<li class="list-group-item">
																		<strong>Venue</strong>: Academic<br>
																		<strong>Position: </strong>: Data Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Alice Academic</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 22<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Hookers Green<br>
																		<strong>Position: </strong>: Guest List Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Gail Green</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 22<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Bimini<br>
																		<strong>Position: </strong>: Guest List Girl<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Betty Bimini</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 22<br>
																	</li>
																</ul>
															</p>
														</div>
													</div>
												</div>
											</div>
<!-- street team staff 1.4 -->
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-staff" href="#guestlist-Four">
															Street Team Staff
															<span class="icon-caret-down pull-right"></span>
														</a>
													</h4>
												</div>
												<div id="guestlist-Four" class="panel-scroller panel-collapse collapse" style="height: 0px;">
													<div class="list-group">
														<div class="list-group-item">
															<p class="list-group-item-text">
																<ul class="list-group">
																	<li class="list-group-item">
																		<strong>Venue</strong>: All Venues<br>
																		<strong>Position: </strong>: Street Teams<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Alice Academic</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 18<br>
																		<strong>New Requests</strong>: 112<br>
																		<strong>Ratio</strong>: 18.6%<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: All Venues<br>
																		<strong>Position: </strong>: Street Teams<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Gail Green</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 18<br>
																		<strong>New Requests</strong>: 112<br>
																		<strong>Ratio</strong>: 18.6%<br>
																	</li>
																	<li class="list-group-item">
																		<strong>Venue</strong>: Cinema<br>
																		<strong>Position: </strong>: Promoter<br>
																		<strong>Name: </strong>: <a href="javascript:void(0);">Betty Bimini</a><br>
																		<strong>Logged-In</strong>: 2h25<br>
																		<strong>Data-Collected</strong>: 18<br>
																		<strong>New Requests</strong>: 112<br>
																		<strong>Ratio</strong>: 18.6%<br>
																	</li>
																</ul>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
<!-- Settings 1 -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
											<i class="icon-wrench icon-border"></i> Settings
											<span class="icon-caret-down pull-right"></span>
										</a>
									</h4>
								</div>
								<div id="collapseSeven" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
									<? if( $venue_id <= 0 ){ ?>
										<form role="form">
											<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid'];?>">
											<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
											<select name="settings_venues" class="form-control clearfix">
												<?=get_Venues( $venue_id, $application ); ?>
											</select>
										</form>
									<? }else{ ?>
										<h4><?=get_Venues( $venue_id, $application ); ?></h4>
									<? } ?>
										<br>
<!-- Settings - Manage Alerts 1.1 -->
										<div class="panel panel-default">
											<div class="panel-heading">Manage Alerts</div>
											<div class="panel-body">
												<ul class="list-group">
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-search pull-right"></i> View Alerts </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-edit pull-right"></i> Manage Alerts</a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-reply pull-right"></i> Send Alert </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-reply-all pull-right"></i> Send Blast </a></li>
												</ul>
											</div>
										</div>
<!-- Settings - Manage Users 1.2 -->
										<div class="panel panel-default">
											<div class="panel-heading">Manage Users <span class="badge pull-right">34 Users</span></div>
											<div class="panel-body">
												<ul class="list-group">
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-search pull-right"></i> View Users </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-edit pull-right"></i> Manage Users</a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-plus pull-right"></i> Add Users </a></li>
												</ul>
											</div>
										</div>
<!-- Settings - Manage Reports 1.3 -->
										<div class="panel panel-default">
											<div class="panel-heading">Manage Reports</div>
											<div class="panel-body">
												<ul class="list-group">
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-search pull-right"></i> View Reports </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-edit pull-right"></i> Manage Reports </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-bar-chart pull-right"></i> Create Report </a></li>
												</ul>
											</div>
										</div>
<!-- Settings - Manage Events 1.4 -->
										<div class="panel panel-default">
											<div class="panel-heading">Manage Events <span class="badge pull-right">42 Events</span></div>
											<div class="panel-body">
												<ul class="list-group">
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-search pull-right"></i> View Events </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-edit pull-right"></i> Manage Events </a></li>
													<li class="list-group-item"><a href="javascript:void(0);"><i class="icon-plus pull-right"></i> Add Event </a></li>
												</ul>
											</div>
										</div>

									</div>
								</div>
							</div>
<!-- end panels -->
<? } ?>
						</div>

					</div>
					<div class="spacer col-xs-12">
						<p>&nbsp;</p>
					</div>
<!-- ************************************************************************************ -->
				</div>
			</div>
		</div>
	</div>
	<div id="modalWidget" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form name="test-pwd-form" id="test-pwd-form" role="form" action="test-password.php" method="post">
			<input type="hidden" name="_muid" value="<?=$_COOKIE['_muid'];?>">
			<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid'];?>">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="current_password">Current Password</label>
					<input type="password" name="current_password" id="current_password"  class="password form-control" placeholder="current password">
				</div>
				<div id="error_message"></div>
				<div id="new-password" style="display:none;">
					<div class="form-group">
						<label for="new_pwd">New Password</label>
						<input type="password" name="new_pwd" id="new_pwd" class="password form-control" placeholder="new password">
					</div>
					<div class="form-group">
						<label for="new_pwd_confirm">Confirm Password</label>
						<input type="password" name="new_pwd_confirm" id="new_pwd_confirm" class="password form-control" placeholder="confirm new password">
					</div>
					<div id="passwordStrength"></div>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" id="cancel_password" class="btn btn-default" data-dismiss="modal">Close</button>
			  <input type="submit" id="test-password" class="btn btn-primary align-right" value="Submit">
			</div>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
		</form>
	</div>
	<!-- // -->
<!-- css only spinning loader -->
	<div id="loading"></div>

	<? include('lib/shared/javascript.php'); ?>
	<script src="public/js/dashboard.js"></script>
	<script src="public/js/bootstrap-switch.min.js"></script>
	<!-- flot -->
	<script src="lib/reporting/flot.js"></script>
	<script type="text/javascript">
		// control the location bar
/********** manage the difference in window location by appliance ***********/
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
		$(document).ajaxStop(function(data, status){
			console.log('ajaxStop');
			$("#loading").hide();
		});

            $(document).ready(function(){
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

				$('a.scrollup').click(function(){
					$("#slider").animate({ scrollTop: 0 }, 600);
					return false;
				});
            	// slide panel left
            	$("a#open-left").live('click',function(){
            		snapper.open('left');
            	});
            	// slide panel right
            	$("a#open-right").live('click',function(){
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
				// accordion
				$('a.accordion-toggle').on('click', function () {
					var $spans = $('span');
					if( $(this).hasClass('collapsed') !== true ){
						$(this).removeClass('active');
					}else{
						$(this).addClass('active');
					}
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
            		console.log(form);
            		console.log(url);
            		snapper.close();
            	});
            	// dashboard tabs
            	$("#dashboard_manager").bind('click', function (e) {
					e.preventDefault();
					$(this).tab('show');
				});
				// cancel password change
				$("#cancel_password").click(function(e){
					$(".password").val('');
					$("#error_message").html('');
					$("#passwordStrength").replaceWith('<div id="passwordStrength"></div>');
					$("#new-password").hide();
					$('#modalWidget').modal('hide');
				});
				// change password
				$("button#change-password").bind('click', function(e){
					e.preventDefault();
					$('#modalWidget').modal('show');
				});
				$("#test-password").click(function(e){
					e.preventDefault();
					var formName = $("#test-pwd-form").attr('name'),
						formUrl = 'lib/forms/'+ $("form[name='"+formName+"']").attr('action'),
						formMethod = $("form[name='"+formName+"']").attr('method'),
						formData = $("form[name='"+formName+"']").serializeForm(),
						jsonData = JSON.stringify(formData),
						submitJSON = '{ "name": '+formName+', "data": '+jsonData+' }';
					// form validates so do the ajax
					password_controller(formName,formUrl,formMethod,formData);
					e.preventDefault();
				});
				// password strength meter
				$('#new_pwd, #new_pwd_confirm').on('keyup', function(e) {
					if($('#new_pwd').val() != '' && $('#new_pwd_confirm').val() != '' && $('#new_pwd').val() != $('#new_pwd_confirm').val())
					{
						$('#passwordStrength').removeClass().addClass('alert alert-error').html('Passwords do not match!');
						return false;
					}

					// Must have capital letter, numbers and lowercase letters
					var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
					// Must have either capitals and lowercase letters or lowercase and numbers
					var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
					// Must be at least 6 characters long
					var okRegex = new RegExp("(?=.{6,}).*", "g");
					if (okRegex.test($(this).val()) === false) {
						// If ok regex doesn't match the password
						$('#passwordStrength').removeClass().addClass('alert alert-error').html('Password must be 6 characters long.');
					} else if (strongRegex.test($(this).val())) {
						// If reg ex matches strong password
						$('#passwordStrength').removeClass().addClass('alert alert-success').html('Good Password!');
					} else if (mediumRegex.test($(this).val())) {
						// If medium password matches the reg ex
						$('#passwordStrength').removeClass().addClass('alert alert-info').html('Make your password stronger with more capital letters, more numbers and special characters!');
					} else {
						// If password is ok
						$('#passwordStrength').removeClass().addClass('alert alert-error').html('Weak Password, try using numbers and capital letters.');
					}
					return true;
				});
            });
	</script>
</body>
</html>
