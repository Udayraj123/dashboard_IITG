<?php
	// date_default_timezone_set("Asia/Dhaka");
	$current = time();
	$current_date = date("d");
	$current_month = date("m");
	$current_month_text = date("M");
	$current_year = date("Y");
	if($current_month==12)
	{
		$next_month = sprintf("%02d",1);
		$next_year = $current_year+1;
	}
	else
	{
		$next_month = sprintf("%02d",$current_month+1);
		$next_year = $current_year;
	}
	$temp=date_create($next_year."-".$next_month."-1");
	$next_month_text = date_format($temp,"M");
	$current_hour = date("H");
	$current_min = date("i");
	$current_sec = date("s");
	$days_in_current_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
	$days_in_next_month = cal_days_in_month(CAL_GREGORIAN, $next_month, $next_year);
	$ymd_today = get_YMD_date($current_date,$current_month,$current_year);

	function weekday($day)
	{
		return ($day+6)%7;
	}
	function monthName($monthNum)
	{
		return date('F', mktime(0, 0, 0, $monthNum, 10));
	}
	function date_in_current_scope($date,$month,$year)
	{
		$current_month = $GLOBALS['current_month'];
		$current_year = $GLOBALS['current_year'];
		$next_month = $GLOBALS['next_month'];
		$next_year = $GLOBALS['next_year'];
		$days_in_current_month = $GLOBALS['days_in_current_month'];
		$days_in_next_month = $GLOBALS['days_in_next_month'];
		if(($year==$current_year&&$month==$current_month&&$date>0&&$date<=$days_in_current_month)||($year==$next_year&&$month==$next_month&&$date>0&&$date<=$days_in_next_month))
			return true;
		else
			return false;
	}
	function get_YMD_date($date,$month,$year)
	{
		$formatted_date = "$year"."-";
		if(strlen(strval($month))==1)
			$formatted_date .= "0";
		$formatted_date .= "$month"."-";
		if(strlen(strval($date))==1)
			$formatted_date .= "0";
		$formatted_date .= "$date";
		return $formatted_date;
	}
	function is_YMD_date($fulldate)
	{
		$regex = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
		if(preg_match($regex,$fulldate))
			return true;
		else
			return false;
	}
	function parseDate($fulldate,$what,$format="YMD")
	{
		$temp = split('-', $fulldate);
		if(($what=='D'&&$format=='DMY')||($what=='Y'&&$format=='YMD'))
			return $temp[0];
		else if($what=='M')
			return $temp[1];
		else if(($what=='Y'&&$format=='DMY')||($what=='D'&&$format=='YMD'))
			return $temp[2];
	}
	function valid_hour($input)
	{
		$input = intval($input);
		if($input>=0&&$input<24)
			return true;
		else
			return false;
	}
	function valid_min($input)
	{
		$input = intval($input);
		if($input>=0&&$input<60)
			return true;
		else
			return false;
	}
?>