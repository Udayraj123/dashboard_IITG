@extends('stationary.master')
@section('divContent')
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
@endsection
@section('script')
<script type="text/javascript">
$('#mess').addClass('active');
</script>
    
@endsection