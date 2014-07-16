<?php

// Home page
Route::get('/', function() {
	return View::make('index');		
			
});


// List books / search results of books
Route::get('/list/{format?}', function($format = 'html') {
	
	// Instantiating an object of the Library class
	$library = new Library(app_path().'/database/books.json'); 
		
	$books = $library->get_books();	
		
	$query = Input::get('query');
	
	if($query) {
		$books = $library->search($query);
	}
	
	// Default - HTML
	if($format == 'html') {
		return View::make('list')
			->with('books', $books)
			->with('query', $query);
	}
	// JSON
	elseif($format == 'json') {
		return Response::json($books);
	}
	// PDF (Coming soon)
	elseif($format == 'pdf') {
		return "This is the pdf (Coming soon).";
	}	
});




// Display edit form
Route::get('/edit/{title}', function() {
		
});

// Process edit form
Route::post('/edit/{title}', function() {
	
});




// Display add form
Route::get('/add/', function() {
	
});

// Process add form
Route::post('/add/', function() {
	
	
	
	
});




// Debug route: Read in the books.json file
Route::get('/data', function() {
	
	// Instantiating an object of the Library class
	$library = new Library(app_path().'/database/books.json'); 
		
	// Get the books
	$books = $library->get_books();
	
	// Debug
	return Pre::render($books, 'Books');
	
	
});






