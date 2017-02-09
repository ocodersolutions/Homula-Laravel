<?php error_reporting(0); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Easy Installation - Real Estate Made Simple</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="install-style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id='container'>
<h2 align='center'>Finalize Installation</h2>
<?php
$host=trim($_POST['host']);
$dbname=trim($_POST['dbname']);
$dbusername=trim($_POST['dbusername']);
$dbpassword=trim($_POST['dbpassword']);
$purchasecode=trim($_POST['purchasecode']);
$authorizationcode=trim($_POST['authorizationcode']);

$adminusername=trim($_POST['adminusername']);
$adminTextpassword=trim($_POST['adminpassword']);
$websitename=trim($_POST['websitename']);
$errorMessage="";
$parent_dir=dirname( dirname(__FILE__) );

if(strlen($adminusername)<=0) $errorMessage=$errorMessage."<br />Admin Username";
if(strlen($adminTextpassword)<=0) $errorMessage=$errorMessage."<br />Admin Password";
if(strlen($websitename)<=0) $errorMessage=$errorMessage."<br />Website Name";

$adminpassword=md5($adminTextpassword);

if(strlen($errorMessage)>1){
	print "<p align='center'><b>Please specify:</b><br />$errorMessage<br /><br />
	<a href='javascript:history.go(-1);'><b>Try again</b></a></p>";
}else{
$con=mysql_connect($host,$dbusername,$dbpassword) or die("Could not connect. Check the values you specified on previous page. <a href='javascript:history.go(-1);'><b>Try again</b></a><br /><br />(".mysql_errno().": ".mysql_error().")");
mysql_select_db($dbname,$con);	

$allErrors="";

$today_dttm = date("Y-m-d H:i:s");
$userqr="insert into member (id,username,password,dttm,memtype) values ('1','$adminusername','$adminpassword','$today_dttm','9')";
$uresult=mysql_query($userqr);
if(!$uresult) $allErrors=mysql_errno().": ".mysql_error();

$userqr2="insert into admin_options (websitetitle,browsertitle,purchase_code,authorization_code) values ('$websitename','$websitename','$purchasecode','$authorizationcode')";
$uresult2=mysql_query($userqr2);
if(!$uresult2) $allErrors=$allErrors."<br />".mysql_errno().": ".mysql_error();
//print "$userqr<br />$uresult<br />";
$userqr3="insert into pricerange (id) values ('1')";
$uresult3=mysql_query($userqr3);
if(!$uresult3) $allErrors=$allErrors."<br />".mysql_errno().": ".mysql_error();

if($uresult && $uresult2 && $uresult3){
	$site_config_file="$parent_dir/site.inc.php";
	$stringData = '<?php
    $host="'.$host.'";
    $database="'.$dbname.'";
    $username="'.$dbusername.'";
    $password="'.$dbpassword.'";
    ?>';
	if(is_writable($site_config_file)){
		$fh = fopen($site_config_file, 'w') or die("Can't open file: $site_config_file. Check permissions");
		fwrite($fh, $stringData);
		fclose($fh);
		print "<p align='center'><b>Installation finished.</b><br /><br />
		<b>Username:</b> $adminusername<br />
		<b>Password:</b> $adminTextpassword
		<br /><br /><font color='A80303'><b>Important: </b>1) Change back the permission of site.inc.php, if you changed it earlier. <br />(linux command: <code>chmod 644 site.inc.php</code> ). Make sure that site.inc.php is not world writable as otherwise it would be a serious security threat.<br /><br />
		<br /> 2) Delete the <b>install</b> folder now.</font></p>";
	}else{ // not writable
		print "<p align='center'><b>$site_config_file</b> is not writable.<br /><br />Paste the following code in <b>$site_config_file</b><br />";
		?>
		<textarea name="conversionField" onclick="this.focus(); this.select();" cols="50" rows="7">
		<?php print $stringData; ?>
		</textarea>
		<br /><br />
		<b>Username:</b> <?php print $adminusername; ?><br />
		<b>Password:</b> <?php print $adminTextpassword; ?>
		<br /><br /><font color='A80303'>
		<b>Important: </b>1) Change back the permission of site.inc.php (linux command: chmod 755 site.inc.php ). Make sure that site.inc.php is not world writable as otherwise it would be a serious security threat.
		 <br /><br />2) Delete the <b>install</b> folder now.</font></p>
		<?php 
	}
	
	
}else{
	print $allErrors;
	
}
}
?>
</div>
</body>
</html>