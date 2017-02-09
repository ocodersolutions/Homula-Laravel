<?php 
session_start();
include_once("errorReporting.inc.php");
include("site.inc.php");

if($_SERVER['REMOTE_ADDR'] == '27.78.20.18'){
    // die($host . ' - ' . $username . ' - ' . $password);
}
 
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$aopt=mysql_fetch_assoc(mysql_query("select splashpage from admin_options;"));
if($aopt['splashpage']!="none" && !isset($_GET['ptype']) && !isset($_POST['ptype']) && !isset($_SESSION["myusername"]) && !isset($_POST['city']) && !isset($_GET['city']) ){
 if(trim($aopt['splashpage']!="")){ include("splash/".$aopt['splashpage']); exit; }   
}
mysql_close($con);

include("header.php");

$containerClass="container"; $rowClass="row";
?>

<style type="text/css">
  .right_header_ul li {
    border-left: 0 !important;
    margin-left: 10px;
  }
</style>

<div id='wrapper'>
<div class='<?php print $containerClass; ?>' >
<?php 
if(($ptype=="" && $fullScreenEnabled!="true") || $ptype=="home" || $ptype=="viewMemberListing" || $ptype=="viewFullListing" || ($ptype=="showOnMap"  && $fullScreenEnabled!="true") || $ptype=="adminOptions"  || $ptype=="UpdateAdminOptions" || $ptype=="allMembers" || $ptype=="contactus" || $ptype=="page" || $_GET["cpage"]==1){
if($ptype=="viewMemberListing")	$reextraMessage=" ".$relanguage_tags["your listings"]." ";
else $reextraMessage=" ".$relanguage_tags["all listings"]." ";
?>

<div class='<?php print $rowClass; ?>'>
<div class='col-md-5 col-lg-5'>
  <div id="sidebar">
  
  <div id="sidebar1">
  <div class='a_block'>
     <h3><span id='showSidebar' class="icon-double-angle-down"></span><span id='hideSidebar' class="icon-double-angle-up"></span><?php print $relanguage_tags["Search"].$reextraMessage; ?></h3>
    <?php include("reSearchForm.php"); ?>
  </div>
  </div>  <!-- end #sidebar1 -->
 
  <?php  if(trim($sidebarad)!=""){ ?>
  <div id='sidebarad1'><?php print $sidebarad; ?></div>
 <?php } ?>
 
 <?php if($ptype=="" || $ptype=="home" || $ptype=="viewMemberListing" || $ptype=="viewFullListing"){
        if($mortgagecalculator) include("mortgageCalculator.php"); 
       } ?>
  </div> <!-- end #sidebar -->
  
  
  
  <!----mortgage calculator => Hitesh-----!>
  <?php include("mortgageCalculator.php"); ?>  
  <!----mortgage calculator => Hitesh-----!>
  
  
 </div>
<div class='col-md-7 col-lg-7'> 
  <div id="mainContent">
      
  	<div id='reResults'>
  	<?php if($ptype=="viewFullListing") include("viewFullListing.php"); ?>
  	<?php if($ptype=="adminOptions" || $ptype=="UpdateAdminOptions") include("adminOptions.php"); ?>
    <?php if($ptype=="allMembers") include("allMembers.php"); ?> 
    <?php if($ptype=="showOnMap"  && $fullScreenEnabled!="true") print "<div id='mapResults'></div>" ?>	
    <?php if($ptype=="contactus") include("contactus.php"); ?>
    <?php if($ptype=="page"){ include("page.php"); $fullScreenEnabled="false"; } ?>
    <?php if($_GET["cpage"]==1) include("pluginPage.php"); ?>
  </div>    
  </div><!-- end #mainContent -->
 </div> 
</div>

<?php
} 

