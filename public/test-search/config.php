<?php
/*
*     Author: Ravinder Mann
*     Email: ravi@codiator.com
*     Website: http://www.codiator.com
*     Release: 1.6.*
*
* Please direct bug reports,suggestions or feedback to :
* http://www.codiator.com/contact/
*
* Real estate made easy is a commercial software. Any distribution is strictly prohibited.
*
*/
include_once("errorReporting.inc.php");
session_start();

include("site.inc.php");
include_once("plugin_handler.inc.php"); 
include_once "plugins.php";

if($host=="" || $database=="" || $username=="") header('Location: install/index.php');
$reListingTable="treb";
//$reListingTable="listing";
$rememberTable="member";
$adminOptionTable="admin_options";
$languageTable="languages";
$priceTable="pricerange";
$pageTable="pages";
$reMaxPictures=15;
$isThisDemo="no"; 
$version_num="Version: 1.6.4";
$changelog="https://www.finethemes.com/changelog/index.php?id=8&";

$SMTPAuth=true;

/* Follow us links */
$googleFollow="";
$twitterFollow="";
$facebookFollow="";
/* Follow us links ends */

/*
 * $defaultCityZoom This is the zoom level of the visitor city and it is used when visitor first visits the website and geoIP is enabled in the admin options. 
 * $defaultCountryZoom is the zoom level of the default country if there's not a single listing and map loads the default country set in admin options.
 * In all other cases the script automatically sets the zoom level as per the number of markers found in a given area.
 */
 
$defaultCityZoom=11;
$defaultCountryZoom=4;

include_once("siteSettings.php");
$readmin_settings=setOptionValues($host,$database,$username,$password,$adminOptionTable);

if(trim($readmin_settings["fullscreenenabled"]=="true")) $fullScreenEnabled="true"; else $fullScreenEnabled="false";
$enableRegisterCaptcha = $readmin_settings["enableregistercaptcha"] ? true : false;
$disableregistration = $readmin_settings["disableregistration"] ? true : false;
$_SESSION['rtl']=$rtl = $readmin_settings["rtl"] ? true : false;
if(isset($_GET['rtl']) && $_GET['rtl']==1)$_SESSION['rtl']=$rtl=true;
$google_login = $readmin_settings["google_login"] ? true : false;
$yahoo_login = $readmin_settings["yahoo_login"] ? true : false;
$currency_before_price = $readmin_settings["currency_before_price"] ? true : false;

$webtheme=trim($readmin_settings['webtheme']);
if(isset($_GET['theme'])) $_SESSION['theme']=$_GET['theme'];
if(isset($_SESSION['theme']))$webtheme=trim($_SESSION['theme']);
$fieldtheme=trim($readmin_settings['fieldtheme']);
$fixedtopheader=$readmin_settings['fixedtopheader'];
$notifyadmin=$readmin_settings['notifyadmin'];
$listingemail=$readmin_settings['listingemail'];
$listingreview=$readmin_settings['listingreview'];
$defaultCurrency=trim($readmin_settings['defaultcurrency']);
$redefaultCountry=trim($readmin_settings['defaultcountry']);
$defaultcountry_latlng=trim($readmin_settings['defaultcountry_latlng']);
$redefaultLanguage=trim($readmin_settings['defaultlanguage']);
$refriendlyurl=trim($readmin_settings['refriendlyurl']);
$mortgagecalculator=trim($readmin_settings['mortgagecalculator']);
$emaildebug=trim($readmin_settings['emaildebug']);
if($redefaultLanguage=="")$redefaultLanguage="English";
if(!isset($_SESSION["re_language"]) || !isset($_SESSION["custom_lang"])){
	$_SESSION["custom_lang"]=$redefaultLanguage;
	$relanguage_tags=setLanguageValues($host,$database,$username,$password,$languageTable,$redefaultLanguage);
}
else $relanguage_tags=$_SESSION["re_language"];
$ppcurrency=trim($readmin_settings['ppcurrency']);
$ppemail=trim($readmin_settings['ppemail']);
$featuredduration=trim($readmin_settings['featuredduration']);
$featuredprice=trim($readmin_settings['featuredprice']);
$geoipenable=trim($readmin_settings['geoipenable']);
$resmtp=trim($readmin_settings['resmtp']);
$resmtpport=trim($readmin_settings['resmtpport']);
$gmailUsername=trim($readmin_settings['smtpusername']);
$gmailPassword=trim($readmin_settings['smtppassword']);
$reSiteName=trim($readmin_settings['websitetitle']);
$reSiteFooter=trim($readmin_settings['websitefooter']);
$WordPressAPIKey = trim($readmin_settings['wordpressapikey']);
$reCaptchaPrivateKey = trim($readmin_settings['recaptchaprivatekey']);
$reCaptchaPublicKey =trim($readmin_settings['recaptchapublickey']);
$googleMapAPIKey=trim($readmin_settings['googlemapapikey']);
//$browsertitle=trim($readmin_settings['browsertitle']);
$browsertitle = 'Real estate search';
$tagline=trim($readmin_settings['tagline']);
$homepagedescription=trim($readmin_settings['homepagedescription']);
$homepagekeywords=trim($readmin_settings['homepagekeywords']);
$toplinkad=trim($readmin_settings['toplinkad']);
$sidebarad=trim($readmin_settings['sidebarad']);
$contactaddress=trim($readmin_settings['contactaddress']);
$contactformemail=trim($readmin_settings['contactformemail']);
$headlinelength=trim($readmin_settings['headlinelength']);
$descriptionlength=trim($readmin_settings['descriptionlength']);
$delete_after_days=trim($readmin_settings['delete_after_days']);
$fb_app_id=trim($readmin_settings['fb_app_id']);
$fb_app_secret=trim($readmin_settings['fb_app_secret']);
$gclientid=trim($readmin_settings['gclientid']);
$gclientsecret=trim($readmin_settings['gclientsecret']);

if(isset($_SESSION["readmin_settings"]['authorization_code']) && isset($_SESSION["readmin_settings"]['purchase_code'])){
$authorization_code=trim($_SESSION["readmin_settings"]['authorization_code']);
$purchase_code=trim($_SESSION["readmin_settings"]['purchase_code']);
}else{
setAuth();
$authorization_code=trim($_SESSION["readmin_settings"]['authorization_code']);
$purchase_code=trim($_SESSION["readmin_settings"]['purchase_code']);    
}

// Start : path for site added by Hitesh
$SitePath	= 'http://realestate.homula.com/treb';
$RedirectMainPath	= 'http://realestate.homula.com/test-search';
// End : path for site added by Hitesh
$gmailUsername = 'homularealestate@gmail.com';
$gmailPassword = 'Iran1234';
$resmtp = 'smtp.gmail.com';
$resmtpport = 465;
//echo $gmailUsername."==".$gmailPassword."==".$resmtp."==".$resmtpport; exit;

?>