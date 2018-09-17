<?php // manage the individual reservation
	$today = new DateTime('today');
	$today = $today->format('Y-m-d h:i:s');

	include "get_reservationDetails.php";
	include "get_guestInformation.php";
	$result = get_reservationDetails( $_GET["pid"] );
	$guest = get_guestInformation( $_GET["pid"] );
	$guest = $guest[0];
//	echo "<pre>";
//	print_r( $guest );
//	echo "</pre>";

		$sms_request = $result[0]["sms_request"];
		$sms_keycode = strtok( strtolower( $sms_request ), " " );
		$sms_keyword = str_replace( $sms_keycode . " ", "", strtolower( $sms_request) );
		switch( $sms_keyword ){
			case "guestlist": $icon = "fa-globe"; $cls = "guest-promoter"; $value = '';
			break;
			case "tableservice": $icon = "fa-glass"; $cls = "guest-vip"; $value = ' checked';
			break;
			default: $icon = "fa-user"; $cls="guest-request"; $value = '';
		}
?>
<form name="guest_list_info">
<input type="hidden" name="frm_type" value="dhm">
<input type="hidden" name="contact_id" value="<?=$_COOKIE['_uuid']; ?>">
<input type="hidden" name="company_id" value="<?=$_COOKIE['_cuid']; ?>">
<input type="hidden" name="venue_id" value="<?=$_COOKIE['_vuid']; ?>">
<input type="hidden" name="referrer_id" value="<?=$cipher->encrypt($result[0]['_rfid']); ?>">
<input type="hidden" name="patron_id" value="<?=$cipher->encrypt($_GET['pid']); ?>">
<input type="hidden" name="timestamp" value="<?=$today;?>">
<input type="hidden" name="data" value="<?=$cipher->encrypt( json_encode($result[0]) ); ?>">
<input type="hidden" name="female" id=female" value="<?=$guest['gender_female']; ?>">
<input type="hidden" name="male" id="male" value="<?=$guest['gender_male']; ?>">
<input type="hidden" name="nc" id=nc" value="<?=$guest['cover_nc']; ?>">
<input type="hidden" name="rc" id="rc" value="<?=$guest['cover_rc']; ?>">
<input type="hidden" name="fc" id=fc" value="<?=$guest['cover_fc']; ?>">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Guest Details</strong>
					<span class="make-switch pull-right" data-on="success" data-off="default" data-animated="false" data-on-label="<i class='fa fa-star'></i>" data-off-label="<i class='fa fa-star-o'></i>" style="margin: -5px -10px; padding-right: -10px;">
							<input type="checkbox" name="patron-checkedin" id="patron-checkedin">
					</span>
				</div>
				<ul class="list-group">
					<li class="list-group-item clearfix">
						<button type="button" name="edit" data-id="" class="btn btn-info btn-xs" style="margin-top:-5px;"><i class="fa fa-pencil fa-xs"></i></button>
						<span style="font-size: 18px;"><strong><?=$result[0]["guest_name"];?></strong></span>
					</li>
					<li class="list-group-item clearfix">
						<strong>Referred By:</strong><span class="pull-right"><?=$result[0]["referred"]?></span>
					</li>
					<li class="list-group-item clearfix"><strong>Table Service</strong>
						<span class="make-switch switch-large pull-right" data-on="success" data-off="default" data-animated="false" data-on-label="YES" data-off-label="NO" style="margin: -9px; padding-right: -10px;">
							<input type="checkbox" name="table_service" id="patron-table-service">
						</span>
					</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item clearfix"><strong>Total Guests Expected?</strong><span class="pull-right"><?= $result[0]["gnum"]; ?></span></li>
					<li class="list-group-item clearfix"><span id="count-female" class="increment" style="font-size: 24px;"><?=$guest['gender_female']; ?></span> <i class="fa fa-female fa-2x"></i>
						<div class="pull-right btn-group" style="margin: -5px; padding-right: -10px;">
							<button class="count-plus btn btn-success btn-large" data-id="#count-female" data-fld="female"><i class="fa fa-plus"></i></button>
							<button class="count-minus btn btn-primary btn-large" data-id="#count-female" data-fld="female"><i class="fa fa-minus"></i></button>
						</div>
					</li>
					<li class="list-group-item clearfix"><span id="count-male" class="increment" style="font-size: 24px;"><?=$guest['gender_male']; ?></span> <i class="fa fa-male fa-2x"></i>
						<div class="pull-right btn-group" style="margin: -5px; padding-right: -10px;">
							<button class="count-plus btn btn-success btn-large" data-id="#count-male" data-fld="male"><i class="fa fa-plus"></i></button>
							<button class="count-minus btn btn-primary btn-large" data-id="#count-male" data-fld="male"><i class="fa fa-minus"></i></button>
						</div>
					</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item clearfix"><span style="margin-top: 10px;"><strong>Cover Breakdown</strong></span>
						<span class="pull-right">
							<ul class="list-inline">
								  <li><span class="label label-default"><?php echo $result[0]['ttl_nc']; ?></span></li>
								  <li><span class="label label-warning"><?php echo $result[0]['ttl_rc']; ?></span></li>
								  <li><span class="label label-success"><?php echo $result[0]['ttl_fc']; ?></span></li>
							</ul>
						</span>
					</li>
					<li class="list-group-item clearfix"><span id="count-nc" class="label label-default" style="font-size: 24px;"><?=$guest['cover_nc']; ?></span>
					<strong>Comp </strong>
						<div class="pull-right btn-group" style="margin: -5px; padding-right: -10px;">
							<button class="count-plus btn btn-success btn-large" data-id="#count-nc" data-fld="nc"><i class="fa fa-plus"></i></button>
							<button class="count-minus btn btn-primary btn-large" data-id="#count-nc" data-fld="nc"><i class="fa fa-minus"></i></button>
						</div>
					</li>
					<li class="list-group-item clearfix"><span id="count-rc" class="label label-warning" style="font-size: 24px;"><?=$guest['cover_rc']; ?></span>
					<strong>Reduced Cover</strong>
						<div class="pull-right btn-group" style="margin: -5px; padding-right: -10px;">
							<button class="count-plus btn btn-success btn-large" data-id="#count-rc" data-fld="rc"><i class="fa fa-plus"></i></button>
							<button class="count-minus btn btn-primary btn-large" data-id="#count-rc" data-fld="rc"><i class="fa fa-minus"></i></button>
						</div>
					</li>
					<li class="list-group-item clearfix"><span id="count-fc" class="label label-success" style="font-size: 24px;"><?=$guest['cover_fc']; ?></span>
					<strong>Full Cover</strong>
						<div class="pull-right btn-group" style="margin: -5px; padding-right: -10px;">
							<button class="count-plus btn btn-success btn-large" data-id="#count-fc" data-fld="fc"><i class="fa fa-plus"></i></button>
							<button class="count-minus btn btn-primary btn-large" data-id="#count-fc" data-fld="fc"><i class="fa fa-minus"></i></button>
						</div>
					</li>
				</ul>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary btn-lg btn-block">submit</button>
				</div>
			</div>
			<div><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></div>
			</form>
		</div>
	</div>
