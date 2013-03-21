$(document).ready(function()
{
	var index 	= 	2;
	var nbNews 	= 	1;
	
	$(window).scroll(function()
	{
		// If user is at the window's bottom
        if  ($(window).scrollTop() == $(document).height() - $(window).height())
        {        	
        	// We load another news in the timeline
        	$.post("controller.php",
			{
				index			:	index,
				nbNews			:	nbNews,
				controller		: 	'news-load-news'
			} ,
			function(data)
			{
				switch(data['error'])
				{
					case 'ok':
						
						$.each(data['arrayNews'], function(index, news)
						{						
							$("#pageContent").append(news);
						});
						
						$.each(data['arrayId'], function(index, id)
						{
							$("#section_"+id).show().css({"opacity":"0","margin-top":"500px"}).animate({"opacity":"1","margin-top":"0"}, 1000);
						})
						
						index = index + nbNews;
				  	break;
					default:
						// Error
					break;
				}
			}, "JSON");
        }
	});
	
});