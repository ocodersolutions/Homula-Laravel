<?php
session_start();
error_reporting(0);
include("functions.inc.php");
$prid	= trim($_GET["prid"]);
$act	= trim($_GET["act"]);
$delid	= trim($_GET["delid"]);

compareproperty($prid, $act, $delid);
?>