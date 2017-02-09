<div id='perimeter'>
<fieldset id='submitListingPage'>
<legend>
<b><?php print $relanguage_tags["Edit Listing"];?></b>
</legend>
<form action='index.php' method='post' name='editReListingForm' class="form-horizontal">
 <input class="form-control"  type='hidden' id='isSubmitListingForm' name='isSubmitListingForm' value='1' />

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="reCategory2"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Classification"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <select class="form-control"  name='reClassification' id='reClassification2' >
<option value='Available' <?php if($fullRelisting['classification']=="Available") print " selected='selected' "; ?> ><?php print $relanguage_tags["Available For Rent"];?></option>
<option value='Sale' <?php if($fullRelisting['classification']=="Sale") print " selected='selected' "; ?> ><?php print $relanguage_tags["Available For Sale"];?></option>
<option value='Wanted' <?php if($fullRelisting['classification']=="Wanted") print " selected='selected' "; ?> ><?php print $relanguage_tags["Looking For Property"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Type"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <select class="form-control"  name='reType' id='reType2'>
<option value='Residential' <?php if($fullRelisting['retype']=="Residential") print " selected='selected' "; ?> ><?php print $relanguage_tags["Residential"];?></option>
<option value='Commercial' <?php if($fullRelisting['retype']=="Commercial") print " selected='selected' "; ?> ><?php print $relanguage_tags["Commercial"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Style"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<div id='reSubtypeRange'>
 <select class="form-control"  name='reSubtype' id='reSubtype2'>
<optgroup class='residentialopt' label="<?php print __("Residential"); ?>" <?php if($fullRelisting['retype']=="Commercial"){?> style="display:none;" <?php } ?>>
<option value="Shared" <?php if($fullRelisting['subtype']== "Shared") print " selected='selected' "; ?> ><?php print $relanguage_tags["Shared"];?></option>
<option value="Bachelor" <?php if($fullRelisting['subtype']=="Bachelor") print " selected='selected' "; ?> ><?php print $relanguage_tags["Bachelor"];?></option>
<option value="Hotel" <?php if($fullRelisting['subtype']=="Hotel") print " selected='selected' "; ?> ><?php print $relanguage_tags["Hotel"];?>/<?php print $relanguage_tags["Motel"];?></option>
<option value="House" <?php if($fullRelisting['subtype']=="House") print " selected='selected' "; ?> ><?php print $relanguage_tags["House"];?></option>
<option value="Townhouse" <?php if($fullRelisting['subtype']=="Townhouse") print " selected='selected' "; ?> ><?php print $relanguage_tags["Townhouse"];?></option>
<option value="Apartment" <?php if($fullRelisting['subtype']=="Apartment") print " selected='selected' "; ?> ><?php print $relanguage_tags["Apartment"];?></option>
<option value="Duplex" <?php if($fullRelisting['subtype']=="Duplex") print " selected='selected' "; ?> ><?php print $relanguage_tags["Duplex"];?></option>
<option value="Triplex" <?php if($fullRelisting['subtype']=="Triplex") print " selected='selected' "; ?> ><?php print $relanguage_tags["Triplex"];?></option>
<option value="Fourplex" <?php if($fullRelisting['subtype']=="Fourplex") print " selected='selected' "; ?> ><?php print $relanguage_tags["Fourplex"];?></option>
<option value="Garden Home" <?php if($fullRelisting['subtype']=="Garden Home") print " selected='selected' "; ?> ><?php print $relanguage_tags["Garden Home"];?></option>
<option value="Mobile Home" <?php if($fullRelisting['subtype']=="Mobile Home") print " selected='selected' "; ?> ><?php print $relanguage_tags["Mobile Home"];?></option>
<option value="Land"  <?php if($reSubtype=="Land") print "selected='selected'"; ?> ><?php print __("Land"); ?></option>
<option value="Special Purpose" <?php if($fullRelisting['subtype']=="Special Purpose") print " selected='selected' "; ?> ><?php print $relanguage_tags["Special Purpose"];?></option>
<option value="Residential Commercial" <?php if($fullRelisting['subtype']=="Residential Commercial") print " selected='selected' "; ?> ><?php print $relanguage_tags["Residential Commercial"];?></option>
</optgroup>
<optgroup class='commercialopt' label="<?php print __("Commercial"); ?>"  <?php if($fullRelisting['retype']=="Residential"){?> style="display:none;" <?php } ?>>
<option value="Office" <?php if($fullRelisting['subtype']=="Office") print " selected='selected' "; ?> ><?php print $relanguage_tags["Office"];?></option>
<option value="Business" <?php if($fullRelisting['subtype']=="Business") print " selected='selected' "; ?> ><?php print $relanguage_tags["Business"];?></option>
<option value="Retail" <?php if($fullRelisting['subtype']=="Retail") print " selected='selected' "; ?> ><?php print $relanguage_tags["Retail"];?></option>
<option value="Land" <?php if($fullRelisting['subtype']=="Land") print " selected='selected' "; ?> ><?php print $relanguage_tags["Land"];?></option>
<option value="Industrial" <?php if($fullRelisting['subtype']=="Industrial") print " selected='selected' "; ?> ><?php print $relanguage_tags["Industrial"];?></option>
<option value="Institutional" <?php if($fullRelisting['subtype']=="Institutional") print " selected='selected' "; ?> ><?php print $relanguage_tags["Institutional"];?></option>
<option value="Multi Home" <?php if($fullRelisting['subtype']=="Multi Home") print " selected='selected' "; ?> ><?php print $relanguage_tags["Multi Home"];?></option>
<option value="Agricultural" <?php if($fullRelisting['subtype']=="Agricultural") print " selected='selected' "; ?> ><?php print $relanguage_tags["Agricultural"];?></option>
<option value="Shop" <?php if($fullRelisting['subtype']=="Shop") print " selected='selected' "; ?> ><?php print $relanguage_tags["Shop"];?></option>
<option value="Warehouse" <?php if($fullRelisting['subtype']=="Warehouse") print " selected='selected' "; ?> ><?php print $relanguage_tags["Warehouse"];?></option>
<option value="Other Commercial" <?php if($fullRelisting['subtype']=="Other Commercial") print " selected='selected' "; ?> ><?php print $relanguage_tags["Other Commercial"];?></option>
</optgroup>
</select>
</div>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<?php //if($fullRelisting['subtype']!="Land"){ ?>
<div class="form-group">
<div class='nonCommercial' <?php if($fullRelisting['retype']=="Commercial"){ print " style='display:none' "; } ?> >
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Bedroom"];?>(#):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <select class="form-control"  name='reBedrooms' id='reBedrooms2'>
<option value="Bachelor" <?php if($fullRelisting['bedrooms']=="bachelor") print " selected='selected' "; ?>  ><?php print $relanguage_tags["Bachelor"];?></option>
<option value="1" <?php if($fullRelisting['bedrooms']=="1") print " selected='selected' "; ?>  >1 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="1den" <?php if($fullRelisting['bedrooms']=="1den") print " selected='selected' "; ?>  >1 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>
<option value="2" <?php if($fullRelisting['bedrooms']=="2") print " selected='selected' "; ?>  >2 <?php print $relanguage_tags["Bedroom"];?>s</option>
<option value="2den" <?php if($fullRelisting['bedrooms']=="2den") print " selected='selected' "; ?>  >2 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>
<option value="3" <?php if($fullRelisting['bedrooms']=="3") print " selected='selected' "; ?>  >3 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="4" <?php if($fullRelisting['bedrooms']=="4") print " selected='selected' "; ?>  >4 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="5" <?php if($fullRelisting['bedrooms']=="5") print " selected='selected' "; ?>  >5 <?php print $relanguage_tags["Bedroom"];?></option>
<option value="6" <?php if($fullRelisting['bedrooms']=="6") print " selected='selected' "; ?>  >>6 <?php print $relanguage_tags["Bedroom"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>

<div class="form-group">
<div class='nonCommercial' <?php if($fullRelisting['retype']=="Commercial"){ print " style='display:none' "; } ?> >
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Bathroom"];?>(#):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <select class="form-control"  name='reBathrooms' id='reBathrooms2'>
<option value="1" <?php if($fullRelisting['bathrooms']=="1") print " selected='selected' "; ?>  >1 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="1.5" <?php if($fullRelisting['bathrooms']=="1.5") print " selected='selected' "; ?>  >1.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="2" <?php if($fullRelisting['bathrooms']=="2") print " selected='selected' "; ?>  >2 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="2.5" <?php if($fullRelisting['bathrooms']=="2.5") print " selected='selected' "; ?>  >2.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="3" <?php if($fullRelisting['bathrooms']=="3") print " selected='selected' "; ?>  >3 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="3.5" <?php if($fullRelisting['bathrooms']=="3.5") print " selected='selected' "; ?>  >3.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="4" <?php if($fullRelisting['bathrooms']=="4") print " selected='selected' "; ?>  >4 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="4.5" <?php if($fullRelisting['bathrooms']=="4.5") print " selected='selected' "; ?>  >4.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="5" <?php if($fullRelisting['bathrooms']=="5") print " selected='selected' "; ?>  >5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="5.5" <?php if($fullRelisting['bathrooms']=="5.5") print " selected='selected' "; ?>  >5.5 <?php print $relanguage_tags["Bathroom"];?></option>
<option value="6" <?php if($fullRelisting['bathrooms']=="6") print " selected='selected' "; ?>  >6 or more <?php print $relanguage_tags["Bathroom"];?></option>
</select>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>
<?php //} ?>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Listing by"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<label class="radio"><?php print $relanguage_tags["Individual"];?>  <input type="radio" name="relistingby"  <?php if($fullRelisting['relistingby']=="owner") print " checked "; ?> value="owner" /></label>
<label class="radio"><?php print $relanguage_tags["Real Estate Agent"];?>  <input type="radio" name="relistingby" <?php if($fullRelisting['relistingby']=="reagent") print " checked "; ?>  value="reagent" /></label>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<?php if($memtype==9){ ?>
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Listing status"];?>:</b></label>  
<font face='verdana' size='1'>(<?php print $relanguage_tags["this option is visible to admin only"];?>)</font><Br />
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<label class="radio"><?php print $relanguage_tags["Normal"];?>  <input type="radio" name="listingexpire" id='listingNormal' <?php if($fullRelisting['listing_expire']=="normal") print "checked"; ?> value="normal" /></label>
<label class="radio"><?php print $relanguage_tags["Permanent"];?>  <input type="radio" name="listingexpire" id="listingPermanent"<?php if($fullRelisting['listing_expire']=="permanent") print "checked"; ?>  value="permanent" /></label>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<span id='listingStatus'></span>
</div>
<?php } ?>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b> <?php print $relanguage_tags["Size"];?> (<?php print __("sq-ft"); ?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='resize' size='7' value='<?php print $fullRelisting['resize']; ?>' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Price"];?> (<?php print $defaultCurrency; ?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='reprice' size='7' value='<?php print $fullRelisting['price']; ?>' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Built in"];?> (<?php print $relanguage_tags["year"];?>):</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='rebuiltin' size='7' value='<?php print $fullRelisting['builtin']; ?>' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Apt"];?> #:&nbsp;&nbsp;</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='reapt' size='10' value='<?php print $fullRelisting['apt']; ?>' onkeyup="if(this.value.match(/[^0-9 ]/g)) { this.value = this.value.replace(/[^0-9 ]/g, '');}" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Address"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='readdress' size='75' value="<?php print $fullRelisting['address']; ?>" />
 <input class="form-control"  type='hidden' name='readdress2' id='readdress2' size='75' value="<?php print $fullRelisting['address']; ?>" />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["City"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='recity' id='recity' value="<?php print $fullRelisting['city']; ?>">
 <input class="form-control"  type='hidden' name='recity2'  id='recity2' value="<?php print $fullRelisting['city']; ?>">
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["State"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='restate'  id='restate' value="<?php print $fullRelisting['state']; ?>">
 <input class="form-control"  type='hidden' name='restate2'  id='restate2' value="<?php print $fullRelisting['state']; ?>">
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Country"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='recountry'  id='recountry' value='<?php print $fullRelisting['country']; ?>'>
 <input class="form-control"  type='hidden' name='recountry2'  id='recountry2' value="<?php print $fullRelisting['country']; ?>">
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Postal Code"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' class='textinput' name='repostal' value='<?php print $fullRelisting['postal']; ?>'><br>
 <input class="form-control"  type='hidden' name='repostal2' id='repostal' value='<?php print $fullRelisting['postal']; ?>'>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Select custom location"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4 checkbox" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> > <input type='checkbox' id='customLocation'  />
<p class="help-block"><font style="font-size:10px;">(<?php print  __("You will be able to choose the address by clicking on map");?>)</font></p>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div id='listinglatLong' style="display:none;">
<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="listingLatitude"><b><?php print $relanguage_tags["Latitude"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' readonly name='latitude' value='<?php print $fullRelisting['latitude']; ?>' id='listingLatitude' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label" for="listingLatitude"><b><?php print $relanguage_tags["Longitude"];?>:</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' readonly name='longitude' value='<?php print $fullRelisting['longitude']; ?>' id='listingLongitude' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>
</div>

<div id='addListingMap' style="width:100%; height:400px; display:none;"></div>
<br /><br />

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Headline"];?>:</b></label>
<div class="col-sm-9 col-md-9 col-lg-9">
 <input class="form-control"  type='text' maxlength="150" class='textinput' name='reheadline' id='reheadline' style="width:90%;" value="<?php print $fullRelisting['headline']; ?>">
</div>

</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Description"];?>:</b></label>
<div class="col-sm-9 col-md-9 col-lg-9">
<TEXTAREA NAME="redescription" id='redescription' class="form-control"  style="width:90%;" ROWS=25><?php print $fullRelisting['description']; ?></TEXTAREA>
</div>

</div>

<br />
<div class='nonCommercial'>
<div class="form-group">
<div class="col-sm-3 col-md-3 col-lg-3"></div>    
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<?php if($fullRelisting['retype']=="Residential"){ ?>
<table>
<tr><td></td>
<td><b><u><?php print $relanguage_tags["OK"];?></u></b></td>
<td width='15%'></td>
<td><b><u><?php print $relanguage_tags["Not OK"];?></u></b></td></tr>
<tr>
<td><b><?php print $relanguage_tags["Cat"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="recat" value="ok"  <?php if($fullRelisting['cats']=="ok") print " checked "; ?> > </td>
<td width='15%'></td>
<td> <input type="radio" name="recat" value="notok" <?php if($fullRelisting['cats']=="notok") print " checked "; ?> > </td>
</tr>

<tr>
<td><b><?php print $relanguage_tags["Dog"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="redog" value="ok" <?php if($fullRelisting['dogs']=="ok") print " checked "; ?> > </td>
<td width='15%'></td>
<td> <input type="radio" name="redog" value="notok" <?php if($fullRelisting['dogs']=="notok") print " checked "; ?> > </td>
</tr>

<tr>
<td><b><?php print $relanguage_tags["Smoking"];?></b></td>
<td>&nbsp;&nbsp;<input type="radio" name="resmoking" value="ok" <?php if($fullRelisting['smoking']=="ok") print " checked "; ?> > </td>
<td width='15%'></td>
<td> <input type="radio" name="resmoking" value="notok" <?php if($fullRelisting['smoking']=="notok") print " checked "; ?> > </td>
</tr>
</table>
<?php } ?>
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
 <input class="form-control"  type='text' name='rename' id='rename' value='<?php print $fullRelisting['contact_name']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Phone"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' name='rephone' value='<?php print $fullRelisting['contact_phone']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><span class='required_field'><sup>*</sup></span><b><?php print $relanguage_tags["Email"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input class="form-control"  type='text' name='reemail' id='reemail' value='<?php print $fullRelisting['contact_email']; ?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Website"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> ><?php if($fullRelisting['contact_website']=="")$fullRelisting['contact_website']="http://"; ?>
 <input class="form-control"  type='text' name='rewebsite' size='30' value='<?php print $fullRelisting['contact_website']; ?>' />
 <input class="form-control"  type='hidden' name='ptype' value='myprofile' /> <input class="form-control"  type='hidden' name='formsubmit' value='1' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Address"];?></b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<textarea name='remyaddress' cols='25' rows='4'><?php print $fullRelisting['contact_address']; ?></textarea>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
</div>

<div class="form-group">
<label class="col-sm-3 col-md-3 col-lg-3 control-label"><b><?php print $relanguage_tags["Show profile image"];?>?</b></label>
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
<label class="radio"><?php print $relanguage_tags["Yes"];?>
 <input type="radio"  <?php if($fullRelisting['show_image']=="yes") print " checked "; ?>  name="reprofileimage" id='reprofileimage'  value="yes"></label>
<label class="radio"><?php print $relanguage_tags["No"];?> <input type="radio" name="reprofileimage" id='reprofileimage2'  <?php if($fullRelisting['show_image']=="no") print " checked "; ?>   value="no"></label>
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<div id='listingProfileImage'></div>
</div>

<div class="form-group">
<div class="col-sm-3 col-md-3 col-lg-3"></div>  
<div class="col-sm-4 col-md-4 col-lg-4" <?php if(isset($_SESSION['rtl']) && $_SESSION['rtl']==true) print " style='float:right;' "; ?> >
 <input  type='hidden' name='ptype' value='updateReListing' />
 <input  type='hidden' name='listingtype' value='<?php print $fullRelisting['listing_type']; ?>' />
 <input  type='hidden' name='reid' value='<?php print $fullRelisting['id']; ?>' />
 <input  type='submit' class='btn btn-primary btn-lg' id='reAddListingButton' value='<?php print $relanguage_tags["Update Listing"];?>' />
</div>
<div class="col-sm-5 col-md-5 col-lg-5"></div>
<p class="help-block"><font style="font-size:10px; color:red;"><?php print $relanguage_tags["Fields marked with are required"];?></font></p>
</div>

</form>
</fieldset>
</div>