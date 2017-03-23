<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stationary Database</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container-fluid" style="padding-top:2%">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<ul class="nav nav-pills nav-justified">
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'mess'])}}" id ="mess">Mess Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'canteen'])}}" id ="canteen">Canteen Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'juice'])}}" id ="juice">Juice Center Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'station'])}}" id ="station">Stationary Items</a></li>
				</ul>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<br>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="container col-md-2">
				<ul class="list-group">
					<?php
					if(!isset($currH))$currH="KAPILI";
					?>
					@foreach(C::get('p.hostels') as $h)
					<li class="list-group-item {{$h==$currH?'active':''}}"><a id="{{$h}}">{{ucwords($h)}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="container col-md-8">
				@yield('divContent')
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	@yield('script')
</body>
</html>