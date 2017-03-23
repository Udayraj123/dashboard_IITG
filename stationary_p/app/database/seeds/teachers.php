<?php
class teachers extends Seeder {
	public function run(){
		DB::table('teachers')->truncate();
		$teacher_names=C::get('p.teacher_names');
		$departments=C::get('p.departments');
		$modN=count($teacher_names);$modD=count($departments);
		$admin_names=C::get('p.admin_names');
		$modA=count($admin_names); 
		$start=$modA;
		$n=$modN;
		$dummies=[];
		for($i=0;$i<$n;$i++){
			$dummy=[];
			$dummy['user_id']=$i+1+$start;
			$dummy['full_name']=$teacher_names[$i%$modN];
			$dummy['department']=$departments[$i%$modD];
			array_push($dummies, $dummy);
		}

		DB::table('teachers')->insert($dummies);
	}
}