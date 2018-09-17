								<div class="col-xs-12">
								<form name="guest_list_info" id="guest_list_info" role="form">
									<input type="hidden" name="_uuid" value="<?=$_COOKIE['_uuid']; ?>">
									<input type="hidden" name="_auid" value="<?=$_COOKIE['_auid']; ?>">
									<input type="hidden" name="gl_request" value="<?=$gl_request; ?>">
									<input type="hidden" name="_puid" value="<?=$puid; ?>">
									<input type="hidden" name="_token" value="<?=$token; ?>">
									<input type="hidden" name="a" value="<?=$gl_request_type; ?>">
									<ul class="list-group">
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Referral: </span>
												<select name="gl_referral" id="gl_referral" class="form-control">
													<option value="0"> -- select advert referral (for metrics) -- </option>
													<?=get_Referral($json_file); ?>
												</select>
											</div>
										</li>
									</ul>
									<? if( $puid === 0 ){ ?>
									<ul class="list-group">
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Name: </span>
												<input type="text" name="gl_name" id="data_gl_name" class="form-control" value="<?=$name;?>" placeholder="Guest Name">
											</div>
										</li>
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Birthdate: </span>
												<input type="date" name="gl_dob" id="data_gl_dob" class="form-control" value="<?=$dob;?>" placeholder="mm/dd/yyyy">
											</div>
										</li>
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Gender: </span>
												<select name="gl_gender" id="data_gl_gender" class="form-control">
													<option value="0"></option>
													<option value="1"<? if($gender_id == 1){ print(' selected="selected"'); }?>> Male </option>
													<option value="2"<? if($gender_id == 2){ print(' selected="selected"'); }?>> Female </option>
												</select>
											</div>
										</li>
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Mobile: </span>
												<input type="tel" name="gl_mobile" id="data_gl_mobile" class="mobile form-control" value="<?=$phone;?>" placeholder="(604) 555-1212">
											</div>
										</li>
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Email: </span>
												<input type="email" name="gl_email" id="data_gl_email" class="form-control" value="<?=$email;?>" placeholder="you@email.com">
											</div>
										</li>
									</ul>
									<? }else{ ?>
									<ul class="list-group">
										<li class="list-group-item clearfix">
											<span class="pull-right"><button id="edit_name" class="edit_item btn btn-primary">Edit</button></span>
											<span class="pull-left"><b>Name: </b><?=$name;?></span>
										</li>
										<li class="list-group-item clearfix">
											<span class="pull-right"><button id="edit_gender" class="edit_item btn btn-primary">Edit</button></span>
											<span class="pull-left"><b>Gender: </b><?=$gender;?></span>
										</li>
										<li class="list-group-item clearfix">
											<span class="pull-right"><button id="edit_dob" class="edit_item btn btn-primary">Edit</button></span>
											<span class="pull-left"><b>Birthdate: </b><?=$dob;?></span>
										</li>
										<li class="list-group-item clearfix">
											<span class="pull-right"><button id="edit_phone" class="edit_item btn btn-primary">Edit</button></span>
											<span class="pull-left"><b>Phone: </b><?=$phone;?></span>
										</li>
										<li class="list-group-item clearfix">
											<span class="pull-right"><button id="edit_email" class="edit_item btn btn-primary">Edit</button></span>
											<span class="pull-left"><b>Email: </b><a href="mailto:<?=$email;?>"><?=$email;?></a></span>
										</li>
									</ul>
									<? } ?>
									<ul class="list-group">
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Venue </span>
												<select name="gl_venue" id="gl_venue" class="form-control">
													<option value="0"> --- </option>
													<?=get_Venues( $venue_id, $venue, $application ); ?>
												</select>
											</div>
										</li>
										<li class="list-group-item">
											<div class="input-group">
												<span class="input-group-addon"> Number Guests </span>
												<input type="number" name="gl_numguests" id="gl_numguests" value="<?=$guests;?>" class="form-control">
											</div>
										</li>
										<li class="list-group-item">
											<p id="gl_date_request" class="text-danger"><b>Request Date: </b><?=$gl_date;?></p>
											<div class="input-group">
												<span class="input-group-addon"> Date - Time </span>
												<input type="datetime-local" name="gl_datetime" id="gl_datetime" class="form-control" placeholder="31/12/2013 08:30PM">
											</div>
										</li>
									</ul>
									<div class="spacer center-block">
										<div style="text-align: center;">
											<div class="btn-group">
												<button id="approve" class="btn-guestlist btn btn-success btn-default btn-lg"><i class="fa fa-check"></i></button>
												<button id="deny" class="btn-guestlist btn btn-danger btn-default btn-lg"><i class="fa fa-minus"></i></button>
												<button id="whitelist" class="btn-guestlist btn btn-info btn-default btn-lg"><i class="fa fa-check-circle"></i></button>
												<button id="blacklist" class="btn-guestlist btn btn-primary btn-default btn-lg"><i class="fa fa-minus-circle"></i></button>
											</div>
										</div>
									</div>
									<div class="spacer center-block">
										<div style="text-align: center;">
											<div class="btn-group">
												<button id="delete" class="btn-guestlist btn btn-default btn-lg"> DEL </button>
											</div>
										</div>
									</div>
								</form>
								</div>
