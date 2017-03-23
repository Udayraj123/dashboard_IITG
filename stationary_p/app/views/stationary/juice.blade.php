@extends('stationary.master')
@section('divContent')
<ul class="list-group">
	<li class="list-group-item active align-self-center">Juices</li>
</ul>
<br>
<ul class="list-group">
	<li class="list-group-item item">
		<div class="row">
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
		</div>    
	</li>
	<li class="list-group-item item">
		<div class="row">
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
			<div class="col-md-3"> Orange Juice </div>
		</div>    
	</li>
</ul>
@endsection
@section('script')
<script type="text/javascript">
	$('#juice').addClass('active');
</script>

@endsection