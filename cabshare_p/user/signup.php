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
		if( isset($_POST['signup_username']) && isset($_POST['signup_password']) && isset($_POST['signup_repassword']) )
		{
			if( !empty($_POST['signup_username']) && !empty($_POST['signup_password']) && !empty($_POST['signup_repassword']) )
			{
				$signup_username = custom_sanitise($_POST['signup_username']);
				$signup_password = custom_sanitise($_POST['signup_password']);
				$signup_repassword = custom_sanitise($_POST['signup_repassword']);
				$regex_username = "/^[a-zA-Z0-9_.]+$/";
				$regex_password = "/^[a-zA-Z0-9_.]+$/";
				if(preg_match($regex_username,$signup_username)&&preg_match($regex_password,$signup_password)&&preg_match($regex_password,$signup_repassword))
				{
					if(strlen($signup_username)<=20&&strlen($signup_password)<=30)
					{
						if($signup_password==$signup_repassword)
						{
							if( @mysql_connect($db_hostname,$db_username,$db_password) && @mysql_select_db($db_database) )
							{
								$query = "SELECT * FROM `users` WHERE `username`='$signup_username'";
								if($query_run=@mysql_query($query)) 
								{
									if(@mysql_num_rows($query_run)==0)
									{
										$signup_password = md5($signup_password);
										$query = "INSERT INTO `users` (`username`, `password`) VALUES ('$signup_username', '$signup_password')";
										if($query_run=@mysql_query($query))
										{
											$_SESSION['username'] = $signup_username;
											header("Location: "."$relative_path"."user/profile.php");
										}
										else
											$error_msg = "Error occured while signing up";
									}
									else
										$error_msg = "Requested username already exists";
								}
								else
									$error_msg = "Error occured while signing up";
							}
							else
								$error_msg = "Error occured while signing up";
						}
						else
							$error_msg = "Password and re-entered password do not match";
					}
					else
						$error_msg = "Username/password is too long";
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
	<title>Sign up - Cab share IITG</title>
	<?php include "$relative_path"."process/include.php"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo "$relative_path"."css/user.css"; ?>"></link>
</head>

<body>

	<?php include "$relative_path".'views/navbar.php'; ?>
	<div class="container-fluid" id="page">
		<div class="container">
			<h3 class="text-center"><a class="btn btn-warning" href="<?php echo "$relative_path"; ?>">Back to calender</a></h3>
			<br>
			<h3 class="text-center">Sign up for IITG Cab Share</h3>
			<br>
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="sheet">
						<form id="signup_form" action="signup.php" method="POST">
							<div class="form-group">
								<input type="text" name="signup_username" class="form-control hollow-input" placeholder="Username" maxlength="20">
							</div>
							<div class="form-group">
								<input type="password" name="signup_password" class="form-control hollow-input" placeholder="Password" maxlength="30">
							</div>
							<div class="form-group">
								<input type="password" name="signup_repassword" class="form-control hollow-input" placeholder="Re-type Password" maxlength="30">
							</div>
							<?php if(!empty($error_msg)) { ?>
							<div class="alert alert-danger" role="alert" style="padding:1%;">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">Error:</span>
								<span class="msg"><?php echo $error_msg; ?></span>
							</div>
							<?php } ?>
							<div class="form-group">
								<input type="submit" name="submit" value="Sign up" class="btn btn-primary btn-block">
							</div>
						</form>
						<h5 class="text-center">By signing up, you accept the <a class="custom-link" href="<?php echo "$relative_path","pages/tnc.php"; ?>" target="_blank">Terms of Usage</a></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "$relative_path".'views/footer.php'; ?>
	<!-- <script type="text/javascript" src="<?php //echo "$relative_path"."js/main.js"; ?>"></script> -->

</body>

</html>




