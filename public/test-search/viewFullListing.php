<?php
/*
*     Author: Ravinder Mann
*     Email: ravi@codiator.com
*     Web: http://www.codiator.com
*     Release: 1.6
*
* Please direct bug reports,suggestions or feedback to :
* http://www.codiator.com/contact/
*
* Real estate made easy is a commercial software. Any distribution is strictly prohibited.
*
*/

/*
 * Filters data through the functions registered for "viewFullListing" hook.
 * Passes an array of aruguments. $vargs[0] is the entire html listing data.
 * $vargs[1] is the entire row of data fetched from database for a particular listing id
 */
 

$vargs[0]=viewFullListing($viewListingRow,$mem_id,$showMoreListings);
$vargs[1]=$viewListingRow;

$vdata=call_plugin("viewFullListing",$vargs);
print $vdata[0];

function printDBValues($attribute,$tag,$defaultCurrency="",$texttype=""){
	
    include_once("functions.inc.php");   
    if($attribute!=""){
     if($_SESSION['currency_before_price']) {
	 	$full_attribute=$defaultCurrency.__($attribute);
	 }else{
		 $full_attribute=__($attribute)." ".$defaultCurrency;
	 }
     if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) $attrClause=" style='float:left;' ";
	 
	 if($texttype=='price'){
		$full_attribute = "$ ".number_format($full_attribute);
	 }
	 
	 
	   if($tag=="Size"){
		   print "<div class='cutsheet-detail-item'><div class='cutsheet-detail-item-label'>".__($tag)." (".__("sq-ft").")</div><div class='cutsheet-detail-item-value'>".$full_attribute."</div></div>";
		   // print "<div class='col-md-4 col-lg-4'><div><strong>".__($tag)." (".__("sq-ft")."):</strong> <span>".$full_attribute."</span></div></div>";
	   }
	   else{
		   print "<div class='cutsheet-detail-item'><div class='cutsheet-detail-item-label'>".__($tag)."</div><div class='cutsheet-detail-item-value'>".$full_attribute."</div></div>";
	      //  print "<div class='col-md-4 col-lg-4'><div><strong>".__($tag).":</strong> <span>".$full_attribute."</span></div></div>";
	   }
   
    } 
 }

function viewFullListing($viewListingRow,$mem_id,$showMoreListings=""){
  global $ptype, $reid;
  include("config.php");
  ob_start();   
  $row=$viewListingRow;
  /* Hitesh
  if($row['cats']=="ok") $catClause="<div title='".$relanguage_tags["Cats are allowed"]."'><img src='images/animals-cat-ok.png' /></div>";
  if($row['cats']=="notok") $catClause="<div title='".$relanguage_tags["Cats are not allowed"]."'><img  src='images/animals-cat-no.png' /></div>";
  if($row['dogs']=="ok") $dogClause="<div title='".$relanguage_tags["Dogs are allowed"]."'><img src='images/animals-dog-ok.png' /></div>";
  if($row['dogs']=="notok") $dogClause="<div title='".$relanguage_tags["Dogs are not allowed"]."'><img src='images/animals-dog-no.png' /></div>";
  if($row['smoking']=="notok") $smokingClause="<div title='".$relanguage_tags["Smoking is not allowed"]."'><img src='images/no-smoking.png' /></div>";
  */
  $reAllowedThings=$catClause.$dogClause.$smokingClause;
  
  if($row['user_id']!="oodle"){
    $rePicArray=explode("::",$row['pictures']);
    $totalRePics=sizeof($rePicArray);
    if ($totalRePics > $reMaxPictures) $totalRePics = $reMaxPictures;
    if($row['show_image']=="yes"){
      $qr1="select photo from $rememberTable where id='".$row['user_id']."'";
      $result1=mysql_query($qr1);
      $row1=mysql_fetch_assoc($result1);
      $poster_pic=$row1['photo']; 
    }
    if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true){
      $contactImageClause=" style='float:left;' ";
    }
    if(trim($poster_pic)!="") $contact_image="<div class='recontact_image' $contactImageClause><img src='uploads/".$poster_pic."' height='125' alt='' /></div>";
    else $contact_image="<div class='recontact_image' $contactImageClause><a style='font-weight:300;font-size: 18px;background-color: rgb(0, 170, 255);color:white;' title='".$relanguage_tags['Click above to send a message to the poster of this listing']."' href='contactPoster.php?reid=".$row['id']."' class='btn btn-default listingcontact'>Contact Agent</a></div>";
  }else{
    $rePicArray=explode("::",$row['pictures']);
    $totalRePics=sizeof($rePicArray);
    if ($totalRePics > $reMaxPictures) $totalRePics = $reMaxPictures;
    $poster_pic=$row['photo'];
    if(trim($poster_pic)!="") $contact_image="<div class='recontact_image'><img src='".$poster_pic."' height='125' alt='' /></div>";
    else $contact_image="<div class='recontact_image'><img src='images/identity.png' height='128' alt='' /></div>";
    
    require_once('geoplugin.class.php');
    $geoplugin = new geoPlugin();
    $geoplugin->locate();
    $vCountry=$geoplugin->countryName;
    $defaultCurrency=getOodleCurrency($vCountry,$defaultCurrency);
  }
  
  if($row['bedrooms']=="1den") $row['bedrooms']="1 + ".$relanguage_tags["den"];
  if($row['bedrooms']=="2den") $row['bedrooms']="2 + ".$relanguage_tags["den"];
  
  if($row['relistingby']=="owner") $row['relistingby']=$relanguage_tags["Individual"];
  if($row['relistingby']=="reagent") $row['relistingby']=$relanguage_tags["Real Estate Agent"];
  if($row['price']==0)$row['price']="";
  if($row['resize']==0)$row['resize']="";
  list($justDate,$justTime)=explode(" ",$row['dttm_modified']);
  $newDateFormat=explode("-",$justDate);
  $row['dttm_modified']=$newDateFormat[1]."/".$newDateFormat[2]."/".$newDateFormat[0];
  
  $full_address="";
  if($row['apt']!="") $full_address=$row['apt'];
  if($row['address']!="") $full_address=$full_address.", ".$row['address'];
  if($row['city']!="") $full_address=$full_address.", ".$row['city'];
  if($row['state']!="") $full_address=$full_address.", ".$row['state'];
  if($row['postal']!="") $full_address=$full_address.", ".$row['postal'];
  if($row['country']!="") $full_address=$full_address.", ".$row['country'];
  $full_address=trim($full_address,',');
  $partialAddress=$row['city'].", ".$row['postal'];
  $partialAddress=trim(trim($partialAddress),',');
  if($row['price']!="" && $currency_before_price) 
  {
    //$full_price=$defaultCurrency.number_format($row['price'])." - "; 
    $full_price=$defaultCurrency.number_format($row['price']); 
  }
  else 
  {
    $full_price="";
  }
  
  function currentPageURL() {
    $currentpageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$currentpageURL .= "s";}
    $currentpageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $currentpageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
      $currentpageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $currentpageURL;
  }
  $current_page_url = currentPageURL();
  ?>
<style type="text/css">
@media (max-width: 767px) {
.navbar-default {
	margin-bottom: 0 !important;
}
#wrapper {
	background-color: #f1f1f1 !important;
}
#wrapper > .container > .row {
	margin: 0;
}
#wrapper > .container > .row > .col-md-8 {
	padding: 0;
}
.single-property .content {
	padding-left: 15px !important;
}
#mainContent .single-property .header_virtual_tour {
	left: 15px!important;
}
/*#jssor_1 .jssort01, #jssor_1 .jssort01 div {
  max-width: 100% !important;
}
#jssor_1 > .jssort01 {
  left: -13px !important;
}
#jssor_1 .jssort01 .jssora05r {
  right: -13px !important;
}
#jssor_1 .jssort01 .jssora05l {
  left: 11px !important;
}*/

</style>

