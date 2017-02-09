<?php
/*
*     Author: Ravinder Mann
*     Email: ravi@codiator.com
*     Web: http://www.codiator.com
*     Release: 1.6
*
* Please direct bug reports,suggestions or feedback to :
* http://www.codiator.com/contact/
*
* Real estate made easy is a commercial software. Any distribution is strictly prohibited.
*
*/
function setOptionValues($host,$database,$username,$password,$adminOptionTable){
	if(!isset($_SESSION["readmin_settings"])) setReSession($host,$database,$username,$password,$adminOptionTable);
	return 	$_SESSION["readmin_settings"];
}

function setReSession($host,$database,$username,$password,$adminOptionTable){
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	mysql_query("SET NAMES utf8");
	$adminQr="select * from $adminOptionTable";
	$adminResult=mysql_query($adminQr);
	$adminOptions=mysql_fetch_assoc($adminResult);
	$_SESSION["readmin_settings"]=$adminOptions;
		
	if(trim($adminOptions['siteoutercolor'])!="" || trim($adminOptions['siteheadercolor'])!="" || trim($adminOptions['siteheaderfontcolor'])!="" || trim($adminOptions['siteinnercolor'])!="" || trim($adminOptions['sitebordercolor'])!="" || trim($adminOptions['searchformcolor'])!="" || trim($adminOptions['searchformbordercolor'])!="" || trim($adminOptions['searchformfontcolor'])!="" || trim($adminOptions['menuboxcolor'])!="" || trim($adminOptions['menuboxfontcolor'])!="" || trim($adminOptions['menuboxbordercolor'])!=""){
		$_SESSION["recustom_settings"]=1;
		
	}
   
}

function setLanguageValues($host,$database,$username,$password,$languageTable,$redefaultLanguage){
	if(!isset($_SESSION["re_language"])) setLanguageSession($host,$database,$username,$password,$languageTable,$redefaultLanguage);
	return 	$_SESSION["re_language"];
}

function setLanguageSession($host,$database,$username,$password,$languageTable,$redefaultLanguage){
	$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
	mysql_select_db($database,$con);
	mysql_query("SET NAMES utf8");
	$adminQr="select * from $languageTable where language='$redefaultLanguage'"; 
	$adminResult=mysql_query($adminQr);
	while($langOptions=mysql_fetch_assoc($adminResult)){
		$languageTags[$langOptions['keyword']]=stripslashes($langOptions['translation']);
	}
	
	
	$_SESSION["re_language"]=$languageTags;
		 
}

function setAuth(){
$con=mysql_connect($GLOBALS['host'],$GLOBALS['username'],$GLOBALS['password']) or die("Could not connect. Please try again.");
    mysql_select_db($GLOBALS['database'],$con);
    mysql_query("SET NAMES utf8");
    $qr="select authorization_code, purchase_code from ".$GLOBALS['adminOptionTable'].";";
    $result=mysql_query($qr); 
    $row=mysql_fetch_assoc($result); 
    $_SESSION["readmin_settings"]['authorization_code']=$row['authorization_code'];    
    $_SESSION["readmin_settings"]['purchase_code']=$row['purchase_code'];
}

?>