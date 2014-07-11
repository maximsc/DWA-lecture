<!doctype html>
<html>
<head>

	<title>
	
	@section('title')
		This is foobooks!
	@show
	
	</title>
	
	<link rel="stylesheet" href="styles/foobooks.css" type="text/css">
	
	@yield('head')
	
	

</head>

<body>

	<a href='/'><img class='logo' src='<?php echo URL::asset('/images/logo@2x.png'); ?>'></a>
	
	@yield('content')
	
	@yield('body')
		
</body>

</html>