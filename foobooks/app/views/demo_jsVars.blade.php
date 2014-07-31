@extends('_master')

@section('title')
	Demo of binding JS variables to a view
@stop

@section('content')
	
	<br><br>
	<button id='ex1'>Get the 'foo' var</button>
	<br><br>
	<button id='ex2'>Get the 'email' var</button>

@stop

@section('footer')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<script>
		$('#ex1').click(function() {
			alert('The value of `foo` is ' + foo);
		});
		
		$('#ex2').click(function() {
			alert('The value of `email` is ' + email);
		});
	</script>
@stop