<?php
/*
*     Author: Ravinder Mann
*     Email: ravi@codiator.com
*     Web: http://www.codiator.com
*     Release: 1.6.*
*
* Please direct bug reports,suggestions or feedback to :
* http://www.codiator.com/contact/
*
* Real estate made easy is a commercial software. Any distribution is strictly prohibited.
*
*/ 

unset($_SESSION);
include("config.php"); 
include_once("functions.inc.php"); 
if($redefaultLanguage=="English") $lang=trim(getLanguageName(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)));
if(isset($_GET['lang'])) $_SESSION["custom_lang"]=$lang=trim($_GET['lang']);
if(isset($_SESSION["custom_lang"])) $lang=$_SESSION["custom_lang"];

if(trim($lang)!="" && ($redefaultLanguage!=$lang || $lang=="English")){
	setLanguageSession($host,$database,$username,$password,$languageTable,$lang);
	$relanguage_tags=$_SESSION["re_language"];
	$readmin_settings['defaultlanguage']=$lang;
	$_SESSION["readmin_settings"]["defaultlanguage"]=$lang;
}

if(isset($_GET['rtl'])) $_SESSION['rtl']=$_GET['rtl'];
if($rtl) $_SESSION['rtl']=true;

if(isThisMobile()) $fullScreenEnabled="false";

if($isThisDemo=="yes"){
	if($webtheme=="default"){ $fieldtheme="smoothness"; $readmin_settings['websitelogo']="logo5b-dark.png"; }
	if($webtheme=="amelia"){  $fieldtheme="blitzer"; }
	if($webtheme=="cerulean"){  $fieldtheme="redmond"; }
	if($webtheme=="cosmos"){  $fieldtheme="ui-darkness"; }
	if($webtheme=="cyborg"){  $fieldtheme="dark-hive"; }
	if($webtheme=="flatly"){  $fieldtheme="hot-sneaks"; }
	if($webtheme=="journal"){  $fieldtheme="humanity";  $readmin_settings['websitelogo']="logo5b-dark.png";}
	if($webtheme=="readable"){  $fieldtheme="redmond";  $readmin_settings['websitelogo']="logo5b-dark.png";}
	if($webtheme=="simplex"){  $fieldtheme="blitzer";  $readmin_settings['websitelogo']="logo5b-dark.png";}
	if($webtheme=="slate"){  $fieldtheme="dark-hive"; }
	if($webtheme=="spacelab"){  $fieldtheme="smoothness";  $readmin_settings['websitelogo']="logo5b-dark.png";}
	if($webtheme=="united"){  $fieldtheme="ui-lightness"; }
	if($webtheme=="yeti"){  $fieldtheme="black-tie"; }
	if($webtheme=="custom"){  $fieldtheme="cupertino";  $readmin_settings['websitelogo']="logo5b-dark.png";}
}

$ptype=trim($_GET["ptype"]);

$requerystring=$_POST['requerystring'];
if($ptype=="") $ptype=trim($_POST["ptype"]);
$ptype=htmlspecialchars($ptype, ENT_QUOTES, 'UTF-8');

if($ptype=="home" || $ptype=="viewMemberListing" || $ptype=="viewFullListing" || $ptype=="submitReListing" || $ptype=="addReListing" || $ptype=="editReListingForm"  || $ptype=="allMembers" || $ptype=="contactus" || $ptype=="updateReListing" || $ptype=="myprofile" || $ptype=="adminOptions"  || $ptype=="UpdateAdminOptions" || $ptype=="allMembers" || $ptype=="languagetags"  || $ptype=="updateLanguageTags" || $ptype=="categories" || $ptype=="pricerange" ||  $ptype=="updatePriceRange" || $ptype=="page")
$fullScreenEnabled="false";

if($ptype!="checklogin"){ 
 if(!isset($_SESSION["myusername"])){ 
		if($ptype=="submitReListing" || $ptype=="addReListing" || $ptype=="editReListingForm"  || $ptype=="updateReListingForm" || $ptype=="myprofile" || $ptype=="adminOptions"  || $ptype=="UpdateAdminOptions" || $ptype=="allMembers" || $ptype=="languagetags"  || $ptype=="updateLanguageTags" || $ptype=="pricerange" || $ptype=="updatePriceRange" || $ptype=="uploadcsv")	$ptype="";
	}	
}

if(isset($_SESSION["showOnMap"])){
	$fullScreenEnabled="true";
}else{
	if($ptype=="showOnMap"){
		$_SESSION["showOnMap"]="true"; $fullScreenEnabled="true";
	}
}

if($ptype!="" && $ptype!="showOnMap"){
	$_SESSION["showOnMap"] = NULL;
	unset($_SESSION["showOnMap"]);
	$fullScreenEnabled="false";
}

$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
$mem_id=$_SESSION["re_mem_id"];
$memtype=$_SESSION["memtype"];
$ip=$_SERVER["REMOTE_ADDR"];

$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$priceqr="select * from $priceTable";
$priceResult=mysql_query($priceqr);
$priceRange=mysql_fetch_assoc($priceResult);
$rentPriceRange=explode(",",$priceRange['rent']);
$salePriceRange=explode(",",$priceRange['sale']);
$rentRangeSize=sizeof($rentPriceRange);
$saleRangeSize=sizeof($salePriceRange);

if($ptype=="submitReListing"){
	require_once('geoplugin.class.php');
	$geoplugin = new geoPlugin();
	$geoplugin->locate();
	$vRegion=$geoplugin->region;
	$vCity=$geoplugin->city;
	$vCountry=$geoplugin->countryName;      
}

if($ptype=="viewFullListing"){ 
	$reid=htmlspecialchars(trim($_GET["reid"]), ENT_QUOTES, 'UTF-8');
	$region=htmlspecialchars(trim($_GET["region"]), ENT_QUOTES, 'UTF-8');
	if($region===""){
	$reid=$_GET['reid']; 
	$viewListingRow=getListingData($reid);
	}else{
		if($readmin_settings['oodleplugin']==1 && function_exists("getOodleArray")){
		$combArray=convertArrayToClFormat(getOodleArray("","",$reid,"",$region));
		$viewListingRow=$combArray[0];
		$viewListingRow['category']=ucfirst($viewListingRow['category']);
		}
	}
	if(empty($viewListingRow)){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $full_url_path");
	} 
	$browsertitle=__($viewListingRow['retype'])." - ".__($viewListingRow['subtype'])." - ";
    if($viewListingRow['readdress']!="")$browsertitle=$browsertitle.$viewListingRow['readdress'].",".$viewListingRow['city'];
    else $browsertitle=$browsertitle.$viewListingRow['city'];
	$homepagedescription=addslashes((substr($viewListingRow['description'],0,250)));
	$homepagekeywords=__($viewListingRow['retype']).",".__($viewListingRow['subtype']).",".__($viewListingRow['city'])." real estate";
    $rePicArray=explode("::",$viewListingRow['pictures']);
    if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled"){
        $headline_slug=friendlyUrl($viewListingRow['headline']);    
        $urlLink=friendlyUrl($viewListingRow['category'],"_")."/".friendlyUrl($viewListingRow['subcategory'],"_")."/"."id-".$viewListingRow['id']."-".$region."-".$headline_slug;
    }else  $urlLink="index.php?ptype=viewFullListing&reid=".$viewListingRow['id'].$regionClause2;
}

