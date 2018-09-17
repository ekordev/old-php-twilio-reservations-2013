								<form name="guest_list_info">
								<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid']; ?>">
								<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid']; ?>">
								<input type="hidden" name="reqId" value="<?=$gl_request; ?>">
								<input type="hidden" name="req" value="<?=$gl_request_type; ?>">
<?
	// replace with real code
	$str = '';
	for ($i = 0; $i <= 4; $i++) {
		$str .= '<option value="'.$i.'">'.$i.'</option>';
	}
?>
								<ul class="list-group">
									<li class="list-group-item">
										<div id="patron_type">
											<strong> GL Type: </strong> <span class="pull-right"><i class="icon-star"></i> General </span>
										</div>
									</li>
									<li class="list-group-item">
										<div id="patron_id"><strong>Patron: </strong> <span id="patron_name" class="pull-right">Carissa Campeotto</span></div>
									</li>
									<li class="list-group-item">
										<label for="checkin_patron">Checked In: </label>
										<div class="make-switch switch-small pull-right" data-on="primary" data-off="default" data-animated="false" data-on-label="YES" data-off-label="NO">
											<input type="checkbox" name="patron-checkedin" id="patron-checkedin">
										</div>
									</li>
								</ul>
								<ul class="list-group">
									<li class="list-group-item">
										<div id="patron_guests"><strong>Number of Guests: </strong> <span id-"ttl_guests" class="badge pull-right">+8</span></div>
									</li>
									<li class="list-group-item">
										<div id="patron_guests_arrived"><strong>Number Arrived: </strong>
											<span id="ttl_arrived" class="pull-right">
												<span class="badge"> 2 <i class="icon-male"></i></span>
												<span class="badge"><i class="icon-female"></i> 2</span>
											</span>
										</div>
									</li>
								</ul>
								<ul class="list-group">
									<li class="list-group-item">
										<div id="num_checkins_male">
											<label for="num_male">Number of Men: </label>
											<span id="ttl_males">
											<select name="num_males" size="1" class="pull-right">
												<?=$str;?>
											</select>
											</span>
										</div>
									</li>
									<li class="list-group-item">
										<div id="num_checkins_female">
											<label for="num_females">Number of Women: </label>
											<span id="ttl_females">
											<select name="num_females" size="1" class="pull-right">
												<?=$str;?>
											</select>
											</span>
										</div>
									</li>
									<li class="list-group-item">
										<label for="table_service">Table Service: </label>
										<div class="make-switch switch-small pull-right" data-on="primary" data-off="default" data-animated="false" data-on-label="YES" data-off-label="NO">
											<input type="checkbox" name="table_service" id="patron-table-service">
										</div>
									</li>
								</ul>
								<div class="button-group btn-group-justified">
									<a href="javascript:void(0);" name="abort" id="abort-checkin" class="btn btn-default">Abort</a>
									<a href="javascript:void(0);" name="checkin" id="checkin" class="btn btn-primary">Check In</a>
								</div>
								</form>
