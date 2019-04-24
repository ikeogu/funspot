$(document).ready(function(){
	$('#videoElementID').bind('contextmenu',function() { return false; });
});

$('.like').on('click', function(event){
		console.log(event)
	});