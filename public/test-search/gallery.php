<?php 
$id=trim($_GET["adid"]);
include("config.php");
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$id=mysql_real_escape_string($id);
$qr="select pictures from $reListingTable where id='$id'";
$result=mysql_query($qr);

if($result){
	$row=mysql_fetch_assoc($result);
	$rePicArray=explode("::",$row['pictures']);
	$totalRePics=sizeof($rePicArray);
	if ($totalRePics > $reMaxPictures) $totalRePics = $reMaxPictures;
}else{
	print "<h3 align='center'>Images for listing #$id not found.</h3>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery.css">
  <script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
  </script>
<title><?php print $relanguage_tags["Photo Gallery For"]; ?> #<?php print $id; ?></title>
</head>
<body>

  <div id="container" style="border:0;">
    <div class='row'>  
        <div class='col-md-12 col-lg-12'>
       <div id="gallery" class="ad-gallery">
      <div class="ad-image-wrapper">
      </div>
      <div class="ad-controls">
      </div>
      <div class="ad-nav">
        <div class="ad-thumbs">
        <ul class="ad-thumb-list">
          <?php 
         for($i=0;$i<$totalRePics;$i++){
         	if(trim($rePicArray[$i])!=""){
          	?>
          	<li>
          	 <a href="<?php print $rePicArray[$i]; ?>">
          	 <img width='150' height='100' src="timthumb.php?src=<?php print $rePicArray[$i]; ?>" class="image0">
          	 </a>
          	</li>
          	<?php   
         	}        	
          }          
          ?>
        </ul>
        </div>
      </div>
    </div>

    <div id="descriptions"></div>
    </div>
  </div>
 </div>
</body>
</html>