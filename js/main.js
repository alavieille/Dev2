$(function(){
		lat = null;
		lng = null;
		localisation = null;
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
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(event){
			lat = event.coords.latitude;
			lng = event.coords.longitude;

			getLocation(lat,lng);
		});	
	}
}


var getLocation = function(lat,lng)
{
	 url = App.urls+"site/searchPosition/"+lat+"/"+lng;
	 $.getJSON(url,function(data){
	 	if(data.geonames.length > 0) {
	 		$(".userPos").html(data.geonames[0].name);
	 	}
	 	 
	});
}

