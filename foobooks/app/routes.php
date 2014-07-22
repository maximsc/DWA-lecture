<?php

# Home page
Route::get('/', function() {
	return View::make('index');				
});




# List books/search results of books
Route::get('/list/{format?}', function($format = 'html') {

	$query = Input::get('query');
	
	# If there is a query, search the library with that query
	if($query) {
		
		# This is how we did it in class...
		//$books = Book::where('author', 'LIKE', "%$query%")->get();
		
		
		# Here's a better option because it searches across multiple fields
		$books = Book::where('author', 'LIKE', "%$query%")
			->orWhere('title', 'LIKE', "%$query%")
			->orWhere('published', 'LIKE', "%$query%")
			->get();
				
	}
	# Otherwise, just fetch all books
	else {
		$books = Book::all();
	}
	
	# Decide on output method...
	# Default - HTML
	if($format == 'html') {
		return View::make('list')
			->with('books', $books)
			->with('query', $query);
	}
	# JSON
	elseif($format == 'json') {
		return Response::json($books);
	}
	# PDF (Coming soon)
	elseif($format == 'pdf') {
		return "This is the pdf (Coming soon).";
	}	
});




# Display edit form
Route::get('/edit/{title}', function() {
		
});

# Process edit form
Route::post('/edit/{title}', function() {
	
});




# Display add form
Route::get('/add/', function() {

	return View::make('add');
	
});

# Process add form
Route::post('/add/', function() {
	
	//echo Pre::render(Input::all());
	
	# Instantiate the book model
	$book = new Book();
	
	$book->title = Input::get('title');
	$book->author = Input::get('author');
	$book->published = Input::get('published');
	$book->cover = Input::get('cover');
	$book->purchase_link = Input::get('purchase_link');
	
	# Magic: Eloquent
	$book->save();
	
	return "Added a new row";
		
});




/*-------------------------------------------------------------------------------------------------
Debugging/Demonstration Routes
-------------------------------------------------------------------------------------------------*/
Route::get('/composer-openshift-test', function() {

	$generator  = new Badcow\LoremIpsum\Generator();
	$paragraphs = $generator->getParagraphs(5);
	$paragraphs = implode('<p>', $paragraphs);
	
	return $paragraphs;
	
});





/*-------------------------------------------------------------------------------------------------
# Debug route: Read in the books.json file
-------------------------------------------------------------------------------------------------*/
Route::get('/data', function() {
	
	# Instantiating an object of the Library class
	$library = new Library(app_path().'/database/books.json'); 
		
	# Get the books
	$books = $library->get_books();
	
	# Debug
	return Pre::render($books, 'Books');
	
});





/*-------------------------------------------------------------------------------------------------
// !mysql-connection-test
-------------------------------------------------------------------------------------------------*/
Route::get('/mysql-connection-test', function() {
	
	$results = DB::select('SHOW DATABASES;');
	
	return Pre::render($results, 'Results');
	
});


/*-------------------------------------------------------------------------------------------------
// !CRUD: Create
-------------------------------------------------------------------------------------------------*/
Route::get('/crud-create', function() {
	
	# Instantiate the book model
	$book = new Book();
	
	$book->title = 'The Great Gatsby';
	$book->author = 'F. Scott Fiztgerald';
	$book->published = 1925;
	$book->cover = 'http://imagesbn.com....';
	$book->purchase_link = 'http://amazon...';
	
	# Magic: Eloquent
	$book->save();
	
	return "Added a new row";

});





/*-------------------------------------------------------------------------------------------------
// !CRUD: Read
-------------------------------------------------------------------------------------------------*/
Route::get('/crud-read', function() {
	
	//$book = new Book();
	
	# Magic: Eloquent
	$books = Book::all();
	
	# Debugging
	foreach($books as $book) {
		echo $book->title."<br>";
	}
	
	
});


/*-------------------------------------------------------------------------------------------------
// !CRUD: Update
-------------------------------------------------------------------------------------------------*/
Route::get('/crud-update', function() {
	
	# Get a book to update
	$book = Book::first();
	
	# Update the author
	$book->author = 'Foobar';
	
	# Save the changes
	$book->save();
	
	echo "This book has been updated";

});





/*-------------------------------------------------------------------------------------------------
// !CRUD: Delete
-------------------------------------------------------------------------------------------------*/
Route::get('/practice-delete', function() {
	
	# Get a book to delete
	$book = Book::first();
	
	# Delete the book
	$book->delete();
	
	echo "This book has been deleted";
	
});





/*-------------------------------------------------------------------------------------------------
Quick and dirty method to dump out the results of the books collection
-------------------------------------------------------------------------------------------------*/
function print_books($books) {
	
	# Print the results
	if(count($books) > 1) {
		foreach($books as $book) {
			echo $book->title."<br>";
		}
	}
	else {
		echo $books->title;
	}
}




