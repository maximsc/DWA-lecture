<?php 

class Author extends Eloquent { 
	
	/**
	* Relationship method
	*/
	public function books() {
		
		# Author has many books
        return $this->hasMany('Book');
        
    }
    
    /**
	* Gets the authors as a id -> name key value pair. Useful for building selects.
	*/
	public static function getIdNamePair() {
		
		$authors    = Array();
		
		$collection = Author::all();	
	
		foreach($collection as $author) {
			$authors[$author->id] = $author->name;
		}	
		
		return $authors;	
	}

  	
}