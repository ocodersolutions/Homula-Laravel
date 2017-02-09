var xmlhttp;
var styleid;

function favcompareproperty(prid)
{
	$.ajax({
		method: "GET",
		url: "favcompareproperties.php",
		data: {
			prid: prid
			}
	}).done(function(status) {
		if(status == 2)
		{
			alert('You can compare max 2 properties.');
		}
		else if(status==0){
			window.location.href = 'compare.php'
		}else if(status==1){
			alert('Please choose another property');
		}else if(status==4){
			alert('You have already selected this property for compare. Please choose other.');
		}
	});	
}

function delcompareproperty(cid, from)
{
	$.ajax({
		method: "GET",
		url: "delcompareproperties.php",
		data: {
			cid: cid,
			from: from
			}
	}).done(function(status) {
		if(status==0){
			alert("Deleted Successfully");
			var urlpath 			= window.location.pathname;
			var pathArray 			= String(urlpath).split('/');
			var secondLevelLocation = pathArray[1];
			var testurl 			= window.location.protocol+'//'+window.location.host+'/'+secondLevelLocation;
			window.location.href	= testurl;
		}
		else
		{
			alert("Oops..something going wrong. Please try again.");
		}
	});
}

function compareproperty(prid, act, delid)
{
	$.ajax({
		method: "GET",
		url: "compareproperties.php",
		data: {
			prid: prid,
			act: act,
			delid: delid
			}
	}).done(function(status) {
		if(status == 2)
		{
			alert('You can compare max 2 properties.');
		}
		else if(status==0){
			$('#comp'+prid).attr('src', 'images/house-gray.png');
			$('#comp'+prid).removeClass("redcls").addClass("blackcls");
			$('#comp'+prid).attr('onmouseover',"this.src='images/house-blue-bg.png'");
			$('#comp'+prid).attr('onmouseout',"this.src='images/house-gray.png'");
			
			$('#comp2'+prid).attr('src', 'images/house-gray.png');
			$('#comp2'+prid).removeClass("redcls").addClass("blackcls");
			$('#comp2'+prid).attr('onmouseover',"this.src='images/house-blue-bg.png'");
			$('#comp2'+prid).attr('onmouseout',"this.src='images/house-gray.png'");
		}else if(status==1){
			$('#comp'+prid).attr('src', 'images/house-blue-bg.png');
			$('#comp'+prid).removeClass("blackcls").addClass("redcls");
		  	$('#comp'+prid).removeAttr('onmouseover');
			$('#comp'+prid).removeAttr('onmouseout');
			
			$('#comp2'+prid).attr('src', 'images/house-blue-bg.png');
			$('#comp2'+prid).removeClass("blackcls").addClass("redcls");
		  	$('#comp2'+prid).removeAttr('onmouseover');
			$('#comp2'+prid).removeAttr('onmouseout');
		}
	});
}


function deletefavorite(delid)
{
	$.ajax({
		method: "GET",
		url: "deletefavorite.php",
		data: {
			fid: delid
			}
	}).done(function(status) {
		if(status == 0)
		{
			alert("Favorites record deleted successfully.");
			window.location.href = window.location.href;
		}
		else
		{
			alert("Something going to wrong. Please try later.");
		}
	});
}

// Start : Hitesh For Result section direct favorite
function dofavorite(fid)
{
	
	$.ajax({
		method: "GET",
		url: "dofavorite.php",
		data: {
			fid: fid
			}
	}).done(function(status) {
		
		if(status==0){
			$('#heartid'+fid).attr('src', 'images/black-heart.png');
			$('#heartid'+fid).removeClass("redcls").addClass("blackcls");
			$('#heartid'+fid).attr('onmouseover',"this.src='images/hhg.png'");
			$('#heartid'+fid).attr('onmouseout',"this.src='images/black-heart.png'");
			
			$('#heartid2'+fid).attr('src', 'images/black-heart.png');
			$('#heartid2'+fid).removeClass("redcls").addClass("blackcls");
			$('#heartid2'+fid).attr('onmouseover',"this.src='images/hhg.png'");
			$('#heartid2'+fid).attr('onmouseout',"this.src='images/black-heart.png'");
		}else{
			$('#heartid'+fid).attr('src', 'images/hhg.png');
			$('#heartid'+fid).removeClass("blackcls").addClass("redcls");
		  	$('#heartid'+fid).removeAttr('onmouseover');
			$('#heartid'+fid).removeAttr('onmouseout');
			
			$('#heartid2'+fid).attr('src', 'images/hhg.png');
			$('#heartid2'+fid).removeClass("blackcls").addClass("redcls");
		  	$('#heartid2'+fid).removeAttr('onmouseover');
			$('#heartid2'+fid).removeAttr('onmouseout');
		}
	});
	/*
	var url="dofavorite.php";
	url=url+"?fid="+fid+"&funname="+funname;
	xmlhttp.onreadystatechange=stateChanged ;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
	*/
}
// End : Hitesh For Result section direct favorite

function infoResults(str,type,divLoc)
{
	styleid=divLoc;
	//str=escape(str);
	
	if (str.length==0)
	{
		document.getElementById(styleid).innerHTML="";
	  	document.getElementById(styleid).style.border="0px";
	  	return;
	}
	
	xmlhttp=GetXmlHttpObject()
	if (xmlhttp==null)
	{
		alert ("Your browser does not support XML HTTP Request");
	  	return;
	}
	
	//alert(imgStr);
	if(type==5 || type==8 || type==14){
		//document.getElementById(styleid).innerHTML=imgStr2;
		$('#'+styleid).html(imgStr2);
		if(type==8 && $('#favli').length > 0) document.getElementById('favli').style.display = "block";
	
	}else{
		//document.getElementById(styleid).innerHTML=imgStr;
		$('#'+styleid).html(imgStr);
	}
	
	//document.getElementById(styleid).style.border="0px";
	
	var url="infoResults.php";
	url=url+"?q="+str+"&type="+type;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=stateChanged ;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

function stateChanged()
{
	if (xmlhttp.readyState==4)
  	{
  		document.getElementById(styleid).innerHTML=xmlhttp.responseText;
  		//document.getElementById(styleid).style.border="1px solid #A5ACB2";
  	}
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
  	{
  		// code for IE7+, Firefox, Chrome, Opera, Safari
  		return new XMLHttpRequest();
  	}
	if (window.ActiveXObject)
  	{
  		// code for IE6, IE5
  		return new ActiveXObject("Microsoft.XMLHTTP");
  	}
	return null;
}
