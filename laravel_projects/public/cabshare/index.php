<?php
	$relative_path = "";
	include('process/common.php');
	include('process/time.php');
	include('db/dbconf.php');

	$error_404 = isset($_GET["404"]) ? true : false;
	if($error_404 == true)
		header("Location: $relative_path"."pages/error.php");
	
	if(!($db_connection=@mysql_connect($db_hostname,$db_username,$db_password)&&@mysql_select_db($db_database)))
		$db_connection = null;

	if(isset($_GET['date'])&&!empty($_GET['date']))
		$fulldate = $_GET['date'];
	else
		$fulldate = null;
	session_start();
	if(isset($_SESSION['username'])&&!empty($_SESSION['username']))
	{
		$username = $_SESSION['username'];
		if($db_connection!=null)
		{
			$query = "SELECT * FROM `users` WHERE `username`='$username';";
			if($query_run=@mysql_query($query))
			{
				$name=mysql_result($query_run,0,'name');
				if($name==null||$name=='')
					header('Location: user/profile.php');
			}
			else
				$result['status'] = 'error';
		}
		else
			$result['status'] = 'connection';
	}
	else
		$username = null;
?>

<!DOCTYPE html>
<html>

<head>
	<title>Cab share - IITG</title>
	<?php include "$relative_path"."process/include.php"; ?>
</head>

<body>

	<?php include "$relative_path".'views/navbar.php'; ?>
	<div class="container-fluid" id="page">
	<?php
		if($fulldate==null)
			include('views/calendar.php');
		else
			include('views/date.php');
	?>
	</div>
	
	<script type="text/javascript" src="<?php echo "$relative_path"."js/main.js"; ?>"></script>

</body>

</html>