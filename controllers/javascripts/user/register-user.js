$(document).ready(function()
{
	/* Variables */
	var modal			=	$('#modalRegister');	
	var submit			= 	modal.find('#submit');
	var captcha 		= 	modal.find('input[name=iQapTcha]');
	var globalError 	=	modal.find('#error');
	
	/* Form's variables */
	var name			= 	modal.find('#name');
	var email			= 	modal.find('#email');
	var password		= 	modal.find('#password');
	var checkPassword	= 	modal.find('#checkPassword');
	
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
			check();
	});
	
	function check()
	{
		if(name.val() != '' && email.val() != '' && password.val() != '' && checkPassword.val() != '')
		{
			var errors = modal.find('.error');
			
			if(errors.length == 0)
			{			
				submit.html('Checking...').addClass('disabled');
				
				$.post("controller.php",
				{
					name			: 	name.val(),
					email			: 	email.val(),
					password		: 	password.val(),
					checkPassword	: 	checkPassword.val(),
					controller		: 	'user-register-user'
				} ,
				function(data)
				{
					switch(data['error'])
					{
						case 'ok':
							document.location='./';
					  	break;
						default:
							submit.html('Generate').removeClass('disabled');
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
	
	/* Name */
	name.blur(function()
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
				avaibleByName(data, 'user', function(avaible)
				{
					if(avaible)
						self.parent().parent().addClass('success');
					else
					{
						var error = '<span class="help-inline">This user already exist !</span>';
						self.parent().parent().addClass('error');
						self.parent().append(error);
					}
				});
			}
			else
			{
				var error = '<span class="help-inline">Alphanumeric !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(error);
			}
		}
	});
	
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
				var error = '<span class="help-inline">Your mail is not correct !</span>';
				self.parent().parent().addClass('error');
				self.parent().append(error);
			}
		}
	});
	
	/* Password */
	password.blur(function()
	{
		var data = $(this).val();
		$(this).parent().parent().removeClass('error');
		$(this).parent().parent().removeClass('success');
		$(this).parent().find('span').remove();
		
		if(data != '')
		{
			if(!passwordFormat(data))
			{
				var error = '<span class="help-inline">Password between 4 and 32 characters !</span>';
				$(this).parent().parent().addClass('error');
				$(this).parent().append(error);
			}
			else
			{
				$(this).parent().parent().addClass('success');
			}
		}		
	});
	
	/* Check password */
	checkPassword.blur(function()
	{
		var data = $(this).val();
		$(this).parent().parent().removeClass('error');
		$(this).parent().parent().removeClass('success');
		$(this).parent().find('span').remove();
		
		if(data != '')
		{
			if(data != password.val())
			{
				var error = '<span class="help-inline">Password don\'t match !</span>';
				$(this).parent().parent().addClass('error');
				$(this).parent().append(error);
			}
			else
			{
				$(this).parent().parent().addClass('success');
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