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
include_once("errorReporting.inc.php");
if(function_exists('date_default_timezone_set')) date_default_timezone_set('America/Toronto');

$oodleListings=array();

/*  Filters the output of searchResults2 through registerd hooks */
function searchResults($reFullQuery,$onlyMemberListings="no",$showFavorite="no"){
 /*
 * Filters data through the functions registered for "searchResults" hook.
 * Passes the content through registered functions.
 */
  print call_plugin("searchResults",searchResults2($reFullQuery,$onlyMemberListings,$showFavorite));
}

/*  This function gets the search criteria and shows listings as per it */
function searchResults2($reFullQuery,$onlyMemberListings="no",$showFavorite="no"){
	include("config.php");
	ob_start();
	
	list($reClassification,$reType,$reSubtype,$reBedrooms,$reBathrooms,$rePrice,$reQuery,$reCity,$listingsPerPage,$pageNum,$sortby)=explode(":",$reFullQuery);
	$rePartialQuery="$reClassification:$reType:$reSubtype:$reBedrooms:$reBathrooms:$rePrice:$reQuery:$reCity";
	$mem_id=$_SESSION["re_mem_id"];
	//$mem_id=isset($_SESSION["actual_re_mem_id"]) ? $_SESSION["actual_re_mem_id"] : $_SESSION["re_mem_id"];
	
	reSetSearchSession($reClassification,$reType,$reSubtype,$reBedrooms,$reBathrooms,$rePrice,$reQuery,$reCity);
	
	//print "$reFullQuery<br />";
	if($onlyMemberListings=="yes"){
		$extraMessage=" your ";
		$functionType=7;
	}else{
		$functionType=1;
	}
	
	if($showFavorite==="yes") $functionType=24;
	
	if($listingsPerPage=="")$listingsPerPage=20;
	if($pageNum=="")$pageNum=1;
	
	
	$startListingNum=($pageNum-1)*$listingsPerPage;
	$endListingNum=$startListingNum+$listingsPerPage;
	$startListingNum2=$startListingNum+1;
	
	if($rePrice != ''){
		$sortby = "priceDown";
	}
	
	if($sortby==""){
		$sortby="dateUp";
	}
	
	if($sortby=="priceUp"){
		$priceSort="priceDown";
		$priceSortClass=$priceSort;
		$sortbyClause=" price desc ";
	}
	if($sortby=="priceDown"){
		$priceSort="priceUp";
		$priceSortClass=$priceSort;
		$sortbyClause=" price asc ";
	}
	if($priceSort==""){
		$priceSort="priceDown";
		$priceSortClass="";
	}
	if($sortby=="cityUp"){
		$citySort="cityDown";
		$citySortClass=$citySort;
		$sortbyClause=" city desc ";
	}
	if($sortby=="cityDown"){
		$citySort="cityUp";
		$citySortClass=$citySort;
		$sortbyClause=" city asc ";
	}
	if($citySort==""){
		$citySort="cityDown";
		$citySortClass="";
	}
	if($sortby=="dateUp"){
		$dateSort="dateDown";
		$dateSortClass=$dateSort;
		$sortbyClause=" dttm desc ";
	}
	if($sortby=="dateDown"){
		$dateSort="dateUp";
		$sortbyClause=" dttm asc ";
		$dateSortClass=$dateSort;
	}
	if($dateSort==""){
		$dateSort="dateDown";
		$dateSortClass="";
	}
	
	if($delete_after_days>0){
		$str_older = date("Y-m-d");
		$str_month = date("n");
		$str_day = date("j");
		$str_year = date("Y");
		$minmonth = mktime(0, 0, 0, $str_month, $str_day - $delete_after_days ,  $str_year );
		$str_older = date("Y-m-d",$minmonth);
		$str_older_dttm="$str_older 23:59:59";
		
		$qr00="select count(*) from $reListingTable";
		$result00=mysql_query($qr00);
		$row00=mysql_fetch_array($result00);
		$numResults00=$row00[0];
		$dttm_mod_clause=" and dttm_modified > '$str_older_dttm' ";
	}else{
		$dttm_mod_clause="";	
	}
	
	if(isset($_SESSION["memtype"]) && $_SESSION["memtype"]==9) $adminClause1=" id like '%' ";
	else  $adminClause1=" listing_type <> 3 ";
	
	if($functionType==7) $adminClause1=" id like '%' ";
	if(isset($_SESSION["memtype"]) && $_SESSION["memtype"]==9){
		$flagClause=" flag desc, ";    
	}else $flagClause="";
	
	if($showFavorite=="no"){
		$tmp_url_array = explode("/",$_SERVER['HTTP_REFERER']);
		$tmp_page_name = end($tmp_url_array);
		$pos = strpos($tmp_page_name, 'favorites.php');
		if ($pos !== false) {
			$qr0= "SELECT favorites.id as fid, $reListingTable.* 
				   FROM $reListingTable
				   LEFT JOIN favorites ON $reListingTable.id = favorites.property_id
				   WHERE (favorites.user_id = '".$_SESSION['wp_login_user_id']."' OR favorites.ip = '".$_SERVER["REMOTE_ADDR"]."') AND favorites.page = 'Realestate'";
		}else{
			/*
			$qr0="select * from $reListingTable WHERE 1 = 1 AND $adminClause1 ".getRealValue($reClassification,"reClassification")
																							 .getRealValue($reType,"reType")
																							 .getRealValue($reSubtype,"reSubtype")
																							 .getRealValue($reBedrooms,"reBedrooms")
																							 .getRealValue($reBathrooms,"reBathrooms")
																							 .getRealValue($rePrice,"rePrice")
																							 .getRealValue($onlyMemberListings,"onlyMemberListings")
																							 .getRealValue($reQuery,"reQuery")
																							 .getRealValue($reCity,"reCity")." 
			 				$dttm_mod_clause ORDER BY $reListingTable.price ASC; ";
			*/
			$qr0="select * from $reListingTable WHERE 1 = 1 AND $adminClause1 $dttm_mod_clause ORDER BY $reListingTable.price ASC; ";
		}
		$result0=mysql_query($qr0);
		$numResults=mysql_num_rows($result0);
		$totalPages=ceil($numResults/$listingsPerPage);
		
		if ($pos !== false) {
			$qr1= "SELECT favorites.id as fid, $reListingTable.* 
				   FROM $reListingTable
				   LEFT JOIN favorites ON $reListingTable.id = favorites.property_id
				   WHERE (favorites.user_id = '".$_SESSION['wp_login_user_id']."' OR favorites.ip = '".$_SERVER["REMOTE_ADDR"]."') AND favorites.page = 'Realestate'";
		}else{
			/*
			$qr1="select * from $reListingTable where 1 = 1 AND $adminClause1 ".getRealValue($reClassification,"reClassification")
																							 .getRealValue($reType,"reType")
																							 .getRealValue($reSubtype,"reSubtype")
																							 .getRealValue($reBedrooms,"reBedrooms")
																							 .getRealValue($reBathrooms,"reBathrooms")
																							 .getRealValue($rePrice,"rePrice")
																							 .getRealValue($onlyMemberListings,"onlyMemberListings")
																							 .getRealValue($reQuery,"reQuery")
																							 .getRealValue($reCity,"reCity")
			." $dttm_mod_clause order by $flagClause listing_type DESC, $sortbyClause limit $startListingNum,$listingsPerPage ; ";
			*/
			$qr1="select * from $reListingTable WHERE 1 = 1 AND $adminClause1 $dttm_mod_clause order by $flagClause listing_type DESC, $sortbyClause limit $startListingNum,$listingsPerPage ; ";
		}
		//echo $qr1;exit;
		$result=mysql_query($qr1);
		//print "$rePrice<br />$numResults - $qr1<br />";
		while($line = mysql_fetch_assoc($result)) $combArray[] = $line;
			$startFrom=0;
			$endAt=sizeof($combArray);
	}else{
		$allfavs=explode(":",$_SESSION["marked_reid"]);
		$favcounter=0;
		foreach($allfavs as $favc => $favid){
			$favArr=getFavRecord($favid);
			if(is_array($favArr)) $combArray[$favcounter]=$favArr; 
			$favcounter++;
		}
		if($sortby==="")$sortby="dateUp";
		usort($combArray, $sortby);
		$startFrom	= 0;
		$endAt		= sizeof($combArray);
		$numResults	= $endAt;
		$favClause1	= " ".__("Favorite")." ";
		//print "size: $endAt"; print_r($combArray);
	}
	
	if($endListingNum>$numResults)$endListingNum=$numResults;
	
	$combArray=call_plugin("searchResultsRecords",$combArray);
	
	if($numResults > 0){
		print "<table id='resultTable' class='table table-striped'>";
		print "<thead><tr class='headRow1 pag_bt'><td colspan='2'>".$relanguage_tags["Showing"]." <b>$startListingNum2 - $endListingNum</b> ".__("of")." $extraMessage<b>$numResults</b> ".$relanguage_tags["listings"].". </td>
		<td colspan='3' class='shownumResults'>"; 
		if($pageNum==1){
		?>
			<div class='pull-right'><?php print $relanguage_tags["Show"];?> <select name='subtype' id='reListingsPerPage1' >
			<option value='<?php print "$rePartialQuery:20:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==20)print " selected='selected' "; ?>>20</option>
			<option value='<?php print "$rePartialQuery:40:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==40)print " selected='selected' "; ?>>40</option>
			<option value='<?php print "$rePartialQuery:60:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==60)print " selected='selected' "; ?>>60</option>
			<option value='<?php print "$rePartialQuery:80:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==80)print " selected='selected' "; ?>>80</option>
			<option value='<?php print "$rePartialQuery:100:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==100)print " selected='selected' "; ?>>100</option>
			<?php 
			print "</select> ".$relanguage_tags["listings"]."/".$relanguage_tags["page"];
		}
		print "</div></td></tr></thead>";
		print "<tbody><tr class='headRow2'><td></td><td  style='color:#A4A4A4; text-align:right;'>".__("Sort by")."</td>"; 
		
		
		?>
		<td align='center' class='hsorting'><a href='#'><span style="display:none;"><?php print "$rePartialQuery:$listingsPerPage:$pageNum:$priceSort-@@-$functionType"; ?></span><?php print $relanguage_tags["Price"];?></a><div class="<?php print $priceSortClass; ?>"></div></td>
		<td class='hsorting'><a href='#'><span style="display:none;"><?php print "$rePartialQuery:$listingsPerPage:$pageNum:$citySort-@@-$functionType"; ?></span><?php print $relanguage_tags["City"];?></a><div class='<?php print $citySortClass; ?>'></div></td>
		<td class='hsorting'><a href='#'><span style="display:none;"><?php print "$rePartialQuery:$listingsPerPage:$pageNum:$dateSort-@@-$functionType"; ?></span><?php print $relanguage_tags["Date"];?></a><div class='<?php print $dateSortClass; ?>'></div></td></tr>
		<tr id='new_row_st'><td colspan='5' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		<div class='container-fluid'>
		<?php 
		$count=0;$rwc=0;
		//while($row=mysql_fetch_assoc($result)){
		for($c=$startFrom;$c<$endAt;$c++){
			$rwc++;
			if($count>=$listingsPerPage) break;
			$row=$combArray[$c];
			$smallDesc=utf8_substr($row['description'],0,250)."....";
			//$smallHeadline=substr($row['headline'],0,75);
			list($listingDate,$listingTime)=explode(" ",$row['dttm']);
			//$listingDate = date("d/m/Y", strtotime($listingDate));
			$rePicArray=explode("::",$row['pictures']);
			if(sizeof($rePicArray) == 1){
				$totalRePics=sizeof($rePicArray);
			}else{
				$totalRePics=sizeof($rePicArray)-1;
			}
			if($row['price']==0){ $row['price']=""; $fullprice=""; 
			}else{
				$row['price']=number_format($row['price']);    
				if($currency_before_price) $fullprice=$defaultCurrency.$row['price'];
				else $fullprice=$row['price']." ".$defaultCurrency;
			} 
			if($row['resize']==0)$row['resize']="";
			
			if($totalRePics>=1) $firstPic=$rePicArray[0];
			else $firstPic="images/no-image.png";
			
			if($row['listing_type']==2){ $featuredClass= " featuredClass alert-info "; $featuredClassChild=" speciallistingChild "; }
			elseif($row['listing_type']==3){$featuredClass= " inavtiveClass alert-danger "; $featuredClassChild=" inactivelistingChild "; }
			elseif($row['flag']>0 && isset($_SESSION["memtype"]) && $_SESSION["memtype"]==9){
				$featuredClass= " flagClass alert-warning "; $featuredClassChild=" flaglistingChild ";
			}else{ $featuredClass=""; $featuredClassChild=""; }
			
			
			$newDateFormat=explode("-",$listingDate);
			
			if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true){
				$listingImageClause=" pull-right ";
				$listingstatusClause=" style='float:right;' ";
				$listingLabelClause=" pull-left ";
			}else{
				$listingImageClause=" pull-left ";
				$listingstatusClause=" style='float:left;' ";
				$listingLabelClause=" pull-right ";
			}
			
			/* Row starts */
			if($totalRePics>1){ ;if($totalRePics>$reMaxPictures) $totalRePics=$reMaxPictures; } ?>
			
			<div class='listingRow marg_2sid <?php if($rwc%2==0){echo "st1";}?> row <?php print $featuredClass; ?>' id='parent-row<?php print $row['id']; ?>'>
			<div class='listingSmallImage col-xs-7 col-sm-3 col-md-3 col-lg-3 <?php print $listingImageClause; ?>'>
			<?php 
			if($firstPic!="images/no-image.png" && $firstPic != ''){
				$style_attr=" style='display:block;' ";   
				$piccount=0;  
				foreach($rePicArray as $pid=>$pval){
					if(trim($pval)!=""){  
					$piccount++;      
					$pval	= $SitePath.'/uploads/'.$pval;
					?>   
						<div class='overlayContainer'> 
						<a rel='prettyPhoto[<?php print $row['id']; ?>]' <?php print $style_attr; ?> href='<?php print $pval; ?>' ><img class='img-thumbnail img-responsive' border='0' src='timthumb.php?src=<?php print $pval; ?>&h=140' /><?php if($piccount==1){ ?><div class='imgOverlay1'><i class='icon-large icon-picture'></i> <?php print $totalRePics; ?></div><?php } ?></a>
						</div>
					<?php
						$style_attr=" style='display:none;' ";
					}   
				}
			}else{ ?>
				<img border='0' src='images/no-image.png' />    
			<?php 
			} ?>
			
			</div>
			<?php 
			if($row['address']!="") $listingTitle=$row['address']; else $listingTitle=__("Address Not Disclosed");
			if($row['city']!="")$listingAddress=$row['city'];
			if($row['state']!="")$listingAddress=$listingAddress.", ".$row['state'];
			if($row['postal']!="")$listingAddress=$listingAddress." ".$row['postal'];
			if($row['retype']=="Residential" && $row['subtype']!="Land"){ 
			$row['bedrooms']=str_replace("den", " + Den", $row['bedrooms']);
			if(strlen($row['bedrooms'])>0){
			   if(stripos($row['bedrooms'],"Den")===false && stripos($row['bedrooms'],"Bachelor")===false) $bedrooms=$row['bedrooms']." ".__("beds"); 
			   else $bedrooms=$row['bedrooms'];
			}else $bedrooms="";
			if($row['bathrooms']!="")$bathrooms=$row['bathrooms']." ".__("baths"); else $bathrooms="";
			}else $bedrooms="";
			
			$headline_slug=friendlyUrl($row['headline']);
			if($row['user_id']=="oodle") $region_slug=$row['country']; else $region_slug="";
			if($refriendlyurl=="enabled") 
			{
				if(trim($row['subtype'])==""){
					$row['subtype'] = "none";
				}
				$relistingLink=friendlyUrl($row['retype'],"_")."/".friendlyUrl($row['subtype'],"_")."/"."id-".$row['id']."-".$region_slug."-".$headline_slug;
			}
			else $relistingLink="index.php?ptype=viewFullListing&reid=".$row['id']."&title=$title_slug";
			?>
			<div class='col-xs-5 col-sm-9 col-md-9 col-lg-9 sty_nleft'>
			<div class='row head1'>    
			 <div class='col-xs-12 col-sm-8 col-md-8 col-lg-8 listingTitle text-primary'><a href='<?php print $relistingLink; ?>'><?php print $listingTitle; ?></a></div>   
			 <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 listingPrice txt-align-r'><?php print $fullprice; ?></div>
			 <div class='listingAddresstop' style="display:none;"><?php print $listingAddress; ?></div>
			</div>
			
			 <div class='row'>
				 <div class='col-sm-5 col-md-5 col-lg-5'>
					 <div class='listingAddress'><?php print $listingAddress; ?></div>
					 <div><?php //print $listingDate; ?></div>
					 </div>
				 <div class='col-sm-2 col-md-2 col-lg-2 bd_rom'>
					 <?php if(__($row['subtype'])!="Land"){ ?>
					 <div class='listingBeds'><?php print $bedrooms; ?></div>
					 <div class='listingBaths'><?php print $bathrooms; ?></div>
					 <?php } ?>
				 </div>
				 <div class='col-sm-3 col-md-3 col-lg-3'>
					 <div class='listingType'><?php print __($row['retype']); ?></div>
					 <div class='listingSubtype'><?php print __($row['subtype']); ?></div>
				 </div>
				 <div class='col-sm-2 col-md-2 col-lg-2'>
					 <div class='listingClassification txt-align-r'><?php print __($row['classification']); ?></div>
					 <div class='listingPricebt txt-align-r' style="display:none;"><?php print $fullprice; ?></div>
					 <div class='listingSize txt-align-r'><?php if(trim($row['resize'])!="") print __($row['resize'])." ".__("sq-ft"); ?></div>
				 </div>
			 </div>
			 
			 <div class='row' style='margin-top:10px;' >
			<?php 
			if($_SESSION["memtype"]==9){ 
			?>
				 <div class='listing_status col-sm-4 col-md-4 col-lg-4' <?php print $listingstatusClause; ?> id='listingstatus<?php print $row['id']; ?>' ><?php print __("Change status");?>: 
						 <select name='listingtype' id='listingtype' onchange="infoResults(this.value+'<?php print "::".$row['id']; ?>',14,'listingstatus<?php print $row['id']; ?>');">
				<option value='1' <?php if($row['listing_type']=="" || $row['id']==1){ print "selected='selected'"; } ?>><?php print $relanguage_tags["Normal"];?></option>
				<!-- <option value='3' <?php if($row['listing_type']==3){ print "selected='selected'"; } ?>>Top</option> -->
				<option value='2' <?php if($row['listing_type']==2){ print "selected='selected'"; } ?>><?php print $relanguage_tags["Featured"];?></option>
				<option value='3' <?php if($row['listing_type']==3){ print "selected='selected'"; } ?>><?php print __("Inactive");?></option>
				</select>
				</div>
			<?php 
			} ?>
			
			<div class="col-sm-6 col-md-6 col-lg-6 listingAttributes">
			<?php
			print hasVisited($row['id']);
			if($row['listing_type']==2){ print "<span class='featuredlisting label label-primary'>".$relanguage_tags["Featured"]."</span>"; }
			if($row['flag']>0 && isset($_SESSION["memtype"]) && $_SESSION["memtype"]==9){ print "<span class='featuredlisting label label-danger'>".__("Flagged")." ".$row['flag']." ".__("times")."</span>"; }
			?>
			</div>
			
			 </div>
			
			<div class='row'>
			<div class='col-sm-12 col-md-12 col-lg-12 row-btn-more'>
			<?php showMemberNavigation($row['user_id'],$mem_id,$row['id'],1); ?>
	            
				<a class='moreInfo btn btn-sm btn-success' href='<?php print $relistingLink; ?>'><?php print $relanguage_tags["More Information"];?></a>
				<?php
				if ($pos !== false) {
				?>
					<a class='btn btn-sm btn-danger' style="cursor:pointer;margin-bottom: 10px;" onClick="javascript:deletefavorite(<?php echo $row['fid'];?>);">Delete</a>
                    <a class='btn btn-sm btn-primary' style="cursor:pointer;margin-bottom: 10px; margin-right:5px;" onClick="javascipt:favcompareproperty('<?php echo $row['id']?>');">Compare</a>
				<?php
				}
				?>
                
			</div>
			</div>
			 </div>
			</div> 
			
			<?php 	
			$count++;
			/* Row Ends */
		
		}
		?>
		</div>
		</td></tr>
		<?php
		if($delete_after_days>0){
			if ($numResults00>$numResults) autoDeleteListings($str_older_dttm);
		}
		autoUpdateStatus();
		//autoDeleteListings($listingdttm,$listingpics);
		print "<tr class='headRow1'><td class='hiddtd' colspan='2'>".$relanguage_tags["Showing"]." <b>$startListingNum2 - $endListingNum</b> ".__("of")." <b>$numResults</b> ".$relanguage_tags["listings"].". </td>
		<td colspan='3' class='shownumResults'>"; 
		if($pageNum==1){
		?>
			<div class='pull-right'><?php print $relanguage_tags["Show"];?> <select name='subtype' id='reListingsPerPage2' >
			<option value='<?php print "$rePartialQuery:20:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==20)print " selected='selected' "; ?>>20</option>
			<option value='<?php print "$rePartialQuery:40:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==40)print " selected='selected' "; ?>>40</option>
			<option value='<?php print "$rePartialQuery:60:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==60)print " selected='selected' "; ?>>60</option>
			<option value='<?php print "$rePartialQuery:80:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==80)print " selected='selected' "; ?>>80</option>
			<option value='<?php print "$rePartialQuery:100:$pageNum:$sortby-@@-$functionType"; ?>' <?php if($listingsPerPage==100)print " selected='selected' "; ?>>100</option>
			<?php 
			print "</select> ".$relanguage_tags["listings"]."/".$relanguage_tags["page"]."";
		}
		print "</div></td></tr>";
		if($pageNum==1)$pgClassStart="disabled";
		else $pgClassStart="pgNav";
		if($pageNum==$totalPages)$pgClassEnd="disabled";
		else $pgClassEnd="pgNav";
		$nextPage=$pageNum+1;
		$prevPage=$pageNum-1;
		
		if($pageNum<5){
			$maxNumOfPagesInNavigation=5;
			$newFirstPage=1;
		}else{
			$newFirstPage=$pageNum-2;
			$maxNumOfPagesInNavigation=$pageNum+2;
		}
		
		print "<tr class='trpagination'><td colspan='5'><div class='pull-right'><ul class='pagination'>"; ?>
		<li class='<?php print $pgClassStart; ?>'><a href='javascript: void(0)'><span style="display: none;"><?php print "$rePartialQuery:$listingsPerPage:$prevPage:$sortby-@@-$functionType"; ?></span><?php print $relanguage_tags["Previous"];?></a></li>
		<?php 
		if($maxNumOfPagesInNavigation>$totalPages) $maxNumOfPagesInNavigation=$totalPages;
		for($pg=$newFirstPage;$pg<=$maxNumOfPagesInNavigation;$pg++){
			if($pg!=$pageNum){
			 ?>
			<li><a href='javascript: void(0)' class='pgNav'><span style="display: none;"><?php print "$rePartialQuery:$listingsPerPage:$pg:$sortby-@@-$functionType"; ?></span><?php print $pg; ?></a></li>
		<?php 
			}else{
			 ?>
			<li class='active'><a href='javascript: void(0)'><span style="display: none;"><?php print "$rePartialQuery:$listingsPerPage:$pg:$sortby-@@-$functionType"; ?></span><?php print $pg; ?></a></li>
		<?php 	
			}
		}
		?>
		<li class='<?php print "$pgClassEnd"; ?>'><a href='javascript: void(0)'><span style="display:none"><?php print "$rePartialQuery:$listingsPerPage:$nextPage:$sortby-@@-$functionType"; ?></span><?php print $relanguage_tags["Next"];?></a></li></ul></div></td></tr>
		<?php
		print "</tbody></table>";
	}else{
			print "<h4 align='center'>".__("No results found")."</h4>";
			
	}
	return ob_get_clean();
}

