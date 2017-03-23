<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			//
		Schema::create('vendors',function($table){
			$table->increments('id');
			$table->integer('hostel_id');
			$table->string('name', 250); 
			$table->enum('store_type',C::get('p.store_types'));
			$table->timestamps();
		});
	}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('vendors');
			//
		}

	}
