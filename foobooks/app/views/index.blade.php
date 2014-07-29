@extends('_master')

@section('title')
	Welcome to Foobooks
@stop

@section('content')
	
	<br><br>
	
	{{ Form::open(array('action' => 'BookController@getIndex', 'method' => 'GET')) }}

		{{ Form::label('query','Search for a book:') }} &nbsp;
		{{ Form::text('query') }} &nbsp;
		{{ Form::submit('Search!') }}
	
	{{ Form::close() }}
	
	
@stop

