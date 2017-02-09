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
<?php if($ptype=="viewFullListing"){ ?>
<div class='col-md-8 col-lg-8'> 
<?php }else{?>
<div class='col-md-8 col-lg-8'> 
<?php }?>

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


<?php if($ptype=="viewFullListing"){ ?>
<div class='col-md-3 col-lg-3'>
<?php }else{?>
<div class='col-md-4 col-lg-4'>
<?php }?>
  <div id="sidebar">
  <?php if($ptype!="viewFullListing"){ ?>
  
      <div id="sidebar1">
        <div class='a_block'>
           <h3 class="listings_tit"><span id='showSidebar' class="icon-double-angle-down"></span><span id='hideSidebar' class="icon-double-angle-up"></span> Filter Search <?php //print $relanguage_tags["Search"].$reextraMessage; ?></h3>
          <?php include("reSearchForm.php"); ?>
        </div>
      </div>  <!-- end #sidebar1 -->
      
  <?php } ?> 
  <?php  if(trim($sidebarad)!=""){ ?>
  <div id='sidebarad1'><?php print $sidebarad; ?></div>
 <?php } ?>
 
 <?php if($ptype=="" || $ptype=="home" || $ptype=="viewMemberListing" || $ptype=="viewFullListing"){
        if($mortgagecalculator) include("mortgageCalculator.php"); 
       } ?>
  </div> <!-- end #sidebar -->
  <?php if($ptype=="viewFullListing"){include("our_agents.php");} ?>
  <!----mortgage calculator => Hitesh----->
  <?php //include("mortgageCalculator.php"); ?>  
  <!----mortgage calculator => Hitesh----->
 </div> 
