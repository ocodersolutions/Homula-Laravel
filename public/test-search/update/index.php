<?php include("../config.php"); $step=$_GET['step']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update - Real Estate Made Simple</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="install-style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(function(){
var authorizationcode="";
var purchasecode="";
$('#activateButton, #updateActivateButton').click(function(){
    
    purchasecode=$.trim($("#purchasecode").val());
    if(purchasecode==""){
        alert("Enter your purchase code."); return false;
    }else{
    var url="https://www.finethemes.com/services/authorize_product.php?callback=?";
    $("#sresponse").html('<img src="../images/loading1c.gif" />');
    $("#sresponse").css("background-color","#FFFFE1");
    $("#sresponse").css("color","#000000");
    $("#sresponse2").hide();    
    var domain=document.domain; 
    if(domain=="") domain=location.host; 
    var siteurl="<?php print urlencode("http://" . $_SERVER['HTTP_HOST'] . preg_replace("#/[^/]*\.php$#simU", "/", $_SERVER["PHP_SELF"])); ?>"; 
    var action="check";
    
    if($(this).attr("id")=="activateButton"){
      action="check";  
    }
    if($(this).attr("id")=="updateActivateButton"){
      action="update";  
    }
    //console.log("action: "+action);
    $.ajax({
          type: 'GET',    
          url: url,
          data:{purchasecode:purchasecode, domain:domain, siteurl:siteurl, action:action},
          dataType: "jsonp",
          crossDomain: true,     
          cache:false, 
          success: function(data){ //console.log("data: "+data);
              if(data[0]=="failed"){
                  $("#sresponse").css("background-color","#B40404");
                  $("#sresponse").css("color","#ffffff");
                  $("#sresponse").html(data[1]);
              }else if(data[0]=="duplicate"){
                  $("#sresponse").css("background-color","#0B610B");
                  $("#sresponse").css("color","#ffffff");
                  $("#sresponse").html(data[1]);
                  $("#sresponse2").show();   
              }else if(data[0]=="success"){
                  if($.trim(data[1])!=""){ 
                  $("#sresponse, #sresponse2").hide();
                  $("#activate").css("background-color","#0B610B");
                  $("#activate").css("color","#ffffff");
                  var purchasecode=$.trim($("#purchasecode").val());
                  $("#apurchasecode").val(purchasecode); 
                  authorizationcode=data[1];
                  $("#authorizationcode").val(data[1]); 
                  $("#activate").html("<br /><p align='center'><b>Purchase Code Confirmed.</p><br /><p align='center'><input type='button' style='padding: 5px 20px; font-size:150%;' value='Run Update Now' id='step2Button' /></p><br /><br />");
                  $("#dbform").show();
                  } else $("#sresponse").html("<br /><p style='background-color:#B40404; color:#fff; padding:5px;' align='center'><b>Please try again.</b></p>");
              }else{
                  
              }
          
            },
          error:function(jqXHR, textStatus, errorThrown){ 
              $("#sresponse").css("background-color","#B40404");
              $("#sresponse").css("color","#ffffff");
              $("#sresponse").html(errorThrown); 
          }
        });
     }
}); 

