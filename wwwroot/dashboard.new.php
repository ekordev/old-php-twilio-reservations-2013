<?php
	session_start();

	if( !isset($_COOKIE['contact_id']) ){
		header( "location: ../logout.php" );
	}else{
		$http_host = strtolower( $_SERVER["HTTP_HOST"] );
		$application	= str_replace( 'https://','',$http_host );
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="translucent">

    <title>GLVIP Sign-In</title>

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
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-wip/css/bootstrap.min.css">
		<!-- Font Awesome CSS -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
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
							<i class="close-drawer icon-chevron-right icon-border"></i>
						</a>
					</div>
					<div id="menu-items" class="list-group">
						<a class="list-group-item" href="../dashboard.php?vid=<?=$_GET['vid'];?>&cid=<?=$_GET['cid'];?>"><i class="icon-home"></i> Dashboard </a>
						<a class="list-group-item active" href="../guest-list.php?vid=<?=$_GET['vid'];?>&cid=<?=$_GET['cid'];?>"><i class="icon-star icon-border"></i> Guest List </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-glass"></i> Table Service </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-globe"></i> Promoters </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-building"></i> Venues </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-bar-chart"></i> Reports </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-user"></i> Users </a>
						<a class="list-group-item" href="javascript:void(0);"><i class="icon-wrench"></i> Settings </a>
						<a class="list-group-item" href="../logout.php"><i class="icon-lock"></i> Logout </a>
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
							<i class="close-drawer icon-chevron-left icon-border"></i>
						</a>
						<h4 class="pull-right">Guest Data</h4>
					</div>
					<form id="guest-data-insert" name="guest-data-insert" method="post" action="guest-data.php">
					<input type="hidden" name="venue_id" value="<?=$_COOKIE['venue_id'];?>">
					<input type="hidden" name="contact_id" value="<?=$_COOKIE['contact_id'];?>">
					<input type="hidden" name="patron_id" value="<?=$_GET["pid"];?>">
					<input type="hidden" name="data_patron_id" value="">
					<input type="hidden" name="data_contact_id" value="">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="input-group">
								<input type="tel" name="data_mobile" id="data_mobile-data" class="mobile form-control" placeholder="Mobile Phone">
								<span class="input-group-addon"><i class="icon-phone"></i></span>
							</div>
						</li>
						<li class="list-group-item">
							<div class="input-group">
								<input type="text" name="fname" class="form-control" placeholder="First Name">
								<span class="input-group-addon"><i class="icon-user"></i></span>
							</div>
						</li>
						<li class="list-group-item">
						<div class="input-group">
							<input type="text" name="lname" class="form-control" placeholder="Last Name">
							<span class="input-group-addon"><i class="icon-user"></i></span>
						</div>
						</li>
						<li class="list-group-item">Girl
							<div id="gender" class="make-switch" data-on="info" data-off="success" data-on-label="<i class='icon-female icon-white'></i>" data-off-label="<i class='icon-male'></i>" data-animated="false">
								<input type="checkbox" name="gender_id" checked>
							</div> Boy
						</li>
					</ul>
					<ul class="list-group">
						<li class="list-group-item">
							<div class="input-group">
								<input type="email" name="email" class="form-control" value="" placeholder="Email Address">
								<span class="input-group-addon"><i class="icon-envelope"></i></span>
							</div>
						</li>
					</ul>
					<div class="button-group btn-group-justified">
						<a href="javascript:void(0);" name="guest_reset" id="guest_reset" class="btn btn-default">Reset</a>
						<a href="javascript:void(0);" name="guest_submit" id="guest_submit" class="btn btn-primary">Submit</a>
					</div>
					</form>
					<br>
				</div>
				<? }else{ ?>
				<div class="full-height nav nav-tabs nav-stacked">
					<div id="search-title" class="clearfix">
						<a href="javascript:void(0);" class="drawer-close pull-left">
							<i class="close-drawer icon-chevron-left icon-border"></i>
						</a>
						<h4 class="pull-right">Search</h4>
					</div>
					<form id="search-form" name="search-form" method="post" action="search.php">
						<input type="hidden" name="credentials_id" value="<?=$_COOKIE['credentials_id'];?>">
						<input type="hidden" name="contact_id" value="<?=$_COOKIE['contact_id'];?>">
					<ul id="search-form" class="list-group">
						<li class="list-group-item">
							<select name="event" size="1" class="form-control">
								<option value="0">Search by Event...</option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
							</select>
						</li>
						<li class="list-group-item">
							<input type="tel" name="mobile" id="mobile" class="mobile form-control" placeholder="search by mobile...">
						</li>
						<li class="list-group-item">
							<input type="text" name="name" id="name" class="form-control" placeholder="search by name...">
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
					<br>
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
						<i class="icon icon-search icon-muted"></i>
						<? }else{ ?>
						<i class="icon icon-cog icon-muted"></i>
						<? } ?>
					</a>
				</div>
			</div>
		</div>
		<!-- content -->
		<div id="main-content" style="scroll-y: scroll;">
			<a href="#" class="scrollup">Top</a>
			<div id="slider">
				<div class="slider-content" class="container">
					<div id="patron-guestlist-details" class="sm-xs-12">
						<h4>Dashboard</h4>
						<div class="panel panel-default">
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="guest_venues" class="form-control clearfix">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="tableservice_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="promoter_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="venue_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
															<td>The Butcher &amp; Bollock</td>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="report_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
											<h5>Aug 2013</h5>
											<div id="charts" class="panel-scroller">
												<div id="guest_venues" class="chart-container clearfix">
													<canvas id="guest_chart" class="chart" height="150" width="300" style="width: 300px; height: 150px;"></canvas>
												</div>
												<div id="table_venue_chart" class="chart-container clearfix">
													<canvas id="table_chart" class="chart" height="150" width="300" style="width: 300px; height: 150px;"></canvas>
												</div>
												<div id="table_venue_chart" class="chart-container clearfix">
													<canvas id="sms_chart" class="chart" height="150" width="300" style="width: 300px; height: 150px;"></canvas>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="users_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
																	</p><ul class="list-group">
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
																<p></p>
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
																	</p><ul class="list-group">
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
																<p></p>
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
																	</p><ul class="list-group">
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
																<p></p>
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
																	</p><ul class="list-group">
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
																<p></p>
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
											<form role="form">
												<input type="hidden" name="credentials_id" value="0">
												<input type="hidden" name="contact_id" value="3">
												<select name="setting_venues" class="form-control">
													<option value="0"> All Venues </option>
												</select>
											</form>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // -->
