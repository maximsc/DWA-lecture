<?php 

class Book extends Eloquent { 
	
	# Relationship method...
    public function author() {
    
    	# Books belongs to Author
	    return $this->belongsTo('Author');
    }
    
    # Relationship method...
    public function tags() {
    
    	# Books belong to many Tags
        return $this->belongsToMany('Tag');
    }
    
}