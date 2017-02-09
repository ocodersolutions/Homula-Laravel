<?php
session_start();
error_reporting(0);
include("functions.inc.php");
$FID		= trim($_GET["fid"]);
deletefavorite($FID);
?>