var urlParam = function(index){
	console.log(window.location.href);
    var results = new RegExp('[\\?&amp;]').exec(window.location.href);
    pathname = window.location.pathname.split('/');
	param = pathname.slice(5);
	return param[index];

   // return results[1] || 0;
}



