<div class="tab-pane active" id="settings">
	<h4>Dashboard Settings</h4>
	<div class="panel-group" id="settingsaccordion">
<!-- guest list settings -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#guestlist_settings">
						Guest List Controller
					</a>
				</h5>
			</div>
			<div id="guestlist_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<tbody>
							<tr>
								<td>Requested</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Approved</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Denied</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Arrived</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Collected</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Outstanding</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>SMS %</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Email %</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Staff %</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Promoter %</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Street Team %</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>TTL Returning Customers</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- Table Services Settings -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#tableservice_settings">
						Table Service Controller
					</a>
				</h5>
			</div>
			<div id="tableservice_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<tbody>
							<tr>
								<td>Guests</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Arrived</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Acquired</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>TTL Returning Patrons</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- Promoter Settings -->
<? if( $position_id < 4 ){ ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#promoters_settings">
						Promoters Controller
					</a>
				</h5>
			</div>
			<div id="promoters_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<tbody>
							<tr>
								<td>Guests</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Arrived</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Acquired</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data Pending</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>TTL Returning Patrons</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- Venue Settings -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#venue_settings">
						Venue Controller
					</a>
				</h5>
			</div>
			<div id="venue_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<tbody>
							<tr>
								<td>Academic</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Hookers Green</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Bimini</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>The Calling</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Cinema</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Lamplighter</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Library Square</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Metropole</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Oxford</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Butcher & Bollock</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Republic</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Portside Pub</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Bar None</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>The Annex</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Killjoy</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Clough Club</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Granville Room</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<? } ?>
<? if( $position_id < 5 ){ ?>
<!-- Report Settings -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#reports_settings">
						Reports Controller
					</a>
				</h5>
			</div>
			<div id="reports_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<table class="table table-condensed table-striped">
						<tbody>
							<tr>
								<td>Pie Chart</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox">
									</span>
								</td>
							</tr>
							<tr>
								<td>Donut Chart</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox">
									</span>
								</td>
							</tr>
							<tr>
								<td>String Chart</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Flot Chart</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Bar Chart</td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!-- User Settings -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#settingsaccordion" href="#user_settings">
						User Controller
					</a>
				</h5>
			</div>
			<div id="user_settings" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<h5 class="panel-title">GL Staff</h5>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td>Venue: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Position: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Name: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Logged-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Checked-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data-collected: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Ratio: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>New Requests: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<h5 class="panel-title">VIP Staff</h5>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td>Venue: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Position: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Name: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Logged-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Checked-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data-collected: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Ratio: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>New Requests: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<h5 class="panel-title">Data Staff</h5>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td>Venue: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Position: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Name: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Logged-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data-collected: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<h5 class="panel-title">Street Teams</h5>
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td>Venue: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Position: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Name: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Logged-In: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Data-collected: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>New Requests: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
							<tr>
								<td>Ratio: </td>
								<td>
									<span class="make-switch switch-mini pull-right">
										<input type="checkbox" checked>
									</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<? } ?>
<!-- Settings Control (undetermined) -->
	</div>
	<br>
</div>
