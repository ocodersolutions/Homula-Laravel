<?php
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

$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php print $browsertitle; ?></title>

<!-- Bootstrap core CSS -->
<?php if($webtheme==""){ ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/default/bootstrap.css" />
<link rel="stylesheet" media="screen" type="text/css" href="css/default/bootstrap-theme.min.css" />
<?php }else{ ?>
<link rel="stylesheet" media="screen" type="text/css" href="css/<?php print $webtheme; ?>/bootstrap.css" />
<?php } ?>

<script src="js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Custom styles for this template -->
<link href="css/carousel.css" rel="stylesheet">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
 <div class="navbar navbar-default" >
    <div class="container">
        <div class="row">
            <div class="col-sm-3 position-r <?php if($rtl) print " pull-right "; ?>">
                <a class="logo" href="<?php print $full_url_path; ?>" >
                <?php if(trim($readmin_settings['websitelogo'])!=""){ ?>
                <img src="uploads/<?php print $readmin_settings['websitelogo']; ?>" class="logo-img" alt='<?php print $reSiteName; ?>'> 
                <img src="uploads/<?php print $readmin_settings['websitelogo']; ?>" class="mobile-only" align="..." alt='<?php print $reSiteName; ?>'>
                <?php }else{ print "<h4>".$reSiteName."</h4>"; } ?>    
                </a></div>
            <div class="col-sm-7">
                <nav role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav nav-option pull-right">
                                <div class="mobile-only join">
                                    <li><?php if(!isset($_SESSION["myusername"])){ ?><a class="btn btn-default btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Sign in / Join</a><?php } ?></li>
                                </div>
                               <li class='first_item <?php if($ptype=="" || $ptype=="home") print "active"; ?>'><a href='index.php'><?php print $relanguage_tags["Home"];?></a></li>
  
    <?php 
    $qrpg="select id, page_name, topmenu from $pageTable order by page_order asc;";
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
    <?php } } ?>
    <li class='favli' id='favli' style="display:none;"><a href='#'><?php print __("Favorite");?></a></li>
    <li <?php if($ptype=="contactus") print " class='active' "; ?>><a href='<?php print $contactPageLink; ?>'><?php print $relanguage_tags["Contact us"];?></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-sm-2 <?php if($rtl) print " pull-left "; ?>">
                <div class="sign-in l-view">
                    <ul>
                        <li><?php if(!isset($_SESSION["myusername"])){ ?><a class="btn btn-default btn-sm" href="javascript:void(0)"  data-toggle="modal" data-target="#myModal">Sign in / Join</a><?php } ?></li>
                        <li><!--<a href="javascript:void(0)"><i class="fa fa-question-circle"></i></a>--></li>
                    </ul>
                </div>
                <div class="sign-in t-view">
                    <ul>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><i class="fa fa-user"></i></a></li>
                        <li><!--<a href="javascript:void(0)"><i class="fa fa-question-circle"></i></a>--></li>
                    </ul>
                </div>
                
                <div class="modal fade bg" id="forgotModal" tabindex="-1" role="dialog" style="z-index:1000" aria-labelledby="forgotModalLabel" aria-hidden="true">
                  <div class="modal-dialog sign-modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php print __("Forgot Password"); ?></h4>
                      </div>
                      <div class="modal-body">
                          <form id="forgotPasswordForm" name="forgotPasswordForm" >
                          <div class="sign-in-data">
                           <div class="row">
                                        <div class="col-xs-12"><input id="fusername"  name="fusername"  type="text" class="form-control sign-tf" placeholder="<?php print __("Your email"); ?>"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-6"><input id="forgotButton"  class='btn btn-primary form-control btn-bg-blue' type="button" class="form-control sign-tf" value="<?php print __("Send Password"); ?>"></div>
                                      </div>
                                      <div class="row">
                                          <div class="col-xs-12" id='fpassMessage'></div>
                                      </div>
                                  </div>
                           </form>
                      </div>
                      
                      </div>
                
                </div>
                </div>
                
                <div class="modal fade bg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog sign-modal">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php print __("Welcome"); ?></h4>
                      </div>
                      <div class="modal-body">
                        <div role="tabpanel" class="bs-example bs-example-tabs">
                            <ul role="tablist" class="nav nav-tabs sign-tab" id="myTab">
                                <li class="active" role="presentation"><a aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" id="home-tab" href="#home">Sign in</a></li>
                                <li <?php if($disableregistration) print " style='display:none;' "; ?> role="presentation" class=""><a aria-controls="profile" data-toggle="tab" id="profile-tab" role="tab" href="#profile" aria-expanded="false">New account</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- Login tab -->
                                
                                <div aria-labelledby="home-tab" id="home" class="tab-pane fade active in" role="tabpanel">
                                    <form id="loginForm" class="loginForm"  method="post" action="index.php">
                                    <div class="sign-in-data">
                                      <div class="row">
                                        <div class="col-xs-12"><input id="reusername"  name="myusername" value="<?php if($isThisDemo=="yes") print "admin"; ?>" type="text" class="form-control sign-tf" placeholder="<?php print __("Enter Username"); ?>"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12"><input id="repassword"  value="<?php if($isThisDemo=="yes") print "testtest"; ?>" name="mypassword" type="password" class="form-control sign-tf" placeholder="<?php print __("Enter Password"); ?>"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-6 fwd">
                                  <input type='hidden' name='ptype' value='checklogin' />          
                                  <input type='hidden' name="requerystring" value="<?php print htmlspecialchars($_SERVER['QUERY_STRING']); ?>" />          
                             <input type="submit" value="<?php print __("Sign in"); ?>" id='loginButton' class="btn btn-primary form-control btn-bg-blue"></input></div>
                                    <div class="col-xs-6 fwd text-center"><a href="javascript:void(0)" id='fpassword' data-toggle="modal" data-target="#forgotModal" class="mr-t5"><?php print __("Don't know your password?"); ?></a></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12">
                                          <div class="contect-with" <?php if($disableregistration) print " style='display:none;' "; ?> >
                                            <ul>
                                              <li><?php 
