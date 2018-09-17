<?php
	date_default_timezone_set( 'America/Vancouver' );

	include "get_Reservations.php";

	$midnight = date('Y-m-d 00:00:00');

	$yesterday = new DateTime('yesterday');
	$yesterday = $yesterday->format('Y-m-d 15:30:00');

	$now = date('Y-m-d h:i:s');
//	$now = $now->format('Y-m-d h:i:s');

	$str = "Guest List for: ";
/*
	if($midnight > $now){
		if($yesterday < $midnight){
			$start_date = new DateTime('yesterday');
			$start_date = $start_date->format('Y-m-d 15:30:00');
			$str .= $start_date . " - ";
			$end_date = new DateTime('today');
			$end_date = $end_date->format('Y-m-d 04:30:00');
			$str .= $end_date;
		}
	}elseif($midnight < $now){
		if($today > $midnight){
			$start_date = new DateTime('today');
			$start_date = $start_date->format('Y-m-d 15:30:00');
			$str .= $start_date . " - ";
			$end_date = new DateTime('tomorrow');
			$end_date = $end_date->format('Y-m-d 04:30:00');
			$str .= $end_date;
		}
	}
*/
	$venue_id = $cipher->decrypt($_COOKIE["_vuid"]);
	$start_date = $_COOKIE["start_date"];
	$end_date = $_COOKIE["end_date"];

//	echo "venue_id: " . $venue_id . "<br>";
//	echo "start_date: " . $start_date . "<br>";
//	echo "end_date: " . $end_date . "<br>";

	$results = get_Reservations( $venue_id, $start_date, $end_date );

	$dhmCnt = count($results);
	$vipCnt = 0;
	$guestCnt = 0;
//	echo "<br><pre>";
//	print_r($results);
//	echo "</pre>";
	$dhm = "";
	$guests = "";
	$vip = "";

	for ($i=0; $i<=$dhmCnt-1; $i++){
		$_ruid = $results[$i]["_ruid"];
		$sms_request = $results[$i]["sms_request"];
		$sms_keycode = strtok( strtolower( $sms_request ), " " );
		$sms_keyword = str_replace( $sms_keycode . " ", "", strtolower( $sms_request) );
		/*
		switch($sms_keyword){
			case "guestlist": $cls = ' warning'; break;
			case "tableservice": $cls = ' danger'; break;
		}
		*/

		$dhm .= '<li class="list-group-item list-column" data-id="' . $results[$i]["_ruid"];
		$dhm .= '" style="display:block;">' . $results[$i]["guest_name"];
		$dhm .= '<span class="badge pull-right">' . $results[$i]["guests"] . '</span></li>';

		$guests = '<li class="list-group-item list-column" data-id="#" style="display:block;">';
		$guests .= 'No Guests at this time.';
		$guests .= '<span class="badge pull-right">0</span></li>';

		$vip = '<li class="list-group-item list-column" data-id="#" style="display:block;">';
		$vip .= 'No VIP Table Service at this time.';
		$vip .= '<span class="badge pull-right">0</span></li>';
	}
?>
	<div class="row">
		<div class="col-xs-12">
			<ul id="guestlist-tabs" class="nav nav-tabs">
				<li><a href="#guests" data-toggle="tab"><i class="fa fa-user fa-lg"></i></a></li>
				<li><a href="#vip" data-toggle="tab"><i class="fa fa-glass fa-lg"></i></a></li>
				<li class="active"><a href="#staff" data-toggle="tab"><i class="fa fa-building-o fa-lg"></i></a></li>
			</ul>
			<div class="tab-content">
<!-- guests -->
				<div class="tab-pane fade" id="guests">
					<h4 class="indent clearfix">Guests <span class="label label-info"><?php echo $guestCnt; ?></span>
						<small>
							<a id="add-guest" href="#" class="btn pull-right"  data-toggle="modal" data-target="#modalWidget" style="margin-top: -12px;">
							<i class="fa fa-border fa-plus fa-sm"></i></a>
						</small>
					</h4>
					<ul class="list-group"><?php echo $guests; ?></ul>
				</div>
<!-- vip -->
				<div class="tab-pane fade" id="vip">
					<h4 class="indent clearfix">Table Service <span class="label label-info"><?php echo $vipCnt; ?></span>
						<small>
							<a id="add-vip" href="#" class="btn pull-right" data-toggle="modal" data-target="#modalWidget" style="margin-top: -12px;">
							<i class="fa fa-border fa-plus fa-sm"></i></a>
						</small>
					</h4>
					<ul class="list-group"><?php echo $vip; ?></ul>
				</div>
<!-- staff -->
				<div class="tab-pane fade in active" id="staff">
					<h4 class="indent clearfix">Staff <span class="label label-info"><?php echo $dhmCnt; ?></span>
						<small>
							<a id="add-dhm" href="#" class="btn pull-right" data-toggle="modal" data-target="#modalWidget" style="margin-top: -12px;">
							<i class="fa fa-border fa-plus fa-sm"></i></a>
						</small>
					</h4>
					<ul class="list-group"><?php echo $dhm; ?></ul>
				</div>
			</div>
		</div>
	</div>
