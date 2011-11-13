function displayBooks(response){
	//only for FF. for explorer include parse
	response=JSON.parse(response);
	
	$("#albumsResponse").empty().append('<div id="albums">');
			
	for(var i in response.albums){
		$("#albums").append(
			'<h3><a href="#">'+response.albums[i].title+'</a></h3>'
			+'<div>sang by '+response.albums[i].artist
			+'<a href="/album/edit/id/'+response.albums[i].id+'">Edit</a>'
        	+'<a href="/album/delete/id/'+response.albums[i].id+'">Delete</a></div>'
		);
	}
	
	$("#albums").append('</div>').accordion({'active':'none','collapsible':'true'});
	
	
	updatePageLinks(response.currentPage);
	
//	for(var i=0; i<response['albums'].length; i++){
//		$("#albums").append('<h3><a href="#">'+response["albums"][i]["title"]+'</a></h3><div>sang by '+response["albums"][i]["artist"]+'</div>');
//	}
}

function updatePageLinks(page){
	$("#cpage").html(page);
	$("#previous").attr('page', page-1);
	$("#next").attr('page', page+1);
}

function getAlbums(){
	
	var full_path=window.location.pathname;
	if(full_path.indexOf('/index')==-1){
		full_path=full_path+'/index';
	}
	var getPath=(full_path.indexOf('/page'))!=-1 ? full_path.indexOf('/page') : full_path.length;
	var url=full_path.substring(0, getPath)+'/page/'+$(this).attr('page');
	$.post(url,
			{'format':'json'},
			function(data){
				displayBooks(data);
			},
			'html'
	);
	return false;
	
}


$(function(){
	$('a#next').click(getAlbums);
	$('a#previous').click(getAlbums);
	$("a#page").each(function(){
		$(this).click(getAlbums);
	});
});
