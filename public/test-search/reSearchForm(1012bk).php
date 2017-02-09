<?php 
if($ctype=="") $reClassification=htmlspecialchars($_POST['classification'], ENT_QUOTES, 'UTF-8');
else $reClassification[0]=$ctype;
$reType=htmlspecialchars($_POST['reType'], ENT_QUOTES, 'UTF-8');

$reSubtype=htmlspecialchars($_POST['reSubtype'], ENT_QUOTES, 'UTF-8');
$reBedrooms=htmlspecialchars($_POST['rebedrooms'], ENT_QUOTES, 'UTF-8');
$reBathrooms=htmlspecialchars($_POST['rebathrooms'], ENT_QUOTES, 'UTF-8');
$rePrice=htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');
if($reQuery=="") $reQuery=htmlspecialchars(trim($_POST['requery']), ENT_QUOTES, 'UTF-8');
if($reCity=="" && $reCity!="any") $reCity=htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');

$any=$residential=$commercial=true;
if($reClassification=="") $reClassification=explode(",",$_SESSION["reClassification"]);
if($reType=="") 
{ 
	if($_GET["reType"] != '')
	{
		$reType = array($_GET["reType"]);
	}
	else
	{
		$reType=explode(",",$_SESSION["reType"]);
	}
}
if($reSubtype=="") $reSubtype=explode(",",$_SESSION["reSubtype"]);
if($reBedrooms=="") 
{
	if($_GET["reBedrooms"] != ''){
		$reBedrooms = array($_GET["reBedrooms"]);
	}
	else
	{
		$reBedrooms=explode(",",$_SESSION["reBedrooms"]);
	}
}
if($reBathrooms=="") 
{
	if($_GET["reBedrooms"] != '')
	{
		$reBathrooms = array($_GET["reBedrooms"]);
	}
	else
	{
		$reBathrooms=explode(",",$_SESSION["reBathrooms"]);
	}
}
if($rePrice=="") 
{
	if($_GET["rePrice"] != '')
	{
		//$rePrice = array($_GET["rePrice"]); 
		$rePrice = $_GET["rePrice"]; 
	}
	else
	{
		$rePrice=explode(",",$_SESSION["rePrice"]);
	}
}
if($reQuery=="") $reQuery=$_SESSION["reQuery"];
if($reCity=="") $reCity=$_SESSION["reCity"];
if($reCity=="any") $reCity="";

