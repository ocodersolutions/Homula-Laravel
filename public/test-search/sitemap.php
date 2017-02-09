<?php include("config.php"); include_once("functions.inc.php"); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$full_url_path = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"]);
$rssqr="select * from $reListingTable order by id desc";
$rssresult=mysql_query($rssqr);
?>
<?php while($rss=mysql_fetch_assoc($rssresult)) {
    if($_SESSION["readmin_settings"]["refriendlyurl"]=="enabled"){
    $headline_slug=friendlyUrl($rss['headline']);   
    $relistingLink=$full_url_path.friendlyUrl($rss['retype'],"_")."/".friendlyUrl($rss['subtype'],"_")."/"."id-".$rss['id']."-".$region."-".$headline_slug; 
    }else{
	$relistingLink=$full_url_path."index.php?ptype=viewFullListing&amp;reid=".$rss['id'];
    }
	list($lastmod,$temptime)=explode(" ",$rss['dttm_modified']);
?>
<url>
	<loc><?php print $relistingLink; ?></loc>
	<lastmod><?php print $lastmod; ?></lastmod>
</url>

<?php }
    $qrpg="select id, page_name from $pageTable order by page_order asc;";
    $resultpg=mysql_query($qrpg);
    while($apage=mysql_fetch_assoc($resultpg)){
    $customPageLink=$full_url_path."index.php?ptype=page&amp;id=".$apage['id'];
    ?>
    <url>
	<loc><?php print $customPageLink; ?></loc>
	<priority>0.5</priority>
	</url>
    <?php 
    }

    $contactLink=$full_url_path."index.php?ptype=contactus"; ?>
<url>
	<loc><?php print $contactLink; ?></loc>
	<priority>0.5</priority>
</url>

</urlset>