/* Gets favorite record from the database as per listing id */
function getFavRecord($favid){
	include("config.php");
	if(trim($favid)!=""){
		$qr="select * from $reListingTable where id='$favid' ";
		$result=mysql_query($qr);
		if(mysql_num_rows($result)) return mysql_fetch_assoc($result);
		else{ return "";
		    /*
			require_once('geoplugin.class.php');
			$geoplugin = new geoPlugin();
			$geoplugin->locate();
			$vCountry=$geoplugin->countryName;
			$oodlecRegion=getOodleRegion($vCountry);
            $oodleArr=array();
			if(function_exists("getOodleArray"))
			$oodleArr=convertArrayToClFormat(getOodleArray("","",$favid,"",$oodlecRegion));
			return $oodleArr[0];
             * */
		}
	}
}

/* Retrieve oodle's default currency as per the region */
function getOodleCurrency($region,$defaultCurrency){
	$currencies=array("canada"=>"$", "united states"=>"$", "usa"=>"$", "ireland"=>"�", "india"=>"Rs ", "united kingdom"=>"�");
	$region=strtolower($region);
	if(array_key_exists($region, $currencies)) return $currencies[$region];
	else $defaultCurrency;
}

/* Fetch the translation for a tag and returns it */
function __($tag){
    session_start();
    $translation=$tag;
    if(isset($_SESSION["re_language"][$tag])) $translation=$_SESSION["re_language"][$tag];
    elseif(isset($_SESSION["re_language"][strtolower($tag)])) $translation=$_SESSION["re_language"][strtolower($tag)];
    else $translation=$tag;
    return trim($translation);
}

/* Date desc sorting */
function dateDown($a, $b)
{
	$t1 = strtotime($a['dttm']);
	$t2 = strtotime($b['dttm']);
	return $t1 - $t2;
}

/* Date asc sorting */
function dateUp($a, $b)
{
	$t1 = strtotime($a['dttm']);
	$t2 = strtotime($b['dttm']);
	return $t2 - $t1;
}

/* This function sorts listing by their type i.e. normal, featured or inactive */
function listingTypeSort($a, $b){
	return $b['listing_type'] - $a['listing_type'];
}

/* Price desc sorting */
function priceDown($a, $b)
{
	return $a['price'] - $b['price'];
}

/* Price desc sorting */
function priceUp($a, $b)
{
	return $b['price'] - $a['price'];
}

/* City desc sorting */
function cityDown($a, $b)
{
	return strcasecmp($a['city'],$b['city']);
}

/* City desc sorting */
function cityUp($a, $b)
{
	return strcasecmp($b['city'],$a['city']);
}

/* Automatically delete listings that have expired as per the limit specified in admin options */
function autoDeleteListings($str_older_dttm){
	include("config.php");
	$qrexp="select pictures from $reListingTable where 	dttm_modified <= '$str_older_dttm' and listing_type='1'";
	$resultexp=mysql_query($qrexp);
	$expcount=0;
		while($allexpPics=mysql_fetch_assoc($resultexp)){
		$thepics=explode("::",$allexpPics['pictures']);
		$totpics=sizeof($thepics);
		for($i=0;$i<$totpics;$i++) if(trim($thepics[$i])!="") unlink($thepics[$i]);
		$expcount++;
		}
	$delqr="delete from $reListingTable where dttm_modified <= '$str_older_dttm' and listing_type='1'";
	$resultdel=mysql_query($delqr);
	
}

/* Change featured listing status to normal once featured duration is over */
function autoUpdateStatus(){
	include("config.php");
	$now_dttm=date("Y-m-d H:i:s");	
	$reqr1="update $reListingTable set listing_type='1', dttm_modified = '$now_dttm' where  listing_type='2' and featured_till<='$now_dttm' and featured_till<>'0000-00-00 00:00:00' ";
	$resultre1=mysql_query($reqr1);	
	//print $reqr1;
}

/* Checks if a viewer has already viewed the listing */
function hasVisited($reid){
	include("config.php");
	if(trim($_SESSION["reid"])=="") if(isset($_COOKIE['reidvisit'])) $_SESSION["reid"] = $_COOKIE['reidvisit'];
	if(trim($_SESSION["marked_reid"])=="") if(isset($_COOKIE['markedreid'])) $_SESSION["marked_reid"] = $_COOKIE['markedreid'];
	
	$allreid=explode(":",$_SESSION["reid"]);
	$allMarkedreid=explode(":",$_SESSION["marked_reid"]);
	$retString="";
	
	if(in_array($reid,$allreid)) $retString="<span class='alreadySeen label label-info'' title='".$relanguage_tags["You have already seen this listing"].".'>".$relanguage_tags["Viewed"]."</span>";
	if(in_array($reid,$allMarkedreid)) $retString=$retString."<span class='listingMarked label label-success' title='".$relanguage_tags["This listing has been liked by you"].".'>".$relanguage_tags["Liked"]."</span>";
	return $retString;
}

/* Saves the search preferences in SESSION variables */
function reSetSearchSession($reClassification,$reType,$reSubtype,$reBedrooms,$reBathrooms,$rePrice,$reQuery,$reCity){
	$_SESSION["reClassification"]=$reClassification;
	$_SESSION["reType"]=$reType;
	$_SESSION["reSubtype"]=$reSubtype;
	$_SESSION["reBedrooms"]=$reBedrooms;
	$_SESSION["reBathrooms"]=$reBathrooms;
	$_SESSION["rePrice"]=$rePrice;
	$_SESSION["reQuery"]=$reQuery;
	$_SESSION["reCity"]=$reCity;
}

/* Checks if a member has logged in and shows edit, delete buttons */
function showMemberNavigation($current_mem_id,$mem_id,$reid,$rePageType){
	include("config.php");
	if(isset($_SESSION["myusername"]))
	if($current_mem_id==$mem_id || $_SESSION["memtype"]==9){ print "<a class='moreInfo btn btn-sm btn-info' href='index.php?ptype=editReListingForm&reid=$reid'>".$relanguage_tags["Edit Listing"]."</a>"; ?>
	<span onclick="javascript:confirmListingdelete('<?php print $reid; ?>',<?php print $rePageType; ?>);" class='moreInfo btn btn-sm btn-info'><?php print $relanguage_tags["Delete Listing"]; ?></span>
	<?php 
	}
}

/* Shows registration form */
function registerUser($q){
	include("config.php");
	//list($reusername,$temp)=split(":",$q);
	if(isset($_SESSION["myusername"])){
		?>
		Welcome <b><?php print $_SESSION["myusername"]; ?></b>
		<?php
	}else{
		/* onkeyup="if(this.value.match(/[^\w+$ ]/g)) { this.value = this.value.replace(/[^\w+$ ]/g, '');}" */
		$randnum=rand(100,10000);
		?>
		<h3 align='center'><?php print $relanguage_tags["Please register"];?></h3>
		<form id="registerForm" name="registerForm" class="registerForm"  method="post" action="reRegister.php">
		<table border='0' style="margin:10px auto;">
		<tr><td><b><?php print $relanguage_tags["Username"];?>:</b></td><td><input id="reusername"  name="myusername" size='20'  type="text" maxlength="255" value="<?php print $_SESSION['reg_username']; ?>" onblur="infoResults(this.value,5,'usernameMessage');"  /> 
		<br /><div id='usernameMessage'></div></td></tr>
		<tr><td><b><?php print $relanguage_tags["Email"];?>:</b></td><td><input id="reemail"  name="myemail" size='20' type="text" maxlength="255" value="<?php print $_SESSION['reg_email']; ?>"/> </td></tr>
		<tr><td><b><?php print $relanguage_tags["Password"];?>:</b></td><td><input id="repassword"  name="mypassword" size='20' type='password'  maxlength="255" value=""/> </td></tr>
		<tr><td><b><?php print $relanguage_tags["Confirm"];?>:</b></td><td><input id="recpassword"  name="mycpassword" size='20' type='password'  maxlength="255" value=""/> </td></tr>
		<?php if($enableRegisterCaptcha){ ?>
		<tr><td colspan='2'>
		<div id='captchaImage'>
		<img id="captcha" src="securimage/securimage_show.php?<?php print $randnum; ?>" alt="CAPTCHA Image" />
		</div>
		</td></tr>
		<tr><td><b><?php print __("Enter the words"); ?></b></td><td><input type="text" name="captcha_code" id="captcha_code" size="10" maxlength="6" /></td></tr>
		<?php } ?>
		<tr><td colspan='2' align='right'><input id="registerButton2"  class='btn btn-sm btn-success' type="button" name="register" value="<?php print $relanguage_tags["Register"]; ?>" onclick="return validateRegForm()" /></td></tr>
		<tr><td colspan='2' align='right'></td></tr>
		<tr><td colspan='2' align='right'>
		<span class='small' id='loginLink2'><?php print $relanguage_tags["Already registered"];?>? <a href='javascript: void(0)'><?php print $relanguage_tags["Login here"];?></a></span><br />
		<span id='forgotPasswordLink2' class='small'><a href='javascript: void(0)'><?php print $relanguage_tags["Forgot password"]; ?>?</a></span></td></tr>
		</table>
		</form>
		<?php
	}
	
}

/* Shows login form */
function showLoginForm(){
	include("config.php");
	include("loginForm.php");
}

/* This function checks if a user with the specified username already exists */
function checkUsernameExists($q){
	if(trim($q)!=""){
		include("config.php");	
		$qr="select id from $rememberTable where username='$q';";	
		$result=mysql_query($qr);
		if(mysql_num_rows($result)>0) print "<span class='redMessage'>Username not available. Please choose a different username.</span>";
	}
}

/* Saves registration data in database */
function completeRegistration($q){
	include("config.php");
	include_once 'securimage/securimage.php';
	$securimage = new Securimage();
	list($reusername,$reemail,$retextpassword,$captcha_code,$page)=explode(":::",$q,5);
    $repassword=md5($retextpassword);
    $_SESSION['reg_username']=$reusername;
    $_SESSION['reg_email']=$reemail;
	if ($securimage->check($captcha_code) == false && $enableRegisterCaptcha) {
	    if($page!="splash"){
			print __("Please enter the word challenge exactly as it appears")." ".$captcha_code." ".__("is incorrect")."."; ?>
			<br /><a href='javascript: void(0)' onclick="infoResults('register',2,'sidebarLogin');"><?php print $relanguage_tags["Please try again"]; ?></a>.
	<?php 	}else print "1";
    }else{
	$str_today = date("Y-m-d");
	$ip=$_SERVER["REMOTE_ADDR"];
	$qr="insert into $rememberTable (username,password,email,dttm,ip) values ('$reusername','$repassword','$reemail','$str_today','$ip')";
	if(mysql_query($qr)){
		if($page!="splash"){
        print "<h3 align='center'>".$relanguage_tags["Registration successful"]."</h3>";
        ?>
		<h5 align='center'><a href='javascript: void(0)' onclick="infoResults('login',4,'sidebarLogin');"><?php print $relanguage_tags["Login here"]; ?></a>.</h5>
		<?php 
		}else print "2";
        sendPassword($reemail,'register',$retextpassword);
	}else{
	if($page!="splash"){    
	 print "<h4 align='center'>".$relanguage_tags["Registration failed."]."</h4>";
	 if(mysql_errno()==1062){
	  print "<h5 align='center'>".$relanguage_tags["Account associated with"]." $reemail or $reusername ".$relanguage_tags["already exists"].".";
	 ?>
	 <br /><a href='javascript: void(0)' onclick="infoResults('register',2,'sidebarLogin');"><?php print $relanguage_tags["Please try again"]; ?></a>.
	 <?php 
	  print"</h5>";
	 }
    }else print "3";
	}
	}
}

