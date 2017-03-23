<?php

class AdminController extends Controller {

	public function addRole() {
	// Only admin access (filtered.)
		$all_roles =Config::get('p.roles');
		$dept_roles =Config::get('p.department_roles');
		$hostel_roles =Config::get('p.hostel_roles');
		$qip_roles =Config::get('p.qip_roles');
		$daysch_roles =Config::get('p.daysch_roles');
		if(!(Input::has('role','sel_faculty') &&  array_search(Input::get('role'), $all_roles)>-1))return array('status'=>'Invalid Input');

		$t=Teacher::find(Input::get('sel_faculty'));
		$u=$t->user;
		$role=Input::get('role');

		$curr_role=[];
		foreach($u->roles as $r)if($r->role==$role)$curr_role=$r;
		if($curr_role!=[])return array('status'=>'Role already exists!');

		$r=new Role();
		$r->user_id=$u->id;
		$r->role=$role;
			//special roles below- can be shortened by preset spl_roles array
		if(Input::has('domain_val2')&& array_search($role, $dept_roles)>-1){
			$r->domain_field='department';
				$r->domain_val=Input::get('domain_val2');//$t->department;
			}
			else if(Input::has('domain_val') && array_search($role, $hostel_roles ) > -1){
				$r->domain_field='hostel';
				$r->domain_val=Input::get('domain_val');
			}
			else if(array_search($role, $qip_roles )>-1){
				$r->domain_field='is_qip';
				$r->domain_val=1;//above column is checked for this value
			}
			else if(array_search($role, $daysch_roles )>-1){
				$r->domain_field='is_daysch';
				$r->domain_val=1;//above column is checked for this value
			}

			$r->save();
			return Redirect::route('panel_admin');
		}
	}
