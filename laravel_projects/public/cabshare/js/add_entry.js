dir_elem = document.querySelector('#add_form select[name="direction"]');

function toggleform()
{
	$('#add_form').toggle();
}

$(dir_elem).change(function(){
	dir_from = dir_elem[dir_elem.selectedIndex].dataset.from;
	dir_to = dir_elem[dir_elem.selectedIndex].dataset.to;
	if(dir_from=='cam')
	{
		document.getElementById('departure_time_group').style.display = 'block';
		document.getElementById('cab_time_group').style.display = 'block';
		if(dir_to=='air')
			document.querySelector('#departure_time_group label[for="travel_time"]').innerHTML = "Flight departure time";
		else
			document.querySelector('#departure_time_group label[for="travel_time"]').innerHTML = "Train departure time";
	}
	else if(dir_to=='cam')
	{
		document.getElementById('departure_time_group').style.display = 'block';
		document.getElementById('cab_time_group').style.display = 'none';
		document.querySelector('#departure_time_group label[for="travel_time"]').innerHTML = "Arrival/Landing time";
	}
	else
	{
		document.getElementById('departure_time_group').style.display = 'none';
		document.getElementById('cab_time_group').style.display = 'none';
		document.querySelector('#departure_time_group label[for="travel_time"]').innerHTML = "Flight/Train time";
	}
});

document.querySelector('#add_form').onsubmit = function(e){
	e.preventDefault();
	document.querySelector('#messageNotice').style.display = "none";
	document.querySelector('#successNotice').style.display = "none";
	formData = {};
	formData['source'] = dir_elem[dir_elem.selectedIndex].dataset.from;
	formData['destination'] = dir_elem[dir_elem.selectedIndex].dataset.to;
	formData['journey_date'] = document.querySelector('#add_form input[name="journey_date"]').value;
	formData['travel_hour'] = document.querySelector('#add_form input[name="travel_time_hour"]').value;
	formData['travel_min'] = document.querySelector('#add_form input[name="travel_time_min"]').value;
	formData['cab_hour'] = document.querySelector('#add_form input[name="cab_time_hour"]').value;
	formData['cab_min'] = document.querySelector('#add_form input[name="cab_time_min"]').value;
	formData['group_size'] = document.querySelector('#add_form input[name="group_size"]').value;
	// console.log(formData);

	$.post('process/add_entry.php',{
		formData: formData
	},function(data,status){
		data = JSON.parse(data);
		if(data['status']=='success')
		{
			message = 'Your entry has been made';
			$('#successNotice .msg').html(message);			
			$('#successNotice').slideDown("medium");
			window.location.href = "";
		}
		else
		{
			showFormError(data);
		}
	});
}

function showFormError(data)
{
	if(data['message']=='incomplete')
		message = 'All fields are required';
	else if(data['message']=='invalid_input')
	{
		switch(data['invalid'])
		{
			case 'direction': message = 'Seems you gave an invalid travel direction'; break;
			case 'date': message = 'Cannot add your entry for this date'; break;
			case 'time': message = 'Invalid time chosen'; break;
			case 'group_size': message = 'Group size must be 1-9'; break;
			default: message = 'Sorry! This entry cannot be made'; break;
		}
	}
	else if(data['message']=='database')
		message = 'Error occured while making this entry';
	else if(data['message']=='duplicate')
		message = 'You have already made entry for this date';
	else
		message = 'Sorry! This entry cannot be made';
	$('#messageNotice .msg').html(message);	
	$('#messageNotice').slideDown("medium");
}