/* Shows forgot password form */
function forgotPasswordForm($q){
	include("config.php");
	if(isset($_SESSION["myusername"])){
		?>
			Welcome <b><?php print $_SESSION["myusername"]; ?></b>
			<?php
		}else{
			?>
            <form id="forgotPasswordForm" name="forgotPasswordForm" >
            <table border='0' align='center' width='98%'>
            <tr><td align='center'><b><?php print $relanguage_tags["Email"]; ?>:</b><input id="reemail"  name="myemail"  type="text" maxlength="255" value="" /></td></tr>
            <tr><td align='center'><input id="forgotPasswordButton"  class='btn btn-sm btn-info' type="button" name="register" value="<?php print $relanguage_tags["Send Password"]; ?>" onclick="return processForgotPassForm();" /></td></tr>
            <tr><td align='center'><br />
            <span class='small' id='loginLink2'><?php print $relanguage_tags["Already registered"];?>? <a href='javascript: void(0)'><?php print $relanguage_tags["Login here"]; ?></a></span><br />
            <span class='small' id='registerLink'><a href='javascript: void(0)' ><?php print $relanguage_tags["Register"]; ?>?</a></span></td></tr>
            </table></form>
			<?php }
}

/* Emails the password to the member's email */
function sendPassword($email,$requestType='forgot',$mpassword=''){
	include("config.php");
	$qr="select * from $rememberTable where email='$email'";
	$result=mysql_query($qr);
	print "<p align='center'>";
	if(mysql_num_rows($result)>0){
		$row=mysql_fetch_assoc($result);	
		$visitor_email=$gmailUsername;
		if($requestType=='forgot'){
		if($email=="test@finethemes.com") exit;    
		$mytextpassword=randomString(8);  
		$mypassword=md5($mytextpassword);  
		$qr2="update $rememberTable set password='$mypassword' where email='$email'";
		$result2=mysql_query($qr2);
		$msgbody=__("A forgot password request was initiated. Your login info is mentioned below with a new password").": <br /><br />
		".__("Username").": ".$row['username']."<br />
		".__("Password").": ".$mytextpassword."<br /><br />
		- <b>$reSiteName</b>";
		$subject=__("Password retrieval");
		print __("New password sent to your registered email").".<br /><span class='small'><a href='index.php'>".__("Login here")."</a></span></p>";
		
		}elseif($requestType=='register'){
		$msgbody=__("Thank you for registering. Your login info is mentioned below").": <br /><br />
		".__("Username").": ".$row['username']."<br />
		".__("Password").": ".$mpassword."<br /><br />
		- <b>$reSiteName</b>";
		$subject=__("Login Information");   
		}else{
		$msgbody=__("Your login info is mentioned below").": <br /><br />
		".__("Username").": ".$row['username']."<br />
		".__("Password").": ".$mpassword."<br /><br />
		- <b>$reSiteName</b>";
		$subject=__("Login Information");      
		}
		
		$to_email=$email;
		$to_name="Member";
		
	sendReEmail($visitor_email,$msgbody,$to_email,$to_name,$subject,false);	
	}else print "Email not found";

}

/* Generates a random string */
function randomString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}

/* This function fetches member's profile image and shows it */
function showProfileImage($q){
	include("config.php");
	$mem_id=$_SESSION["re_mem_id"];
	if($q!="no"){
		$qr="select * from $rememberTable where id='$mem_id'";
		$result=mysql_query($qr);
		$row=mysql_fetch_assoc($result);
		if($result) if(trim($row['photo'])!="") print "<img src='uploads/".$row['photo']."' width='200' />";
	}else{
		print "";
	}
}

// Start : Add Compare Properties from favorite page
function favcompareproperty($prid)
{
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	/* Start: Insert in favourites table*/
	$LoginUserID	= $_SESSION['wp_login_user_id'];
	$PropertyID		= $prid;
	$PageName		= 'Realestate';
	$IP				= $_SERVER["REMOTE_ADDR"];
	
	$chkSQL 	= "SELECT * FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND page = '".$PageName."'"; 
	$chkresult 	= mysql_query($chkSQL);
	$TotRec		= mysql_num_rows($chkresult);
	
	if($TotRec >= 2)
	{
		echo '2';exit;
	}
	else
	{
		$chkSQL 	= "SELECT * FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND property_id = '".$PropertyID."' AND page = '".$PageName."'"; 
		$chkresult 	= mysql_query($chkSQL);
		$TotRec		= mysql_num_rows($chkresult);
		if($TotRec > 0)
		{
			echo '4';exit;
		}
		else
		{
			$InsertRecord	= "INSERT INTO compare_properties SET user_id = '".$LoginUserID."',
													 property_id = '".$PropertyID."',
													 page = '".$PageName."', 
													 ip = '".$IP."'";
			mysql_query($InsertRecord);
			$chkSQL 	= "SELECT * FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND page = '".$PageName."'"; 
			$chkresult 	= mysql_query($chkSQL);
			$TotRec		= mysql_num_rows($chkresult);
			if($TotRec == 1)
			{
				echo '1';exit;
			}
			else
			{
				echo '0';exit;
			}
		}
		
	}
}
// End : Add Compare Properties from favorite page

// Start : Del Compare Properties
function delcompareproperty($cid, $from)
{
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	/* Start: Insert in favourites table*/
	$LoginUserID	= $_SESSION['wp_login_user_id'];
	$PageName		= 'Realestate';
	$IP				= $_SERVER["REMOTE_ADDR"];
	
	if($from == 'all'){
		$deleteSQL = "DELETE FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND page = '".$PageName."'";		
		if(mysql_query($deleteSQL))
		{
			echo 0; exit;
		}
		else
		{
			echo 1; exit;
		}
	}
	else{
		$cid			= $cid;
		$deleteSQL = "DELETE FROM compare_properties WHERE id = '".$cid."'";		
		if(mysql_query($deleteSQL))
		{
			echo 0; exit;
		}
		else
		{
			echo 1; exit;
		}	
	}
}
// End : Del Compare Properties

// Start : Add Compare Properties
function compareproperty($prid, $act, $delid)
{
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	/* Start: Insert in favourites table*/
	$LoginUserID	= $_SESSION['wp_login_user_id'];
	$PropertyID		= $prid;
	$PageName		= 'Realestate';
	$IP				= $_SERVER["REMOTE_ADDR"];
	
	/*Check already favourite or not*/
	$chkSQL 	= "SELECT * FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND property_id = '".$PropertyID."' AND page = '".$PageName."'"; 
	$chkresult 	= mysql_query($chkSQL);
	$TotRec		= mysql_num_rows($chkresult);
	if(mysql_num_rows($chkresult) > 0)
	{
		$deleteSQL = "DELETE FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND property_id = '".$PropertyID."' AND page = '".$PageName."'";		
		mysql_query($deleteSQL);
		echo 0; exit;	 
	}
	else
	{
		$chkSQL 	= "SELECT * FROM compare_properties WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND page = '".$PageName."'"; 
		$chkresult 	= mysql_query($chkSQL);
		$TotRec		= mysql_num_rows($chkresult);
		
		if($TotRec >= 2)
		{
			echo '2';exit;
		}
		else
		{
			$InsertRecord	= "INSERT INTO compare_properties SET user_id = '".$LoginUserID."',
														 property_id = '".$PropertyID."',
														 page = '".$PageName."', 
														 ip = '".$IP."'";
			mysql_query($InsertRecord);
			echo 1; exit;
		}
	}	
}
// End : Add Compare Properties

/* Function called when a listing is liked by a viewer HiteshL */
function deletefavorite($FID){
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	
	$deleteSQL = "DELETE FROM favorites WHERE id = ".$FID;		
	mysql_query($deleteSQL);
	echo 0; exit;
}

function markReListingImg($FID){
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	/* Start: Insert in favourites table*/
	$LoginUserID	= $_SESSION['wp_login_user_id'];
	$PropertyID		= $FID;
	$PageName		= 'Realestate';
	$IP				= $_SERVER["REMOTE_ADDR"];
	
	/*Check already favourite or not*/
	$chkSQL = "SELECT * FROM favorites WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND property_id = '".$PropertyID."' AND page = '".$PageName."'"; 
	$chkresult = mysql_query($chkSQL);
	if(mysql_num_rows($chkresult)>0){
		$deleteSQL = "DELETE FROM favorites WHERE (user_id = '".$LoginUserID."' OR ip = '".$IP."') AND property_id = '".$PropertyID."' AND page = '".$PageName."'";		
		mysql_query($deleteSQL);
		echo 0; exit;
	}else{
		$InsertRecord	= "INSERT INTO favorites SET user_id = '".$LoginUserID."',
													 property_id = '".$PropertyID."',
													 page = '".$PageName."', 
													 ip = '".$IP."'";
		mysql_query($InsertRecord);
		echo 1; exit;
	}
	/* End: Insert in favourites table*/
	
	/*
	$_SESSION["marked_reid"]=$reid.":".$_SESSION["marked_reid"];
	$reCookieTime = 60 * 60 * 24 * 12 + time();
	setcookie('markedreid', $_SESSION["marked_reid"], $reCookieTime);
	print '<span class="btn btn-sm btn-success">'.$relanguage_tags["Listing marked"]."</span>";
	*/
	//print '<span class="btn btn-sm btn-success" disabled="disabled" title="This listing has been liked by you.">Favorite </span>';
}

function markReListing($reid){
	include("config.php");
	
	/* Start: Insert in favourites table*/
	$LoginUserID	= $_SESSION['wp_login_user_id'];
	$PropertyID		= $reid;
	$PageName		= 'Realestate';
	$IP				= $_SERVER["REMOTE_ADDR"];
	$InsertRecord	= "INSERT INTO favorites SET user_id = '".$LoginUserID."',
												 property_id = '".$PropertyID."',
												 page = '".$PageName."', 
												 ip = '".$IP."'";
	mysql_query($InsertRecord);											 
	/* End: Insert in favourites table*/
	
	/*
	$_SESSION["marked_reid"]=$reid.":".$_SESSION["marked_reid"];
	$reCookieTime = 60 * 60 * 24 * 12 + time();
	setcookie('markedreid', $_SESSION["marked_reid"], $reCookieTime);
	print '<span class="btn btn-sm btn-success">'.$relanguage_tags["Listing marked"]."</span>";
	*/
	//print '<span class="btn btn-sm btn-success" disabled="disabled" title="This listing has been liked by you.">Favorite </span>';
	print '<span class="btn btn-danger">'.$relanguage_tags["Listing marked"].'</span>';
}

/* Deletes a listing when a member deletes a listing */
function deleteReListing($reid){
  if(isset($_SESSION["myusername"])){
	include("config.php");
	if($_SESSION["memtype"]==9){
        $qr0="select pictures from $reListingTable where id='$reid' ";
        $deleteClause="";
    }else{
        $qr0="select pictures from $reListingTable where id='$reid' and user_id='".$_SESSION["re_mem_id"]."'";
        $mem_id=$_SESSION["re_mem_id"];
        $deleteClause=" and user_id='$mem_id' ";
    }
	$result0=mysql_query($qr0);
	$row0=mysql_fetch_assoc($result0);
	$allPictures=explode("::",$row0['pictures']);
	$totalPics=sizeof($allPictures);
	
	$qr="delete from $reListingTable where id='$reid' $deleteClause";
	$result=mysql_query($qr);
	if($result){
		for($i=0;$i<$totalPics;$i++){
		if(trim($allPictures[$i])!="")
		list($temppart,$actualImgName)=explode("uploads/",$allPictures[$i]);
		unlink("uploads/".$actualImgName);
		//print "deleting: ".$actualImgName;
		}
		exit;
		print "<h5 align='center'>Listing # $reid deleted.</h5>";
	}
	
  }else print "Please sign in"; 
	
}

/* Delete a listing picture when a member delets it */
function deleteRePhoto($qr){
	include("config.php");
	list($reimgid,$reid)=explode(":::",$qr);
	list($temppart,$actualImgName)=explode("uploads/",$reimgid);
	if(unlink("uploads/".$actualImgName)) print "<h4 align='center'>".$relanguage_tags["Image Deleted"].".</h4>";
	else print "<h4 align='center'>Picture $reimgid couldn't be deleted. Please check if the file exists and permissions of the upload folder</h4>";
	
	$reqr1="select pictures from $reListingTable where id='$reid' ";
	$resultre1=mysql_query($reqr1);
	$row=mysql_fetch_assoc($resultre1);
	$allpictures=$row['pictures'];
	if(trim($reimgid)!=""){
		//$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
		$allpictures=str_replace("$reimgid::", "", $allpictures);
	}
	$reqr2="update $reListingTable set pictures='$allpictures'  where id='$reid' ";
	$resultre2=mysql_query($reqr2);
	//print "<br /><br />$reimgid"."<br /><br />$reqr2<br />";
}

/* Changes member status to active, ban or deleted */
function changeMemberStatus($q){
	include("config.php");
	list($memstatus,$rememid)=explode("::",$q);
	if($memstatus=="Ban" || $memstatus=="Active"){
		$reqr1="update $rememberTable set status='$memstatus' where id='$rememid' ";
		$resultre1=mysql_query($reqr1);
		if($resultre1){
			if($memstatus=="Ban")	print "Banned";
			if($memstatus=="Active")	print "Activated";
		}
	}
	if($memstatus=="Delete"){	
		$reqr1="delete from $rememberTable where id='$rememid' ";
		$resultre1=mysql_query($reqr1);
		if($resultre1){
			print "Deleted";
		}	
	}
}

/* Changes listing status to normal, featured or inactive */
function changeListingStatus($q){
	include("config.php");
	if($isThisDemo=="yes"){ print "Listing status can't be updated in demo"; exit; }
	list($listingstatus,$reid)=explode("::",$q);	
	if($listingstatus==2){
		$dt_now = date("Y-m-d");
		$now_month = date("n");
		$now_day = date("j");
		$now_year = date("Y");
		$now_hour= date("H");
		$now_minute= date("i");
		$now_second= date("s");
        if($featuredduration=="" || $featuredduration==0) $featuredduration=30;
		$minmonth = mktime($now_hour, $now_minute, $now_second, $now_month, $now_day + $featuredduration ,  $now_year );
		$future_dttm = date("Y-m-d H:i:s",$minmonth);
		$reqr1="update $reListingTable set listing_type='$listingstatus', featured_till='$future_dttm' where id='$reid' ";
	}
	else{ $reqr1="update $reListingTable set listing_type='$listingstatus' where id='$reid' "; }
	$resultre1=mysql_query($reqr1);	
	if($listingstatus==1) $listingstatusString="normal";
	if($listingstatus==2) $listingstatusString="featured";
	if($listingstatus==3) $listingstatusString="Inactive";
    if($isThisDemo=="yes" && $listingstatus==3){
    print "<br />Listing status can't be changed to 'Inactive' in the demo.";    
    }else { if($resultre1) print "Status changed to $listingstatusString"; }
}

/* Gets ajax request and pass on to other functions as per user's action */
function safelyExecute($q,$type){

	try{
		
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	//mysql_query("SET character_set_results=utf8");
	mysql_query("SET NAMES utf8");
	$q=mysql_real_escape_string($q);
	
	if($type==1) searchResults($q);
	if($type==2) registerUser($q);
	if($type==3) completeRegistration($q);
	if($type==4) showLoginForm();
	if($type==5) checkUsernameExists($q);
	if($type==6) showProfileImage($q);
	if($type==7) searchResults($q,"yes");
	if($type==8) markReListing($q);
	if($type==9) forgotPasswordForm($q);
	if($type==10) sendPassword($q);
	if($type==11) deleteReListing($q);
	if($type==12) deleteRePhoto($q);
	if($type==13) changeMemberStatus($q);
	if($type==14) changeListingStatus($q);
	if($type==15) changeStatus($q);
	if($type==22) addNewTag($q);
	if($type==23) showMapListing($q);
	if($type==24) searchResults($q,"no","yes");
	if($type==25) updateLangTag($q);
    if($type==26) setJSvariables($q);
    if($type==27) flagListing($q);
    if($type==28) splashSearchAutoComplete($q);
    if($type==29) PostalcodeAutoComplete($q);
	if($type==30) CityAutoComplete($q);
	
	}catch(Exeption $e){ print "Function Type - $type : ".$e; }
	mysql_close($con);
} 

