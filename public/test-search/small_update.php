<?php include("config.php"); 

$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");


$qr0="ALTER TABLE admin_options ADD jsontexturl varchar(2500) NOT NULL ;";
$result0=mysql_query($qr0);
 
if($result0) print "<h3 align='center'>Added support for jsontexturl.</h3>";
else print "<h3 align='center'>".mysql_errno().": ".mysql_error().". If you've refreshed this page after update or already updated then discard this message.</h3>";


?>