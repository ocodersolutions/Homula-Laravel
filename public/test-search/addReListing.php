<div id='memberArea'>
<?php 
if(!isset($_SESSION["myusername"])) exit;
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
if(function_exists('set_magic_quotes_runtime')) @set_magic_quotes_runtime(0);
if((function_exists('get_magic_quotes_gpc') && @get_magic_quotes_gpc() == 1) || @ini_get('magic_quotes_sybase')) $_POST = remove_magic($_POST);

$reClassification=mysql_real_escape_string($_POST['reClassification']);
$reType=mysql_real_escape_string($_POST['reType']);
$reSubtype=mysql_real_escape_string($_POST['reSubtype']);
$reBedrooms=mysql_real_escape_string($_POST['reBedrooms']);
$reBathrooms=mysql_real_escape_string($_POST['reBathrooms']);
$relistingby=mysql_real_escape_string($_POST['relistingby']);
$resize=mysql_real_escape_string($_POST['resize']);
$reprice=mysql_real_escape_string($_POST['reprice']);
$rebuiltin=mysql_real_escape_string($_POST['rebuiltin']);
$reapt=mysql_real_escape_string($_POST['reapt']);
$readdress=trim(mysql_real_escape_string(strip_tags($_POST['readdress'])));
$recity=trim(mysql_real_escape_string(strip_tags($_POST['recity'])));
$restate=trim(mysql_real_escape_string(strip_tags($_POST['restate'])));
$repostal=trim(mysql_real_escape_string(strip_tags($_POST['repostal'])));
$recountry=trim(mysql_real_escape_string(strip_tags($_POST['recountry'])));
$reheadline=mysql_real_escape_string(strip_tags($_POST['reheadline']));
$redescription=mysql_real_escape_string(strip_tags($_POST['redescription']));
$recat=mysql_real_escape_string($_POST['recat']);
$redog=mysql_real_escape_string($_POST['redog']);
$resmoking=mysql_real_escape_string($_POST['resmoking']);
$rename=mysql_real_escape_string(strip_tags($_POST['rename']));
$rephone=mysql_real_escape_string(strip_tags($_POST['rephone']));
$reemail=mysql_real_escape_string(strip_tags($_POST['reemail']));
$rewebsite=mysql_real_escape_string(strip_tags($_POST['rewebsite']));
$remyaddress=mysql_real_escape_string(strip_tags($_POST['remyaddress']));
$reprofileimage=mysql_real_escape_string($_POST['reprofileimage']);
$latitude=mysql_real_escape_string($_POST['latitude']);
$longitude=mysql_real_escape_string($_POST['longitude']);
$errorMessage="<font size='3'><b>".$relanguage_tags["Please specify"].":</b></font>";
$today_date_time = date("Y-m-d H:i:s");
$listing_expire=mysql_real_escape_string($_POST['listingexpire']);
$prevErrorLen=strlen($errorMessage);
if($rewebsite=="http://" || $rewebsite=="https://") $rewebsite="";
if(strlen($reClassification)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["Classification"];
if(strlen($reType)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["Type"];
if(strlen($reSubtype)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["Style"];
if($reType!="Commercial" && $reSubtype!="Land"){
if(strlen($reBedrooms)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["Bedroom"];
if(strlen($reBathrooms)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["Bathroom"];
}
if(strlen($recity)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["City"];
//if(strlen($restate)<=0) $errorMessage=$errorMessage."<br />".$relanguage_tags["State"];
if($headlinelength > 0 && strlen($reheadline)<=$headlinelength) $errorMessage=$errorMessage."<br />".$relanguage_tags["Headline"]." (".$relanguage_tags["at least"]." $headlinelength ".$relanguage_tags["characters"].")";
if($descriptionlength > 0 && strlen($redescription)<=$descriptionlength) $errorMessage=$errorMessage."<br />".$relanguage_tags["Description"]." (".$relanguage_tags["at least"]." $descriptionlength ".$relanguage_tags["characters"].")";
if(strlen($rename)<=0) $errorMessage=$errorMessage."<br />Your name".$relanguage_tags["Your name"];
if(strlen($reemail)<=0) $errorMessage=$errorMessage."<br />Your email".$relanguage_tags["Your email"];

if(strlen($errorMessage)>$prevErrorLen){
print $errorMessage;
}else{
	
	$fullAddress=$readdress.", ".$recity.", ".$restate.", ".$repostal.",".$recountry;
	$fullAddress2=$recity.", ".$restate.", ".$repostal.",".$recountry;
	$fullAddress3=$restate.", ".$repostal.",".$recountry;
	$fullAddress4=$repostal.",".$recountry;
	if(trim($latitude)=="" || trim($longitude)==""){	
	list($latitude,$longitude)=explode("::",getLonglat($fullAddress));
	//print "$fullAddress: $latitude,$longitude<br />";
	if($latitude==0 || $longitude==0) list($latitude,$longitude)=explode("::",getLonglat($fullAddress2));
	//print "$fullAddress2: $latitude,$longitude<br />";
	if($latitude==0 || $longitude==0) list($latitude,$longitude)=explode("::",getLonglat($fullAddress3));
	//print "$fullAddress3: $latitude,$longitude<br />";
	if($latitude==0 || $longitude==0) list($latitude,$longitude)=explode("::",getLonglat($fullAddress4));
	//print "$fullAddress4: $latitude,$longitude<br />";
	}
	$reheadline=substr($reheadline,0,150);
	//$reheadline=substr($reheadline,0,60);
	$reheadline=breakBigString($reheadline,60);
	if(strtolower($redefaultLanguage)!="japanese" && strtolower($redefaultLanguage)!="chinese simplified") $redescription=breakBigString($redescription,60);
	if($listingreview=="yes" && $memtype!=9) $listing_type=3; else $listing_type=1;
    
    if($reType=="Commercial" || $reSubtype=="Land"){
        $reBedrooms=""; $reBathrooms="";
    }
    
$qr="insert into $reListingTable(user_id,retype,subtype,price,city,state,country,description,contact_name,contact_phone,
contact_email,contact_website,contact_address,show_image,ip,dttm,dttm_modified,address,apt,postal,classification,
headline,cats,dogs,smoking,bedrooms,bathrooms,resize,relistingby,builtin,latitude,longitude,listing_expire,listing_type) 
values('$mem_id','$reType','$reSubtype','$reprice','$recity','$restate','$recountry','$redescription','$rename','$rephone',
'$reemail','$rewebsite','$remyaddress','$reprofileimage','$ip','$today_date_time','$today_date_time','$readdress','$reapt','$repostal','$reClassification',
'$reheadline','$recat','$redog','$resmoking','$reBedrooms','$reBathrooms','$resize','$relistingby','$rebuiltin','$latitude','$longitude','$listing_expire','$listing_type')";
//print $qr."<br />";
mysql_query("SET NAMES utf8");
if($isThisDemo!="yes"){ 
	
$result=mysql_query($qr);
if(!$result) "<h4 align='center'>".$relanguage_tags["Listing could not be added"]." ".$relanguage_tags["Please try again"].".</h4>";
else{
if($listing_type==1) print "<h3 align='center'>".$relanguage_tags["Listing added"].".</h3>";
else print "<h3 align='center'>".__("Listing will be first reviewed by the admin before it goes live").".</h3>";
$reid=mysql_insert_id();
if($notifyadmin=="yes"){
	$full_site_url = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"])."?ptype=viewFullListing&reid=".$reid;
	$msgbody="A new listing has been posted on ".$full_site_url." by $reemail<br /><br />".$relanguage_tags["Listing id"].": $reid<br /><br />- $reSiteName";
	sendReEmail($reemail,$msgbody,$contactformemail,"Admin","Listing posted: ".$reheadline,false);
}
//pingSitemap();
}
}else{
	print "<h3 align='center'>Adding a listing has been disabled in the demo.</h3>";
	
}
?>
<div class='listingButtons2'><?php 
if(trim($ppemail)!="" && $featuredduration>0 && $featuredprice>0 && $row['listing_type']!=2){
	featuredButton($mem_id,$mem_id,$reid); 
?>
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<?php } ?>
</div>
<h4 align='center'><?php print $relanguage_tags["Add images for your listing"]." (".$relanguage_tags["max"]." ".$reMaxPictures. ", <u>".$relanguage_tags["one at a time"]."</u>)</h4>"; ?>
<div class='table-responsive'>
<table align='center' class='table' id='listingImageTable'><tr>
<?php 
$rowcount=0;
for($i=0;$i<$reMaxPictures;$i++){

print "<td>";
getListingImageUploadForm($reid,$i);
print "</td>";
$rowcount++;
if($rowcount==2){
	print "</tr><tr>";
	$rowcount=0;
}
}
?>
</tr></table></div>
<p align='center'>

<input type="button" class='btn btn-large btn-primary' VALUE="<?php print __("Go To My Listings"); ?>" ONCLICK="window.location.href='index.php?ptype=viewMemberListing'">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" class='btn btn-large btn-primary' VALUE="<?php print __("Add Another Listing"); ?>" ONCLICK="window.location.href='index.php?ptype=submitReListing'">

</p>
<?php } ?>
</div>
<?php 



?>