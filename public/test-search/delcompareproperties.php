<?php
session_start();
error_reporting(0);
include("functions.inc.php");
$cid	= trim($_GET["cid"]);
$from	= trim($_GET["from"]);;

delcompareproperty($cid, $from);
?>