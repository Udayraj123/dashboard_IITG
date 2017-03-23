<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			//
		Schema::create('products',function($table){
			$table->increments('id');
			// $table->integer('productset_id');
			$table->string('name');
			$table->integer('vendor_id');
			$table->integer('left');
			$table->integer('price');
			$table->integer('monthly_orders');
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
			Schema::drop('products');
			//
		}

	}
