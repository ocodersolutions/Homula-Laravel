

<div id="agent_block_wrapper">
  <div class="agent_block inquire_now_div" id="inquire_now_div">
    <div class="a_block">
      <h3 class="listings_tit"> Enquire Now </h3>
      <script type="text/javascript">
	/*$(function(){
	var h = $(window).height();
	var w = $(window).width();
		
	$('#visitor_submit').click(function(){
	var visitor_name=$.trim($('input#visitor_name').val());	
	var visitor_email=$.trim($('input#visitor_email').val());
	var visitor_message=$.trim($('#visitor_message').val());
	var errorMessage="<?php print $relanguage_tags["Please specify"];?>: ";
	$prevLen=errorMessage.length;
	if(visitor_name.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Name"];?>";
	if(visitor_email.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Email"];?>";
	if(visitor_message.length<=0) errorMessage=errorMessage+"\n<?php print $relanguage_tags["Message"];?>";
	if(errorMessage.length>$prevLen){
		alert(errorMessage);
		return false;
	}else{
		return true;
	   }
	});
		
	});*/
	</script>
      <form  name='contactForm' method="post" action="sendMessage.php" class="ng-pristine ng-valid">
        <input name="receive_admin" value="1" type="hidden">
        <div class="form-group">
          <input class="form-control" id="visitor_name" name="visitor_name" placeholder="Name" required type="text">
        </div>
        <div class="form-group">
          <input class="form-control" id="visitor_email" name="visitor_email" placeholder="E-mail" required type="email">
        </div>
        <div class="form-group">
          <textarea class="form-control" id="visitor_message" name="visitor_message" required placeholder="Message" rows="4" style="overflow: hidden; overflow-wrap: break-word; height: 200px;"></textarea>
        </div>
        <div class="button-wrapper">
          <button type="submit" class="btn" name="enquire_form" id='visitor_submit'>Send Message</button>
        </div>
      </form>
    </div>
  </div>
  <?php
$agent_sql = "SELECT * 
			  FROM contact_agents 
			  WHERE agent_img <> '' 
			  ORDER BY RAND()  limit 0,6";
$agent_result=mysql_query($agent_sql);
if(mysql_num_rows($agent_result)){	?>
  <div class="agent_block our_agents_div" id="our_agents_div" style="margin-bottom:10px;">
    <div class="a_block">
      <h3 class="listings_tit"> Our Agents </h3>
      <?php while($agent_result_data = mysql_fetch_assoc($agent_result)){ 
            $agent_url = 'http://realestate.homula.com/agents/'.trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower($agent_result_data['agent_name'])), '-');
            $agentPic	= $SitePath.'/agentimages/'.$agent_result_data['agent_img']; 
			?>
      
      <div class="agent-small">
        <div class="agent-small-inner">
          <div class="agent-small-image"> <a href="<?php echo $agent_url;?>" class="agent-small-image-inner"> <img src="<?php echo $agentPic;?>"  alt="<?php echo $agent_result_data['agent_name'];?>" width="192" height="240"> </a> </div>
          <div class="agent-small-content">
            <h4 class="agent-small-title"> <a href="<?php echo $agent_url;?>"><?php echo $agent_result_data['agent_name'];?></a> </h4>
          </div>
          
          <div class="agent-info">
			  <div class="agent-small-email"> <i class="fa fa-envelope"></i> <a href="mailto:<?php echo $agent_result_data['email'];?>"><?php echo $agent_result_data['email'];?></a> </div>
	          <!--<div class="agent-small-phone"> <i class="fa fa-phone"></i> <?php echo $agent_result_data['phone'];?> </div>-->
          </div>
          
        </div>
      </div>
      
      
      <?php }
	   ?>
    </div>
  </div>
  <?php }?>
</div>
<?php 
    	$simiqr1 = "SELECT * 
					FROM $reListingTable WHERE where_from =  'IDX' 
					ORDER BY RAND()  limit 0,5";
		$result1=mysql_query($simiqr1);
		
		
	?>
    <div id="sticky-anchor"></div>
<div id="featured_img_div" class="agent_block featured_img_div"  style="margin-bottom:10px;">
  <div class="a_block">
    <h3 class="listings_tit"> Featured Properties </h3>
    <div class="type-small">
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
		?>
    <div class="property-small">
      <div class="property-small-image "> <a href="<?php echo $relistingLink;?>"> <img src="<?php echo $firstPic;?>" class="" alt="<?php echo $similine['address']; ?>" width="200" height="200"> </a> </div>
      <div class="property-small-content">
        <h3 class="property-small-title"> <a href="<?php echo $relistingLink;?>"><?php echo $similine['address'].", ".$similine['city'].", ".$similine['postal'].", ".$similine['state']; ?></a> </h3>
        <div class="property-small-type"> <?php echo $similine['retype'];?> </div>
      </div>
    </div>
    <?php }
	  
	  ?>
      </div>
  </div>
</div>
<style>
#featured_img_div.stick {
    margin-top: 0 !important;
    position: fixed;
    top: 0 !important;
    z-index: 10000;
    border-radius: 0 0 0.5em 0.5em;
	width:23% !important;
}
</style>
<script>

jQuery(function(){ // document ready
   if (jQuery('#sticky-anchor').length) { // make sure "#sticky" element exists
      var el = jQuery('#sticky-anchor');
      var stickyTop = jQuery('#sticky-anchor').offset().top; // returns number
      var stickyHeight = jQuery('#sticky-anchor').height();

      jQuery(window).scroll(function(){ // scroll event
	 
	      var limit = jQuery('#body_footer').offset().top - stickyHeight - 650;
			
			
          var windowTop = jQuery(window).scrollTop(); // returns number

          if (stickyTop < windowTop){
			  //alert(1)
            // el.css({ position: 'fixed', top: 0 });
			 jQuery('#featured_img_div').addClass('stick');
			 jQuery('#sticky-anchor').height(jQuery('#featured_img_div').outerHeight());
          }
          else {
			  //alert(2)
            // el.css('position','static');
			  jQuery('#featured_img_div').removeClass('stick');
			  jQuery('#sticky-anchor').height(0);
          }
			
          if (limit < windowTop) {
			 // alert("here");
			  var diff = limit - windowTop;
			  el.css({top: diff});
			  jQuery('#featured_img_div').css({top: diff});
			  jQuery('#featured_img_div').removeClass('stick');
			  jQuery('#sticky-anchor').height(0);
          }
        });
   }
});

/*
function sticky_relocate() {
	
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor').offset().top;
    if (window_top > div_top) {
		//alert(1);
        jQuery('#agent_block_wrapper').addClass('stick');
		jQuery('#sticky-anchor').height(jQuery('#agent_block_wrapper').outerHeight());
		
		
    } else {
		//alert(2);
        jQuery('#agent_block_wrapper').removeClass('stick');
		jQuery('#sticky-anchor').height(0);
    }
	
	
	
	
}

jQuery(function() {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});
*/
</script>