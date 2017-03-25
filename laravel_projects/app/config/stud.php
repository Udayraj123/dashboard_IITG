<?php
$fresher_fields = ['Roll'=>'roll','Name'=>'name','Hostel'=>'hostel','Room'=>'room','Webmail'=>'webmail','Discipline'=>'discipline','Division'=>'division','Lab'=>'lab_group','Tut'=>'tut_group',];
$crep_extras=['Address'=>'address','Contact'=>'contact_iitg'];
$crep_fields=array_merge($fresher_fields,$crep_extras);
$days= [
'1'=>'Mon',
'2'=>'Tue',
'3'=>'Wed',
'4'=>'Thu',
'5'=>'Fri',
];
$divToALorML= [
'1'=>'ML',
'2'=>'ML',
'3'=>'AL',
'4'=>'AL',
'I'=>'ML',
'II'=>'ML',
'III'=>'AL',
'IV'=>'AL',
];
$divsToVenue= [
'1'=>'L1',
'3'=>'L1',
'2'=>'L3',
'4'=>'L3',
'I'=>'L1',
'III'=>'L1',
'II'=>'L3',
'IV'=>'L3',
];
$subsToVenue=[
'CS' => 'Computer Center',
'EC' => 'Core 2 (EE)',
'PH' => 'Core 4 (PH)',
'ME' => 'WorkShop',
];
$TutsToVenue=[
'T1'=>'Lecture Hall 1',
'T4'=> 'Lecture Hall 4',
'T7'=> '1G2 ',
'T10'=> '2102',
'T13'=> '4G',
'T2'=> 'Lecture Hall 2',
'T5'=> '1006',
'T8'=> '1207',
'T11'=> '4001',
'T14'=> '400',
'T3'=> 'Lecture Hall 3',
'T6'=> '1G1',
'T9'=> '2101',
'T12'=> '4G',
];
$SAToVenue=[
'#N/A'=>'Old SAC',
'Athletics'=>'Old SAC',
'Badminton'=>'Old SAC',
'Basketball'=>'Old SAC',
'Cricket'=>'Old SAC',
'Football'=>'Old SAC',
'Hockey'=>'Old SAC',
'Lawn Tennis'=>'Old SAC',
'Table Tennis'=>'Old SAC',
'Volleyball'=>'Old SAC',
'Yoga'=>'Old SAC',
];
$labTimings=[
'ML'=>'9AM to 12PM',
'AL'=>'2PM to 5PM',
];

$classTimings=[
'ML'=>'2PM to 5PM',
'AL'=>'9AM to 12PM',
];


/********** NEED TO FILL THIS ***********/
$divToclassTimings=[
'I'=>[
'9AM to 10AM'=>'Physics',
],

]
;

$labGrpsToSched =[
'L1'=>['CS'=>'1','EC'=>'4','PH'=>'2'],
'L2'=>['CS'=>'3','EC'=>'1','PH'=>'4'],
'L3'=>['CS'=>'5','EC'=>'3','PH'=>'1'],
'L4'=>['CS'=>'2','EC'=>'5','PH'=>'3'],
'L5'=>['CS'=>'4','EC'=>'2','PH'=>'5'],
'L6'=>['CS'=>'1','EC'=>'4','PH'=>'2'],
'L7'=>['CS'=>'3','EC'=>'1','PH'=>'4'],
'L8'=>['CS'=>'5','EC'=>'3','PH'=>'1'],
'L9'=>['CS'=>'2','EC'=>'5','PH'=>'3'],
'L10'=>['CS'=>'4','EC'=>'2','PH'=>'5'],
];


$tutTimings=[
'1'=>['timing'=>'8AM to 9AM','name'=>'XYZ Tutorial'],
'3'=>['timing'=>'8AM to 9AM','name'=>'XYZ Tutorial'],
'5'=>['timing'=>'8AM to 9AM','name'=>'XYZ Tutorial'],
];


$labGrpsToDays =[
'L1'=>['1','4','2'],
'L2'=>['3','1','4'],
'L3'=>['5','3','1'],
'L4'=>['2','5','3'],
'L5'=>['4','2','5'],
'L6'=>['1','4','2'],
'L7'=>['3','1','4'],
'L8'=>['5','3','1'],
'L9'=>['2','5','3'],
'L10'=>['4','2','5'],
];
//Tuts are commons
//SA groups to Days

$SAgrpToTimings = [
'A'=>[
'1'=>'7PM to 8PM',
'3'=>'6PM to 7PM',
'5'=>'7PM to 8PM',
],
'B'=>[
'1'=>'7PM to 8PM',
'3'=>'6PM to 7PM',
'5'=>'7PM to 8PM',
],
'C'=>[
'1'=>'7PM to 8PM',
'3'=>'6PM to 7PM',
'5'=>'7PM to 8PM',
],

];
//Time ordering
$timeSlots=[
'8AM to 9AM',
'9AM to 12PM',
'2PM to 5PM',
'6PM to 7PM',
'7PM to 8PM',
];
$daySlots=[
'Mon',
'Tue',
'Wed',
'Thu',
'Fri',
];


return array(
	'timeSlots'=>$timeSlots,
	'days'=>$days,
	'divToALorML'=>$divToALorML,
	'subsToVenue'=>$subsToVenue,
	'divsToVenue'=>$divsToVenue,
	'classTimings'=>$classTimings,
	'TutsToVenue'=>$TutsToVenue,
	'SAToVenue'=>$SAToVenue,
	'labTimings'=>$labTimings,
	'labGrpsToSched'=>$labGrpsToSched,
	'tutTimings'=>$tutTimings,
	'SAgrpToTimings'=>$SAgrpToTimings,
	'fresher_fields'=>$fresher_fields,
	'crep_fields'=>$crep_fields,
	);
