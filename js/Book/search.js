$(function(){
	$("#searchBook .button").click(searchBook);
	$("#searchBook").submit(searchBook);
});


var searchBook = function()
{
	var value = $("#searchBook .searchContent").val();
	if( value == "")
        return false;
    var googleAPI = "https://www.googleapis.com/books/v1/volumes?q="+value;
	$.getJSON(googleAPI, function (response) {

    // In console, you can see the response objects
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
	return false;
}