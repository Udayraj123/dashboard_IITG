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
		$this->call('hostels');
		$this->call('vendors');
		$this->call('productset');
		$this->call('products');
	}

}
