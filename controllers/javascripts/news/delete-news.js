$(document).ready(function()
{
	var id = -1;

	$('a[id^=delete]').live("click", function(e)
	{
		e.preventDefault();
		id = this.id.replace('delete_','');
		$('#modalDelete').modal('show');
	});
	
    $('#modalDelete .accept').live("click", function(e) {

		e.preventDefault();
		
		$.post("./controller.php", 
		{
			id			: id, 
			controller	: "news-delete-news"
		},
		function(data)
		{
			$('#modalDelete').modal('toggle');
			
			if(data['result'] == "ok")
				$('#section_'+id).hide();
			else
				$("#delete_"+id).append(data['result']);
		}, "JSON");
    });
});