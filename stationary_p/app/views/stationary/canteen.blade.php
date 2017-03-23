@extends('stationary.master')
@section('divContent')
@foreach($items as $item)
<ul class="list-group">
	<li class="list-group-item active align-self-center">{{$item->name}}</li>
</ul>
<br>
<ul class="list-group">
	<li class="list-group-item item">
		<div class="row">
			<div class="col-md-3">{{$item}}</div>
			<div class="col-md-3">{{$item->price}}</div>
			<div class="col-md-3">{{$item->left}}</div>
			<div class="col-md-3">{{$item->monthly_orders}}</div>
		</div>
	</li>
</ul>
@endforeach
@endsection
@section('script')
<script type="text/javascript">
	$('#canteen').addClass('active');
</script>

@endsection