$(function(){

	$(".pagination li a").click(changePage);

	$(window).on('popstate', navigateArticle);


  	$(window).load(function(){
	  	$('#masonryContainer').masonry({  
	   	   itemSelector: '.masonry-brick',
	       isFitWidth: true,
	  		});  
	});
});


var changePage = function(){
	var page = $(this).data("page");
	loadArticle(page)
	return false;
}

var loadArticle = function(page){
	var url = App.urls+"Article/viewAll/"+page;


	$.get(url,function(data){
	
	   loadContent(data,page);
	   var obj = { 'content': data };
       var newUrl = '#!' + page;

       if (window.location.hash != newUrl) {
            history.pushState(obj, 'page', newUrl);
        } else {
            history.replaceState(obj, 'page', newUrl);
         }
	});
	return false;
}

var navigateArticle = function()
{
	if(	window.location.hash != "" && window.location.hash != "#!book") {
		console.log('changement de page');
	    // history.state contient l'objet stocké pour l'URL courante

	    var data = history.state.content;
	    var page = window.location.hash.substring(2);

	    loadContent(data,page);
	 }
}

var loadContent = function(data,page)
{
	$("#previousArticle>div").html(data);

	$('#masonryContainer').masonry({  
		 itemSelector: '.masonry-brick',
		 isFitWidth: true,

	});  
	$(".pagination li").not(".arrow").removeClass("current");
	$(".pagination li").not(".arrow").children("a[data-page='"+page+"']").parent().addClass("current");

}