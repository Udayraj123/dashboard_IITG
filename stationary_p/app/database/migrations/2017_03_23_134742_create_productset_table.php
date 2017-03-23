<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			//
		Schema::create('productset',function($table){
			$table->increments('id');
			$table->string('img', 250);
			$table->string('name', 250);
			// $table->enum('store_type',C::get('p.store_types'));
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
			Schema::drop('productset');
			//
		}

	}
