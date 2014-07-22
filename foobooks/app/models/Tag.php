<?php 

class Tag extends Eloquent { 
	
    public function books() {
	    return $this->belongsToMany('Book');
    }
    
}