function CityAutoComplete()
{
	include("config.php");
	$term			= mysql_real_escape_string($_GET['term']);
    $qr 			= "SELECT DISTINCT(city) FROM $reListingTable WHERE city LIKE '$term%' LIMIT 0,10";
	
    $result			= mysql_query($qr);
    $matchingCities	= array();
    while($record	= mysql_fetch_assoc($result)){
        $matchingCities[]	= $record['city'];
    }
	print json_encode($matchingCities);  
}

function PostalcodeAutoComplete()
{
	include("config.php");
	$term			= mysql_real_escape_string($_GET['term']);
    $qr 			= "SELECT DISTINCT(postal) FROM $reListingTable WHERE postal LIKE '$term%' LIMIT 0,10";
	
    $result			= mysql_query($qr);
    $matchingCities	= array();
    while($record	= mysql_fetch_assoc($result)){
        $matchingCities[]	= $record['postal'];
    }
	print json_encode($matchingCities);  
}

/* Returns matching results for splash page query shich are shown in a dropdown */
function splashSearchAutoComplete($q){
    $term=mysql_real_escape_string($_GET['term']);
    $stype=mysql_real_escape_string($_GET['stype']);
    if($stype==1) $classificationClause=" and classification like '%' ";
    if($stype==2) $classificationClause=" and classification ='".__("Available")."'";
    if($stype==3) $classificationClause=" and classification ='".__("Wanted")."'";
    
    //$qr="select distinct city FROM treb where city like '%$term%' $classificationClause;";
	$qr="select distinct city FROM treb where city like '$term%' $classificationClause;";
    $result=mysql_query($qr);
    $matchingCities=array();
    while($record=mysql_fetch_assoc($result)){
        $matchingCities[]=$record['city'];
    }
	if(stripos('North York', $term) !== false)
	{
		
		$matchingCities[] = 'North York';
	}
	if(stripos('Durham', $term) !== false)
	{
		
		$matchingCities[] = 'Durham';
	}
	print json_encode($matchingCities);  
}

/* Flag a listing */
function flagListing($listing_id){
    $ip=$_SERVER["REMOTE_ADDR"];
    
    $qr="select * from flagging where ip='$ip' and listing_id='$listing_id'";
    $result=mysql_query($qr); 
    if($result){
        if(mysql_num_rows($result) <= 0){
            $qr2="insert into flagging (listing_id,ip) values ('$listing_id','$ip')"; 
            $result2=mysql_query($qr2);
            $qr3="update listing set flag=flag+1 where id='$listing_id'";
            $result3=mysql_query($qr3); 
            if($result2 && $result3){
                print '<span class="btn btn-warning" disabled="disabled">'.__("Listing reported")."</span>";
            }
        }else{
            print '<span class="btn btn-warning" disabled="disabled">'.__("Listing reported")."</span>";
        }
    }    
}

/* Set session for various javascript variables */
function setJSvariables($q){
   $allVariables=explode("::",$q); 
   foreach($allVariables as $varid => $varval){
	   list($variableName,$variableValue)=explode(":",$varval);    
	   $_SESSION[$variableName]=$variableValue;
   }   
}

/* Fetches complete listing data of the listing identified by $reid */
function showMapListing($reid){
	include("config.php");
	$viewListingRow=getListingData($reid);
    $showMoreListings="no";
	include("viewFullListing.php");
}

/* Sets uid in admin options table of the database */
function changeStatus($q){
	include("config.php");
	$qr="update $adminOptionTable set uid='$q';";
	$result=mysql_query($qr);
	//print "done";
}

/* Returns comma separated string from an array. Just like implode. */
function getCommaStringFromArray($theArray){
	$theString="";
	$delim=",";
	if(!empty($theArray)){
		foreach($theArray as $thename=>$thevalue){
			if($theString!="")$delim=","; else $delim="";
			$theString=$theString.$delim.$thevalue;
		}	
	}
	return $theString;
}

/* Retrieves marker image as per the classification and type */
function getMarkerImage($type,$return="key",$classification="a"){

	$mid=0;
	$markerImage[$mid]="other";
	
	switch($type){
		
	case "Shared":
	$mid=1;
	$markerImage[$mid]="shared";
	break;
	
	case "Bachelor":
		$mid=2;
	$markerImage[$mid]="bachelor";
	break;
	
	case "Hotel":
	$mid=3;
	$markerImage[$mid]="hotel";
	break;
	
	case "House":
		$mid=4;
	$markerImage[$mid]="house";
	break;
	
	case "Townhouse":
		$mid=5;
	$markerImage[$mid]="townhouse";
	break;
	
	case "Apartment":
	$mid=6;
	$markerImage[$mid]="apartment";
	break;
	
	case "Duplex":
		$mid=7;
	$markerImage[$mid]="house";
	break;
	
	case "Triplex":
	$mid=8;
	$markerImage[$mid]="house";
	break;
	
	case "Fourplex":
	$mid=9;
	$markerImage[$mid]="house";
	break;
	
	case "Garden Home":
		$mid=10;
	$markerImage[$mid]="gardenhome";
	break;
	
	case "Mobile Home":
		$mid=11;
	$markerImage[$mid]="house";
	break;
	
	case "Special Purpose":
		$mid=12;
	$markerImage[$mid]="specialpurpose";
	break;
	
	case "Residential Commercial":
		$mid=13;
	$markerImage[$mid]="residentialcommercial";
	break;
	
	case "Office":
		$mid=14;
	$markerImage[$mid]="office";
	break;
	
	case "Business":
		$mid=15;
	$markerImage[$mid]="business";
	break;
	
	case "Retail":
		$mid=16;
	$markerImage[$mid]="retail";
	break;
	
	case "Land":
	$mid=17;
	$markerImage[$mid]="land";
	break;
	
	case "Industrial":
		$mid=18;
	$markerImage[$mid]="industry";
	break;
	
	case "Institutional":
		$mid=19;
	$markerImage[$mid]="institutional";
	break;
	
	case "Multi Home":
		$mid=20;
	$markerImage[$mid]="house";
	break;
	
	case "Agricultural":
		$mid=21;
	$markerImage[$mid]="agricultural";
	break;
	
	case "Shop":
		$mid=22;
	$markerImage[$mid]="shop";
	break;
	
	case "Warehouse":
		$mid=23;
	$markerImage[$mid]="warehouse";
	break;
	
	case "Other Commercial":
		$mid=24;
	$markerImage[$mid]="other";
	break;
	
	case "Other":
	$mid=25;
	$markerImage[$mid]="other";
	break;
	
	default:
		$mid=0;
	$markerImage[$mid]="other";
	break;	
		}
	
	$mImage=$markerImage[$mid]."-".$classification;
	
	if($return=="key") return $mid;
	elseif($return=="image") return $mImage;
	else return $markerImage[$mid];
	
}

/* Sample function to be used with api */
function getMarkersJson1(){
	include("config.php"); 
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	mysql_query("SET NAMES utf8");   
	$qr="select id,latitude as la,longitude as lo, listing_type as lt, price as pr, classification, subtype as su, retype from $reListingTable";
	$result=mysql_query($qr);
	$count=0;
	   $markers=array();
		while($marker=mysql_fetch_assoc($result)){
		 if(!isset($allmarkers[$marker['la'].",".$marker['lo']])) $allmarkers[$marker['la'].",".$marker['lo']]=0;    
		 else $allmarkers[$marker['la'].",".$marker['lo']]=$allmarkers[$marker['la'].",".$marker['lo']]+1;   
		 if("Available"==$marker['classification']) $classification="a";
		 if("Sale"==$marker['classification']) $classification="b";
		 if("Wanted"==$marker['classification']) $classification="c";   
		 if($marker['lt']==1) unset($marker['lt']);  
		 if($allmarkers[$marker['la'].",".$marker['lo']]>0){
		   $classification="d";
		   foreach($markers as $key => $tempmarker){ if ( $tempmarker['la'] == $marker['la'] && $tempmarker['lo'] == $marker['lo'] ) unset($markers[$key]); }
		 } 
		 $marker['su']=getMarkerImage($marker['su'],"image",$classification);
		 $markers[] = $marker;
		 
		 }
	 return json_encode($markers);   
}

/* Returns json marker data */
function getMarkersJson2(){
    include("config.php");
    $con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
    mysql_select_db($database,$con);
    mysql_query("SET NAMES utf8");
    $reClassification	= $_GET['classification'];
    $reType				= $_GET['type'];
    //$reSubtype		= $_GET['subtype'];
    
    //$reBathrooms		= $_GET['bathrooms'];
    //$rePrice			= $_GET['price'];
    //$reQuery			= mysql_real_escape_string($_GET['requery']);
    //$reCity			= mysql_real_escape_string(trim($_GET['city']));
    $favorite			= $_GET['favorite'];
	
	// Start : Hitesh New Vars
	//$moresubtype	= $_GET['moresubtype'];
    //$moreaddress	= $_GET['moreaddress'];
	//$morefrom		= $_GET['morefrom'];
	// End : Hitesh New Vars   
	
	
	// Start : New fields from new design
	$minprice	= $_GET['minprice'];   
	$maxprice	= $_GET['maxprice'];
	$othertype	= $_GET['othertype'];
	$style		= $_GET['style'];
	$reBedrooms	= $_GET['bedrooms'];
	$bedplus	= $_GET['bedplus'];
	$reBathrooms= $_GET['bathrooms'];
	$heatsource	= $_GET['heatsource'];
	$cooling	= $_GET['cooling'];	
	$basement	= $_GET['basement'];	
	$kitchens	= $_GET['kitchens'];	
	$exterior	= $_GET['exterior'];
	$pool		= $_GET['pool'];
	$laundry	= $_GET['laundry'];
	$furnished	= $_GET['furnished'];
	$heatinc	= $_GET['heatinc'];
	$hydroinc	= $_GET['hydroinc'];
	$squarefeet	= $_GET['squarefeet'];
	$exposure	= $_GET['exposure'];
	$pets		= $_GET['pets'];
	$locker		= $_GET['locker'];
	$city		= $_GET['city'];
	$postal		= $_GET['postal'];
	
	$poolsql		= '';
	$laundrysql		= '';
	$furnishedsql	= '';
	$heatincsql		= '';
	$hydroincsql	= '';
	$squarefeetsql	= '';
	$exposuresql	= '';
	$petssql		= '';
	$lockersql		= '';
	if($reClassification == 'Sale')
	{
		$poolsql	= getRealValue($pool, "pool");
	}
	if($reClassification == 'Rent')
	{
		$laundrysql		= getRealValue($laundry, "laundry");
		$furnishedsql	= getRealValue($furnished, "furnished");
		$heatincsql		= getRealValue($heatinc, "heatinc");
		$hydroincsql	= getRealValue($exposure, "exposure");
	}
	if($reType == 'Condo')
	{
		$squarefeetsql	= getRealValue($squarefeet, "squarefeet");
		$exposuresql	= getRealValue($exposure, "exposure");
		$petssql		= getRealValue($pets, "pets");
		$lockersql		= getRealValue($locker, "locker");
	}
	// End : New fields from new design
	
    reSetSearchSession($reClassification,$reType,$reSubtype,$reBedrooms,$reBathrooms,$rePrice,$reQuery,$reCity); 
    if($favorite==1){
       	$allfavs=rtrim(str_replace(":", ",", $_SESSION["marked_reid"]),',');
       	$qr0 = "SELECT id,
					   latitude as la,
					   longitude as lo, 
					   listing_type as lt, 
					   price as pr, 
					   classification, 
					   subtype as su,
					   retype, 
					   subtype 
				FROM $reListingTable 
				WHERE id IN ($allfavs);";
    }else{
		//$qr0="select id,latitude as la,longitude as lo, listing_type as lt, price as pr, classification, subtype as su from $reListingTable where  listing_type <> 3  ".getRealValue($reClassification,"reClassification").getRealValue($reType,"reType").getRealValue($reSubtype,"reSubtype").getRealValue($reBedrooms,"reBedrooms").getRealValue($reBathrooms,"reBathrooms").getRealValue($rePrice,"rePrice").getRealValue($reQuery,"reQuery").getRealValue($reCity,"reCity").";";
		if( $_GET['default_load'] == 0){
			
			$gLat = $_GET['gLat']; 
			$gLong = $_GET['gLong']; 
			//$gLat = '43.6532'; 
			//$gLong = '-79.3832'; 
			
			$tmp_select_var = "";
			$tmp_having_var = "";
			
				$tmp_select_var = " , ( 3959 * acos( cos( radians(".$gLat.") ) * cos( radians( $reListingTable.latitude ) ) 
	   * cos( radians($reListingTable.longitude) - radians(".$gLong.")) + sin(radians(".$gLat.")) 
	   * sin( radians($reListingTable.latitude)))) AS distance ";	
				$tmp_having_var = " HAVING distance <= 40 ";
			
		}
		$IncVar	= '';
		if($reType == 'Commercial')
		{
			$IncVar	= getRealValue($minprice,"minprice").
					  getRealValue($maxprice,"maxprice");
		}
		else
		{
			$IncVar	= getRealValue($reBedrooms,"reBedrooms").
					  getRealValue($reBathrooms,"reBathrooms").
					  getRealValue($minprice,"minprice").
					  getRealValue($maxprice,"maxprice").
					  getRealValue($othertype,"othertype").
					  getRealValue($style,"style").
					  getRealValue($bedplus,"bedplus").
					  getRealValue($heatsource,"heatsource").
					  getRealValue($cooling,"cooling").
					  getRealValue($basement,"basement").
					  getRealValue($kitchens,"kitchens").
					  getRealValue($exterior,"exterior").
					  $poolsql.
					  $laundrysql.
					  $furnishedsql.
					  $heatincsql.
					  $hydroincsql.
					  $squarefeetsql.
					  $exposuresql.
					  $petssql.
					  $lockersql;
		} 
   		$qr0 = "SELECT id,
					   latitude as la,
					   longitude as lo, 
					   listing_type as lt, 
					   price as pr, 
					   classification, 
					   subtype as su,
					   retype, subtype ".$tmp_select_var."
			    FROM $reListingTable 
			    WHERE 1 = 1 AND ($reListingTable.latitude != '' AND $reListingTable.longitude != '') ".getRealValue($reClassification,"reClassification").
													 getRealValue($reType,"reType").
													 getRealValue($city,"city").
					  								 getRealValue($postal,"postal").
													 $IncVar.
													 getRealValue($morefrom,"morefrom").$tmp_having_var.";";
		//echo $qr0;exit;
	}
    $result0=mysql_query($qr0);
    $totalRows=mysql_num_rows($result0);
   	// return json_encode($qr0);
    $markers=array();  
    while($marker=mysql_fetch_assoc($result0)){
     	if(!isset($allmarkers[$marker['la'].",".$marker['lo']])) $allmarkers[$marker['la'].",".$marker['lo']]=0;    
     	else $allmarkers[$marker['la'].",".$marker['lo']]=$allmarkers[$marker['la'].",".$marker['lo']]+1;   
     	if("Available"==$marker['classification']) $classification="a";
     	if("Sale"==$marker['classification']) $classification="b";
     	if("Wanted"==$marker['classification']) $classification="c";   
     	if($marker['lt']==1) unset($marker['lt']);  
     	if($allmarkers[$marker['la'].",".$marker['lo']]>0){
			$classification="d";
			foreach($markers as $key => $tempmarker){ 
				if ( $tempmarker['la'] == $marker['la'] && $tempmarker['lo'] == $marker['lo'] ) unset($markers[$key]); 
			}
     	} 
     	$marker['su']=getMarkerImage($marker['su'],"image",$classification);
     	$marker['pr']=number_format($marker['pr']);
    	$markers[] = $marker;
    }
 	$markers=call_plugin("allMarkers",$markers);
 	return json_encode($markers);
}

