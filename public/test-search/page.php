<?php
include("config.php");
$id=mysql_real_escape_string($_GET['id']);
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$qr="select * from $pageTable where id='$id';";
$result=mysql_query($qr);
$page=mysql_fetch_assoc($result);
?>
<div id='perimeter'>
<fieldset id='reProfilePage'>
<legend>
<?php print $page['page_name'];?>
</legend>
<?php print $page['page_content']; ?>
</fieldset>
</div>