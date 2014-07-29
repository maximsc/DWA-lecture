@extends('_master')


@section('head')
	<link rel="stylesheet" href="foobooks.css" type="text/css">
@stop

@section('title')
	All your Books
@stop

@section('content')

	<h2>Books</h2>

	<div>
		View as:
		<a href='/book/?format=json' target='_blank'>JSON</a> | 
		<a href='/book/?format=pdf' target='_blank'>PDF</a>
	</div>
	
	<div>
		<a href='/book/create'>+ Add a book</a>
	</div>


	@if(trim($query) != "")
		<p>You searched for <strong>{{{ $query }}}</strong></p>
		
		@if(count($books) == 0)
			<p>No matches found</p>
		@endif
		
	@endif
		
	@foreach($books as $title => $book)
		
		<section>
			<img class='cover' src='{{ $book['cover'] }}'>
			
			<h2>{{ $book['title'] }}</h2>
			
			<p>			
			{{ $book['author']->name }} {{ $book['published'] }}
			</p>

			<p>
				@foreach($book['tags'] as $tag) 
					{{ $tag->name }}
				@endforeach
			</p>
			
			<a href='{{ $book['cover'] }}'>Purchase this book...</a>
			<br>
			<a href='/book/edit/{{ $book->id }}'>Edit</a>
		</section>
	
	@endforeach

@stop