<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Fresher extends Eloquent{
	protected $table = 'freshers';
	function getDetails(){
		$fresher_fields = 	C::get('stud.fresher_fields');
		$details= [];
		foreach ($fresher_fields as $h=>$f) {
			$details[$h]=$this->$f;
		}
		return $details;
	}
	
	function getTimeTable(){
		$rollNo=trim($this->roll);
		$labGrpNo=trim($this->lab_group);
		$tutGrpNo=trim($this->tut_group);
		$divNo=trim($this->division);
		$days=C::get('stud.days');
		$divToALorML=C::get('stud.divToALorML');
		$subsToVenue=C::get('stud.subsToVenue');
		$TutsToVenue=C::get('stud.TutsToVenue');
		$SAToVenue=C::get('stud.SAToVenue');
		$labTimings=C::get('stud.labTimings');
		$labGrpsToSched=C::get('stud.labGrpsToSched');
		$tutTimings=C::get('stud.tutTimings');
		$SAgrpToTimings=C::get('stud.SAgrpToTimings');

		// Best method seems to have timings array by day for each stud
		$studTimings=[];
		$ALorML = $divToALorML[$divNo];
			$tutVenue = $TutsToVenue[$tutGrpNo];//global
		//as they are common. // Add Tut timings
			foreach($tutTimings as $day => $nameTime){
				$timing=$nameTime['timing'];
				$name=$nameTime['name'];
				$studTimings[$days[$day]][$timing]=['name'=>$name,'venue'=>$tutVenue];
			}
		// Add Class timings
			
			$divsToVenue=C::get('stud.divsToVenue');
			$classTimings=C::get('stud.classTimings');
			$Ctiming = $classTimings[$ALorML];
			foreach ($days as $day => $Dday) {
				//everyday same time. Same venue? check.
				$studTimings[$Dday][$Ctiming]=['name'=>'Classes','venue'=>$divsToVenue[$divNo]];
			}
			

		// Add Lab timings
			$labSched = $labGrpsToSched[$labGrpNo];
			foreach($labSched as $subject => $day){
				$timing = $labTimings[$ALorML];
				$studTimings[$days[$day]][$timing]=['name'=>$subject.' Lab','venue'=>$subsToVenue[$subject]];
			}
			$SAname = $this->sa_name;
			$SAgrp = $this->sa_group;
		//Add SA timings
			if($SAgrp && $SAname && $SAname != "#N/A" && $SAgrp != "#N/A"){
				foreach ($SAgrpToTimings[$SAgrp] as $day => $timing) {
					$studTimings[$days[$day]][$timing]=['name'=>$SAname,'venue'=>$SAToVenue[$SAname]];
				}
			}

			//Sort by timeline
			$timeSlots=C::get('stud.timeSlots');
//Method 1 : 
			foreach ($studTimings as $day => $dayTimes) {
				uksort($dayTimes, function ($item1, $item2) use($timeSlots){
					$key1= array_search($item1, $timeSlots);
					$key2= array_search($item2, $timeSlots);
					$ret = $key1 < $key2 ? -1 : ( $key1 > $key2? 1 : 0 );
					return $ret;
				});
				$studTimings[$day]=$dayTimes;
				
			}
			$daySlots=C::get('stud.daySlots');
			// Here it works for Mon Tue Wed !!
			uksort($studTimings, function($a, $b) {
				return ( strtotime($a) > strtotime($b) );
			});
			return $studTimings;
			
		}


		function overlapping($slot,$time){
			$matches=[];
			$pattern =  '/(\d\d?)(\w)M (?i)TO(?-i) (\d\d?)(\w)M/'; //case insensitive
			// $slot = '9AM TO 1PM';
			//$time = '7PM'
			preg_match_all($pattern, $slot, $matches);
			$start = $matches[1][0]; //9
			$startA_P = $matches[2][0];//' '
			$end = $matches[3][0];//1
			$endA_P = $matches[4][0];//P
			//both S & E are in common timer.
			$matches2=[];
			$pattern2 =  '/(\d\d?)[\:0-9 ]*(\w)M/';
			preg_match_all($pattern2, $time, $matches2);
			$h = (int)$matches2[1][0];//02
			$hA_P = $matches2[2][0];//P

			if($startA_P == $endA_P){
				if($endA_P != $hA_P)
					$flag = 0;
			}
			else{//different times
				if($end<12)$end+=12;
				if($h<12 && $hA_P==$endA_P)$h += 12; 
			}
			$flag = $h<=$end && $h>=$start;
			return $flag;
		}

		function getTimeSlot($time=""){
			if($time=="")
				$time = date('hA',time());
			$slots = C::get('stud.timeSlots');
			foreach ($slots as $slot) {
				if($this->overlapping($slot,$time)){
					return $slot;
				}
			}
			return '8PM to 8AM';
		}

		function getCurrJob($Dday='Mon',$Ttime=""){
			$studTimings=$this->getTimeTable();
			$timing = $this->getTimeSlot($Ttime);
			if(array_key_exists($timing,$studTimings[$Dday])){	
				return $studTimings[$Dday][$timing];
			}
			else return ['name'=>'','venue'=>'N/A'];
		}
	}
