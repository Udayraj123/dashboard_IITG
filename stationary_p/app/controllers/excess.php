

// NO NEED OF THE FUNCTION BELOW ! (if needed later, checkout the zip)

	public function getRoleFacs(){
		//will not scan for faculty role
//for fac_approvals, use stud->deptfacs
		$u=Auth::user();
		$s=$u->student;
		$non_fac_dept =			C::get('p.non_fac_dept');
		$hostel_roles =			C::get('p.hostel_roles');
		$other_roles =			C::get('p.other_roles');
		$qip_roles =			C::get('p.qip_roles');
		$daysch_roles =			C::get('p.daysch_roles');
		$roles=[];
		foreach ($non_fac_dept as $r) {
			$teacher = Role::where('role',$r)->where('domain_val',$s->department)->first();
			if($teacher)array_push($roles,$teacher->toArray());
		}
		foreach ($hostel_roles as $r) {
			$teacher = Role::where('role',$r)->where('domain_val',$s->hostel)->first();
			if($teacher)array_push($roles,$teacher->toArray());
		}
		if($s->is_qip==1){
			foreach ($qip_roles as $r) {
				$teacher = Role::where('role',$r)->first();
				if($teacher)array_push($roles,$teacher->toArray());
			}
		}

		if($s->is_daysch==1){
			foreach ($daysch_roles as $r) {
				$teacher = Role::where('role',$r)->first();
				if($teacher)array_push($roles,$teacher->toArray());
			}
		}
		$rolefacs=[];

		//one person per role for the student
		foreach ($roles as $t) {
			$fac=User::find($t['user_id']);
			if($fac){
				$details=[
				'full_name'=>$fac->teacher->full_name,
				'role'=>$t['role'],
				'domain_field'=>$t['domain_field'],
				'domain_val'=>$t['domain_val'],
				];
				array_push($rolefacs,$details);
			}
		}
		return $rolefacs;
	}