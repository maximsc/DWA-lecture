@extends('_master')

@section('title')
	Add a new book
@stop

@section('content')
	
	<h1>Add a New Book</h1>
	
		
	{{ Form::open(array('url' => '/book/create', 'method' => 'POST')) }}

		<div class='form-group'>
			{{ Form::label('author_id', 'Author') }}
			{{ Form::select('author_id', $authors); }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('title') }} 
			{{ Form::text('title') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('published', 'Published (YYYY)') }} 
			{{ Form::text('published') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('cover','Cover URL') }} 
			{{ Form::text('cover') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('purcase_link','Purchase URL') }} 
			{{ Form::text('purchase_link') }}
		</div>
		
		{{ Form::submit('Add') }}
	
	{{ Form::close() }}
	
	
@stop

