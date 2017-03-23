<form id="add_form" class="form-horizontal" role="form">
	<br>
	<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
		<div class="center light"><strong>Note :</strong> Enter all times in 24-hour format</div><br>
		<div class="form-group hidden">
			<input class="form-control hidden" type="text" name="journey_date" value="<?php echo $formatted_date; ?>">
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<label class="control-label" for="direction">Choose travel direction</label>
			</div>
			<div class="col-sm-1 hidden-xs">:</div>
			<div class="col-sm-6">
				<select class="form-control" name="direction">
					<option data-category="direction" data-from="" data-to="">Choose</option>
					<option data-category="direction" data-from="cam" data-to="air">Campus to Airport</option>
					<option data-category="direction" data-from="cam" data-to="mrs">Campus to Main railway station</option>
					<option data-category="direction" data-from="cam" data-to="krs">Campus to Kamakhya railway station</option>
					<option data-category="direction" data-from="air" data-to="cam">Airport to Campus</option>
					<option data-category="direction" data-from="mrs" data-to="cam">Main railway station to Campus</option>
					<option data-category="direction" data-from="krs" data-to="cam">Kamakhya railway station to Campus</option>
				</select>
			</div>
		</div>
		<div class="form-group" id="departure_time_group">
			<div class="col-sm-5">
				<label class="control-label" for="travel_time">Flight/Train time</label>
			</div>
			<div class="col-sm-1 hidden-xs">:</div>
			<div class="col-sm-5">
				<div class="col-xs-5">
					<input type="text" name="travel_time_hour" class="form-control hollow-input" placeholder="Hour" maxlength="2">
				</div>
				<div class="col-xs-1 text-center">:</div>
				<div class="col-xs-5">
					<input type="text" name="travel_time_min" class="form-control hollow-input" placeholder="Min" maxlength="2">
				</div>
			</div>
		</div>
		<div class="form-group" id="cab_time_group">
			<div class="col-sm-5">
				<label class="control-label" for="cab_time">Need cab at</label>
			</div>
			<div class="col-sm-1 hidden-xs">:</div>
			<div class="col-sm-5">
				<div class="col-xs-5">
					<input type="text" name="cab_time_hour" class="form-control hollow-input" placeholder="Hour" maxlength="2">
				</div>
				<div class="col-xs-1 text-center">:</div>
				<div class="col-xs-5">
					<input type="text" name="cab_time_min" class="form-control hollow-input" placeholder="Min" maxlength="2">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-5">
				<label class="control-label" for="group_size">Group size travelling <br><span class="light">(Including yourself)</span></label>
			</div>
			<div class="col-sm-1 hidden-xs">:</div>
			<div class="col-lg-3 col-sm-4">
				<input type="text" name="group_size" class="form-control hollow-input" placeholder="No. of people" maxlength="1">
			</div>
		</div>
		<div id="messageNotice">
			<div class="alert alert-danger" role="alert" style="padding:1%;">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				<span class="msg"></span>
			</div>
		</div>
		<div id="successNotice">
			<div class="alert alert-success" role="alert" style="padding:1%;">
				<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				<span class="msg"></span>
			</div>
		</div>
		<div class="center"><input type="submit" value="Submit" class="btn btn-success"></div>
	</div>
	</div>
</form>

<script type="text/javascript" src="js/add_entry.js"></script>
