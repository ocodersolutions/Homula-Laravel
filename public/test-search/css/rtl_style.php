<?php
session_start();
header("Content-type: text/css");
$readmin_settings=$_SESSION["readmin_settings"];
error_reporting(0);
?>

#addListingMap img, #reListingOnMap img { 
  max-width: none;
}
#addListingMap label, #reListingOnMap label { 
  width: auto; display:inline; 
} 
.ui-multiselect {
     text-align: right;
}

.mapInfoPic {
    float: right;
    height: 50px;
    padding-top: 10px;
    width: 50px;
}

.mapInfoText {
    float: left;
    padding: 10px 10px 0 0;
    width: 70%;
}

#theListing{
z-index:100;
}

.ui-multiselect-single .ui-multiselect-checkboxes input {
    position: absolute !important;
    right: -9999px;
    top: auto !important;
}

.ui-multiselect-checkboxes span {
    padding-right: 4px;
}

.form-horizontal .control-label, div.adminlabel{float:right;}
#logo{float:right;}
.nav-collapse, .menuside{float:left;}

.a_block {
    text-align: right;
}


.navbar .brand{float:right;}

<?php  if(($_GET['ptype']=="showOnMap" && $_GET['fullscreen']=="true") || $_GET['fs']=="true"){  ?>
#sidebar{right:0;}
#modeButton{right:auto; left: 5px;}
#hidebar{background-image:url("../images/fancy_nav_right.png")}
#showbar{background-image:url("../images/fancy_nav_left.png"); left:auto; right:20px; }
<?php } ?>

#sidebarMap1 h3 {
    margin-bottom: 0px;
}

#sidebarMap1{
width:230px;
}

#sidebarMap1{
margin-top:-8px;
}

.ui-multiselect-checkboxes label{
padding:1px;
}

input[type="radio"], input[type="checkbox"]{
margin:0;
}

#sidebarMap1 input[type="text"]{
width:220px;
}

#theListing{
left:0px;
}

.pagination li {
float: right;
}

.ui-multiselect-single .ui-multiselect-checkboxes label{
 margin-right:20px;   
}