<div id='rememberAction' class="single-property"> 
  <script src="http://realestate.homula.com/wp-content/themes/realsite/assets/js/jssor.slider-21.1.6.mini.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/hstylenew.css">
  <div class="content col-sm-8 col-md-12" style="background-color:#f1f1f1;">
    <h1 class="page-header page_header_first">
      <div class="page_header_title">
        <?php 
	//print __($full_price." - ".$row['subtype'])." - ".$partialAddress; 
	if($row['address'] != '')
	{
		echo $row['address'].", ";
	}
	if($row['city'] != '')
	{
		echo $row['city'].", "; 
	}
	if($row['state'] != '')
	{
		echo $row['state'].", "; 
	}
	if($row['postal'] != '')
	{
		echo $row['postal'];
	}
	?>
        <?php if($ptype!="viewFullListing"){?>
        <div class="pull-right" id="closeMapListing" style="cursor:pointer;"><img src="images/fancy_close.png" alt="" height="20"></div>
        <?php } ?>
      </div>
      <div class="page-header-actions">
        <div class="header_virtual_tour"><a style="color:white;text-decoration:none;"  href="<?php echo $row['tour_url'];?>" target="_blank"> <i class="fa fa-eye" aria-hidden="true"></i>VIRTUAL TOUR </a></div>
        <div class="share_action"> <span>Share this:</span> <a href="https://www.facebook.com/share.php?u=<?php echo $current_page_url; ?>&amp;title=<?php echo str_replace(' ', '%20', $row['address'] ); ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="https://twitter.com/home?status=<?php echo str_replace( ' ', '%20', $row['address'] ); ?>+<?php echo $current_page_url; ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="https://plus.google.com/share?url=<?php echo $current_page_url; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="https://www.linkedin.com/cws/share?url=<?php echo $current_page_url; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo $current_page_url; ?>&is_video=false&description=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-pinterest-square" aria-hidden="true"></i></a> <a href="http://www.reddit.com/submit?url=<?php echo $current_page_url; ?>&title=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-reddit-square" aria-hidden="true"></i></a> <a href="http://del.icio.us/post?url=<?php echo $current_page_url; ?>&title=<?php echo str_replace(' ', '%20', $row['address'] ); ?>&notes=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-delicious" aria-hidden="true"></i></a> <a href="https://digg.com/submit?url=<?php echo $current_page_url; ?>&title=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-digg" aria-hidden="true"></i></a> <a href="http://www.stumbleupon.com/submit?url=<?php echo $current_page_url; ?>&title=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-stumbleupon" aria-hidden="true"></i></a> <a href="http://www.tumblr.com/share?v=3&u=<?php echo $current_page_url; ?>&t=<?php echo str_replace(' ', '%20', $row['address'] ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa  fa-tumblr-square" aria-hidden="true"></i></a> </div>
      </div>
      <div class="clr"></div>
    </h1>
    <div class="row">
      <div style="width:100%;clear:both;"></div>
      <div class="col-sm-12 col-md-12">
        <div class="galCont">
          <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 752px!important; height: 660px; overflow: block; visibility: block; background-color: #f1f1f1;">
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
              <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
              <div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" class="lightslide" style="cursor: default; position: relative; top: 0px; left: 0px; width: 752px; height: 480px; overflow: hidden;">
              <?php
      $firstDef = $SitePath.'/images/no-image.png';
        for($imgCount=0;$imgCount<$totalRePics;$imgCount++){ 
          if(trim($rePicArray[$imgCount])!=""){
            $tmpSubImages = $SitePath.'/uploads/'.$rePicArray[$imgCount]; 
                        if($imgCount == 0)
            {
              $firstDef = $tmpSubImages;  
            }
            ?>
              <div data-p="144.50"> <a href="<?php echo $tmpSubImages; ?>"> <img data-u='image'width="640" height="426" src="<?php echo $tmpSubImages; ?>" class="attachment-full size-full" alt="<?php echo $tmpSubImages; ?>" /></a><br>
                <img data-u='thumb'width="640" height="426" src="<?php echo $tmpSubImages; ?>" class="attachment-full size-full" alt="<?php echo $tmpSubImages; ?>" /> </div>
              <?
          }
        }
        ?>
            </div>
            <div data-u="thumbnavigator" class="jssort01" style="margin-top:30px;position:absolute;left:0px;bottom:0px;width:847px;height:150px;" data-autocenter="1">
              <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                  <div class="w">
                    <div data-u="thumbnailtemplate" class="t"></div>
                  </div>
                  <!--<div class="c"></div>--> 
                </div>
              </div>
              <span data-u="arrowleft" class="jssora05l" style="top:0px;left:0px;width:40px;height:150px;text-align:center;"></span> <span data-u="arrowright" class="jssora05r" style="top:0px;right:0px;width:40px;height:150px;text-align:center;"></span> </div>
          </div>
          <!--<script type="text/javascript" src="http://realestate.homula.com/wp-content/themes/realsite/js/jquery.lightbox-0.5.min.js"></script>
          <link rel="stylesheet" type="text/css" href="http://realestate.homula.com/wp-content/themes/realsite/css/jquery.lightbox-0.5.css" media="screen" />--> 
        </div>
        <div style="width:100%;clear:both;"></div>
        <div class="property-list style_padding">
          <div class="property_title_left  cutsheet-section-title" id="property_overview_div">
            <h3><i class="fa fa-check-square" aria-hidden="true"></i>Property overview</h3>
          </div>
          <div class="shadow_bottom"  id="property_overview_content">
            <div class="property_content_right">
              <div class="post_thumbnail_post"> <img src="<?php echo $firstDef;?>" style="max-width:100%;" /> </div>
              <dl >
                <dt>Price: </dt>
                <dd><?php echo $full_price;?></dd>
                <dt>Location: </dt>
                <dd>
                  <?php 
					//print __($full_price." - ".$row['subtype'])." - ".$partialAddress; 
					if($row['address'] != '')
					{
						echo $row['address'].", ";
					}
					if($row['city'] != '')
					{
						echo $row['city'].", "; 
					}
					if($row['state'] != '')
					{
						echo $row['state'].", "; 
					}
					if($row['postal'] != '')
					{
						echo $row['postal'];
					}
					?>
                </dd>
                <dt>Bedrooms: </dt>
                <dd><?php echo $row['bedrooms'];?>&nbsp;&nbsp;<img src="images/bed.png" height="20" width="20"></dd>
                <dt>Bathrooms: </dt>
                <dd><?php echo $row['bathrooms'];?>&nbsp;&nbsp;<img src="images/bath.png" height="20" width="20"></dd>
                <dt>Description: </dt>
                <dd><?php print nl2br($row['description']); ?></dd>
              </dl>
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="description style_padding">
      <div class="property_title_left cutsheet-section-title" id="advanced_features_div">
        <h3 class="page-header boldDesc"><i class="fa fa-check-square" aria-hidden="true"></i><strong>Advanced Features</strong></h3>
      </div>
      <div class="tab_stats style_padding" id="advanced_features_content">
        <ul class="nav nav-tabs">
          <!--<li><a data-toggle="tab" href="#home"  >Basic Features</a></li>-->
          <li><a data-toggle="tab" href="#menu1" id="home_a">Advanced Features</a></li>
          <!--<li><a data-toggle="tab" href="#menu2">Amenities</a></li>-->
          <li class="active"><a data-toggle="tab" href="#menu3">Calculator</a></li>
          <li><a data-toggle="tab" href="#menu4">Live Polls</a></li>
        </ul>
        <div class="tab-content"> 
          <!--<div id="home" class="tab-pane fade">
          <div class="shadow_bottom">
            <div class="property_content_right">
              <div class="property-detail-description-new">
                <div class="fieldsLeft">
                  <div class="fieldState"><strong>Province:</strong> <span class="IDX-fieldData"><?php echo $row['state'];?></span></div>
                  <div class="fieldAddress"><strong>Address:</strong> <span class="IDX-fieldData">
				  	<?php 
					//print __($full_price." - ".$row['subtype'])." - ".$partialAddress; 
					if($row['address'] != '')
					{
						echo $row['address'].", ";
					}
					if($row['city'] != '')
					{
						echo $row['city'].", "; 
					}
					if($row['state'] != '')
					{
						echo $row['state'].", "; 
					}
					if($row['postal'] != '')
					{
						echo $row['postal'];
					}
					?>
                    </span></div>
                  <div class="fieldArea"><strong>Area:</strong> <span class="IDX-fieldData">< ?php echo $row['city'];?></span></div>
                  <div class="fieldBedrooms"><strong>Bedrooms:</strong> <span class="IDX-fieldData">< ?php echo $row['bedrooms'];?></span></div>
                </div>
                <div class="fieldsRight">
                  <div class="fieldMunicipality District"><strong>Municipality District:</strong> <span class="IDX-fieldData">< ?php echo $row['city'];?></span></div>
                  <div class="fieldRent/Lease Off Season"><strong>Rent/Lease Off Season:</strong> <span class="IDX-fieldData">< ?php echo $full_price;?></span></div>
                  <div class="fieldRent/Lease Price"><strong>Rent/Lease Price:</strong> <span class="IDX-fieldData">< ?php echo number_format($row['price']);?></span></div>
                  <div class="fieldTotal Baths"><strong>Total Baths:</strong> <span class="IDX-fieldData">< ?php echo $row['bathrooms'];?></span></div>
                  <div class="fieldType"><strong>Type:</strong> <span class="IDX-fieldData">< ?php echo $row['subtype'];?></span></div>
                  <div class="fieldZoning"><strong>Zoning:</strong> <span class="IDX-fieldData">< ?php echo $row['retype'];?></span></div>
                </div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>-->
          <div id="menu1" class="tab-pane fade">
            <div class="shadow_bottom">
              <div class="property_content_right">
                <div class="property-detail-description-new">
                  <div class="cutsheet-detail-wrap striped"> <?php printDBValues($row['a_c'],"Air Conditioning");?> <?php printDBValues($row['acres'],"Acreage");?> <?php printDBValues($row['addr'],"Address");?> <?php printDBValues($row['amps'],"Amps");?> <?php printDBValues($row['appts'],"Appointments");?> <?php printDBValues($row['apt_num'],"Apt/Unit");?> <?php printDBValues($row['area_infl1_out'],"Area Influences1");?> <?php printDBValues($row['area_infl2_out'],"Area Influences2");?> <?php printDBValues($row['ass_year'],"Assessment Year");?> <?php printDBValues($row['bath_tot'],"Washrooms");?> <?php printDBValues($row['bay_size1'],"Bay Size Width");?> <?php printDBValues($row['bay_size2'],"Bay Size Length");?> <?php printDBValues($row['board'],"Board");?> <?php printDBValues($row['bph_num'],"List Broker Phone #");?> <?php printDBValues($row['br'],"Bedrooms");?> <?php printDBValues($row['br_plus'],"Bedrooms +");?> <?php printDBValues($row['bsmt1_out'],"Basement1");?> <?php printDBValues($row['bsmt2_out'],"Basement2");?> <?php printDBValues($row['type_own1_out'],"Type");?> <?php printDBValues($row['style'],"Style");?> <?php printDBValues($row['bus_type'],"Use");?> <?php printDBValues($row['cable'],"Cable TV Included");?> <?php printDBValues($row['cac'],"CAC");?> <?php printDBValues($row['cac_inc'],"CAC Included");?> <?php printDBValues($row['cctd'],"Deal Fell Through Entry Date");?> <?php printDBValues($row['cd'],"Sold Date");?> <?php printDBValues($row['ceil_ht'],"Clear Height Feet");?> <?php printDBValues($row['ceil_ht_in'],"Clear Height Inches");?> <?php printDBValues($row['chattels'],"Chattels");?> <?php printDBValues($row['city_water'],"Utilities-Municipal Water");?> <?php printDBValues($row['class'],"Class");?> <?php printDBValues($row['cldt'],"Back On Market Entry Date");?> <?php printDBValues($row['cndsold_xd'],"Conditional Expiry Date");?> <?php printDBValues($row['co_lagt_ph'],"Salesperson 2 Phone #");?> <?php printDBValues($row['co_list'],"Salesperson 2");?> <?php printDBValues($row['com_chgs'],"Common Area Upcharge");?> <?php printDBValues($row['com_coopb'],"Commission Co-Op Broker");?> <?php printDBValues($row['comel_inc'],"Common Elements Included");?> <?php printDBValues($row['comments'],"Comments");?> <?php printDBValues($row['comp_pts'],"Fronting On (NSEW)");?> <?php printDBValues($row['cond'],"Condition");?> <?php printDBValues($row['cond_txinc'],"Condo Taxes Included");?> <?php printDBValues($row['condo_corp'],"Condo Registry Office");?> <?php printDBValues($row['condo_exp'],"Exposure");?> <?php printDBValues($row['constr1_out'],"Exterior1");?> <?php printDBValues($row['constr2_out'],"Exterior2");?> <?php printDBValues($row['coop_s2'],"Co-Op Salesperson 2");?> <?php printDBValues($row['corp_num'],"Condo Corp#");?> <?php printDBValues($row['country'],"Country");?> <?php printDBValues($row['county'],"Province");?> <?php printDBValues($row['crane'],"Crane");?> <?php printDBValues($row['cross_st'],"Directions/Cross Streets");?> <?php printDBValues($row['days_open'],"Days Open");?> <?php printDBValues($row['dba'],"Business/Building Name");?> <?php printDBValues($row['den_fr'],"Family Room");?> <?php printDBValues($row['depth'],"Lot Depth");?> <?php printDBValues($row['disc_td'],"Disclose After Closing Date");?> <?php printDBValues($row['dom'],"Days On Market");?> <?php printDBValues($row['dont_disc'],"Do Not Disclose Until  Closing");?> <?php printDBValues($row['drive'],"Drive");?> <?php printDBValues($row['dt_sus'],"Suspended Date");?> <?php printDBValues($row['dt_ter'],"Terminated Date");?> <?php printDBValues($row['elec'],"Utilities-Hydro");?> <?php printDBValues($row['elevator'],"Elevator");?> <?php printDBValues($row['employees'],"Employees");?> <?php printDBValues($row['ens_lndry'],"Ensuite Laundry");?> <?php printDBValues($row['esc_clause'],"Escape Hours");?> <?php printDBValues($row['esc_flag'],"Escape Clause");?> <?php printDBValues($row['exer_gym'],"Exercise Rm/Gym");?> <?php printDBValues($row['exp_actest'],"Expenses Actual/Estimated");?> <?php printDBValues($row['farm_agri'],"Farm/Agriculture");?> <?php printDBValues($row['fin_stmnt'],"Financial Statement");?> <?php printDBValues($row['fpl_num'],"Fireplace/Stove");?> <?php printDBValues($row['franchise'],"Franchise");?> <?php printDBValues($row['freestandg'],"Freestanding");?> <?php printDBValues($row['front_ft'],"Lot Front");?> <?php printDBValues($row['fuel'],"Heat Source");?> <?php printDBValues($row['gar'],"Garage/Park Spaces");?> <?php printDBValues($row['gar_spaces'],"Garage Spaces");?> <?php printDBValues($row['gar_type'],"Garage Type");?> <?php printDBValues($row['gas'],"Utilities-Gas");?> <?php printDBValues($row['gross_inc'],"Gross Income/Sales");?> <?php printDBValues($row['heat_exp'],"Heat Expenses");?> <?php printDBValues($row['heat_inc'],"Heat Included");?> <?php printDBValues($row['heating'],"Heat Type");?> <?php printDBValues($row['holdover'],"Holdover Days");?> <?php printDBValues($row['hours_open'],"Hours Open");?> <?php printDBValues($row['hydro_exp'],"Hydro Expense");?> <?php printDBValues($row['hydro_inc'],"Hydro Included");?> <?php printDBValues($row['inc_list'],"Incomplete Listing");?> <?php printDBValues($row['inc_sale'],"Incomplete Sale");?> <?php printDBValues($row['ind_area'],"Industrial Area");?> <?php printDBValues($row['ind_areacd'],"Industrial Area Code");?> <?php printDBValues($row['input_date'],"Listing Entry Date");?> <?php printDBValues($row['insur'],"Insurance Expense");?> <?php printDBValues($row['insur_bldg'],"Building Insurance Included");?> <?php printDBValues($row['internet'],"Distribute To Internet Portals");?> <?php printDBValues($row['inventory'],"Estim Inventory Values At Cost");?> <?php printDBValues($row['irreg'],"Lot Irregularities");?> <?php printDBValues($row['lagt_ph'],"Salesperson 1 Phone #");?> <?php printDBValues($row['ld'],"Contract Date");?> <?php printDBValues($row['legal_desc'],"Legal Description");?> <?php printDBValues($row['level1'],"Level 1");?> <?php printDBValues($row['level2'],"Level 2");?> <?php printDBValues($row['level3'],"Level 3");?> <?php printDBValues($row['level4'],"Level 4");?> <?php printDBValues($row['level5'],"Level 5");?> <?php printDBValues($row['level6'],"Level 6");?> <?php printDBValues($row['level7'],"Level 7");?> <?php printDBValues($row['level8'],"Level 8");?> <?php printDBValues($row['level9'],"Level 9");?> <?php printDBValues($row['list_agent'],"Salesperson 1");?> <?php printDBValues($row['llbo'],"LLBO");?> <?php printDBValues($row['locker'],"Locker");?> <?php printDBValues($row['locker_num'],"Locker #");?> <?php printDBValues($row['lot_code'],"Lot/Bldg/Unit Code");?> <?php printDBValues($row['lot_fr_inc'],"Lot Front Incomplete");?> <?php printDBValues($row['lot_u_prt'],"Lot Unit");?> <?php printDBValues($row['lotsz_code'],"Lot Size Code");?> <?php printDBValues($row['lp_code'],"List Price Code");?> <?php printDBValues($row['lp_dol'],"List Price","","price");?> <?php printDBValues($row['lsc'],"Last Status");?> <?php printDBValues($row['lse_terms'],"Leased Terms");?> <?php printDBValues($row['lud'],"Last Update");?> <?php printDBValues($row['maint'],"Maintenance");?> <?php printDBValues($row['map_col'],"Map Column #");?> <?php printDBValues($row['map_page'],"Map #");?> <?php printDBValues($row['map_row'],"Map Row");?> <?php printDBValues($row['mgmt'],"Management Expense");?> <?php printDBValues($row['minrenttrm'],"Minimum Rental Term");?> <?php printDBValues($row['ml_num'],"MLS#");?> <?php printDBValues($row['mort_amt'],"Mortgage Amount");?> <?php printDBValues($row['mort_comm'],"Mortgage Comments");?> <?php printDBValues($row['mort_freq'],"Frequency");?> <?php printDBValues($row['mort_inc'],"Payment Includes");?> <?php printDBValues($row['mort_ir'],"Interest Rate");?> <?php printDBValues($row['mort_lendr'],"Lender");?> <?php printDBValues($row['mort_mdt'],"Maturity Date");?> <?php printDBValues($row['mort_pay'],"Payment");?> <?php printDBValues($row['net_inc'],"Net Income Before Debt");?> <?php printDBValues($row['num_kit'],"Kitchens");?> <?php printDBValues($row['oa_area'],"Office/Apt Area");?> <?php printDBValues($row['occ'],"Possession Date");?> <?php printDBValues($row['occupancy'],"Occupancy");?> <?php printDBValues($row['oenc'],"Other Encumbrances");?> <?php printDBValues($row['oenc_freq'],"Other Encumbrances Frequency");?> <?php printDBValues($row['oenc_inc'],"Other Encumbrances Payment Includes");?> <?php printDBValues($row['oenc_ir'],"Other Encumbrances Interest Rate");?> <?php printDBValues($row['oenc_lendr'],"Other Encumbrances Lender");?> <?php printDBValues($row['oenc_mdt'],"Other Encumbrances Maturity Date");?> <?php printDBValues($row['oenc_pay'],"Other Encumbrances Payment");?> <?php printDBValues($row['oenc_type'],"Other Encumbrances Type");?> <?php printDBValues($row['off_areacd'],"Office/Apt Area Code");?> <?php printDBValues($row['oper_exp'],"Operating Expenses");?> <?php printDBValues($row['orig_dol'],"Original Price");?> <?php printDBValues($row['orig_lp_cd'],"Original Price Code");?> <?php printDBValues($row['oth_struc1_out'],"Other Structures1");?> <?php printDBValues($row['oth_struc2_out'],"Other Structures2");?> <?php printDBValues($row['other'],"Other Expenses");?> <?php printDBValues($row['out_storg'],"Outside Storage");?> <?php printDBValues($row['outof_area'],"Out of Area Municipality");?> <?php printDBValues($row['parcel_id'],"PIN#");?> <?php printDBValues($row['park_chgs'],"Park Cost/Mo");?> <?php printDBValues($row['park_desig'],"Parking Type");?> <?php printDBValues($row['park_fac'],"Parking/Drive");?> <?php printDBValues($row['park_spc1'],"Parking Spot #1");?> <?php printDBValues($row['park_spc2'],"Parking Spot #2");?> <?php printDBValues($row['park_spcs'],"Parking Spaces");?> <?php printDBValues($row['patio_ter'],"Balcony");?> <?php printDBValues($row['pctd'],"Price Change Entry Date");?> <?php printDBValues($row['perc_bldg'],"% Building");?> <?php printDBValues($row['perc_dif'],"% Listing Price");?> <?php printDBValues($row['perc_rent'],"Percentage Rent");?> <?php printDBValues($row['pets'],"Pets Permitted");?> <?php printDBValues($row['pix'],"Picture");?> <?php printDBValues($row['pix_img'],"Image #");?> <?php printDBValues($row['pix_ts'],"Picture Timestamp");?> <?php printDBValues($row['pool'],"Pool");?> <?php printDBValues($row['ppcode'],"Prior Price Code");?> <?php printDBValues($row['pr_lp_dol'],"Prior Price");?> <?php printDBValues($row['pr_lsc'],"Prior LSC");?> <?php printDBValues($row['prkg_inc'],"Parking Included");?> <?php printDBValues($row['prop_feat1_out'],"Property Features1");?> <?php printDBValues($row['prop_feat2_out'],"Property Features2");?> <?php printDBValues($row['prop_type'],"Category");?> <?php printDBValues($row['rail'],"Rail");?> <?php printDBValues($row['rec_room'],"Recreation Rm");?> <?php printDBValues($row['redt'],"Leased Entry Date");?> <?php printDBValues($row['retail_a'],"Retail Area");?> <?php printDBValues($row['retail_ac'],"Retail Area Code");?>
                    <?php //printDBValues($row['rltr'],"List Broker");?>
                    <?php printDBValues($row['rm1_dc1_out'],"Room 1 Desc 1");?> <?php printDBValues($row['rm1_dc2_out'],"Room 1 Desc 2");?> <?php printDBValues($row['rm1_dc3_out'],"Room 1 Desc 3");?> <?php printDBValues($row['rm1_len'],"Room 1 Length");?> <?php printDBValues($row['rm1_out'],"Room 1");?> <?php printDBValues($row['rm1_wth'],"Room 1 Width");?> <?php printDBValues($row['rm2_dc1_out'],"Room 2 Desc 1");?> <?php printDBValues($row['rm2_dc2_out'],"Room 2 Desc 2");?> <?php printDBValues($row['rm2_dc3_out'],"Room 2 Desc 3");?> <?php printDBValues($row['rm2_len'],"Room 2 Length");?> <?php printDBValues($row['rm2_out'],"Room 2");?> <?php printDBValues($row['rm2_wth'],"Room 2 Width");?> <?php printDBValues($row['rm3_dc1_out'],"Room 3 Desc 1");?> <?php printDBValues($row['rm3_dc2_out'],"Room 3 Desc 2");?> <?php printDBValues($row['rm3_dc3_out'],"Room 3 Desc 3");?> <?php printDBValues($row['rm3_len'],"Room 3 Length");?> <?php printDBValues($row['rm3_out'],"Room 3");?> <?php printDBValues($row['rm3_wth'],"Room 3 Width");?> <?php printDBValues($row['rm4_dc1_out'],"Room 4 Desc 1");?> <?php printDBValues($row['rm4_dc2_out'],"Room 4 Desc 2");?> <?php printDBValues($row['rm4_dc3_out'],"Room 4 Desc 3");?> <?php printDBValues($row['rm4_len'],"Room 4 Length");?> <?php printDBValues($row['rm4_out'],"Room 4");?> <?php printDBValues($row['rm4_wth'],"Room 4 Width");?> <?php printDBValues($row['rm5_dc1_out'],"Room 5 Desc 1");?> <?php printDBValues($row['rm5_dc2_out'],"Room 5 Desc 2");?> <?php printDBValues($row['rm5_dc3_out'],"Room 5 Desc 3");?> <?php printDBValues($row['rm5_len'],"Room 5 Length");?> <?php printDBValues($row['rm5_out'],"Room 5");?> <?php printDBValues($row['rm5_wth'],"Room 5 Width");?> <?php printDBValues($row['rm6_dc1_out'],"Room 6 Desc 1");?> <?php printDBValues($row['rm6_dc2_out'],"Room 6 Desc 2");?> <?php printDBValues($row['rm6_dc3_out'],"Room 6 Desc 3");?> <?php printDBValues($row['rm6_len'],"Room 6 Length");?> <?php printDBValues($row['rm6_out'],"Room 6");?> <?php printDBValues($row['rm6_wth'],"Room 6 Width");?> <?php printDBValues($row['rm7_dc1_out'],"Room 7 Desc 1");?> <?php printDBValues($row['rm7_dc2_out'],"Room 7 Desc 2");?> <?php printDBValues($row['rm7_dc3_out'],"Room 7 Desc 3");?> <?php printDBValues($row['rm7_len'],"Room 7 Length");?> <?php printDBValues($row['rm7_out'],"Room 7");?> <?php printDBValues($row['rm7_wth'],"Room 7 Width");?> <?php printDBValues($row['rm8_dc1_out'],"Room 8 Desc 1");?> <?php printDBValues($row['rm8_dc2_out'],"Room 8 Desc 2");?> <?php printDBValues($row['rm8_dc3_out'],"Room 8 Desc 3");?> <?php printDBValues($row['rm8_len'],"Room 8 Length");?> <?php printDBValues($row['rm8_out'],"Room 8");?> <?php printDBValues($row['rm8_wth'],"Room 8 Width");?> <?php printDBValues($row['rm9_dc1_out'],"Room 9 Desc 1");?> <?php printDBValues($row['rm9_dc2_out'],"Room 9 Desc 2");?> <?php printDBValues($row['rm9_dc3_out'],"Room 9 Desc 3");?> <?php printDBValues($row['rm9_len'],"Room 9 Length");?> <?php printDBValues($row['rm9_out'],"Room 9");?> <?php printDBValues($row['rm9_wth'],"Room 9 Width");?> <?php printDBValues($row['rms'],"Rooms");?> <?php printDBValues($row['rooms_plus'],"Rooms +");?> <?php printDBValues($row['rr'],"Rerun");?> <?php printDBValues($row['rr_edt'],"Rerun Entry Date");?> <?php printDBValues($row['s_areacd'],"Sold Area Code");?> <?php printDBValues($row['s_r'],"Sale/Lease");?> <?php printDBValues($row['sauna'],"Sauna");?> <?php printDBValues($row['scdt'],"Sold Cond Entry Date");?> <?php printDBValues($row['seats'],"Seats");?> <?php printDBValues($row['sec'],"Sub Area");?> <?php printDBValues($row['secgrd_sys'],"Security Guard System");?> <?php printDBValues($row['sell_agt'],"Co-Op Salesperson 1");?> <?php printDBValues($row['sewer'],"Sewers");?> <?php printDBValues($row['share_perc'],"# Shares %");?> <?php printDBValues($row['shpdrsdlnu'],"Drive-In Level Shipping Doors  #");?> <?php printDBValues($row['shpdrsdmnu'],"Double Man Shipping Doors #");?> <?php printDBValues($row['shpdrsglnu'],"Grade Level Shipping Doors #");?> <?php printDBValues($row['shpdrstlnu'],"Truck Level Shipping Doors #");?> <?php printDBValues($row['soil_test'],"Soil Test");?> <?php printDBValues($row['sold_area'],"Sold Area");?> <?php printDBValues($row['sp_code'],"Sold Price Code");?> <?php printDBValues($row['sp_dol'],"Sold Price");?> <?php printDBValues($row['spec_des'],"Special Designation");?> <?php printDBValues($row['sprinklers'],"Sprinklers");?> <?php printDBValues($row['sqft'],"Approx Square Footage");?> <?php printDBValues($row['sqs_rac_ct'],"Squash/Racquet Court");?> <?php printDBValues($row['srchst_num'],"Street #");?> <?php printDBValues($row['srltr'],"Co-Operating Firm");?> <?php printDBValues($row['st'],"Street Name");?> <?php printDBValues($row['st_dir'],"Street Direction");?> <?php printDBValues($row['st_num'],"Street #");?> <?php printDBValues($row['st_sfx'],"Street Abbreviation");?> <?php printDBValues($row['status'],"Status");?> <?php printDBValues($row['stories'],"Level");?> <?php printDBValues($row['survey'],"Survey");?> <?php printDBValues($row['susdt'],"Suspended Entry Date");?> <?php printDBValues($row['taxes'],"Taxes");?> <?php printDBValues($row['taxes_exp'],"Taxes Expense");?> <?php printDBValues($row['td'],"Closed Date");?> <?php printDBValues($row['tennis_ct'],"Tennis Court");?> <?php printDBValues($row['terms'],"Maximum Rental Term");?> <?php printDBValues($row['timestamp'],"Timestamp");?> <?php printDBValues($row['tot_area'],"Total Area");?> <?php printDBValues($row['tot_areacd'],"Total Area Code");?> <?php printDBValues($row['tot_exp'],"Total Expenses");?> <?php printDBValues($row['tour_flag'],"Virtual Tour Flag");?> <?php printDBValues($row['tour_url'],"Virtual Tour URL");?> <?php printDBValues($row['town'],"Municipality");?> <?php printDBValues($row['township'],"Area");?> <?php printDBValues($row['tv'],"Assessment");?> <?php printDBValues($row['type_own2_out'],"Type (Secondary)");?> <?php printDBValues($row['type_taxes'],"Type Taxes");?> <?php printDBValues($row['uctd'],"Sold Entry Date");?> <?php printDBValues($row['uffi'],"UFFI");?> <?php printDBValues($row['unavail_dt'],"Unavailable Date");?> <?php printDBValues($row['unit_num'],"Unit #");?> <?php printDBValues($row['util_cable'],"Utilities-Cable");?> <?php printDBValues($row['util_sewr'],"Utilities-Sewers");?> <?php printDBValues($row['util_tel'],"Utilities-Telephone");?> <?php printDBValues($row['utilities'],"Utilities");?> <?php printDBValues($row['vac_perc'],"Vacancy Allowance");?> <?php printDBValues($row['vend_pis'],"Seller Property Info Statement");?> <?php printDBValues($row['volts'],"Volts");?> <?php printDBValues($row['vtour_upby'],"Virtual Tour Uploaded By");?> <?php printDBValues($row['vtour_updt'],"Virtual Tour Upload Date");?> <?php printDBValues($row['water'],"Water");?> <?php printDBValues($row['water_exp'],"Water Expense");?> <?php printDBValues($row['water_inc'],"Water Included");?> <?php printDBValues($row['wcloset_p1'],"Washrooms Type 1 # Pcs");?> <?php printDBValues($row['wcloset_p2'],"Washrooms Type 2 # Pcs");?> <?php printDBValues($row['wcloset_p3'],"Washrooms Type 3 # Pcs");?> <?php printDBValues($row['wcloset_p4'],"Washrooms Type 4 # Pcs");?> <?php printDBValues($row['wcloset_t1'],"Washrooms Type 1");?> <?php printDBValues($row['wcloset_t2'],"Washrooms Type 2");?> <?php printDBValues($row['wcloset_t3'],"Washrooms Type 3");?> <?php printDBValues($row['wcloset_t4'],"Washrooms Type 4");?> <?php printDBValues($row['wrtd'],"Terminated Entry Date");?> <?php printDBValues($row['wtr_suptyp'],"Water Supply Types");?> <?php printDBValues($row['xd'],"Expiry Date");?> <?php printDBValues($row['xdtd'],"Extension Entry Date");?> <?php printDBValues($row['yr'],"Tax Year");?> <?php printDBValues($row['yr_built'],"Approx Age");?> <?php printDBValues($row['yr_exp'],"Year Expenses");?> <?php printDBValues($row['zip'],"Postal Code");?> <?php printDBValues($row['zn'],"District");?> <?php printDBValues($row['zoning'],"Zoning");?> <?php printDBValues($row['code_treb'],"TREB List Broker #");?> <?php printDBValues($row['agent_id'],"Salesperson 1 Member #");?> <?php printDBValues($row['co_lagt_id'],"Salesperson 2 Member #");?> <?php printDBValues($row['disp_addr'],"Display Address on Internet");?> <?php printDBValues($row['mmap_col'],"Map Column #");?> <?php printDBValues($row['mmap_page'],"Map #");?> <?php printDBValues($row['mmap_row'],"Map Row");?> <?php printDBValues($row['prop_mgmt'],"Property Management Company");?> <?php printDBValues($row['perm_adv'],"Permission To Advertise");?> <?php printDBValues($row['contac_exp'],"Contact After Expiry");?> <?php printDBValues($row['all_inc'],"All Inclusive Rental");?> <?php printDBValues($row['furnished'],"Furnished");?> <?php printDBValues($row['pvt_ent'],"Private Entrance");?> <?php printDBValues($row['laundry'],"Laundry Access");?> <?php printDBValues($row['lease_term'],"Lease Term");?> <?php printDBValues($row['pay_freq'],"Payment Frequency");?> <?php printDBValues($row['pay_meth'],"Payment Method");?> <?php printDBValues($row['app_req'],"Application Required");?> <?php printDBValues($row['sec_dep'],"Deposit Required");?> <?php printDBValues($row['credit_chk'],"Credit Check");?> <?php printDBValues($row['emply_lett'],"Employment Letter");?> <?php printDBValues($row['lease'],"Lease Agreement");?> <?php printDBValues($row['ref_req'],"References Required");?> <?php printDBValues($row['opt_to_buy'],"Buy Option");?> <?php printDBValues($row['trlr_pk_spt'],"# Trailer Parking Spots");?> <?php printDBValues($row['yr1_lsd_price'],"1st Year Leased Price");?> <?php printDBValues($row['yr2_lsd_price'],"2nd Year Leased Price");?> <?php printDBValues($row['yr3_lsd_price'],"3rd Year Leased Price");?> <?php printDBValues($row['yr4_lsd_price'],"4th Year Leased Price");?> <?php printDBValues($row['yr5_lsd_price'],"5th Year Leased Price");?> <?php printDBValues($row['addl_mo_fee'],"Addl Monthly Fees");?> <?php printDBValues($row['central_vac'],"Central Vac");?> <?php printDBValues($row['com_cn_fee'],"Commercial Condo Fees");?> <?php printDBValues($row['bay_size2_in'],"Bay Size Length Inches");?> <?php printDBValues($row['bay_size1_in'],"Bay Size Width Inches");?> <?php printDBValues($row['shpdrsdmhtft'],"Double Man Shipping Doors Height Feet");?> <?php printDBValues($row['shpdrsdmhtin'],"Double Man Shipping Doors Height Inches");?> <?php printDBValues($row['shpdrsdmwdft'],"Double Man Shipping Doors Width Feet");?> <?php printDBValues($row['shpdrsdmwdin'],"Double Man Shipping Doors Width Inches");?> <?php printDBValues($row['shpdrsdlhtft'],"Drive-In Level Shipping Doors Height Feet");?> <?php printDBValues($row['shpdrsdlhtin'],"Drive-In Level Shipping Doors Height Inches");?> <?php printDBValues($row['shpdrsdlwdft'],"Drive-In Level Shipping Doors Width Feet");?> <?php printDBValues($row['shpdrsdlwdin'],"Drive-In Level Shipping Doors Width Inches");?> <?php printDBValues($row['shpdrsglhtft'],"Grade Level Shipping Doors Height Feet");?> <?php printDBValues($row['shpdrsglhtin'],"Grade Level Shipping Doors Height Inches");?> <?php printDBValues($row['shpdrsglwdft'],"Grade Level Shipping Doors Width Feet");?> <?php printDBValues($row['shpdrsglwdin'],"Grade Level Shipping Doors Width Inches");?> <?php printDBValues($row['shpdrstlhtft'],"Truck Level Shipping Doors Height Feet");?> <?php printDBValues($row['shpdrstlhtin'],"Truck Level Shipping Doors Height Inches");?> <?php printDBValues($row['shpdrstlwdft'],"Truck Level Shipping Doors Width Feet");?> <?php printDBValues($row['shpdrstlwdin'],"Truck Level Shipping Doors Width Inches");?> <?php printDBValues($row['kit_plus'],"Kitchens Plus");?> <?php printDBValues($row['laundry_lev'],"Laundry Level");?> <?php printDBValues($row['park_lgl_desc1'],"Parking Legal Description");?> <?php printDBValues($row['park_lgl_desc2'],"Parking Legal Description2");?> <?php printDBValues($row['parking_spots'],"Parking Spots");?> <?php printDBValues($row['park_desig_2'],"Parking Type2");?> <?php printDBValues($row['retirement'],"Retirement");?> <?php printDBValues($row['rm10_out'],"Room 10");?> <?php printDBValues($row['rm10_dc1_out'],"Room 10 Desc 1");?> <?php printDBValues($row['rm10_dc2_out'],"Room 10 Desc 2");?> <?php printDBValues($row['rm10_dc3_out'],"Room 10 Desc 3");?> <?php printDBValues($row['rm10_len'],"Room 10 Length");?> <?php printDBValues($row['rm10_wth'],"Room 10 Width");?> <?php printDBValues($row['rm11_out'],"Room 11");?> <?php printDBValues($row['rm11_dc1_out'],"Room 11 Desc 1");?> <?php printDBValues($row['rm11_dc2_out'],"Room 11 Desc 2");?> <?php printDBValues($row['rm11_dc3_out'],"Room 11 Desc 3");?> <?php printDBValues($row['rm11_len'],"Room 11 Length");?> <?php printDBValues($row['rm11_wth'],"Room 11 Width");?> <?php printDBValues($row['rm12_out'],"Room 12");?> <?php printDBValues($row['rm12_dc1_out'],"Room 12 Desc 1");?> <?php printDBValues($row['rm12_dc2_out'],"Room 12 Desc 2");?> <?php printDBValues($row['rm12_dc3_out'],"Room 12 Desc 3");?> <?php printDBValues($row['rm12_len'],"Room 12 Length");?> <?php printDBValues($row['rm12_wth'],"Room 12 Width");?> <?php printDBValues($row['waterfront'],"Waterfront");?> <?php printDBValues($row['prop_feat3_out'],"Property Features3");?> <?php printDBValues($row['prop_feat4_out'],"Property Features4");?> <?php printDBValues($row['prop_feat5_out'],"Property Features5");?> <?php printDBValues($row['prop_feat6_out'],"Property Features6");?> <?php printDBValues($row['wcloset_t5'],"Washrooms Type 5");?> <?php printDBValues($row['wcloset_p5'],"Washrooms Type 5 # Pcs");?> <?php printDBValues($row['wcloset_t1lvl'],"Washrooms Type 1 Level");?> <?php printDBValues($row['wcloset_t2lvl'],"Washrooms Type 2 Level");?> <?php printDBValues($row['wcloset_t3lvl'],"Washrooms Type 3 Level");?> <?php printDBValues($row['wcloset_t4lvl'],"Washrooms Type 4 Level");?> <?php printDBValues($row['wcloset_t5lvl'],"Washrooms Type 5 Level");?> <?php printDBValues($row['bldg_amen1_out'],"Building Amenities1");?> <?php printDBValues($row['bldg_amen2_out'],"Building Amenities2");?> <?php printDBValues($row['bldg_amen3_out'],"Building Amenties3");?> <?php printDBValues($row['bldg_amen4_out'],"Building Amenities4");?> <?php printDBValues($row['bldg_amen5_out'],"Building Amenities5");?> <?php printDBValues($row['bldg_amen6_out'],"Building Amenities6");?> <?php printDBValues($row['spec_des1_out'],"Special Designation1");?> <?php printDBValues($row['spec_des2_out'],"Special Designation2");?> <?php printDBValues($row['spec_des3_out'],"Special Designation3");?> <?php printDBValues($row['spec_des4_out'],"Special Designation4");?> <?php printDBValues($row['spec_des5_out'],"Special Designation5");?> <?php printDBValues($row['spec_des6_out'],"Special Designation6");?> <?php printDBValues($row['level10'],"Level 10");?> <?php printDBValues($row['level11'],"Level 11");?> <?php printDBValues($row['level12'],"Level 12");?> <?php printDBValues($row['oh_date1'],"First Open House Date");?> <?php printDBValues($row['oh_from1'],"First Open House from time");?> <?php printDBValues($row['oh_to1'],"First Open House To Time");?> <?php printDBValues($row['oh_date2'],"Second Open House Date");?> <?php printDBValues($row['oh_from2'],"Second Open House from time");?> <?php printDBValues($row['oh_to2'],"Second Open House To Time");?> <?php printDBValues($row['oh_date3'],"Third Open House Date");?> <?php printDBValues($row['oh_from3'],"Third Open House from time");?> <?php printDBValues($row['oh_to3'],"Third Open House To Time");?> <?php printDBValues($row['oh_dt_stamp'],"Timestamp");?> <?php printDBValues($row['area_code'],"Area Code");?> <?php printDBValues($row['municipality_code'],"Municipality Code");?> <?php printDBValues($row['community_code'],"Community Code");?> <?php printDBValues($row['area'],"Area");?> <?php printDBValues($row['municipality'],"Municipality");?> <?php printDBValues($row['community'],"Community");?> <?php printDBValues($row['municipality_district'],"Municipality District");?> <?php printDBValues($row['handi_equipped'],"Physically Handicapped-Equipped");?> <?php printDBValues($row['sqft_source'],"Square Foot Source");?> <?php printDBValues($row['energy_cert'],"Energy Certification");?> <?php printDBValues($row['green_pis'],"Green Property Information Statement");?> <?php printDBValues($row['cert_lvl'],"Certification Level");?> <?php printDBValues($row['bldg_name'],"Building Name");?> <?php printDBValues($row['status_cert'],"Status Certificate");?> <?php printDBValues($row['alt_feature_sheet'],"Alternate Feature Sheet");?> <?php printDBValues($row['sound_bite_url'],"Sound Bite");?> <?php printDBValues($row['sales_brochure_url'],"Sales Brochure");?> <?php printDBValues($row['addl_pix_url'],"Additional Pictures");?> <?php printDBValues($row['map_loc_url'],"Map Location");?> <?php printDBValues($row['lcdt'],"Leased Cond Entry Date");?> <?php printDBValues($row['ad_text'],"Remarks For Clients");?> <?php printDBValues($row['extras'],"Extras");?>
                    <div class='cutsheet-detail-item'>
                      <div class='cutsheet-detail-item-label'>Contact Phone</div>
                      <div class='cutsheet-detail-item-value'><?php echo $row['contact_phone'];?></div>
                    </div>
                    <div class='cutsheet-detail-item'>
                      <div class='cutsheet-detail-item-label'>Contact Email</div>
                      <div class='cutsheet-detail-item-value'><a style="text-decoration:none;" href="mailto:<?php echo $row['contact_email'];?>"><?php echo $row['contact_email'];?></a></div>
                    </div>
                    <div class='cutsheet-detail-item'>
                      <div class='cutsheet-detail-item-label'>Contact Website</div>
                      <div class='cutsheet-detail-item-value'><a style="text-decoration:none;" href="<?php echo $row['contact_website'];?>" target="_blank"><?php echo $row['contact_website'];?></a></div>
                    </div>
                  </div>
                  <div class="clr"></div>
                </div>
              </div>
            </div>
          </div>
          <div id="menu2" class="tab-pane fade">
            <div class="shadow_bottom">
              <div class="property_content_right">
                <div class="property-amenities property-detail-description-new"> 
                  <!--<ul>
                  <li class="yes"> </li>
                  <li class="yes"> </li>
                </ul>--> 
                </div>
              </div>
            </div>
          </div>
          <div id="menu3" class="tab-pane fade in active">
            <div>
              <?php include("mortgageCalculator.php"); ?>
            </div>
          </div>
          <div id="menu4" class="tab-pane fade">
            <div class="shadow_bottom">
              <div id="population_age_group" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="population_growth" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="education" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="marital_status" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="languages_chart" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="household_income" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="children_home" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="ownership" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="construction_date" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
            <div class="shadow_bottom">
              <div id="occupations" style="min-width: 310px; width:100%; height: 400px; margin-top:20px"></div>
            </div>
          </div>
          <script>
    jQuery(document).ready(function(e) {
      // Start : Retail Sales
      /*$(function () {
        // Create the chart
        Highcharts.chart('retail_sales', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Retail Sales'
          },
          subtitle: {
            text: 'Values and ranges below represent the total of retail sales (including all retail trade, stores and dealers) and are expressed in millions (CDN$).'
          },
          xAxis: {
            type: 'category'
          },
          yAxis: {
            title: {
              text: ''
            }
      
          },
          legend: {
            enabled: false
          },
          credits: {
              enabled: false
            },
          plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y}'
              }
            }
          },
      
          tooltip: {
            /*headerFormat: '<span style="font-size:11px">{point.name}</span><br>',*/
        /*    pointFormat: '<span style="color:{point.color}">{series.name}</span>: <b>{point.y}</b><br/>'
          },
      
          series: [{
            name: 'Retail Sales',
            colorByPoint: true,
            data: [{
              name: 'Unknown',
              y: 31
            }, {
              name: '&lt;1',
              y: 153
            }, {
              name: '1-4.9',
              y: 148
            }, {
              name: '5-19.9',
              y: 31
            }, {
              name: '20-99.9',
              y: 9
            }, {
              name: '100+',
              y: 2
            }]
          }]
        });
      });*/
      // End : Retail Sales
      
      // Start : Population by Age Group
      
                
            
      jQuery(function () {
        Highcharts.chart('population_age_group', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Population by Age Group'
          },
          subtitle: {
            text: 'Population grouped according to age in the area containing the listing. '
          },
          credits: {
              enabled: false
            },

          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          series: [{
            name: 'Population by Age Group',
            data: [
              ['0 - 4 years old (165)', 165],
              ['5 - 9 years old (137)', 137],
              ['10 - 19 years old (199)', 199],
              ['20 - 34 years old (553)', 553],
              ['35 - 49 years old (435)', 435],
              ['50 - 54 years old (109)', 109],
              ['55 - 64 years old (156)', 156],
              ['65 - 69 years old (53)', 53],
              ['70 - 79 years old (56)', 56],
              ['80+ years old (41)', 41]
            ]
          }]
        });
      });
      // End : Population by Age Group
      
      // Start : Population Growth/Projection
      jQuery(function () {
        Highcharts.chart('population_growth', {
          title: {
            text: 'Population Growth/Projection',
            x: -20 //center
          },
          subtitle: {
            text: 'Past and expected changes in population.',
            x: -20
          },
          xAxis: {
            categories: ['2009', '2014', '2017', '2019', '2024']
          },
          yAxis: {
            title: {
              text: ''
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          tooltip: {
            valueSuffix: ''
          },
          credits: {
                    enabled: false
                  },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          },
          series: [{
            name: 'Population Growth/Projection',
            data: [1113, 1904, 2484, 2857, 3195]
          }]
        });
      });
      // End : Population Growth/Projection
      
      // Start : Education
      jQuery(function () {
        Highcharts.chart('education', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Education'
          },
          subtitle: {
            text: 'Highest level of education from an accredited institution, based on evaluation rather than attendance.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Education',
            data: [
              ['No cert. / Diploma / Degree (109)', 109],
              ['High school (341)', 341],
              ['Apprenticeship / Trade cert. / Diploma (8)', 8],
              ['Non-university cert. / Diploma (222)', 222],
              ['University cert. / Diploma below bachelor (121)', 121],
              ['University degree (701)', 701]
            ]
          }]
        });
      });
      // End : Education
      
      // Start : Marital Status
      jQuery(function () {
        Highcharts.chart('marital_status', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Marital Status'
          },
          subtitle: {
            text: 'Marital or formal relationship statuses.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Marital Status',
            data: [
              ['Married (780)', 780],
              ['Common law (62)', 62],
              ['Single (533)', 533],
              ['Separated (48)', 48],
              ['Divorced (44)', 44],
              ['Widowed (35)', 35]
            ]
          }]
        });
      });
      // End : Marital Status
      
      // Start : Languages
      jQuery(function () {
        Highcharts.chart('languages_chart', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Languages'
          },
          subtitle: {
            text: 'Self-identified first language or combination of languages spoken in the area.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Languages',
            data: [
              ['English (461)', 461],
              ['Arabic (201)', 201],
              ['Persian (137)', 137],
              ['English & Non-Official (127)', 127],
              ['Tagalog (124)', 124],
              ['Urdu (83)', 83],
              ['Chinese n.o.s (82)', 82],
              ['Tamil (71)', 71],
              ['Hindi (65)', 65],
              ['Other Languages (553)', 553]
            ]
          }]
        });
      });
      // End : Languages
      
      // Start : Household income
      jQuery(function () {
        Highcharts.chart('household_income', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Household income'
          },
          subtitle: {
            text: 'The combined gross income of all the members of a household who are 15 years old and older. Individuals do not have to be related to be considered members of the same household.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Household income',
            data: [
              ['$0 - $29,999 (281)', 281],
              ['$30,000 - $59,999 (202)', 202],
              ['$60,000 - $79,999 (96)', 96],
              ['$80,000 - $99,999 (60)', 60],
              ['$100,000 - $149,999 (59)', 59],
              ['$200,000+ (20)', 20]
            ]
          }]
        });
      });
      // End : Household income
      
      // Start : Children at Home
      jQuery(function () {
        Highcharts.chart('children_home', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Children at Home'
          },
          subtitle: {
            text: 'Children at home includes: never married sons or daughters, previously married sons or daughters (alone); grandchildren with no parent present.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{

            name: 'Children at Home',
            data: [
              ['0 - 4 years old (165)', 165],
              ['5 - 9 years old (111)', 111],
              ['10 - 14 years old (66)', 66],
              ['15 - 19 years old (46)', 46],
              ['20 - 24 years old (38)', 38],
              ['25+ years old (34)', 34]
            ]
          }]
        });
      });
      // End : Children at Home
      
      // Start : Ownership
      jQuery(function () {
        Highcharts.chart('ownership', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Ownership'
          },
          subtitle: {
            text: 'Those living spaces that are owned, rented.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Ownership',
            data: [
              ['Own (111)', 111],
              ['Rent (607)', 607]
            ]
          }]
        });
      });
      // End : Ownership
      
      // Start : Construction Date
      jQuery(function () {
        Highcharts.chart('construction_date', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Construction Date'
          },
          subtitle: {
            text: 'Ranges for the years in which properties in the area were built.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Construction Date',
            data: [
              ['Before 1960 (22)', 22],
              ['1961 - 1980 (270)', 270],
              ['1981 - 1990 (20)', 20],
              ['1991 - 2000 (7)', 7],
              ['2006 - 2011 (51)', 51],
              ['After 2011 (348)', 348]
            ]
          }]
        });
      });
      // End : Construction Date
      
      // Start : Occupations
      jQuery(function () {
        Highcharts.chart('occupations', {
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45
            }
          },
          title: {
            text: 'Occupations'
          },
          subtitle: {
            text: ' Based on the total labour force, occupation is a grouping of similar job tasks and work performed.'
          },
          credits: {
              enabled: false
          },
          tooltip: {
            pointFormat: '<span style="color:{point.color}"><b>{point.percentage:.1f}%</b><br/>'
          },
          plotOptions: {
            pie: {
              innerSize: 100,
              depth: 45
            }
          },
          series: [{
            name: 'Occupations',
            data: [
              ['Not Applicable (152)', 152],
              ['Management (53)', 53],
              ['Business, Finance, Admin (277)', 277],
              ['Sciences (154)', 154],
              ['Health (11)', 11],
              ['Social Sciences, Education,  Government, Religion (7)', 7],
              ['Art, Culture, Recreation, Sport (9)', 9],
              ['Sales and service (346)', 346],
              ['Trades, Transport, Operators (78)', 78],
              ['Manufacture and Utilities (17)', 17]
            ]
          }]
        });
      });
      // End : Occupations
      
      setInterval(function () {
            jQuery('#population_age_group').highcharts().reflow();
        jQuery('#population_growth').highcharts().reflow();
        jQuery('#education').highcharts().reflow();
        jQuery('#marital_status').highcharts().reflow();
        jQuery('#languages_chart').highcharts().reflow();
        jQuery('#household_income').highcharts().reflow();
        jQuery('#children_home').highcharts().reflow();
        jQuery('#ownership').highcharts().reflow();
        jQuery('#construction_date').highcharts().reflow();
        jQuery('#occupations').highcharts().reflow();
        }, 10);
      
      });
      </script> 
        </div>
      </div>
    </div>
    <div style="width:100%;clear:both;"></div>
    <div style="width:100%;clear:both;"></div>
    <div style="width:100%;clear:both;"></div>
    <?php if($ptype=="viewFullListing"){ ?>
    <div class="property_position style_padding">
      <div class="property_title_left cutsheet-section-title" id="walkscore_div">
        <h3 class="page-header boldDesc"><i class="fa fa-check-square" aria-hidden="true"></i><strong>Walkscore</strong></h3>
      </div>
      <div class="property_content_right" style="margin-top:10px; text-align:center;" id="walkscore_content">
        <iframe style="margin: 0px; outline: medium none; text-align: left; text-decoration: none; padding: 0px; font-size-adjust: none; font-stretch: normal; font-style: normal; font-variant: normal; letter-spacing: normal; word-spacing: normal; text-transform: none; vertical-align: baseline; text-indent: 0px; text-shadow: none; white-space: normal; background-image: none; background-color: transparent; border: 0px none;" marginheight="0" marginwidth="0" scrolling="no" src="http://www.walkscore.com/serve-walkscore-tile.php?wsid=b698f03ac6a12c7ccdef834f95313370&s=<?php echo $row['address'].", ".$row['city'].", ".$row['postal'].", ".$row['state'];?>&lat=<?php echo $row['latitude'];?>&lng=<?php echo $row['longitude'];?>8&o=h&ts=t&c=f&map_provider=mapquest&mm=all&base_map=google_map&h=442&fh=18&w=800" width="100%" height="442px" frameborder="0"></iframe>
      </div>
    </div>
    <div class="property_position style_padding">
      <div class="property_title_left  cutsheet-section-title"  id="position_div">
        <h3 class="page-header boldDesc"><i class="fa fa-check-square" aria-hidden="true"></i>Position</h3>
      </div>
      <div class="shadow_bottom" id="position_content">
        <div class="property_content_right">
          <div class="property-detail-description boldDesc">
            <div class="map-position">
              <div id="reListingOnMap"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php
      //$simiqr1 = "SELECT * FROM $reListingTable WHERE retype = '".$row['retype']."' ORDER BY RAND()  limit 0,10";
	  $simiqr1 = "SELECT * FROM $reListingTable WHERE retype = '".$row['retype']."' ORDER BY id DESC LIMIT 0,10";
    //echo $simiqr1; exit;
    $result1=mysql_query($simiqr1);
    
    
  ?>
    <!--<link rel="stylesheet" type="text/css" href="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/css/owl.carousel.css">-->
    <div class="properties_similar style_padding">
      <h3 class="page-header-primary"><i class="fa fa-check-square" aria-hidden="true"></i>Similar properties</h3>
      <div class="row jcarousel" id="similar_prop_div">
      <ul>
        <?php
        while($similine = mysql_fetch_assoc($result1)){ 
    
      if($similine['address']!="") $listingTitle=$similine['address']; else $listingTitle=__("Address Not Disclosed");
      if($similine['city']!="")$listingAddress=$row['city'];
      if($similine['state']!="")$listingAddress=$listingAddress.", ".$similine['state'];
      if($similine['postal']!="")$listingAddress=$listingAddress." ".$similine['postal'];
      if($similine['retype']=="Residential" && $similine['subtype']!="Land"){ 
      $similine['bedrooms']=str_replace("den", " + Den", $similine['bedrooms']);
      if(strlen($similine['bedrooms'])>0){
         if(stripos($similine['bedrooms'],"Den")===false && stripos($similine['bedrooms'],"Bachelor")===false) $bedrooms=$similine['bedrooms']." ".__("beds"); 
         else $bedrooms=$similine['bedrooms'];
      }else $bedrooms="";
      if($similine['bathrooms']!="")$bathrooms=$similine['bathrooms']." ".__("baths"); else $bathrooms="";
      }else $bedrooms="";
      
      $headline_slug=friendlyUrl($similine['headline']);
      if($similine['user_id']=="oodle") $region_slug=$similine['country']; else $region_slug="";
      if($refriendlyurl=="enabled") 
      {
        if(trim($row['subtype'])==""){
          $similine['subtype'] = "none";
        }
        $relistingLink=friendlyUrl($similine['retype'],"_")."/".friendlyUrl($similine['subtype'],"_")."/"."id-".$similine['id']."-".$region_slug."-".$headline_slug;
      }
      else $relistingLink="index.php?ptype=viewFullListing&reid=".$similine['id']."&title=$title_slug";
    
      $rePicArray=explode("::",$similine['pictures']);
      if(count($rePicArray)>=1 && $rePicArray[0]!=""){
		$firstPic=$rePicArray[0];
		$firstPic	= $SitePath.'/uploads/'.$firstPic;
	}else{ 
		$firstPic = $SitePath.'/images/no-image.png';
	}
    ?><li>
        <div class="properties_similar_items">
          <div class="property-box-simple">
            <div class="property-box-image "> <a href="<?php echo $relistingLink;?>" class="property-box-simple-image-inner"> <img width="640" height="493" src="<?php echo $firstPic;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="<?php echo $firstPic;?>" /> </a>
              <div class="property-box-simple-actions"> 
              	<span>Actions</span> 
                <?php
					$TotFav	= 0;
					if(!empty($similine['id'])){
						$CheckFavSql	= "SELECT COUNT(*) as Tot FROM favorites WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																						property_id = '".$similine['id']."' AND 
																						page = 'Realestate'";
						$CheckFavQue	= mysql_query($CheckFavSql);
						$ResFav		= mysql_fetch_assoc($CheckFavQue);
						$TotFav		= $ResFav['Tot'];
					}
					
					$TempHeartSrc = 'images/black-heart.png';
					$TempHeartCls = 'blackcls';
					$TempOnclick  = 'javascript:dofavorite('.$similine['id'].')';	
					$MouseHovor	  = 'onmouseover="this.src=\'images/hhg.png\'"';	
					$MouseOut	  = 'onmouseout="this.src=\'images/black-heart.png\'"';	
					
					if($TotFav > 0)
					{
						$MouseHovor   = '';
						$MouseOut	  = '';
						$TempHeartSrc = 'images/hhg.png';
						$TempHeartCls = 'redcls';
						/*$TempOnclick  = 'javascript:void(0)';	*/
					}
					
					// Start : Hitesh Compare record
					$TotComp	= 0;
					if(!empty($similine['id'])){
						$CheckCompSql	= "SELECT COUNT(*) as Tot FROM compare_properties WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																								 property_id = '".$similine['id']."' AND 
																								 page = 'Realestate'";
						$CheckCompQue	= mysql_query($CheckCompSql);
						$ResComp		= mysql_fetch_assoc($CheckCompQue);
						$TotComp		= $ResComp['Tot'];
					}
					$TempCompSrc = 'images/house-gray.png';
					$TempCompCls = 'blackcls';
					$TempCompOnclick  = 'javascript:compareproperty('.$similine['id'].')';	
					$MouseCompHovor	  = 'onmouseover="this.src=\'images/house-blue-bg.png\'"';	
					$MouseCompOut	  = 'onmouseout="this.src=\'images/house-gray.png\'"';	
					if($TotComp > 0)
					{
						$MouseCompHovor   = '';
						$MouseCompOut	  = '';
						$TempCompSrc 	  = 'images/house-blue-bg.png';
						$TempCompCls 	  = 'redcls';
					}
					// End : Hitesh Compare record
				  ?>
                <span data-ng-controller="CompareAddController"> 
                	<a title="Add to compare list" class="compare-add action-link"> 
                    	<img <?php echo $MouseCompHovor." ".$MouseCompOut;?> id='comp<?php echo $similine['id'];?>' onclick="<?php echo $TempCompOnclick;?>" class="<?php echo $TempCompCls;?>" height='32' width='32' src="<?php echo $TempCompSrc;?>" style="float:right;width:32px !important;height:32px !important;" />
                    </a> 
                </span>
                <span> 
                	<a title="Add to favorites" class="favorites-action action-link favorites-added" > 
                    	<img <?php echo $MouseHovor;?> <?php echo $MouseOut;?> id="heartid<?php echo $similine['id'];?>" onclick=<?php echo $TempOnclick;?> class="<?php echo $TempHeartCls;?>" height="32" width="32" src="<?php echo $TempHeartSrc;?>" style="float:right;width:32px !important;height:32px !important;"> 
                    </a> 
                </span> 
              </div>
            </div>
            <div class="property-box-simple-header">
              <h2> <a href="<?php echo $relistingLink;?>"> <?php echo $similine['address'].", ".$similine['city'].", ".$similine['postal'].", ".$similine['state']; ?> </a> </h2>
              <h3><?php echo $defaultCurrency.number_format($similine['price']);?></h3>
            </div>
            <div class="property-box-simple-meta">
              <ul>
                <li> <span>Area</span> <strong><?php echo $similine['state'];?>, <?php echo $similine['postal'];?></strong> </li>
              </ul>
            </div>
          </div>
        </div>
        </li>
        <?php }
    
    ?>
    </ul>
      </div>
      <p class="jcarousel-pagination"></p>
    </div>
    <style>
    #owl-demo .item {
    margin: 3px;
	}
	#owl-demo .item img {
		display: block;
		width: 50%;
		height: auto;
	}
	.owl-theme .owl-controls .owl-page {
		display: inline-block;
	}
	.owl-theme .owl-controls .owl-page span {
		background: none repeat scroll 0 0 #869791;
		border-radius: 20px;
		display: block;
		height: 12px;
		margin: 5px 7px;
		opacity: 0.5;
		width: 12px;
	}
	.owl-theme .owl-controls .active span{
   		background: none repeat scroll 0 0 #29B6F6;
	}
    </style>
    <!--<script type='text/javascript' src='http://realestate.homula.com/wp-includes/js/jquery/jquery.js'></script>
    <script src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/js/owl.carousel.min.js" type="text/javascript"></script> -->
  <!--  <link rel="stylesheet" type="text/css" href="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/css/owl.theme.default.min.css">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.js"></script>--> 
    <script type='text/javascript' src='js/jquery.jcarousel.js'></script>
    <link href="css/jcarousel.responsive.css" rel="stylesheet" />
    <script>
   
      jQuery(document).ready(function(e) {
		  
		/* var wysiwyg_owloptions = {
			items : 3,
			navigation : false,
			slideBy: 1,
			loop:true,
			transitionStyle : "fade",
			rewindSpeed: 100,
			autoplay:true,
			autoplayTimeout:2000,
			autoplayHoverPause:true
		  } 
		
		function owlResize($owl) {
			$owl.trigger('destroy.owl.carousel');
			$owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
			$owl.owlCarousel(wysiwyg_owloptions);
		}  
		  
		var $owl = $("#similar_prop_div").owlCarousel(wysiwyg_owloptions);
		owlResize($owl);*/
		  
		
		/* jQuery("#similar_prop_div").owlCarousel({
			items : 3,
			navigation : false,
			slideBy: 1,
			loop:true,
			transitionStyle : "fade",
			rewindSpeed: 100,
			autoplay:true,
			autoplayTimeout:1000,
			autoplayHoverPause:true,
			dots: true
		  });*/
		
		
		
		(function($) {
    $(function() {
        var jcarousel = $('#similar_prop_div');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 600) {
                    width = width / 3;
                } else if (width >= 350) {
                    width = width / 2;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 3,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });
	//$('#similar_prop_div').jcarouselAutoscroll('start');
})(jQuery);
		
    
      //jQuery('#similar_prop_div .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');
      //var owl = $("#featured-properties");
      /* jQuery(document).on("click","#similar_prop_div .see-more", function(){
        jQuery("#similar_prop_div").trigger('owl.next');
        jQuery("#similar_prop_div .owl-next").trigger('click');
         var $dots = jQuery('#similar_prop_div .owl-dot');
         var $next = $dots.filter('.active').next();
          if (!$next.length)
            $next = $dots.first();
          $next.trigger('click');
         });*/
      
      
      });
    </script> 
    <!--<link href="http://realestate.homula.com/wp-content/themes/realsite/css/lightbox.css" rel="stylesheet">
    <script src="http://realestate.homula.com/wp-content/themes/realsite/js/lightbox.js"></script> --> 
    <script>
    /*lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })*/
