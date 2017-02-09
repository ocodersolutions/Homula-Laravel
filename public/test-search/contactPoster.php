<?php 
error_reporting(0);
include("config.php");
$con	= mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
include_once("functions.inc.php");
require_once('recaptcha/recaptchalib.php');
$reid=trim($_GET["reid"]);
$agent_sql	= "SELECT * FROM contact_agents WHERE agent_img != '' ORDER BY RAND()  LIMIT 0,1";
$agent_que	= mysql_query($agent_sql);
$AgentArr	= array();
if(mysql_num_rows($agent_que)){	
	while($FetchArray	= mysql_fetch_assoc($agent_que))
	{
		$AgentArr	= $FetchArray; 	
	}
}
//echo "<pre>";print_r($AgentArr);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
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
	
});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/bootstrap.css" />
<?php
if($_SESSION["rtl"]){ ?>
<link href="css/rtl_style.php?ptype=<?php print $ptype; ?>&amp;fullscreen=<?php print $_GET["fullscreen"]; ?>&amp;fs=<?php print $fullScreenEnabled; ?>"
rel="stylesheet" type="text/css" />
<style>
body {
	direction: rtl;
}
</style>
<?php } ?>
 <style>
  .cutsheet-pipeliner-wrap{
	overflow: hidden;
	position: relative; 
	margin-top:25px; 
  }
  .cutsheet-pipeliner .cutsheet-pipeliner-name {
    font-size: 1.6rem;
	}
	.cutsheet-pipeliner-name {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		font-size: 2rem;
		font-weight: 600;
		text-transform: uppercase;
	}
	
	.cutsheet-pipeliner .cutsheet-pipeliner-name {
		font-size: 1.6rem;
	}
	.cutsheet-pipeliner-name {
		font-size: 2rem;
		font-weight: 600;
		text-transform: uppercase;
	}
	.cutsheet-pipeliner {
		text-align: center;
	}
	.cutsheet-pipeliner {
		color: #fff;
	}
	.cutsheet-pipeliner-name small {
		text-transform: none;
		font-weight: 400;
		font-size: 1.4rem;
		display: block;
	}

.cutsheet-pipeliner {
    background: #3074bf;
    padding: 5px;
    color: #fff;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
  </style>
</head>
<body style="background-color:#2F74C1;">
<div class='container'>
  <div class='row'> 
  <h3 align='center' style="color:#fff"><?php print __("Contact Poster")." ".__("of")." ".__("listing");?> # <?php print $reid; ?></h3>
  <br />
    <!--<div class='col-md-1 col-lg-1'></div>-->
    <div class="">
    
    <div class='col-md-3 col-lg-3' style="float:left; width:40%; border-right:2px solid #fff; padding-bottom:25px;">
      <div>
        
        <div class="cutsheet-section-pipeliner cutsheet-pipeliner-wrap ">
          <div class="cutsheet-pipeliner" style="border-radius:100%; background:#fff;">
          <?php
          	$agentPic	= $SitePath.'/agentimages/'.$AgentArr['agent_img']; 
		  ?>
            <div class="cutsheet-pipeliner-name">
            	<img style="width:185px;margin:auto; height:185px; border-radius:100%" src="<?php echo $agentPic;?>">
            </div>
            
          </div>
            
            <div class="" style="text-align:center; margin-top:10px;">
            	<a href=""><img src="http://realestate.homula.com/wp-content/themes/realsite/images/ftwit-w.png"></a>
            	<a href=""><img src="http://realestate.homula.com/wp-content/themes/realsite/images/ffb-w.png"></a>
            	<a href=""><img style="" src="http://realestate.homula.com/wp-content/themes/realsite/images/fgoogle-w.png"></a>
            </div>
          <!-- .cutsheet-pipeliner -->
        </div>
        
      </div>
    </div>
    
    <div class='col-md-6 col-lg-6' style="float:left; width:60%; color:#fff">
      
      
            <div class="cutsheet-pipeliner-name" style="word-break:break-all;">
              <div class="pl-name"> <?php echo $AgentArr['agent_name'];?><small><?php echo $AgentArr['email'];?></small> </div>
            </div>
      <form name='contactForm' method='post' action='sendMessage.php' class="form-horizontal">
        <div class="form-group">
          <label style="font-weight:100" class="col-md-2 col-lg-2  <?php if($_SESSION['rtl']!=true) print " control-label "; ?> " for="visitor_name"><span class='required_field' <?php if($_SESSION['rtl']==true) print " style='float:left;' "; ?> ><sup>*<sup></span><?php print __("Name");?>:</label>
          <div class="col-md-10 col-lg-10" style="position:inherit;">
            <input type='text' class='form-control' id='visitor_name' name='visitor_name'>
          </div>
        </div>
        <div class="form-group">
          <label style="font-weight:100" class="col-md-2 col-lg-2  <?php if($_SESSION['rtl']!=true) print " control-label "; ?> " for="visitor_name"><span class='required_field' <?php if($_SESSION['rtl']==true) print " style='float:left;' "; ?> ><sup>*<sup></span><?php print __("Email");?>:</label>
          <div class="col-md-10 col-lg-10" style="position:inherit;">
            <input type='text' class='form-control' id='visitor_email' name='visitor_email'>
          </div>
        </div>
        <div class="form-group">
          <label style="font-weight:100" class="col-md-2 col-lg-2  <?php if($_SESSION['rtl']!=true) print " control-label "; ?> " for="visitor_name"><span class='required_field' <?php if($_SESSION['rtl']==true) print " style='float:left;' "; ?> ><sup>*<sup></span><?php print __("Message");?>:</label>
          <div class="col-md-10 col-lg-10" style="position:inherit;">
            <textarea name='visitor_message' id='visitor_message' class='form-control' rows='5'></textarea>
          </div>
        </div>
        <?php if(trim($reCaptchaPrivateKey)!="" && trim($reCaptchaPublicKey)!=""){ ?>
        <div class="form-group" style="float:right;">
          <div class="controls"> <?php echo recaptcha_get_html($reCaptchaPublicKey); ?> </div>
        </div>
        <?php } ?>
        <div class="form-group" style="text-align:center;">
          <div class="controls">
            <input type='hidden' name='reid' value='<?php print $reid; ?>' />
            <input type='submit' class='btn btn-default' value='<?php print __("Submit");?>' id='visitor_submit' />
          </div>
        </div>
      </form>
    </div>
    
    
    
  </div>
  
  </div>
 <div id="fancybox-title" class="fancybox-title-float" style="text-align:center; color:white; padding-top:20%">Click above to send a message to the poster of this listing</div>
  <!-- end row --> 
</div>
<!-- end container -->
</body>
</html>