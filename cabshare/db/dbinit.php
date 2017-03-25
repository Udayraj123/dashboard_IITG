<?php

require 'dbconf.php';
if(mysql_connect($db_hostname,$db_username,$db_password))
{
	$query="CREATE DATABASE IF NOT EXISTS ".$db_database;
	echo $query.'<br>';
	mysql_query($query);

	if( mysql_select_db($db_database) )
	{
		$query = "SELECT * FROM `entries` WHERE 1;";
		if(!mysql_query($query))
		{
			$query = "CREATE TABLE users (
						username VARCHAR(20) PRIMARY KEY,
						password VARCHAR(35) NOT NULL,
						name VARCHAR(30) NOT NULL,
						phone BIGINT(10),
						webmail VARCHAR(20),
						fb VARCHAR(100),
						residence VARCHAR(20)
						)";
			echo $query.'<br>';
			mysql_query($query);
			$query = "CREATE TABLE entries (
						id INTEGER AUTO_INCREMENT PRIMARY KEY,
						username VARCHAR(20) NOT NULL,
						source VARCHAR(10) NOT NULL,
						destination VARCHAR(10) NOT NULL,
						journey_date DATE NOT NULL,
						travel_time TIME NOT NULL,
						cab_time TIME NOT NULL,
						group_size TINYINT(2) NOT NULL DEFAULT '1'
						)";
			echo $query.'<br>';
			mysql_query($query);
		}
	}
	else
		echo "Can't connect to the database";
}
else
	echo "Can't connect to mySQL";

// ALTER TABLE `entries` CHANGE `group_size` `group_size` INT(1) NULL DEFAULT '2';
// ALTER TABLE `entries` ADD `group` INT(1) NOT NULL DEFAULT '1' AFTER `group_size`;

?>