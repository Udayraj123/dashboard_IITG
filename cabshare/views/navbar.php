<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header page-scroll">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo "$relative_path"; ?>" style="text-transform: none; color:#fff" class="navbar-brand">
				<div class="logo_text">Cab share - IITG</div>
			</a>			
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right" id="formBar">
				<form class="navbar-form navbar-right">
					<?php if($username==null) { ?>
					<div class="form-group">
						<a href="<?php echo "$relative_path","user/login.php"; ?>"><button type="button" class="btn btn-hollow btn-green btn-block" id="loginButton">Log in</button></a>
					</div>
					<div class="form-group">
						<a href="<?php echo "$relative_path","user/signup.php"; ?>"><button type="button" class="btn btn-hollow btn-orange btn-block" id="signupButton">Sign up</button></a>
					</div>
					<?php } else { ?>
					<div class="form-group">
						<a href="<?php echo "$relative_path","user/profile.php"; ?>"><button type="button" class="btn btn-hollow btn-blue" id="profileButton">Profile</button></a>
					</div>
					<div class="form-group">
						<a href="<?php echo "$relative_path","user/logout.php"; ?>"><button type="button" class="btn btn-hollow btn-yellow" id="logoutButton">Log out</button></a>
					</div>
					<?php } ?>
				</form>
			</ul>
		</div>
	</div>
</nav>