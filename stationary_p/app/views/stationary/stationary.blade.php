@extends('stationary.master')
@section('divContent')
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
</div><br>
<div class="row">
	<div class="col-md-3 active align-self-center">Name</div>
	<div class="col-md-3">Price</div>
	<div class="col-md-3">Left</div>
	<div class="col-md-3">Monthly Orders</div>
</div>
@foreach($items as $item)
<div class="row">
	<div class="col-md-3 align-self-center">{{$item->name}}</div>
	<div class="col-md-3">{{$item->price}}</div>
	<div class="col-md-3">{{$item->left}}</div>
	<div class="col-md-3">{{$item->monthly_orders}}</div>
</div>
@endforeach
@endsection
@section('script')
<script type="text/javascript">
	$('#station').addClass('active');
</script>

@endsection