$('.block-radio').click(function(){
	if(!$(this).hasClass('checked'))
	{
		var current_category = $(this).attr('data-category');
		$('.block-radio').each(function(){
			if($(this).attr('data-category')==current_category)
				$(this).removeClass('checked');
		});
	}
	$(this).toggleClass('checked');
});