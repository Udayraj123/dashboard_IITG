<?php
	$result = "";
	if( $conn=@mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
	{
		$query = "SELECT * FROM `entries` WHERE 1";
		if($query_run=@mysql_query($query))
		{
			if(@mysql_num_rows($query_run)>0)
			{
				$rows = array();
				while($r = mysql_fetch_assoc($query_run))
				{
				  $rows[] = $r;
				}
				$result = json_encode($rows);
			}
		}
	}
?>