<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds. This is what gets run when you issue the seed command from CL
	 *
	 * @return void
	 */
	public function run() {
	
		Eloquent::unguard(); # Tell Eloquent to allow mass assignment

		$this->call('FoobooksSeeder');
	}

}
