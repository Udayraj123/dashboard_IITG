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
	public function fetchMenu($view="station",$currH="KAPILI"){
	return View::make('stationary.'.$view);
		$hostel = Hostel::where('name',$currH)->first();
		$vendor = $hostel->vendor($view);
		$items=   $vendor->products();
		return View::make('stationary.'.$view)->with(['currH'=>$currH,'items'=>$items]);
	}
}