<!-- css only spinning loader -->
	<div id="loading"></div>
	<? include('lib/shared/javascript.php'); ?>
	<script src="public/js/bootstrap-switch.min.js"></script>
	<script src="public/js/bootstrap-select.min.js"></script>
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
		$(document).ajaxStop(function(){
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
            	// guest list data check on-blur
            	$("input[name='data_mobile']").bind('blur', function(e){
            		e.preventDefault();
            		var mobile = $(this).val().replace(/[^\d]/g, ""),
            			formMethod = $("form[name='guest-data-insert']").attr("method"),
            			formUrl = 'lib/forms/' + $("form[name='guest-data-insert']").attr("action");
					$.ajax({
						dataType:"json",
						type: formMethod,
						url: formUrl,
						data: { data: mobile }
					}).done(function( results ){
						if(results){
							$("input[name='data_patron_id']").val( results[0].patron_id );
							$("input[name='data_contact_id']").val( results[0].contact_id );
							$("input[name='fname']").val( results[0].usr_fname );
							$("input[name='lname']").val( results[0].usr_lname );
							$("input[name='email']").val( results[0].usr_email );
							if( results[0].gender_id == 1 ){
								$('input[name=gender_id]').attr('checked', false)
								$("#gender").bootstrapSwitch('setState', false);
							}else{
								$('input[name=gender_id]').attr('checked', true);
								$("#gender").bootstrapSwitch('setState', true);
							}
						}
					});
            	});
            });
	</script>
</body>
</html>
