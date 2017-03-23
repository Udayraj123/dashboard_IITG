<?php
	$relative_path = "../";
	include('../db/dbconf.php');
	include('../process/common.php');

	session_start();
	if(isset($_SESSION['username'])&&!empty($_SESSION['username']))
		$username = $_SESSION['username'];
	else
		$username = null;

	if($username!=null)
	{
		$error_msg = "";
		$success_msg = "";
		$regex_name = "/^[A-Z][a-zA-Z ]*$/";
		$regex_webmail = "/^[a-zA-Z0-9._]+$/";
		$regex_phone = "/^\d{10}$/";
		$regex_fb = "/^https:\/\/.*(?=facebook\.com|fb\.com)/";
		$regex_harm = "/[<>%]/";
		$regex_residence = "/^[a-zA-Z0-9-, ]*$/";
		if(isset($_POST['submit']))
		{
			if( !isset($_POST['user_name']) || empty($_POST['user_name']) || !isset($_POST['user_webmail']) || empty($_POST['user_webmail']) )
			{
				$error_msg = "Fields marked <span class=\"red\">*</span> cannot be empty";
			}
			else if( (!isset($_POST['user_phone'])||empty($_POST['user_phone'])) && (!isset($_POST['user_fb'])||empty($_POST['user_fb'])) )
			{
				$error_msg = "Atleast one of the fields marked <span class=\"blue\">*</span> must be provided";
			}
			else
			{
				$user_name = custom_sanitise($_POST['user_name']);
				$user_webmail = custom_sanitise($_POST['user_webmail']);
				$user_phone = custom_sanitise($_POST['user_phone']);
				$user_fb = custom_sanitise($_POST['user_fb']);
				$user_residence = '';
				if(isset($_POST['user_residence'])&&!empty($_POST['user_residence']))
					$user_residence = custom_sanitise($_POST['user_residence']);

				if(!preg_match($regex_name,$user_name))
					$error_msg = "Name should have only alphabets & spaces and start with capital letter";				
				else if(!preg_match($regex_webmail,$user_webmail))
					$error_msg = "Invalid webmail format (Enter only the username part of it)";
				else if( (isset($_POST['user_phone'])&&!empty($_POST['user_phone'])) && !preg_match($regex_phone,$user_phone) )
					$error_msg = "Phone no. must be 10-digit number";
				else if( (isset($_POST['user_fb'])&&!empty($_POST['user_fb'])) && (!preg_match($regex_fb,$user_fb)||preg_match($regex_harm,$user_fb)) )
					$error_msg = "This facebook link is not acceptable (must include https://)";
				else if(!preg_match($regex_residence,$user_residence))
					$error_msg = "Residence cannot have any special character";
				if($error_msg=="")
				{
					if(@mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
					{
						$query = "UPDATE `users` SET `name`='$user_name',`webmail`='$user_webmail',`phone`='$user_phone',`fb`='$user_fb',`residence`='$user_residence' WHERE `username`='$username';";
						if($query_run=@mysql_query($query))
						{
							$success_msg = "Details updated";
							header("refresh:2;url=../");
						}
						else
							$error_msg = "Error occured while updating profile";
					}
					else
						$error_msg = "Error occured while connecting to server";
				}
			}
		}
		if( @mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
		{
			$query = "SELECT * FROM `users` WHERE `username`='$username';";
			if($query_run=@mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$current_name = mysql_result($query_run,0,'name');
					$current_webmail = mysql_result($query_run,0,'webmail');
					$current_phone = mysql_result($query_run,0,'phone');
					$current_fb = mysql_result($query_run,0,'fb');
					$current_residence = mysql_result($query_run,0,'residence');
					if($current_phone==0)
						$current_phone = "";
				}
			}
		}
	}
	else
		header("Location: "."$relative_path"."user/login.php");
?>

<!DOCTYPE html>
<html>

<head>
	<title>Profile - Cab share IITG</title>
	<?php include "$relative_path"."process/include.php"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo "$relative_path"."css/user.css"; ?>"></link>
</head>

<body>

	<?php include "$relative_path".'views/navbar.php'; ?>
	<div class="container-fluid" id="page">
		<div class="container">
			<h3 class="text-center"><a class="btn btn-warning" href="<?php echo "$relative_path"; ?>">Back to calender</a></h3>
			<br>
			<h3 class="text-center">Your details</h3>
			<br>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
					<div class="sheet">
						<form id="profile_fom" action="profile.php" method="POST" class="form-horizontal" role="form">
							<div class="form-group">
								<label class="control-label col-sm-4" for="user_name">Name <span class="red">* </span>:</label>
								<div class="col-sm-8">
								<input type="text" name="user_name" class="form-control hollow-input" placeholder="Enter name" maxlength="30" value="<?php echo $current_name; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="user_webmail">Webmail <span class="red">* </span>:<br><span class="light">(without @ part)</span></label>
								<div class="col-sm-8">
								<input type="text" name="user_webmail" class="form-control hollow-input" placeholder="Enter webmail without @iitg.ernet.in part" maxlength="20" value="<?php echo $current_webmail; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="user_phone">Phone No <span class="blue">* </span>:</label>
								<div class="col-sm-8">
								<input type="text" name="user_phone" class="form-control hollow-input" placeholder="Enter phone no." maxlength="10" value="<?php echo $current_phone; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="user_fb">Facebook profile <span class="blue">* </span>:</label>
								<div class="col-sm-8">
								<input type="text" name="user_fb" class="form-control hollow-input" placeholder="Enter FB profile link" maxlength="200" value="<?php echo $current_fb; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="user_residence">Hostel/Residence :</label>
								<div class="col-sm-8">
								<input type="text" name="user_residence" class="form-control hollow-input" placeholder="Enter your hostel/residence" maxlength="20" value="<?php echo $current_residence; ?>">
								</div>
							</div>
							<span class="red">* </span>: Required fields<br>
							<span class="blue">* </span>: Atleast one must be filled<br>
							<?php if(!empty($error_msg)) { ?>
							<div class="alert alert-danger" role="alert" style="padding:1%;">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">Error:</span>
								<span class="msg"><?php echo $error_msg; ?></span>
							</div>
							<?php } ?>
							<?php if(!empty($success_msg)) { ?>
							<div class="alert alert-success" role="alert" style="padding:1%;">
								<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
								<span class="sr-only">Error:</span>
								<span class="msg"><?php echo $success_msg; ?></span>
							</div>
							<?php } ?>
							<div class="form-group text-center">
								<input type="submit" name="submit" value="Save" class="btn btn-success">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "$relative_path".'views/footer.php'; ?>
	<!-- <script type="text/javascript" src="<?php //echo "$relative_path"."js/main.js"; ?>"></script> -->

</body>

</html>

