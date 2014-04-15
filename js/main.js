$(function(){
		lat = null;
		lng = null;
		getPosition();
		$(".eventPos").click(eventLocation);
});


var eventLocation = function()
{
	if( lat == null && lng == null ) {
		alert("impossible de trouver votre position");
		return false;
	}
	var url = $(".eventPos").attr('href')+"/"+lat+"/"+lng;
	document.location.replace(url);
	return false;
}



var getPosition = function()
{
	if(navigator.geolocation)
		navigator.geolocation.getCurrentPosition(function(event){
			lat = event.coords.latitude;
			lng = event.coords.longitude;
	
			return {"lat" : lat ,"lng" :lng}
			/*var url = $(".eventPos").attr('href')+"/"+lat+"/"+lng;
			document.location.replace(url);*/
			//console.log(url);
		});	
	//return null;
}

