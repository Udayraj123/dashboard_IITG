<head>
	<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('font-awesome/css/font-awesome.css') }}">
	@yield('headContent')
	<style type="text/css">
		body{
			padding: 3%;
		}
	</style>
</head>

<body>
	<!-- //this is like a {%block %} with {% endblock %} -->
	@yield('bodyContent') 
</body>