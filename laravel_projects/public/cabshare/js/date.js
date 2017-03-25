$('.result-group .direction_tab').click(function(){
	$('.direction_res',$(this).parent()).slideToggle();
});

function delete_entry()
{
	if(confirm('Are you sure you want to delete this entry?')==true)
	{
		$.post('process/delete_entry.php',{
			journey_date: formatted_date
		},function(data,status){
			data = JSON.parse(data);
			if(data['status']=='success')
			{
				window.location.href = "";
			}
			else
			{
				alert('Sorry! Your entry could not be deleted');
			}
		});
	}
}

function showContact(name,webmail,phone,fb,residence)
{
	$('#contactModal .modalName').html(name);
	$('#contactModal .modalWebmail').html(webmail);
	if(phone==undefined||phone==""||phone==0)
		phone = "N/A";
	$('#contactModal .modalPhone').html(phone);
	if(fb==undefined||fb=="")
		$('#contactModal .modalFB').html('N/A');
	else
		$('#contactModal .modalFB').html('<a target="_blank" href="'+fb+'">'+fb+'</a>');
	if(residence==undefined||residence=="")
		residence = "N/A";
	$('#contactModal .modalResidence').html(residence);

	$('#contactModal').modal('toggle');	
}
