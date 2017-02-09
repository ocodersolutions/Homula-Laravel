<?php error_reporting(0); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Easy Installation - Real Estate Made Simple</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="install-style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(function(){
$('#finishintall').click(function(){
	var adminusername=$.trim($('input#adminusername').val());
	var adminpassword=$.trim($('input#adminpassword').val());
	var websitename=$.trim($('input#websitename').val());
	var errorMessage="Please specify: ";
	
	if(adminusername.length<=0) errorMessage=errorMessage+"\nAdmin Username";
	if(adminpassword.length<6) errorMessage=errorMessage+"\nAdmin Password (atleast 6 characters)";
	if(websitename.length<=0) errorMessage=errorMessage+"\nWebsite Name";
	
	if(errorMessage.length>18){
	    alert(errorMessage);
	    return false;
   }else{
		return true;
	   }
});
	
});
</script>
</head>
<body>
<div id='container'>
<h2>Step 2</h2>
<?php
error_reporting(0);

$host=trim($_POST['host']);
$dbname=trim($_POST['dbname']);
$dbusername=trim($_POST['dbusername']);
$dbpassword=trim($_POST['dbpassword']);
$authorizationcode=trim($_POST['authorizationcode']);
$purchasecode=trim($_POST['apurchasecode']);
$errorMessage="";

if(strlen($host)<=0) $errorMessage=$errorMessage."<br />Host";
if(strlen($dbname)<=0) $errorMessage=$errorMessage."<br />MySQL Database Name";
if(strlen($dbusername)<=0) $errorMessage=$errorMessage."<br />MySQL Database Username";



if(strlen($errorMessage)>1){
	print "<p align='center'><b>Please specify:</b><br />$errorMessage<br /><br />
	<a href='javascript:history.go(-1);'><b>Try again</b></a></p>";
}else{
	$con=mysql_connect($host,$dbusername,$dbpassword) or die("Could not connect. Check the values you specified on previous page. <a href='javascript:history.go(-1);'><b>Try again</b></a><br /><br />(".mysql_errno().": ".mysql_error().")");
	mysql_select_db($dbname,$con);
	include("createTables.php");
	$result1 = mysql_query($admin_options);
	$result2 = mysql_query($listing);
	$result3 = mysql_query($member);
	$result4 = mysql_query($language);
	$result5 = mysql_query($pricerange);
	$result6= mysql_query($pages);
    $result7= mysql_query($ipnTable);
    $result8= mysql_query($flagging);
	
	if($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7 && $result8){
		include("createUser.php");
		translate("all_languages",$host,$dbusername,$dbpassword,$dbname);
	}else{
		if(!$result1) print "Couldn't create table: <b>admin_options</b> - ".mysql_error()."<br />";
		if(!$result2) print "Couldn't create table: <b>listing</b> - ".mysql_error()."<br />";
		if(!$result3) print "Couldn't create table: <b>member</b> - ".mysql_error()."<br />";
		if(!$result4) print "Couldn't create table: <b>language</b> - ".mysql_error()."<br />";
		if(!$result5) print "Couldn't create table: <b>pricerange</b> - ".mysql_error()."<br />";
		if(!$result6) print "Couldn't create table: <b>pages</b> - ".mysql_error()."<br />";
	}
	
}


function translate($dir,$host,$dbusername,$dbpassword,$dbname) {
	$i=0;
	$con=mysql_connect($host,$dbusername,$dbpassword) or die("Could not connect. Please try again.");
	mysql_select_db($dbname,$con);
	mysql_query("SET NAMES utf8");

	global $source, $overwriteOnly, $repFile;
	foreach(scandir($dir) as $filename) {
		if ($filename !== '.' AND $filename !== '..' ) {
			
			list($keyword,$extn)=explode(".",$filename);
			$filename=$dir."/".$filename;
			//print "Processing $filename : ";
			$fh = fopen($filename, 'r');
			while(! feof($fh)){
			$language=trim(fgets($fh));
			list($language,$temp1)=explode(":",$language);
			$language=trim($language);
			$keyword=trim($keyword);
			$translation=addslashes(trim(fgets($fh)));
			//print "$language - $translation<br />";
			$qr="insert into languages (keyword,language,translation) values ('$keyword','$language','$translation')";
			$result=mysql_query($qr);

			}
		fclose($fh);

     }
     $i++;
  
		}

	}
?>
</div>
</body>
</html>