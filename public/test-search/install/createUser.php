<form name='installform' action='finishInstallation.php' method='post'>
<table border='0'>
<tr class='headrow'><td colspan='2'><span>Create an Admin User</span></td></tr>
<tr class='datarow'><td>Site Admin Username:</td><td><input type='text' name='adminusername' value='' id='adminusername' size='30' /></td></tr>
<tr class='datarow'><td>Site Admin Password:</td><td><input type='text' name='adminpassword' value='' id='adminpassword' size='30' /></td></tr>
<tr class='datarow'><td>Website Name:</td><td><input type='text' name='websitename' value='' id='websitename' size='30' /></td></tr>
<tr class='submitrow'><td colspan='2'>
<input type='hidden' name='host' value='<?php print $host; ?>' />
<input type='hidden' name='dbname' value='<?php print $dbname; ?>' />
<input type='hidden' name='dbusername' value='<?php print $dbusername; ?>' />
<input type='hidden' name='dbpassword' value='<?php print $dbpassword; ?>' />
<input type='hidden' name='purchasecode' value='<?php print $purchasecode; ?>' />
<input type='hidden' name='authorizationcode' value='<?php print $authorizationcode; ?>' />
<input type='submit' name='submit' value='Finish Installation' id='finishintall' /></td></tr>
</table>
</form>