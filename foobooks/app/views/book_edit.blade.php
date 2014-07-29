@extends('_master')


@section('title')
	Edit Book
@stop



@section('content')

	{{ Form::model($book, ['method' => 'post', 'action' => ['BookController@postEdit', $book->id]]) }}
	
		<h2>Update: {{ $book->name }}</h2>
	
		<div class='form-group'>
			{{ Form::label('name', 'Title') }}
			{{ Form::text('title') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('author_id', 'Author') }}
			{{ Form::select('author_id', $authors, $book->author_id); }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('published', 'Published') }}
			{{ Form::text('published') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('cover', 'Cover URL') }}
			{{ Form::text('cover') }}
		</div>
		
		<div class='form-group'>
			{{ Form::label('purchase_link', 'Purchase URL') }}
			{{ Form::text('purchase_link') }}
		</div>
		
		{{ Form::submit('Save') }}
	
	{{ Form::close() }}

@stop