if($fullScreenEnabled=="true"){
	?>
<div style="width:100%;">

 


 <div style="width:248px;" id='mapSidebar' >
 <div id='showbar' data-original-title="<?php print $relanguage_tags["Show the sidebar"]; ?>"></div>
 <div id="sidebar" class='ui-widget-content'>
  <div id="sidebarTabs" style="width:100% !important">
  	<div id='hidebar' data-original-title="<?php print $relanguage_tags["Hide the sidebar"]; ?>"></div>
    <div style="float: right; margin-right: 10px;">
    	<a style=" padding: 0.5em 1em;text-decoration: none; background:#f6f6f6 none repeat scroll 0 0 !important; color: #3190cf !important;position: relative; top: 12px;
        			border-top-left-radius: 6px;border-top-right-radius: 6px;border: 1px solid #fefefe !important;box-shadow: -3px 3px 0 0 #899599;border-radius: 3px;" href="index.php?ptype=home&">Details</a>
    </div>
    <ul>
    <li><a href="#sidebar1"><?php print __("Search"); ?></a></li>
    <li><a href="#sidebarResults"><?php print __("Results"); ?></a></li>
    </ul>       
    
  <div id="sidebar1">
	<div class='a_block'>
	<!-- <div id="logo2"></div> -->
    <h3><?php print $relanguage_tags["Search"].$reextraMessage; ?></h3>
    <?php include("reSearchForm.php"); ?>
    </div>
    <?php  if(trim($sidebarad)!=""){ ?>
    <div id='sidebarad1'><?php print $sidebarad; ?></div>
    <?php } ?>
  </div>  <!-- end #sidebar1 -->
  <div id='sidebarResults'></div>
  </div>
       
  </div> <!-- end #sidebar -->
  </div> <!-- end mapSidebar -->



<div style="width:80%;" id='mapContainer'>
	<div id="mainContent">
    	<div id='mapResults'></div>
        <div id='theListing'></div>
        <div id='MapLoadingImage'><img src='images/maploading1.gif' alt='Loading map' /></div>
		<div id='modeButton'><a class='btn btn-primary btn-large' href='index.php?ptype=home&<?php print str_replace("ptype=", "",htmlspecialchars($_SERVER['QUERY_STRING'])); ?>'><i class='icon-align-justify'></i> <?php print $relanguage_tags["Switch to text mode"]; ?></a></div>
        <div class="notice_link" style="position:fixed; right:30px; bottom:150px;"><a class="btn btn-primary btn-large" style="margin-left:5px; background-color:#183674 !important" href="<?php print $full_url_path; ?>"><?php print $reSiteName; ?></a></div>
	</div> <!-- end span8 -->
</div>

</div> <!-- end row -->
<div class="nolisting alert alert-info"><a class="close"  onclick="$('.alert').hide()" data-dismiss="alert" href="#">x</a>
<h4 style="text-align:'center'"><?php print $relanguage_tags["No listings found for your search criteria"]; ?>.
<?php if($isThisDemo=="yes") print "The demo has limited listings."  ?> 
</h4></div>
	<?php 
}

if($ptype=="checklogin") loadPage("checklogin.php");
if($ptype=="submitReListing") loadPage("submitReListing.php");
if($ptype=="addReListing") loadPage("addReListing.php");
if($ptype=="editReListingForm") loadPage("editReListingForm.php");
if($ptype=="updateReListing") loadPage("updateReListing.php");
if($ptype=="myprofile") loadPage("myprofile.php");
if($ptype=="languagetags" || $ptype=="updateLanguageTags") loadPage("languagetags.php");
if($ptype=="categories" || $ptype=="updateCategories") loadPage("categories.php");
if($ptype=="pricerange" || $ptype=="updatePriceRange") loadPage("pricerange.php");
if($ptype=="addeditpage") loadPage("addeditpage.php");
if($ptype=="uploadcsv") loadPage("uploadcsv.php");
if($ptype=="oodle" || $ptype=="updateOodle") loadPage("plugins/oodle/options.php");
?>

<!--
<div id="a_c" style="display:none;"><?php print $authorization_code; ?></div>
<div id="p_c" style="display:none;"><?php print md5($purchase_code); ?></div>
-->

</div>
</div>

<?php 
//if($fullScreenEnabled!="true") 
include("footer.php"); 
?>