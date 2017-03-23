<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		// $this->call('users');
		// $this->call('admins');
		// $this->call('students');
		$this->call('hostels');
		$this->call('vendors');
		$this->call('productset');
		$this->call('products');
		// $this->call('teachers');
		// $this->call('roles'); 
		// $this->call('approvals');
	}

}
