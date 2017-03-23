<?php

class stationaryController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'stationaryController@showWelcome');
	|
	*/
	public function fetchMenu($view="stationary",$currH="KAPILI"){
		$currH = strtoupper($currH);
		if($view!="mess"){
			$store_type=$view;
			$hostel = Hostel::where('name',$currH)->first();
			$vendor = $hostel->vendor($store_type);
			if(!$vendor){
				$items=[];
				$vendor=['name'=>'No Vendor'];
			}
			else{
				$items=   $vendor->products();
				$vendor=$vendor->toArray();
			}
		}
		else{
			$items = [];
			$vendor = [];
		}

		return View::make('stationary.'.$view)->with(['currH'=>$currH,'view'=>$view,'items'=>$items,'vendor'=>$vendor]);
	}
}
