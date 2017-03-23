<link rel="stylesheet" type="text/css" href="css/calendar.css"></link>
<?php
	$current_month_start_day = weekday(date_format(date_create($current_year."-".$current_month."-01"),"w"));
	$next_month_start_day = weekday(date_format(date_create($next_year."-".$next_month."-01"),"w"));
	function put($date,$month,$year)
	{
		echo "<td class=\"calender_date_cell\">";
		echo "<a class=\"calender_link\" href=\"?date=".sprintf("%02d",$date)."-".sprintf("%02d",$month)."-$year\">";
		// echo "<div class=\"date_left\"><div class=\"lt\"></div><div class=\"lm\"></div><div class=\"lb\"></div></div>";
		if(strlen(strval($date))==1)
			echo "&nbsp;".$date."&nbsp;";
		else
			echo $date;
		// echo "<div class=\"date_right\"><div class=\"rt\"></div><div class=\"rm\"></div><div class=\"rb\"></div></div>";
		echo "</a>";
		echo "</td>";
	}
?>

<div class="container">
	<br><br>
	<div class="row">
		<div class="col-md-8">
			<h4>Click on the date for which you wish to see if others are interested in sharing cab for that day and to add the time when you need cab.</h4>
		</div>
		<div class="col-md-4">
			<div><div class="legend from_cam"></div> Campus to city</div>
			<div><div class="legend to_cam"></div> Back to campus</div>
			<div><div class="legend from_cam to_cam"></div> Both directions</div>
		</div>
	</div>
	<br>
	<div class="row sheet" id="calendar">
		<div class="col-md-6 text-center">
			<h3><?php echo $current_month_text." ".$current_year." "; ?></h3>
			<table class="table table-custom" id="present_month_calender" data-month="<?php echo $current_month; ?>" data-year="<?php echo $current_year; ?>">
				<tr>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>
				<tr>
					<?php for($i=0;$i<$current_month_start_day;$i++) { echo "<td></td>"; } ?>
					<?php for($i=1;$i<=7-$current_month_start_day;$i++) { put($i,$current_month,$current_year); } ?>
				</tr>
				<?php for($i=7-$current_month_start_day;$i<$days_in_current_month-7;$i+=7) { ?>
				<tr>
					<?php for($j=1;$j<=7;$j++) { $last_printed=$i+$j; put($last_printed,$current_month,$current_year); } ?>
				</tr>
				<?php } ?>
				<tr>
					<?php for($i=1;$i<=$days_in_current_month-$last_printed;$i++) { put($last_printed+$i,$current_month,$current_year); } ?>
					<?php for($i=$days_in_current_month-$last_printed+1;$i<=7;$i++) { echo "<td></td>"; } ?>
				</tr>
			</table>
		</div>
		<div class="col-md-6 text-center">
			<h3><?php echo $next_month_text." ".$next_year; ?></h3>
			<table class="table table-custom" id="next_month_calender" data-month="<?php echo $next_month; ?>" data-year="<?php echo $next_year; ?>">
				<tr>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>
				<tr>
					<?php for($i=0;$i<$next_month_start_day;$i++) { echo "<td></td>"; } ?>
					<?php for($i=1;$i<=7-$next_month_start_day;$i++) { put($i,$next_month,$next_year); } ?>
				</tr>
				<?php for($i=7-$next_month_start_day;$i<$days_in_next_month-7;$i+=7) { ?>
				<tr>
					<?php for($j=1;$j<=7;$j++) { $last_printed=$i+$j; put($last_printed,$next_month,$next_year); } ?>
				</tr>
				<?php } ?>
				<tr>
					<?php for($i=1;$i<=$days_in_next_month-$last_printed;$i++) { put($last_printed+$i,$next_month,$next_year); } ?>
					<?php for($i=$days_in_next_month-$last_printed+1;$i<=7;$i++) { echo "<td></td>"; } ?>
				</tr>
			</table>
		</div>
	</div>
</div>

<?php include('process/get_entries.php'); ?>

<script type="text/javascript">
	result = <?php echo $result; ?>;
	for(var i=0;i<result.length;i++)
	{
		var source = result[i]['source'];
		var destination = result[i]['destination'];
		var journey_date = (result[i]['journey_date']).split('-');
		var year = journey_date[0]; var month = journey_date[1]; var date = journey_date[2];
		if(document.querySelector('a[href="?date='+date+'-'+month+'-'+year+'"]')!=null)
	{	if(source=='cam')
			document.querySelector('a[href="?date='+date+'-'+month+'-'+year+'"]').classList.add('from_cam');
		else if(destination=='cam')
			document.querySelector('a[href="?date='+date+'-'+month+'-'+year+'"]').classList.add('to_cam');
	}}
</script>
