<?php

class FoobooksSeeder extends Seeder {
	
	
	public function run() {
		
		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE books');
		DB::statement('TRUNCATE authors');
		DB::statement('TRUNCATE tags');
		DB::statement('TRUNCATE book_tag');
		DB::statement('TRUNCATE users');
		
		# Authors
		$fitzgerald = new Author;
		$fitzgerald->name = 'F. Scott Fitzgerald';
		$fitzgerald->birth_date = '1896-09-24';
		$fitzgerald->save();
		
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
		$gatsby->author()->associate($fitzgerald); # Equivalent of $gatsby->author_id = $fitzgerald->id
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
		
		$user = new User;
		$user->email = 'susan@susanbuck.net';
		$user->password = Hash::make('susan');
		$user->save();
		
	
	}
	
}