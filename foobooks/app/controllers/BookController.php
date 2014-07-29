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
	public function getIndex() {
	
		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');
		
		$query  = Input::get('query');
		
		# If there is a query, search the library with that query
		if($query) {
		
			# Eager load tags and author
	 		$books = Book::with('tags','author')
	 		->whereHas('author', function($q) use($query) {
			    $q->where('name', 'LIKE', "%$query%");
			})
			->orWhereHas('tags', function($q) use($query) {
			    $q->where('name', 'LIKE', "%$query%");
			})
			->orWhere('title', 'LIKE', "%$query%")
			->orWhere('published', 'LIKE', "%$query%")
			->get();
					 		   	 		   		
		}
		# Otherwise, just fetch all books
		else {
			# Eager load tags and author
			$books = Book::with('tags','author')->get();
		}
		
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
