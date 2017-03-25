<?php
class productset extends Seeder {
	public function run(){
		//run hostel seed first
		DB::table('productset')->truncate();
		$store_types= C::get('p.store_types');
		$store_types_foods= C::get('p.store_types_foods');
		
		$dummies_v=[];
		foreach ($store_types as $type) {
			foreach ($store_types_foods[$type] as $food) {
				$v=[];
				$v['name']=$food;
				// $v['store_type']=$type;//not added yet
				// $v['img']=$food.'.jpg';
				$dummies_v[] = $v;
			}
		}

		DB::table('productset')->insert($dummies_v);
	}
}