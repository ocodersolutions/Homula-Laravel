$( "#sidebarTabs" ).tabs();  

setWidthHeight = function(){
  
$('#mapResults').css('position','absolute');
$('#mapResults').css('top','0');
$('#mapResults').css('left','0');
var isIE8 = $.browser.msie && +$.browser.version === 8;
var isIE7 = $.browser.msie  && parseInt($.browser.version, 10) === 7;
var topbarHeight=$('.navbar-default').height();
if (isIE7 || isIE8) topbarHeight='52';
 
var sidebarHeight=$('#sidebar').height();
var winHeight=$(window).height();
if((winHeight-topbarHeight)>sidebarHeight){
    $('#sidebar').css('height',(winHeight-topbarHeight-9)+'px');
    <?php if(!isset($_GET['hideheader'])){ ?>
    $('#sidebar').css('height',(winHeight-topbarHeight-9)+'px');
    <?php }else{ ?>
    $('#sidebar').css('margin-top','0px');
    <?php } ?>
 }
var sidebarResultHeight=(winHeight-(topbarHeight + $(".ui-tabs-nav").height()))-30;
$('#sidebarResults').css('height',sidebarResultHeight+'px'); 
$('#sidebarResults').css('padding-top','0');
$('#sidebarResults').css('padding-bottom','0');

var winWidth=$(window).width();
if(winWidth<=1024){ $(".top_menu").css('margin-right','60px'); }
var mapSidebarWidth=$("#mapSidebar").width();
if(sidebarVisible==0)mapSidebarWidth=0;
var mapSidebarHeight=$("#sidebar1").outerHeight();
var docHeight=$(document).height();
var mapWidth=winWidth-mapSidebarWidth;
var mapHeight=docHeight-topbarHeight;

if(mapHeight < mapSidebarHeight) mapHeight=mapSidebarHeight;
/* console.log('mapHeight:'+mapHeight+'px'); */

$('#mapResults').css('width',mapWidth+'px');

<?php 
if($_SESSION['rtl'])
{ 
?>
	$('#mapResults').css('margin-right',mapSidebarWidth+'px'); $('#mapResults').css('margin-left','0px');
<?php 
}else{ 
?>
	/*$('#mapResults').css('margin-left',mapSidebarWidth+'px'); $('#mapResults').css('margin-right','0px');*/
    $('#mapResults').css('margin-left','0px'); $('#mapResults').css('margin-right','0px'); $('#mapResults').css('width','100%')
<?php 
} 
?>

$("#theListing").css('height',($(window).height()-50)+'px');

if( $('.navbar').is(':visible') ) { 
           <?php if(!isset($_GET['hideheader'])){ ?>
            $('#mapResults').css('height',mapHeight+'px');   
            $('#sidebar').css('margin-top',topbarHeight+'px');
            /*$('#mapResults').css('margin-top',topbarHeight+'px');*/
            $('#showbar').css('top',topbarHeight+'px');
            <?php }else{ ?>
            $('.navbar-default').hide();
            $('#mapResults, #sidebar').css('margin-top','0px');
            mapHeight=mapHeight+topbarHeight;
            $('#mapResults').css('height',mapHeight+'px');
            <?php } ?> 
}

$('#theListing').css('margin-top', topbarHeight);
/* $('#theListing').css('width', winWidth/2); */
  
     
}

setWidthHeight();