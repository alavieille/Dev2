$(function(){
		console.log("test");
		$(".eventPos").click(eventLocation);
});


var eventLocation = function()
{
	//console.log("test");
	if(navigator.geolocation)
		navigator.geolocation.getCurrentPosition(function(event){
			lat = event.coords.latitude;
			lng = event.coords.longitude;
			var url = $(".eventPos").attr('href')+"/"+lat+"/"+lng;
			document.location.replace(url);
			console.log(url);
		//	console.log($(".eventPos").attr('href'));
		});	
	return false;
}