/*-------------------------------------------------------------------------------------------------
// !query-without-constraints
-------------------------------------------------------------------------------------------------*/
Route::get('/query-without-constraints', function() {

	# W/o any constraints
	
	# w/ the find() fetch method
	$books = Book::find(1);
	
	# w/ the first() fetch method
	//$books = Book::first();
		
	# w/ the all() fetch method
	//$books = Book::all();
	
	return print_collection($books);

});



/*-------------------------------------------------------------------------------------------------
// !query-with-constraints
-------------------------------------------------------------------------------------------------*/
Route::get('/query-with-constraints', function() {
		
	# where constraint + first() fetch method
	//$books = Book::where('published','>',1960)->first();
		
	# where constraint + get() fetch method
	//$books = Book::where('published','>',1960)->get();
	
	# multiple constraints + get() fetch method
	/*
	$books = Book::where('published','>',1960)
		->orWhere('title', 'LIKE', '%gatsby')
		->get();
	*/
		
	# whereRaw constraint + the get() fetch method 
	$books = Book::whereRaw('title LIKE "%gatsby" OR title LIKE "%bell%"')->get();

	return print_books($books);
	
});



/*-------------------------------------------------------------------------------------------------
// !collections
-------------------------------------------------------------------------------------------------*/
Route::get('/collections', function() {

	$collection = Book::all();
	
	# The many faces of a Eloquent Collection object...
	
	# Treat it like a string:
	echo $collection;   
	
	# Treat it like an array:
	//foreach($collection as $book) {
    //	echo $book['title']."<br>";
	//}   
	
	# Treat it like an object:
	//foreach($collection as $book) {
	//  echo $book->title."<br>";
	//}
	
	
});




/*-------------------------------------------------------------------------------------------------
// !query-responsibility
-------------------------------------------------------------------------------------------------*/
Route::get('/query-responsibility', function() {
	
	# How can you get the first book?
	
	# Burden falls on the database...
	# 2 queries:
	$books = Book::all(); 
	$first_book = Book::first();

	# Burden falls on the collection...
	# 1 query (better):
	//$books = Book::all();
	//$first_book = $books->first();
	
	print_books($first_book);
	
});




/*-------------------------------------------------------------------------------------------------
// !seed-raw
Quickly seed books table for demonstration purposes
-------------------------------------------------------------------------------------------------*/
Route::get('/seed-raw', function() {
	
	$query = "INSERT INTO `books` (`created_at`, `updated_at`, `title`, `author`, `published`, `cover`, `purchase_link`)
	VALUES
	('2014-07-17 09:15:14','2014-07-17 09:15:14','The Great Gatsby','F. Scott Fiztgerald',1925,'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG','http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565'),
	('2014-07-17 09:15:47','2014-07-17 09:15:47','The Bell Jar','Sylvia Plath',1963,'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG','http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514'),
	('2014-07-17 09:16:20','2014-07-17 09:16:20','I Know Why the Caged Bird Sings','Maya Angelou',1969,'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG','http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400');
	";
	
	DB::statement($query);
	
	return $query;
	
});





/*-------------------------------------------------------------------------------------------------
// !collection
-------------------------------------------------------------------------------------------------*/

Route::get('/example', function() {
	
	$collection = Book::all();
	echo Pre::render($collection);
	
	
});





