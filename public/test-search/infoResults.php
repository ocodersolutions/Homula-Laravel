<?php
session_start();
error_reporting(0);
include("functions.inc.php");

$q=trim($_GET["q"]);
$type=trim($_GET["type"]);
//include_once("config.php");
//$_SESSION['_old_session']=$q;

safelyExecute($q,$type);
 
 ?>
 
 
 