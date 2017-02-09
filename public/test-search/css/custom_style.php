<?php
session_start();
header("Content-type: text/css");
$readmin_settings=$_SESSION["readmin_settings"];
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
error_reporting(0);
?>
body{font-size:13px;}
<?php
if($readmin_settings['siteoutercolor']!=""){
?>
body{
background-color:<?php print $readmin_settings['siteoutercolor']; ?>;
}
<?php } ?>

<?php if($readmin_settings['webtheme']=="readable"){ ?>
body {
    padding-top: 0px !important;
}
<?php } ?>

<?php if($readmin_settings['fixedtopheader']!="yes"){ ?>
	body{ padding-top: 0; }
<?php } ?>
#header{
<?php 
if($readmin_settings['siteheadercolor']!="") print "background-color:". $readmin_settings['siteheadercolor'].";";
if($readmin_settings['siteheaderfontcolor']!="") print "color:". $readmin_settings['siteheaderfontcolor'].";";
?>
}

#wrapper .container{
<?php 
if($readmin_settings['siteinnercolor']!="") print "background-color:". $readmin_settings['siteinnercolor'].";";
if($readmin_settings['sitebordercolor']!="") print "border-color:". $readmin_settings['sitebordercolor'].";";
?>
}

#sidebar1{
<?php 
if($readmin_settings['searchformcolor']!="") print "background-color:". $readmin_settings['searchformcolor'].";";
if($readmin_settings['searchformbordercolor']!="") print "border-color:". $readmin_settings['searchformbordercolor'].";";
if($readmin_settings['searchformfontcolor']!="") print "color:". $readmin_settings['searchformfontcolor'].";";
if(($_GET['ptype']=="showOnMap" && $_GET['fullscreen']=="true") || $_GET['fs']=="true"){ 
/*	print "position: fixed; ";
	print "padding:10px; ";
	print "z-index: 100; ";
	print "width:250px;
	left:0px;
	top:10px; "; */
}
?>
}

.fblogin li > a:hover{
background-color:#fff;
}

<?php if(($_GET['ptype']=="showOnMap" && $_GET['fullscreen']=="true") || $_GET['fs']=="true"){   ?>
#header{
display:none;
}

#sidebar{
position: absolute;
z-index: 100;
top:0px;
<?php if(isset($_SESSION["rtl"]) && !$_SESSION["rtl"]){ ?>left:0px; <?php } ?>
/*width:350px;*/
width:315px; 
}

#footer{
display:none;
}

#mainContent{
z-index:11;
background-color:#fff;
}
<?php } ?>
.smallOptional, .smallOptional a{
<?php 
if($readmin_settings['searchformfontcolor']!="") print "color:". $readmin_settings['searchformfontcolor'].";";
?>
}

#sidebarLogin{
<?php 
if($readmin_settings['menuboxcolor']!="") print "background-color:". $readmin_settings['menuboxcolor'].";";
if($readmin_settings['menuboxbordercolor']!="") print "border-color:". $readmin_settings['menuboxbordercolor'].";";
if($readmin_settings['menuboxfontcolor']!="") print "color:". $readmin_settings['menuboxfontcolor'].";";
?>
}

#footer,#footer p,#footer a{
<?php 
if($readmin_settings['sitefooterfontcolor']!="") print "color:". $readmin_settings['sitefooterfontcolor'].";";
?>
}

<?php if(trim($readmin_settings['topmenubordercolor'])!=""){ ?>
#header_top_menu{
border:1px solid <?php print $readmin_settings['topmenubordercolor']; ?>;
}

#header_top_menu ul li.first_item{
border-right:1px solid <?php print $readmin_settings['topmenubordercolor']; ?>;
}
<?php  } ?>

<?php if(trim($readmin_settings['topmenubackgroundcolor'])!=""){ ?>
#header_top_menu ul{
background-color: <?php print $readmin_settings['topmenubackgroundcolor']; ?>;
}
<?php  } ?>

<?php if(trim($readmin_settings['topmenufontcolor'])!=""){ ?>
#header_top_menu a{
color: <?php print $readmin_settings['topmenufontcolor']; ?>;
}
<?php  } ?>

.nav-collapse .nav{
margin-right:0;
z-index:200;
}

<?php if($_SESSION["rtl"]){ ?>
#addListingMap img, #reListingOnMap img { 
  max-width: none;
}
#addListingMap label, #reListingOnMap label { 
  width: auto; display:inline; 
} 
.ui-multiselect {
     text-align: right;
}
<?php } ?>

[class^="icon-"], [class*=" icon-"] {
   vertical-align: middle;
   background-image:none;
}

.nav-collapse .nav{
  /*  background-color:#000; */
}

.login_link{
    margin-left:30px;
}

#loginlink a{
    color:#fff;
}

#theListing{
<?php if(isset($_SESSION["rtl"]) && !$_SESSION["rtl"]){ ?>right:0px; <?php } ?>
}
.a_block {
    display: block;
    text-align: left;
    margin-left: 8px;
}
