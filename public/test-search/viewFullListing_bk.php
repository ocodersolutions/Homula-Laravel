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
	if($row['price']!="" && $currency_before_price) $full_price=$defaultCurrency.number_format($row['price'])." - "; else $full_price="";
	?>
	
	<div id='rememberAction'>
	  <table id='resultTable'>
		<tr class='headRow1'>
		  <td colspan='2' class='bg-primary'><i class="fa fa-home" aria-hidden="true" style="display:none;"></i><span class='listingTitle'><?php print __($full_price.$row['subtype'])." - ".$partialAddress; ?></span>
			<?php if($row['listing_type']==2){ print "<span class='featuredlisting label label-primary'>".$relanguage_tags["Featured"]."</span>"; } print hasVisited($row['id']); ?>
			<div class="pull-right" id='closeMapListing' style="cursor:pointer;"><img src='images/fancy_close.png' height='20' alt='' /></div></td>
		</tr>
		<?php
		$tdbimgWidth="60%";
		$buttonsStyle="";
		if($totalRePics<=1){
			 $tdbimgWidth="70%";
			 $buttonsStyle=" style='margin:0;' ";
		} 
		if($totalRePics<=5 && $totalRePics>1) $tdbimgWidth="85%";
		if($totalRePics<=10 && $totalRePics>5) $tdbimgWidth="70%";
		
		?>
		<tr id="trImage">
		  <td style="vertical-align:top; width:<?php print $tdbimgWidth; ?>;" id='image_cell'><div id='listingImage'>
			  <?php 
			  if(trim($rePicArray[0])!=""){ 
			  	$MainImage = $SitePath.'/uploads/'.$rePicArray[0];//Hitesh
			  
			  ?>
			  	<a data-fancybox-group='listgallery' href='<?php print $MainImage; ?>' ><img alt='listing image' src='<?php print $MainImage; ?>' style='width:100%; height:400px' /></a>
			  <?php 
			  } 
			  ?>
              
              <?php
			  
              for($imgCount=1;$imgCount<$totalRePics;$imgCount++){ 
					if(trim($rePicArray[$imgCount])!=""){
						$tmpSubImages = $SitePath.'/uploads/'.$rePicArray[$imgCount]; ?>
                        <a data-fancybox-group='listgallery' style="display:none;" href='<?php echo $tmpSubImages; ?>' ><img alt='listing image' src='<?php echo $tmpSubImages; ?>' style='width:100%; height:400px' /></a>
						
                        <?
					}
				}
			  
			  ?>
              
              
			</div>
            
            
            
            </td>
            <div id="hiddendiv_listingimages" style="display:none;">
                <?php
			  
              for($imgCount=0;$imgCount<$totalRePics;$imgCount++){ 
					if(trim($rePicArray[$imgCount])!=""){
						$tmpSubImages = $SitePath.'/uploads/'.$rePicArray[$imgCount]; ?>
                        <a class="listinghiddenimages" id="image_<?php echo $imgCount;?>" data-fancybox-group='listgallery' style="display:none;" href='<?php echo $tmpSubImages; ?>' ><img alt='listing image' src='<?php echo $tmpSubImages; ?>' style='width:100%;height:400px' /></a>
						
                        <?
					}
				}
			  
			  ?>
            
            
            </div>
		  <?php 
		  if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]<=1170) print "</tr><tr>"; ?>
		  <td style="vertical-align:top;" id="imagethump_r"><?php 
				$_SESSION["reid"]=$row['id'].":".$_SESSION["reid"];
				if($totalRePics>1) { ?>
			<div id='listingImages'>
			  <?php 
				$imgRowCount=0;
				for($imgCount=0;$imgCount<$totalRePics;$imgCount++){ 
					if(trim($rePicArray[$imgCount])!=""){
						$SubImages = $SitePath.'/uploads/'.$rePicArray[$imgCount];
						print "<span id='image_icon-$imgCount'><a href='#'><img src='timthumb.php?src=$SubImages&amp;w=200' alt='listing image' /></a></span>";	
					}
				}
				print "<div style='display:none;'>";
				for($imgCount=0;$imgCount<$totalRePics;$imgCount++){ 
					if(trim($rePicArray[$imgCount])!=""){ 
						$TempSubVar	= $SitePath.'/uploads/'.$rePicArray[$imgCount];
						print "<span id='bimage-$imgCount'>$TempSubVar</span>";
					
					}
				}
				print "</div>";
	?>
			</div>
			<?php }
	$allMarkedreid=explode(":",$_SESSION["marked_reid"]);
	$_SESSION['currency_before_price']=$currency_before_price;
	
	function printAttribute($attribute,$tag,$defaultCurrency=""){
	   include_once("functions.inc.php");   
	   if($attribute!=""){
		   if($_SESSION['currency_before_price']) $full_attribute=$defaultCurrency.__($attribute);
		   else  $full_attribute=__($attribute)." ".$defaultCurrency;
		   if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) $attrClause=" style='float:left;' ";
		 if($tag=="Size") print "<tr class='tr_attr_val'><td><b>".__($tag)." (".__("sq-ft")."):</b> <span class='attr_value'>".$full_attribute."</span></td></tr>";
		 else print "<tr class='tr_attr_val'><td><b>".__($tag).":</b> <span class='attr_value' $attrClause>".$full_attribute."</span></td></tr>";  
	   } 
	}
	?>
			<div id='listingButtons' <?php print $buttonsStyle; ?> >
			  <?php 
			  //if(!empty($_SESSION['authenticated']) && $_SESSION['authenticated']==1 && !empty($_SESSION['wp_login_user_id']) && $_SESSION['wp_login_user_id']!=0){
				  $TotFav	= 0;
				  if(!empty($row['id'])){
					  $CheckFavSql	= "SELECT COUNT(*) as Tot FROM favorites WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
					  															   property_id = '".$row['id']."' AND 
																				   page = 'Realestate'";
					  $CheckFavQue	= mysql_query($CheckFavSql);
					  $ResFav		= mysql_fetch_assoc($CheckFavQue);
					  $TotFav		= $ResFav['Tot'];
				  }

				  //if(in_array($row['id'],$allMarkedreid)){ 
				  if($TotFav > 0)
				  {
				  ?>
					<div id='reAlreadyMarkedListing'><span class='btn btn-danger' disabled="disabled" title='<?php print $relanguage_tags["This listing has been liked by you"];?>.'><?php print $relanguage_tags["Liked"]." ".$relanguage_tags["Listing"];?></span></div>
				  <?php 
				  }else{ 
				  ?>
					<div id='reMarkedListing'><span class='btn btn-danger' title='<?php print $relanguage_tags["Mark this listing to find it easily in future"];?>.'  onclick="infoResults('<?php print $row['id']; ?>',8,'reMarkedListing');"><?php print $relanguage_tags["Like Listing"];?></span></div>
				  <?php 
				  } 
			  //}
			  ?>
			  <a title='<?php print $relanguage_tags["Click above to send a message to the poster of this listing"]; ?>' href='contactPoster.php?reid=<?php print $row['id']; ?>' class='btn btn-default listingcontact'><?php print __("Contact");?></a>
			  <?php
			$ip=$_SERVER["REMOTE_ADDR"];
			$listing_id=$row['id'];
			$fqr="select * from flagging where ip='$ip' and listing_id='$listing_id'";
			$fresult=mysql_query($fqr); 
			if(mysql_num_rows($fresult) > 0){
				$reportButton=__("Reported");
				$reportClause=' disabled="disabled" ';
			}else{
				$reportButton=__("Report this");
				$reportClause="";
			}
			?>
			  <!--<div id='reFlaggedListing'><span onclick="infoResults('<?php print $row['id']; ?>',27,'reFlaggedListing');" class="btn btn-danger listingflag" title="" data-original-title="<?php print __("Flag this listing"); ?>" <?php print $reportClause; ?> ><?php print $reportButton; ?></span></div>-->
			</div></td>
		</tr>
		<?php
		if($reAllowedThings!=""){
			$thingsClass=" col-md-1 col-lg-1 ";
			$infoClass=" col-md-4 col-lg-4 ";
			$descClass=" col-md-7 col-lg-7 ";
		}else{
			$thingsClass="";
			$infoClass=" col-md-4 col-lg-4 ";
			$descClass=" col-md-8 col-lg-8 ";
		}
		?>
		<tr id='reDescriptionRow'>
		  <td colspan='2'><div id='listingAllowedThings' class='<?php print $thingsClass; ?>'><?php print $reAllowedThings; ?></div>
			<div class='listingItem head_titl_line'>
			  <h4><?php print $row['headline']; ?></h4>
			</div>
			<div class='listingItem desc_row'>
			  <?php if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]>=400) $infoBoxStyle=' style="float:right;" '; else $infoBoxStyle=' style="float:none; width:90%;" '; ?>
			  <?php
			  if($ptype=="viewFullListing"){ 
			  ?>
              	<b class="pad_2sid"><?php print $relanguage_tags["Description"];?>:</b><br />
                  <div style="width:90%; margin-bottom:5px" class="pad_2sid">
                    <?php print nl2br($row['description']); ?>
                    <br />
                  </div>
              <?php
			  }
			  ?>
              <div class='reAttributes alert alert-info <?php print $infoClass; ?>' <?php print $infoBoxStyle; ?> >
				<table id='listing_attributes'>
				  <tr>
					<td><h4 class="list_attr_title"><?php print $full_address; ?></h4></td>
				  </tr>
				  <?php
				//printAttribute($row['classification'],"Classification");
				printAttribute($row['retype'],"Type");
				printAttribute($row['subtype'],"Style");
				printAttribute(number_format($row['price']),"Price",$defaultCurrency);
				printAttribute($row['bedrooms'],"Bedroom");
				printAttribute($row['bathrooms'],"Bathroom");
				printAttribute($row['resize'],"Size");
				printAttribute($row['builtin'],"Built in");
				printAttribute($row['relistingby'],"Listing by");
				printAttribute($row['dttm_modified'],"Date Listed");
				?>
                <input type="hidden" value="<?php echo $row['price'];?>" id="priceforcalc" />
				<?php 
				if($ptype=="viewFullListing"){ 
				?>
                <tr class="pd_more"><td>&nbsp;</td></tr>
                <tr id="trMapwrap">
                	<td id="tdmap_wrap">
                		<iframe style="margin: 0px; outline: medium none; text-align: left; text-decoration: none; padding: 0px; font-size-adjust: none; font-stretch: normal; font-style: normal; font-variant: normal; letter-spacing: normal; word-spacing: normal; text-transform: none; vertical-align: baseline; text-indent: 0px; text-shadow: none; white-space: normal; background-image: none; background-color: transparent; border: 0px none;" marginheight="0" marginwidth="0" scrolling="no" src="http://www.walkscore.com/serve-walkscore-tile.php?wsid=b698f03ac6a12c7ccdef834f95313370&s=<?php echo $row['address'];?>&lat=<?php echo $row['latitude'];?>&lng=<?php echo $row['longitude'];?>&o=h&ts=t&c=f&map_provider=mapquest&mm=all&base_map=google_map&h=442&fh=18&w=600" width="600px" height="442px" frameborder="0"></iframe>
                	</td>
                </tr>
                <?php
				}
				?>
				</table>
			  </div>
              <?php
              if($ptype != "viewFullListing")
              {
              ?>
              <b><?php print $relanguage_tags["Description"];?>:</b><br />
			  <div class='reListingDescription <?php print $descClass; ?>'>
			  	<?php print nl2br($row['description']); ?>
                <br />
                <?php
                $headline_slug=friendlyUrl($row['headline']);    
				if(trim($row['subtype'])==""){
					$row['subtype'] = "none";
				}
				$newTabLink=friendlyUrl($row['retype'],"_")."/".friendlyUrl($row['subtype'],"_")."/"."id-".$row['id']."-".$region."-".$headline_slug;
                ?>
                <br />
                <div style="float:left">
                <a class="btn btn-sm btn-primary" target="_blank" style="margin-top:5px; margin-right:5px; background:rgba(0, 0, 0, 0) linear-gradient(#1452b0, #011027) repeat scroll 0 0" href="<?php echo $newTabLink;?>">
                	<span id="<?php echo $row['id'];?>">More Info</span>
                </a>
                <a class="btn btn-sm btn-success listingcontact" style="margin-top:5px; margin-right:5px;" href="contactPoster.php?reid=<?php echo $row['id'];?>">
                	<span id="<?php echo $row['id'];?>">Contact Agent</span>
                </a>
                </div>
                <div style="float: left; clear: both; margin-top: 10px;"><div class="addthis_inline_share_toolbox"></div></div>
              </div>
              <?php
			  }
			  ?>
              
              
              
              
              <?php
              $TotComp	= 0;
			  if(!empty($row['id'])){
				  $CheckCompSql	= "SELECT COUNT(*) as Tot FROM compare_properties WHERE (user_id = '".$_SESSION['wp_login_user_id']."' OR ip = '".$_SERVER["REMOTE_ADDR"]."') AND 
																			   			 property_id = '".$row['id']."' AND 
																			   			 page = 'Realestate'";
				  $CheckCompQue	= mysql_query($CheckCompSql);
				  $ResComp		= mysql_fetch_assoc($CheckCompQue);
				  $TotComp		= $ResComp['Tot'];
			  }

			  //if(in_array($row['id'],$allMarkedreid)){ 
			  if($TotComp > 0)
			  {
			  ?>
              	<img id="compareimg" src="images/red.png" style="cursor:pointer" onClick="javascript:compareproperty(<?php echo $row['id'];?>, '', '');">
              <?php
			  }
			  else
			  {
			  ?>
              	<img id="compareimg" src="images/blue.png" style="cursor:pointer" onClick="javascript:compareproperty(<?php echo $row['id'];?>, '', '');">
              <?php
			  }
			  ?>
              
              
              
              
			</div>
			<?php if($row['user_id']=="oodle") print "<br /><br /><b>".__("More Information").":</b> <a href='".$row['url']."' target='_blank'>".__("Here")."</a>"; ?>
			<?php 
			if($ptype=="viewFullListing"){ 
			?>
                <div class='listingItem pd_30' style="clear:both;"><i class="fa fa-location-arrow" aria-hidden="true" style="display:none;"></i><b class="titl_upcase"><?php print $relanguage_tags["Location on map"];?>:</b></div>
                <div id='reListingOnMap'></div>
			<?php 
			} 
			?>
           	<div id="hd_field">
           		
           	
            <!--<div id="retail_sales" style="min-width: 310px; margin-top:20px"></div>-->
            <div id="population_age_group" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="population_growth" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="education" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="marital_status" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="languages_chart" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="household_income" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="children_home" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="ownership" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="construction_date" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            <div id="occupations" style="min-width: 310px; height: 400px; margin-top:20px"></div>
            </div>
            <script>
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
				/*		pointFormat: '<span style="color:{point.color}">{series.name}</span>: <b>{point.y}</b><br/>'
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			$(function () {
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
			</script>
            <?php
			if($row['contact_name']!="" || $row['contact_phone']!="" || $row['contact_email']!="" || $row['contact_website']!="" || $row['contact_address']!=""){ 
			?>
			<div class='reContactInformation alert alert-danger pad_2sid ' style="clear:both;"> <i class='fa fa-address-card' aria-hidden='true' style="display:none"></i><b class="titl_upcase"><?php print $relanguage_tags["Contact Information"];?></b><?php print $contact_image; ?>
			  <div class='recontact_info'><br />
				<?php 
				if($row['contact_name']!=""){ ?>
				<b><?php print $relanguage_tags["Email"];?>:</b> <?php print $row['contact_email']."<br />"; } ?>
				<?php if($row['contact_phone']!=""){ print "<b>".$relanguage_tags["Phone"]." :</b> ".$row['contact_phone']."<br />"; } ?>
				<?php //if($readmin_settings['listingemail']=="yes"){ print"<b>".$relanguage_tags["Email"].":</b> ".$row['contact_email']."<br />"; } ?>
				<?php if($row['contact_website']!=""){ print "<b>".$relanguage_tags["Website"].":</b> <a href='".$row['contact_website']."' target='_blank'>".$row['contact_website']."</a><br />"; } ?>
				<?php if($row['contact_address']!=""){ print "<b>".$relanguage_tags["Address"]." :</b>".nl2br($row['contact_address']); } ?>
			  </div>
			</div>
			<?php 
			} 
			?>
			<br />
			<div class='listingButtons'>
			  <?php 
			if(isset($_SESSION["memtype"]) && trim($ppemail)!="" && $featuredduration>0 && $featuredprice>0 && $row['listing_type']!=2) featuredButton($row['user_id'],$mem_id,$row['id']); 
			showMemberNavigation($row['user_id'],$mem_id,$row['id'],2); 
			if(isset($_SESSION["memtype"]) && isset($_SESSION["memtype"]) && trim($ppemail)!="" && $featuredduration>0 && $featuredprice>0  && $row['listing_type']!=2){
			?>
			  <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			  </form>
			  <?php 
			  } ?>
			</div></td>
		</tr>
	  </table>
	 
	</div>
	<br />
	<?php 
	if($showMoreListings!="no"){ 
	?>
        <h3 class='reHeading1 pd_30'><i class="fa fa-building visib_xs" aria-hidden="true" style="display:none"></i><?php print $relanguage_tags["Similar listings based on your search criteria"];?></h3>
        <div id='reResults2'></div>
	<?php 
	} 
	return ob_get_clean();
}
?>

<script type="text/javascript">
   $(document).ajaxStop(function() {
	  if (window.addthis) {
		window.addthis = null;
		window._adr = null;
		window._atc = null;
		window._atd = null;
		window._ate = null;
		window._atr = null;
		window._atw = null;
	  }
	  return $.getScript("http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58351a9bbda6054f");
	});
</script>
