$(document).ready(function()
{
	/* Variables */
	var modal			=	$('#modalRegister');	
	var submit			= 	modal.find('#submit');
	var captcha 		= 	modal.find('input[name=iQapTcha]');
	var globalError 	=	modal.find('#error');
	
	/* Form's variables */
	var email			= 	modal.find('#email');
	
	/* Detecting Enter key */
	modal.keypress(function(e)
	{
		if(e.which == 13)
		{
			check();
		}
	});
	
	/* Checking form */
	submit.click(function(e)
	{
		e.preventDefault();
		
		// Checking qaptcha
		if($(this).attr('class') == 'btn btn-primary')
			validation();
	});
	
	function check()
	{
		if(email.val() != '')
		{
			var errors = modal.find('.error');
			
			if(errors.length == 0)
			{			
				submit.html('Checking...').addClass('disabled');
				
				$.post("controller.php",
				{
					email			: 	email.val(),
					controller		: 	'user-reset-password'
				} ,
				function(data)
				{
					switch(data['error'])
					{
						case 'ok':
							document.location='./';
					  	break;
						default:
							submit.html('Reset').removeClass('disabled');
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
			globalErreur.slideDown();
			globalErreur.find('span').html('Thanks to fill all fields !');
		}
	}
	
	/* Email */
	email.change(function()
	{
		var self = $(this);
		var data = self.val();
		self.parent().parent().removeClass('error');
		self.parent().parent().removeClass('success');
		self.parent().find('span').remove();
		
		if(data != '')
		{
			if(mailFormat(data))
			{
				avaibleByMail(data, function(avaible)
				{
					if(avaible)
						self.parent().parent().addClass('success');
					else
					{
						var erreur = '<span class="help-inline">This mail already exist !</span>';
						self.parent().parent().addClass('error');
						self.parent().append(error);
					}
				});
			}
			else
			{
				var erreur = '<span class="help-inline">Your mail is not correct !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(error);
			}
		}
	});
});