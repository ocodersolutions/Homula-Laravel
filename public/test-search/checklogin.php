<?php
error_reporting(0);
//ob_start();
include("config.php");

mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db($database)or die("cannot select DB");
mysql_query("SET NAMES utf8");

$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$myusername = stripslashes(htmlspecialchars($myusername, ENT_QUOTES, 'UTF-8'));
$mypassword = stripslashes(htmlspecialchars($mypassword, ENT_QUOTES, 'UTF-8'));
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$mypassword=md5($mypassword);

$sql="SELECT * FROM $rememberTable WHERE username='$myusername' and password='$mypassword' and status='Active' ";

$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
$count=mysql_num_rows($result);

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
$_SESSION["re_mem_id"]=$row['id'];
$_SESSION["memtype"]=$row['memtype'];
$_SESSION["myusername"]=$myusername;
//session_register("mypassword");
$_SESSION["mypassword"]=$mypassword;

//header("location:index.php?$requerystring");

}
else {
echo "<h5 align='center'>".$relanguage_tags["Incorrect Username or Password"].". <a href='javascript:history.go(-1);'><b>".$relanguage_tags["Please try again"]."</b></a></h5>";
}

ob_end_flush();




?>