/* Returns parsed data to be used in mysql queries a per their type */
function getRealValue($value,$type){
	include("config.php");
	
	if($type=="reClassification"){
		$retString	= '';
		if($value == "Rent")
		{
			$retString = " AND (classification = 'Lease' OR classification = 'Sub-Lease')";
		}
		else if($value == "Sale"){
			$retString = " AND (classification = 'Sale')";
		}
		return $retString;
	}
	
	if($type=="reType"){
		$retString	= '';
		if($value == "Residential")
		{
			$retString = " AND (reType = 'Residential')";
		}
		else if($value == "Commercial"){
			$retString = " AND (reType = 'Commercial')";
		}
		else if($value == "Condo"){
			$retString = " AND (reType = 'Condo')";
		}
		return $retString;
	}
	
	if($type == 'minprice')
	{
		$MinPrice	= str_replace('$','',str_replace(',', '', $value));
		$retString	= " AND price >= $MinPrice";
		return $retString;
	}
	
	if($type == 'maxprice')
	{
		$MaxPrice	= str_replace('$','',str_replace(',', '', $value));
		if($MaxPrice != 'Unlimited')
		{
			$retString	= " AND price <= $MaxPrice";
		}
		return $retString;
	}
	
	if($type == 'othertype' && $value != 'null')
	{
		$othertype	= $value;
		if(count($othertype) > 0 && $othertype[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($othertype); $i++)
			{
				if($i == 0)
				{
					$retString.= " gar_type = '".$othertype[$i]."'";	
				}
				else
				{
					$retString.= " OR gar_type = '".$othertype[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'style' && $value != 'null')
	{
		$style	= $value;
		if(count($style) > 0 && $style[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($style); $i++)
			{
				if($i == 0)
				{
					$retString.= " style = '".$style[$i]."'";	
				}
				else
				{
					$retString.= " OR style = '".$style[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == "reBedrooms"){
		$allValues	= explode(",", $value);
		if(count($allValues) > 0 && $allValues[0] != '')
		{
			$retString = ' AND (';
			for($i=0; $i<count($allValues); $i++){
				if($i != 0)
				{
					$retString.= ' OR ';
				}
				if($allValues[$i] == 5)
				{
					$retString.='br >=5';
				}
				else
				{
					$retString.= ' br = '.$allValues[$i];
				}
			}
			$retString.= ')';
			return $retString;
		}
	}
	
	if($type == 'bedplus')
	{
		if($value == 'Yes')
		{
			$retString = " AND br_plus > 0";
			return $retString;
		}
		else if($value == 'No')
		{
			$retString = " AND br_plus = '' ";
			return $retString;
		}
	}
	
	if($type=="reBathrooms"){
		$allValues	= explode(",", $value);
		if(count($allValues) > 0 && $allValues[0] != '' && !in_array('Any', $allValues))
		{
			$retString = ' AND (';
			for($i=0; $i<count($allValues); $i++){
				if($i != 0)
				{
					$retString.= ' OR ';
				}
				if($allValues[$i] == 4)
				{
					$retString.=' bathrooms >=4 ';
				}
				else
				{
					$retString.= ' bathrooms = '.$allValues[$i];
				}
			}
			$retString.= ')';
			return $retString;
		}
	}
	
	if($type == 'heatsource' && $value != 'null')
	{
		$heatsource	= $value;
		if(count($heatsource) > 0 && $heatsource[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($heatsource); $i++)
			{
				if($i == 0)
				{
					$retString.= " heating = '".$heatsource[$i]."'";	
				}
				else
				{
					$retString.= " OR heating = '".$heatsource[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'cooling' && $value != 'null')
	{
		$cooling	= $value;
		if(count($cooling) > 0 && $cooling[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($cooling); $i++)
			{
				if($i == 0)
				{
					$retString.= " a_c = '".$cooling[$i]."'";	
				}
				else
				{
					$retString.= " OR a_c = '".$cooling[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'basement'  && $value != 'null')
	{
		$basement	= $value;
		if(count($basement) > 0 && $basement[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($basement); $i++)
			{
				if($i == 0)
				{
					$retString.= " subtype = '".$basement[$i]."'";	
				}
				else
				{
					$retString.= " OR subtype = '".$basement[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == "kitchens"){
		$allValues	= explode(",", $value);
		if(count($allValues) > 0 && $allValues[0] != '')
		{
			$retString = ' AND (';
			for($i=0; $i<count($allValues); $i++){
				if($i != 0)
				{
					$retString.= ' OR ';
				}
				if($allValues[$i] == 3)
				{
					$retString.=' num_kit >=3 ';
				}
				else
				{
					$retString.= ' num_kit = '.$allValues[$i];
				}
			}
			$retString.= ')';
			return $retString;
		}
	}
	
	if($type == 'exterior' && $value != 'null')
	{
		$exterior	= $value;
		if(count($exterior) > 0 && $exterior[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($exterior); $i++)
			{
				if($i == 0)
				{
					$retString.= " constr1_out = '".$exterior[$i]."'";	
				}
				else
				{
					$retString.= " OR constr1_out = '".$exterior[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'pool' && $value != 'null')
	{
		$pool	= $value;
		if(count($pool) > 0 && $pool[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($pool); $i++)
			{
				if($i == 0)
				{
					$retString.= " pool = '".$pool[$i]."'";	
				}
				else
				{
					$retString.= " OR pool = '".$pool[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'laundry' && $value != 'null')
	{
		//print_r($value);
		$laundry	= $value;
		if(count($laundry) > 0 && $laundry[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($laundry); $i++)
			{
				if($i == 0)
				{
					$retString.= " laundry = '".$laundry[$i]."'";	
				}
				else
				{
					$retString.= " OR laundry = '".$laundry[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == "furnished" && $value != 'null'){
		$allValues	= explode(",", $value);
		if(count($allValues) > 0 && $allValues[0] != '')
		{
			$retString = ' AND (';
			for($i=0; $i<count($allValues); $i++){
				if($i != 0)
				{
					$retString.= ' OR ';
				}
				$retString.= ' furnished = "'.$allValues[$i].'"';
			}
			$retString.= ')';
			return $retString;
		}
	}
	
	if($type == "heatinc" && $value != 'null' && $value != '' && $value == 'true'){
		$retString = ' AND heat_inc = "Y"';
		return $retString;
	}
	
	if($type == "hydroinc" && $value != 'null' && $value != '' && $value == 'true'){
		$retString = ' AND hydro_inc = "Y"';
		return $retString;
	}
	
	if($type == 'squarefeet' && $value != 'null')
	{
		$squarefeet	= $value;
		if(count($squarefeet) > 0 && $squarefeet[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($squarefeet); $i++)
			{
				if($i == 0)
				{
					$retString.= " sqft = '".$squarefeet[$i]."'";	
				}
				else
				{
					$retString.= " OR sqft = '".$squarefeet[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'exposure' && $value != 'null')
	{
		$exposure	= $value;
		if(count($exposure) > 0 && $exposure[0] != 'Any')
		{
			$retString = ' AND (';
			for($i=0; $i<count($exposure); $i++)
			{
				if($i == 0)
				{
					$retString.= " st_dir = '".$exposure[$i]."'";	
				}
				else
				{
					$retString.= " OR st_dir = '".$exposure[$i]."'";	
				}
			}
			$retString.= ' ) ';
			return $retString;
		}
	}
	
	if($type == 'pets')
	{
		if($value == 'Any')
		{
			$retString = " AND (pets = '' OR pets = 'N' OR pets = 'Restrict')";
			return $retString;
		}
		else if($value == 'Yes')
		{
			$retString = " AND (pets = '')";
			return $retString;
		}
		else if($value == 'No')
		{
			$retString = " AND (pets = 'N' OR pets = 'Restrict')";
			return $retString;
		}
	}
	
	if($type == "locker" && $value != 'null' && $value != '' && $value == 'true'){
		$retString = ' AND locker != "None"';
		return $retString;
	}
	
	if($type == 'city' && $value != 'null' && $value != '')
	{
		$retString.= " AND city = '".$value."'";	
		return $retString;
	}
	
	if($type == 'postal' && $value != 'null' && $value != '')
	{
		$retString.= " AND postal = '".$value."'";	
		return $retString;
	}
	
	if($type=="reSubtype"){
		$allValues=explode(",",$value);
		$totSize=sizeof($allValues);
		for($j=0;$j<$totSize;$j++){
			$allValues[$j]=array_search($allValues[$j],$relanguage_tags);
		}
		for($i=0;$i<$totSize;$i++){
			if($allValues[$i]==$relanguage_tags["Any"] || $allValues[$i]=="" || $allValues[$i]=="Any"){
				$retString=$retString." and subtype like '%' ";
				break;
			}
			else{
				if($retString=="") $delimClause=" and ( ";
				else $delimClause=" or ";
				$retString=$retString." $delimClause subtype='".$allValues[$i]."' ";
			}

		}
		if($retString!="" && $retString!=" and subtype like '%' ") $retString=$retString." ) ";
		return $retString;

	}

	if($type=="reQuery"){
		if($value=="") $value="";
		else $value=" AND ( postal LIKE '%$value%' )";
		return $value;
	}

	if($type=="reCity"){
		//Mississauga
		if($value == "")
		{ 
			$value = "";
		}
		else if(strtolower($value) == 'durham')
		{
			$value=" AND ( (city LIKE'%Ajax%') OR (city LIKE '%Clarington%') OR (city LIKE '%Brock%') OR (city LIKE'%Oshawa%') OR (city LIKE '%Pickering%') OR (city LIKE '%Scugog%') OR (city LIKE '%Uxbridge%') OR (city LIKE '%Whitby%')  OR (city LIKE'%Durham%') OR (area LIKE'%Durham%'))";
		}
		else if(strtolower($value) == 'north york')
		{
			$value=" AND ( (city LIKE'%Aurora%') OR (city LIKE '%East Gwillimbury%') OR (city LIKE '%Georgina%') OR (city LIKE'%King%') OR (city LIKE '%Markham%') OR (city LIKE '%Newmarket%') OR (city LIKE '%Richmond Hill%') OR (city LIKE '%Vaughan%')  OR (city LIKE'%Whitchurch-Stouffville%') OR (area LIKE'%York%') OR (area LIKE'%North York%'))";	
		}
		else 
		{
			$value=" AND ( (city LIKE '%$value%') OR (area LIKE '%$value%'))";
		}
		return $value;
	}

	if($type == "moresubtype")
	{
		if($value != '' && $value != '0')
		{
			$value = " AND ( subtype LIKE '$value%' )";
			return $value;
		}
	}
	
	if($type == "moreaddress")
	{
		if($value != '' && $value != '0')
		{
			$value = " AND ( address LIKE '%$value%' )";
			return $value;
		}
	}
	
	if($type == "morefrom")
	{
		if($value != '' && $value != '0')
		{
			$value = " AND ( where_from LIKE '%$value%' )";
			return $value;
		}
	}
	
	if($type=="onlyMemberListings"){
		$mem_id=$_SESSION["re_mem_id"];
		if($value=="no") $value="";
		if($value=="yes") $value=" and user_id='$mem_id' ";
		return $value;
	}
}

/* Gets listing data related to the marker */
//function getMarkerInfo($latitude,$longitude,$list_id,$region="usa"){
function getMarkerInfo($latitude,$longitude,$list_id,$region="canada"){
	include("config.php");
	$row0=array();
	
	if(trim($list_id)=="" || $list_id==0){
		$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
		mysql_select_db($database,$con);
		mysql_query("SET NAMES utf8");
		
		$reClassification=$_SESSION["reClassification"];
		$reType=$_SESSION["reType"];
		$reSubtype=$_SESSION["reSubtype"];
		$reBedrooms=$_SESSION["reBedrooms"];
		$reBathrooms=$_SESSION["reBathrooms"];
		$rePrice=$_SESSION["rePrice"];
		$reQuery=$_SESSION["reQuery"];
		$reCity=$_SESSION["reCity"];
		$latitude=mysql_real_escape_string($latitude);
		$longitude=mysql_real_escape_string($longitude);
		$list_id=mysql_real_escape_string($list_id);
		
		//$qr="select * from $reListingTable where listing_type <> 3 and latitude like '$latitude%' and longitude like '$longitude%'".getRealValue($reClassification,"reClassification").getRealValue($reType,"reType").getRealValue($reSubtype,"reSubtype").getRealValue($reBedrooms,"reBedrooms").getRealValue($reBathrooms,"reBathrooms").getRealValue($rePrice,"rePrice").getRealValue($reQuery,"reQuery").getRealValue($reCity,"reCity").";";
		$qr = "SELECT * 
		 	   FROM $reListingTable 
			   WHERE 1 = 1 AND 
			   		 latitude LIKE '$latitude%' AND 
					 longitude LIKE '$longitude%'".getRealValue($reClassification,"reClassification").
					 							   getRealValue($reType,"reType").
												   getRealValue($reSubtype,"reSubtype").
												   getRealValue($reBedrooms,"reBedrooms").
												   getRealValue($reBathrooms,"reBathrooms").
												   getRealValue($rePrice,"rePrice").
												   getRealValue($reQuery,"reQuery").
												   getRealValue($reCity,"reCity")." LIMIT 0,1";
		//echo $qr;exit; 
		$result=mysql_query($qr);
		$markerContent=$listingDelimeter="";
		$totalResults=mysql_num_rows($result);
		while($listingTemp=mysql_fetch_assoc($result)) $listing[]=$listingTemp;
		$region=$regionClause1=$regionClause2="";
	}else{
		$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
		mysql_select_db($database,$con);
		mysql_query("SET NAMES utf8");
		$qr = "SELECT * 
		 	   FROM $reListingTable 
			   WHERE id = ".$list_id." LIMIT 0,1";
		//echo $qr;exit; 
		$result=mysql_query($qr);
		$markerContent=$listingDelimeter="";
		$totalResults=mysql_num_rows($result);
		while($listingTemp=mysql_fetch_assoc($result)) $listing[]=$listingTemp;
		$region=$regionClause1=$regionClause2="";
		/*
		$combArray=convertArrayToClFormat(getOodleArray("","",$list_id,"",$region));
		$oodleListing=$combArray[0];
		$oodleListing['category']=ucfirst($oodleListing['category']);   
		$listing[]=$oodleListing;
		$regionClause1="::$region";
		$regionClause2="&region=$region";
		*/
	}
	if($totalResults>1) $markerContent="<div class='label label-primary' style='font-size: 125%; text-align:center;'>$totalResults ".__("Listings Found Here")."</div><br /><br />";
		$count=0;
	
		$listing=call_plugin("markerRecord",$listing);
	
		foreach($listing as $lid=>$row0){
					
			if($row0['listing_type']==2){
				  $featuredClass=" style='background-color:#F9FDF8;' "; $featuredTag="<span class='featuredlisting label label-primary'>".__("Featured")."</span>"; 
				}else{
					$featuredTag="";
					$featuredClass="";
				}
				   
			if($totalResults>1){
				$headlineLength=40;
				$descriptionSize=170;
				$thumbnailHeight=60;
				$markerHeightStyle=" style='min-height:140px; ' ";
			}else{
				$headlineLength=45;
				$descriptionSize=350;
				$thumbnailHeight=120;
			}
			$infoTextWidth="45%";
			$headlineH=4;
			//$attributClause="<br /><font style='font-size:85%;'><b>".__($row0['retype'])." - ".__($row0['subtype'])."</b> (#".$row0['id']."), $priceString<b>".__("Phone").":</b> ".$row0['contact_phone'].", <b>".__("Address").":</b> ".$row0['address'].", <b>".__("City").":</b> ".$row0['city'];
			//$attributClause="<br /><font style='font-size:85%;'><b>".__("Address").":</b> ".$row0['address'].", ".$row0['city']." <br /><b>".__("Phone").":</b> ".$row0['contact_phone']."";
			
			$TotFav	= 0;
		  	if(!empty($row0['id'])){
			  	$CheckFavSql	= "SELECT COUNT(*) as Tot FROM favorites WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																		   		property_id = '".$row0['id']."' AND 
																		   		page = 'Realestate'";
			  	$CheckFavQue	= mysql_query($CheckFavSql);
			  	$ResFav			= mysql_fetch_assoc($CheckFavQue);
			  	$TotFav			= $ResFav['Tot'];
		  	}
			$TempHeartSrc = 'images/black-heart.png';
			$TempHeartCls = 'blackcls';
			$TempOnclick  = 'javascript:dofavorite('.$row0['id'].')';	
			$MouseHovor	  = 'onmouseover="this.src=\'images/hhg.png\'"';	
			$MouseOut	  = 'onmouseout="this.src=\'images/black-heart.png\'"';	
			if($TotFav > 0)
			{
				$MouseHovor   = '';
				$MouseOut	  = '';
				$TempHeartSrc = 'images/hhg.png';
				$TempHeartCls = 'redcls';
			}
			
			
			// Start : Hitesh Compare record
			$TotComp	= 0;
		  	if(!empty($row0['id'])){
			  	$CheckCompSql	= "SELECT COUNT(*) as Tot FROM compare_properties WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																		   				 property_id = '".$row0['id']."' AND 
																		   				 page = 'Realestate'";
			  	$CheckCompQue	= mysql_query($CheckCompSql);
			  	$ResComp		= mysql_fetch_assoc($CheckCompQue);
			  	$TotComp		= $ResComp['Tot'];
		  	}
			$TempCompSrc = 'images/house-gray.png';
			$TempCompCls = 'blackcls';
			$TempCompOnclick  = 'javascript:compareproperty('.$row0['id'].')';	
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
			
			$attributClause="<a onclick='showstreetview(".$row0['id'].",".$row0['latitude'].",".$row0['longitude'].");' style='cursor:pointer;text-transform: none;text-decoration: none !important;font-family: arial;font-size: medium;' ><img src='images/streetview-icon.png' style='height:40px; width:40px'> Street View</a><br /><font style='font-size:85%;'><b>".__("Price").": $".number_format($row0['price'])."</b><br /><b>".__("Bed/Bath").": </b>".__($row0['bedrooms'])." <img src='images/bed.png' height='20' width='20' >  &nbsp; ".__($row0['bathrooms'])." <img src='images/bath.png' height='20' width='20'><div class='addthis_inline_share_toolbox' style='width:50%; float:right'></div><p class='tag_speach' style='right: 70px; top: 0px; cursor:pointer;'></p><p class='tag_c' style='right: 40px; top: 0px; cursor:pointer'><img ".$MouseCompHovor." ".$MouseCompOut." id='comp2".$row0['id']."' onclick=".$TempCompOnclick." class='".$TempCompCls."' height='32' width='32' src='".$TempCompSrc."' style='float:right;' /></p><p class='tag_p' style='right:5px; top:0px'><img ".$MouseHovor." ".$MouseOut." id='heartid2".$row0['id']."' onclick=".$TempOnclick." class='".$TempHeartCls."' height='32' width='32' src='".$TempHeartSrc."' style='float:right; cursor:pointer'></p>";
			//$attributClause="<br /><font style='font-size:85%;'><b>".__("Price").": $".number_format($row0['price'])."</b><br /><b>".__("Bed/Bath").": </b>".__($row0['bedrooms'])." <img src='images/bed.png' height='20' width='20' >  &nbsp; ".__($row0['bathrooms'])." <img src='images/bath.png' height='20' width='20'><div class='addthis_inline_share_toolbox' style='width:50%; float:right'></div><p class='tag_speach' style='right: 70px; top: 0px; cursor:pointer;'></p><p class='tag_c' style='right: 40px; top: 0px; cursor:pointer'><img ".$MouseCompHovor." ".$MouseCompOut." id='comp2".$row0['id']."' onclick=".$TempCompOnclick." class='".$TempCompCls."' height='32' width='32' src='".$TempCompSrc."' style='float:right;' /></p><p class='tag_p' style='right:5px; top:0px'><img ".$MouseHovor." ".$MouseOut." id='heartid2".$row0['id']."' onclick=".$TempOnclick." class='".$TempHeartCls."' height='32' width='32' src='".$TempHeartSrc."' style='float:right; cursor:pointer'></p>";
			
			if(isset($_SESSION["winwidth"]) && ($_SESSION["winwidth"]<=1024 && $_SESSION["winwidth"]>=500)){
				 $headlineLength=20; 
				 $descriptionSize=60; 
				 $thumbnailHeight=60;
				 $headlineH=4;
				 // $attributClause="";
			}
			
			//$smallDescription=nl2br(utf8_substr(preg_replace( '/\s+/', ' ', escapeJavaScriptText($row0['description'])),0,$descriptionSize))."....";
			$smallDescription=nl2br(utf8_substr(preg_replace( '/\s+/', ' ', escapeJavaScriptText($row0['description'])),0,150))."....";
			if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]<500){
				 $headlineLength=20; 
				 $thumbnailHeight=130;/*<- change here 40 to 120 */
				 $headlineH=5;
				 $attributClause="<br /><font style='font-size:85%;'><b>".__("Price").":</b> $".number_format($row0['price'])."<br /><b>".__("Bed/Bath").": </b>".__($row0['bedrooms'])." <img src='images/bed.png' height='20' width='20' style='width: 20px !important' >  &nbsp; ".__($row0['bathrooms'])." <img src='images/bath.png' height='20' width='20' style='width: 20px !important'><div class='addthis_inline_share_toolbox' style='width:100%; margin-top: 10px;'></div><p class='tag_speach' style='right: 70px; top: 0px; cursor:pointer;'></p><p class='tag_c' style='right: 40px; top: 0px; cursor:pointer'><img ".$MouseCompHovor." ".$MouseCompOut." id='comp2".$row0['id']."' onclick=".$TempCompOnclick." class='".$TempCompCls."' height='32' width='32' src='".$TempCompSrc."' style='float:right;' /></p><p class='tag_p' style='right:5px; top:0px'><img ".$MouseHovor." ".$MouseOut." id='heartid2".$row0['id']."' onclick=".$TempOnclick." class='".$TempHeartCls."' height='32' width='32' src='".$TempHeartSrc."' style='float:right; cursor:pointer'></p>";
				 // $attributClause="";     __($row0['bedrooms'])
			}
			if(isset($_SESSION["winwidth"]) && ($_SESSION["winwidth"]<400 && $_SESSION["winwidth"]>=200)){
				 $markerPopStyle="min-height:120px; min-width:250px;"; 
			}
			//$smallHeadline=nl2br(utf8_substr(preg_replace( '/\s+/', ' ', escapeJavaScriptText($row0['headline'])),0,$headlineLength))."..";
			$smallHeadline	= nl2br(preg_replace( '/\s+/', ' ', escapeJavaScriptText($row0['headline'])));
			$city 			= $row0['city'];
			$state 			= $row0['state'];
			$postal 		= $row0['postal'];
			$smallHeadline="<h$headlineH style='display:inline; color:#000;'>$smallHeadline, $city, $state, $postal</h$headlineH>";
			
			if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]<500){
				$smallHeadline .= $attributClause;
			}
			
			
			$row0['address']=addslashes(escapeJavaScriptText($row0['address']));
			$rePicArray = explode("::",$row0['pictures']);
			if(trim($rePicArray[0])=="") $rePicArray[0]="../images/no-image.png";
			
			$oodleregion=$region_slug=$oodleurlregion="";
			
			
			$timestamp_sql_tmp = substr( $row0['timestamp_sql'], 0, -2 ) ; 
			$current_time = date("Y-m-d H:i:s");
			$difftime	= time_since(strtotime($timestamp_sql_tmp),strtotime($current_time));
			if($row0['classification']=="Available") 
			{
				$classClause="<span class='label label-info' style='margin-right:10px !important; padding:7px !important'>".__("Available For Rent")."</span>";  
				$classClause .= "<span class='label label-info' style='padding:7px !important'>".$difftime."</span>"; 
			}
			else if($row0['classification']=="Lease" || $row0['classification']=="Sub-Lease") 
			{
				$classClause="<span class='label label-info' style='margin-right:10px !important; padding:7px !important'>".__("Available For Rent")."</span>"; 
				$classClause .= "<span class='label label-info' style='padding:7px !important'>".$difftime."</span>";
			}
			else if($row0['classification']=="Sale") 
			{
				$classClause="<span class='label label-danger' style='margin-right:10px !important; padding:7px !important'>".__("Available For Sale")."</span>";
				$classClause .= "<span class='label label-danger' style='padding:7px !important'>".$difftime."</span>";
			}
			else if($row0['classification']=="Wanted") 
			{
				$classClause="<span class='label label-success' style='margin-right:10px !important; padding:7px !important'>".__("Wanted")."</span>";
				$classClause .= "<span class='label label-success' style='padding:7px !important'>".$difftime."</span>";
			}
			if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled"){
				$headline_slug=friendlyUrl($row0['headline']);    
				if(trim($row0['subtype'])==""){
					$row0['subtype'] = "none";
				}
				$newTabLink=friendlyUrl($row0['retype'],"_")."/".friendlyUrl($row0['subtype'],"_")."/"."id-".$row0['id']."-".$region."-".$headline_slug;
			}else  $newTabLink="index.php?ptype=viewFullListing&reid=".$row0['id'].$regionClause2;
			
				/*$newTabButton="<a class='btn btn-sm btn-info pull-right' style='margin-top:5px; margin-right:5px;' target='_blank' href='$newTabLink'>".__("Direct Link")."</a>";*/
				$newTabButton='<a href="contactPoster.php?reid='.$row0['id'].'" class="btn btn-sm btn-info pull-right listingcontact">Contact Agent</a>';
				
				
				$row0['price']=number_format($row0['price']);
				
				if($row0['price']!="" && $row0['price']!=0){
				   if($currency_before_price) $priceString="<b>".__("Price").":</b> ".$_SESSION["readmin_settings"]["defaultcurrency"].$row0['price'].", "; 
				   else $priceString="<b>".__("Price").":</b> ".$row0['price']." ".$_SESSION["readmin_settings"]["defaultcurrency"].", ";
				} 
				
				//$listingLink="<a class='btn btn-sm btn-primary pull-right' style='margin-top:5px; margin-right:5px;' href='#' id='theListingLink'><span id='".$row0['id'].$oodleregion."'>".__("More Info")."</span></a>";
				$listingLink="<a class='btn btn-sm btn-primary pull-right' style='margin-top:5px;' target='_blank' href='$newTabLink'><span id='".$row0['id'].$oodleregion."'>".__("More Info")."</span></a>";
				
				if($count>0) $listingDelimeter="<hr />";
				
				$style_attr=" style='display:block;' ";
				$map_image ="";    
				foreach($rePicArray as $pid=>$pval){
					if(trim($pval)!=""){        
						$pval		= $SitePath.'/uploads/'.$pval; //Hitesh
						$map_image 	= $map_image."<a rel='prettyPhoto[".$row0['id']."]' $style_attr href='$pval' ><img border='0' width='220' height='$thumbnailHeight' src='timthumb.php?h=$thumbnailHeight&src=$pval' /></a>"; //Hitesh
						//$map_image 	= $SitePath.'/uploads/'.$map_image."<a rel='prettyPhoto[".$row0['id']."]' $style_attr href='$pval' ><img border='0' height='$thumbnailHeight' src='timthumb.php?h=$thumbnailHeight&src=$pval' /></a>";
						$style_attr = " style='display:none;' ";
					}  
				}
			
				if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]<500){
					$newTabButton="<div><a class='btn btn-sm btn-primary' style='margin-top:5px;' target='_blank' href='$newTabLink'>"/*.__("Direct Link").*/.__("More Info")."</a></div>";
					$row0['price']=number_format($row0['price']);
					//$listingLink="<div><a class='btn btn-sm btn-primary' style='margin-top:5px; margin-right:5px;' href='#' id='theListingLink'><span id='".$row0['id'].$oodleregion."'>".__("More Info")."</span></a></div>";
				
					$markerContent=$markerContent.$listingDelimeter."<div class='markerInfo' $featuredClass $markerHeightStyle>$classClause<br />".$smallHeadline."$attributClause<br /><div style='margin-bottom:5px;'>$map_image</div> $featuredTag $newTabButton </div>";
				}else{
					$markerContent=$markerContent.$listingDelimeter."<div class='markerInfo' $featuredClass $markerHeightStyle>$classClause".$smallHeadline."$attributClause</font><br /><div class='mapInfoText' style='float:right; width:$infoTextWidth; padding:10px 10px 0 0;'>$smallDescription $featuredTag</div>";
					$markerContent=$markerContent."<div class='mapInfoPic'>$map_image<div class='mapInfoPicBtn' style='float:left;'>$newTabButton $listingLink</div></div></div>";
			}
			$count++;    
		}
	//return $markerContent;
	if($totalResults>1) $markerContent="<div style='height:200px;'>".$markerContent."</div>";
	return json_encode($markerContent); 	  
}

/* Passes the data returned by getTextDataJson2 to registered filter hooks */
function getTextDataJson($nelatitude,$nelongitude,$swlatitude,$swlongitude,$pageNum){
	 include_once("plugin_handler.inc.php"); 
	 print call_plugin("sidebarTextResults",getTextDataJson2($nelatitude,$nelongitude,$swlatitude,$swlongitude,$pageNum));   
}
function time_since ( $start,$end )
{
    //$end = time();
    $diff = $end - $start;
    $days = floor ( $diff/86400 ); //calculate the days
    $diff = $diff - ($days*86400); // subtract the days
    $hours = floor ( $diff/3600 ); // calculate the hours
    $diff = $diff - ($hours*3600); // subtract the hours
    $mins = floor ( $diff/60 ); // calculate the minutes
    $diff = $diff - ($mins*60); // subtract the mins
    $secs = $diff; // what's left is the seconds;
    if ($secs!=0) 
    {
        $secs .= " s";
        if ($secs=="1 seconds") $secs = "1 second"; 
    }
    else $secs = '';
    if ($mins!=0) 
    {
        $mins .= " m ";
        if ($mins=="1 mins ") $mins = "1 min "; 
        $secs = '';
    }
    else $mins = '';
    if ($hours!=0) 
    {
        $hours .= " h ";
        if ($hours=="1 hours ") $hours = "1 hour ";             
        $secs = '';
    }
    else $hours = '';
    if ($days!=0) 
    {
        $days .= " d "; 
        if ($days=="1 days ") $days = "1 day ";                 
        $mins = '';
        $secs = '';
        if ($days == "-1 days ") {
            $days = $hours = $mins = '';
            $secs = "less than 10 seconds";
        }
    }
    else $days = '';
    return "$days $hours $mins $secs ago";
}
/* Retrieves sidebar text data as per search criteria */
function getTextDataJson2($nelatitude,$nelongitude,$swlatitude,$swlongitude,$pageNum){
	include("config.php");
	ob_start(); 
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	mysql_query("SET NAMES utf8");   
	
	$alltextListings=array();
	$boundListings=array();
	$allmarkers=array();
	
	if($listingsPerPage=="")$listingsPerPage=10;
	if($pageNum=="" || $pageNum==0)$pageNum=1;
	
	$startListingNum=($pageNum-1)*$listingsPerPage;
	$endListingNum=$startListingNum+$listingsPerPage;
	$startListingNum2=$startListingNum+1;
	
	$reClassification	= $_GET['classification'];
	$reType				= $_GET['type'];
	//$reSubtype=$_GET['subtype'];
	//$reBedrooms=$_GET['bedrooms'];
	//$reBathrooms=$_GET['bathrooms'];
	//$rePrice=$_GET['price'];
	//$reQuery=mysql_real_escape_string($_GET['requery']);
	//$reCity=mysql_real_escape_string(trim($_GET['city']));
	$favorite			= $_GET['favorite'];
	
	// Start : Hitesh New Vars
	//$moresubtype	= $_GET['moresubtype'];
    //$moreaddress	= $_GET['moreaddress'];
	//$morefrom		= $_GET['morefrom'];
	// End : Hitesh New Vars  
	
	// Start : New fields from new design
	$minprice	= $_GET['minprice'];   
	$maxprice	= $_GET['maxprice'];
	$othertype	= $_GET['othertype'];
	$style		= $_GET['style'];
	$reBedrooms	= $_GET['bedrooms'];
	$bedplus	= $_GET['bedplus'];
	$reBathrooms= $_GET['bathrooms'];
	$heatsource	= $_GET['heatsource'];
	$cooling	= $_GET['cooling'];	
	$basement	= $_GET['basement'];	
	$kitchens	= $_GET['kitchens'];	
	$exterior	= $_GET['exterior'];
	$pool		= $_GET['pool'];
	$laundry	= $_GET['laundry'];
	$furnished	= $_GET['furnished'];
	$heatinc	= $_GET['heatinc'];
	$hydroinc	= $_GET['hydroinc'];
	$squarefeet	= $_GET['squarefeet'];
	$exposure	= $_GET['exposure'];
	$pets		= $_GET['pets'];
	$locker		= $_GET['locker'];
	$city		= $_GET['city'];
	$postal		= $_GET['postal'];

	$poolsql		= '';
	$laundrysql		= '';
	$furnishedsql	= '';
	$heatincsql		= '';
	$hydroincsql	= '';
	$squarefeetsql	= '';
	$exposuresql	= '';
	$petssql		= '';
	$lockersql		= '';
	if($reClassification == 'Sale')
	{
		$poolsql	= getRealValue($pool, "pool");
	}
	if($reClassification == 'Rent')
	{
		$laundrysql		= getRealValue($laundry, "laundry");
		$furnishedsql	= getRealValue($furnished, "furnished");
		$heatincsql		= getRealValue($heatinc, "heatinc");
		$hydroincsql	= getRealValue($exposure, "exposure");
	}
	if($reType == 'Condo')
	{
		$squarefeetsql	= getRealValue($squarefeet, "squarefeet");
		$exposuresql	= getRealValue($exposure, "exposure");
		$petssql		= getRealValue($pets, "pets");
		$lockersql		= getRealValue($locker, "locker");
	}
	// End : New fields from new design
	
	
	
	$IncVar	= '';
	if($reType == 'Commercial')
	{
		$IncVar	= getRealValue($minprice,"minprice").
				  getRealValue($maxprice,"maxprice").
				  getRealValue($city,"city").
				  getRealValue($postal,"postal");
	}
	else
	{
		$IncVar	= getRealValue($reBedrooms,"reBedrooms").
				  getRealValue($reBathrooms,"reBathrooms").
				  getRealValue($minprice,"minprice").
				  getRealValue($maxprice,"maxprice").
				  getRealValue($othertype,"othertype").
				  getRealValue($style,"style").
				  getRealValue($bedplus,"bedplus").
				  getRealValue($heatsource,"heatsource").
				  getRealValue($cooling,"cooling").
				  getRealValue($basement,"basement").
				  getRealValue($kitchens,"kitchens").
				  getRealValue($exterior,"exterior").
				  $poolsql.
				  $laundrysql.
				  $furnishedsql.
				  $heatincsql.
				  $hydroincsql.
				  $squarefeetsql.
				  $exposuresql.
				  $petssql.
				  $lockersql;
	}
	
	
	if($favorite==1){
	   $allfavs=rtrim(str_replace(":", ",", $_SESSION["marked_reid"]),',');
	   $qr="SELECT id, 
	   			   latitude as la, 
				   longitude as lo, 
				   retype, 
				   subtype, 
				   headline, 
				   pictures, 
				   price, 
				   bedrooms, 
				   bathrooms ,
				   timestamp_sql
		    FROM $reListingTable 
			WHERE id IN ($allfavs);";
	}else{
		//$qr="select id, latitude as la, longitude as lo, retype, subtype, headline, pictures, price from $reListingTable where listing_type <> 3  ".getRealValue($reClassification,"reClassification").getRealValue($reType,"reType").getRealValue($reSubtype,"reSubtype").getRealValue($reBedrooms,"reBedrooms").getRealValue($reBathrooms,"reBathrooms").getRealValue($rePrice,"rePrice").getRealValue($reQuery,"reQuery").getRealValue($reCity,"reCity").";";
		$qr="SELECT id, 
					latitude as la, 
					longitude as lo, 
					retype, 
					subtype, 
					headline, 
					pictures, 
					price,
					bedrooms,
					bathrooms,
					postal, 
					city,
					timestamp_sql
			 FROM $reListingTable 
			 WHERE 1 = 1 AND ($reListingTable.latitude != '' AND $reListingTable.longitude != '') ".getRealValue($reClassification,"reClassification").
			 									  getRealValue($reType,"reType").
												  $IncVar.";";
		//echo $qr;exit; 
	}
	$result=mysql_query($qr);
	//print "swlatitude=$swlatitude,<br />swlongitude=$swlongitude,<br />nelatitude=$nelatitude,<br />nelongitude=$nelongitude<br /><br />";
	while($tlisting = mysql_fetch_assoc($result)){
		if(coordinate_in_bounds($swlatitude, $swlongitude, $nelatitude, $nelongitude, $tlisting['la'], $tlisting['lo'])){
	  		$boundListings[]=$tlisting;
	 	}
		//print "<br />coordinates: $swlatitude, $swlongitude, $nelatitude, $nelongitude, <br /><br />".$tlisting['la'].", ".$tlisting['lo'];
	}
	
	$numResults=sizeof($boundListings);
	$totalPages=ceil($numResults/$listingsPerPage);
	if($pageNum>$totalPages)$pageNum=$totalPages;
	
	$allTextListings="";
	$thumbnailWidth=100;
	$count=0;
	
	if($endListingNum>$numResults)$endListingNum=$numResults;
	
	//print "$startListingNum, $endListingNum, $numResults<br />";
	if($numResults>0){
		$ncnt = 0;
		for($c=$startListingNum;$c<$endListingNum;$c++){
			if($count>=$listingsPerPage) break;
			$tlisting=$boundListings[$c];   
			$count++;
			 
			$rePicArray=explode("::",$tlisting['pictures'],3); 
			if(isset($rePicArray) && $rePicArray[0] != ""){
				$TempIMG	= $SitePath.'/uploads/'.$rePicArray[0];
				$rePicArray[0] = $SitePath.'/uploads/'.$rePicArray[0];// Hitesh
				$picClause="<div class='textimage' style='color:white !important'><img src='timthumb.php?w=$thumbnailWidth&src=".$rePicArray[0]."' /></div>";
				//$picClause="<div class='textimage'><img width='$thumbnailWidth' src='".$rePicArray[0]."' /></div>";
				
			}
			else 
			{
				$picClause="<div class='textimage'><img width='$thumbnailWidth' src='images/no-image.png' /></div>";
				$TempIMG	= $SitePath.'/images/no-image.png';
			}
			/*if($tlisting['price']>0){
				if($currency_before_price) $priceClause="<br /><span class='textcontent_price' style='color:white !important'>".__("Price").": $defaultCurrency ".$tlisting['price']."</span>"; 
				else $priceClause="<br /><span class='textcontent_price' style='color:white !important'>".__("Price").": ".$tlisting['price']." $defaultCurrency</span>";
			} else $priceClause="";
			
			$allTextListings="<div class='textrecord' id='textrecord-".$tlisting['id']."'><span class='textcontent_headline'>".substr($tlisting['headline'], 0, 21)."..</span>$picClause<div class='textcontent'><span class='textcontent_type'>".__($tlisting['retype'])." - ".__($tlisting['subtype'])."</span>$priceClause</div><span class='textlatlong' style='display:none;'>".$tlisting['la'].",".$tlisting['lo']."</span></div>".$allTextListings;
			*/
			
			// Start : Hitesh Favorite record check
			$TotFav	= 0;
		  	if(!empty($tlisting['id'])){
			  	$CheckFavSql	= "SELECT COUNT(*) as Tot FROM favorites WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																		   		property_id = '".$tlisting['id']."' AND 
																		   		page = 'Realestate'";
			  	$CheckFavQue	= mysql_query($CheckFavSql);
			  	$ResFav		= mysql_fetch_assoc($CheckFavQue);
			  	$TotFav		= $ResFav['Tot'];
		  	}
			$TempHeartSrc = 'images/black-heart.png';
			$TempHeartCls = 'blackcls';
			$TempOnclick  = 'javascript:dofavorite('.$tlisting['id'].')';	
			$MouseHovor	  = 'onmouseover="this.src=\'images/hhg.png\'"';	
			$MouseOut	  = 'onmouseout="this.src=\'images/black-heart.png\'"';	
			if($TotFav > 0)
			{
				$MouseHovor   = '';
				$MouseOut	  = '';
				$TempHeartSrc = 'images/hhg.png';
				$TempHeartCls = 'redcls';
			}
			// End : Hitesh Favorite record check
			
			// Start : Hitesh Compare record
			$TotComp	= 0;
		  	if(!empty($tlisting['id'])){
			  	$CheckCompSql	= "SELECT COUNT(*) as Tot FROM compare_properties WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																		   				 property_id = '".$tlisting['id']."' AND 
																		   				 page = 'Realestate'";
			  	$CheckCompQue	= mysql_query($CheckCompSql);
			  	$ResComp		= mysql_fetch_assoc($CheckCompQue);
			  	$TotComp		= $ResComp['Tot'];
		  	}
			$TempCompSrc = 'images/house-gray.png';
			$TempCompCls = 'blackcls';
			$TempCompOnclick  = 'javascript:compareproperty('.$tlisting['id'].')';	
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
			
			$PicturesCnt	= count(explode('::', $tlisting['pictures']));
			$TempFunName	= 'reMarkedListing';
			//$allTextListings="<div style='width:50%; float:left; -webkit-box-shadow:inset 0px 1px 15px 0px #adadac; box-shadow:-4px -4px 6px #888888; -moz-box-shadow:inset 0px 1px 15px 0px #adadac; background-color:#efede7; border:1px solid #adadac; height:300px !important; margin: 3px 0px;font-family:Arial; font-size:13px; padding:6px 24px; background-image: url(".$TempIMG."); background-repeat: no-repeat;'><div style='float:left; color:white'>".$PicturesCnt." photos</div><div class='clsimg'><img ".$MouseHovor." ".$MouseOut." id='heartid".$tlisting['id']."' onclick=".$TempOnclick." class='".$TempHeartCls."' height='32' width='32' src='".$TempHeartSrc."' style='float:right;'></div><div class='textrecord' id='textrecord-".$tlisting['id']."'><div class='textcontent' style='color:white !important; margin-top:55%; font-size:125%;'><hr /><div class='textcontent_type' style='color:white !important'><span style='font-weight:bold;color:white !important;font-size: larger;line-height:30px;'> $".__($tlisting['price'])."</span> - ".__($tlisting['bedrooms'])." Bedrooms - ".__($tlisting['bathrooms'])." Bathrooms<br />  <span style='font-weight:bold;color:white !important;'> ".__(substr($tlisting['headline'], 0, 21)).", ".__($tlisting['city'])."</span> </div>$priceClause</div> <span class='textlatlong' style='display:none;'>".$tlisting['la'].",".$tlisting['lo']."</span></div></div>".$allTextListings;
			 
			 // Date Compare
			 $timestamp_sql_tmp = substr( $tlisting['timestamp_sql'], 0, -2 ) ; 
			 $current_time = date("Y-m-d H:i:s");
			 $difftime	= time_since(strtotime($timestamp_sql_tmp),strtotime($current_time));
			 
			 $ncnt++;	
			  if($ncnt==1){	
				  $allTextListings='<div id="textrecord-'.$tlisting['id'].'" class="textrecord owl-item"><div class="item"><div class="hot_properties_item"><div class="hot_properties_item_top"><div class="item_img"><img width="480" height="320" src="'.$TempIMG.'"></div><div class="timer_div" ><span class="timer_span">'.$difftime.'</span></div><p class="tag_c"><img '.$MouseCompHovor.' '.$MouseCompOut.' id="comp'.$tlisting['id'].'" onclick='.$TempCompOnclick.' class="'.$TempCompCls.'" height="32" width="32" src="'.$TempCompSrc.'" style="float:right;" /></p><p class="tag_p"><img '.$MouseHovor.' '.$MouseOut.' id="heartid'.$tlisting['id'].'" onclick='.$TempOnclick.' class="'.$TempHeartCls.'" height="32" width="32" src="'.$TempHeartSrc.'" style="float:right;"></p><div class="tag_social"><div class="addthis_inline_share_toolbox"></div><script type="text/javascript">$(document).ajaxStop(function() { if (window.addthis) {	window.addthis = null; window._adr = null; window._atc = null; window._atd = null; window._ate = null; window._atr = null; window._atw = null; } return $.getScript("http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58351a9bbda6054f");});</script></div></div><div class="hot_properties_item_bot"><b style="color: #000000;">$ '.__(number_format($tlisting['price'])).'</b><p class="main_p"></p><p class="second_p"  style="color: #ff0000;">'.__(substr($tlisting['headline'], 0, 21)).'</p><p class="third_p">'.__($tlisting['city']).'</p><p class="third_p">'.__($tlisting['bedrooms']).' <img src="images/bed.png" height="20" width="20" >  &nbsp; '.__($tlisting['bathrooms']).' <img src="images/bath.png" height="20" width="20" ></p></div></div><span class="textlatlong" style="display:none;">'.$tlisting['la'].','.$tlisting['lo'].'</span></div></div>'.$allTextListings;
			  }else{
				  $allTextListings='<div id="textrecord-'.$tlisting['id'].'" class="textrecord owl-item"><div class="item"><div class="hot_properties_item"><div class="hot_properties_item_top"><div class="item_img"><img width="480" height="320" src="'.$TempIMG.'"></div><div class="timer_div" ><span class="timer_span">'.$difftime.'</span></div><p class="tag_c"><img '.$MouseCompHovor.' '.$MouseCompOut.' id="comp'.$tlisting['id'].'" onclick='.$TempCompOnclick.' class="'.$TempCompCls.'" height="32" width="32" src="'.$TempCompSrc.'" style="float:right;" /></p><p class="tag_p"><img '.$MouseHovor.' '.$MouseOut.' id="heartid'.$tlisting['id'].'" onclick='.$TempOnclick.' class="'.$TempHeartCls.'" height="32" width="32" src="'.$TempHeartSrc.'" style="float:right;"></p><div class="tag_social"><div class="addthis_inline_share_toolbox"></div><script type="text/javascript">$(document).ajaxStop(function() { if (window.addthis) {	window.addthis = null; window._adr = null; window._atc = null; window._atd = null; window._ate = null; window._atr = null; window._atw = null; } return $.getScript("http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58351a9bbda6054f");});</script></div></div><div class="hot_properties_item_bot"><b style="color: #000000;">$ '.__(number_format($tlisting['price'])).'</b><p class="main_p"></p><p class="second_p" style="color: #0a368a;">'.__(substr($tlisting['headline'], 0, 21)).'</p><p class="third_p">'.__($tlisting['city']).'</p><p class="third_p">'.__($tlisting['bedrooms']).' <img src="images/bed.png" height="20" width="20" > &nbsp;  '.__($tlisting['bathrooms']).' <img src="images/bath.png" height="20" width="20" ></p></div></div><span class="textlatlong" style="display:none;">'.$tlisting['la'].','.$tlisting['lo'].'</span></div></div>'.$allTextListings;					  
			  }
			  
			  if($ncnt == 2)
			  {
				$ncnt = 0;	  
			  }
			  
		}
	}
	
	if($pageNum==1)$pgClassStart="disabled";
	else $pgClassStart="pgNav";
	if($pageNum==$totalPages)$pgClassEnd="disabled";
	else $pgClassEnd="pgNav";
	$nextPage=$pageNum+1;
	$prevPage=$pageNum-1;
	
	if($pageNum<5){
		$maxNumOfPagesInNavigation=5;
		$newFirstPage=1;
	}else{
		$newFirstPage=$pageNum-2;
		$maxNumOfPagesInNavigation=$pageNum+2;
	}
	
	print $allTextListings;
	
	
	if(strlen(trim($allTextListings)) > 0){
		print "<table id='textResultsTable'><tr><td colspan='5'><div><ul class='pagination'>"; ?>
		<li class='<?php print $pgClassStart; ?>'><a href='javascript: void(0)'  id='testResultLink-<?php print $prevPage; ?>'><?php print __("Previous");?></a></li>
		<?php 
		if($maxNumOfPagesInNavigation>$totalPages) $maxNumOfPagesInNavigation=$totalPages;
		for($pg=$newFirstPage;$pg<=$maxNumOfPagesInNavigation;$pg++){
			if($pg!=$pageNum){
			 ?>
			<li><a href='javascript: void(0)' class='pgNav' id='testResultLink-<?php print $pg; ?>'><?php print $pg; ?></a></li>
		<?php }else{
			 ?>
			<li class='active'><a href='javascript: void(0)' id='testResultLink-<?php print $pg; ?>'><?php print $pg; ?></a></li>
		<?php } 
		}
		?>
		<li class='<?php print "$pgClassEnd"; ?>'><a href='javascript: void(0)' id='testResultLink-<?php print $nextPage; ?>'><?php print __("Next");?></a></li></ul></div></td></tr>
		<?php
		print "</table>";
	}else{
		print "<p style='margin-top:10px;text-align:center;'>".__("No results found").".</p>";
	} 	
	return ob_get_clean();
}

/* Checks if supploed lat/lng are within the bound */
function coordinate_in_bounds($sw_lat, $sw_lng, $ne_lat, $ne_lng, $lat, $lng) {
    $inLng = false;
    $inLat = false;
    if($sw_lat > $ne_lat) $inLat = $lat > $ne_lat && $lat < $sw_lat;
    else $inLat = $lat < $ne_lat && $lat > $sw_lat;
    
    $inLng = $lng < $ne_lng && $lng > $sw_lng;
    return $inLat && $inLng;
    }

/* Escapes javascript for safe usage */
function escapeJavaScriptText($string)
{
	return json_decode(str_replace("\u2029","",str_replace("\u2028", "", json_encode($string))));
}

/* Returns a part of the utf8 string */
function utf8_substr($str,$start)
{
	preg_match_all("/./u", $str, $ar);

	if(func_num_args() >= 3) {
		$end = func_get_arg(2);
		return join("",array_slice($ar[0],$start,$end));
	} else {
		return join("",array_slice($ar[0],$start));
	}
}

/* Changes the translation of a language tag */
function updateLangTag($q){
    include("config.php");
    list($keyword,$translation,$defaultLanguage)=explode(":::",$q); $translation=trim($translation);
    $qr00="select * from $languageTable where translation='$translation' and keyword <> '$keyword' and language='$defaultLanguage'"; 
    $result00=mysql_query($qr00);
    if(mysql_num_rows($result00)<1){
     $qr="update $languageTable set translation='$translation' where keyword = '$keyword' and language='$defaultLanguage'";  
     if($isThisDemo!="yes") $result=mysql_query($qr); 
     if($result) print "Translation updated"; else print "Translation couldn't be updated.";
    }else{
        $row00=mysql_fetch_assoc($result00);
        print "<p align='center'>Same translation already exist for the keyword <b>'".$row00['keyword']."'</b>. Please use a unique translation.<p>";
    }
}

/* Add a new tag with its translation */
function addNewTag($q){
    include("config.php");
    list($keyword,$translation,$defaultLanguage)=explode(":::",$q);
    $qr00="select * from $languageTable where translation='$translation' and language='$defaultLanguage'"; 
    $result00=mysql_query($qr00);
    if(mysql_num_rows($result00)<1){
    $qr0="select * from $languageTable where keyword='$keyword' and language='$defaultLanguage'";
    $result0=mysql_query($qr0);
    $qr2="insert into $languageTable (keyword,translation,language) values ('$keyword','$translation','$defaultLanguage')";
    
    if($isThisDemo=="no"){
    if(@mysql_num_rows($result0)<1){
    $result2=mysql_query($qr2);
    if($result2){
        print "<p align='center'>New keyword and translation ".stripslashes($category)." has been added.</p>";
        unset($_SESSION["cl_language"]);
    }else print "<p align='center'>Keyword and translation ".stripslashes($category)." couldn't be added. Please try again.</p>";
    }else{
        print "<p align='center'>The keyword and translation ".stripslashes($category)." already exists. ".mysql_error()."</p>";
    }
    }else print "Adding a new keyword and translation has been disabled in the demo.";
    }else{
        $row00=mysql_fetch_assoc($result00);
        print "<p align='center'>Same translation already exist for the keyword <b>'".$row00['keyword']."'</b>. Please use a unique translation.<p>";
    }
}

/* Returns entire listing data */
function getListingData($reid){
	include("config.php");
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	mysql_query("SET NAMES utf8");
	$reid=mysql_real_escape_string($reid);
	//$_SESSION["reid"]=$reid.":".$_SESSION["reid"];
	$allMarkedreid=explode(":",$_SESSION["marked_reid"]);

	$reCookieTime = 60 * 60 * 24 * 12 + time();
	list($tempw,$redomain)=explode(".",$_SERVER['HTTP_HOST'],2);
	setcookie('reidvisit', $_SESSION["reid"], $reCookieTime,"/", ".".$redomain, 1, true);

	$qr="select * from $reListingTable where id='$reid'";
	$result=mysql_query($qr);
	$row=mysql_fetch_assoc($result);
	return $row;
}

/* Fetches the coordinates for an address */
function getLonglat2($address){
	define("MAPS_HOST", "maps.google.com");
	define("KEY", $googleMapAPIKey);
	$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv";//&key=" . KEY;
	$request_url = $base_url . "&q=" . urlencode($address);
	//print $request_url."<br />";

	if(ini_get('allow_url_fopen') ) {
		$googleResult=file_get_contents($request_url);
	}else{
		if (!_iscurlinstalled()){
			echo "<p align='center'>cURL is NOT installed. Google geocoding won't work. Please ask your hosting provider to enable cURL or allow_url_fopen.</p>";
		}else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $request_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$googleResult = curl_exec ($ch);

		}
	}
	list($responseCode,$temp,$latitude,$longitude)=explode(",",$googleResult);
	return "$latitude::$longitude";
}

/* Fetches the coordinates for an address */
function getLongLat($address){
    $address=urlencode($address);
    $request_url = $base_url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
    
    if(ini_get('allow_url_fopen') ) {
    $googleResult=file_get_contents($request_url);
    }else{
    if (!_iscurlinstalled()){ 
        echo "<p align='center'>cURL is NOT installed. Google geocoding won't work. Please ask your hosting provider to enable it.</p>";
    }else{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $googleResult = curl_exec ($ch);
   }
    }
    $googlemap=json_decode($googleResult);
    if(!empty($googlemap)){
    foreach($googlemap->results as $res){
        $address = $res->geometry;
        $latlng = $address->location;
        $formattedaddress = $res->formatted_address;
    }
    }
 
    return $latlng->lat."::".$latlng->lng;
    
}

/* Test function */
function getMapListingTest($reid){
    ob_start();
    include("config.php"); $ptype="showOnMap";
    list($reid,$region)=explode("::",$reid); 
    if($region==="") $viewListingRow=getListingData($reid); 
    else $viewListingRow=getListingData($reid,$region);
    include("viewFullListing.php");
    $string = ob_get_clean();
    return json_encode($string);
  
}

/* Gets authorization code value */
function acode($q=""){
include("config.php");
$qr0="select authorization_code from $adminOptionTable";
$result0=mysql_query($qr0); 
$record=mysql_fetch_assoc($result0);
print $record['authorization_code'];   
}

/* Checks if cURL is installed on the server */    
function _iscurlinstalled() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	}
	else{
		return false;
	}
}

/* Shows image upload form after a listing has been added */
function getListingImageUploadForm($reid,$divid,$reimgid=""){
	include("config.php");
	$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);

	?>
<div id='reimg<?php print $divid; ?>'>
<?php if(trim($reimgid)!=""){ list($temppart,$actualImgName)=explode("uploads/",$reimgid); ?>
<?php if($isThisDemo=="yes"){ ?>
<p align='center'><a class='deletepiclink' ><?php print $relanguage_tags["Delete Picture"]; ?></a></p><br />
<?php }else{ ?>
<p align='center'><a href='javascript: void(0)' onclick="infoResults('<?php print $reimgid.":::".$reid; ?>',12,'reimg<?php print $divid; ?>')" /><?php print $relanguage_tags["Delete Picture"]; ?></a></p><br />
<?php } ?>
 

<?php 
print "<img src='timthumb.php?w=250&src=$reimgid' width='250' border='0' />";
 } 
 
 ?>
</div>
<form action="ajaxupload.php" method="post" name="unobtrusive" id="unobtrusive" enctype="multipart/form-data">
<input type="hidden" name="maxSize" value="1024000" />
<input type="hidden" name="maxW" value="1200" />
<input type="hidden" name="fullPath" value="<?php print $full_url_path."uploads/"; ?>" />
<input type="hidden" name="relPath" value="uploads/" />
<input type="hidden" name="colorR" value="255" />
<input type="hidden" name="colorG" value="255" />
<input type="hidden" name="colorB" value="255" />
<input type="hidden" name="maxH" value="1000" />
<input type="hidden" name="filename" value="filename" />
<p><input type="file" name="filename" id="filename-<?php print $divid; ?>" class="refileup" value="filename" onchange="ajaxUpload(this.form,'ajaxupload.php?filename=filename&amp;maxSize=1024000&amp;maxW=1200&amp;fullPath=<?php print $full_url_path."uploads/"; ?>&amp;relPath=uploads/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=1000&amp;reid=<?php print $reid; ?>&amp;reimgid=<?php print $reimgid; ?>&amp;repicid=<?php print $divid; ?>','reimg<?php print $divid; ?>','<?php print $relanguage_tags["File Uploading Please Wait"]; ?>...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; <?php print $relanguage_tags["Error in upload"];?>.'); return false;" /></p>
<noscript><p><input type="submit" class='rebutton' name="submit" value="Upload Image" /></p></noscript>
</form>
<?php 	
//print $relanguage_tags["File Uploading Please Wait"]." - ".$relanguage_tags["File Uploading Please Wait"];
}

/* Sends email using phpmailer */
function sendReEmail($visitor_email,$msgbody,$to_email,$to_name,$subject,$show_response=true){
	include("config.php");
	
	if(is_ip_private($_SERVER['REMOTE_ADDR']) == false){
	if($gmailUsername!="" && $gmailPassword!=""){
	require_once("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP(); // send via SMTP
	$mail->SMTPAuth   = true; //$SMTPAuth;                  // enable SMTP authentication
	$mail->CharSet = 'UTF-8';
	if($emaildebug=="yes") $mail->SMTPDebug = 1;
	if($resmtp=="smtp.gmail.com") $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	if($resmtpport==465) $mail->SMTPSecure = "ssl";
	$mail->Host       = $resmtp;      // sets GMAIL as the SMTP server
	$mail->Port       = $resmtpport;
	$mail->Username = $gmailUsername; // SMTP username
	$mail->Password = $gmailPassword; // SMTP password
	$mail->From = $gmailUsername;
	
	$mail->FromName = $reSiteName;
	$mail->AddAddress($to_email,$to_name);
	
	$mail->AddCC('homula01@gmail.com', 'homula01@gmail.com');
	$mail->AddCC('frankdigitally@gmail.com', 'frankdigitally@gmail.com');
	$mail->AddCC('ray@realestate.homula.com', 'ray@realestate.homula.com');
	$mail->AddCC('rayazar@royallepage.ca', 'rayazar@royallepage.ca');
	$mail->AddCC('sales@realestate.homula.com', 'sales@realestate.homula.com');
	
	$mail->AddReplyTo($visitor_email,$reSiteName);
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = $subject;
	$mail->Body = $msgbody;
	
	if(!$mail->Send())
	{
	if($show_response) echo "<h3 align='center'>".$relanguage_tags["Message can not be sent"].": " . $mail->ErrorInfo."<br /><a href='javascript:history.go(-1);'>".$relanguage_tags["Go back"]."</a></h3>";
		//sendReEmail2($visitor_email,$msgbody,$to_email,$to_name,$subject);
	}
	else
	{
	if($show_response) echo "<h3 align='center'>".$relanguage_tags["Message has been sent"].". <a href='javascript:history.go(-1);'><b>".$relanguage_tags["Go back"]."</b></a></h3>";
	}
	}
 }else{
    if($show_response) print "<h3 align='center'>".__("Email can't be sent through localhost.")."</h3>";
 }	
}

/* Checks if it is a private IP. It is useful as email phpmailer function hangs on localhost */
function is_ip_private ($ip) {
    $pri_addrs = array (
                      '10.0.0.0|10.255.255.255', // single class A network
                      '172.16.0.0|172.31.255.255', // 16 contiguous class B network
                      '192.168.0.0|192.168.255.255', // 256 contiguous class C network
                      '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
                      '127.0.0.0|127.255.255.255' // localhost
                     );

    $long_ip = ip2long ($ip);
    if ($long_ip != -1) {
        foreach ($pri_addrs AS $pri_addr) {
            list ($start, $end) = explode('|', $pri_addr);
             if ($long_ip >= ip2long ($start) && $long_ip <= ip2long ($end)) return true;
        }
    }

    return false;
}


/* Sends email using sendmail */
function sendReEmail2($visitor_email,$msgbody,$to_email,$to_name,$subject,$show_response=true,$debug=""){
	include("config.php");

	require("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	$mail->IsSendmail(); // telling the class to use SendMail transport

	try {
		$mail->AddReplyTo($visitor_email, $reSiteName);
		$mail->AddAddress($to_email,$to_name);
		$mail->SetFrom($gmailUsername, $reSiteName);
		$mail->AddReplyTo($visitor_email, $reSiteName);
		$mail->Subject = $subject;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		$mail->Body = $msgbody;
		 
		if(!$mail->Send())
		{
			if($show_response) echo "<h3 align='center'>".$relanguage_tags["Message can not be sent"].": " . $mail->ErrorInfo."<br /><a href='javascript:history.go(-1);'>".$relanguage_tags["Go back"]."</a></h3>";
		}
		else
		{
			if($show_response) echo "<h3 align='center'>".$relanguage_tags["Message has been sent"].". <a href='javascript:history.go(-1);'><b>".$relanguage_tags["Go back"]."</b></a></h3>";
		}
		 
	} catch (phpmailerException $e) {
		echo "phpmailerException: ".$e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo "Exception: ".$e->getMessage(); //Boring error messages from anything else!
	}


}


/* Add space between a very long string that can break formatting of a page */
function breakBigString($bigString,$maxStringLen){
	$descriptionArray=explode(" ",$bigString);
	$descriptionArraySize=sizeof($descriptionArray);
	$totalDescriptionLength=0;
	//print "array: $descriptionArraySize";
	if($descriptionArraySize>1){
	for($j=0;$j<$descriptionArraySize;$j++){
		$descParts=round(strlen($descriptionArray[$j])/$maxStringLen);
		if(strlen($descriptionArray[$j])>$maxStringLen){
			for($i=1;$i<=$descParts;$i++){
				$splitAt=$i * $maxStringLen;
				$descriptionArray[$j]=substr_replace($descriptionArray[$j], " ", $splitAt, 0);
			}
			//print "<br />long pc $j, $descParts: ".$descriptionArray[$j];
		}
	}
	$bigString=implode(" ",$descriptionArray);
	}else{
		//print "0 array - opt 2<br />";
		if(strlen($bigString)>$maxStringLen){
			$descParts=round(strlen($bigString)/$maxStringLen);
			//print "desc parts: ".$descParts;
			for($i=1;$i<=$descParts;$i++){
					$splitAt=$i * $maxStringLen;
					//print "<br />split at: ".$splitAt;
					$bigString=substr_replace($bigString, " ", $splitAt, 1);
				}
				//print "<br />long pc $j, $descParts: ".$descriptionArray[$j];
			
		}
	}
	
	return $bigString;
}

/* Function used to upload an image */
function uploadImage($mem_id){
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
	$full_url_path=dirname(__FILE__)."/";
	$path = $full_url_path."uploads/";

	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		list($old_img_name,$old_ext)=explode("\.",$name);
		if(strlen($name))
		{
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats))
			{
				if($size<(1024*1024)) // Image size max 1 MB
				{
					$actual_image_name = $old_img_name.time().$mem_id.".".$ext;
					$tmp = $_FILES['photoimg']['tmp_name'];
					if(move_uploaded_file($tmp, $path.$actual_image_name))
					{
						//mysql_query("update $rememberTable set photo='$actual_image_name' WHERE id='$mem_id'");
						return $actual_image_name;
						//echo "<img src='uploads/".$actual_image_name."' class='preview'>";
					}
					else
					echo "<p align='center'>Failed uploading image.</p>";
				}
				else
				echo "<p align='center'>Image file size max 1 MB</p>";
			}
			else
			echo "<p align='center'>Invalid file format..</p>";
		}
		else
		echo "<p align='center'>Please select image..!</p>";
		exit;

	}

}

/* Shows featured button */
function featuredButton($current_mem_id,$mem_id,$reid){
	include("config.php");
	//print "$current_mem_id, $mem_id".$_SESSION["memtype"];
	if($current_mem_id==$mem_id || $_SESSION["memtype"]==9){
		$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
	?>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="<?php print $ppemail; ?>">
	<input type="hidden" name="item_name" value="Featured Listing">
	<input type="hidden" name="item_number" size=30 value="<?php print $reid; ?>">
	<input type="hidden" name="amount" value="<?php print $featuredprice; ?>">
	<input type="hidden" name="currency_code" value="<?php print $ppcurrency; ?>">
	<input type="hidden" name="button_subtype" value="products">
	<input type="hidden" name="cn" value="Add special instructions to the seller">
	<input type="hidden" name="no_shipping" value="2">
	<input type="hidden" name="rm" value="1">
	<input type="hidden" name="return" value="<?php print $full_url_path; ?>">
	<input type="hidden" name="cancel_return" value="<?php print $full_url_path; ?>">
	<input type="hidden" name="bn" value="PP-BuyNowBF">
	<input  type="submit" class='btn btn-sm btn-primary' height='30' width='100' value='<?php print $relanguage_tags["Buy Featured"]; ?>' name="submit" alt="<?php print $relanguage_tags["Buy Featured"]; ?>">
	
	<?php 
	}
}

/* Replaces unwanted characters from a string so it can be safely used in a url */
function friendlyUrl($str = '',$replace='-') {

    $friendlyURL = htmlentities($str, ENT_COMPAT, "UTF-8", false); 
    $friendlyURL = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','\1',$friendlyURL);
    $friendlyURL = html_entity_decode($friendlyURL,ENT_COMPAT, "UTF-8"); 
    $friendlyURL = preg_replace('/[^a-z0-9-]+/i', $replace, $friendlyURL);
    $friendlyURL = preg_replace('/-+/', $replace, $friendlyURL);
    $friendlyURL = trim($friendlyURL, $replace);
    $friendlyURL = strtolower($friendlyURL);
    return $friendlyURL;

}

/* Remove them if magic_quotes are enabled on a server */
function remove_magic($array, $depth = 5)
{
	if($depth <= 0 || count($array) == 0)
	return $array;

	foreach($array as $key => $value)
	{
		if(is_array($value))
		$array[stripslashes($key)] = remove_magic($value, $depth - 1);
		else
		$array[stripslashes($key)] = stripslashes($value);
	}

	return $array;
}

/* Add extra html for the supplied page and outputs it */
function loadPage($filename){
	global $fullRelisting, $ptype, $memtype, $mem_id;
	include("config.php");
	?>
	<div class='row'>
	<div class='col-sm-4 col-md-4 col-lg-4'>
	<div id="sidebar">
	 <div id='sidebarLogin'>
     <span class='a_block'>
      <?php include("loginForm.php"); ?>
    <!-- <div class='ssocial'><a href='rss.php'><img border='0' src='images/rss.png' /></a></div> -->
     </span>
    </div>
	</div> <!-- end #sidebar -->
	</div>	  <!-- end span4 -->
	<div class='col-sm-8 col-md-8 col-lg-8'>  
	 <div id="mainContent">
	  <?php include($filename); ?>
	 </div> <!-- end #mainContent -->
	</div> <!-- end span8 -->
	</div> <!-- end row -->
			<br class="clearfloat" />
	<?php 
}

/* Ping the sitemap to major search engines. */
function pingSitemap(){
	$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
	$sitemap = $full_url_path."sitemap.php";

	$pingurls = array(
			"http://www.google.com/webmasters/tools/ping?sitemap=",
			"http://submissions.ask.com/ping?sitemap=",
			"http://webmaster.live.com/ping.aspx?siteMap="
	);
	if (_iscurlinstalled()){
		foreach ($pingurls as $pingurl) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $pingurl.$sitemap);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			curl_close($ch);
		}
	}
}

/* Get language short code for a language name */
function getLanguageName($langCode){
	$language="English";

	switch ($langCode){
		case "ar":
			$language="﻿Arabic";
			break;

		case "bg":
			$language="Bulgarian";
			break;

		case "ca":
			$language="Catalan";
			break;

		case "zh":
			$language="Chinese Simplified";
			break;

		case "cs":
			$language="Czech";
			break;

		case "da":
			$language="Danish";
			break;

		case "nl":
			$language="Dutch";
			break;

		case "en":
			$language="English";
			break;

		case "et":
			$language="Estonian";
			break;

		case "fi":
			$language="Finnish";
			break;

		case "fr":
			$language="French";
			break;

		case "de":
			$language="German";
			break;

		case "el":
			$language="Greek";
			break;

		case "ht":
			$language="Haitian Creole";
			break;

		case "he":
			$language="Hebrew";
			break;

		case "hi":
			$language="Hindi";
			break;

		case "hu":
			$language="Hungarian";
			break;

		case "id":
			$language="Indonesian";
			break;

		case "it":
			$language="Italian";
			break;

		case "ja":
			$language="Japanese";
			break;

		case "ko":
			$language="Korean";
			break;

		case "lv":
			$language="Latvian";
			break;

		case "lt":
			$language="Lithuanian";
			break;

		case "no":
			$language="Norwegian";
			break;

		case "pl":
			$language="Polish";
			break;

		case "pt":
			$language="Portuguese";
			break;

		case "ro":
			$language="Romanian";
			break;

		case "ru":
			$language="Russian";
			break;

		case "sk":
			$language="Slovak";
			break;

		case "sl":
			$language="Slovenian";
			break;

		case "es":
			$language="Spanish";
			break;

		case "sv":
			$language="Swedish";
			break;

		case "th":
			$language="Thai";
			break;

		case "tr":
			$language="Turkish";
			break;

		case "uk":
			$language="Ukrainian";
			break;

		case "vi":
			$language="Vietnamese";
			break;
	}
	return $language;

}

/* Checks if user is on mobile */
function isThisMobile(){
	$mobile_browser = '0';

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}

	if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
		$mobile_browser++;
	}

	if (strpos(strtolower($_SERVER['ALL_HTTP']),'operamini')>0) {
		$mobile_browser++;
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
		$mobile_browser = 0;
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iemobile')>0) {
		$mobile_browser++;
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),' ppc;')>0) {
		$mobile_browser++;
	}

	if ($mobile_browser > 0) {
		return true;
	}
	else {
		return false;
	}

}


?>