if(($google_login && $gclientid!="" && $gclientsecret!="") || ($fb_app_id!="" && $fb_app_secret!="") || $yahoo_login){                                             print __("Or connect with"); } ?>: </li>
                             
                                              <?php if($google_login && $gclientid!="" && $gclientsecret!=""){  ?>
                                              <li><a href="glogin.php" class="gplus"><i class="fa fa-google-plus-square"></i></a></li>
                                              <?php  } 
                                              if($fb_app_id!="" && $fb_app_secret!=""){ ?>
                                              <li><a href="fblogin.php" class="fb"><i class="fa fa-facebook-square"></i></a></li>
                                              <?php }
                                              if($yahoo_login){ ?>
                                              <li><a href="ylogin.php" class="yahoo"><i class="fa fa-yahoo"></i></a></li>
                                              <?php } ?>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </form>
                                </div>
                                
                                <!-- Login tab ends -->
                                
                                <!-- Signup tab -->
                                <div aria-labelledby="profile-tab" id="profile" class="tab-pane fade" role="tabpanel">
                                    <form id="registerForm" name="registerForm">
                                    <div class="sign-in-data">
                                      <div class="row">
                                        <div class="col-xs-12"><input type="text" id="regusername" name="myusername" class="form-control sign-tf" placeholder="<?php print __("Enter username"); ?>" value="<?php print $_SESSION['reg_username']; ?>"><div style='margin-top:5px; color:red;' id='usernameMessage'></div></div>                         
                                      </div>  
                                      <div class="row">
                                        <div class="col-xs-12"><input type="text" id="reemail"  name="myemail" class="form-control sign-tf" placeholder="<?php print __("Enter Email"); ?>"></div>                         </div>
                                      <div class="row">
                                        <div class="col-xs-12"><input id="regpassword"  name="mypassword" type="password" class="form-control sign-tf" placeholder="<?php print __("Create Password"); ?>"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-12"><input id="recpassword"  name="mycpassword" type="password" class="form-control sign-tf" placeholder="<?php print __("Confirm Password"); ?>"></div>
                                      </div>
                                      <?php if($enableRegisterCaptcha){ ?>
                                      <div class="row">
                                      <div class="col-xs-12">
                                          <div id='captchaImage'>
                                          <img id="captcha" src="securimage/securimage_show.php?<?php print rand(100,10000); ?>" alt="<?php print __("CAPTCHA Image"); ?>" />                           </div>
                                      
                                      </div>
                                      </div>
                                     <div class="row">
                                        <div class="col-xs-12">
                                        <input name="captcha_code" id="captcha_code" type="text" class="form-control sign-tf" placeholder="<?php print __("Enter the words"); ?>"></div></div>
                                        <?php } ?>
                                      <div class="row">
                                        <div class="col-xs-6 fwd"><button type="button" id="registerButton2" class="btn btn-primary form-control btn-bg-blue"><?php print __("Submit"); ?></button>
                                            <div id='registerErrorMessage' style='color:red; font-weight:bold;'></div>                                            
                                        </div>                                        
                                        <div class="col-xs-6 fwd text-center"><!--I accept <a href="#" class="mr-t5">Terms of Use</a>--></div>
                                      </div>
                                       <div class="row">
                                        <div class="col-xs-12">
                                          <div class="contect-with">
                                            <ul>
                                              <li><?php 
