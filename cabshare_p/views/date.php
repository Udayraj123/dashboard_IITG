<link rel="stylesheet" type="text/css" href="css/date.css"></link>
<?php
	$fulldate = $_GET['date'];
	$validdate = false;
	$regex = "/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/";
	if(preg_match($regex,$fulldate))
	{
		$dateArray = split('-', $fulldate);
		$date = $dateArray[0];
		$month = $dateArray[1];
		$year = $dateArray[2];
		$formatted_date = get_YMD_date($date,$month,$year);
		if(date_in_current_scope($date,$month,$year)==true)
			$validdate = true;
	}

	function get_self_entry()
	{
		$db_connection=$GLOBALS["db_connection"];
		$db_hostname=$GLOBALS["db_hostname"];
		$db_username=$GLOBALS["db_username"];
		$db_password=$GLOBALS["db_password"];
		$db_database=$GLOBALS["db_database"];
		$formatted_date=$GLOBALS["formatted_date"];
		$username=$GLOBALS["username"];

		$result = array();
		if($db_connection!=null)
		{
			$query = "SELECT * FROM `entries` WHERE `username`='$username' AND `journey_date`='$formatted_date';";
			if($query_run=@mysql_query($query))
			{
				if(@mysql_num_rows($query_run)==0)
					$result['status'] = 'add';
				else
				{
					$result['status'] = 'show';
					$result['data'] = mysql_fetch_assoc($query_run);
				}
			}
			else
				$result['status'] = 'error';
		}
		else
			$result['status'] = 'connection';

		return $result;
	}

	function result_table($src,$des)
	{
		$db_connection=$GLOBALS["db_connection"];
		$db_hostname=$GLOBALS["db_hostname"];
		$db_username=$GLOBALS["db_username"];
		$db_password=$GLOBALS["db_password"];
		$db_database=$GLOBALS["db_database"];
		$formatted_date=$GLOBALS["formatted_date"];
		$query = "SELECT * FROM `entries` INNER JOIN `users` ON entries.username=users.username WHERE journey_date='$formatted_date' AND source='$src' AND destination='$des' ORDER BY travel_time;";
		if($db_connection!=null)
		{
			if($query_run=@mysql_query($query))
			{
				if(@mysql_num_rows($query_run)>0)
				{
					echo "<table class=\"table table-striped\">
						<tr>
							<th>Name</th>
							<th>Webmail</th>";
						if($src=='cam')
							echo "<th>Departure time</th>
								<th>Leaving campus at</th>";
						else if($des=='cam')
							echo "<th>Arrival time</th>";
						echo "<th>Group size travelling</th>
							<th>Residence</th>
							<th>Contact</th>
						</tr>";
						for($i=0;$i<mysql_num_rows($query_run);$i++)
						{
							$name = mysql_result($query_run,$i,'name');
							$webmail = mysql_result($query_run,$i,'webmail');
							$travel_time = date('H:i',strtotime(mysql_result($query_run,$i,'travel_time')));
							$cab_time = date('H:i',strtotime(mysql_result($query_run,$i,'cab_time')));
							$journey_date = mysql_result($query_run,$i,'journey_date');
							$group_size = mysql_result($query_run,$i,'group_size');
							$residence = mysql_result($query_run,$i,'residence');
							$phone = mysql_result($query_run,$i,'phone');
							$fb = mysql_result($query_run,$i,'fb');
							echo "<tr>
								<td>$name</td>
								<td>$webmail</td>
								<td>$travel_time</td>";
							if($src=='cam')
								echo "<td>$cab_time</td>";							
							echo "<td>$group_size people</td>
								<td>$residence</td>
								<td><a onclick=\"showContact('".$name."','".$webmail."','".$phone."','".$fb."','".$residence."');\">Contact</a></td>
							</tr>";
						}
					echo "</table>";
				}
				else
					echo "<h4 class=\"text-center\">No results found</h4>";
			}
			else
				echo "<h4 class=\"text-center\">Cannot connect to database</h4>";
		}
		else
			echo "<h4 class=\"text-center\">Cannot connect to database</h4>";
	}
?>

