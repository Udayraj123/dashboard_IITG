<?php
class users extends Seeder {
	public function run(){
		DB::table('users')->truncate();
		$admin_names=C::get('p.admin_names');
		$student_names=C::get('p.student_names');
		$teacher_names=C::get('p.teacher_names');
		$departments=C::get('p.departments');
		$types=C::get('p.types');
		$modA=count($admin_names); 
		$modS=count($student_names); 
		$modTC=count($teacher_names); 
		$modT=count($types); $modD=count($departments);
		$dummies=[];
		$start=0;
		//add admins
		for($i=0;$i<$modA;$i++){
			$dummy=[];
			$dummy['username']=$admin_names[$i%$modA];
			$dummy['password']=Hash::make('CSE');//$departments[$i%$modD]);
			$dummy['type']=$types[($i/3)%$modT];
			array_push($dummies, $dummy);
		}
		//add teachers
		for($i=0;$i<$modTC;$i++){
			$dummy=[];
			$dummy['username']=$teacher_names[$i%$modTC];
			$dummy['password']=Hash::make('CSE');//$departments[$i%$modD]);
			$dummy['type']='teacher';
			array_push($dummies, $dummy);
		}
		//add students
		for($i=0;$i<$modS;$i++){
			$dummy=[];
			$dummy['username']=$student_names[$i%$modS];
			$dummy['password']=Hash::make('CSE');//$departments[$i%$modD]);
			$dummy['type']='student';
			array_push($dummies, $dummy);
		}
		DB::table('users')->insert($dummies);
	}
}