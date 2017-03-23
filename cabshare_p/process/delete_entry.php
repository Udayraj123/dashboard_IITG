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
		$journey_date = custom_sanitise($_POST['journey_date']);

		$response = array();
		if(!isset($journey_date)||empty($journey_date))
		{
			$response['status'] = 'fail';
			$response['message'] = 'incomplete';
		}
		else
		{
			if(!( is_YMD_date($journey_date) && date_in_current_scope(parseDate($journey_date,'D'),parseDate($journey_date,'M'),parseDate($journey_date,'Y')) && $journey_date>=$ymd_today ))
			{
				$response['status'] = 'fail';
				$response['message'] = 'invalid_input';
				$response['invalid'] = 'date';
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
							$query = "DELETE FROM `entries` WHERE `username`='$username' AND `journey_date`='$journey_date'";
							if($query_run=@mysql_query($query))
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