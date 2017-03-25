<?php

class studSearchController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'studSearchController@showWelcome');
	|
	*/
	public function searchStud(){
		return View::make('student_search.student_search');
	}
	public function postSearchStud(){
		
		if(Input::has('col'))
			$col=Input::get('col');
		else $col='name';
		$inp=Input::get('value');
		// split on 1+ whitespace & ignore empty (eg. trailing space)
		$studs=Fresher::where($col,'like','%'.$inp.'%')->get();
		// $searchValues = preg_split('/\s+/', $inp, -1, PREG_SPLIT_NO_EMPTY);
		// $studs=Fresher::where(
		// 	function($q) use($col,$searchValues) {
		// 		foreach($searchValues as $n)
		// 			$q->orWhere($col,'like','%'.$n.'%');
		// 	})->get();
		if($studs->isEmpty()){
			return Redirect::route('searchStud')->withErrors('No such Student');
		}
		else {
			return View::make('student_search.student_search',array('studs' => $studs));
		}
	}

	public function getTimeTableModal(){
		$id=Input::get('id');
		$fresher = Fresher::find($id);
		$tt=$fresher->getTimeTable();
		return View::make('student_search.makeTimeTable')->with('studTimings',$tt);
	}
}
