<?php 
include("header.php");
$_GET['ptype'] = 'compare';
?>
<?php //include("js/v3map.php"); ?>
<script src="js/v3map.js" type="text/javascript" ></script>

<div class='container'>
  <div class='row'>
    <div class='col-md-8 col-lg-8'>
      <div id="mainContent">
        <link href="http://realestate.homula.com/wp-content/themes/realsite/sl/css/slider.css" rel="stylesheet">
        <script src="http://realestate.homula.com/wp-content/themes/realsite/sl/js/jquery-1.11.3.min.js" type="text/javascript" data-library="jquery" data-version="1.11.3"></script> 
        <script src="http://realestate.homula.com/wp-content/themes/realsite/sl/js/jssor.slider-22.0.15.mini.js" type="text/javascript" data-library="jssor.slider.mini" data-version="22.0.15"></script>
        <?php
		$cmp_sql= "SELECT compare_properties.id as cid, $reListingTable.* 
				   FROM $reListingTable
				   LEFT JOIN compare_properties ON $reListingTable.id = compare_properties.property_id
				   WHERE (compare_properties.user_id = '".$_SESSION['wp_login_user_id']."' OR compare_properties.ip = '".$_SERVER["REMOTE_ADDR"]."') AND compare_properties.page = 'Realestate' LIMIT 0,2";
			
		//echo $cmp_sql;exit;
		$cmp_result = mysql_query($cmp_sql);
		
		?>
        <?php
		  if(mysql_num_rows($cmp_result) == 2)
		  {
		  ?>
        <div class="row" style="text-align: center;">
          <button onClick="javascript:delcompareproperty('0', 'all')">Remove all Properties</button>
        </div>
        <div class="row">
          <?php
			
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
			
            	
				$m=1;
				while($cmp_row = mysql_fetch_assoc($cmp_result)){ 
				
				
				 if($cmp_row['bedrooms']=="1den") $cmp_row['bedrooms']="1 + ".$relanguage_tags["den"];
				  if($cmp_row['bedrooms']=="2den") $cmp_row['bedrooms']="2 + ".$relanguage_tags["den"];
				  
				  if($cmp_row['relistingby']=="owner") $cmp_row['relistingby']=$relanguage_tags["Individual"];
				  if($cmp_row['relistingby']=="reagent") $cmp_row['relistingby']=$relanguage_tags["Real Estate Agent"];
				  if($cmp_row['price']==0)$cmp_row['price']="";
				  if($cmp_row['resize']==0)$cmp_row['resize']="";
				  list($justDate,$justTime)=explode(" ",$row['dttm_modified']);
				  $newDateFormat=explode("-",$justDate);
				  $cmp_row['dttm_modified']=$newDateFormat[1]."/".$newDateFormat[2]."/".$newDateFormat[0];
				  
				  $full_address="";
				  if($cmp_row['apt']!="") $full_address=$cmp_row['apt'];
				  if($cmp_row['address']!="") $full_address=$full_address.", ".$cmp_row['address'];
				  if($cmp_row['city']!="") $full_address=$full_address.", ".$cmp_row['city'];
				  if($cmp_row['state']!="") $full_address=$full_address.", ".$cmp_row['state'];
				  if($cmp_row['postal']!="") $full_address=$full_address.", ".$cmp_row['postal'];
				  if($cmp_row['country']!="") $full_address=$full_address.", ".$cmp_row['country'];
				  $full_address=trim($full_address,',');
				  $partialAddress=$cmp_row['city'].", ".$cmp_row['postal'];
				  $partialAddress=trim(trim($partialAddress),',');
				  
				   require_once('geoplugin.class.php');
					$geoplugin = new geoPlugin();
					$geoplugin->locate();
					$vCountry=$geoplugin->countryName;
					$defaultCurrency=getOodleCurrency($vCountry,$defaultCurrency);
				  
				  if($cmp_row['price']!="" && $currency_before_price) 
				  {
					//$full_price=$defaultCurrency.number_format($row['price'])." - "; 
					$full_price="$".number_format($cmp_row['price']); 
				  }
				  else 
				  {
					$full_price="";
				  }
				$rePicArray=explode("::",$cmp_row['pictures']);
   				$totalRePics=sizeof($rePicArray);
				?>
          <div class="col-md-6"> 
            <script type="text/javascript">
				jQuery(document).ready(function ($) {
				    var jssor_<?php echo $cmp_row['id'];?>_options = {
				      $AutoPlay: false,
				      $ArrowNavigatorOptions: {
				        $Class: $JssorArrowNavigator$
				      },
				      $ThumbnailNavigatorOptions: {
				        $Class: $JssorThumbnailNavigator$,
				        $Cols: 3,
				        $SpacingX: 3,
				        $SpacingY: 3,
				        $Align: 260
				      }
				    };

				   var jssor_<?php echo $cmp_row['id'];?>_slider = new $JssorSlider$("jssor_<?php echo $cmp_row['id'];?>", jssor_<?php echo $cmp_row['id'];?>_options);

				         function ScaleSlider<?php echo $cmp_row['id'];?>() {
					        var refSize = jssor_<?php echo $cmp_row['id'];?>_slider.$Elmt.parentNode.clientWidth;
					        if (refSize) {
					            refSize = Math.min(refSize, 600);
					            jssor_<?php echo $cmp_row['id'];?>_slider.$ScaleWidth(refSize);
					        }
					        else {
					            window.setTimeout(ScaleSlider<?php echo $cmp_row['id'];?>, 130);
					        }
					    }
					    ScaleSlider<?php echo $cmp_row['id'];?>();
					    $(window).bind("load", ScaleSlider<?php echo $cmp_row['id'];?>);
					    $(window).bind("resize", ScaleSlider<?php echo $cmp_row['id'];?>);
					    $(window).bind("orientationchange", ScaleSlider<?php echo $cmp_row['id'];?>);

				});
			</script>
            <div class="top-compare">
              <h2 class="title-property"><?php echo $cmp_row['address'];?>, <?php echo $cmp_row['city'];?>, <?php echo $cmp_row['postal'];?>, <?php echo $cmp_row['state'];?></h2>
              <p><span class="share">Share this: <a href="https://www.facebook.com/share.php?u=<?php echo $current_page_url; ?>&amp;title=<?php echo str_replace(' ', '%20', $cmp_row['address'] ); ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="https://twitter.com/home?status=<?php echo str_replace( ' ', '%20', $cmp_row['address'] ); ?>+<?php echo $current_page_url; ?>#sthash.BUkY1jCE.dpuf"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="https://plus.google.com/share?url=<?php echo $current_page_url; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </span></p>
              <button onClick="javascript:delcompareproperty('<?php echo $cmp_row['cid']?>', 'single')">Remove this property</button>
              <hr>
            </div>
            <div class="slider">
              <div id="jssor_<?php echo $cmp_row['id']?>" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 300px; overflow: visible;">
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                  <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                  <div style="position:absolute;display:block;background:url('sl/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 335px; overflow: hidden;">
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
                  <div data-p="112.50"> <img data-u='image' src="<?php echo $tmpSubImages; ?>" class="attachment-full size-full" alt="<?php echo $tmpSubImages; ?>" /><br>
                    <img data-u='thumb' src="<?php echo $tmpSubImages; ?>" class="attachment-full size-full" alt="<?php echo $tmpSubImages; ?>" /> </div>
                  <?
					  }
					}
					?>
                </div>
                <div data-u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:-175px;width:600px;height:135px;" data-autocenter="1">
                  <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; filter:alpha(opacity=30.0); opacity:0.3;"></div>
                  <div data-u="slides" style="cursor: default;height: 142px!important;">
                    <div data-u="prototype" class="p">
                      <div class="w">
                        <div data-u="thumbnailtemplate" class="t"></div>
                      </div>
                      <div class="c"></div>
                    </div>
                  </div>
                </div>
                <span data-u="arrowleft" class="jssora02l" style="top:355px;left:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-left" aria-hidden="true"></i></span> <span data-u="arrowright" class="jssora02r" style="top:355px;right:0;width:55px;height:55px;" data-autocenter="2"><i class="fa fa-angle-right" aria-hidden="true"></i></span> </div>
            </div>
            <div class="shadow">
              <div class="box-info">
                <div class="title-box">
                  <h4><i class="fa fa-check-square" aria-hidden="true"></i> Property Overview</h4>
                  <hr>
                  <div class="wrap-box">
                    <div class="thumb"> <img class="cmp-img-responsive" src="<?php echo $firstDef;?>" width="175" height="110"> </div>
                    <div class="info">
                      <ul>
                        <li><i class="fa fa-usd" aria-hidden="true"></i><span> Price: </span><?php echo $full_price;?></li>
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i><span> Location: </span> 
						<?php 
							if($cmp_row['address'] != '')
							{
								echo $cmp_row['address'].", ";
							}
							if($cmp_row['city'] != '')
							{
								echo $cmp_row['city'].", "; 
							}
							if($cmp_row['state'] != '')
							{
								echo $cmp_row['state'].", "; 
							}
							if($cmp_row['postal'] != '')
							{
								echo $cmp_row['postal'];
							}
							?>
                        </li>
                        <li><i class="fa fa-bed" aria-hidden="true"></i><span> Bedrooms: </span> <?php echo $cmp_row['bedrooms'];?></li>
                        <li><i class="fa fa-bath" aria-hidden="true"></i><span> Total Baths: </span><?php echo $cmp_row['bathrooms'];?></li>
                        <!--<li><span>Extra: </span>< ?php echo $cmp_row['description'];?></li>-->
                      </ul>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="shadow">
              <div class="box-info">
                <div class="title-box">
                  <h4><i class="fa fa-check-square" aria-hidden="true"></i> Description</h4>
                  <hr>
                  <div class="wrap-box">
                    <p><?php echo $cmp_row['description'];?></p>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="shadow">
              <div class="box-info features">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#left1<?php echo $cmp_row['id'];?>">Basic features</a></li>
                  <li><a data-toggle="tab" href="#left2<?php echo $cmp_row['id'];?>">Advanced features</a></li>
                  <!-- <li><a data-toggle="tab" href="#left3<?php echo $cmp_row['id'];?>">Amenities</a></li>-->
                </ul>
                <hr>
                <div class="tab-content">
                  <div id="left1<?php echo $cmp_row['id'];?>" class="tab-pane fade in active">
                    <div class="fieldsLeft">
                      <div class="fieldState"><strong>Province:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['state'];?></span></div>
                      <div class="fieldAddress">
                      	<strong>Address:</strong> 
                        <span class="IDX-fieldData">
							<?php 
							if($cmp_row['address'] != '')
							{
								echo $cmp_row['address'].", ";
							}
							if($cmp_row['city'] != '')
							{
								echo $cmp_row['city'].", "; 
							}
							if($cmp_row['state'] != '')
							{
								echo $cmp_row['state'].", "; 
							}
							if($cmp_row['postal'] != '')
							{
								echo $cmp_row['postal'];
							}
							?>
                        </span>
                        </div>
                      <div class="fieldArea"><strong>Area:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['state'];?></span></div>
                      <div class="fieldBedrooms"><strong>Bedrooms:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['state'];?></span></div>
                    </div>
                    <div class="fieldsRight">
                      <div class="fieldMunicipality District"><strong>Municipality District:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['city'];?></span></div>
                      <div class="fieldRent/Lease Off Season"><strong>Rent/Lease Off Season:</strong> <span class="IDX-fieldData"><?php echo $full_price;?></span></div>
                      <div class="fieldRent/Lease Price"><strong>Rent/Lease Price:</strong> <span class="IDX-fieldData"><?php echo $full_price;?></span></div>
                      <div class="fieldTotal Baths"><strong>Total Baths:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['bathrooms'];?></span></div>
                      <div class="fieldType"><strong>Type:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['subtype'];?></span></div>
                      <div class="fieldZoning"><strong>Zoning:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['retype'];?></span></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div id="left2<?php echo $cmp_row['id'];?>" class="tab-pane fade">
                    <div class="fieldsLeft">
                      <div class="fieldZoning"><strong>Relisting By :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['relistingby'];?></span></div>
                      <div class="fieldZoning"><strong>Built IN :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['builtin'];?></span></div>
                      <div class="fieldZoning"><strong>Resize :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['resize'];?></span></div>
                      <div class="fieldZoning"><strong>Apt :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['apt'];?></span></div>
                      <div class="fieldZoning"><strong>Postal :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['postal'];?></span></div>
                    </div>
                    <div class="fieldsRight">
                      <div class="fieldZoning"><strong>Sale/Lease:</strong> <span class="IDX-fieldData"><?php echo $cmp_row['classification'];?></span></div>
                      <div class="fieldZoning"><strong>Contact Phone :</strong> <span class="IDX-fieldData"> <?php echo $cmp_row['contact_phone'];?></span></div>
                      <div class="fieldZoning"><strong>Contact Email :</strong> <span class="IDX-fieldData"> <a style="text-decoration:none;" href="mailto:<?php echo $cmp_row['contact_email'];?>"><?php echo $cmp_row['contact_email'];?></a></span></div>
                      <div class="fieldZoning"><strong>Contact Website :</strong> <span class="IDX-fieldData"> <a style="text-decoration:none;" href="<?php echo $cmp_row['contact_website'];?>" target="_blank"><?php echo $cmp_row['contact_website'];?></a></span></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!--<div id="left3<?php echo $cmp_row['id'];?>" class="tab-pane fade">
                    <ul>
                      <li class="no">Air conditioning</li>
                      <li class="no">Cable TV</li>
                      <li class="no">CAC Included</li>
                      <li class="no">Dishwasher</li>
                      <li class="no">Heating</li>
                      <li class="no">Internet</li>
                      <li class="no">Lift</li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>--> 
                </div>
              </div>
            </div>
            <div class="box-info score">
              <div class="title-box">
                <div class="title-special"><i class="fa fa-heart" aria-hidden="true"></i> Walk score : <span> 1 Out of 100 </span> <i class="fa fa-question-circle" aria-hidden="true"></i></div>
                <hr>
                <div class="tab-content">
                  <div class="wrap-list">
                    <div class="border-score">
                      <iframe style="margin: 0px; outline: medium none; text-align: left; text-decoration: none; padding: 0px; font-size-adjust: none; font-stretch: normal; font-style: normal; font-variant: normal; letter-spacing: normal; word-spacing: normal; text-transform: none; vertical-align: baseline; text-indent: 0px; text-shadow: none; white-space: normal; background-image: none; background-color: transparent; border: 0px none;" marginheight="0" marginwidth="0" scrolling="no" src="http://www.walkscore.com/serve-walkscore-tile.php?wsid=b698f03ac6a12c7ccdef834f95313370&s=<?php echo $cmp_row['address'].", ".$cmp_row['city'].", ".$cmp_row['postal'].", ".$cmp_row['state'];?>&lat=<?php echo $cmp_row['latitude'];?>&lng=<?php echo $cmp_row['longitude'];?>8&o=h&ts=t&c=f&map_provider=mapquest&mm=all&base_map=google_map&h=442&fh=18&w=500" width="100%" height="442px" frameborder="0"></iframe>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <!--<div class="box-info">
              <div class="title-box">
                <h4><i class="fa fa-check-square" aria-hidden="true"></i> Similar Properties</h4>
                <hr>
              </div>
              
              <div class="related left">
                <div class="shadow">
                  <div class="wrap-related"> <a href="http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/">
                    <div class="title-related">Five things to expect from Canadian real estate in 2017</div>
                    </a>
                    <div class="price-related">1800.00</div>
                  </div>
                </div>
              </div>
              
              <div class="related right">
                <div class="shadow">
                  <div class="wrap-related"> <a href="http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/">
                    <div class="title-related">4 Illegal Tactics You Need to Beware of in Toronto Real Estate</div>
                    </a>
                    <div class="price-related">1800.00</div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>-->
            <div class="shadow">
              <div class="box-info">
                <div class="title-box">
                  <h4><i class="fa fa-check-square" aria-hidden="true"></i> Position</h4>
                  <hr>
                  <div class="wrap-box">
                    <div style="height:100%;width:100%;" id="reListingOnMap<?php echo $m;?>"> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
			 var listingmap<?php echo $m;?>= $('#reListingOnMap<?php echo $m;?>');
			  function listingMapInit<?php echo $m;?>() {
					var myLatlng<?php echo $m;?> = new google.maps.LatLng('<?php echo $cmp_row['latitude'];?>','<?php echo $cmp_row['longitude'];?>');
					var mapOptions<?php echo $m;?> = {
					  zoom: 15,
					  center: myLatlng<?php echo $m;?>,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					var map<?php echo $m;?> = new google.maps.Map(document.getElementById('reListingOnMap<?php echo $m;?>'), mapOptions<?php echo $m;?>);
			
					var marker = new google.maps.Marker({
						position: myLatlng<?php echo $m;?>,
						map: map<?php echo $m;?>            
					});
				  }
				  
			google.maps.event.addDomListener(window, 'load', listingMapInit<?php echo $m;?>);

		
		
		</script>
          <?php
			$m++;		
				} 
					
			?>
          <?php
            	if(mysql_num_rows($cmp_result)==1){ ?>
          <div class="col-md-6">
            <div class="com_btn_cls" style="margin-top:65px; display:flex;" >
              <div class="row" style="text-align: center;"> <a href="<?php echo $SitePath;?>">
                <button style="background-color:#0A368A !important;">Choose a Property to Compare</button>
                </a> </div>
            </div>
          </div>
          <?php	}
			?>
        </div>
        <?php
		  }
		  else
		  {
		  ?>
          
          <!--
        <div class="row" style="text-align: center;"> <a href="<?php echo $SitePath;?>">
          <button style="background-color:#0A368A !important;">Choose a Property to Compare</button> 
          </a> </div>-->
          <script>
		  	alert("2 properties are needed to access this page.");
			window.location.href = '<?php echo $RedirectMainPath;?>';
		  </script>
        <?php
		  }
		  ?>
      </div>
      <!-- end #mainContent --> 
    </div>
  </div>
</div>
<link href="css/hcomparecss.css" rel="stylesheet">
<link href="css/hstylenew.css" rel="stylesheet">
<style>
.wrap-box{
	height:auto !important;
	min-height:200px !important;	
}
</style>
<?php 
include("footer.php"); 
?>