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
<div id='wrapper'>
<div class='<?php print $containerClass; ?>' >
<?php 
if(($ptype=="" && $fullScreenEnabled!="true") || $ptype=="home" || $ptype=="viewMemberListing" || $ptype=="viewFullListing" || ($ptype=="showOnMap"  && $fullScreenEnabled!="true") || $ptype=="adminOptions"  || $ptype=="UpdateAdminOptions" || $ptype=="allMembers" || $ptype=="contactus" || $ptype=="page" || $_GET["cpage"]==1){
if($ptype=="viewMemberListing")	$reextraMessage=" ".$relanguage_tags["your listings"]." ";
else $reextraMessage=" ".$relanguage_tags["all listings"]." ";
?>



<div class='col-md-12 col-lg-12'> 
<div class='<?php print $rowClass; ?>'>
  <div id="mainContent">
      
  	<div id='reResults'>
  	<?php if($ptype=="viewFullListing") include("viewFullListing.php"); ?>
  	
  </div>    
  </div><!-- end #mainContent -->
 </div> 
</div>

<?php
} 


?>



</div>
</div>

<?php 
//if($fullScreenEnabled!="true") 
include("footer.php"); 
?>