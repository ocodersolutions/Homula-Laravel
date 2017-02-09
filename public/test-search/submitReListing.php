<?php 
/*
 * Filters data through the functions registered for "addListingForm" hook.
 * Passes the content through registered functions.
 */
 
print call_plugin("addListingForm",addListingForm());

function addListingForm(){
    include("config.php");
ob_start();     
$con=mysql_connect($host,$username,$password) or die("Could not connect. Please try again.");
mysql_select_db($database,$con);
mysql_query("SET NAMES utf8");
$mem_id=$_SESSION["re_mem_id"];
$qr="select * from $rememberTable where id='$mem_id'";
$result=mysql_query($qr);
$row=mysql_fetch_assoc($result);

?>
<div id='perimeter'>
<fieldset id='submitListingPage'>
<legend>
<b><?php print $relanguage_tags["Add Listing"];?></b>
</legend>
<form action='index.php' method='post' name='addReListingForm'  class="form-horizontal" role="form" accept-charset="UTF-8">
<input type='hidden' id='isSubmitListingForm' name='isSubmitListingForm' value='1' />

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="reCategory2"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Classification"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<select name='reClassification' id='reClassification2' class="form-control" >
<option value='' selected="selected"><?php print $relanguage_tags["Select"];?></option>
<option value='Available' <?php if($reClassification=="Available") print "selected='selected'"; ?>  ><?php print $relanguage_tags["Available For Rent"];?></option>
<option value='Sale' <?php if($reClassification=="Sale") print "selected='selected'"; ?> ><?php print $relanguage_tags["Available For Sale"];?></option>
<option value='Wanted' <?php if($reClassification=="Wanted") print "selected='selected'"; ?> ><?php print $relanguage_tags["Looking For Property"];?></option>
</select>
</div> 
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Type"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<select name='reType' id='reType2' class="form-control" >
<option value='' selected="selected"><?php print $relanguage_tags["Select"];?></option>
<option value='Residential' <?php if($reType=="Residential") print "selected='selected'"; ?> ><?php print $relanguage_tags["Residential"];?></option>
<option value='Commercial' <?php if($reType=="Commercial") print "selected='selected'"; ?> ><?php print $relanguage_tags["Commercial"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Style"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<div id='reSubtypeRange'>
<select name='reSubtype' id='reSubtype2' class="form-control">
<option value='' selected="selected"><?php print $relanguage_tags["Select"];?></option>
<optgroup class='residentialopt' label="<?php print __("Residential"); ?>">
<option value="Shared"  <?php if($reSubtype=="Shared") print "selected='selected'"; ?> ><?php print $relanguage_tags["Shared"];?></option>
<option value="Bachelor"  <?php if($reSubtype=="Bachelor") print "selected='selected'"; ?> ><?php print $relanguage_tags["Bachelor"];?></option>
<option value="Hotel"  <?php if($reSubtype=="Hotel") print "selected='selected'"; ?> ><?php print $relanguage_tags["Hotel"];?>/<?php print $relanguage_tags["Motel"];?></option>
<option value="House"  <?php if($reSubtype=="House") print "selected='selected'"; ?> ><?php print $relanguage_tags["House"];?></option>
<option value="Townhouse"  <?php if($reSubtype=="Townhouse") print "selected='selected'"; ?> ><?php print $relanguage_tags["Townhouse"];?></option>
<option value="Apartment"  <?php if($reSubtype=="Apartment") print "selected='selected'"; ?> ><?php print $relanguage_tags["Apartment"];?></option>
<option value="Duplex"  <?php if($reSubtype=="Duplex") print "selected='selected'"; ?> ><?php print $relanguage_tags["Duplex"];?></option>
<option value="Triplex"  <?php if($reSubtype=="Triplex") print "selected='selected'"; ?> ><?php print $relanguage_tags["Triplex"];?></option>
<option value="Fourplex"  <?php if($reSubtype=="Fourplex") print "selected='selected'"; ?> ><?php print $relanguage_tags["Fourplex"];?></option>
<option value="Garden Home"  <?php if($reSubtype=="Garden Home") print "selected='selected'"; ?> ><?php print $relanguage_tags["Garden Home"];?></option>
<option value="Mobile Home"  <?php if($reSubtype=="Mobile Home") print "selected='selected'"; ?> ><?php print  __("Mobile Home");?></option>
<option value="Land"  <?php if($reSubtype==__("Land")) print "selected='selected'"; ?> ><?php print __("Land"); ?></option>
<option value="Special Purpose"  <?php if($reSubtype=="Special Purpose") print "selected='selected'"; ?> ><?php print $relanguage_tags["Special Purpose"];?></option>
<option value="Residential Commercial"  <?php if($reSubtype=="Residential Commercial") print "selected='selected'"; ?> ><?php print $relanguage_tags["Residential Commercial"];?></option>
</optgroup>
<optgroup class='commercialopt' label="<?php print __("Commercial"); ?>">
<option value="Office"  <?php if($reSubtype=="Office") print "selected='selected'"; ?> ><?php print $relanguage_tags["Office"];?></option>
<option value="Business"  <?php if($reSubtype=="Business") print "selected='selected'"; ?> ><?php print $relanguage_tags["Business"];?></option>
<option value="Retail"  <?php if($reSubtype=="Retail") print "selected='selected'"; ?> ><?php print $relanguage_tags["Retail"];?></option>
<option value="Land"  <?php if($reSubtype=="Land") print "selected='selected'"; ?> ><?php print $relanguage_tags["Land"];?></option>
<option value="Industrial"  <?php if($reSubtype=="Industrial") print "selected='selected'"; ?> ><?php print $relanguage_tags["Industrial"];?></option>
<option value="Institutional"  <?php if($reSubtype=="Institutional") print "selected='selected'"; ?> ><?php print $relanguage_tags["Institutional"];?></option>
<option value="Multi Home"  <?php if($reSubtype=="Multi Home") print "selected='selected'"; ?> ><?php print $relanguage_tags["Multi Home"];?></option>
<option value="Agricultural"  <?php if($reSubtype=="Agricultural") print "selected='selected'"; ?> ><?php print $relanguage_tags["Agricultural"];?></option>
<option value="Shop"  <?php if($reSubtype=="Shop") print "selected='selected'"; ?> ><?php print $relanguage_tags["Shop"];?></option>
<option value="Warehouse"  <?php if($reSubtype=="Warehouse") print "selected='selected'"; ?> ><?php print $relanguage_tags["Warehouse"];?></option>
<option value="Other Commercial"  <?php if($reSubtype=="Other Commercial") print "selected='selected'"; ?> ><?php print $relanguage_tags["Other Commercial"];?></option>
<option value="Other"  <?php if($reSubtype=="Other") print "selected='selected'"; ?> ><?php print $relanguage_tags["Other"];?></option>
</optgroup>
</select>
</div>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>


<div class="form-group">
<div class='nonCommercial'>
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Bedroom"];?>(#):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<select name='reBedrooms' id='reBedrooms2' class="form-control">
<option value='' selected="selected"><?php print $relanguage_tags["Select"];?></option>
<option value="Bachelor" ><?php print $relanguage_tags["Bachelor"];?></option>
<option value="1" >1 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="1den" >1 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>
<option value="2" >2 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="2den" >2 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>
<option value="3" >3 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="4" >4 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="5" >5 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="6" >> 6 <?php print $relanguage_tags["Bedroom"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>

<div class="form-group">
<div class='nonCommercial'>
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Bathroom"];?>(#):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<select name='reBathrooms' id='reBathrooms2' class="form-control">
<option value='' selected="selected"><?php print $relanguage_tags["Select"];?></option>
<option value="1" >1 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="1.5" >1.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="2" >2 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="2.5" >2.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="3" >3 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="3.5" >3.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="4" >4 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="4.5" >4.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="5" >5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="5.5" >5.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="6" >> 6 <?php print $relanguage_tags["Bathroom"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>


<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Listing by"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<div class="radio">
<label><?php print $relanguage_tags["Individual"];?> <input type="radio" name="relistingby" checked value="owner" /></label>
</div>
<div class="radio">
<label><?php print $relanguage_tags["Real Estate Agent"];?> <input type="radio" name="relistingby" value="reagent" /></label> 
</div>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<?php if($memtype==9){ ?>
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Listing status"];?>:</b></label>  
<font face='verdana' size='1'>(<?php print $relanguage_tags["this option is visible to admin only"];?>)</font><Br />
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<label class="radio"><?php print $relanguage_tags["Normal"];?> <input class="form-control" type="radio" name="listingexpire" id='listingNormal' checked value="normal" /></label>
<label class="radio"><?php print $relanguage_tags["Permanent"];?> <input class="form-control" type="radio" name="listingexpire" id="listingPermanent" value="permanent" /></label>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<span id='listingStatus'></span>
</div>
<?php } ?>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b> <?php print $relanguage_tags["Size"];?> (<?php print __("sq-ft"); ?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='resize' size='7' value='' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Price"];?> (<?php print $defaultCurrency; ?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='reprice' size='7' value='' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Built in"];?> (<?php print $relanguage_tags["year"];?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input  class="form-control" type='text' class='textinput' name='rebuiltin' size='7' value='' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Apt"];?> #:&nbsp;&nbsp;</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='reapt' size='10' value='' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Address"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='readdress' size='75' value='' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["City"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='recity' id='recity' value='<?php print $GLOBALS['vCity']; ?>'>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["State"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='restate'  id='restate' value='<?php print $GLOBALS['vRegion']; ?>'>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Country"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='recountry'  id='recountry' value='<?php print $GLOBALS['vCountry']; ?>'>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Postal Code"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' class='textinput' name='repostal' value=''><br>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Select custom location"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4 checkbox" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input type='checkbox' id='customLocation'  />
<p class="help-block"><font style="font-size:10px;">(<?php print  __("You will be able to choose the address by clicking on map"); ?>)</font></p>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div id='listinglatLong' style="display:none;">
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="listingLatitude"><b><?php print $relanguage_tags["Latitude"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' readonly name='latitude' id='listingLatitude' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="listingLongitude"><b><?php print $relanguage_tags["Longitude"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' readonly name='longitude' id='listingLongitude' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>

<div id='addListingMap' style="width:100%; height:400px; display:none;"></div>
<br /><br />

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Headline"];?>:</b></label>
<div class="col-sm-9 col-md-9 col-lg-9">
<input class="form-control" type='text' class='textinput' maxlength="150" name='reheadline' id='reheadline' style="width:90%;" value=''>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Description"];?>:</b></label>
<div class="col-sm-9 col-md-9 col-lg-9">
<TEXTAREA class="form-control" NAME="redescription" id='redescription' class='textinput4'  style="width:90%;" ROWS=25></TEXTAREA>
</div>
</div>

<br />
<div class='nonCommercial'>
<div class="form-group">
<div class="col-sm-3 col-md-3 col-lg-3"></div>    
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<table>
<tr><td></td>
<td><b><u><?php print $relanguage_tags["OK"];?></u></b></td>
<td width='15%'></td>
<td><b><u><?php print $relanguage_tags["Not OK"];?></u></b></td></tr>
<tr>
<td><b><?php print $relanguage_tags["Cat"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="recat" value="ok"> </td>
<td width='15%'></td>
<td><input  type="radio" name="recat" value="notok"> </td>
</tr>

<tr>
<td><b><?php print $relanguage_tags["Dog"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="redog" value="ok"> </td>
<td width='15%'></td>
<td><input type="radio" name="redog" value="notok"> </td>
</tr>

<tr>
<td><b><?php print $relanguage_tags["Smoking"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="resmoking" value="ok"> </td>
<td width='15%'></td>
<td><input type="radio" name="resmoking" value="notok"> </td>
</tr>
</table>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

</div>
<br /><br />
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Contact Information"];?>:</b></label>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Name"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' name='rename' id='rename' value='<?php print $row['name']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Phone"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' name='rephone' value='<?php print $row['phone']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Email"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' name='reemail' id='reemail' value='<?php print $row['email']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<?php if($row['website']=="") $mem_website="http://"; else $mem_website=$row['website']; ?>
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Website"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input class="form-control" type='text' name='rewebsite' size='30' value='<?php print $mem_website; ?>' />
<input class="form-control" type='hidden' name='ptype' value='myprofile' /><input type='hidden' name='formsubmit' value='1' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>


<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Address"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<textarea class="form-control" name='remyaddress' cols='25' rows='4'><?php print $row['address']; ?></textarea>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Show profile image"];?>?</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<label class="radio"><?php print $relanguage_tags["Yes"];?><input type="radio"  name="reprofileimage" id='reprofileimage'  value="yes"></label>
<label class="radio"><?php print $relanguage_tags["No"];?><input type="radio" name="reprofileimage" id='reprofileimage2' value="no"></label>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<div id='listingProfileImage'></div>
</div>

<div class="form-group">
<div class="col-sm-3 col-md-3 col-lg-3"></div>  
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<input type='hidden' name='ptype' value='addReListing' />
<input type='submit' class='btn btn-primary btn-lg' id='reAddListingButton' value='<?php print $relanguage_tags["Add Listing"];?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<p class="help-block"><font style="font-size:10px; color:red;"><?php print $relanguage_tags["Fields marked with are required"];?></font></p>
</div>

</form>
</fieldset>
</div>
<?php
return ob_get_clean();
}
?>