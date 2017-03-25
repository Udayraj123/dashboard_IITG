<!-- ajax content will go here into a modal form -->
<!-- image tiles radio buttons and price & numbers-->
<div class="container">
	<p>
		Units Left :  <input type="number" id="left" value="10" ></input>
		<br>
		Monthly Orders : <input type="number" id="monthly_orders" value="10" ></input>
		<br>
		Price : <input type="number" id="price" value="50" ></input>
		<br>

	</p>
	Click The Product to Add:
	<br>
	<div class="row">
		@foreach($prods as $p)
		<div class="col-md-4">
			<label>
				<img src="{{$p->img}}"/>
				<br>
				<button type="button" class="btn btn-sm btn-success addProd" data-id="{{ $p->id }}">{{$p->name}}</button>
			</label>
		</div>
		@endforeach
	</div>
</div>
<br>

<script type="text/javascript">
	$(".addProd").on('click', function(e){
		data = {
			productset_id : $(this).data('id'),
			monthly_orders : $('#monthly_orders').val(),
			left : $('#left').val(),
			price: $('#price').val()
		};
		$.ajax({
			method:'post',
			url:"{{route('addProd')}}",
			data:data,
			success:function(result){
				alert(result);
				$('#modal').modal('hide');
				window.location.href+="";
			},
		});
	});

</script>