<div class="container">
<h3 class="text-center"><a class="btn btn-warning" href="?">Back to calender</a></h3>
<?php if($validdate==false) { ?>
	<h2 class="text-center">Invalid/Unavailable date</h2>
<?php } else { ?>

	<h2 class="text-center"><?php echo $date." ".monthName($month)." ".$year; ?></h2>
	<br>

	<?php if($formatted_date>=$ymd_today) { ?>
	<div class="sheet" id="add_form_section">
		<?php if($username!=null) { ?>
			<?php $result = get_self_entry(); ?>
			<?php if($result['status']=='add') { ?>
				<h4 class="center">Add your entry for this date</h4>
				<?php include('entry_form.php'); ?>
			<?php } else if($result['status']=='show') { ?>
				<h4 class="text-center">You have added the following entry for this date :</h4>
				<span class="red" style="text-align:left;">*</span> All times are in 24-hour format
				<table class="table table-bordered table-striped center">
					<tr>
						<th>Source</th>
						<th>Destination</th>
						<?php if($result['data']['source']=="cam"){ ?>
						<th>Departure time</th>
						<th>Leaving campus at</th>
						<?php } else if($result['data']['destination']=="cam") { ?>
						<th>Arrival/Landing time</th>
						<?php } ?>
						<th>Group size travelling</th>
					</tr>
					<tr>
						<td><?php echo ucfirst(getPlaceName($result['data']['source'])); ?></td>
						<td><?php echo ucfirst(getPlaceName($result['data']['destination'])); ?></td>
						<td><?php echo date('H:i',strtotime($result['data']['travel_time'])); ?></td>
						<?php if($result['data']['source']=="cam"){ ?>
						<td><?php echo date('H:i',strtotime($result['data']['cab_time'])); ?></td>
						<?php } ?>
						<td><?php echo $result['data']['group_size']; ?> people(s)</td>
					</tr>
				</table>
				<h4 class="center">
					<button class="btn btn-primary" onclick="toggleform();"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
					<button class="btn btn-danger" onclick="delete_entry();"><span class="glyphicon glyphicon-trash"></span> Delete</button>
				</h4>
				<?php include('entry_form.php'); ?>
				<script type="text/javascript">document.querySelector('#add_form').style.display='none';</script>			
			<?php } else if($result['status']=='connection') { ?>
				<h4 class="text-center">Unable to connect to server</h4>
			<?php } else { ?>
				<h4 class="text-center">Some error occured</h4>
			<?php } ?>
		<?php } else { ?>
			<h4 class="text-center">You must be logged in to add/change your entry</h4>
		<?php } ?>
	</div>
	<?php } ?>

	<h3>Results for this date :</h3>

	<div id="result_section">
		<div class="result-group">
			<div class="direction_tab" id="cam_air_tab"><span class="glyphicon glyphicon-plus"></span> Campus to Airport</div>
			<div class="direction_res" id="cam_air_res">
				<?php result_table('cam','air'); ?>
			</div>
		</div>
		<div class="result-group">
			<div class="direction_tab" id="cam_mrs_tab"><span class="glyphicon glyphicon-plus"></span> Campus to Main Railway Station</div>
			<div class="direction_res" id="cam_mrs_res">
				<?php result_table('cam','mrs'); ?>
			</div>
		</div>
		<div class="result-group">
			<div class="direction_tab" id="cam_krs_tab"><span class="glyphicon glyphicon-plus"></span> Campus to Kamakhya Railway Station</div>
			<div class="direction_res" id="cam_krs_res">
				<?php result_table('cam','krs'); ?>
			</div>
		</div>
		<div class="result-group">
			<div class="direction_tab" id="air_cam_tab"><span class="glyphicon glyphicon-plus"></span> Airport to Campus</div>
			<div class="direction_res" id="air_cam_res">
				<?php result_table('air','cam'); ?>
			</div>
		</div>
		<div class="result-group">
			<div class="direction_tab" id="mrs_cam_tab"><span class="glyphicon glyphicon-plus"></span> Main Railway Station to Campus</div>
			<div class="direction_res" id="mrs_cam_res">
				<?php result_table('mrs','cam'); ?>
			</div>
		</div>
		<div class="result-group">
			<div class="direction_tab" id="krs_cam_tab"><span class="glyphicon glyphicon-plus"></span> Kamakhya Railway Station to Campus</div>
			<div class="direction_res" id="krs_cam_res">
				<?php result_table('krs','cam'); ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="contactModal" tabindex='-1'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div><h4><span class="modalName"></span></h4></div>
					<div><strong>Webmail : </strong><span class="modalWebmail"></span></div>
					<div><strong>Phone : </strong><span class="modalPhone"></span></div>
					<div><strong>Facebook link : </strong><span class="modalFB"></span></div>
					<div><strong>Hostel/Residence : </strong><span class="modalResidence"></span></div>
				</div>
			</div>
		</div>
	</div>


<?php } ?>
</div>

<script type="text/javascript">
	formatted_date = "<?php echo $formatted_date; ?>";
</script>
<script type="text/javascript" src="js/date.js"></script>

