<?php
session_start();
error_reporting(0);
include("functions.inc.php");
$prid	= trim($_GET["prid"]);

favcompareproperty($prid);
?>