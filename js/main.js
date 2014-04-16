$(function(){
		lat = null;
		lng = null;
		localisation = null;
		getPosition();

		$(".eventPos").click(eventLocation);
		$("#searchBookPos").click(searchBookPos);
});


var searchBookPos = function()
{	
	console.log("searchBook");
	if( lat == null && lng == null && localisation == null) {
		alert("impossible de trouver votre position");
		return false;
	}
	else {
		$.getJSON(url,function(data){
                  
                 var googleAPI = "https://www.googleapis.com/books/v1/volumes?q="+localisation;
            
                 $.getJSON(googleAPI, function (response) {
                 	var res = '<div  id="titleRow"><div class="row"><h1 class="columns large-12"> Recherche Google Books </h1></div></div>';
          			res += '<div class="row"><div class="large-12 columns"><div class="panel">	<h4>Résultats</h4><div class="res">'
          			res += "<ul>";
                    $.each(response.items,function(index,item){
                    
                        res += "<li>";
                        console.log(item.volumeInfo);
                        res += "<h4>"+item.volumeInfo.title+"</h4>";
                        if( typeof item.volumeInfo.publisher != 'undefined')
                           res += "<p>"+item.volumeInfo.publisher.toLowerCase()+"</p>";        

                       if( typeof item.volumeInfo.description != 'undefined')
                           res += "<p>"+item.volumeInfo.description+"</p>";
                        res += "<a target='_blank' class='button tiny' href='"+item.volumeInfo.infoLink+"'>Voir le livre</a>";
                        res += "</li>";
                    });
                    res += "</ul>";
                    res += "</div></div></div></div>";
                    $("#content").html(res);

                    history.pushState(null, 'book', "#!book");
	
                 });
          
        });
	}
	return false;
}



/***
* Recherche evenement selon position 
***/
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


/**
* recherche latitude longitude 
**/
var getPosition = function()
{
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(event){
			lat = event.coords.latitude;
			lng = event.coords.longitude;
			geolocationGoogle(lat,lng);
			
			if(	window.location.hash == "#!book") {

				searchBookPos();
		 	}
		});	
	}
}


/**
* Reverse geocoding geocoding google
**/
var geolocationGoogle = function (lat,lng)
{
	url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+lng+"&sensor=false";
	$.getJSON(url,function(data){
		if(data.results.length > 0) {
			$.each(data.results[0].address_components,function(key,value)
			{
				if(value.types.indexOf("locality") >= 0){
					localisation = value.short_name;
					$(".userPos").html(value.short_name);
				}
			});
		}
			
	});
}

/**
* Reverse geocoding geoname
**/
var getLocationGeoname = function(lat,lng)
{
	 url = App.urls+"site/searchPosition/"+lat+"/"+lng;
	 $.getJSON(url,function(data){
	 	if(data.geonames.length > 0) {
	 		localisation = data.geonames[0].name;
	 		$(".userPos").html(data.geonames[0].name);
	 	}
	 	 
	});
}