</div>
<?php
} 
if($fullScreenEnabled=="true"){
	$CountRec	= mysql_num_rows(mysql_query("SELECT * FROM $reListingTable"));
?>
<div style="width:100%;">
 <div style="width:248px;" id='mapSidebar' >
 <div id='showbar' data-original-title="<?php print $relanguage_tags["Show the sidebar"]; ?>"></div>
 <div id="sidebar" class='ui-widget-content'>
  <div id="sidebarTabs" style="width:100% !important">
  	<div id='hidebar' data-original-title="<?php print $relanguage_tags["Hide the sidebar"]; ?>"></div>
    <!--<div style="float: right; margin-right: 8px;">
    	<a style="width:80px !important; padding: 8.7px 15px 8px 15px; text-decoration: none; background:#f6f6f6 none repeat scroll 0 0 !important; color: #3190cf !important; position: relative; top: 12px; border-top-left-radius: 6px; border-top-right-radius: 6px; border: 1px solid #fefefe !important; box-shadow: -3px 3px 0 0 #899599; border-radius: 3px; font-weight:bold; font-family:Arial" href="index.php?ptype=home&">Details</a>
    </div>-->
    <div style="float: right; margin-right: 8px;">
    	<a style="width:80px !important; color: #ffffff !important; position: relative; top: 12px; font-weight:bold; font-family:Arial"> <?php echo (30000+$CountRec);?> Rec</a>
    </div>
    <script>
    	function tab_show(tab1,tab2){
			$("#"+tab1).show();
			$("#"+tab2).hide();
		}
    </script>
    <ul id="main_filter_tab">
    <li style="width:80px !important"><a href="" onClick="tab_show('sidebar1','sidebarResults');" style="font-weight:bold;cursor:pointer;">&nbsp;Filter</a></li>
    <li style="width:80px !important;opacity:1;"><a href=""  onClick="tab_show('sidebarResults','sidebar1');" style="font-weight:bold;cursor:pointer;"><?php print __("Results"); ?></a></li>
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
  <div id='sidebarResults' style="display:none"></div>
  </div>
       
  </div> <!-- end #sidebar -->
  </div> <!-- end mapSidebar -->
<!-- new filter -->
<div id="sidebar_filter" class="search_filter_box" style="width:100%;">
<div class="col-xs-12">  
    <form id="nw_form_filter" action="index.php" method="post" name="form2">
        <div class="header_filter pd_row row">
          <div class="col-xs-4">
            <button type="button" class="btn btn-default cancel">Cancel</button>
          </div>
          <div class="col-xs-4">
            
          </div>
          <div class="col-xs-4 text-right">
             <button type="button" class="btn btn-primary apply">Apply</button>
          </div> 
          <div class="clearfix"></div>
        </div>
        <div class="city_postcode pd_row">
           
          <div class="city col_left4x" >
            <p class="status_title">City :</p>
            <input type="text" name="" value=""/>
          </div>
          <div class="min_max col_mid">
            -
          </div>
          <div class="postcode col_left4x">
            <p class="status_title">Post Code :</p>
            <input type="text" name="" value=""/>
          </div>
          <div class="clearfix"></div>
         </div> 
        <div class="classifications pd_row">
          <p class="status_title">Classification:</p>
          <ul class="classification">
            <li class="active"><a data-toggle="tab" tabindex="0" data-value="" class="selected">Any</a></li>
            <li><a data-toggle="tab" tabindex="0" data-value="buy">Buy</a></li>
            <li><a data-toggle="tab" tabindex="0" data-value="rent">Rent</a></li>
          </ul>
        </div>
        <div class="option_select pd_row">
            <p class="status_title">Select Options:</p>
            <ul class="sl_opt">
              <li class="active"><a data-toggle="tab" tabindex="0" data-value="" class="selected">Any</a></li>
              <li><a data-toggle="tab" tabindex="0" data-value="Residential">Residential</a></li>
              <li><a data-toggle="tab" tabindex="0" data-value="Commercial">Commercial</a></li>
          </ul>
        </div>
        <div class="form-group pd_row">
          <p class="status_title">Select Bedroom:</p>
          <div class="sl_bedroom">
            <input type="checkbox" id="1bed" value="">
            <label for ="1bed" class="checkbox-inline sl_bedroom_items">1</label>
            <input type="checkbox" id="2bed" value="">
            <label for ="2bed" class="checkbox-inline sl_bedroom_items">2</label>
            <input type="checkbox" id="3bed" value="">
            <label for ="3bed" class="checkbox-inline sl_bedroom_items">3</label>
            <input type="checkbox" id="4bed" value="">
            <label for ="4bed" class="checkbox-inline sl_bedroom_items">4</label>
            <input type="checkbox" id="5bed" value="">
            <label for ="5bed" class="checkbox-inline sl_bedroom_items">5</label>
            <input type="checkbox" id="6bed" value="">
            <label for ="6bed" class="checkbox-inline sl_bedroom_items">6+</label>
          </div>
        </div>
        <div class="form-group pd_row">
          <p class="status_title">Select Bathroom:</p>
          <div class="sl_bathroom">
            <input type="checkbox" id="1bath" value="">
            <label for ="1bath" class="checkbox-inline sl_bedroom_items">1</label>
            <input type="checkbox" id="1haftbath" value="">
            <label for ="1haftbath" class="checkbox-inline sl_bedroom_items">1.5</label>
            <input type="checkbox" id="2bath" value="">
            <label for ="2bath" class="checkbox-inline sl_bedroom_items">2</label>
            <input type="checkbox" id="2haftbath" value="">
            <label for ="2haftbath" class="checkbox-inline sl_bedroom_items">2.5</label>
            <input type="checkbox" id="3bath" value="">
            <label for ="3bath" class="checkbox-inline sl_bedroom_items">3</label>
            <input type="checkbox" id="3haftbath" value="">
            <label for ="3haftbath" class="checkbox-inline sl_bedroom_items">3.5</label>
            <input type="checkbox" id="4bath" value="">
            <label for ="4bath" class="checkbox-inline sl_bedroom_items">4</label>
            <input type="checkbox" id="4haftbath" value="">
            <label for ="4haftbath" class="checkbox-inline sl_bedroom_items">4.5</label>
            <input type="checkbox" id="5bath" value="">
            <label for ="5bath" class="checkbox-inline sl_bedroom_items">5</label>
            <input type="checkbox" id="5haftbath" value="">
            <label for ="5haftbath" class="checkbox-inline sl_bedroom_items">5.5</label>
            <input type="checkbox" id="6bath" value="">
            <label for ="6bath" class="checkbox-inline sl_bedroom_items">>6</label>
          </div>
        </div>
        <div class="filter_price pd_row">
          <p class="status_title">Prices:</p>
          <select class="form-control" id="price" name="pricen[]">
            <option value="">Select Price</option>
            <option value="0-50K">0$ - 50$</option>
            <option value="50K-100K">50$ - 100$</option>
            <option value="100K-250K">100$ - 250$</option>
            <option value="250K-500K">250$ - 500$</option>
            <option value="500K-750K">500$ - 750$</option>
            <option value="750K-1M">750$ - 1M</option>
            <option value="1M-Above">1M +</option>
          </select>
        </div>
        <div class="filter_bottom pd_row">
            <button type="button" class="btn btn-primary more_opts" id="btn_more_opts">More Options</button>
            <div class="more_opts_container row">
            <div class="address">
                <div class="col-xs-4">
                  <p class="status_title">Address:</p>
                </div>
                <div class="col-xs-8">
                  <input class="form-control" type="text" name="" value=""/>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="subtype">
                <div class="col-xs-4">
                  <p class="status_title">Subtype:</p>
                </div>
                <div class="col-xs-8">
                  <select class="form-control" name="sl_subtype" id="more_subtype">
                    <option>Select Subtype</option>
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
                <div class="clearfix"></div>
              </div>
              <div class="from">
                <div class="col-xs-4">
                  <p class="status_title">From:</p>
                </div>
                <div class="col-xs-8">
                  <select class="form-control" name="sl_from" id="more_from">
                    <option>Select From</option>
                    <option value="VOW">VOW</option>
                    <option value="IDX">IDX</option>
                  </select>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </form>
  </div>
</div>
<!-- end new filter -->
<div style="width:100%;" id='mapContainer'>
	<div id="mainContent" style="margin-left:315px;position:relative;">
    	<div id='mapResults'></div>
        <div id='theListing'></div>
        <div id='MapLoadingImage'><img src='images/maploading1.gif' alt='Loading map' /></div>
		<div id='modeButton'><a class='btn btn-primary btn-large'><i class='icon-align-justify'></i> Canada's top real estate search</a></div>
        <!--<div class="notice_link" style="position:fixed; right:30px; bottom:150px;"><a class="btn btn-primary btn-large" style="margin-left:5px; background-color:#183674 !important" href="< ?php print $full_url_path; ?>">< ?php print $reSiteName; ?></a></div>-->
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
<script type="text/javascript">
jQuery(document).ready(function($) {
  $("#search_filter_form").click(function(){
    gettop = $(this).offset().top;
    $("#sidebar_filter").css('top',+gettop+'px');
    $("#sidebar_filter").addClass("open");
    $("#sidebar_filter").slideDown(800);
  });
  
 $(".cancel").click(function(){
  $("#sidebar_filter").removeClass('open');
  $("#sidebar_filter").slideUp(400);
 });
 $("#btn_more_opts").click(function(){
    $(".more_opts_container").slideToggle();
 });
 $(window).scroll(function(event) {
   if($(this).scrollTop() >= gettop){
      if($("#sidebar_filter").hasClass('open')){
        $(".header_filter").css({"position":"fixed","top":"0","width":"100%","z-index":"9"});
      }
   }else{
      if($("#sidebar_filter").hasClass('open')){
      $(".header_filter").removeAttr('style');
    }
   }
 });
// onchane in new form
$('select#price').on('change', function() {
	priceval=this.value;
 	console.log(priceval);
 	$("#rePrice").val(priceval);
 	console.log($('select#rePrice').val());
});
$(".apply").click(function(){
	$(".cancel").trigger('click');
	$("#reSearchMap2").trigger('click');
});

//* get param from url*//
var param = <?php echo $_GET['onmap']?>;
  if(param = 1){
    $('#reSearchMap2').trigger('click');
  }

  
});
</script>
<?php 
//if($fullScreenEnabled!="true") 
include("footer.php"); 
?>
