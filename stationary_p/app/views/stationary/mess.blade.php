<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel Food Menus</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
	<?php
	if(!isset($currH))$currH="KAPILI";
	?>
	<div class="container-fluid" style="padding-top:2%">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<ul class="nav nav-pills nav-justified">
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'mess','currH'=>$currH])}}" id ="mess">Mess Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'canteen','currH'=>$currH])}}" id ="canteen">Canteen Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'juice','currH'=>$currH])}}" id ="juice">Juice Center Menus</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('stationary_view',['view' => 'stationary','currH'=>$currH])}}" id ="stationary">Stationary Items</a></li>
					<li class="nav-item"><a class="nav-link" href="{{route('vendorlogin')}}" id ="stationary">Log In</a></li>
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
					
					@foreach(C::get('p.hostels') as $h)
					<li class="list-group-item {{$h==$currH?'active':''}}"><a href="{{route('stationary_view',['view' => $view,'currH'=>$h])}}" id="{{$h}}">{{ucwords($h)}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="container col-md-8">
				<table class="table">
					<tr><th>Day</th><th>Breakfast</th><th>Lunch</th><th>Dinner</th></tr>
					<tr><th>Monday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Tuesday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Wednesday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Thursday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Friday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Saturday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
					<tr><th>Sunday</th><td>Breakfast</td><td>Lunch</td><td>Dinner</td></tr>
				</table>

			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<script type="text/javascript">
		$('#mess').addClass('active');
	</script>
</body>
</html>
