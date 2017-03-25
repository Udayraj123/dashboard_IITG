<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel Food Menus</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
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
					<label>
						<a href="{{route('stationary_view',['view' => $view,'currH'=>$h])}}" id="{{$h}}" style="color:orange">
							<li class="list-group-item {{$h==$currH?'active':''}}">
								{{ucwords($h)}}
							</li>
						</a>
					</label>
					@endforeach
				</ul>
			</div>
			@if($view=="mess")

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
	@else
	<div class="container col-md-8">
		<div class="row">
			<div class="container col-md-8">
				<ul class="list-group">
					<li class="list-group-item active align-self-center">Name: {{$vendor['name']}}</li>
					<br>
					<li class="list-group-item align-self-center">
						Contact:
						@if(array_key_exists('contact',$vendor))
						{{$vendor['contact']}}
						@else
						N/A
						@endif
					</li>
				</ul>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="text-success col-md-3 active align-self-center">Name</div>
			<div class="text-success col-md-1">Price</div>
			<div class="text-success col-md-1">Left</div>
			<div class="text-success col-md-2">Monthly Orders</div>
			<div class="text-success col-md-3">Last Updated</div>
			<div class="text-success col-md-2">Delete</div>
		</div>
		@foreach($items as $item)
		<div class="row">
			<div class="col-md-3 align-self-center">{{$item->name}}</div>
			<div class="col-md-1">{{$item->price}}</div>
			<div class="col-md-1">{{$item->left}}</div>
			<div class="col-md-2">{{$item->monthly_orders}}</div>
			<div class="col-md-3">{{date('H:i d M.',strtotime($item->updated_at))}}</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-sm btn-danger delProd" data-id="{{ $item->id }}">Delete</button>
			</div>

		</div>
		@endforeach
	</div>
	<div class="col-md-1">
		<button class="btn btn-success" onclick="showForm()">
			Add
		</button>
	</div>

</div>
</div>
</div>

<div class="modal fade" id="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Add Product
			</div>
			<div class="modal-body" id='modalContent'>

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#{{$view}}').addClass('active');
function showForm(){
	$.ajax({
		method:'post',
		url:"{{route('fetchProds')}}",
		data:{'q':''},
		success:function(result){
			$('#modalContent').html(result);
			$('#modal').modal('show');
		},
	});
}
$(".delProd").on('click', function(e){
	data = {
		product_id : $(this).data('id'),
	};
	$.ajax({
		method:'post',
		url:"{{route('delProd')}}",
		data:data,
		success:function(result){
			alert(result);
			$('#modal').modal('hide');
			window.location.href+="";
		},
	});
});
</script>
@endif
</body>
</html>