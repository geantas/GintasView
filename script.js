$(document).ready(function(){
	
	$('#download').click(function(e){

		$.generateFile({

			filename	: new Date().getFullYear() + "-" + (new Date().getMonth()+1) + "-" + new Date().getDate() + "_" + new Date().getHours() + "_" + new Date().getMinutes() + '.txt',
			content		: $('#output').val(),
			script		: 'download.php'
		});
		
		e.preventDefault();
	});
	

});
