<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students',function($table){
			$table->increments('id');
			$fields=C::get('p.studfields');
			foreach($fields['string'] as $si) $table->string($si);
			foreach($fields['integer'] as $ii) $table->integer($ii);
			$table->enum('hostel',C::get('p.hostels'));
			$table->enum('department',C::get('p.departments'));
			$table->timestamps();
			foreach($fields['bigInteger'] as $bi) $table->bigInteger($bi);
			foreach($fields['tinyinteger'] as $ti) $table->tinyinteger($ti)->default(0);
		});
		
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');

	}

}
