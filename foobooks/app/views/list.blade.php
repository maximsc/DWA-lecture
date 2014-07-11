@extends('_master')


@section('head')
	<link rel="stylesheet" href="foobooks.css" type="text/css">
@stop

@section('title')
	All your Books
@stop

@section('content')

	View as:
	<a href='/list/json' target='_blank'>Json</a> | 
	<a href='/list/pdf' target='_blank'>PDF</a>
	
	@foreach($books as $title => $book)
		
		<section>
			<h2>{{ $title }}</h2>
		</section>
	
	@endforeach

@stop