$(function(){

	console.log(urlParam(0));
	$("#pictures .close").click(deletePicture);
});

var deletePicture = function()
{
	console.log($(this).data("link"));
	var picture = $(this);
	$.get($(this).data("link"), function( data ) {
		picture.parent().remove();
	});
	return false;
	
}
