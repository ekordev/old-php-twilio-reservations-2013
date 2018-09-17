					<form id="guest-insert" name="guest-insert" method="post" action="guest-data.php">
					<input type="hidden" name="venue_id" value="<?=$_COOKIE['_vuid'];?>">
					<input type="hidden" name="contact_id" value="<?=$_COOKIE['_cuid'];?>">
					<?php
						if( isset($_GET['pid']) ){
							print('<input type="hidden" name="patron_id" value="' . $cipher->encrypt($_GET["pid"]) . '">');
						}else{
							print('<input type="hidden" name="patron_id" value="0">');
						}
					?>
					<ul class="list-group">
						<li class="list-group-item">
							<select name="guestlist-type" class="form-control" id="guestlist-type">
								<option value=""></option>
								<option value="guestlist"> Guest List </option>
								<option value="tableservice"> Table Service</option>
							</select>
						</li>
						<li class="list-group-item">
							<div class="input-group">
								<input type="text" pattern="[0-9]*" name="data_mobile" id="data_mobile-data" class="mobile form-control" placeholder="Mobile Phone">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							</div>
						</li>
						<li class="list-group-item">
							<div class="input-group">
								<input type="text" name="full_name" class="form-control" placeholder="Full Name">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
							</div>
						</li>
						<li class="list-group-item">Girl
							<div id="gender_select" class="make-switch" data-on="info" data-off="success" data-on-label="<i class='fa fa-female'></i>" data-off-label="<i class='fa fa-male'></i>" data-animated="false">
								<input type="checkbox" name="gender_select_id" checked>
							</div> Boy
						</li>
					</ul>
					<div class="button-group btn-group-justified">
						<a href="javascript:void(0);" name="guest_reset" id="guest_reset" class="btn btn-default">Reset</a>
						<a href="javascript:void(0);" name="guest_submit" id="guest_submit" class="btn btn-primary">Submit</a>
					</div>
					</form>
					<br>
				</div>
