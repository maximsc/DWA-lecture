<?php 

class Book extends Eloquent { 
	
    public function author() {
	    return $this->belongsTo('Author');
    }
    
    public function tags() {
        return $this->belongsToMany('Tag');
    }
    
}