if($ptype=="page" && htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8')!=""){
	$qrpg0="select * from $pageTable where id='".mysql_real_escape_string(htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'))."';";
	$resultpg0=mysql_query($qrpg0);
	$page_info=mysql_fetch_assoc($resultpg0);
	$browsertitle=$page_info['page_name']." - ".$browsertitle;
	$homepagedescription=(substr(strip_tags(preg_replace( '/\s+/', ' ', $page_info['page_content'])),0,250));
	$homepagekeywords=$page_info['keywords'];
}

?>
<!DOCTYPE html>
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="generator" content="Real Estate Made Simple" />
<meta name="robots" content="noindex, follow" />
<?php if($ptype=="checklogin"){ ?><meta http-equiv="refresh" content="1;url=index.php?<?php print $requerystring; ?> "><?php } ?>
<?php if($ptype=="UpdateAdminOptions"){ ?><META HTTP-EQUIV=Refresh CONTENT="1 ; URL=index.php?ptype=adminOptions"> <?php } ?>
<title><?php print $browsertitle; ?></title>
<?php if(trim($homepagedescription)!=""){ ?>
<meta name="description" content="<?php print $homepagedescription; ?>">
<?php  } ?>
<?php if(trim($homepagekeywords)!=""){ ?>
<meta name="keywords" content="<?php print $homepagekeywords; ?>">
<?php  } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if($ptype=="viewFullListing") { ?>
<meta property="og:image" content="<?php print $rePicArray[0]; ?>"/>
<meta property="og:title" content="<?php print $browsertitle; ?>"/>
<meta property="og:url" content="<?php print $full_url_path.$urlLink; ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:site_name" content="<?php print $reSiteName; ?>"/>
<meta property="og:description" content="<?php print $homepagedescription; ?>"/>
<?php } ?>


<base href="<?php print $full_url_path; ?>" />
<?php if($ptype=="viewFullListing" || $ptype=="showOnMap" || $fullScreenEnabled=="true" || $ptype=="submitReListing" || $ptype=="editReListingForm" ){ ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCIml0BSyypNp4sNgLzMo-HQcdU5dK3Ls8&v=3.15&sensor=false"></script>
<script  src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
<?php } ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.multiselect.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php 
//if($ptype=="viewFullListing"){ ?>
<script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
<?php  
//} 
?>

<?php if($ptype=="viewFullListing" || $ptype=="showOnMap" || $fullScreenEnabled=="true" || $ptype=="submitReListing" || $ptype=="editReListingForm" ){ ?>
<script src="js/markerwithlabel_packed.js"></script>
<script src="js/markerclusterer_packed.js"></script>
<?php  } ?>

<script type="text/javascript" src="loadingImage.js"></script>
<script type="text/javascript"  src="infoResults.js"></script>
<script type="text/javascript"  src="js/reFunctions.js"></script>
<?php if($memtype==9 || $memtype==1) { ?>
<script type="text/javascript"  src="js/ajaxupload.js"></script>
<?php } ?>

<?php if($memtype==9) { ?>
<script type="text/javascript" src="js/colorpicker.js"></script>
<script type="text/javascript" src="js/eye.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
<script type="text/javascript" src="js/adminOptions.js"></script>
<?php } ?>
<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/mortgageCalculator.js"></script>

<?php if($ptype=="addeditpage"){ ?>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.tagsinput.js"></script>
<link rel="stylesheet" href="css/jquery.tagsinput.css" type="text/css" />
<?php  } ?>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<?php if($fieldtheme==""){ ?>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/smoothness/jquery-ui.css" />
<?php }else{ ?>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/<?php print $fieldtheme; ?>/jquery-ui.css" />
<?php } ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/jquery.multiselect.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" media="screen" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<?php 
//if($ptype=="viewFullListing"){ 
?>
	<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<?php 
//} 
?>

<link rel="stylesheet" href="prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58351a9bbda6054f"></script> 
 
<?php if($webtheme==""){ ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/default/bootstrap.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/default/bootstrap-theme.min.css" />
<?php }else{ ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/<?php print $webtheme; ?>/bootstrap.css" />
<?php } ?>
<?php if($memtype==9) { ?><link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" /><?php } ?>
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<?php if((isset($_SESSION["readmin_settings"]) && $_SESSION["recustom_settings"]==1) || $fullScreenEnabled=="true"){ ?>
<link href="css/custom_style.php?ptype=<?php print $ptype; ?>&amp;fullscreen=<?php print $_GET["fullscreen"]; ?>&amp;fs=<?php print $fullScreenEnabled; ?>" rel="stylesheet" type="text/css" />
<?php } ?>
<?php  
if($_SESSION["rtl"]){ ?>
<link href="css/rtl_style.php?ptype=<?php print $ptype; ?>&amp;fullscreen=<?php print $_GET["fullscreen"]; ?>&amp;fs=<?php print $fullScreenEnabled; ?>" 
rel="stylesheet" type="text/css" />
<style> body {direction: rtl;}</style>
<?php } ?>
<style> 
   @media (max-width: 767px) {
	  .navbar-nav .open .dropdown-menu {
		  position:absolute;
		  background-color:#fff;
		  border:1px solid #ccc;    
	  }
  }
</style>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<script type="text/javascript">
$(function(){
    var isIE8 = $.browser.msie && +$.browser.version === 8;
    var isIE7 = $.browser.msie  && parseInt($.browser.version, 10) === 7;
       
     $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'winwidth:'+$(window).width(), type:26}, success: function(data){ }});
     
     $("tr.inactiveListing1 td").css("background-color",$('.alert-danger').css("background-color"));
     
	<?php 
	if($fixedtopheader=="yes"){ 
	?>
		 var topbarHeight=$('.navbar').height();
		 if (isIE7 || isIE8){
			 $('#sidebar').css('margin-top','52px');
			 $('#mainContent').css('margin-top','52px');  
		 }else{
			 $('#sidebar').css('margin-top',topbarHeight+'px');
			 $('#mainContent').css('margin-top',topbarHeight+'px');
		 }
	<?php 
	}else{ 
	?>
		 $('#sidebar').css('margin-top','0px');
		 $('#mainContent').css('margin-top','0px');
	<?php 
	}
	if(isset($_GET['requery'])) $reQuery=htmlspecialchars(trim($_GET['requery']), ENT_QUOTES, 'UTF-8');
    if(isset($_GET['city'])) $reCity=htmlspecialchars(trim($_GET['city']), ENT_QUOTES, 'UTF-8');
    if(isset($_GET['ctype'])) $ctype=htmlspecialchars(trim($_GET['ctype']), ENT_QUOTES, 'UTF-8');
    if(isset($_POST['requery'])) $reQuery=htmlspecialchars(trim($_POST['requery']), ENT_QUOTES, 'UTF-8');
    if(isset($_POST['city'])) $reCity=htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');
    if(isset($_POST['ctype'])) $ctype=htmlspecialchars(trim($_POST['ctype']), ENT_QUOTES, 'UTF-8');
    
	/* Changed By Hitesh
	if($ctype==1)$ctype=__("Any");   
    if($ctype==2)$ctype=__("Sale"); 
    if($ctype==3)$ctype=__("Available"); 
    */
	 
	if($ctype=='Any') $ctype=__("Any");   
    if($ctype=='Sell') $ctype=__("Sale"); 
    if($ctype=='Rent') $ctype=__("Available"); 
	
	?>
	<?php if(($ptype=="" || $ptype=="home") && $fullScreenEnabled!="true"){ 
	/* if($_SESSION["reClassification"]!="") $homeClassification=$_SESSION["reClassification"]; else $homeClassification=__("Any"); */
    if($ctype==""){ if($_SESSION["reClassification"]!="") $homeClassification=$_SESSION["reClassification"]; else $homeClassification=__("Any"); } else{ $homeClassification=$ctype; }
	if($_SESSION["reType"]!="") $homeType=$_SESSION["reType"]; else $homeType=__("Any");
	if($_SESSION["reSubtype"]!="") $homeSubtype=$_SESSION["reSubtype"]; else $homeSubtype=__("Any");
	if($_SESSION["reBedrooms"]!="") $homeBedrooms=$_SESSION["reBedrooms"]; else $homeBedrooms=__("Any");
	if($_SESSION["reBathrooms"]!="") $homeBathrooms=$_SESSION["reBathrooms"]; else $homeBathrooms=__("Any");
	if($_SESSION["rePrice"]!="") $homePrice=$_SESSION["rePrice"]; else $homePrice=10;
    if($reQuery==""){ if($_SESSION["reQuery"]!="") $homeQuery=$_SESSION["reQuery"]; else $homeQuery="";} else{ $homeQuery=$reQuery; }
    if($reCity=="" && $_GET['city']!=""){ if($_SESSION["reCity"]!="") $homeCity=$_SESSION["reCity"]; else $homeCity="";} else{ $homeCity=$reCity; }
		
	?>
	$('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>");
	var allData='<?php print $homeClassification.":".$homeType.":".$homeSubtype.":".$homeBedrooms.":".$homeBathrooms.":".$homePrice.":".$homeQuery.":".$homeCity;?>';	 $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:1}, success: function(data){ $('#reResults').html(data); 
	onTextSearch();
	}});
	<?php } ?>
	<?php if($ptype=="viewMemberListing"){ ?>
	$('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>");    
var allData='<?php print $relanguage_tags["Any"].":".$relanguage_tags["Any"].":".$relanguage_tags["Any"].":".$relanguage_tags["Any"].":".$relanguage_tags["Any"];?>:10:'; $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:7}, success: function(data){ $('#reResults').html(data); 
onTextSearch();
}});
	<?php }  ?>
	<?php if($ptype=="viewFullListing"){ 
	$allData=$_SESSION["reClassification"].":".$_SESSION["reType"].":".$_SESSION["reSubtype"].":".$_SESSION["reBedrooms"].":".$_SESSION["reBathrooms"].":".$_SESSION["rePrice"].":".$_SESSION["reQuery"].":".$_SESSION["reCity"];
		?>
	$.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'<?php print $allData; ?>', type:1}, success: function(data){ $('#reResults2').html(data); 
	onTextSearch();
	}});
	<?php }  ?>

	<?php 
	if($ptype=="viewFullListing"){ 
	?>
	//$("#listingImage a").lightBox();
	<?php 
	} ?>
	
	$('#listingButtons span,span.alreadySeen,#listingAllowedThings div,#hidebar,#showbar, #pageorder, #pagename, .action_icon img, .listingcontact, .updateLangTag, .deleteLangTag').tooltip({ 
		placement:'bottom',
		delay: { show: 500, hide: 100 }
	});
	$("#reTextSearch").click(function(){
	$("#sfpType").val("home");
	});

	$('.nav .favli').click(function(event){
	    event.preventDefault(); 
		$('.nav li').removeClass("active");
		$(this).addClass("active");
		$('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>");
		$.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'<?php print $relanguage_tags["Any"].":".$relanguage_tags["Any"]; ?>:10:', type:24}, success: function(data){ $('#reResults').html(data); 
		onTextSearch();
		}});
		
	});
 
	<?php if(isset($_SESSION["marked_reid"])){ ?>
	 $('.nav .favli').css('display','block');
	<?php } ?>	
	
	$("#mainContent").on("click", "#listingImages span", function(event) {    
	event.preventDefault(); 
	var img = new Image();
	$("#image_cell").html("<div style='width:100%; text-align:center; padding-top:25%;'><img src='images/loader_light_blue.gif' /></div>");
	var icon_id=($(this).attr('id')).split('-');
	img.onload = function(){
		
		$("#image_cell").html("<div id='listingImage'><a data-fancybox-group='listgallery' href='"+$("#bimage-"+icon_id[1]).html()+"' ><img src='"+$("#bimage-"+icon_id[1]).html()+"' width='100%' /></a></div>");
		//alert($("#hiddendiv_listingimages").html());
		$("#listingImage").html($("#hiddendiv_listingimages").html());
		//$(".listinghiddenimages").hide();
		//alert("image_"+icon_id[1]);
		$("#listingImage a#image_"+icon_id[1]).show();
		//$("#listingImage a").lightBox();
	}
	//alert($("#bimage-"+icon_id[1]).html());
	img.src = $("#bimage-"+icon_id[1]).html();
	
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto();
	
	$("#mainContent").on("click", "#listingImage a", function(event) {
		event.preventDefault();
		//$("#listingImage a").lightBox();
	    /*$(this).filter(':not(.fb)').fancybox({
	    	'transitionIn'	:	'elastic',
	    	'transitionOut'	:	'elastic',
	    	'speedIn'		:	100, 
	    	'speedOut'		:	100, 
	    	'overlayShow'	:	false,
			'showNavArrows' : true,
			'scrolling' : 'auto',
			'type' : 'image'
	    }).addClass('fb');
	    $(this).triggerHandler('click');*/
	 });
    
    var contactFormHeight=700;
    if($(window).height()<550) contactFormHeight=$(window).height()-50;
    
	$("#mainContent").on("click", "a.listingcontact", function(event) {
		event.preventDefault();
	    $(this).filter(':not(.fb)').fancybox({
	    	'transitionIn'	:	'elastic',
	    	'transitionOut'	:	'elastic',
	    	'speedIn'		:	100, 
	    	'speedOut'		:	100, 
	    	'width' : 600,
			'height' : contactFormHeight,
	    	'type' : 'iframe',
	    	'overlayShow'	:	false,
			'showNavArrows' : true,
			'scrolling' : 'auto'
	    }).addClass('fb');
	    $(this).triggerHandler('click');
	 });

    
  $('input, textarea').placeholder();

function onTextSearch(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
    $('#resultTable tr.featuredClass td').css('background-color',$('.alert-info').css('background-color'));
    $('#resultTable tr.flagClass td').css('background-color',$('.alert-warning').css('background-color'));
    $('#resultTable tr.inavtiveClass td').css('background-color',$('.alert-danger').css('background-color'));  
  }
  
    $('#reSearch').click(function(){
    	$('#mapOverlayDiv input').css('display','none');
		var reClassification="";
		var reType="";
		var reSubtype="";
		var reBedrooms="";
		var reBathrooms="";
		var rePrice="";
		var delim=",";
		
		$("#reClassification :selected").each(function(i, selected){ 
			 if(reClassification=="") delim=""; else delim=",";
			 reClassification = reClassification+delim+$(selected).val(); 
		});
		
		$("#reType :selected").each(function(i, selected){ 
			 if(reType=="") delim=""; else delim=",";
			 reType = reType+delim+$(selected).val(); 
		}); 
		 if(reType=="<?php print __("Any"); ?>"){ 
			 $("#reSubtype :selected").each(function(i, selected){ 
				 if(reSubtype=="") delim=""; else delim=",";
				 reSubtype = reSubtype+delim+$(selected).val();
			});		
		}	
		if(reType=="<?php print __("Residential"); ?>"){ 
		 $("#reSubtypeResidential :selected").each(function(i, selected){ 
			 if(reSubtype=="") delim=""; else delim=",";
			 reSubtype = reSubtype+delim+$(selected).val();
		});		
		}
		if(reType=="<?php print __("Commercial"); ?>"){ 
			 $("#reSubtypeCommercial :selected").each(function(i, selected){ 
				 if(reSubtype=="") delim=""; else delim=",";
				 reSubtype = reSubtype+delim+$(selected).val();
			});		
		}
		 $("#reBedrooms :selected").each(function(i, selected){ 
			 if(reBedrooms=="") delim=""; else delim=",";
			 reBedrooms = reBedrooms+delim+$(selected).val(); 
		});	
		 $("#reBathrooms :selected").each(function(i, selected){ 
			 if(reBathrooms=="") delim=""; else delim=",";
			 reBathrooms = reBathrooms+delim+$(selected).val(); 
		});	
		 $("#rePrice :selected").each(function(i, selected){ 
			 if(rePrice=="") delim=""; else delim=",";
			 rePrice = rePrice+delim+$(selected).val();
		});			

		 $('.nav li').removeClass("active");
		 $('.first_item').addClass("active");
		 var reQuery=$('input#reQuery').val();
		 var reCity=$('input#reCity').val();
		 var allData=reClassification+":"+reType+":"+reSubtype+":"+reBedrooms+":"+reBathrooms+":"+rePrice+":"+reQuery+":"+reCity; 
		  $('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>");
		 <?php 
		 if($ptype=="" || $ptype=="home" || $ptype=="viewFullListing"  || $ptype=="showOnMap"  || $ptype=="adminOptions" || $ptype=="UpdateAdminOptions" || $ptype=="allMembers" || $ptype=="contactus" || $ptype=="page" || $ptype=="languagetags" || $ptype=="updateLanguageTags" || $_GET["cpage"]==1)
		 { 
		 ?>
			 $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:1}, success: function(data){ $('#reResults').html(data); 
				onTextSearch();
			 }});
	 	<?php 
		 } 
		 if($ptype=="viewMemberListing"){ 
		 ?>
			 $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:7}, success: function(data){ $('#reResults').html(data); 
			 onTextSearch();
		 }});
		 <?php 
		 } ?>
		 if($(window).width()<=991){
		 $("#reForm").hide('slow');
         $('#showSidebar').show();
         $('#hideSidebar').hide();
         }
   
	 });    
    
    $("#reCity").autocomplete({
        source: "infoResults.php?type=28&stype=1",
        minLength: 2,
        select: function( event, ui ) { 
        $("#reCity").val(ui.item.value);
        }
    });

   $(document).on("click","ul.pagination li a, .hsorting a",function(event){ 
    event.preventDefault();
    var qData=$("span", this).html(); 
    var allData=qData.split("-@@-");
  /*  console.log('allData: '+allData[0]+", "+allData[1]); */
    $('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>");  
    $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData[0], type:allData[1]}, success: function(data){ $('#reResults').html(data); }});
   });
    
    $(document).on("change", "#reListingsPerPage1, #reListingsPerPage2", function(){
        var qData=this.value; 
        var allData=qData.split("-@@-");
        $('#reResults').html("<p align='center'><br /><br /><br /><img src='images/loading1.gif' /></p>"); 
         $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData[0], type:allData[1]}, success: function(data){ $('#reResults').html(data); }});
    });    

    <?php if($ptype=="viewFullListing" || $ptype=="showOnMap"  || $fullScreenEnabled=="true"){ ?>
    var remap = $("#mapResults");
	<?php } ?>

	<?php if($ptype=="viewFullListing"){ ?>
	$("#closeMapListing").css('display','none');
	<?php  }else{ ?>
	$("#closeMapListing").css('display','block');
	<?php  } ?>
	
	$("#mapResults").click(function(){
		$("#theListing").hide("slow");
	});
	 
	$(document).on('click', '#closeMapListing img', function() { $("#theListing").hide("slow"); });

	$(document).keydown(function(e) { if (e.keyCode == 27) $("#theListing").hide("slow"); });
	
	$('#addNewTag').click(function(){
		var newKeyword=$.trim($('input#newtag').val());
		var newTranslation=$.trim($('input#newtranslation').val());
		if(newKeyword.length<=0 || newTranslation.length<=0){
		alert("Please specify keyword in English and the translation in <?php print $redefaultLanguage; ?>.");
			return false;
		}else{
		infoResults(newKeyword+':::'+newTranslation+':::'+'<?php print $redefaultLanguage; ?>',22,'addTagStatus');
		}
	});
	
    $("#reSubtype").multiselect({
        noneSelectedText: "<?php print __("Select Style"); ?>",
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Style"];?>: " + selectedValues.join(", ");
		   },				
		height:'350',
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"
		}); 
  $("#reSubtypeResidential").multiselect({
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Style"];?>: " + selectedValues.join(", ");
		   },
		height:'350',
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"
		
	});
	$("#reSubtypeCommercial").multiselect({
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Style"];?>: " + selectedValues.join(", ");
		   },
		height:'350',
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"
		
	});  
	
	/*
    $("#reClassification").multiselect({
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				selectedValues[i]=checkedItems[i].value;
			}
		      var tempvar = selectedValues.join(", ");
			  if(tempvar == 'Sale')
			  {
				tempvar = 'Buy';
			  }
			  return "<?php print $relanguage_tags["Classification"];?>: " + tempvar;
		   },
		   checkAllText:"<?php print __("Check all"); ?>",
		   uncheckAllText:"<?php print __("Uncheck all"); ?>",
		   multiple:false
	}); 
     */
	/*
	$("#reType").multiselect({
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
				      return "<?php print $relanguage_tags["Type"];?>: " + selectedValues.join(", ");
				   },
				multiple:false,
				height:'auto',
				checkAllText:"<?php print __("Check all"); ?>",
				uncheckAllText:"<?php print __("Uncheck all"); ?>"
				
	}); 
	*/
	$("#reBedrooms").multiselect({
	    noneSelectedText: "<?php print __("Select Bedroom"); ?>",
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				if(checkedItems[i].value=="1den") checkedItems[i].value="<?php print __("1 + Den"); ?>";
				if(checkedItems[i].value=="2den") checkedItems[i].value="<?php print __("2 + Den"); ?>";
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Bedroom"];?>: " + selectedValues.join(", ");
		   },
		height:'250',
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"
	});

	$("#reBathrooms").multiselect({
	    noneSelectedText: "<?php print __("Select Bathroom"); ?>",
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Bathroom"];?>: " + selectedValues.join(", ");
		   },
		height:'250',
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"
	});

	$("#rePrice").multiselect({
		noneSelectedText: "Price",
		selectedText: function(numChecked, numTotal, checkedItems){
			var selectedValues = new Array();
			for (var i = 0; i < checkedItems.length; i++) {
				if(checkedItems[i].value==10) checkedItems[i].value="<?php print __("Any"); ?>";
				selectedValues[i]=checkedItems[i].value;
			}
		      return "<?php print $relanguage_tags["Price"];?>: " + selectedValues.join(", ");
		   },
		height:'250',
		multiple:false,
		checkAllText:"<?php print __("Check all"); ?>",
		uncheckAllText:"<?php print __("Uncheck all"); ?>"		
	});
	
	var currentType=new Array();
	<?php 
	$reType=htmlspecialchars($_POST['retype'][0], ENT_QUOTES, 'UTF-8');
	if($reType=="") $reType=$_SESSION["reType"]; 
	?>
	var testing="<?php print $_POST['retype'][0]; ?>";
	currentType[0]="<?php print $reType; ?>";
	checkSelections(currentType);	
	
	$('#reType').change(function(){
		 
		var reClassification=[];
		var reType=[];
		
		$("#reClassification :selected").each(function(i, selected){ 
			 reClassification[i] = $(selected).val(); 
		});

		$("#reType :selected").each(function(i, selected){ 
			 reType[i] = $(selected).val(); 
		});
		 
	     var isSubmitListingForm=$('input#isSubmitListingForm').val();
	     checkSelections(reType);	     
		 	
		   if(isSubmitListingForm==1){
	    	 if($.inArray("<?php print $relanguage_tags["Commercial"];?>",reType)>=0){
	    	 $('.nonCommercial').css('display', 'none');
	    	 }
	    	 if($.inArray("<?php print $relanguage_tags["Residential"];?>",reType)>=0){
		     $('.nonResidential').css('display', 'none');
	    	 }
	        }
	    
	 });

	function checkSelections(reType){
		if($.inArray("<?php print $relanguage_tags["Any"];?>",reType)>=0){ 
	 		 $("div.allStyle").css('display','block');
	 		 $("#reSubtypeResidential").multiselect("uncheckAll");
	 		 $("#reSubtypeCommercial").multiselect("uncheckAll");
	 		 $("div.onlyCommercial").hide();
	    	 $("div.onlyResidential").hide();
	    	 $('.nonCommercial').css('display', 'block');
	    	  
	 	}else if($.inArray("<?php print $relanguage_tags["Residential"];?>",reType)>=0 && $.inArray("<?php print $relanguage_tags["Commercial"];?>",reType)>=0){
	 		 $("div.allStyle").css('display','block');
	 		 $("#reSubtypeResidential").multiselect("uncheckAll");
	 		 $("#reSubtypeCommercial").multiselect("uncheckAll");
	 		 $("div.onlyCommercial").hide();
	    	 $("div.onlyResidential").hide();
	    	 $('.nonCommercial').css('display', 'block');
	    
		 }else if($.inArray("<?php print $relanguage_tags["Residential"];?>",reType)>=0){ 
			  $("#reSubtype").multiselect("uncheckAll");
	       	  $("div.allStyle").hide();
	       	  $("#reSubtypeCommercial").multiselect("uncheckAll");
	       	  $("div.onlyCommercial").hide();
	    	  $("div.onlyResidential").css('display','block');
	    	  $('.nonCommercial').css('display', 'block');
	    	 		    	  
	    }else if($.inArray("<?php print $relanguage_tags["Commercial"];?>",reType)>=0){ 
		      $("div.onlyCommercial").css('display','block');
		      $("#reSubtype").multiselect("uncheckAll");
	    	  $("div.allStyle").hide();
	    	  $("#reSubtypeResidential").multiselect("uncheckAll");
	    	  $("div.onlyResidential").hide();
	    	  $('.nonCommercial').css('display', 'none');
		 
		 }
		
	}
	
	 setEditFormOptions();
	 $('#reType2').change(function(){
	 setEditFormOptions();
	 });

    function setEditFormOptions(){
     var reType2=$('#reType2').val(); 
     if(reType2=="<?php print "Commercial";?>"){ $('.nonCommercial').css('display', 'none'); 
     $('.commercialopt').css('display', 'block'); $('.residentialopt').css('display', 'none'); 
     } 
     if(reType2=="<?php print "Residential";?>"){ $('.nonCommercial').css('display', 'block'); 
     $('.commercialopt').css('display', 'none');  $('.residentialopt').css('display', 'block');
     }
    }

	 $('#reSubtype2').change(function(){
		 var reType2=$('#reType2').val();
		 var reSubtype2=$('#reSubtype2').val();
		 if(reSubtype2=="<?php print "Land"; ?>" && reType2=="<?php print "Residential"; ?>"){ $('.nonCommercial').css('display', 'none'); }
		 else{ $('.nonCommercial').css('display', 'block'); }
		 if(reType2=="<?php print "Commercial"; ?>") $('.nonCommercial').css('display', 'none');
	 });
	 
	 if($('#reSubtype2').val()=="<?php print "Land"; ?>" && $('#reType2').val()=="<?php print "Residential"; ?>"){ $('.nonCommercial').css('display', 'none');  }
         
    $('#loginButton').click(function(){
	   var reusername=$.trim($('input#reusername').val());
	   var repassword=$.trim($('input#repassword').val());
	   var errorMessage="<?php print $relanguage_tags["Please enter your"];?>: ";
	   var errorCode=0;
	   if(reusername.length<=0){
		    errorMessage=errorMessage+"<?php print $relanguage_tags["Username"];?>";
		    errorCode=1;
	   }
	   if(repassword.length<=0){
		   if(errorCode==1) var errorMessage=errorMessage+" <?php print $relanguage_tags["and"];?> ";
		    errorMessage=errorMessage+"<?php print $relanguage_tags["Password"];?>";
		    errorCode=1;
	   }
	   if(errorCode==1){
		    alert(errorMessage);
		    return false;
	   } 
   });
   
   $("#sidebar1, #sidebar, #sidebarTabs").mouseout(function(){
      $(".tooltip").hide();
   });
   
   $('#sidebarLogin').on("click","#registerButton, #registerLink a",function(){
       var reusername=$('input#reusername').val();
       var repassword=$('input#repassword').val();
       var allData=reusername+":"+repassword;
       $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:2}, success: function(data){
          $('#sidebarLogin').html(data); 
          $("#mapResults").trigger("resize");
          }
       });
    });
    
	$('#sidebarLogin').on("click","#forgotPasswordLink, #forgotPasswordLink2 a",function(){
		  $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'sidebarLogin', type:9}, success: function(data){
          $('#sidebarLogin').html(data); 
         }
       });
	});
	
	$('#sidebarLogin').on("click","#loginLink2 a",function(){
         $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'sidebarLogin', type:4}, success: function(data){
          $('#sidebarLogin').html(data); 
         }
       });
    });
    
    <?php include("js/v3map.php"); ?>

	$('#reprofileimage').click(function(){
	var reprofileimage=$("input[@name=reprofileimage]:checked").val();
	infoResults(reprofileimage,6,'listingProfileImage');
	});

	$('#reprofileimage2').click(function(){
		var reprofileimage=$("input[@name=reprofileimage]:checked").val();
		infoResults('no',6,'listingProfileImage');
	});
    
      
   	$('#reAddListingButton').click(function(){
		var reClassification=$.trim($('select#reClassification2').val());
		var reType=$.trim($('select#reType2').val());
		var reSubtype=$.trim($('select#reSubtype2').val());
		var reBedrooms=$.trim($('select#reBedrooms2').val());
		var reBathrooms=$.trim($('select#reBathrooms2').val());
		var recity=$.trim($('input#recity').val());
		var restate=$.trim($('input#restate').val());
		var reheadline=$.trim($('input#reheadline').val());
		var redescription=$.trim($('#redescription').val());
		var rename=$.trim($('input#rename').val());
		var reemail=$.trim($('input#reemail').val());
		var isSubmitListingForm=$('input#isSubmitListingForm').val();
		var errorMessage="<?php print $relanguage_tags["Please specify"];?>: ";
		var startErrorLen=errorMessage.length;
		var errorCode=0;

		if(reClassification.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Classification"];?>";
		if(reType.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Type"];?>";
		if(reSubtype.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Style"];?>";
		
	    if(reType!="Commercial" && reSubtype!="<?php print "Land"; ?>"){ 
		 if(reBedrooms.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Bedroom"];?>";
		 if(reBathrooms.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Bathroom"];?>";
	     }
		if(recity.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["City"];?>";
		<?php if($headlinelength > 0){ ?>
        if(reheadline.length<=<?php print $headlinelength; ?>) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Headline"];?> (<?php print $headlinelength; ?> <?php print $relanguage_tags["characters"];?>)";
        <?php } ?>
        <?php if($descriptionlength > 0){ ?>
        if(redescription.length<=<?php print $descriptionlength; ?>) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Description"];?> (<?php print $relanguage_tags["atleast"];?> <?php print $descriptionlength; ?> <?php print $relanguage_tags["characters"];?>)";
        <?php } ?>
		if(rename.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Name"];?>";
		if(reemail.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Email"];?>";
		else{
			if (echeck(reemail)==false) return false;			 
		}

		var endErrorLen=errorMessage.length;
		if(startErrorLen<endErrorLen){
		    alert(errorMessage);
		    return false;
	   }else{
			return true;
		   }
	});

	$('#resmtpAuth').change(function(){
	var resmtpAuth=$('select#resmtpAuth').val();
	if(resmtpAuth=="gmail"){
	$('input#resmtp').val("smtp.gmail.com");
	$('input#resmtpPort').val("587");
	$('#emailusername').html("Gmail/Apps Email");
	$('#emailpassword').html("Gmail/Apps Password");
	}else{
		$('input#resmtp').val("");
		$('input#resmtpPort').val("");
		$('#emailusername').html("Username");
		$('#emailpassword').html("Password");
	}
	});

	$('#visitor_submit').click(function(){
		var visitor_name=$.trim($('input#visitor_name').val());	
		var visitor_email=$.trim($('input#visitor_email').val());
		var visitor_message=$.trim($('#visitor_message').val());
		var errorMessage="<?php print $relanguage_tags["Please specify"];?>: ";
		var errorMessageprevLen=errorMessage.length;
		if(visitor_name.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Name"];?>";
		if(visitor_email.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Email"];?>";
		if(visitor_message.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Message"];?>";

		if(errorMessage.length>errorMessageprevLen){
		    alert(errorMessage);
		    return false;
		}else{
			return true;
		   }
		});
	$('#listingNormal').click(function(){
		$('#listingStatus').css('display','inline');
	$('#listingStatus').html("Listing will be removed automatically after some days as defined in admin options.");
	});

	$('#listingPermanent').click(function(){
		$('#listingStatus').css('display','inline');
		$('#listingStatus').html("Listing will never expire.");
	});

	var ppcurrency=$('select#ppcurrency').val();
    $('#ppdefaultcurrency').html(ppcurrency);
    
	$('#ppcurrency').change(function(){
    var ppcurrency=$('select#ppcurrency').val();
    $('#ppdefaultcurrency').html(ppcurrency);
	});
	
	$('.refileup').click(function(){
    	var fileid=$(this).attr('id');
		var filenum = fileid.split("-");
		var filenumprev=filenum[1]-1;
		var reMaxPictures=<?php print $reMaxPictures; ?>;
		var errorst;
		var fieldothers;
		if(filenumprev >= 0){
		for(var i=0;i<=filenumprev;i++){
		fieldothers=$.trim($('#reimg'+i).html());
		if(fieldothers.search("<?php print $relanguage_tags["File Uploading Please Wait"]; ?>")>=0 || fieldothers=="")
			errorst=1;
		}
		}
		if(errorst==1){
		alert("<?php print $relanguage_tags["Please upload previous files first"];?>");
		return false;
			}else return true;
		
	});

	$('#rewebTheme').change(function() {
		  var webtheme = $(this).find(":selected").val();
		  $(".webscreen").html("<img src='css/"+webtheme+"/screen.jpg' />");
		});
	
<?php if($isThisDemo=="yes"){ ?>
	$('.deletepiclink').click(function(){
	alert("Picture deletion has been disabled in demo.");
	return false;
	});

	$('#updateAdminOptionsButton').click(function(){
		alert("Updating admin options has been disabled in demo.");
		return false;
		});
	
	$('#reprofilesubmit').click(function(){
		alert("Updating profile has been disabled in demo.");
		return false;
		});
	$('#languageUpdateButton').click(function(){
			alert("Updating language tags has been disabled in demo.");
			return false;
	});	
	$('#updatePriceRange1,#updatePriceRange2').click(function(){
		alert("Updating price range has been disabled in demo.");
		return false;
	});		
<?php } ?>

$('.updateLangTag').click(function(){
 <?php if($isThisDemo=="yes"){ ?>
    alert("Language tags can't be updated in demo."); 
 <?php }else{ ?> 
   var clickid= (this.id).split('-');   
   var langkey=$('#'+'keyword-'+clickid[1]).text(); 
   var langtrans=$('#'+'trans-'+clickid[1]).val(); 
   var divid='langResult-'+clickid[1]; 
   var lang=$("#defLang").val(); 
   $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:langkey+':::'+langtrans+':::'+lang, type:25}, success: function(data){ $('#'+divid).html(data); }}); 
 <?php } ?>       
});

<?php if($ptype=="addeditpage"){ ?>
$('textarea.tinymce1').tinymce({
	script_url : 'tinymce/jscripts/tiny_mce/tiny_mce.js',
	theme : "advanced",
	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,|,sub,sup,|,charmap,emotions,fullscreen",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	content_css : "css/style.css",
});

$('#keywords').tagsInput();
  
<?php  } ?>

$('.dropdown-toggle').dropdown();
$('.dropdown-menu').on("click", function(e) { e.stopPropagation(); });
$('#reForm .ui-multiselect').css('width', '225px');

$('#showSidebar').click(function(){
   $("#reForm").show('slow');
   $('#showSidebar').hide();
   $('#hideSidebar').show(); 
});

$('#hideSidebar').click(function(){
   $("#reForm").hide('slow');
   $('#showSidebar').show();
   $('#hideSidebar').hide(); 
});

$('#sidebar1 a_block').click(function(){
	$('#hideSidebar').toggle('click');
});


});

$(window).on('load', function(){
   if($(window).width()<=768){ 
      $('.nav > li').css('display','inline');
      $('.nav > li > a').css('display','inline');
      var topbarHeight=$('.navbar').height();
      <?php if($fixedtopheader=="yes"){ ?>
      $('#sidebar').css('margin-top',topbarHeight+'px');
      <?php }else{ ?>
      $('#sidebar').css('margin-top','0px');    
      <?php } ?>    
      $('#mainContent').css('margin-top','10px');
      }else{
      $('.nav > li').css('display','block');
      $('.nav > li > a').css('display','block');  
      }
      
      <?php if($fullScreenEnabled!="true"){ ?>
          if($(window).width()<=991){
              $("#reForm").hide();
              $('#showSidebar').css('display','inline');
              <?php if($fixedtopheader=="yes"){ ?>
              $('#sidebar').css('margin-top',topbarHeight+'px');
              <?php }else{ ?>
              $('#sidebar').css('margin-top','0px');    
              <?php } ?>
          }
      <?php } ?>
      
       <?php if($_SESSION["rtl"]){ ?>
      if($(window).width()>970) $('.sbar').css('float','right');
      else $('.sbar').css('float','none');
      <?php } ?>
      try {setWidthHeight();}catch(err){}    
});

$(window).resize(function () {
  $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:'winwidth:'+$(window).width(), type:26}, success: function(data){ }});  
  if($(window).width()<=1000){ $(".ui-multiselect").width('95%'); }
  //console.log("resized window2: "+$(window).width());
  if($(window).width()<=768){ 
      $('.nav > li').css('display','inline');
      $('.nav > li > a').css('display','inline');
      }else{
      $('.nav > li').css('display','block');
      $('.nav > li > a').css('display','block');
      }
      
      <?php if($_SESSION["rtl"]){ ?>
      if($(window).width()>970) $('.sbar').css('float','right');
      else $('.sbar').css('float','none');
      <?php } ?>
  try {setWidthHeight();}catch(err){}     
}).resize();

<?php include("reFunctions.php"); ?>
function silentErrorHandler() {return true;}
window.onerror=silentErrorHandler;

</script>
	
</head>

<body>
    <?php $mapMode=false; if(($ptype=="showOnMap" && $_GET['fullscreen']=="true") || $fullScreenEnabled=="true") $mapMode=true; ?>
 <div class="navbar <?php if($fixedtopheader=="yes") print "navbar-fixed-top"; ?> navbar-default" >
    <div class="menuside pull-right"><ul class="nav navbar-nav pull-right"><li><a href="rss.php"><img style='border:0;' src="images/rss.png" alt='rss'></a></li>
    <?php 
    if($isThisDemo=="yes"){
    if(!$_SESSION['rtl']){ ?><li><a href="" class="label">RTL</a></li><?php }
    else{ ?><li><a href="" class="label label-important">LTR</a></li><?php } 
    }
    ?>
    </ul></div>
	
	<?php 
		$brandShown=false; 
		if($mapMode){
			$navBarStyle1=' style="margin-right:100px;" ';
			?>
			<div class="container" style='width:100%;' >
			<?php 
			if(trim($readmin_settings['websitelogo'])!=""){ 
			?>
				<div id='logo'><a style="margin-left:5px;" href="<?php print $full_url_path; ?>"><img src='uploads/<?php print $readmin_settings['websitelogo']; ?>' alt='<?php print $reSiteName; ?>' /></a></div>
			<?php 
			}else{ 
			?>
				<!--<a class="navbar-brand" style="margin-left:5px;" href="<?php //print $full_url_path; ?>"><?php //print $reSiteName; ?></a>-->
		<?php  
			} $brandShown=true; 
		} ?>
	
	<?php 
	if(!$brandShown)
	{ 
	?>
    	<div class="container"> 
	<?php  
	} 
	?>
	    <!--
	<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	</button>
	-->
	<?php 
	if(!$brandShown){ 
		 if(trim($readmin_settings['websitelogo'])!=""){ ?>
		   <div id='logo'><a href="<?php print $full_url_path; ?>"><img src='uploads/<?php print $readmin_settings['websitelogo']; ?>' alt='<?php print $reSiteName; ?>' /></a></div>
		   <?php 
		 }else{ 
		 ?>
	       <!--<a class="navbar-brand" href="<?php// print $full_url_path; ?>"><?php// //print $reSiteName; ?></a>--> 
	<?php 
		} 
	} ?>
	<?php  
	if(trim($toplinkad)!=""){ ?>
   		<div style="float:left; margin:10px auto 0 40px;" id="top_ad_menu"><?php print $toplinkad; ?></div>
    <?php 
	} ?>
    <style>
    	.right_header_ul{
			list-style-type: none; 
			margin: 0 3px 0 0; 
			padding: 0;
		}
    	.right_header_ul li{
			float:left;	
			border-left:1px solid white;
			padding: 0 5px 0 5px;
		}
		.right_header_ul li:last-child{
			padding: 0 10px 0 10px;
		}
		.right_header_ul li a{
			text-decoration:none;	
			color:#FFF;
		}
		.bs-helps-modal-lg .modal-lg{
			color: #000;
		}
		
		.bs-helps-modal-lg .modal-footer{
			margin-top: 0;
		}
		.helps_items img{
			max-height: 49px;
		}
		.notice_link{
			display: none;
		}
		/*form.mgCalculator{
			display: none!important;
		}*/
		
		@media (min-width: 768px){
			.bs-helps-modal-lg .modal-lg{width: 90%;
			}
			li.helps_li{
				display: none;
			}
			#sidebar_filter,#search_filter_form{
				display: none;
			}
			.row-btn-more .btn-sm.btn-danger,.row-btn-more .btn-sm.btn-primary{
				float: right;
			}
		}
		@media (max-width: 767px){
			#tps_icon{
				display: none!important;
			}
			#search_filter_form{
				padding: 0 15px;
			}
			#search_filter_form .col-xs-12{
				border-bottom: 1px solid white;
			    margin-bottom: 10px;
			}
			.input{
				display: inline-block;
				width: 80%;
			}
			.icon{
				display: inline-block;
				width: 15%;
				float: right;
				text-align: center;
			}
			#sidebar_filter {
			    position: absolute;
			    left: 0;
			    top: 111px;
			    background: #fff;
			    color: #000;
			    z-index: 101;
			    display: none;
			    
			}
			#sidebar_filter.open{ 
				background: #fafafa;
				}
			.col_left4x,.col_right4x{
				width: 40%;
				display: inline-block;
			}
			.col_left4x input{
				border-radius: 4px;
				border: 1px solid #f1f1f1;
				width: 100%;
				padding: 10px;
			}
			.col_mid{
				width: 10%;
				display: inline-block;
			}
			.min_max{
				text-align: center;
			}
			#nw_form_filter ul{
				padding:0;
			}
			#nw_form_filter ul li{
				display: inline-block;
				list-style-type: none;
				cursor: pointer;
			}
			#nw_form_filter ul li a{
				text-align: center;
			    padding: 10px;
			    text-decoration: none;
			    display: block;
			    line-height: 20px;
			    width: 100%;
			}
			#nw_form_filter ul li.active{background-color: #183674;}
			#nw_form_filter ul li.active a{
				color: #fff;
			}
			#nw_form_filter ul li.active a:focus,#nw_form_filter ul li.active a:active{
				outline: none;
			}
			.sl_bathroom,.classification,.sl_opt,.sl_bedroom{
				display: flex;
				display: -webkit-flex; /* Safari */
			}
			.classification li,.sl_opt li{
				flex:auto;
			}
			.sl_bathroom{
				flex-wrap: wrap;
				-webkit-flex-wrap: wrap; /* Safari */
			}
			.pd_row{
				padding: 10px 0;
				border-bottom: 1px solid #fdfdfd;
			}
			.header_filter{
				background-color: #fff;
				box-shadow: 0 2px 2px rgba(0,0,0,0.15);
			}
			.classification li a{
				padding: 10px 25px;
				text-transform: uppercase;
			}
			.sl_opt li a {
				text-transform: uppercase;
			}
			.status_title{
				font-weight: 600;
			    line-height: 40px;
			    padding: 0 10px 0 10px;
			    font-size: 16px;
			}
			#nw_form_filter input[type="checkbox"]{
				display: none;
			}
			
			#nw_form_filter input[type="checkbox"]:checked + label{
				color: #fff;
				background-color: #183674;
			}
			#nw_form_filter  label{
				background-color: #fff;
				margin-right: 1px;
				margin-bottom: 5px;
				cursor: pointer;
				padding: 0px 10px!important;
				display: inline-block;
				line-height: 40px;
				width: 81px;
				text-align: center;
			}
			.more_opts_container{
				display: none;
				padding: 15px 0;
			}
			#nw_form_filter select option{
				font-weight: bold;
				font-style: italic;
			}
			table#resultTable tr{
				border: 0;
				padding: 0;
			}
			table#resultTable tbody > tr.headRow2{
				display: block;
				padding-left: 30px;
				padding-bottom: 15px;
				background: #fff;
			}
			table#resultTable tbody > tr.headRow2 td:nth-child(2){
				color: #333;
			}
			table#resultTable td.hsorting{
				padding: 0 10px;
			}
			table#resultTable tr.headRow1,table#resultTable tr#trImage{
				padding: 0 30px;
			}
			table#resultTable td{
				padding:0;
				border: 0;
			}
			table#resultTable td#image_cell{
				padding: 0;
				width: 100%!important;
			}
			table#resultTable td#image_cell #listingImage{
				width: 100%!important;
			}
			table#resultTable td#imagethump_r{
				padding: 0;
			}
			table#resultTable td#imagethump_r #listingImages{
				display: flex;
				border: 0!important;
				padding: 0;
				margin-top: 3px;
			}
			table#resultTable td#imagethump_r #listingImages img{
				margin: 0;
				width: 100%!important;
				height: auto!important;
			}
			table#resultTable td#imagethump_r #listingButtons{display: none;}
			table#resultTable td#imagethump_r #listingImages span{
				flex:auto;
			}
			table#resultTable tr#trImage td{
				display: block;
			}
			table#resultTable tr#reDescriptionRow,table#resultTable tr#reDescriptionRow{
				padding: 0;
			}
			table#resultTable tr#reDescriptionRow .listingItem{
				padding: 10px 0;
				color: #414143;
			}
			table#resultTable tr#reDescriptionRow .listingItem .reAttributes.alert-info{
				padding: 0;
				border:0;
				border-radius: 0;
				background: #0066cb;
			}
			table#resultTable tr#reDescriptionRow .listingItem h4{color:#00adef;font-weight: bold;padding:0 30px;}
			.pad_2sid{
				padding:0 30px!important;
			}
			.headRow1 td.bg-primary{background: transparent;border-bottom: 1px solid #3fc1f3!important;margin-bottom: 15px;}
			#listing_attributes .list_attr_title,.tr_attr_val b,.tr_attr_val span{
				color: #fff!important;
				font-weight: 300;
			}
			.marg_2sid{margin:0 15px!important;}
			tr.tr_attr_val{
				padding: 0 90px!important;
			}
			img#compareimg,#hd_field{
				display: none;
			}
			.pd_more{
				border-top: 1px solid #fff!important;
				margin: 0 30px!important;
			}
			tr#trMapwrap{margin: 0 30px;}
			td#tdmap_wrap iframe{
				width: 100%;
			}
			#tile-container{
				width: 100%!important;
			}
			div#root-card,#above-map.active,#scroll-menu.scrollable{
				top:320px!important;
			}
			#map-frame{height: 300px!important;}
			.scrollable .items{
				width: 100%!important;
			}
			#root-card .header,.two-line .menu-item h3, .two-line .menu-item h4 {
			color: #fff;}
			div.reContactInformation{
				position: relative;
				border:0;
				background-color: #fff!important;
				color: #414143!important;
			}
			.recontact_image{position: absolute;bottom: -35px;right: 30px;}
			.recontact_image a.listingcontact{
				font-size: 14px!important;font-weight: 300!important;
			}
			.nonCommercial {
			    margin-bottom: 10px;
			    border-bottom: 1px solid #fff;
			    padding-bottom: 30px;
			}
			#resultTable thead,#reResults2 #resultTable tr.headRow2{
				display: none;
			}
			#reResults .reHeading1{background: #fff;text-transform: uppercase;color: #414143;}
			#reResults #new_row_st,#reResults #new_row_st > td{display: block;}
			#reResults .overlayContainer img.img-thumbnail{
				width: 100%!important;
				background:transparent;
				border:0;
				height: auto!important;
			}
			tr#new_row_st .listingRow.row,tr#new_row_st .listingRow.row .bd_rom{ background-color: #1a75bc; }
			tr#new_row_st .listingRow.row .bd_rom{
				padding: 5px 15px;
				color: #fff;
				font-weight: bold;
			    margin-bottom: 15px;
			}
			tr#new_row_st .listingRow.st1,tr#new_row_st .listingRow.row .sty_nleft{
				background-color: #fff;
			}
			tr#new_row_st .listingRow .listingPricebt,.listingSubtype{display: inline!important;float: right;}
			.listingRow .head1 .listingPrice,.listingRow .listingAddress{display: none;}
			tr#new_row_st .listingRow .listingClassification,.listingType{display: inline;}
			tr#new_row_st .listingRow.st1.row .sty_nleft{border-right: 15px solid #fff;}
			tr#new_row_st .listingRow.row .sty_nleft{border-right: 15px solid #1a75bc;}
			tr#new_row_st .listingRow.row .head1 .listingAddresstop{display: block!important;margin:0 15px 10px;border-bottom: 1px solid #1a75bc;line-height: normal;}
			.head1 .listingTitle{ margin-bottom: 0;text-align: center;font-weight: 700; }
			.listingPricebt{font-size: 20px;font-weight: 700;color:#1a75bc;}
			.listingAddresstop{
				font-size: 18px;text-align: center;text-transform: uppercase;font-weight: 700; 
			}
			.bg-primary span.listingTitle{text-transform: uppercase;}
			tr#trMapwrap{margin: 0;background-color: #fff;padding: 0 15px;}
			.listingRow .row-btn-more{text-align: center;padding: 0;}
			.listingRow a.moreInfo{
				color: #fff;
			    background-color: #27aae2!important;
			    border-color: #27aae2!important;
			    margin-bottom: 10px;
			    float:none;
			}
			#resultTable tr.headRow1 .hiddtd,#resultTable tr.headRow1 .shownumResults{display: none;}
			tr#trMapwrap td#tdmap_wrap{padding: 0 20px;}
			
			tr.trpagination > td{text-align: center;padding: 0 30px!important;}
			table#resultTable td#image_cell #listingImage img{
				height: auto!important;
			}
			.listingItem.pd_30,.reHeading1.pd_30{margin: 0 30px 10px;padding: 0!important;border-bottom: 1px solid #3fc1f3!important;}
			.headRow1 td.bg-primary i,tr#reDescriptionRow .listingItem i,.reHeading1 i,.reContactInformation i{display: inline-block!important;margin-right: 15px;font-size: 22px;}
			b.titl_upcase{text-transform: uppercase;}
			.list_attr_title{margin-top: 15px!important;}
			.recontact_info{border-top: 1px solid #3fc1f3!important;}
			.listingItem.pd_30 b,.reHeading1.pd_30,.reContactInformation b.titl_upcase{
				font-size: 20px;font-weight: 500;
			}
			#sidebar{position: relative;}
			#sidebar #hideSidebar{position: absolute;
				bottom: 5px;
				left: 50%;
				transform: translateX(-50%);
			}
			.head_titl_line{padding-bottom: 0!important;}
			.desc_row {padding-top: 0!important;}
			.headnavrow .col-xx2{
				margin: 5px 0;
				cursor: pointer;
				text-align: center;
				width: 17%;
				float: left;
			}
			.headnavrow .col-xx2 i{display: block;font-size: 20px;}
			.navbar.navbar-default.visible-xs{margin-bottom: 0!important;}
			.col-xx2 a{
				color: #fff;
			}
			.col-xx2 a:hover,.col-xx2 a:focus,.col-xx2 a:active{
				color: #fff;
				text-decoration: none;
			}

		}
		@media (min-width: 600px) and (max-width: 767px){
			.mapInfoPic{
				width: 48%;
			    height: inherit;
			}
			.mapInfoPic img{
				height: auto!important;
				max-height: 150px;
			}
		}
		@media (min-width: 480px) and (max-width: 599px){
			.gm-style-iw .markerInfo h4{
				font-size: 18px;
			}
			.mapInfoText{
				width: 100%!important;
				height: auto;
				font-size: 14px;
			}
			.markerInfo .gm-style-iw .markerInfo .mapInfoPic{
				width: 100%!important;
				height: auto!important;
			}
			.gm-style .gm-style-iw{
				width: 100%!important;
			}
			.mapInfoPic img{
				width: 100%;
				height: auto;
			}
			.mapInfoPic > div {
				bottom: 0;
				width: 95%;
				background: #fff;
				margin-left:0!important;
			}
			.mapInfoPic > div a{
				float: none!important;
			}
			.properties_similar_items{
				width: 100%!important;
			}
			.properties_similar_items .property-box-simple{
				min-height: 0!important;
			}
			.listingRow .listingSmallImage, .listingRow .sty_nleft{
				width: 100%!important;
			}
			tr#new_row_st .listingRow.row .sty_nleft {
			    border-left: 15px solid #1a75bc;
			}
			tr#new_row_st .listingRow.st1.row .sty_nleft {
			    border-left: 15px solid #fff;
			    border-right: 15px solid #fff;
			}
			.markerInfo h5{
				font-size: 18px;
			}
			.tag_c,.tag_p{
				position: static!important;
				display: inline-block;
				margin-right: 7px;
			}
			
		}
		@media (max-width: 500px){
			.boxinfo {
			    transform: translate(22%,5%);
			}
			.tag_c,.tag_p{
				display: inline-block;
				position: static!important;
				margin-right: 7px!important;
			}

			
		}
		@media (max-width: 501px) and (max-width: 599px){
			.markerInfo h5{
				font-weight: bold;
			}
			
		}
		@media (min-width: 600px) and (max-width: 767px){
			.boxinfo{
			    transform: translateX(10%);
			}
			.markerInfo h4{
				margin-top: 15px;
			}
		}
		@media (max-width: 600px){
			.tab_stats ul.nav li,.tab_stats ul.nav li a{
				display: block!important;
				width: 100%!important;
			}
			.tag_c,.tag_p{
				position: static;
			}
		}
		@media (min-width: 350px) and (max-width: 479px){
			.at-share-tbx-element .at-icon-wrapper,.at-icon{
				width: 28px!important;
				height: 28px!important;
			}
			.right_header_ul img{
				display: none;
			}
			.helps_items{
				width: 100%;
			}
			.markerInfo h5{
				font-size: 16px;
				font-weight: 700;
			}
			.mapInfoPic{
				width: 100%!important;
				height: auto!important;
			}
			.gm-style .gm-style-iw{
				height: auto!important
			}
			.gm-style img{
				width: 100%;
				height: auto;
			}
			.right_header_ul li {
				margin-left: 2px!important;
			}
			.right_header_ul li i{
				display: none;
			}
			.right_header_ul li b{
				font-size: 12px;
			}
			.listingRow .listingSmallImage,.listingRow .sty_nleft{
				width: 100%!important;
			}
			tr#new_row_st .listingRow.row .sty_nleft{
				border-left: 15px solid #1a75bc;
			}
			tr#new_row_st .listingRow.st1.row .sty_nleft{
				border-left: 15px solid #fff;
				border-right: 15px solid #fff;
			}
			tr.tr_attr_val{
				padding: 0 60px!important;
			}
			.properties_similar_items{
				width: 100%!important;
			}
			.properties_similar_items .property-box-simple{
				min-height: 0!important;
			}
			.single-property h1.page-header.page_header_first .page_header_title{
				margin-bottom: 30px!important;
			}
			.single-property .header_virtual_tour{
				top:50px!important;
				left: 45px!important;
			}
			.boxinfo {
			    transform: translate(28%,-75%);
			}
		}
		@media (min-width: 320px) and (max-width: 349px){
			.right_header_ul li{
				margin-left: 0px!important;
			}
			.right_header_ul li i{
				display: none;
			}
			.right_header_ul li b{
				font-size: 11px;
			}
			.gm-style .gm-style-iw{
				width: 350px!important;
				height: auto!important;
			}
			.boxinfo{
			    transform: translate(25%,10%);
			}
			.gm-style-iw .markerInfo span.label.label-info{
				margin-right: 10px!important;
				margin-bottom: 5px;
				display: inline-block;
			}
			.btn-sm.btn-info,.btn-sm.btn-primary{
				padding: 5px 3px!important;
			}
			#sidebar_filter .sl_bathroom label{
				width: 71px;
			}
			.listingRow .listingSmallImage,.listingRow .sty_nleft{
				width: 100%!important;
			}
			tr#new_row_st .listingRow.row .sty_nleft{
				border-left: 15px solid #1a75bc;
			}
			tr#new_row_st .listingRow.st1.row .sty_nleft{
				border-left: 15px solid #fff;
				border-right: 15px solid #fff;
			}
			tr.tr_attr_val{
				padding: 0 60px!important;
			}
			tr.trpagination > td{
				padding: 0 10px!important;
			}
			#new_row_st .container-fluid{
				padding:0!important;
			}
			.properties_similar_items{
				width: 100%!important;
			}
			.properties_similar_items .property-box-simple{
				min-height: 0!important;
			}
			.single-property h1.page-header.page_header_first .page_header_title{
				margin-bottom: 30px!important;
			}
			.single-property .header_virtual_tour{
				top:50px!important;
				left: 45px!important;
			}
			#rememberAction .tab_stats ul.nav-tabs li a{
				padding: 5px!important;
			}
			#sidebar{
				margin-top: 0!important;
			}
			.markerInfo h5{
				font-weight: 700;
				margin-bottom: 0;
			}
			.gm-style-iw .markerInfo font{
				font-size: 13px!important;
				position: relative;
			}
			.at-share-tbx-element .at-icon-wrapper,.at-icon{
				width: 22px!important;
				height: 22px!important;
			}
			.tag_c,.tag_p{
				position: static!important;;
			}
		}
		@media (min-width: 480px) and (max-width: 767px){
    		.bs-helps-modal-lg .modal-dialog.modal-lg {
			    /* margin: 0; */
			    position: absolute;
			    top: 50%!important;
			    /* left: 50%!important; */
			    transform: translateY(-50%)!important;
			}
			.modal-content .helps_items.col-sm-4{
				width: 50%;
			    padding: 0;
			    float: left;
			}
			.properties_similar_items{
				width: 100%!important;
			}
			.single-property h1.page-header.page_header_first .page_header_title{
				margin-bottom: 30px!important;
			}
			.single-property .header_virtual_tour{
				top:30px!important;
				left:45px!important;
			}
		}
		.markerInfo{
			position: relative;
		}
		.head_nav_fixed{
			/*position: fixed;
			top: 0*/
		}
		.head_nav_fixed i{
			margin-right: 5px;
		}
		.a_block .type-small .property-small:first-child{
			padding-top: 15px;
		}
		
    </style>
    <!-- my headnav -->
    <div class="navbar navbar-default visible-xs">
	  <div class="container">
	    <div class="headnavrow">
    	  <div class="col-xx2">
    	  <a href="/homula-mobile">
    	  	<i class="fa fa-arrow-left" aria-hidden="true"></i>
	        <span>Back</span>
    	  </a>
	      </div>
	      <div class="col-xx2">
	      	<a href="/realestate-search/index.php?onmap=1">
	      		<i class="fa fa-map-marker" aria-hidden="true"></i>
	        	<span>Map</span>
	      	</a>
	      </div>
	      <div class="col-xx2" id="select-search-options-top">
	        <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
	        <span>Filter</span>
	      </div>
	      <div class="col-xx2">
	      	<a href="/realestate-search/favorites.php?ptype=home">
		        <i class="fa fa-heart" aria-hidden="true"></i>
		        <span>Save</span>
		    </a>
	      </div>
	      <div class="col-xx2">
	        <i class="fa fa-bell" aria-hidden="true"></i>
	        <span>Alerts</span>
	      </div>
	      <div class="select-search-options" id="select-search-options" style="z-index: 9999;display: none;position: absolute;background: #fff;width: 100%;top: 50px;padding: 20px;border-bottom: 1px solid #039be6;">
	        <form action="/realestate-search/index.php" method="get">
	          <input type="hidden" name="onmap" value="1">
	          <div class="form-group">
	            <select class="form-control" id="sel1" name="ctype">
	                <option value="Any">Any</option>
	                <option value="Rent">Available for rent</option>
	                <option value="Sale">Available For Sell</option>
	              </select>
	            <select class="form-control" name="reType" id="salutation">
	                <option value="Any">Any</option>
	                  <option value="Residential" selected="selected">Residential</option>
	                  <option value="Commercial">Commercial</option>
	              </select>
	              <select class="form-control" name="reBedrooms" id="bedroom">
	                <option value="1">1 Bedroom</option>
	                  <option value="2">2 Bedroom</option>
	                  <option value="3">3 Bedroom</option>
	                  <option value="4">4 Bedroom</option>
	                  <option value="5">5 Bedroom</option>
	                  <option value="6">&gt; 6 Bedroom</option>
	              </select>
	              <select class="form-control" name="reBathrooms" id="bathroom">
	                <option value="1">1 Bathroom</option>
	                <option value="1.5">1.5 Bathroom</option>
	                <option value="2">2 Bathroom</option>
	                <option value="2.5">2.5 Bathroom</option>
	                <option value="3">3 Bathroom</option>
	                <option value="3.5">3.5 Bathroom</option>
	                <option value="4">4 Bathroom</option>
	                <option value="4.5">4.5 Bathroom</option>
	                <option value="5">5 Bathroom</option>
	                <option value="5.5">5.5 Bathroom</option>
	                <option value="6">&gt; 6 Bathroom</option>
	              </select>
	              <select class="form-control" name="rePrice" id="price">
	                <optgroup id="rentpricen" label="Rent / Lease">
	                  <option class="rent_options" value="0-400">$0 - $400</option>
	                  <option class="rent_options" value="400-800">$400 - $800</option>
	                  <option class="rent_options" value="800-1000">$800 - $1000</option>
	                  <option class="rent_options" value="1000-1200">$1000 - $1200</option>
	                  <option class="rent_options" value="1200-1500">$1200 - $1500</option>
	                  <option class="rent_options" value="1500-2000">$1500 - $2000</option>
	                  <option class="rent_options" value="2000-2500">$2000 - $2500</option>
	                  <option class="rent_options" value="2500-Above">$2500 - Above</option>
	                </optgroup>
	                <optgroup id="sellpricen" label="Sale">
	                  <option value="0-50K">$0 - $50K</option>
	                  <option value="50K-100K">$50K - $100K</option>
	                  <option value="100K-250K">$100K - $250K</option>
	                  <option value="250K-500K">$250K - $500K</option>
	                  <option value="500K-750K">$500K - $750K</option>
	                  <option value="750K-1M">$750K - $1M</option>
	                  <option value="1M-Above">$1M - Above</option>
	                </optgroup>
	            </select>
	          </div>
	          <button id="btn-search-options-1" class=" btn btn-primary" type="submit"><i class="fa fa-map-marker" aria-hidden="true"></i>Search</button>
	          <a href="http://realestate.homula.com/realestate-search/" id="pro_info" class=" btn btn-primary">Properties Info</a>
	          <a id="btn-mre-options" class="btn btn-primary">More Options</a>
	          <div class="more_option_contain">
	            <div class="form-group">
	              <input type="text" class="form-control" placeholder="Address" id="moreaddress" name="city">
	            </div>
	            <div class="form-group">
	              <select class="form-control" id="moresubtype" name="subtype">
	                <option value="">Select Subtype</option>
	                  <option value="Apartment">Apartment</option>
	                  <option value="Crawl Space">Crawl Space</option>
	                  <option value="Fin W/O">Fin W/O</option>
	                  <option value="Finished">Finished</option>
	                  <option value="Full">Full</option>
	                  <option value="Half">Half</option>
	                  <option value="Other">Other</option>
	                  <option value="Part Bsmt">Part Bsmt</option>
	                  <option value="Part Fin">Part Fin</option>
	                  <option value="Sep Entrance">Sep Entrance</option>
	                  <option value="Unfinished">Unfinished</option>
	                  <option value="W/O">W/O</option>
	                  <option value="Walk-Up">Walk-Up</option>
	                </select>
	              </div>
	              <div class="form-group">
	                <select class="form-control" name="sl_from" id="more_from">
	                  <option>Select From</option>
	                  <option value="VOW">VOW</option>
	                  <option value="IDX">IDX</option>
	                </select>
	              </div>
	            </div>
	        </form>
	       </div><!-- END .select-search-options -->
	      <div class="navbar-header-1">
	        <nav role="navigation">
	            <div class="container-fluid">
		            <div class="navbar-header">
		              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarnew" aria-expanded="false" aria-controls="navbarnew">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		              </button>
		            </div>
		            <div id="navbarnew" class="navbar-collapse collapse">
		              <ul class="nav navbar-nav nav-option pull-right">
		              	<li><a href="">Home</a></li>
		              	<li><a href="">Top Properties</a></li>
		              	<li><a href="">Top Agents</a></li>
		              	<li><a href="">News</a></li>
		              	<li><a href="">About Us</a></li>
		              	<li><a href="">Contact Us</a></li>
		              	<li><a href="">Sign In/ Sign Out</a></li>
		              </ul>
	              	</div>
          	    </div>
      	    </nav>
  	       </div>
       	</div>
       </div>
    </div>
	              <!-- end my navebar -->
    <div class="head_nav_fixed" style="float:left; width:100%; line-height:50px">
    	<!--<div style="width:75px; float:right;"><span style="border-left:1px solid white; border-right:1px solid white; padding:10px 4px"><b><a style="text-decoration:none; color:#FFF;" data-toggle="modal" href="#myModal"><img src="images/markers/silh-white.png" height="20" width="20" />Login</a></b></span></div>
        <div style="width:155px; float:right;""><span style="border-left:1px solid white; padding:10px 4px"><b>Compare Property</b></span><img style="padding-left:2px" src="images/markers/header_compare_empty.png" height="25" width="30" /> <span></span></div>
        <div style="float:right;"><span style="border-left:1px solid white;"><a href="favorites.php?ptype=home&" style="color:#FFF;"><b>Your Favorites</b></span><img src="images/black-heart.png" height="35" width="35" /></a></div>
        -->
        <?php
		$checkurlstr = explode("/",$_SERVER['REQUEST_URI']);
		$checkurlstrname = end($checkurlstr);
		?>
        <div style="display: block; float:left" id="tps_icon">
        	<?php
        	if($ptype != 'home' && $checkurlstrname != 'compare.php' && !in_array('commercial', $checkurlstr) && !in_array('condo', $checkurlstr) && !in_array('residential', $checkurlstr))
			{
			?>
        		<div style="width:110px; display: inline-block; padding-left:10px"><a style="text-decoration:none; color:white" href="http://realestate.homula.com/"> <img src="images/homeredirect.png" height="35" width="35" style="margin-right:3px"><span><b>Home</b></span></a></div>
            <?php
			}
			else
			{
			?>
            	<div style="width:120px; display: inline-block; padding-left:10px"><a style="text-decoration:none; color:white" href="<?php echo $RedirectMainPath;?>"> <img src="images/BackArrow.png" height="35" width="35" style="margin-right:3px"><span><b>Go Back</b></span></a></div>
            <?php
			}
			?>
            <div style="display:inline-block; width:190px"><a class='btn btn-primary btn-large' href='<?php echo $RedirectMainPath;?>'><i class='icon-map-marker'></i> Switch to Map Search</a></div>
            <div style="width:100px; display: inline-block;"><img src="images/w.png" height="50" width="50"> <span><b>1-9</b></span></div>
	        <div style="width:110px; display: inline-block;"><img src="images/t.png" height="50" width="50"> <span><b>10-99</b></span></div>
	        <div style="width:110px; display: inline-block;"><img src="images/e.png" height="50" width="50"> <span><b>100-∞</b></span></div>
	        <div style="width:140px; display: inline-block;"><img src="images/markers/house-a.png" height="35" width="35"> <span><b>Residential</b></span></div>
	        <div style="width:140px; display: inline-block;"><img src="images/markers/industry-c.png" height="35" width="35"> <span><b>Commercial</b></span></div>
	        <div style="width:170px; display: inline-block;"><img src="images/q.png" height="35" width="35"> <span><b>Condo/Apartment</b></span></div>
            <div style="width:150px; display: inline-block; cursor:pointer" onClick="javascript:changespeechvar();">
            	<input type="hidden" name="defspeechvar" id="defspeechvar" value="0" />
                <img src="images/speechimg2.png" height="35" width="35"> <span id="speechspn"><b>Voice Search</b></span>
            </div>
            <script>
			function changespeechvar()
			{
				var speechvar = $('#defspeechvar').val();
				if(speechvar == 0)
				{
					$('#defspeechvar').val(1);
				}
				else if(speechvar == 1)
				{
					$('#defspeechvar').val(0);
				}
				enabledisablespeech();
			}
			</script>
	        <!--<div style="width:120px; display: inline-block; "><img src="images/markers/gardenhome-b.png" height="35" width="35"> <span><b>Finished</b></span></div>
	        <div style="width:140px; display: inline-block; "><img src="images/markers/agricultural-a.png" height="35" width="35"> <span><b>Unfinished</b></span></div>
	        <div style="width:150px; display: inline-block; "><img src="images/markers/shared-a.png" height="35" width="35"> <span><b>Sep Entrance</b></span></div>
	        <div style="width:100px; display: inline-block; "><img src="images/y.png" height="35" width="35"> <span><b>Multiple</b></span></div>-->
	        <!--<div class="clearfix"></div>-->
        </div>
        <div style="width:auto; float:right;">
        	<ul class="right_header_ul">
        		<?php
				if($ptype != 'home' && $checkurlstrname != 'compare.php' && !in_array('commercial', $checkurlstr) && !in_array('condo', $checkurlstr) && !in_array('residential', $checkurlstr))
				{
				?>
                    <li> 
                    	<a data-toggle="modal" href="#helppopup" data-dismiss="modal"><span style="font-weight:bold; font-size:16px; padding-right:10px;">?</span></a>
                    	<a><img id="mapzoomin" src="images/zoomin.png" title="Zoom In" style="cursor:pointer; width:25px; height:25px"></a>
                    </li>
                    <li><a><img id="mapzoomout" src="images/zoomout.png" title="Zoom Out" style="cursor:pointer; width:25px; height:25px"></a></li>
                    <li><a><img id="mapleft" src="images/mapleft.png" title="Left" style="cursor:pointer"></a></li>
                    <li><a><img id="mapright" src="images/mapright.png" title="Right" style="cursor:pointer"></a></li>
                    <li><a><img id="maptop" src="images/maptop.png" title="Top" style="cursor:pointer"></a></li>
                    <li><a><img id="mapbottom" src="images/mapbottom.png" title="Bottom" style="cursor:pointer"></a></li>
                <?php
				}
				?>
                <li style="border-left:0 ;" class="helps_li"><a href="" data-toggle="modal" data-target="#helps-modal" ><i class="fa fa-question-circle" aria-hidden="true"></i></i><b>Help</b></a></li>
            	<li><a href="favorites.php?ptype=home&" style="color:#FFF;"><i class="fa fa-heart" aria-hidden="true"></i><b>Your Favorites</b></span><!-- <img src="images/black-heart.png" height="35" width="35" /> --></a></li>
            	<li><a href="compare.php" style="color:#FFF;"><i class="fa fa-home" aria-hidden="true"></i><b>Compare Property</b></span><!-- <img style="padding-left:2px" src="images/markers/header_compare_empty.png" height="25" width="30" /> --></a></li>
                <li><b><a style="text-decoration:none; color:#FFF;" data-toggle="modal" href="#myModal"><i class="fa fa-user" aria-hidden="true"></i><!-- <img src="images/markers/silh-white.png" height="20" width="20" /> -->Login</a></b></li>
            </ul>
        </div>
        <style>
			.right_header_ul li{
				border-left:none !important;	
			}
		</style>
        <div class="modal fade bs-helps-modal-lg" id="helps-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Helps</h4>
		      </div>
		      <div class="modal-body">
		        <div class="helps_items col-sm-4" ><img src="images/w.png" height="50" width="50" /> <span><b>1-9</b></span></div>
                <div class="helps_items col-sm-4" ><img src="images/t.png" height="50" width="50" /> <span><b>10-99</b></span></div>
		        <div class="helps_items col-sm-4" ><img src="images/e.png" height="50" width="50" /> <span><b>100-&infin;</b></span></div>
		        <div class="helps_items col-sm-4" ><img src="images/markers/house-a.png" height="35" width="35" /> <span><b>Residential</b></span></div>
		        <div class="helps_items col-sm-4" ><img src="images/markers/industry-c.png" height="35" width="35" /> <span><b>Commercial</b></span></div>
		        <div class="helps_items col-sm-4" ><img src="images/q.png" height="35" width="35" /> <span><b>Condo/Apartment</b></span></div>
		        <div class="helps_items col-sm-4" ><img src="images/markers/gardenhome-b.png" height="35" width="35" /> <span><b>Finished</b></span></div>
		        <div class="col-sm-4 helps_items" ><img src="images/markers/agricultural-a.png" height="35" width="35" /> <span><b>Unfinished</b></span></div>
		        <div class="col-sm-4 helps_items" ><img src="images/markers/shared-a.png" height="35" width="35" /> <span><b>Sep Entrance</b></span></div>
		        <div class="col-sm-4 helps_items" ><img src="images/y.png" height="35" width="35" /> <span><b>Multiple</b></span></div>
		        <div class="clearfix"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="clearfix"></div>
		<!-- sfilter html -->
		<!-- <div id="search_filter_form"> 
			 <div class="col-xs-12">
			      <div class="input">
			        <span> realsearch (near map)</span>
			      </div>
			      <div class="icon">
			        <i class="fa fa-search" aria-hidden="true"></i>
			      </div>
			  </div>
			  <div class="clearfix"></div>
			</div>--><!-- end sfilter html -->
    </div>
    
    <!--<div class="pull-right top_menu">
    <ul class="nav navbar-nav"  >
    
    
    <li class='first_item <?php if($ptype=="" || $ptype=="home") print "active"; ?>'><a href='index.php'><?php print $relanguage_tags["Home"];?></a></li>
  
    <?php 
    $qrpg="select id, page_name, topmenu, footermenu from $pageTable order by page_order asc;";
    $resultpg=mysql_query($qrpg);
    if($refriendlyurl=="enabled")$contactPageLink="contact-us"; else $contactPageLink="index.php?ptype=contactus";
    while($apage=mysql_fetch_assoc($resultpg)){
           if($refriendlyurl=="enabled"){
            $pageLink=friendlyUrl($apage['page_name'],"_")."-".$apage['id'];
           }else{
            $pageLink="index.php?ptype=page&amp;id=".$apage['id'];
           }
           if($apage['topmenu']==1){
   ?>
    <li <?php if(htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8')== $apage['id']) print " class='active' "; ?>><a href='<?php print $pageLink; ?>'><?php print $apage['page_name'];?></a></li>
    <?php } 
    } ?>
    <li class='favli' id='favli' style="display:none;"><a href='#'><?php print __("Favorite");?></a></li>
    <li <?php if($ptype=="contactus") print " class='active' "; ?>><a href='<?php print $contactPageLink; ?>'><?php print $relanguage_tags["Contact us"];?></a></li>
    <!--<li class='login_link btn-primary' id='loginlink'><a href='loginForm.php'><?php print __("Login");?></a></li>-->
    <!--<li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <?php if(!isset($_SESSION['myusername'])) print __("Login"); else{ print $relanguage_tags["Welcome"];?> <b><?php print $_SESSION["myusername"]."</b>"; } ?><strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px;">
              <?php include("loginForm.php"); ?>
            </div>
          </li>
    </ul>
    <?php if($isThisDemo=="yes"){ if($ptype=="viewFullListing")$ptype2="home"; else $ptype2=$ptype; 
    if($webtheme!="") $theme_menu=ucfirst($webtheme); else $theme_menu="Themes";
    ?>
     <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php print $theme_menu; ?> Theme <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?theme=default&amp;ptype=<?php print $ptype2; ?>">Default</a></li>
          <li><a href="index.php?theme=amelia&amp;ptype=<?php print $ptype2; ?>">Amelia</a></li>
          <li><a href="index.php?theme=cerulean&amp;ptype=<?php print $ptype2; ?>">Cerulean</a></li>
          <li><a href="index.php?theme=cosmos&amp;ptype=<?php print $ptype2; ?>">Cosmos</a></li>
          <li><a href="index.php?theme=cyborg&amp;ptype=<?php print $ptype2; ?>">Cyborg</a></li>
          <li><a href="index.php?theme=flatly&amp;ptype=<?php print $ptype2; ?>">Flatly</a></li>
          <li><a href="index.php?theme=journal&amp;ptype=<?php print $ptype2; ?>">Journal</a></li>
          <li><a href="index.php?theme=readable&amp;ptype=<?php print $ptype2; ?>">Readable</a></li>
          <li><a href="index.php?theme=simplex&amp;ptype=<?php print $ptype2; ?>">Simplex</a></li>
          <li><a href="index.php?theme=slate&amp;ptype=<?php print $ptype2; ?>">Slate</a></li>
          <li><a href="index.php?theme=spacelab&amp;ptype=<?php print $ptype2; ?>">Spacelab</a></li>
          <li><a href="index.php?theme=united&amp;ptype=<?php print $ptype2; ?>">United</a></li>
          <li><a href="index.php?theme=yeti&amp;ptype=<?php print $ptype2; ?>">Yeti</a></li>
          <li><a href="index.php?theme=custom&amp;ptype=<?php print $ptype2; ?>">Custom</a></li>
        </ul>
      </li>
     </ul>
    <?php } ?> 
    </div>--> <!-- nav-collapse -->
       
    <?php if(!$brandShown){ ?></div> <!-- container --> <?php  } ?>
  
<?php if($brandShown){ ?>  </div> <!-- End Container1 --> <?php }  ?>
    </div> <!-- navbar-inner -->
 
 <!--Login Pop up---------->
 <div class="modal fade" id="helppopup" role="dialog">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                To navigate the map with voice please say the following words to the mic: Move Up, Move Down, Move Left, Move Right, Zoom In, Zoom Out
              </div>
        </div>  
    </div>
  </div>
  
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Login to realestate.homula.com</h3>
          </div>
        <div class="modal-body">
          <form method="post" action='' name="login_form">
              <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
              <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
              <p><button type="submit" class="btn btn-primary">Login</button>
                <a href="#">Forgot Password?</a>
              </p>
            </form>
        </div>
        <div class="modal-footer">
            New To realestate.homula.com?
            <a data-toggle="modal" href="#myModalregister" data-dismiss="modal" class="btn btn-primary">Register</a>
          </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="myModalregister" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Register to realestate.homula.com</h3>
          </div>
        <div class="modal-body">
          <form method="post" action='' name="register_form">
          	  <p><input type="text" class="span3" name="eid" id="name" placeholder="Name"></p> 	
              <p><input type="text" class="span3" name="eid" id="phone_number" placeholder="Phone Number"></p> 	
              <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
              <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
              <p><button type="submit" class="btn btn-primary">Register</button></p>
            </form>
        </div>
      </div>
      
    </div>
  </div>
  <script src="https://code.highcharts.com/highcharts.js"></script>
<!--<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>-->
  <style>
  .modal-body textarea, .modal-body input[type="text"], .modal-body input[type="password"], .modal-body input[type="email"]{
    background-color: #ffffff;
    border: 1px solid #cccccc;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border linear .2s, box-shadow linear .2s;
    -moz-transition: border linear .2s, box-shadow linear .2s;
    -o-transition: border linear .2s, box-shadow linear .2s;
    transition: border linear .2s, box-shadow linear .2s;
	/* display: inline-block; */
    height: 20px;
    padding: 15px 6px;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 20px;
    color: #555555;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    vertical-align: middle;
	    width: 256px;
		float: none;
    margin-left: 0;
}

/*style detail page*/
#mgPrintButton,#mgResults{
	/*display: none!important;*/
}
@media (max-width: 1200px){
	#body_footer.footer .footer-bottom .container{
		width: 100%!important;
	}
	table#resultTable{
		display: block;
	}
	table#resultTable tbody{
		display: block;
	}