$("#step2Button").live('click', function(){ 
    window.location.href="?step=2&authorization="+authorizationcode+"&purchasecode="+purchasecode;
});

});
</script>
</head>
<body>
<div id='container'>
<?php if($step!=2){ ?>    
<div id="activate">
<table border='0'>
<tr class='headrow'><td colspan='2'><span>Confirm Purchase Code</span></td></tr>
<tr class='datarow'><td>Item Purchase Code:</td><td><input type='text' name='purchasecode' value='' id='purchasecode' size='55' /></td></tr>
<tr class='submitrow'><td colspan='2'><input type='button' name='activate' value='Activate' id='activateButton' /></td></tr>
<tr class='datarow'><td colspan='2'><div id='sresponse' style="text-align:center; font-weight:bold;"></div></td></tr>
<tr class='datarow'><td colspan='2'><div id='sresponse2' style="text-align:center; font-weight:bold; display:none;">
<b><font color='#8A0808'>Do you want to activate the license on this domain instead? Activating the license on this domain <u>would deactivate it from your previous domain</u> as one license is good for only one domain.</font></b><br /><br />
<input type='button' name='updateActivate' style="font-size: 150%; padding:5px 20px;" value='Activate for this domain' id='updateActivateButton' />        
</div></td></tr>
</table>
<br />
<b>How to find the purchase code?</b><br />
Log-in to your Codecanyon account and go to <b>Downloads </b> and click on <b>Download</b> and then click on <b>License Certificate</b> link as shown in the below given image. <br /><br />Save the <b>License Certificate</b> file and open it in notepad and locate <b>Item Purchase Code</b> and enter it above. <br /><br />The code would look like this: 88554d20c9-f0aa-4055-b87c-55ec903c4f7b  (This is a sample code)<br /><br />
<p align='center'>
    <img src='../images/licensehelp1.jpg' width='' />
</p>
</div>

<?php
}else{
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$authorization_code=mysql_real_escape_string(trim($_GET["authorization"]));
$purchase_code=mysql_real_escape_string(trim($_GET["purchasecode"]));

if($authorization_code!="" && $purchase_code!=""){
    
$qr0="ALTER TABLE admin_options ADD listingreview varchar(25) NOT NULL ;";
$qr1="ALTER TABLE admin_options ADD fullscreenenabled varchar(25) NOT NULL DEFAULT 'true';";
$qr2="ALTER TABLE admin_options ADD enableregistercaptcha tinyint(1) NOT NULL DEFAULT '1';";
$qr3="ALTER TABLE admin_options ADD rtl tinyint(1) NOT NULL  DEFAULT '0';";
$qr4="ALTER TABLE admin_options ADD google_login tinyint(1) NOT NULL DEFAULT '1';";
$qr5="ALTER TABLE admin_options ADD yahoo_login tinyint(1) NOT NULL DEFAULT '1';";
$qr6="ALTER TABLE admin_options ADD currency_before_price tinyint(1) NOT NULL DEFAULT '1';";

$_SESSION["readmin_settings"]['authorization_code']=$authorization_code;
$_SESSION["readmin_settings"]['purchase_code']=$purchase_code;

$qr0="ALTER TABLE admin_options ADD listingreview varchar(25) NOT NULL ;";
$qr1="ALTER TABLE admin_options ADD fullscreenenabled varchar(25) NOT NULL DEFAULT 'true';";
$qr2="ALTER TABLE admin_options ADD enableregistercaptcha tinyint(1) NOT NULL DEFAULT '1';";
$qr3="ALTER TABLE admin_options ADD rtl tinyint(1) NOT NULL  DEFAULT '0';";
$qr4="ALTER TABLE admin_options ADD google_login tinyint(1) NOT NULL DEFAULT '1';";
$qr5="ALTER TABLE admin_options ADD yahoo_login tinyint(1) NOT NULL DEFAULT '1';";
$qr6="ALTER TABLE admin_options ADD currency_before_price tinyint(1) NOT NULL DEFAULT '1';";
$qr7="ALTER TABLE admin_options ADD jsonurl varchar(255) NOT NULL ;";
$qr8="ALTER TABLE admin_options ADD markerjsonurl varchar(255) NOT NULL ;";
$qr9="ALTER TABLE admin_options ADD listingjsonurl varchar(255) NOT NULL ;";
$qr10="ALTER TABLE admin_options ADD geoipenable varchar(25) NOT NULL ;";
$qr11="ALTER TABLE admin_options ADD emaildebug varchar(25) NOT NULL ;";
$qr12="ALTER TABLE admin_options ADD headlinelength int(11) NOT NULL DEFAULT 10 ;";
$qr13="ALTER TABLE admin_options ADD descriptionlength  int(11) NOT NULL DEFAULT 50;";
$qr14="ALTER TABLE admin_options ADD authorization_code varchar(255) NOT NULL;";
$qr15="ALTER TABLE admin_options ADD purchase_code varchar(255) NOT NULL;";
$qr16="ALTER TABLE admin_options ADD defaultcountry_latlng varchar(255) NOT NULL;";
$qr17="update admin_options set purchase_code='$purchase_code' where id like '%' ";
$qr18="update admin_options set authorization_code='$authorization_code' where id like '%' ";
$qr19="ALTER TABLE member ADD open_identity varchar(2500) NOT NULL;";
$qr20="ALTER TABLE admin_options ADD jsontexturl varchar(2500) NOT NULL;";
$qr21="ALTER TABLE listing ADD flag int NOT NULL ;";
$qr22="CREATE TABLE IF NOT EXISTS `flagging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int NOT NULL,
  `ip` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$qr23="ALTER TABLE admin_options ADD gclientid varchar(255) NOT NULL;";
$qr24="ALTER TABLE admin_options ADD gclientsecret varchar(255) NOT NULL;";
$qr25="ALTER TABLE admin_options ADD tagline varchar(500) NOT NULL;";
$qr26="ALTER TABLE pages ADD topmenu tinyint(1) NOT NULL DEFAULT '1';";
$qr27="ALTER TABLE pages ADD footermenu tinyint(1) NOT NULL DEFAULT '1';";
$qr28="ALTER TABLE admin_options ADD splashpage varchar(255) NOT NULL;";
$qr29="ALTER TABLE admin_options ADD mortgagecalculator tinyint(1) NOT NULL DEFAULT '1';";
$qr30="ALTER TABLE admin_options ADD disableregistration tinyint(1) NOT NULL DEFAULT '1';";

$_SESSION["readmin_settings"]['authorization_code']=$authorization_code;
$_SESSION["readmin_settings"]['purchase_code']=$purchase_code;

$result0=mysql_query($qr0);
$result1=mysql_query($qr1);
$result2=mysql_query($qr2);
$result3=mysql_query($qr3);
$result4=mysql_query($qr4);
$result5=mysql_query($qr5);
$result6=mysql_query($qr6);
$result7=mysql_query($qr7);
$result8=mysql_query($qr8);
$result9=mysql_query($qr9);
$result10=mysql_query($qr10);
$result11=mysql_query($qr11);
$result12=mysql_query($qr12);
$result13=mysql_query($qr13);
$result14=mysql_query($qr14);
$result15=mysql_query($qr15);
$result16=mysql_query($qr16);
$result17=mysql_query($qr17);
$result18=mysql_query($qr18);
$result19=mysql_query($qr19);
$result20=mysql_query($qr20);
$result21=mysql_query($qr21);
$result22=mysql_query($qr22);
$result23=mysql_query($qr23);
$result24=mysql_query($qr24);
$result25=mysql_query($qr25);
$result26=mysql_query($qr26);
$result27=mysql_query($qr27);
$result28=mysql_query($qr28);
$result29=mysql_query($qr29);
$result30=mysql_query($qr30);

print "<h3 align='center'>Update Finished. Please don't refresh this page. You can now delete the 'Update' folder from your website.</h3>";

}else{
print "<p align='center'>A required code is missing. Please <a href='javascript:history.go(-1);'><b>click here and try again</b></a></p>";    
}
}

function translate($dir,$host,$dbusername,$dbpassword,$dbname) {
    $i=0;
    $con=mysql_connect($host,$dbusername,$dbpassword) or die("Could not connect. Please try again.");
    mysql_select_db($dbname,$con);
    mysql_query("SET NAMES utf8");

    global $source, $overwriteOnly, $repFile;
    foreach(scandir($dir) as $filename) {
        if ($filename !== '.' AND $filename !== '..' ) {

            list($keyword,$extn)=explode(".",$filename);
            $filename=$dir."/".$filename;
            //print "Processing $filename : ";
            $fh = fopen($filename, 'r');
            while(! feof($fh)){
                $language=trim(fgets($fh));
                list($language,$temp1)=explode(":",$language);
                $translation=addslashes(trim(fgets($fh)));
                //print "$language - $translation<br />";
                $qr="insert into languages (keyword,language,translation) values ('$keyword','$language','$translation')";
                $result=mysql_query($qr);

            }
            fclose($fh);

        }
        $i++;

    }
    if($result) return true;
}

?>