/*-------------------------------------------------------------------------------------------------
// !seed-orm
# Quickly seed books table for demonstration purposes
-------------------------------------------------------------------------------------------------*/
Route::get('/seed-orm', function() {
	
	# Clear the tables to a blank slate
	DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
	DB::statement('TRUNCATE books');
	DB::statement('TRUNCATE authors');
	DB::statement('TRUNCATE tags');
	DB::statement('TRUNCATE book_tag');
	
	# Authors
	$fiztgerald = new Author;
	$fiztgerald->name = 'F. Scott Fiztgerald';
	$fiztgerald->birth_date = '1896-09-24';
	$fiztgerald->save();
	
	$plath = new Author;
	$plath->name = 'Sylvia Plath';
	$plath->birth_date = '1932-10-27';
	$plath->save();

	$angelou = new Author;
	$angelou->name = 'Maya Angelou';
	$angelou->birth_date = '1928-04-04';
	$angelou->save();
	
	# Tags (Created using the Model Create shortcut method)
	# Note: Tags model must have `protected $fillable = array('name');` in order for this to work
	$novel         = Tag::create(array('name' => 'novel'));
	$fiction       = Tag::create(array('name' => 'fiction'));
	$nonfiction    = Tag::create(array('name' => 'nonfiction'));
	$classic       = Tag::create(array('name' => 'classic'));
	$wealth        = Tag::create(array('name' => 'wealth'));
	$women         = Tag::create(array('name' => 'women'));
	$autobiography = Tag::create(array('name' => 'autobiography'));
	
	# Books		
	$gatsby = new Book;
	$gatsby->title = 'The Great Gatsby';
	$gatsby->published = 1925;
	$gatsby->cover = 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG';
	$gatsby->purchase_link = 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565';
	
	# Associate has to be called *before* the book is created (save()) 
	$gatsby->author()->associate($fiztgerald); # Equivalent of $gatsby->author_id = $fiztgerald->id
	$gatsby->save();
	
	# Attach has to be called *after* the book is created (save()), 
	# since resulting `book_id` is needed in the book_tag pivot table
	$gatsby->tags()->attach($novel); 
	$gatsby->tags()->attach($fiction); 
	$gatsby->tags()->attach($classic); 
	$gatsby->tags()->attach($wealth); 
	
	$belljar = new Book;
	$belljar->title = 'The Bell Jar';
	$belljar->published = 1963;
	$belljar->cover = 'http://img1.imagesbn.com/p/9780061148514_p0_v2_s114x166.JPG';
	$belljar->purchase_link = 'http://www.barnesandnoble.com/w/bell-jar-sylvia-plath/1100550703?ean=9780061148514';
	$belljar->author()->associate($plath);
	$belljar->save();
	$belljar->tags()->attach($novel); 
	$belljar->tags()->attach($fiction); 
	$belljar->tags()->attach($classic); 
	$belljar->tags()->attach($women); 

	$cagedbird = new Book;
	$cagedbird->title = 'I Know Why the Caged Bird Sings';
	$cagedbird->published = 1969;
	$cagedbird->cover = 'http://img1.imagesbn.com/p/9780345514400_p0_v1_s114x166.JPG';
	$cagedbird->purchase_link = 'http://www.barnesandnoble.com/w/i-know-why-the-caged-bird-sings-maya-angelou/1100392955?ean=9780345514400';
	$cagedbird->author()->associate($angelou);
	$cagedbird->save();
	$cagedbird->tags()->attach($autobiography); 
	$cagedbird->tags()->attach($nonfiction); 
	$cagedbird->tags()->attach($classic); 
	$cagedbird->tags()->attach($women);
	
	echo "Done; check DB for results."; 
	
});





/*-------------------------------------------------------------------------------------------------
// !query-relationships-author
-------------------------------------------------------------------------------------------------*/
Route::get('/query-relationships-author', function() {
	
	# Get the first book as an example
	$book = Book::first();
		
	# Get the author from this book using the "author" dynamic property
	# "author" corresponds to the the relationship method defined in the Book model
	$author = $book->author; 
	
	# Print book info
	echo $book->title." was written by ".$author->name."<br>";
	
	# FYI: You could also access the author name like this:
	//$book->author->name;
			
});





/*-------------------------------------------------------------------------------------------------
// !query-relationships-tags
-------------------------------------------------------------------------------------------------*/
Route::get('/query-relationships-tags', function() {
	
	# Get the first book as an example
	$book = Book::first();
		
	# Get the tags from this book using the "tags" dynamic property
	# "tags" corresponds to the the relationship method defined in the Book model
	$tags = $book->tags; 
	
	# Print results
	echo "The tags for <strong>".$book->title."</strong> are: <br>";
	foreach($tags as $tag) {
		echo $tag->name."<br>";
	}

			
});





/*-------------------------------------------------------------------------------------------------
// !query-eager-loading-tags
-------------------------------------------------------------------------------------------------*/
Route::get('/query-eager-loading-tags', function() {
	
	# Without eager loading: N+1: 1 Query to get all books plus 1 query for each author (4 total)
	$books = Book::get();
	
	# Eager loading: 2 Queries: 1 query to get all the books, 1 query to get all the authors
	//$books = Book::with('author')->get();
	
	foreach($books as $book) {
		echo $book->author->name.' wrote '.$book->title.'<br>';
	}
			
});





/*-------------------------------------------------------------------------------------------------
// !query-eager-loading-tags-and-author
-------------------------------------------------------------------------------------------------*/
Route::get('/query-eager-loading-tags-and-authors', function() {
	
	# Without eager loading: 7 Queries
	//$books = Book::get();

	# With eager loading: 3 Queries
	// $books = Book::with('tags','author')->get(); 
	
	# Print results
	foreach($books as $book) {
		
		echo $book->title.' by '.$book->author->name.'<br>';
		foreach($book->tags as $tag) {
			echo $tag->name.", ";
		}
		
		echo "<br><br>";
	}
		
});







/*-------------------------------------------------------------------------------------------------
Environment fiddling
-------------------------------------------------------------------------------------------------*/
Route::get('/environment', function() {
	
	echo "Environment: ".App::environment();
	
});

Route::get('/trigger-error',function() {
	
	$foo = new Foobar;
	
});

