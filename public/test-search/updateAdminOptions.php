<?php
if($memtype==9){ 
include_once("functions.inc.php");
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
if(function_exists('set_magic_quotes_runtime')) @set_magic_quotes_runtime(0);
if((function_exists('get_magic_quotes_gpc') && @get_magic_quotes_gpc() == 1) || @ini_get('magic_quotes_sybase')) $_POST = remove_magic($_POST);

if($ptype=="UpdateAdminOptions"){
$siteoutercolor=mysql_real_escape_string($_POST['siteoutercolor']);
$siteheadercolor=mysql_real_escape_string($_POST['siteheadercolor']);
$siteheaderfontcolor=mysql_real_escape_string($_POST['siteheaderfontcolor']);
$siteinnercolor=mysql_real_escape_string($_POST['siteinnercolor']);
$sitebordercolor=mysql_real_escape_string($_POST['sitebordercolor']);
$sitefooterfontcolor=mysql_real_escape_string($_POST['sitefooterfontcolor']);
$fixedtopheader=mysql_real_escape_string($_POST['fixedtopheader']);

$searchformcolor=mysql_real_escape_string($_POST['searchformcolor']);
$searchformbordercolor=mysql_real_escape_string($_POST['searchformbordercolor']);
$searchformfontcolor=mysql_real_escape_string($_POST['searchformfontcolor']);
$webtheme=mysql_real_escape_string($_POST['webtheme']);
$fieldtheme=mysql_real_escape_string($_POST['fieldtheme']);
$menuboxcolor=mysql_real_escape_string($_POST['menuboxcolor']);
$menuboxfontcolor=mysql_real_escape_string($_POST['menuboxfontcolor']);

$menuboxbordercolor=mysql_real_escape_string($_POST['menuboxbordercolor']);
$websitetitle=mysql_real_escape_string($_POST['websitetitle']);
$logoname = $_FILES['photoimg']['name'];
$removewebsitelogo=mysql_real_escape_string($_POST['removewebsitelogo']);
$websitefooter=mysql_real_escape_string($_POST['websitefooter']);
$defaultcountry=mysql_real_escape_string($_POST['defaultcountry']);
$defaultcurrency=mysql_real_escape_string($_POST['defaultcurrency']);
$defaultlanguage=mysql_real_escape_string($_POST['defaultlanguage']);
$refriendlyurl=mysql_real_escape_string($_POST['refriendlyurl']);
$geoipenable=mysql_real_escape_string($_POST['geoipenable']);
$emaildebug=mysql_real_escape_string($_POST['emaildebug']);

$ppcurrency=mysql_real_escape_string($_POST['ppcurrency']);
$ppemail=mysql_real_escape_string($_POST['ppemail']);
$featuredduration=mysql_real_escape_string($_POST['featuredduration']);
$featuredprice=mysql_real_escape_string($_POST['featuredprice']);
$notifyadmin=mysql_real_escape_string($_POST['notifyadmin']);
$listingreview=mysql_real_escape_string($_POST['listingreview']);
$listingemail=mysql_real_escape_string($_POST['listingemail']);
$headlinelength=mysql_real_escape_string($_POST['headlinelength']);
$descriptionlength=mysql_real_escape_string($_POST['descriptionlength']);

$smtpauth=mysql_real_escape_string($_POST['smtpauth']);
$resmtp=mysql_real_escape_string($_POST['resmtp']);
$resmtpport=mysql_real_escape_string($_POST['resmtpport']);
$smtpusername=mysql_real_escape_string($_POST['smtpusername']);
$smtppassword=mysql_real_escape_string($_POST['smtppassword']);
if(trim($smtppassword)==".......") $smtpPasswordClause="";
else $smtpPasswordClause=",smtppassword='$smtppassword'";
$googlemapapikey=mysql_real_escape_string($_POST['googlemapapikey']);
$recaptchaprivatekey=mysql_real_escape_string($_POST['recaptchaprivatekey']);
$recaptchapublickey=mysql_real_escape_string($_POST['recaptchapublickey']);
$wordpressapikey=mysql_real_escape_string($_POST['wordpressapikey']);
$splashpage=mysql_real_escape_string($_POST['splashpage']);
$mortgagecalculator=mysql_real_escape_string($_POST['mortgagecalculator']);

$fullscreenenabled=mysql_real_escape_string($_POST['fullscreenenabled']);
$enableregistercaptcha=mysql_real_escape_string($_POST['enableregistercaptcha']);
$disableregistration=mysql_real_escape_string($_POST['disableregistration']);
$rtl=mysql_real_escape_string($_POST['rtl']);
$googlelogin=mysql_real_escape_string($_POST['googlelogin']);
$yahoologin=mysql_real_escape_string($_POST['yahoologin']);
$currencybeforeprice=mysql_real_escape_string($_POST['currencybeforeprice']);
if($enableregistercaptcha=="") $enableregistercaptcha=0;
if($disableregistration=="") $disableregistration=0;
if($rtl=="") $rtl=0;
if($googlelogin=="") $googlelogin=0;
if($yahoologin=="") $yahoologin=0;
if($currencybeforeprice=="") $currencybeforeprice=0;

$browsertitle=mysql_real_escape_string($_POST['browsertitle']);
$tagline=mysql_real_escape_string($_POST['tagline']);
$homepagedescription=mysql_real_escape_string($_POST['homepagedescription']);
$homepagekeywords=mysql_real_escape_string($_POST['homepagekeywords']);

$toplinkad=mysql_real_escape_string($_POST['toplinkad']);
$sidebarad=mysql_real_escape_string($_POST['sidebarad']);

$jsonurl=mysql_real_escape_string($_POST['jsonurl']);
$jsontexturl=mysql_real_escape_string($_POST['jsontexturl']);
$markerjsonurl=mysql_real_escape_string($_POST['markerjsonurl']);
$listingjsonurl=mysql_real_escape_string($_POST['listingjsonurl']);

$topmenubackgroundcolor=mysql_real_escape_string($_POST['topmenubackgroundcolor']);
$topmenubordercolor=mysql_real_escape_string($_POST['topmenubordercolor']);
$topmenufontcolor=mysql_real_escape_string($_POST['topmenufontcolor']);

$contactaddress=mysql_real_escape_string($_POST['contactaddress']);
$contactformemail=mysql_real_escape_string($_POST['contactformemail']);

$gclientid=mysql_real_escape_string(trim($_POST['gclientid']));
$gclientsecret=mysql_real_escape_string(trim($_POST['gclientsecret']));

if($redefaultCountry!=$defaultcountry && trim($defaultcountry)!="") $defaultcountry_latlng=getLonglat($defaultcountry);

$delete_after_days=mysql_real_escape_string($_POST['delete_after_days']);
$fb_app_id=mysql_real_escape_string($_POST['fbappid']);
$fb_app_secret=mysql_real_escape_string($_POST['fbappsecret']);

if(trim($fb_app_id)=="##########") $fb_appClause="";
else $fb_appClause=",fb_app_id='$fb_app_id'";

if(trim($fb_app_secret)=="##########") $fb_app_secretClause="";
else $fb_app_secretClause=",fb_app_secret='$fb_app_secret'";
 
if(trim($logoname)!=""){
	$websitelogo=uploadImage($mem_id);
	$websitelogoClause=", websitelogo='$websitelogo' ";
}else{
	if($removewebsitelogo=="yes") $websitelogoClause=", websitelogo='' ";
}

$qr="update $adminOptionTable set siteoutercolor='$siteoutercolor',siteheadercolor='$siteheadercolor',siteheaderfontcolor='$siteheaderfontcolor',fixedtopheader='$fixedtopheader',
siteinnercolor='$siteinnercolor',sitebordercolor='$sitebordercolor',sitefooterfontcolor='$sitefooterfontcolor',searchformcolor='$searchformcolor',searchformbordercolor='$searchformbordercolor',
searchformfontcolor='$searchformfontcolor',menuboxcolor='$menuboxcolor',menuboxfontcolor='$menuboxfontcolor',menuboxbordercolor='$menuboxbordercolor',notifyadmin='$notifyadmin',listingemail='$listingemail',
websitetitle='$websitetitle',websitefooter='$websitefooter',defaultcountry='$defaultcountry',defaultcurrency='$defaultcurrency',defaultlanguage='$defaultlanguage',smtpauth='$smtpauth',resmtp='$resmtp',resmtpport='$resmtpport',
smtpusername='$smtpusername' $smtpPasswordClause,googlemapapikey='$googlemapapikey',recaptchaprivatekey='$recaptchaprivatekey',recaptchapublickey='$recaptchapublickey' $fb_appClause $fb_app_secretClause,
wordpressapikey='$wordpressapikey',browsertitle='$browsertitle',refriendlyurl='$refriendlyurl',geoipenable='$geoipenable',emaildebug='$emaildebug',homepagedescription='$homepagedescription',homepagekeywords='$homepagekeywords', headlinelength='$headlinelength',descriptionlength='$descriptionlength',
toplinkad='$toplinkad',ppcurrency='$ppcurrency',ppemail='$ppemail',featuredduration='$featuredduration',featuredprice='$featuredprice',sidebarad='$sidebarad',topmenubackgroundcolor='$topmenubackgroundcolor',topmenubordercolor='$topmenubordercolor',
topmenufontcolor='$topmenufontcolor',webtheme='$webtheme', listingreview='$listingreview',fieldtheme='$fieldtheme',contactaddress='$contactaddress',contactformemail='$contactformemail',defaultcountry_latlng='$defaultcountry_latlng',jsonurl='$jsonurl',jsontexturl='$jsontexturl',fullscreenenabled='$fullscreenenabled',enableregistercaptcha='$enableregistercaptcha',rtl='$rtl',google_login='$googlelogin',yahoo_login='$yahoologin',currency_before_price='$currencybeforeprice',markerjsonurl='$markerjsonurl',listingjsonurl='$listingjsonurl', delete_after_days='$delete_after_days',gclientid='$gclientid', gclientsecret='$gclientsecret', tagline='$tagline', splashpage='$splashpage', mortgagecalculator='$mortgagecalculator', disableregistration='$disableregistration' $websitelogoClause ;";

if($isThisDemo!="yes") $result=mysql_query($qr);
if($result) print "<p align='center' class='info_success'>Admin options updated.</p>";
else print "<p align='center' class='info_error'>Admin options couldn't be updated. Please try again</p>".mysql_errno()." - ".mysql_error();
}

$qr1="select * from $adminOptionTable";
$result1=mysql_query($qr1);
$adminOptions=mysql_fetch_assoc($result1);
$_SESSION["readmin_settings"]=$adminOptions;
$_SESSION["recustom_settings"]=1;
if($defaultlanguage!="" && $defaultlanguage!=$redefaultLanguage) $redefaultLanguage=$_SESSION["custom_lang"]=$defaultlanguage;

$adminQr="select * from $languageTable where language='$redefaultLanguage'";
$adminResult=mysql_query($adminQr);
while($langOptions=mysql_fetch_assoc($adminResult)){
	$languageTags[$langOptions['keyword']]=$langOptions['translation'];
}
$_SESSION["re_language"]=$languageTags;

}
?>