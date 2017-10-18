<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title> {{-- Yield es como que marca el elemento con el nombre del primer parametro y puede ser reyenado desde la otra plantilla con section --}}
	<link rel="stylesheet" href="{{ asset('plugins/materialize/css/materialize.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/icons/icons.css') }}">
</head>
<body>

	@include('Admin/Template/Parts/nav')
	
	<script src="{{ asset('plugins/jquery/jquery-3.2.1.js') }}"></script>
	<script src="{{ asset('plugins/materialize/js/materialize.js') }}"></script>
	<script type="text/javascript">
		$( document ).ready(function(){ 
			$(".button-collapse").sideNav(); 
		});
	</script>

</body>
</html>