</script> 
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
      
           var jssor_1_SlideshowTransitions = [
              {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:1200,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];
			
            var jssor_1_options = {
              $AutoPlay: true,
			  $SlideDuration: 0,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 4,
                $SpacingX: 8,
                $SpacingY: 8,
                $Align: 360,
                $ParkingPosition: 364,
				$Scale: false
              }
            };
      var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 752);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*responsive code end*/
      
      /*var map_property = $('#map-position');
    
        if (map_property.length) {
          map_property.google_map({
            center: {
              latitude: '43.6291393',
              longitude: '-79.4972528'
            }
          });
        }*/
		
			/*$(".jssort01 div:nth-child(2)").children("div").click(function(e) {
				//alert($(this).html());
				 $(this).css('transform', 'translate3d(364px, 0px, 0px)');
            });*/
		
        	jQuery("#home_a").trigger("click");   
        });
    </script> 
    <script>
              jQuery(document).ready(function(e) {
                    jQuery(".lightslide div a").lightBox();
                });
        
        jQuery(window).load(function(e) {
          <?php if(is_numeric($row['price'])){?>
            jQuery('#homeValue').val(<?php echo $row['price'];?>);
            jQuery('#loanAmount').val(<?php echo $row['price'];?>);
          <?php }?>
            jQuery(".mg-calculator-submit").trigger('click');
        });
            </script> 
    <script>
      	$("#advanced_features_div").click(function(e) {
			if ( $("#advanced_features_content").css('display') == 'none' ){
				$("#advanced_features_div").removeClass("collapsed");
			}else{
				$("#advanced_features_div").addClass("collapsed");
			}
            $("#advanced_features_content").toggle("fast");
        });
		
		$("#property_overview_div").click(function(e) {
			if ( $("#property_overview_content").css('display') == 'none' ){
				$("#property_overview_div").removeClass("collapsed");
			}else{
				$("#property_overview_div").addClass("collapsed");
			}
            $("#property_overview_content").toggle("fast");
        });
		
		$("#walkscore_div").click(function(e) {
			if ( $("#walkscore_content").css('display') == 'none' ){
				$("#walkscore_div").removeClass("collapsed");
			}else{
				$("#walkscore_div").addClass("collapsed");
			}
            $("#walkscore_content").toggle("fast");
        });
		$("#position_div").click(function(e) {
			if ( $("#position_content").css('display') == 'none' ){
				$("#position_div").removeClass("collapsed");
			}else{
				$("#position_div").addClass("collapsed");
			}
            $("#position_content").toggle("fast");
        });
		
		
      </script> 
  </div>
</div>
<br />
<?php 
  if($showMoreListings!="no"){ 
    if($ptype!="viewFullListing"){
  ?>
<h3 class='reHeading1 pd_30'><i class="fa fa-building visib_xs" aria-hidden="true" style="display:none"></i><?php print $relanguage_tags["Similar listings based on your search criteria"];?></h3>
<div id='reResults2'></div>
<?php 
    }
  } 
  return ob_get_clean();
}
?>
<script type="text/javascript">
   jQuery(document).ajaxStop(function() {
    if (window.addthis) {
    window.addthis = null;
    window._adr = null;
    window._atc = null;
    window._atd = null;
    window._ate = null;
    window._atr = null;
    window._atw = null;
    }
    return jQuery.getScript("http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58351a9bbda6054f");
    
  });
</script>
<style>
.wrap-box{
	height:auto !important;
	min-height:200px !important;	
}

</style>
