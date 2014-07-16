@extends('_master')

@section('title')
	Welcome to Foobooks
@stop

@section('content')
	<h1>Welcome to Foobooks</h1>
	
	<a href='/list'>View all Books</a> | 
	<a href='/add'>+ Add New book</a>
	
	{{ Form::open(array('url' => '/list', 'method' => 'GET')) }}

		Search: 
		{{ Form::text('query') }}
		
		{{ Form::submit('Search!') }}
	
	{{ Form::close() }}
	
	
@stop

