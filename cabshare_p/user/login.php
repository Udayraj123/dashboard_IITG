<?php
	$relative_path = "../";
	include('../db/dbconf.php');
	include('../process/common.php');

	session_start();
	if(isset($_SESSION['username'])&&!empty($_SESSION['username']))
		$username = $_SESSION['username'];
	else
		$username = null;

	if($username==null)
	{
		$error_msg = "";
		if( isset($_POST['login_username']) && isset($_POST['login_password']) )
		{
			if( !empty($_POST['login_username']) && !empty($_POST['login_password']) )
			{
				$login_username = custom_sanitise($_POST['login_username']);
				$login_password = custom_sanitise($_POST['login_password']);
				$regex_username = "/^[a-zA-Z0-9_.]+$/";
				$regex_password = "/^[a-zA-Z0-9_.]+$/";
				// $regex_password = "/^[a-zA-Z0-9_.!@#&]+$/";
				if(preg_match($regex_username,$login_username)&&preg_match($regex_password,$login_password))
				{
					if( @mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
					{
						$login_password = md5($login_password);
						$query = "SELECT * FROM `users` WHERE `username`='$login_username';";
						if($query_run=@mysql_query($query)) 
						{
							if(@mysql_num_rows($query_run)==1)
							{
								if(mysql_result($query_run,0,'password')==$login_password)
								{
									$_SESSION['username'] = $login_username;
									header('Location: ../');
								}
								else
									$error_msg = "Wrong password";
							}
							else
								$error_msg = "This username does not exist";
						}
						else
							$error_msg = "Error occured while logging in";
					}
					else
						$error_msg = "Error occured while logging in";
				}
				else
					$error_msg = "Username and Password can have only letters, digits, dot and underscore";
			}
			else
				$error_msg = "All fields are required";
		}
	}
	else
		header('Location: ../');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login - Cab share IITG</title>
	<?php include "$relative_path"."process/include.php"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo "$relative_path"."css/user.css"; ?>"></link>
</head>

<body>

	<?php include "$relative_path".'views/navbar.php'; ?>
	<div class="container-fluid" id="page">
		<div class="container">
			<h3 class="text-center"><a class="btn btn-warning" href="<?php echo "$relative_path"; ?>">Back to calender</a></h3>
			<br>
			<h3 class="text-center">Login to IITG Cab Share</h3>
			<br>
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="sheet">
						<form id="login_fom" action="login.php" method="POST">
							<div class="form-group">
								<input type="text" name="login_username" class="form-control hollow-input" placeholder="Username" maxlength="20">
							</div>
							<div class="form-group">
								<input type="password" name="login_password" class="form-control hollow-input" placeholder="Password" maxlength="30">
							</div>
							<?php if(!empty($error_msg)) { ?>
							<div class="alert alert-danger" role="alert" style="padding:1%;">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">Error:</span>
								<span class="msg"><?php echo $error_msg; ?></span>
							</div>
							<?php } ?>
							<div class="form-group">
								<input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
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