if(($google_login && $gclientid!="" && $gclientsecret!="") || ($fb_app_id!="" && $fb_app_secret!="") || $yahoo_login){                                             print __("Or connect with"); } ?>: </li>
                             
                                              <?php if($google_login && $gclientid!="" && $gclientsecret!=""){  ?>
                                              <li><a href="glogin.php" class="gplus"><i class="fa fa-google-plus-square"></i></a></li>
                                              <?php  } 
                                              if($fb_app_id!="" && $fb_app_secret!=""){ ?>
                                              <li><a href="fblogin.php" class="fb"><i class="fa fa-facebook-square"></i></a></li>
                                              <?php }
                                              if($yahoo_login){ ?>
                                              <li><a href="ylogin.php" class="yahoo"><i class="fa fa-yahoo"></i></a></li>
                                              <?php } ?>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<!-- Carousel -->
<div id="myCarousel" class="carousel slide  carousel-fade position-r" data-ride="carousel">
    <div class="home-search-main">
        <div class="h-search">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="search-home">
                            <h1><span><?php print __("Search"); ?></span></h1>
                        </div>
                    </div>
                </div>
                <div class="search-option-bg">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-options">
                                <ul>
                                    <li><a id='s-1' href="javascript:void(0)" class="active"><?php print __("All"); ?></a> </li>
                                    <li><a id='s-2' href="javascript:void(0)"><?php print __("For Sale"); ?></a></li>
                                    <li><a id='s-3' href="javascript:void(0)"><?php print __("For Rent"); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-group ui-widget">
                                <input type="text" id='searchQuery' class="form-control search-field" placeholder="<?php print __("Start typing city name to view existing matching results"); ?>">
                                <span id='searchButton' class="input-group-addon search-btn"><i class="fa fa-search"></i></span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end  home-search-main  -->
    <div class="rentals">
      <div class="container">
        <div class="row">
          <div class="col-xs-9"><div class="home-icon"><a href="javascript:void(0)" class="icon-home"><i class="fa fa-home"></i></a></div><a href="javascript:void(0)"><span><?php print $reSiteName; ?></span></a> <?php print $tagline; ?></div>
         <div class="col-xs-3 txt-align-r"><a href='index.php?ptype=' class="btn btn-primary btn-bg-blue" type="button"><?php print __("View Listings"); ?></a></div>
        </div>
      </div>
    </div>
    <div class="carousel-inner" role="listbox">
        <div class="item active"> <img src="images/slide1.jpg" alt="First slide"> </div>
        <div class="item"> <img src="images/slide2.jpg" alt="Second slide"> </div>
        <div class="item"> <img src="images/slide3.jpg" alt="Third slide"> </div>
    </div>
    <div class="left carousel-control shadow-new"> <span class="sr-only">Previous</span> </div>
    <div class="right carousel-control shadow-new"> <span class="sr-only">Next</span> </div>
    <div class="mobile-only top shadow-top">a</div>
