$(function(){
	console.log(App.urls);
	//console.log(window.location.href);
	console.log(urlParam(0));
		$("#addImage").click(showFormAddImage);
})


var showFormAddImage = function()
{

	$('#myModal').foundation('reveal', 'open', {
    url: 'http://some-url',
    data: {param1: 'value1', param2: 'value2'}
});
	$.get( App.urls+"Image/create/"+urlParam(0), function( data ) {
		var res = '<div id="myModal" class="reveal-modal" data-reveal>'+data+'<a class="close-reveal-modal">&#215;</a></div>';
		$('body').append(res);
		$('#myModal').foundation('reveal', 'open');
	});
	return false;
}