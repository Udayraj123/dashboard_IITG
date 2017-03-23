<?php
class vendors extends Seeder {
	public function run(){
		//run hostel seed first
		DB::table('vendors')->truncate();
		$store_types= C::get('p.store_types');
		$dummies_v=[];
		foreach (Hostel::all() as $h) {
			foreach ($store_types as $type) {
				$v=[];
				$v['name']=$h->name.'_'.$type;
				$v['contact']=9988776655;
				$v['store_type']=$type;
				$v['hostel_id'] = $h->id;
				$dummies_v[] = $v;
			}
		}

		DB::table('vendors')->insert($dummies_v);
	}
}