</div>
<!-- /.carousel -->

<!-- Three columns of text below the carousel -->
<!--
<div class="blue-section">
    <div class="container"> 
        
        
        <div class="row">
            <div class="col-sm-4 blue-section-box">
                <h2>Heading</h2>
                <img src="images/1.jpg">
                <p class="blue-box-text">See single-family homes, condos, town homes - even homes not yet on the market, such as pre-foreclosures.</p>
                <p><a class="btn btn-primary" href="javascript:void(0)" role="button">Lander homes for sale</a></p>
            </div>
            
            <div class="col-sm-4 blue-section-box">
                <h2>Heading</h2>
                <img src="images/2.jpg">
                <p class="blue-box-text">Shop for customized quotes, calculate monthly payments with mortgage calculators, get pre-approved for a mortgage by a participating lender, and more! .</p>
                <p><a class="btn btn-primary" href="javascript:void(0)" role="button">Get rates </a></p>
            </div>
            
            <div class="col-sm-4 blue-section-box">
                <h2>Heading</h2>
                <img src="images/3.jpg">
                <p class="blue-box-text">Browse more than 300,000 photos of kitchens, bathrooms, outdoor spaces and more – organized by space, style, cost and color. </p>
                <p><a class="btn btn-primary" href="javascript:void(0)" role="button">Get inspired now </a></p>
            </div>
            
        </div>
             
    </div>
    
</div>
-->
<?php
//$qr="SELECT city, count( * ) AS tot FROM listing GROUP BY city ORDER BY tot DESC; ";
$qrlist="select distinct city, count( * ) as tot from listing group by city order by city asc; ";
$resultlist=mysql_query($qrlist);
$totalCities=mysql_num_rows($resultlist);
$eachRow=$totalCities/4;
$visibleRows=10;
?>
<div class="bottom-links">
    <div class="container">
        <div class="row">
          <div class="col-sm-6">
           <div class="row">
            <div class="col-xs-6">
             <ul data-show-less-text="Less" data-show-more-text="More" data-visible-count="5" >
                   <?php
                   $count=0;
                   while($count<$eachRow){
                       $record=mysql_fetch_assoc($resultlist);
                       if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled") $cityLink="city/".$record['city'];
                       else $cityLink='index.php?city='.$record['city'];
                       if($count<=$visibleRows) print '<li><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       else print '<li class="hide drawer-item"><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       $count++;
                   }
                   if($count>$visibleRows) print '<li class="drawer-show-hide"><span style="cursor:pointer;" class="moreLink show-hide-link">More</span></li>';
                   ?>
                   <li class="drawer-show-hide" ><span style="display:none; cursor:pointer;" class="lessLink show-hide-link"><?php print __("Less"); ?></span></li>
                </ul>
            </div>
            <div class="col-xs-6">
                 <ul data-show-less-text="Less" data-show-more-text="More" data-visible-count="5">
                  <?php
                   $count=0;
                   while($count<$eachRow){
                       $record=mysql_fetch_assoc($resultlist);
                       if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled") $cityLink="city/".$record['city'];
                       else $cityLink='index.php?city='.$record['city'];
                       if($count<=$visibleRows) print '<li><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       else print '<li class="hide drawer-item"><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       $count++;
                   }
                   if($count>$visibleRows) print '<li class="drawer-show-hide"><span style="cursor:pointer;" class="moreLink show-hide-link">More</span></li>';
                   ?>
                   <li class="drawer-show-hide" ><span style="display:none; cursor:pointer;" class="lessLink show-hide-link">Less</span></li>
                </ul>
            </div>
           </div>
          </div>
            
          <div class="col-sm-6">
           <div class="row">
            <div class="col-xs-6">
               <ul data-show-less-text="Less" data-show-more-text="More" data-visible-count="5">
                 <?php
                   $count=0;
                   while($count<$eachRow){
                       $record=mysql_fetch_assoc($resultlist);
                       if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled") $cityLink="city/".$record['city'];
                       else $cityLink='index.php?city='.$record['city'];
                       if($count<=$visibleRows) print '<li><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       else print '<li class="hide drawer-item"><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       $count++;
                   }
                   if($count>$visibleRows) print '<li class="drawer-show-hide"><span style="cursor:pointer;" class="moreLink show-hide-link">More</span></li>';
                   ?>
                   <li class="drawer-show-hide" ><span style="display:none; cursor:pointer;"  class="lessLink show-hide-link">Less</span></li>
                </ul>
            </div>
            <div class="col-xs-6">
                <ul data-show-less-text="Less" data-show-more-text="More" data-visible-count="5">
                 <?php
                   $count=0;
                   while($count<$eachRow){
                       $record=mysql_fetch_assoc($resultlist);
                       if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled") $cityLink="city/".$record['city'];
                       else $cityLink='index.php?city='.$record['city'];
                       if($count<=$visibleRows) print '<li><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       else print '<li class="hide drawer-item"><a href="'.$cityLink.'">'.$record['city'].'</a></li>';
                       $count++;
                   }
                   if($count>$visibleRows) print '<li class="drawer-show-hide"><span style="cursor:pointer;" class="moreLink show-hide-link">More</span></li>';
                   ?>
                   <li class="drawer-show-hide" ><span style="display:none; cursor:pointer;"  class="lessLink show-hide-link">Less</span></li>
                </ul>
            </div>
          </div>
        </div>
            
            
        </div>
    </div>
