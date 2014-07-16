<?php

class Library {
	
	// Properties - Variables, Params
	
	// String
	public $path;

	// Array	
	public $books;
	
	// Methods - Functions
	// Encapsulation
	
	
	public function __construct($path) {
		
		$this->set_path($path);
		
	}
	
	// public, private, protected, static 
	
	public function get_path() {	
		return $this->path;
	}
	
	public function set_path($new_path) {
		$this->path = $new_path;
	}
	
	public function get_books() {
	
		// Load the json file
		$books = File::get($this->path);
	
		// Convert the string of JSON into object
		$books = json_decode($books,true);
		
		// Set the class param
		$this->books = $books;
		
		return $books;
		
	}
	
	
	/**
	* @param String $query
	* @return Array $results
	*/
	public function search($query) {
	
		$books = $this->books;
						
		# If any books match our query, they'll get stored in this array
		$results = Array();
		
		# Loop through the books looking for matches
		foreach($books as $title => $book) {
								
			# First compare the query against the title
			if(stristr($title,$query)) {
			
				# There's a match - add this book the the $results array
				$results[$title] = $book;
			}
			# Then compare the query against all the attributes of the book (author, tags, etc.)
			else {
						
				if(self::search_book_attributes($book,$query)) {
					# There's a match - add this book the the $results array
					$results[$title] = $book;
				}
			}
		}
		
		return $results;
	
	}

	/**
	* Resursively search through a book's attributes looking for a query match
	* @param Array $attributes
	* @param String $query
	* @return Boolean
	*/
	private function search_book_attributes($attributes,$query) { 
	        
	    foreach($attributes as $k => $value) { 
	        
	      	# Dig deeper
	        if (is_array($value)) {
	        	return self::search_book_attributes($value,$query);
	        }
	   		
	   		if(stristr($value,$query)) {
	   			return true;
	   		}             
	    } 
	  
		return false;
	  
	 }
	
	
	
	
}