@media (min-width: 992px){
	.footer .footer-bottom .container, #slider .carousel-caption, .cookie-policy-inner, .cover-search{
		width: 970px!important;
	}
}
@media (min-width: 992px) and (max-width: 1199px){
	tr.headRow1{
		display: block;
	}
	tr.headRow1 > td{
		display: block;
	}
	tr#trImage,tr#reDescriptionRow,tr#reDescriptionRow > td{
		display: block;
	}
	.listingItem div{
		width: 100%!important;
	}
	#map-wrapper{
		width: 275px!important;
	}
	tr#trMapwrap,td#tdmap_wrap{
		display: block;
	}
	#tdmap_wrap iframe{
		width: 100%!important;
	}
}
@media (max-width: 991px){
	.footermenu img{
		width: 100%;
	}
	.footer-bottom{
		 background-color: #0a368a !important;
	 }
	 .listingItem div{
		width: 100%!important;
	}

}
@media (min-width: 768px){
	.footer .footer-bottom .container, #slider .carousel-caption, .cookie-policy-inner, .cover-search{
		width: 750px!important;
	}
	#showSidebar{
		display: block;
	    width: 200px;
	    position: absolute;
	    left: calc((100% - 260px) / 2);
	}
	.nav.navbar-nav.nav-option {
	    width: 100%;
	    /* border-top: 3px solid #0074e4; */
	    margin: 0;
	    box-sizing: border-box;
	    padding-left: 0px!important;
	    padding-top: 20px;
	    padding-bottom: 20px;
	}
}
@media (max-width: 767px){
	#sidebar{
		margin-top: 0!important;
	}
	tr.headRow1{
		display: block;
	}
	tr.headRow1 > td{
		display: block;
	}
	tr#trImage,tr#reDescriptionRow,tr#reDescriptionRow > td{
		display: block;
	}
	.listingItem div{
		width: 100%!important;
	}
	table#listing_attributes,table#listing_attributes tr,table#listing_attributes tr td{
		display: block;border: 0;
	}
	#tdmap_wrap iframe{
		width: 100%!important;
	}
	#sidebar1 {
		padding-top: 15px;
		border: 0;
		border-radius: 0;
		background: #0066cb; /* For browsers that do not support gradients */
		background: -webkit-linear-gradient(left,#0066cb,#00adef); /*Safari 5.1-6*/
		background: -o-linear-gradient(right,#0066cb,#00adef); /*Opera 11.1-12*/
		background: -moz-linear-gradient(right,#0066cb,#00adef); /*Fx 3.6-15*/
		background: linear-gradient(to right, #0066cb,#00adef); /*Standard*/
	}
	#sidebar1 .listings_tit{
		color: #fff;
		text-transform: uppercase;
	}
	#sidebar1 .ui-state-default{
		position: relative;
		background: #fff;
		border:0;
		color: #0265cd;
		background-image: none;
	}
	#sidebar1 .ui-state-default span{
		line-height: 30px;
	}
	#sidebar1 .ui-state-default .ui-icon{
		background-image: none;
	}
	#sidebar1 .ui-state-default:after{
		position: absolute;
	    right: 15px;
	    font-family: FontAwesome;
	    content: "\f107";
	    font-size: 22px;
	    line-height: 30px;
	    display: inline-block;
	    padding-right: 3px;
	    vertical-align: middle;
	}
	#showSidebar{
		display: block;
	    width: 285px;
	    position: absolute;
	    left: calc((100% - 300px) / 2);
	}
	.navbar-collapse.in >ul{display: block;width: 100%;}
	#navbarnew ul.nav li,#navbarnew ul.nav li a{
		display: block!important;
		color: #fff;
	}
	#navbarnew ul.nav li a:hover{
		background-color: #00adef;
	}
	.navbar-default .headnavrow .navbar-toggle:hover,.navbar-default .headnavrow .navbar-toggle:focus{
		background-color:transparent;
		border-color: #00adef;
	}
	.navbar-default .headnavrow .navbar-toggle:hover span.icon-bar, .navbar-default .headnavrow .navbar-toggle:focus span.icon-bar{background-color: #00adef;}
	 .navbar-default .headnavrow .navbar-toggle,.navbar-default .headnavrow .navbar-toggle .icon-bar{border-color: #fff;}
	 #reForm button.bd_w_btn{
		background: transparent;border: 1px solid #fff;font-weight: 700;
	}
}
@media (max-width: 599px) {
	.headnavrow .col-xx2{width: 15%;}
}   
  </style>
<script>
function goBack() {
    window.history.back();
}

jQuery(document).ready(function(){
    jQuery('#select-search-options-top').click(function(){
        jQuery('.select-search-options').toggle('fold');
    });
});
</script>