</div>

<!-- FOOTER -->

<footer class="footer-bg">
    <div class="container">
        <nav class="footer-nav">
            <ul>
                <?php
                $qrpg="select id, page_name, topmenu, footermenu from $pageTable order by page_order asc;";
    $resultpg=mysql_query($qrpg);
    while($apage=mysql_fetch_assoc($resultpg)){
           if($refriendlyurl=="enabled"){
            $pageLink=friendlyUrl($apage['page_name'],"_")."-".$apage['id'];
           }else{
            $pageLink="index.php?ptype=page&amp;id=".$apage['id'];
           }
           if($apage['footermenu']==1){
            print '<li><a href="'.$pageLink.'">'.$apage['page_name'].'</a></li>';
           } 
           }?>
           <li><a href='<?php print $contactPageLink; ?>'><?php print __("Contact us");?></a></li>
           </ul>
        </nav>
        <div class="row">
            <div class="col-sm-12">
                <div class="follow-us">
                    <ul>
                        <li><?php print $reSiteName; ?></li>
                        <?php if($facebookFollow!="" || $twitterFollow!="" || $googleFollow!=""){ ?>
                        <li>Follow us <a href="<?php print $facebookFollow; ?>"><i class="fa fa-facebook-square"></i></a> 
                            <a href="<?php print $twitterFollow; ?>"><i class="fa fa-tumblr-square"></i></a> 
                            <a href="<?php print $googleFollow; ?>"><i class="fa fa-google-plus-square"></i></a> </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="js/bootstrap.js"></script> 
<script type="text/javascript"  src="js/reFunctions.js"></script>

<script>
$(document).ready(function () {
    $('.moreLink').click(function(){
        $('.drawer-item').removeClass('hide');
        $('.moreLink').hide();
        $('.lessLink').show();
    });
    
    $('.lessLink').click(function(){
        $('.drawer-item').addClass('hide');
        $('.lessLink').hide();
        $('.moreLink').show();
    });
    
    $('.search-option-bg ul li a').click(function(){
      $('ul li a').removeClass('active');
      $(this).addClass("active");
    });
  $('.carousel').carousel({
  interval: 5000,
  pause:false
});
var searchOption=1;

$("#searchButton").click(function(){
    window.location="index.php?ptype=&city="+$("#searchQuery").val()+"&ctype="+searchOption;
});

$("#searchQuery").autocomplete({
source: "infoResults.php?type=28&stype="+searchOption,
minLength: 2,
select: function( event, ui ) { 
$("#searchQuery").val(ui.item.value);
}
});

$('.search-options a').click(function(){
    var sid=(this.id).split('-');
    searchOption=sid[1];
    $( "#searchQuery" ).autocomplete("option","source","infoResults.php?type=28&stype="+sid[1]);
});

$('#regusername').blur(function() {
$.ajax({ type: 'GET', url: 'infoResults.php', data:{q:$(this).val(), type:5}, success: function(data){
          $("#usernameMessage").html(data);
          }
       });
});

$('#loginButton').click(function(){
       var reusername=$.trim($('input#reusername').val());
       var repassword=$.trim($('input#repassword').val());
       var errorMessage="<?php print __("Please enter your");?>: ";
       var errorCode=0;
       if(reusername.length<=0){
            errorMessage=errorMessage+"<?php print __("Username");?>";
            errorCode=1;
       }
       if(repassword.length<=0){
           if(errorCode==1) var errorMessage=errorMessage+" <?php print __("and");?> ";
            errorMessage=errorMessage+"<?php print __("Password");?>";
            errorCode=1;
       }
       if(errorCode==1){
            alert(errorMessage);
            return false;
       } 
   });
   
});

$('#fpassword').click(function(){
$('#myModal').modal('toggle');    
});

$('#registerButton2').click(function(){
var reusername=$("input#regusername").val();
var emailID=document.registerForm.reemail;
if((reusername==null)||(reusername.length<4)){
    alert("<?php print __("Please enter your")." ".__("username");?> (<?php print __("at least")." 4 ".__("characters");?>).");
    return false;
    }
 if((emailID.value==null)||(emailID.value=="")){
     alert("<?php print __("Please enter your")." ".__("Email");?> ID");
     emailID.focus();
     return false
     }
 if(echeck(emailID.value)==false){
     emailID.value="";emailID.focus();return false
 }
 var passVal=$("input#regpassword").val();
 var cpassVal=$("input#recpassword").val();
 var captcha_code=$("input#captcha_code").val();
 if(passVal.length>=6){
     if(passVal==cpassVal){
         var allData=reusername+":::"+emailID.value+":::"+passVal+":::"+captcha_code+":::splash";
         $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:allData, type:3}, success: function(data){
          data=$.trim(data.replace(/[\n\r]/g, ''));   
          data=data.charAt(0);
          if(data=="1"){
              $("#registerErrorMessage").html("<?php print __("Please enter the word challenge exactly as it appears"); ?>.");
              $("#captchaImage").html('<img id="captcha" src="securimage/securimage_show.php?<?php $randnum=rand(100,10000); print $randnum; ?>" alt="CAPTCHA Image" />');
          }
          if(data=="2") $("#profile").html("<div style='text-align:center; margin-top:20px; font-size:16px; font-weight:bold;'><?php print __("Registration successful"); ?>.</div>");
          if(data=="3") $("#registerErrorMessage").html("<?php print __("Registration failed. Try choosing a different username/email"); ?>.");
          }
       });
     }else alert("<?php print __("Passwords don't match."); ?>");
 }else{
    alert("<?php print __("Please make sure that password is of at least 6 digits"); ?>"); 
 }
});

function echeck(str){var at="@";var dot=".";var lat=str.indexOf(at);var lstr=str.length;var ldot=str.indexOf(dot);if(str.indexOf(at)==-1){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.indexOf(at)==-1||str.indexOf(at)==0||str.indexOf(at)==lstr){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.indexOf(dot)==-1||str.indexOf(dot)==0||str.indexOf(dot)==lstr){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.indexOf(at,(lat+1))!=-1){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.substring(lat-1,lat)==dot||str.substring(lat+1,lat+2)==dot){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.indexOf(dot,(lat+2))==-1){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}if(str.indexOf(" ")!=-1){alert("<?php print $relanguage_tags["Invalid E-mail ID"];?>");return false}return true}

$("#forgotButton").click(function(){
var emailID=document.forgotPasswordForm.fusername;if(echeck(emailID.value)==false){emailID.value="";emailID.focus();return false;}if((emailID.value==null)||(emailID.value=="")){alert("<?php print __("Please enter your")." ".__("Email");?> ID");emailID.focus();return false;
}else{
   //infoResults(emailID.value,10,'sidebarLogin');
    $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:emailID.value, type:10}, success: function(data){
        $('#fpassMessage').html(data);
    }
    
});
}
    
});
</script>
</body>
</html>