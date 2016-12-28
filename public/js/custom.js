$(document).ready(function(){
	// $(".article_thumbnail span, .menu_icon span").click(function() {
	// 	$(this).parent().find("#id_of_the_target_input").val("");
	// });
	// $(".article_thumbnail i, .menu_icon i").hover(function(){
	// 	var src = $(this).parent().find("#id_of_the_target_input").val();
	// 	$(this).attr('data-original-title', "<img src ='"+src+"'/>");
	// 	if(src == "") {	$(this).attr('data-original-title', "Select image");	}
		// $(this).tooltip({
		//     animated: 'fade',
		//     placement: 'bottom',
		//     html: true
		// });
	// });	
});

function ResetValue(id) {
	document.getElementById(id).value = "";
}
function PreviewImage(obj,id) {
	var src = document.getElementById(id).value;
	document.getElementById(obj).setAttribute("data-original-title", "<img src ='"+src+"'/>"); 
	if(src == "") 
	{
		document.getElementById(obj).setAttribute("data-original-title", "Select image"); 
	}
	$("#"+obj).tooltip({
	    animated: 'fade',
	    placement: 'bottom',
	    html: true
	});
}

//Selec image
var urlobj;

function BrowseServer(obj, url)
{
  urlobj = obj;
  OpenServerBrowser(
  url,
  screen.width * 0.7,
  screen.height * 0.7 ) ;
}

function OpenServerBrowser( url, width, height )
{
  var iLeft = (screen.width - width) / 2 ;
  var iTop = (screen.height - height) / 2 ;
  var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
  sOptions += ",width=" + width ;
  sOptions += ",height=" + height ;
  sOptions += ",left=" + iLeft ;
  sOptions += ",top=" + iTop ;
  var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
}

function SetUrl( url, width, height, alt )
{
  document.getElementById(urlobj).value = url ;
  oWindow = null;
}