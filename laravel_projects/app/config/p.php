<?php
//dummy data
$teacher_names=[
'Santosh Biswas',
'Chandan Karfa',
'Tony Jacob',
'Amit Awekar',
'Arijit Sur',
'Arnab Sarkar',
'Aryabartta Sahu',
'Ashish Anand',
'Benny George K',
'Deepanjan Kesh',
'Diganta Goswami',
];
$admin_names=array(
	'admin',
	);

$student_names=[
'Udayraj',	
'ASHUTOSH KUMAR',	
'AYUSH JAIN',	
'AYUSH SINGH',	
'AYUSH SONI',	
'BHAVYA BANSAL',	
'BHOLA SHANKAR RATHIA',	
'BISHWENDRA CHOUDHARY',	
'BOPPANA AKHILESH',	
'CHINMOY JYOTI KATHAR',	
'CHINMOY KACHARI',	
'UDAYRAJ',	
'DHARMESH CHOURASIYA',	
'G SHARATH KUMAR',	
'GOURAV',	];
return [
'teacher_names'=>$teacher_names,
'student_names'=>$student_names,
'admin_names'=>$admin_names,
'store_types'=>[
'stationary','juice','canteen',
],
'store_types_foods'=>[
'stationary'=>['Pen','Pencil','Notebook'],
'juice'=>['Mango Juice','Orange Juice','Chocolate Shake'],
'canteen'=>['Kachori','Samosa'],
],
'types'=>['teacher','student'],
'hostels'=>['KAPILI','KAMENG','SIANG','MANAS','BARAK','UMIAM','DHANSIRI','SUBANSIRI','BRAHMAPUTRA','DIHING'],
'departments'=>['CSE','CST','CL','EE','ECE','EP','ME','MNC','CE'],
'table_fields'=>['id','roll','full_name','department','hostel','ac_no','is_qip','is_daysch'],


];
?>