<?php
class hostels extends Seeder {
	public function run(){
		DB::table('hostels')->truncate();
		$hostels = C::get('p.hostels');
		$dummies=[];
		foreach ($hostels as $h) {
			$dummy=[];
			$dummy['name']=$h;
			array_push($dummies, $dummy);
		}
		DB::table('hostels')->insert($dummies);
	}
}