<?php

class vendorController extends Controller {

	public function fetchProds($q='') {
		if(Input::has('q'))
			$q=Input::get('q');
		$prods = Productset::where('name','like','%'.$q.'%')->get();
		return View::make('stationary.addprods')->with('prods',$prods);
	}
	public function addProd() {
//Set Productset_id, amount,etc fields from the post data
		
		$fields = [
		'productset_id'=>Input::get('productset_id'),
		'name'=>Productset::find(Input::get('productset_id'))->name,
		'left'=>Input::get('left'),
		'price'=>Input::get('price'),
		'monthly_orders'=>Input::get('monthly_orders'),
		'vendor_id'=>Auth::id(),
		];

		$p = new Product($fields);
		$p->save();
		return "added product";
	}
	public function delProd() {
		$p = Product::find(Input::get('id'));
		$vendor_id = Auth::id();
		if($p->vendor_id == $vendor_id){
			$p->delete();
			return "Deleted.";
		}
		else{
			return "Authentication Error.";
		}
	}
	public function makeDummy($n){
		$v = new Vendor();
		$v->username= $n;
		$v->password= Hash::make($n);
		$v->hostel_id= 1;
		$v->store_type= 'stationary';
		$v->save();
		return $v;
	}
	public function login(){
		return View::make('login');
	}
	public function postlogin()
	{
		if (Input::has(['username','password']) && Auth::attempt(array('username' =>Input::get('username'), 'password' => Input::get('password')),true)){
			$user=Auth::user();			
			if($user->hostel)
				return Redirect::route('stationary_view');
			else{
				Auth::user()->logout();
				return View::make('login')->with('errors',['No hostel linked to vendor']);
			} 
		}
		else {        
			return View::make('login')->with('errors',["Wrong Credentials"]);
		}
	}
}

