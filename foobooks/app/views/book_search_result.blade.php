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
