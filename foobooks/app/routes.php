<?php




// Home page
Route::get('/', function()
{
	
	// String
	// Redirect
	// JSON
	// View
		
	return View::make('index');		
			
});




// List books / search results of books
Route::get('/list/{format?}', function($format = 'html') {
	
	// Where are the books?
	$path = app_path().'/database/books.json';

	// Getting the contents of a file and returning it as a string
	$books = File::get($path);
	
	// Convert our string of JSON into object
	$books = json_decode($books,true);
	
	// Default
	if($format == 'html') {
		return View::make('list')->with('books',$books);		
	}
	elseif($format == 'json') {
		return Response::json($books);
	}
	elseif($format == 'pdf') {
		return "This is the pdf";
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

// Read in the books.json file
Route::get('/data', function() {
	
	$path = app_path().'/database/books.json';

	// Getting the contents of a file and returning it as a string
	$books = File::get($path);
	
	// Convert our string of JSON into object
	$books = json_decode($books,true);
		
	echo Pre::render($books, 'Books');
	
	print_r($books);
	
});






