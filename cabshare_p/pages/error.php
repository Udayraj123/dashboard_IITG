<?php
	$relative_path = "../";
	include('../db/dbconf.php');
	include('../process/common.php');

	session_start();
	if(isset($_SESSION['username'])&&!empty($_SESSION['username']))
		$username = $_SESSION['username'];
	else
		$username = null;
?>

<!DOCTYPE html>
<html>

<head>
	<title>Error - Cab share IITG</title>
	<?php include "$relative_path"."process/include.php"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo "$relative_path"."css/pages.css"; ?>"></link>
</head>

<body>

	<?php include "$relative_path".'views/navbar.php'; ?>
	<div class="container-fluid" id="page">
		<div class="container">			
			<br><br><br>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="sheet">
						<h3 class="text-center red">Error</h3>
						<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<hr class="custom-hr">
							<h4 class="text-center">Looks like the page/service you were looking for does not exists or is unavailable</h4>
							<h3 class="text-center"><a class="btn btn-warning" href="<?php echo "$relative_path"; ?>">Back to calender</a></h3>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "$relative_path".'views/footer.php'; ?>

</body>

</html>