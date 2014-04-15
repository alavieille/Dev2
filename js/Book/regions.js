$(function(){
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(event){
            lat = event.coords.latitude;
            lng = event.coords.longitude;


         url = App.urls+"site/searchPosition/"+lat+"/"+lng;
         $.getJSON(url,function(data){
            if(data.geonames.length <= 0) {
                $(".res p").html("Aucun résultat");
             }
                 var googleAPI = "https://www.googleapis.com/books/v1/volumes?q="+data.geonames[0].name;
                 console.log(googleAPI);
                 $.getJSON(googleAPI, function (response) {
                    var res = "<ul>";
                    $.each(response.items,function(index,item){
                        console.log(item);
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
                    $(".res").html(res);
                 });
          
        });
      }); 
    }
    else {
        $(".res p").html("Impossible de trouver votre position");
    }
});



