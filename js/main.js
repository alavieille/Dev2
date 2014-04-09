$(function(){
		console.log("test");
		$(".eventPos").click(eventLocation);
});


var eventLocation = function()
{
	if(navigator.geolocation)
		navigator.geolocation.getCurrentPosition(function(event){
			lat = event.coords.latitude;
			lng = event.coords.longitude;
			var url = $(".eventPos").attr('href')+"/"+lat+"/"+lng;
			document.location.replace(url);
			console.log(url);
		});	
	return false;
}
