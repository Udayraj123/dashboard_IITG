@extends('stationary.master')
@section('divContent')
<ul class="list-group">
    <li class="list-group-item active align-self-center">Perfumes</li>
</ul>
<br>
<ul class="list-group">
    <li class="list-group-item item">Park Avenue</li>
</ul>
@endsection
@section('script')
<script type="text/javascript">
$('#station').addClass('active');
</script>
    
@endsection