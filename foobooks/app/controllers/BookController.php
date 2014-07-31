<?php

class BookController extends \BaseController {


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		
		# Make sure BaseController construct gets called
		parent::__construct();		
		
		# Only logged in users should have access to this controller
		$this->beforeFilter('auth');
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getSearch() {
				
		return View::make('book_search');
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	http://localhost/book/search
	Demonstrate of Ajax
	-------------------------------------------------------------------------------------------------*/
	public function postSearch() {
		
		if(Request::ajax()) {
		
			$query  = Input::get('query');
			
			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');

			# Do the actual query
	        $books  = Book::search($query);
	        
	        # If the request is for JSON, just send the books back as JSON
	        if($format == 'json') {
		        return Response::json($books);
	        }
	        # Otherwise, loop through the results building the HTML View we'll return
	        elseif($format == 'html') {
	        

		        $results = '';	        
				foreach($books as $book) {
					# Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
					# For each book, we'll add a new stub to the results
					$results .= View::make('book_search_result')->with('book', $book)->render();   
				}
	        
				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getIndex() {
	
		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');
		
		$query  = Input::get('query');
		
		$books = Book::search($query);
		
		# Decide on output method...
		# Default - HTML
		if($format == 'html') {
			return View::make('book_index')
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
		
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getEdit($id) {
		
		$book = Book::with('author')->findOrFail($id);
				
		$authors = Author::getIdNamePair();
						
		return View::make('book_edit')
			->with('book', $book)
			->with('authors', $authors);
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function postEdit($id) {
		
		$book = Book::findOrFail($id);
		$book->fill(Input::all());
		$book->save();
		
		return Redirect::action('BookController@getIndex')->with('flash_message','Your changes have been saved.');
		
	}
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function getCreate() {
	
		$authors = Author::getIdNamePair();
	
		return View::make('book_create')->with('authors', $authors);
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function postCreate() {
		
		# Instantiate the book model
		$book = new Book();
		
		$book->fill(Input::all());
		$book->save();
		
		# Magic: Eloquent
		$book->save();
		
		return Redirect::action('BookController@getIndex')->with('flash_message','Your book has been added.');

	}
	
}