?>
<form id='reForm' method='post' name='form2' action='index.php' enctype="multipart/form-data" >
  <table>
    <tr>
      <td  style="vertical-align: top" ><select name='classification[]' multiple id='reClassification' onChange="javascript:showhideprice();" >
          <option value='<?php print $relanguage_tags["Any"];?>' <?php if(in_array($relanguage_tags["Any"],$reClassification) || $reClassification[0]=="Any") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any"];?></option>
          <!--
          <option value='<?php print $relanguage_tags["Available"];?>' <?php if(in_array($relanguage_tags["Available"],$reClassification)) print "selected='selected'"; ?>  ><?php print $relanguage_tags["Available For Rent"];?></option>
          <option value='<?php print $relanguage_tags["Sale"];?>' <?php if(in_array($relanguage_tags["Sale"],$reClassification)) print "selected='selected'"; ?> ><?php print $relanguage_tags["Available For Sale"];?></option>
          <option value='<?php print $relanguage_tags["Wanted"];?>' <?php if(in_array($relanguage_tags["Wanted"],$reClassification)) print "selected='selected'"; ?> ><?php print $relanguage_tags["Looking For Property"];?></option>
          -->
          <option value='Sale' <?php if(in_array($relanguage_tags["Sale"],$reClassification) || $reClassification[0]=="") print "selected='selected'"; ?> >Available For Buy</option>
          <option value='Rent' <?php if(in_array($relanguage_tags["Available"],$reClassification)) print "selected='selected'"; ?>  ><?php print $relanguage_tags["Available For Rent"];?></option>
        </select>
        <br />
        <br />
        <select name='retype[]' multiple id='reType'>
          <!--<option value='<?php print $relanguage_tags["Any"];?>' <?php if(in_array($relanguage_tags["Any"],$reType) || $reType[0]=="" || $reType[0]=="Any") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any"];?></option>-->
          <option value='<?php print $relanguage_tags["Any"];?>' <?php if(in_array($relanguage_tags["Any"],$reType) || $reType[0] == "Any") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any"];?></option>
          <option value='<?php print $relanguage_tags["Residential"];?>' <?php if(in_array($relanguage_tags["Residential"],$reType)){ print "selected='selected'";} ?> ><?php print $relanguage_tags["Residential"];?></option>
          <option value='<?php print $relanguage_tags["Commercial"];?>' <?php if(in_array($relanguage_tags["Commercial"],$reType)) print "selected='selected'"; ?> ><?php print $relanguage_tags["Commercial"];?></option>
        </select></td>
    </tr>
    <!--<tr>
      <td   style="vertical-align: top" ><br>
        <div id='reSubtypeRange' class='allStyle'>
          <select name='reSubtype[]' multiple id='reSubtype'>
            <option value='<?php print $relanguage_tags["Any"];?>'  <?php if((in_array($relanguage_tags["Any"],$reSubtype) || $reSubtype[0]=="" || $reSubtype[0]=="Any") && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Any"];?></option>
            <optgroup label="<?php print __("Residential"); ?>">
            <option value="<?php print $relanguage_tags["Shared"];?>"  <?php if(in_array($relanguage_tags["Shared"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Shared"];?></option>
            <option value="<?php print $relanguage_tags["Bachelor"];?>"  <?php if(in_array($relanguage_tags["Bachelor"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Bachelor"];?></option>
            <option value="<?php print $relanguage_tags["Hotel"];?>"  <?php if(in_array($relanguage_tags["Hotel"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Hotel"];?>/<?php print $relanguage_tags["Motel"];?></option>
            <option value="<?php print $relanguage_tags["House"];?>"  <?php if(in_array($relanguage_tags["House"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["House"];?></option>
            <option value="<?php print $relanguage_tags["Townhouse"];?>"  <?php if(in_array($relanguage_tags["Townhouse"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Townhouse"];?></option>
            <option value="<?php print $relanguage_tags["Apartment"];?>"  <?php if(in_array($relanguage_tags["Apartment"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Apartment"];?></option>
            <option value="<?php print $relanguage_tags["Duplex"];?>"  <?php if(in_array($relanguage_tags["Duplex"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Duplex"];?></option>
            <option value="<?php print $relanguage_tags["Triplex"];?>"  <?php if(in_array($relanguage_tags["Triplex"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Triplex"];?></option>
            <option value="<?php print $relanguage_tags["Fourplex"];?>"  <?php if(in_array($relanguage_tags["Fourplex"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Fourplex"];?></option>
            <option value="<?php print $relanguage_tags["Garden Home"];?>"  <?php if(in_array($relanguage_tags["Garden Home"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Garden Home"];?></option>
            <option value="<?php print $relanguage_tags["Mobile Home"];?>"  <?php if(in_array($relanguage_tags["Mobile Home"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Mobile Home"];?></option>
            <option value="<?php print $relanguage_tags["Special Purpose"];?>"  <?php if(in_array($relanguage_tags["Special Purpose"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Special Purpose"];?></option>
            <option value="<?php print $relanguage_tags["Residential Commercial"];?>"  <?php if(in_array($relanguage_tags["Residential Commercial"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Residential Commercial"];?></option>
            </optgroup>
            <optgroup label="<?php print __("Commercial"); ?>">
            <option value="<?php print $relanguage_tags["Office"];?>"  <?php if(in_array($relanguage_tags["Office"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Office"];?></option>
            <option value="<?php print $relanguage_tags["Business"];?>"  <?php if(in_array($relanguage_tags["Business"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Business"];?></option>
            <option value="<?php print $relanguage_tags["Retail"];?>"  <?php if(in_array($relanguage_tags["Retail"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Retail"];?></option>
            <option value="<?php print $relanguage_tags["Land"];?>"  <?php if(in_array($relanguage_tags["Land"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Land"];?></option>
            <option value="<?php print $relanguage_tags["Industrial"];?>"  <?php if(in_array($relanguage_tags["Industrial"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Industrial"];?></option>
            <option value="<?php print $relanguage_tags["Institutional"];?>"  <?php if(in_array($relanguage_tags["Institutional"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Institutional"];?></option>
            <option value="<?php print $relanguage_tags["Multi Home"];?>"  <?php if(in_array($relanguage_tags["Multi Home"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Multi Home"];?></option>
            <option value="<?php print $relanguage_tags["Agricultural"];?>"  <?php if(in_array($relanguage_tags["Agricultural"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Agricultural"];?></option>
            <option value="<?php print $relanguage_tags["Shop"];?>"  <?php if(in_array($relanguage_tags["Shop"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Shop"];?></option>
            <option value="<?php print $relanguage_tags["Warehouse"];?>"  <?php if(in_array($relanguage_tags["Warehouse"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Warehouse"];?></option>
            <option value="<?php print $relanguage_tags["Other Commercial"];?>"  <?php if(in_array($relanguage_tags["Other Commercial"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Other Commercial"];?></option>
            <option value="<?php print $relanguage_tags["Other"];?>"  <?php if(in_array($relanguage_tags["Other"],$reSubtype) && $any) print "selected='selected'"; ?> ><?php print $relanguage_tags["Other"];?></option>
            </optgroup>
          </select>
        </div>
        <div class='onlyResidential'>
          <select name='reSubtype2[]' multiple id='reSubtypeResidential'>
            <!--<option value='<?php print $relanguage_tags["Any"];?>'   ><?php print $relanguage_tags["Any"];?></option>--> 
    <!--<option value="<?php print $relanguage_tags["Shared"];?>"  <?php if(in_array($relanguage_tags["Shared"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Shared"];?></option>
            <option value="<?php print $relanguage_tags["Bachelor"];?>"  <?php if(in_array($relanguage_tags["Bachelor"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Bachelor"];?></option>
            <option value="<?php print $relanguage_tags["Hotel"];?>"  <?php if(in_array($relanguage_tags["Hotel"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Hotel"];?>/<?php print $relanguage_tags["Motel"];?></option>
            <option value="<?php print $relanguage_tags["House"];?>"  <?php if(in_array($relanguage_tags["House"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["House"];?></option>
            <option value="<?php print $relanguage_tags["Townhouse"];?>"  <?php if(in_array($relanguage_tags["Townhouse"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Townhouse"];?></option>
            <option value="<?php print $relanguage_tags["Apartment"];?>"  <?php if(in_array($relanguage_tags["Apartment"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Apartment"];?></option>
            <option value="<?php print __("Land"); ?>"  <?php if(in_array(__("Land"),$reSubtype) && $residential)  print "selected='selected'"; ?> >Land</option>
            <option value="<?php print $relanguage_tags["Duplex"];?>"  <?php if(in_array($relanguage_tags["Duplex"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Duplex"];?></option>
            <option value="<?php print $relanguage_tags["Triplex"];?>"  <?php if(in_array($relanguage_tags["Triplex"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Triplex"];?></option>
            <option value="<?php print $relanguage_tags["Fourplex"];?>"  <?php if(in_array($relanguage_tags["Fourplex"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Fourplex"];?></option>
            <option value="<?php print $relanguage_tags["Garden Home"];?>"  <?php if(in_array($relanguage_tags["Garden Home"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Garden Home"];?></option>
            <option value="<?php print $relanguage_tags["Mobile Home"];?>"  <?php if(in_array($relanguage_tags["Mobile Home"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Mobile Home"];?></option>
            <option value="<?php print $relanguage_tags["Special Purpose"];?>"  <?php if(in_array($relanguage_tags["Special Purpose"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Special Purpose"];?></option>
            <option value="<?php print $relanguage_tags["Residential Commercial"];?>"  <?php if(in_array($relanguage_tags["Residential Commercial"],$reSubtype) && $residential) print "selected='selected'"; ?> ><?php print $relanguage_tags["Residential Commercial"];?></option>
          </select>
        </div>
        <div class='onlyCommercial'>
          <select name='reSubtype3[]' multiple id='reSubtypeCommercial'>--> 
    <!--<option value='<?php print $relanguage_tags["Any"];?>'   ><?php print $relanguage_tags["Any"];?></option>--> 
    <!--<option value="<?php print $relanguage_tags["Office"];?>"  <?php if(in_array($relanguage_tags["Office"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Office"];?></option>
            <option value="<?php print $relanguage_tags["Business"];?>"  <?php if(in_array($relanguage_tags["Business"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Business"];?></option>
            <option value="<?php print $relanguage_tags["Retail"];?>"  <?php if(in_array($relanguage_tags["Retail"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Retail"];?></option>
            <option value="<?php print $relanguage_tags["Land"];?>"  <?php if(in_array($relanguage_tags["Land"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Land"];?></option>
            <option value="<?php print $relanguage_tags["Industrial"];?>"  <?php if(in_array($relanguage_tags["Industrial"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Industrial"];?></option>
            <option value="<?php print $relanguage_tags["Institutional"];?>"  <?php if(in_array($relanguage_tags["Institutional"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Institutional"];?></option>
            <option value="<?php print $relanguage_tags["Multi Home"];?>"  <?php if(in_array($relanguage_tags["Multi Home"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Multi Home"];?></option>
            <option value="<?php print $relanguage_tags["Agricultural"];?>"  <?php if(in_array($relanguage_tags["Agricultural"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Agricultural"];?></option>
            <option value="<?php print $relanguage_tags["Shop"];?>"  <?php if(in_array($relanguage_tags["Shop"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Shop"];?></option>
            <option value="<?php print $relanguage_tags["Warehouse"];?>"  <?php if(in_array($relanguage_tags["Warehouse"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Warehouse"];?></option>
            <option value="<?php print $relanguage_tags["Other Commercial"];?>"  <?php if(in_array($relanguage_tags["Other Commercial"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Other Commercial"];?></option>
            <option value="<?php print $relanguage_tags["Other"];?>"  <?php if(in_array($relanguage_tags["Other"],$reSubtype) && $commercial) print "selected='selected'"; ?> ><?php print $relanguage_tags["Other"];?></option>
          </select>
        </div></td>
    </tr>-->
    <tr>
      <td  style="vertical-align: top" ><div class='nonCommercial' <?php if(!$residential) print " style='display:none' "; else print " style='display:block' "; ?>>
        <br>
        <select name='rebedrooms[]' multiple id='reBedrooms'>
          <!--<option value='<?php print $relanguage_tags["Any"];?>' <?php if(in_array($relanguage_tags["Any"],$reBedrooms) || $reBedrooms[0]=="" || $reBedrooms[0]=="Any") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any"];?></option>-->
          <option value="1" <?php if(in_array("1",$reBedrooms)) print "selected='selected'"; ?>>1 <?php print $relanguage_tags["Bedroom"];?></option>
          <!--<option value="1den" <?php if(in_array("1den",$reBedrooms)) print "selected='selected'"; ?>>1 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>-->
          <option value="2" <?php if(in_array("2",$reBedrooms)) print "selected='selected'"; ?>>2 <?php print $relanguage_tags["Bedroom"];?></option>
          <!--<option value="2den" <?php if(in_array("2den",$reBedrooms)) print "selected='selected'"; ?>>2 <?php print $relanguage_tags["Bedroom"]." ".$relanguage_tags["and"]." ".$relanguage_tags["den"];?></option>-->
          <option value="3" <?php if(in_array("3",$reBedrooms)) print "selected='selected'"; ?>>3 <?php print $relanguage_tags["Bedroom"];?></option>
          <option value="4" <?php if(in_array("4",$reBedrooms)) print "selected='selected'"; ?>>4 <?php print $relanguage_tags["Bedroom"];?></option>
          <option value="5" <?php if(in_array("5",$reBedrooms)) print "selected='selected'"; ?>>5 <?php print $relanguage_tags["Bedroom"];?></option>
          <option value="6" <?php if(in_array("6",$reBedrooms)) print "selected='selected'"; ?>>> 6 <?php print $relanguage_tags["Bedroom"];?></option>
        </select>
        <br />
        <br />
        <select name='rebathrooms[]' multiple id='reBathrooms'>
          <!--<option value='<?php print $relanguage_tags["Any"];?>' <?php if(in_array($relanguage_tags["Any"],$reBathrooms) || $reBathrooms[0]=="" || $reBathrooms[0]=="Any") print "selected='selected'"; ?>><?php print $relanguage_tags["Any"];?></option>-->
          <option value="1" <?php if(in_array("1",$reBathrooms)) print "selected='selected'"; ?> >1 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="1.5" <?php if(in_array("1.5",$reBathrooms)) print "selected='selected'"; ?> >1.5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="2" <?php if(in_array("2",$reBathrooms)) print "selected='selected'"; ?>>2 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="2.5" <?php if(in_array("2.5",$reBathrooms)) print "selected='selected'"; ?>>2.5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="3" <?php if(in_array("3",$reBathrooms)) print "selected='selected'"; ?>>3 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="3.5" <?php if(in_array("3.5",$reBathrooms)) print "selected='selected'"; ?>>3.5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="4" <?php if(in_array("4",$reBathrooms)) print "selected='selected'"; ?>>4 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="4.5" <?php if(in_array("4.5",$reBathrooms)) print "selected='selected'"; ?>>4.5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="5" <?php if(in_array("5",$reBathrooms)) print "selected='selected'"; ?>>5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="5.5" <?php if(in_array("5.5",$reBathrooms)) print "selected='selected'"; ?>>5.5 <?php print $relanguage_tags["Bathroom"];?></option>
          <option value="6" <?php if(in_array("6",$reBathrooms)) print "selected='selected'"; ?>>> 6 <?php print $relanguage_tags["Bathroom"];?></option>
        </select></td>
        </div>
    </tr>
    <tr>
      <td><br>
        <div id='rePriceRange'>
          <select name="price[]" multiple id="rePrice">
            <optgroup id="rentprice" label="<?php print __("Rent / Lease"); ?>"> 
            <!--<option value="10"  <?php if(in_array(10,$rePrice) || $rePrice[0]=="") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any Range"];?></option>-->
            <?php 
			for($i=0;$i<$rentRangeSize;$i++){
				list($opriceFrom,$opriceTo)=explode("-",$rentPriceRange[$i]);
				if($opriceTo=="Above") $opricerange=$opriceFrom."-".__("Above");
				else $opricerange=$rentPriceRange[$i]; 
				list($priceFrom,$priceTo)=explode("-",$rentPriceRange[$i]);
				
				if(trim($priceFrom)!="" && $priceTo!=""){
					if($priceTo!="Above"){
						if($currency_before_price) $priceTo=$defaultCurrency.$priceTo;
					  	else $priceTo=$priceTo." ".$defaultCurrency;
					}    
					if($priceTo=="Above") $priceToTrans=__($priceTo); else $priceToTrans=$priceTo;
					if($currency_before_price) $priceFrom=$defaultCurrency.$priceFrom;
					else $priceFrom=$priceFrom." ".$defaultCurrency; 
				?>
            <option class='rent_options' value="<?php print str_replace("Above", __("Above"), $rentPriceRange[$i]); ?>" <?php if($rePrice[0]!="" && in_array($opricerange,$rePrice)) print "selected='selected'"; ?> ><?php print $priceFrom." - ".$priceToTrans; ?></option>
            <?php 
				}  
			} 
			$priceFrom="";
			$priceTo="";
			?>
            </optgroup>
            <optgroup id="sellprice" label="<?php print __("Sale"); ?>">
            <?php 
			for($i=0;$i<$saleRangeSize;$i++){
             list($spriceFrom,$spriceTo)=explode("-",$saleRangeSize[$i]);
             if($spriceTo=="Above") $spricerange=$spriceFrom."-".__("Above");
             else $spricerange=$saleRangeSize[$i]; 
 
			 list($priceFrom,$priceTo)=explode("-",$salePriceRange[$i]);
			 
				 if(trim($priceFrom)!="" && $priceTo!=""){
					 if($priceTo!="Above"){
					  if($currency_before_price) $priceTo=$defaultCurrency.$priceTo;
					  else $priceTo=$priceTo." ".$defaultCurrency;
					 }    
					 if($priceTo=="Above") $priceToTrans=__($priceTo); else $priceToTrans=$priceTo;
					 if($currency_before_price) $priceFrom=$defaultCurrency.$priceFrom;
					 else $priceFrom=$priceFrom." ".$defaultCurrency;  
				 ?>
				<option value="<?php print str_replace("Above", __("Above"), $salePriceRange[$i]); ?>" <?php if($rePrice[0]!="" && in_array($spricerange,$rePrice)) print "selected='selected'"; ?> ><?php print $priceFrom." - ".$priceToTrans; ?></option>
				<?php  
				} 
			} ?>
            </optgroup>
          </select>
          <select name="pricen[]" multiple id="rePricen" style="display:none">
            <optgroup id="rentpricen" label="<?php print __("Rent / Lease"); ?>"> 
            <!--<option value="10"  <?php if(in_array(10,$rePrice) || $rePrice[0]=="") print "selected='selected'"; ?> ><?php print $relanguage_tags["Any Range"];?></option>-->
            <?php 
			for($i=0;$i<$rentRangeSize;$i++){
				list($opriceFrom,$opriceTo)=explode("-",$rentPriceRange[$i]);
				if($opriceTo=="Above") $opricerange=$opriceFrom."-".__("Above");
				else $opricerange=$rentPriceRange[$i]; 
				list($priceFrom,$priceTo)=explode("-",$rentPriceRange[$i]);
				
				if(trim($priceFrom)!="" && $priceTo!=""){
					if($priceTo!="Above"){
						if($currency_before_price) $priceTo=$defaultCurrency.$priceTo;
					  	else $priceTo=$priceTo." ".$defaultCurrency;
					}    
					if($priceTo=="Above") $priceToTrans=__($priceTo); else $priceToTrans=$priceTo;
					if($currency_before_price) $priceFrom=$defaultCurrency.$priceFrom;
					else $priceFrom=$priceFrom." ".$defaultCurrency; 
				?>
            <option class='rent_options' value="<?php print str_replace("Above", __("Above"), $rentPriceRange[$i]); ?>" <?php if($rePrice[0]!="" && in_array($opricerange,$rePrice)) print "selected='selected'"; ?> ><?php print $priceFrom." - ".$priceToTrans; ?></option>
            <?php 
				}  
			} 
			$priceFrom="";
			$priceTo="";
			?>
            </optgroup>
            <optgroup id="sellpricen" label="<?php print __("Sale"); ?>">
            <?php for($i=0;$i<$saleRangeSize;$i++){
             list($spriceFrom,$spriceTo)=explode("-",$saleRangeSize[$i]);
             if($spriceTo=="Above") $spricerange=$spriceFrom."-".__("Above");
             else $spricerange=$saleRangeSize[$i]; 
 
			 list($priceFrom,$priceTo)=explode("-",$salePriceRange[$i]);
			 
			 if(trim($priceFrom)!="" && $priceTo!=""){
			     if($priceTo!="Above"){
                  if($currency_before_price) $priceTo=$defaultCurrency.$priceTo;
                  else $priceTo=$priceTo." ".$defaultCurrency;
                 }    
			     if($priceTo=="Above") $priceToTrans=__($priceTo); else $priceToTrans=$priceTo;
                 if($currency_before_price) $priceFrom=$defaultCurrency.$priceFrom;
                 else $priceFrom=$priceFrom." ".$defaultCurrency;  
			 ?>
            <option value="<?php print str_replace("Above", __("Above"), $salePriceRange[$i]); ?>" <?php if($salePriceRange[$i] == $rePrice) print "selected='selected'"; ?> ><?php print $priceFrom." - ".$priceToTrans; ?></option>
            <?php  } 
} ?>
            </optgroup>
          </select>
        </div></td>
    </tr>
    <tr>
      <td style="vertical-align: top"><br>
        <input size='32' style='width:225px' type='text' class="form-control" name='city' value='<?php print htmlspecialchars($reCity, ENT_QUOTES, 'UTF-8'); ?>' id='reCity' placeholder='<?php print $relanguage_tags["City"];?>'>
        <input type='hidden' name='ptype' value='showOnMap'></td>
    </tr>
    <tr>
      <td style="vertical-align: top"><br>
        <input size='32' style='width:225px;' type='text' class="form-control"  name='requery' value='<?php print htmlspecialchars($reQuery, ENT_QUOTES, 'UTF-8'); ?>' id='reQuery' placeholder='<?php print $relanguage_tags["Postal"];?>'></td>
    </tr>
    <tr>
      <td style="vertical-align: top; text-align:center;"><br>
        <?php if($fullScreenEnabled!="true"){ ?>
        <button type='button' class='rebutton btn btn-sm btn-primary' id='reSearch' ><i class="icon-search"></i> <?php print $relanguage_tags["Search"];?></button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php  } ?>
        <?php if(($ptype=="showOnMap" && $_GET['fullscreen']=="true") || $fullScreenEnabled=="true"){ ?>
        <button type='button'  class='rebutton btn btn-sm btn-primary'  id='reSearchMap2'><i class="icon-map-marker"></i> Search Now</button>
        <?php }else{ ?>
        <button type='submit'  class='rebutton btn btn-sm btn-primary'  id='reSearchMap2'><i class="icon-map-marker"></i> Search Now</button>
        <?php } ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; text-align:center;padding-bottom: 15px;"><br>
        <button type='button'  class='rebutton btn btn-sm btn-primary'  id='search_options' onClick="toggleSearchOptions();"> More Options</button></td>
    </tr>
    <script>
    	function toggleSearchOptions(){
			$("#search_options_div").toggle("slow");
			return false;
		}
    
    </script>
    
    <!-- Start : Hitesh --->
    <style>
    .select-search-options .form-control {
		background-color: #fff;
		background-image: none;
		border: 1px solid #039be6;
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
		color: #039be6;
		display: block;
		font-size: 14px;
		height: 34px;
		line-height: 1.42857;
		padding: 6px 12px;
		transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		width: 100%;
	}
	.select-search-options select {
		margin-bottom: 15px;
	}
    </style>
    <?php
	$FetchDistSubTypeSql	= 'SELECT DISTINCT(subtype) FROM listing';
	$FetchDistSubTypeQue	= mysql_query($FetchDistSubTypeSql);
	
	?>
    <tr id="search_options_div" style="display: none;">
      <td style="vertical-align: top"><div class="select-search-options" >
          <div class="form-group" style="width: 70%; margin: auto;">
            <input type="text" class="form-control" placeholder="Address" id="moreaddress" name="moreaddress" /><br />
            <select class="form-control" id="moresubtype">
              <option value="">Select Subtype</option>
              <?php
              while($FetchDistSubTypeRes = mysql_fetch_assoc($FetchDistSubTypeQue))
              {
				  if($FetchDistSubTypeRes['subtype'] != 'None' && $FetchDistSubTypeRes['subtype'] != '' && $FetchDistSubTypeRes['subtype'] != 'N' && $FetchDistSubTypeRes['subtype'] != 'Y'){
			  ?>
                    <option value="<?php echo $FetchDistSubTypeRes['subtype'];?>"><?php echo $FetchDistSubTypeRes['subtype'];?></option>
              <?php
				  }
              }
			  ?>
            </select>
            <select class="form-control" id="morefrom">
            	<option value="">Select From</option>
                <option value="VOW">VOW</option>
                <option value="IDX">IDX</option>
            </select>
          </div>
        </div></td>
    </tr>
    <!-- End : Hitesh --->
    
  </table>
</form>
<input type="hidden" name="default_load" id="default_load" value="0" />
<script>
function showhideprice()
{
	var clstype = $("#reClassification").val();
	if(clstype == 'Rent')
	{
		$("#sellprice").html('');
		$("#rentprice").html($("#rentpricen").html());
		$('#rePrice').multiselect("refresh");
	}
	else if(clstype == 'Sale')
	{
		$("#rentprice").html('');
		$("#sellprice").html($("#sellpricen").html());
		$('#rePrice').multiselect("refresh");
	}
	else
	{
		$("#sellprice").html($("#sellpricen").html());
		$("#rentprice").html($("#rentpricen").html());
		$('#rePrice').multiselect("refresh");
	}
}
showhideprice();
</script> 
