$(document).ready(function()
{
	/* Variables */
	var modal			=	$('#modalAddNews');	
	var submit			= 	modal.find('#submit');
	var captcha 		= 	modal.find('input[name=iQapTcha]');
	var globalError 	=	modal.find('#error');
	
	/* Form's variables */
	var title			= 	modal.find('#title');
	var content			= 	modal.find('#content');
	var tags			= 	modal.find('#tags');
	var type			= 	modal.find('#type');
	var cover			= 	modal.find('#cover');
	var demoLink		= 	modal.find('#demoLink');
	var source			= 	modal.find('#source');
	
	/* Checking form */
	submit.click(function(e)
	{
		e.preventDefault();
		
		// Checking qaptcha
		if($(this).attr('class') == 'btn btn-primary')
			check();
	});
	
	function check()
	{
		if(title.val() != '' && content.val() != '' && tags.val() != '' && type.val() != '' && cover.val() != '')
		{
			var errors = modal.find('.error');
			
			if(errors.length == 0)
			{			
				submit.html('Checking...').addClass('disabled');
				
				$.post("controller.php",
				{
					title			: 	title.val(),
					content			: 	content.val(),
					tags			: 	tags.val(),
					type			: 	type.select2("val"),
					cover			: 	cover.val(),
					demoLink		: 	demoLink.val(),
					source			: 	source.val(),
					controller		: 	'news-add-news'
				} ,
				function(data)
				{
					switch(data['error'])
					{
						case 'ok':
							document.location='./';
					  	break;
						default:
							submit.html('Add').removeClass('disabled');
							errorMessage = 'Error : ' + data['error'];
							globalError.slideDown();
							globalError.find('span').html(errorMessage);
						break;
					}
				}, "JSON");
			}
		}
		else
		{
			globalError.slideDown();
			globalError.find('span').html('Thanks to fill all fields !');
		}
	}
	
	/* Title */
	title.blur(function()
	{
		var self = $(this);
		var data = self.val();
		self.parent().parent().removeClass('error');
		self.parent().parent().removeClass('success');
		self.parent().find('span').remove();
		
		if(data != '')
		{
			if(alphaNum(data))
			{
				self.parent().parent().addClass('success');
			}
			else
			{
				var error = '<span class="help-inline">Alphanumeric !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(error);
			}
		}
	});
	
	/* Tags */
	tags.blur(function()
	{
		var self = $(this);
		var data = self.val();
		self.parent().parent().removeClass('error');
		self.parent().parent().removeClass('success');
		self.parent().find('span').remove();
		
		if(data != '')
		{
			if(alphaNum(data))
			{
				self.parent().parent().addClass('success');
			}
			else
			{
				var error = '<span class="help-inline">Alphanumeric !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(error);
			}
		}	
	});
	
	/* Demonstration link */
	demoLink.change(function()
	{
		var self = $(this);
		var data = self.val();
		self.parent().parent().removeClass('error');
		self.parent().parent().removeClass('success');
		self.parent().find('span').remove();
		
		if(data != '')
		{
			if(webSiteFormat(data))
			{
				self.parent().parent().addClass('success');
			}
			else
			{
				var erreur = '<span class="help-inline">Your URL site is not correct !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(erreur);
			}
		}
	});
	
	/* Detect locking captcha */
	$('.QapTcha').mousemove(function()
	{
		if(captcha.val() == '' || captcha.length == 0)
			submit.removeClass('disabled');
	});
});