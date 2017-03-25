<?php
	include('time.php');
	include('common.php');
	include('../db/dbconf.php');

	session_start();
	if(isset($_SESSION['username'])&&!empty($_SESSION['username']))
		$username = $_SESSION['username'];
	else
		$username = null;

	if($username!=null)
	{
		$formData		= $_POST['formData'];
		$source			= custom_sanitise($formData['source']);
		$destination	= custom_sanitise($formData['destination']);
		$journey_date	= custom_sanitise($formData['journey_date']);
		$travel_hour	= custom_sanitise($formData['travel_hour']);
		$travel_min		= custom_sanitise($formData['travel_min']);
		$cab_hour		= custom_sanitise($formData['cab_hour']);
		$cab_min		= custom_sanitise($formData['cab_min']);
		$group_size		= custom_sanitise($formData['group_size']);
		if($source!='cam')
		{
			$cab_hour = $travel_hour;
			$cab_min = $travel_min;
		}
		$travel_hour = strval($travel_hour);
		$travel_min = strval($travel_min);
		$cab_hour = strval($cab_hour);
		$cab_min = strval($cab_min);
		if(strlen($travel_hour)<2)
			$travel_hour = '0'.$travel_hour;
		if(strlen($travel_min)<2)
			$travel_min = '0'.$travel_min;
		if(strlen($cab_hour)<2)
			$cab_hour = '0'.$cab_hour;
		if(strlen($cab_min)<2)
			$cab_min = '0'.$cab_min;

		$response = array();
		if(!isset($source)||!isset($destination)||!isset($journey_date)||!isset($travel_hour)||!isset($travel_min)||!isset($cab_hour)||!isset($cab_min)||!isset($group_size))
		{
			$response['status'] = 'fail';
			$response['message'] = 'incomplete';
		}
		else if(empty($source)||empty($destination)||empty($journey_date)||empty($travel_hour)||empty($travel_min)||empty($cab_hour)||empty($cab_min))
		{
			$response['status'] = 'fail';
			$response['message'] = 'incomplete';
		}
		else
		{
			$regex_time = "/^\d{1,2}$/";
			$regex_group = "/^[1-9]$/";
			if(!( ($source=='cam'&&($destination=='air'||$destination=='mrs'||$destination=='krs')) || ($destination=='cam'&&($source=='air'||$source=='mrs'||$source=='krs')) ))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'direction';
			}
			else if(!( is_YMD_date($journey_date) && date_in_current_scope(parseDate($journey_date,'D'),parseDate($journey_date,'M'),parseDate($journey_date,'Y')) && $journey_date>=$ymd_today ))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'date';
			}
			else if(!preg_match($regex_time,$travel_hour)||!preg_match($regex_time,$travel_min)||!preg_match($regex_time,$cab_hour)||!preg_match($regex_time,$cab_min))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'time';
			}
			else if(!(valid_hour($travel_hour)&&valid_min($travel_min)&&valid_hour($cab_hour)&&valid_min($cab_min)))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'time';
			}
			else if(!preg_match($regex_group,$group_size))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'group_size';
			}
			else
			{
				if( @mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
				{
					$query = "SELECT * FROM `users` WHERE `username`='$username';";
					if($query_run=@mysql_query($query))
					{
						if(mysql_num_rows($query_run)==1)
						{
							$travel_time = "$travel_hour:$travel_min";
							$cab_time = "$cab_hour:$cab_min";
							$group_size = intval($group_size);
							$query = "SELECT * from `entries` WHERE `username`='$username' AND `journey_date`='$journey_date'";
							if($query_run=@mysql_query($query))
							{
								if(@mysql_num_rows($query_run)==0)
								{
									$query = "INSERT INTO `entries` (`username`, `source`, `destination`, `journey_date`, `travel_time`, `cab_time`, `group_size`) VALUES ('$username', '$source', '$destination', '$journey_date', '$travel_time', '$cab_time', '$group_size');";
									if(@mysql_query($query))
									{
										$response['status'] = 'success';
									}
									else
									{
										$response['status'] = 'fail';
										$response['message'] = 'database';
									}
								}
								else
								{
									$query = "UPDATE `entries` SET `source`='$source',`destination`='$destination',`travel_time`='$travel_time',`cab_time`='$cab_time', `group_size`='$group_size' WHERE `username`='$username' AND `journey_date`='$journey_date';";
									if(@mysql_query($query))
									{
										$response['status'] = 'success';
									}
									else
									{
										$response['status'] = 'fail';
										$response['message'] = 'database';
									}
								}
							}
							else
							{
								$response['status'] = 'fail';
								$response['message'] = 'database';
							}
						}
						else
						{
							$response['status'] = 'fail';
							$response['message'] = 'username';
						}
					}
					else
					{
						$response['status'] = 'fail';
						$response['message'] = 'database';
					}					
				}
				else
				{
					$response['status'] = 'fail';
					$response['message'] = 'database';
				}
			}
		}
		echo json_encode($response);
	}
?>