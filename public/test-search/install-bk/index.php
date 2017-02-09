<?php error_reporting(0); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Easy Installation - Real Estate Made Simple</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="install-style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(function(){
$('#submitintall').click(function(){
	var host=$.trim($('input#host').val());
	var dbname=$.trim($('input#dbname').val());
	var dbusername=$.trim($('input#dbusername').val());
	var dbpassword=$.trim($('input#dbpassword').val());
	var errorMessage="Please specify: ";
	
	if(host.length<=0) errorMessage=errorMessage+"\nHost";
	if(dbname.length<=0) errorMessage=errorMessage+"\nMySQL Database Name";
	if(dbusername.length<=0) errorMessage=errorMessage+"\nMySQL Database Username";
	//if(dbpassword.length<=0) errorMessage=errorMessage+"\nMySQL Database Password";

	if(errorMessage.length>18){
	    alert(errorMessage);
	    return false;
   }else{
		return true;
	   }
});

$('#activateButton, #updateActivateButton').click(function(){
    
    var purchasecode=$.trim($("#purchasecode").val());
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
                  $("#authorizationcode").val(data[1]); 
                  if($.trim($("#authorizationcode").val())!=""){ 
                  $("#sresponse, #sresponse2").hide();
                  $("#activate").css("background-color","#0B610B");
                  $("#activate").css("color","#ffffff");
                  var purchasecode=$.trim($("#purchasecode").val());
                  $("#apurchasecode").val(purchasecode); 
                  $("#activate").html("<br /><p align='center'><b>Purchase Code Confirmed.</p><br />");
                  $("#dbform").show();
                  }else $("#sresponse").html("<br /><p style='background-color:#B40404; color:#fff; padding:5px;' align='center'><b>Please try again.</b></p>");
              }else{
                  $("#sresponse").html("<br /><p style='background-color:#B40404; color:#fff; padding:5px;' align='center'><b>Please try again.</b></p>");
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

});
</script>
</head>
<body>
<div id='container'>
<?php 
//$pathtosite=getcwd();
$parent_dir=dirname( dirname(__FILE__) );
$writableFiles=array("$parent_dir/uploads","$parent_dir/site.inc.php","$parent_dir/cache","$parent_dir/cache/index.html");
$totalFiles=sizeof($writableFiles);
$error_flag=1;
?>
<h2>Installation - Step 1</h2>
<b><a href='http://www.codiator.com/real-estate-made-simple/Help/' target='_blank'>Click Here For Help on Installation</a></b><br /><br />
<table border='0'>
<tr class='headrow'><td colspan='2'><span>Testing files/folders</span></td></tr>
<?php for($i=0;$i<$totalFiles;$i++){ ?>
<tr class='datarow'><td class='splmsg'>
<?php 
if(is_writable($writableFiles[$i])){
	print "<img src='../images/success.gif' />&nbsp;&nbsp;&nbsp;&nbsp;<b>$writableFiles[$i]</b> is writable";
}
else{
	print "<img src='../images/cross-circle.png' />&nbsp;&nbsp;&nbsp;&nbsp;<b>$writableFiles[$i]</b> is not writable.<Br /><Br />
	<font color='#A80303'>Please give write permissions:</font> <code>chmod -R 777 $writableFiles[$i]</code>";
	$error_flag=0;
}
?>
</td></tr>
<?php } ?>
<?php if($error_flag==0){ ?>
<tr class='submitrow'><td colspan='2'><input type='button' value="Try Again" onClick="javascript:location.reload(true)"></td></tr>
<?php  } ?>
</table>

<?php if($error_flag==1){ ?>
<br /><br />
<div id="activate">
<table border='0'>
<tr class='headrow'><td colspan='2'><span>Confirm Purchase Code</span></td></tr>
<tr class='datarow'><td>Item Purchase Code:</td><td><input type='text' name='purchasecode' value='' id='purchasecode' size='55' /></td></tr>
<tr class='submitrow'><td colspan='2'><input type='button' name='activate' value='Activate' id='activateButton' /></td></tr>
<tr class='datarow'><td colspan='2'><div id='sresponse' style="text-align:center; font-weight:bold;"></div></td></tr>
<tr class='datarow'><td colspan='2'><div id='sresponse2' style="text-align:center; font-weight:bold; display:none;">
<b><font color='#8A0808'>Do you want to use it on this domain?.</font></b><br /><br />
<input type='button' name='updateActivate' style="font-size: 150%; padding:5px 20px;" value='Activate for this domain' id='updateActivateButton' />        
</div></td></tr>
</table>
<br />
<b>How to find the purchase code?</b><br />
Log-in to your Codecanyon account and go to <b>Downloads </b> and click on <b>Download</b> and then click on <b>License Certificate</b> link as shown in the below given image. <br /><br />Save the <b>License Certificate</b> file and open it in notepad and locate <b>Item Purchase Code</b> and enter it above. <br /><br />The code would look like this: 88554d20c9-f0aa-4055-b87c-55ec903c4f7b  (This is a sample code)<br /><br />
<p align='center'>
    <img src='../images/licensehelp1.jpg' />
</p>
</div>
<div id="dbform" style="display:none;">
<br /><br />
<form name='installform' action='completeinstall.php' method='post'>
<table border='0'>
<tr class='headrow'><td colspan='2'><span>Install</span></td></tr>
<tr class='datarow'><td>Database Host:</td><td><input type='text' name='host' value='' id='host' size='30' /></td></tr>
<tr class='datarow'><td>MySQL Database Name:</td><td><input type='text' name='dbname' value='' id='dbname' size='30' /></td></tr>
<tr class='datarow'><td>MySQL Database Username:</td><td><input type='text' name='dbusername' value='' id='dbusername' size='30' /></td></tr>
<tr class='datarow'><td>MySQL Database Password:</td><td><input type='text' name='dbpassword' value='' id='dbpassword' size='30' />
<input type='hidden' name='apurchasecode' value='' id='apurchasecode' />     
<input type='hidden' name='authorizationcode' value='' id='authorizationcode' />    
</td></tr>
<tr class='submitrow'><td colspan='2'><input type='submit' name='submit' value='Install' id='submitintall' /></td></tr>
</table>
</form>
</div>
<?php  } ?>
</div>
</body>
</html>