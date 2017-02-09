function toggleRow(id)
{
imgid='img'+id;
childid='child-row'+id;
parentid='parent-row'+id;

$('#'+childid).toggle();

//document.getElementById(id).style.display="";


if( $('#'+childid).is(":visible") ) {
	$('#'+imgid).attr("src","images/minus.png");
	if($('#'+parentid).hasClass('featuredClass')==false && $('#'+parentid).hasClass('inavtiveClass') == false){
	$('#'+parentid).css('background-color', $('.table-hover > tbody > tr:hover > td').css('background-color'));
	}
	}
	else {
	// element is not visible
	$('#'+imgid).attr("src","images/plus.png");
	if($('#'+parentid).hasClass('featuredClass')==false && $('#'+parentid).hasClass('inavtiveClass') == false){
	$('#'+parentid).css('background-color', $('.table-striped > tbody > tr:nth-child(2n+1) > td').css('background-color'));
	$('#'+parentid).css('font-weight', 'normal');
	}
	}

}

