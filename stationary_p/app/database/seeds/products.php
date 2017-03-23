<?php
class products extends Seeder {
	public function run(){
		//run hostel seed first
		DB::table('products')->truncate();
		$store_types= C::get('p.store_types');
		$store_types_foods= C::get('p.store_types_foods');
		$dummies_v=[];
		foreach (Vendor::all() as $t) {
			$v=[];
			$foods = $store_types_foods[$t->store_type];
			$l=count($foods);
			// $v['productset_id']=Productset::where('name',$foods[$l-1])->first()->id;
			$v['name']=$foods[rand()%$l];
			$v['vendor_id']=$t->id;
			$v['left']=10;
			$v['price']=50;
			$v['monthly_orders']=60;
			$dummies_v[] = $v;
		}

		DB::table('products')->insert($dummies_v);
	}
}