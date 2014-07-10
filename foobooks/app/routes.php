<?php


// Home page
Route::get('/', function()
{
	return "Welcome to Foobooks";
});




// List books / search results of books
Route::get('/list/{format?}', function() {
	
	
	
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
	
	print_r($books);
	
});






