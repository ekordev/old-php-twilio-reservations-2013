<div class="tab-pane" id="profile">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4>Personal Profile</h4>
			<form name="contact-profile" method="" action="">
				<ul class="list-group">
					<li class="list-group-item">
						<div class="input-group">
							<input type="tel" name="mobile" class="mobile form-control" disabled value="<?=$mobile;?>" placeholder="Mobile Phone">
							<span class="input-group-addon"><i class="icon-phone"></i></span>
						</div>
					</li>
					<li class="list-group-item">
						<button name="change-password" disabled id="change-password" class="form-control btn btn-success" data-toggle="modal" data-target="#modalWidget">Edit Password</button>
					</li>
					<li class="list-group-item">
						<div class="input-group">
							<input type="email" name="email" disabled class="form-control" value="<?=$email;?>" placeholder="Email Acct">
							<span class="input-group-addon"><i class="icon-envelope"></i></span>
						</div>
					</li>
					<li class="list-group-item">
						<div class="input-group">
							<input type="text" name="full_name" disabled class="form-control" value="<?=$name;?>" placeholder="Full Name">
							<span class="input-group-addon"><i class="icon-user"></i></span>
						</div>
					</li>
					<li class="list-group-item">
						<?
							/*
							if( $position_id >=4 ){
								echo '<h5>' . get_positionCredentials( trim( $position_id ) ) . '</h5>';
							}else{
							*/
						?>
						<!-- select name="position" size="1" class="form-control">
							<option value="0"> ---------- </option>
							<?=get_positionCredentials( trim( $position_id ) );?>
						</select -->
						<?
							/*
							}
							*/
						?>
					</li>
					<li class="list-group-item">
						<button id="submit" disabled name="update" class="form-control btn btn-primary">Update</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>
