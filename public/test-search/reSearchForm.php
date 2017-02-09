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

<div class="filters split-left split-nav split-filters mobile-unfocus">
  <div class="filters-forms">
    <form method="get" action="/listings" role="form" class="form-horizontal" id="filters-form">
      <!-----------Start : Form Fields-------------------->
      <input type="hidden" name="reClassification" id="reClassification" value="Sale" />
      <input type="hidden" name="reType" id="reType" value="Residential" />
      <!-----------End : Form Fields-------------------->
      <div class="filters-heading" style="margin-bottom: 8px;">
        <div id="filter-tabs" class="form-group" style="margin-bottom:0;">
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a class="btn-sales" href="#sales" data-toggle="tab" id="saleOrRent-sale" onClick="showhidesales('saleOrRent-sale', 'Sale');">Sales</a></li>
            <li><a href="#rentals" class="btn-rentals" data-toggle="tab" id="saleOrRent-rent" onClick="showhidesales('saleOrRent-rent', 'Rent');">Leases</a></li>
          </ul>
        </div>
      </div>
      <script type="text/javascript">
	  	function showhidesales(tabid, tabtype){
			$('#reClassification').val(tabtype);
			$(".saleOrRent-sale").hide();	
			$(".saleOrRent-rent").hide();	
			$("."+tabid).show();
			//$("#freeown").trigger('click');
			showhideprice();
			$('#reSearchMap2').trigger('click'); 
		}
	  </script>
      <div id="filter-forms" class="filter-forms">
        <div class="form-group">
          <label for="">Ownership</label>
          <div class="btn-group" data-toggle="buttons">
            <label id="freeown" class="btn btn-default active" onClick="javascript:ChangeSubtype('Residential');">
              <input type="radio" name="class" value="FREE" checked="checked">
              House </label>
            <label class="btn btn-default" onClick="javascript:ChangeSubtype('Condo');">
              <input type="radio" name="class" value="CONDO">
              Condo & Other </label>
            <label class="btn btn-default" onClick="javascript:ChangeSubtype('Commercial');">
              <input type="radio" name="class" value="">
              Commercial </label>
              <style>
			  .filter-forms .btn-default
			  {
				padding:7px 10px !important;	  
			  }
			  </style>
          </div>
        </div>
        <script type="text/javascript">
		function ChangeSubtype(subtypetab){
			$('input#reType').val(subtypetab);
			var sltype = $('#reClassification').val();
			if(subtypetab == 'Residential')
			{
				$('.commercial').hide();
				$('.nocommercial').show();
				$('.class-condo').hide();	
				$('.saleOrRent-sale-class-condo').hide();	
				$('.saleOrRent-rent-class-condo').hide();	
				if(sltype == 'Sale')
				{
					$('.saleOrRent-rent').hide();
					$('.saleOrRent-sale').show();
					$('.saleOrRent-sale-class-free').show();	
					$('.saleOrRent-rent-class-free').hide();	
					$('#reSearchMap2').trigger('click');
					$("#sidebar1").removeClass("ui-tabs-hide");
				}
				else if(sltype == 'Rent')
				{
					$('.saleOrRent-rent').show();
					$('.saleOrRent-sale').hide();
					$('.saleOrRent-sale-class-free').hide();	
					$('.saleOrRent-rent-class-free').show();	
					$('#reSearchMap2').trigger('click');
					$("#sidebar1").removeClass("ui-tabs-hide");
				}
				
			}
			else if(subtypetab == 'Condo')
			{
				$('.commercial').hide();
				$('.nocommercial').show();
				$('.class-condo').show();	
				$('.saleOrRent-sale-class-free').hide();	
				$('.saleOrRent-rent-class-free').hide();	
				if(sltype == 'Sale')
				{
					$('.saleOrRent-sale-class-condo').show();	
					$('.saleOrRent-rent-class-condo').hide();	
					$('#reSearchMap2').trigger('click');
					$("#sidebar1").removeClass("ui-tabs-hide");
				}
				else if(sltype == 'Rent')
				{
					$('.saleOrRent-sale-class-condo').hide();	
					$('.saleOrRent-rent-class-condo').show();	
					$('#reSearchMap2').trigger('click');
					$("#sidebar1").removeClass("ui-tabs-hide");
				}
			}
			else if(subtypetab == 'Commercial')
			{
				$('.class-condo').hide();
				$('.saleOrRent-sale-class-free').hide();	
				$('.saleOrRent-rent-class-free').hide();	
				$('.saleOrRent-sale-class-condo').hide();	
				$('.saleOrRent-rent-class-condo').hide();
				$('#reSearchMap2').trigger('click');
				$("#sidebar1").removeClass("ui-tabs-hide");
				$('.commercial').show();
				$('.nocommercial').hide();
			}
			$(window).resize();
		}
		</script>
        <style>
        	.ui-multiselect{
			    display: inline-block !important;	
			    border-color: #eee !important;
			    background-color: #f0f0f0 !important;
			    background-image: none !important;
				
				padding: 6px 12px !important;
				font-size: 14px !important;
				line-height: 1.42857143 !important;
				color: #555 !important;
				border: 1px solid #ccc !important;
				border-radius: 4px;
			}
			.ui-state-default .ui-icon{
				background-image: url(images/ui-icons_f08000_256x240-black.png) !important;	
			}
			.ui-widget-content{
				background-color: #f0f0f0 !important;
				/*width:135px !important;	*/
			}
			.ui-multiselect-menu{
				width:130px !important;	
			}
			.ui-corner-all{
				font-weight: normal !important;
			}
			.ui-multiselect-menu .ui-state-active, .ui-multiselect-menu .ui-widget-content .ui-state-active, .ui-multiselect-menu .ui-widget-header .ui-state-active{
				border:none !important;
				background: none !important;
				color:black !important;
				font-weight: bold !important;
				
			}
			.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{
					border:1px solid #eee !important;
					background: #3276b1 !important;
					color:white !important; 
			}
			#main_filter_tab .ui-state-hover{
					border:1px solid #eee !important;
					background: #f6f6f6 !important;
					color:white !important; 
			}
			#sidebar1 {
 			   padding: 4% 0 !important;;
			}
			.ui-multiselect{
				width:130px !important;	  
		  	}
			.class-condo label, .saleOrRent-sale-class-condo label{
				font-weight: 100;
    			font-size: 13px;	
				font-family: Verdana,Arial,sans-serif;
			}
        </style>
        
        
        <div class="form-group">
          <label for="">City</label>
          <input class="form-control" style="width:225px" type="text" id="city" name="city" onKeyUp="javascript:fetchcity($(this).attr('id'));">
          <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all" id="citylist" style="display:none; width:220px"></ul>
        </div>
        <script type="text/javascript">
			function fetchcity(fieldname)
			{
				var fieldval = $('#'+fieldname).val();
				$('#citylist').html('');
				$('#citylist').hide();
				$.ajax({ 
					type: 'GET', 
					url: 'infoResults.php', 
					data:{term:fieldval, type:30}, 
					success: function(data){ 
						var temlhtml = '';
						var temp = JSON.parse(data);
						for(var i=0; i<temp.length; i++)
						{
							if(typeof(temp[i]) != 'undefined')
							{
								temlhtml+='<li class="ui-menu-item"><a class="ui-corner-all" onclick="cityfillvalue(\''+temp[i]+'\');">'+temp[i]+'</a></li>'
							}
						}
						if(temlhtml != '')
						{
							$('#citylist').show();
							$('#citylist').html(temlhtml);
						}
					}
				});	
			}
			function cityfillvalue(selval)
			{
				$('#city').val(selval);
				$('#citylist').html('');
				$('#citylist').hide();
				assignmultipleval();
			}
			$(document).click(function (e)
			{
				var container = $("#citylist");
			
				if (!container.is(e.target) && container.has(e.target).length === 0) 
				{
					container.hide();
				}
			});		
		</script>
        <div class="form-group">
          <label for="">Postal</label>
          <input class="form-control" style="width:225px" type="text" id="postal" name="postal" onKeyUp="javascript:fetchpostalcode($(this).attr('id'));">
          <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all" id="postalcodelist" style="display:none; width:220px"></ul>
          
        </div>
        <script type="text/javascript">
			function fetchpostalcode(fieldname)
			{
				var fieldval = $('#'+fieldname).val();
				$('#postalcodelist').html('');
				$('#postalcodelist').hide();
				$.ajax({ 
					type: 'GET', 
					url: 'infoResults.php', 
					data:{term:fieldval, type:29}, 
					success: function(data){ 
						var temlhtml = '';
						var temp = JSON.parse(data);
						for(var i=0; i<temp.length; i++)
						{
							if(typeof(temp[i]) != 'undefined')
							{
								temlhtml+='<li class="ui-menu-item"><a class="ui-corner-all" onclick="postalvalueassign(\''+temp[i]+'\');">'+temp[i]+'</a></li>'
							}
						}
						if(temlhtml != '')
						{
							$('#postalcodelist').show();
							$('#postalcodelist').html(temlhtml);
						}
					}
				});	
			}
			function postalvalueassign(selval)
			{
				$('#postal').val(selval);
				$('#postalcodelist').html('');
				$('#postalcodelist').hide();
				assignmultipleval();
			}
			$(document).click(function (e)
			{
				var container = $("#postalcodelist");
			
				if (!container.is(e.target) && container.has(e.target).length === 0) 
				{
					container.hide();
				}
			});		
		</script>
        
        <!--<div class="form-group saleOrRent-sale">-->
        <div class="form-group">
          <label for="price">Price</label>
          <div>
            <div class="custom-price" style="display:none;">
              <img src="/images/x.png?00000001" class="cancel-custom-price"> </div>
            <select class="form-control" name="minprice" id="minprice" style="width:45%; display:inline-block;" onChange="javascript:$('#reSearchMap2').trigger('click');"></select>
            <script type="text/javascript">
			$("#minprice").multiselect({
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					  return selectedValues.join(", ");
				   },
				height:'250',
				header:false,
				multiple:false
			});
          </script>
            <span style="vertical-align:middle; color:#888;">to</span>
            <div class="custom-price" style="display:none;">
              <img src="/images/x.png?00000001" class="cancel-custom-price"> </div>
            <select class="form-control" name="maxprice" id="maxprice" style="width:45%; display:inline-block;" onChange="javascript:$('#reSearchMap2').trigger('click');"></select>
            <script type="text/javascript">
			$("#maxprice").multiselect({
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					  return selectedValues.join(", ");
				   },
				height:'250',
				header:false,
				multiple:false
			});
          </script>
          </div>
        </div>
        <div class="form-group form-group-multiselect nocommercial" style="display: inline-block;">
          <label for="">Type</label>
          <select class="form-control" style="display:inline-block;" multiple name="othertype" id="othertype" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$SubTypeSql  = 'SELECT DISTINCT(gar_type) FROM treb';
				$SubTypeQue  = mysql_query($SubTypeSql);
				while($SubTypeRes = mysql_fetch_assoc($SubTypeQue))
              	{
					if(trim($SubTypeRes['gar_type']) != '')
					{
  			?>
            			<option value="<?php echo $SubTypeRes['gar_type'];?>"><?php echo $SubTypeRes['gar_type'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#othertype").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        <div class="form-group form-group-multiselect nocommercial" style="display: inline-block;">
          <label for="">Style</label>
          <select class="form-control" multiple name="style[]" id="style" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
			<?php
  				$STypeSql  = 'SELECT DISTINCT(style) FROM treb';
				$STypeQue  = mysql_query($STypeSql);
				while($STypeRes = mysql_fetch_assoc($STypeQue))
              	{
					if(trim($STypeRes['style']) != ''){
  			?>
            			<option value="<?php echo $STypeRes['style'];?>"><?php echo $STypeRes['style'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#style").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
			function assignmultipleval()
			{
				$('#reSearchMap2').trigger('click');
			}
          </script>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="form-group nocommercial">
          <input type="hidden" name="selectedbedrooms" id="selectedbedrooms" value="" />
          <label for="">Bedrooms</label>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(0);">
              <input type="checkbox" name="bedrooms" value="0">
              0 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(1);">
              <input type="checkbox" name="bedrooms" value="1">
              1 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(2);">
              <input type="checkbox" name="bedrooms" value="2">
              2 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(3);">
              <input type="checkbox" name="bedrooms" value="3">
              3 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(4);">
              <input type="checkbox" name="bedrooms" value="4">
              4 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbedrooms(5);">
              <input type="checkbox" name="bedrooms" value=">=5">
              5+ </label>
          </div>
          <script type="text/javascript">
			function selectedbedrooms(selcheckboxval)
			{
				var selectedbdrooms = $('#selectedbedrooms').val();
			  	if(selectedbdrooms!=""){
					var selectedbdroomsArray = new Array();
				  	var selectedbdroomsArray = selectedbdrooms.split(",");
				  	if(selectedbdroomsArray.indexOf(selcheckboxval.toString()) > -1){
						selectedbdroomsArray.splice(selectedbdroomsArray.indexOf(selcheckboxval.toString()), 1);  
				  	}else{
					  selectedbdroomsArray.push(selcheckboxval);
				 	}
				  	$('#selectedbedrooms').val(selectedbdroomsArray.join());
					$('#reSearchMap2').trigger('click');
			  	}else{
				    $('#selectedbedrooms').val(selcheckboxval);
					$('#reSearchMap2').trigger('click');
			  	}
			}
		  </script>
        </div>
        <div class="form-group nocommercial">
          <label for="" style="display:block;">Bedrooms +</label>
          <input type="hidden" name="bedroomplus" id="bedroomplus" value="Any" />
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active" onClick="javascript:Setbedplus('Any');">
              <input type="radio" name="belowGradeBedroomsYN" value="Any" checked="checked">
              Any </label>
            <label class="btn btn-default" onClick="javascript:Setbedplus('Yes');">
              <input type="radio" name="belowGradeBedroomsYN" value="Yes">
              Yes </label>
            <label class="btn btn-default" onClick="javascript:Setbedplus('No');">
              <input type="radio" name="belowGradeBedroomsYN" value="No">
              No </label>
          </div>
          <script type="text/javascript">
		  function Setbedplus(bedplusval)
		  {
			  $('#bedroomplus').val(bedplusval);
			  $('#reSearchMap2').trigger('click');
		  }
		  </script>
        </div>
        <div class="form-group nocommercial">
          <input type="hidden" name="selectedbathrooms" id="selectedbathrooms" value="" />
          <label for="">Bathrooms</label>
          <div class="btn-group" data-toggle="buttons" id="bathid">
            <label class="btn btn-default" id="bathanyid" onClick="javascript:selectedbathrooms('Any');">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value="">
              Any </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbathrooms(0);">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value="0">
              0 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbathrooms(1);">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value="1">
              1 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbathrooms(2);">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value="2">
              2 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbathrooms(3);">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value="3">
              3 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedbathrooms(4);">
              <input type="checkbox" name="bathrooms" data-anyoption="true" value=">=4">
              4+ </label>
          </div>
          <script type="text/javascript">
			function selectedbathrooms(selcheckboxval)
			{
				var selectedbtrooms = $('#selectedbathrooms').val();
			  	
				if(selectedbtrooms != "")
				{
					var selectedbtroomsArray = new Array();
					var selectedbtroomsArray = selectedbtrooms.split(",");
					if(selectedbtroomsArray.indexOf(selcheckboxval.toString()) > -1)
					{
						selectedbtroomsArray.splice(selectedbtroomsArray.indexOf(selcheckboxval.toString()), 1);  
					}
					else
					{
					  selectedbtroomsArray.push(selcheckboxval);
					}
					$('#selectedbathrooms').val(selectedbtroomsArray.join());
					$('#reSearchMap2').trigger('click');
				}
				else
				{
					$('#selectedbathrooms').val(selcheckboxval);
					$('#reSearchMap2').trigger('click');
				}
				
			}
		  </script>
        </div>
        <div class="form-group class-condo form-group-multiselect" style="display: none;">
          <label for="">Approximate Square Footage</label>
          <select class="form-control" name="squarefeet[]" id="squarefeet" multiple="multiple" style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$sqftSql  = 'SELECT DISTINCT(sqft) FROM treb';
				$sqftQue  = mysql_query($sqftSql);
				while($sqftRes = mysql_fetch_assoc($sqftQue))
              	{
					if(trim($sqftRes['sqft']) != ''){
  			?>
            			<option value="<?php echo $sqftRes['sqft'];?>"><?php echo $sqftRes['sqft'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#squarefeet").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
				  	return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        <!--<div class="form-group">
          <label for="">Parking Spaces</label>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value="0">
              0 </label>
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value="1">
              1 </label>
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value="2">
              2 </label>
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value="3">
              3 </label>
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value="4">
              4 </label>
            <label class="btn btn-default" style="width:45px;">
              <input type="checkbox" name="parkingSpaces" value=">=5">
              5+ </label>
          </div>
        </div>-->
        <div class="form-group form-group-multiselect">
           <div class="row">
           <!--<div class="col-sm-6">
          <label for="" class="font100set">Garage Type</label>
          <select class="form-control" name="garageType" id="garageType" multiple="multiple" style="display: none;">
            <option value="Any">Any</option>
            <option value="None">No Garage</option>
            <option value="Attached">Attached</option>
            <option value="Built-in">Built-in</option>
            <option value="Carport">Carport</option>
            <option value="Detached">Detached</option>
            <option value="Other">Other</option>
          </select>
          <script type="text/javascript">
			$("#garageType").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					  return selectedValues.join(", ");
				   },
				height:'250',
				header:false
			});
          </script>
          </div>-->
          <div class="col-sm-6">
        <div class="form-group form-group-multiselect nocommercial">
          <label for="" class="font100set">Heat Source</label>
          <select class="form-control" name="heatingSource[]" id="heatingSource" multiple style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$heatingSql  = 'SELECT DISTINCT(heating) FROM treb';
				$heatingQue  = mysql_query($heatingSql);
				while($heatingRes = mysql_fetch_assoc($heatingQue))
              	{
					if(trim($heatingRes['heating']) != ''){
  			?>
            			<option value="<?php echo $heatingRes['heating'];?>"><?php echo $heatingRes['heating'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#heatingSource").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
				  	return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        </div>
        </div>
        <div class="row">
        <!--<div class="col-sm-6">
        <div class="form-group saleOrRent-sale-class-free form-group-multiselect" style="display: inline-block;">
          <label for="" class="font100set">Heat Type</label>
          <select class="form-control" name="heatingType" id="heatingType" multiple="multiple" style="display: none;">
            <option value="Any">Any</option>
            <option value="Baseboard">Baseboard</option>
            <option value="Forced Air">Forced Air</option>
            <option value="Heat Pump">Heat Pump</option>
            <option value="Other">Other</option>
            <option value="Radiant">Radiant</option>
            <option value="Water">Water</option>
          </select>
          <script type="text/javascript">
			$("#heatingType").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					  return selectedValues.join(", ");
				   },
				height:'250',
				header:false
			});
          </script>
        </div>
        </div>-->
        <div class="col-sm-6">
        <div class="form-group form-group-multiselect nocommercial">
          <label for="" class="font100set">Air Conditioning</label>
          <select class="form-control" name="cooling" id="cooling" multiple="multiple" style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$acSql  = 'SELECT DISTINCT(a_c) FROM treb';
				$acQue  = mysql_query($acSql);
				while($acRes = mysql_fetch_assoc($acQue))
              	{
					if(trim($acRes['a_c']) != ''){
  			?>
            			<option value="<?php echo $acRes['a_c'];?>"><?php echo $acRes['a_c'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#cooling").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-12">
        <div class="form-group saleOrRent-sale-class-free form-group-multiselect" style="display: inline-block;">
          <label for="" class="font100set">Basement</label>
          <select class="form-control" name="basement[]" id="basement" multiple style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$basementSql  = 'SELECT DISTINCT(subtype) FROM treb';
				$basementQue  = mysql_query($basementSql);
				while($basementRes = mysql_fetch_assoc($basementQue))
              	{
					if(trim($basementRes['subtype']) != ''){
  			?>
            			<option value="<?php echo $basementRes['subtype'];?>"><?php echo $basementRes['subtype'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#basement").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false/*
				checkAllText:"Check all",
				uncheckAllText:"Uncheck all"*/
			});
          </script>
        </div>
        </div>
        <div class="col-sm-12">
        <div class="form-group saleOrRent-sale-class-free" style="display: block;">
          <input type="hidden" name="selectedkitchens" id="selectedkitchens" value="" />
          <label for="" class="font100set">Kitchens</label>
          <div class="btn-group" data-toggle="buttons" style="display:block;">
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedkitchens(0);">
              <input type="checkbox" name="kitchens" value="0">
              0 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedkitchens(1);">
              <input type="checkbox" name="kitchens" value="1">
              1 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedkitchens(2);">
              <input type="checkbox" name="kitchens" value="2">
              2 </label>
            <label class="btn btn-default" style="width:45px;" onClick="javascript:selectedkitchens(3);">
              <input type="checkbox" name="kitchens" value=">=3">
              3+ </label>
          </div>
          <script type="text/javascript">
			function selectedkitchens(selcheckboxval)
			{
				var selectedbtrooms = $('#selectedkitchens').val();
			  	
				if(selectedbtrooms != "")
				{
					var selectedbtroomsArray = new Array();
					var selectedbtroomsArray = selectedbtrooms.split(",");
					if(selectedbtroomsArray.indexOf(selcheckboxval.toString()) > -1)
					{
						selectedbtroomsArray.splice(selectedbtroomsArray.indexOf(selcheckboxval.toString()), 1);  
					}
					else
					{
					  selectedbtroomsArray.push(selcheckboxval);
					}
					$('#selectedkitchens').val(selectedbtroomsArray.join());
					$('#reSearchMap2').trigger('click');
				}
				else
				{
					$('#selectedkitchens').val(selcheckboxval);
					$('#reSearchMap2').trigger('click');
				}
				
			}
		  </script>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-6">
        <div class="form-group saleOrRent-sale-class-free form-group-multiselect" style="display: inline-block;">
          <label for="">Exterior</label>
          <select class="form-control" name="exterior[]" id="exterior" multiple onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$exteriorSql  = 'SELECT DISTINCT(constr1_out) FROM treb';
				$exteriorQue  = mysql_query($exteriorSql);
				while($exteriorRes = mysql_fetch_assoc($exteriorQue))
              	{
					if(trim($exteriorRes['constr1_out']) != ''){
  			?>
            			<option value="<?php echo $exteriorRes['constr1_out'];?>"><?php echo $exteriorRes['constr1_out'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#exterior").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
				  	return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group saleOrRent-sale-class-free form-group-multiselect" style="display: inline-block;">
          <label for="">Pool</label>
          <select class="form-control" name="pool[]" id="pool" multiple onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$poolSql  = 'SELECT DISTINCT(pool) FROM treb';
				$poolQue  = mysql_query($poolSql);
				while($poolRes = mysql_fetch_assoc($poolQue))
              	{
					if(trim($poolRes['pool']) != ''){
  			?>
            			<option value="<?php echo $poolRes['pool'];?>"><?php echo $poolRes['pool'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#pool").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        </div>
        </div>
        <div class="form-group saleOrRent-rent form-group-multiselect" style="display: none;">
          <label for="">Laundry Access</label>
          <select class="form-control" name="laundry[]" id="laundry" multiple style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$laundrySql  = 'SELECT DISTINCT(laundry) FROM treb';
				$laundryQue  = mysql_query($laundrySql);
				while($laundryRes = mysql_fetch_assoc($laundryQue))
              	{
					if(trim($laundryRes['laundry']) != ''){
  			?>
            			<option value="<?php echo $laundryRes['laundry'];?>"><?php echo $laundryRes['laundry'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#laundry").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
        </div>
        <style>
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
		{
			border:none;
			padding:0px;	
		}
		</style>
        <div class="form-group class-condo form-group-multiselect" style="display: none;">
          <label for="">Exposure</label>
          <select class="form-control" name="exposure[]" id="exposure" multiple style="display: none;" onChange="javascript:assignmultipleval();">
            <option value="Any">Any</option>
            <?php
  				$dirSql  = 'SELECT DISTINCT(st_dir) FROM treb';
				$dirQue  = mysql_query($dirSql);
				while($dirRes = mysql_fetch_assoc($dirQue))
              	{
					if(trim($dirRes['st_dir']) != ''){
  			?>
            			<option value="<?php echo $dirRes['st_dir'];?>"><?php echo $dirRes['st_dir'];?></option>
            <?php
					}
				}
			?>
          </select>
          <script type="text/javascript">
			$("#exposure").multiselect({
				noneSelectedText: "Any",
				selectedText: function(numChecked, numTotal, checkedItems){
					var selectedValues = new Array();
					for (var i = 0; i < checkedItems.length; i++) {
						selectedValues[i]=checkedItems[i].value;
					}
					return selectedValues.join(", ");
				},
				height:'250',
				header:false
			});
          </script>
          
        </div>
        <div class="form-group  saleOrRent-rent" style="display: none;">
          <input type="hidden" name="furnished" id="furnished" value="" />
          <label for="">Furnished</label>
          <div class="btn-group" data-toggle="buttons" style="display:block;">
            <label class="btn btn-default" onClick="javascript:selectedfurnished('N');">
              <input type="checkbox" name="furnishedname" value="N" disabled="">
              No </label>
            <label class="btn btn-default" onClick="javascript:selectedfurnished('Part');">
              <input type="checkbox" name="furnishedname" value="Part" disabled="">
              Part </label>
            <label class="btn btn-default" onClick="javascript:selectedfurnished('Y');">
              <input type="checkbox" name="furnishedname" value="Y" disabled="">
              Yes </label>
          </div>
          <script type="text/javascript">
			function selectedfurnished(selcheckboxval)
			{
				var selectedfurnished = $('#furnished').val();
			  	if(selectedfurnished!=""){
					var selectedfurnishedArray = new Array();
				  	var selectedfurnishedArray = selectedfurnished.split(",");
				  	if(selectedfurnishedArray.indexOf(selcheckboxval.toString()) > -1){
						selectedfurnishedArray.splice(selectedfurnishedArray.indexOf(selcheckboxval.toString()), 1);  
				  	}else{
					  selectedfurnishedArray.push(selcheckboxval);
				 	}
				  	$('#furnished').val(selectedfurnishedArray.join());
					$('#reSearchMap2').trigger('click');
			  	}else{
				    $('#furnished').val(selcheckboxval);
					$('#reSearchMap2').trigger('click');
			  	}
			}
		  </script>
        </div>
        <div class="form-group class-condo" style="display: none;">
          <input type="hidden" name="pets" id="pets" value="Any" />
          <label for="">Pets Permitted</label>
          <div class="btn-group" data-toggle="buttons" style="display:block;">
            <label class="btn btn-default active" onClick="javascript:setpets('Any')">
              <input type="radio" name="petsAllowedYN" value="" checked="checked" disabled="">
              Any </label>
            <label class="btn btn-default" onClick="javascript:setpets('Yes')">
              <input type="radio" name="petsAllowedYN" value="true" disabled="">
              Yes </label>
            <label class="btn btn-default" onClick="javascript:setpets('No')">
              <input type="radio" name="petsAllowedYN" value="false" disabled="">
              No </label>
          </div>
          <script type="text/javascript">
		  function setpets(petval)
		  {
			  $('#pets').val(petval);
			  $('#reSearchMap2').trigger('click');
		  }
		  </script>
        </div>
        <div class="form-group">
          <label class="class-condo saleOrRent-rent" for="" style="display: none;">Features</label>
          <table class="table table-condensed features-search-list" style="font-size: 15px">
            <tbody>
              <tr class="class-condo" style="display: none;">
                <td><label>
                    <input type="checkbox" name="locker" id="locker" onClick="javascript:assignmultipleval();">
                    Locker</label></td>
                <td><label>
                    <input type="checkbox" name="balconyYN" value="true">
                    Balcony</label></td>
              </tr>
              <tr class="saleOrRent-rent" style="display: none;">
                <td><label>
                    <input type="checkbox" name="heatingIncluded" id="heatingIncluded" onClick="javascript:assignmultipleval();">
                    Heat Included</label></td>
                <td><label>
                    <input type="checkbox" name="hydroIncluded" id="hydroIncluded" onClick="javascript:assignmultipleval();">
                    Hydro Included</label></td>
              </tr>
              <tr class="saleOrRent-sale-class-condo" style="display: none;">
                <td colspan="2"><label>
                    <input type="checkbox" name="features" value="[]Ensuite Laundry">
                    Ensuite Laundry</label></td>
              </tr>
              <!--<tr class="class-condo">
							<td colspan="2"><label><input type="checkbox" name="features" value="[]Pets Allowed with Restrictions" /> Pets Permitted w/ Restrictions</label></td>
						</tr>-->
            </tbody>
          </table>
        </div>
        <div class="form-group  class-condo" style="display: none;">
          <label for="" style="width:60%">Building Amenities</label>
          <span class="pull-right" style="color: #999;font-size:13px;margin-top:2px; margin-right:5px">Select up to 6</span>
          <table class="table table-condensed features-search-list" style="font-size: 15px">
            <tbody>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]BBQs Allowed">
                    BBQs Allowed</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Bus Ctr (WiFi Bldg)">
                    Bus Ctr (WiFi Bldg)</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Car Wash">
                    Car Wash</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Concierge">
                    Concierge</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Exercise Room">
                    Exercise Room</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Games Room">
                    Games Room</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Guest Suites">
                    Guest Suites</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Gym">
                    Gym</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Indoor Pool">
                    Indoor Pool</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Lap Pool">
                    Lap Pool</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Media Room">
                    Media Room</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Outdoor Pool">
                    Outdoor Pool</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Party/Meeting Room">
                    Party/Meeting Room</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Recreation Room">
                    Recreation Room</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Rooftop Deck/Garden">
                    Rooftop Deck/Garden</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Satellite Dish">
                    Satellite Dish</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Sauna">
                    Sauna</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Security Guard">
                    Security Guard</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Security System">
                    Security System</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Squash/Racquet Court">
                    Squash/Racquet Court</label></td>
              </tr>
              <tr>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Tennis Court">
                    Tennis Court</label></td>
                <td><label>
                    <input type="checkbox" name="building.features" value="[]Visitor Parking">
                    Visitor Parking</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!--<input type="submit" class="btn btn-default"/>-->
      
      <div class="additional-filters-description" style="display:none;">
        <div class="form-group" style="text-align:left;">
          <label>Additional Filters Description</label>
          <div class="description"></div>
        </div>
      </div>
      </div>
      <!--
      <input type="submit" class="hidden-submit btn btn-primary" onclick="$(document.activeElement).blur();" >
      <input type="hidden" name="streetgrid">
      <input type="hidden" name="geometry" value="?#POLYGON ((-81.11755 44.61783, -80.31555 43.2492, -78.55772 43.2492, -78.55772 44.75063, -80.61218 44.98810, -81.11755 44.61783))">
      <input type="hidden" name="geometry" value="?#POLYGON ((-80.24045 45.36851, -80.71476 45.19449, -81.08600 44.92449, -81.31797 44.58607, -81.38994 44.21322, -81.29781 43.84272, -81.05336 43.51044, -80.68212 43.24805, -80.22027 43.08017, -79.7113 43.02243, -79.20233 43.08017, -78.74047 43.24805, -78.36923 43.51044, -78.12477 43.84272, -78.03264 44.21322, -78.10462 44.58607, -78.33659 44.92449, -78.70784 45.19449, -79.18214 45.36851, -79.7113 45.4286, -80.24045 45.36851, -80.24045 45.36851))">
      -->
      <div style="text-align:center">
	  <?php 
	  if($fullScreenEnabled!="true")
	  { 
	  ?>
        <button type='button' class='rebutton btn btn-sm btn-primary bd_w_btn' id='reSearch' ><i class="icon-search"></i> Text Search <?php //print $relanguage_tags["Search"];?></button>
        &nbsp;&nbsp;&nbsp;&nbsp;
      <?php  
	  } 
	  if(($ptype=="showOnMap" && $_GET['fullscreen']=="true") || $fullScreenEnabled=="true")
	  { 
	  ?>
        <button type='button'  class='rebutton btn btn-sm btn-primary bd_w_btn'  id='reSearchMap2'><i class="icon-map-marker"></i> Map Search</button>
      <?php 
	  }
	  else
	  { 
	  ?>
        <button type='submit'  class='rebutton btn btn-sm btn-primary bd_w_btn'  id='reSearchMap2'><i class="icon-map-marker"></i> Map Search</button>
      <?php 
	  } 
	  ?>
      <style>
	  	.rebutton
		{
			padding-left:40px !important;
			padding-right:40px !important;	
		}
	  </style>
      </div>
    </form>
    <!--<form method="get" action="/searchlistings/filters" role="form" id="app-filters-form" style="display:none;">
      <div class="" style="margin-bottom:10px; z-index:1;">
        <label for="gid" style="display:none;">Customer</label>
        <select id="gid" class="form-control" style="background-color: transparent; font-size: 13px">
          <option value="treb" selected="">treb</option>
        </select>
      </div>
    </form>-->
  </div>
  <!--<div class="filters-description" style="display:none;">
    <div class="form-group" style="text-align:left;">
      <label>Description</label>
      <div class="description"></div>
    </div>
    <button class="btn btn-primary btn-filters-rtn" onclick="newSearch();">New Search</button>
  </div>-->
</div>
<style>
.form-horizontal .form-group{
	margin-left:0px !important;
	margin-right:0px !important;	
}

#loc::-webkit-input-placeholder {
    color: white;
}
#loc:-moz-placeholder {
    /* FF 4-18 */
    color: white;
}
#loc::-moz-placeholder {
    /* FF 19+ */
    color: white;
}
#loc:-ms-input-placeholder {
    color: white;
}
.nav-tabs.nav-justified > li{
	display:table-cell !important;
	width:50% !important;
	float:left !important;	
}
.twitter-typeahead{
	width:96% !important;	
}
.btn-default.active{
	background-color:#656565 !important;
	color:white !important;
}
</style> 

<select class="form-control" name="saleminprice" id="saleminprice" style="display:none;">
	<?php
    $saleminpriceArray	= array('$0', '$25,000', '$50,000', '$75,000', '$100,000', '$125,000', '$150,000', '$175,000', '$200,000', '$225,000', '$250,000', '$275,000', 
                            '$300,000', '$325,000', '$350,000', '$375,000', '$400,000', '$425,000', '$450,000', '$475,000', '$500,000', '$550,000', '$600,000', 
                            '$650,000', '$700,000', '$750,000', '$800,000', '$850,000', '$900,000', '$950,000', '$1,000,000', '$1,100,000', '$1,200,000', 
                            '$1,300,000','$1,400,000', '$1,500,000', '$1,600,000','$1,700,000', '$1,800,000', '$1,900,000',	'$2,000,000', '$2,500,000', '$3,000,000', 
                            '$4,000,000', '$5,000,000', '$7,500,000', '$10,000,000');
    for($i=0; $i<count($saleminpriceArray); $i++)
    {
    ?>
        <option value="<?php echo $saleminpriceArray[$i];?>"><?php echo $saleminpriceArray[$i];?></option>
    <?php
    }
    ?>
</select>
            
<select class="form-control" name="salemaxprice" id="salemaxprice" style="display:none;">
  <?php
  $salemaxpriceArray	= array('Unlimited', '$25,000', '$50,000', '$75,000', '$100,000', '$125,000', '$150,000', '$175,000', '$200,000', '$225,000', '$250,000', '$275,000',
                            '$300,000', '$325,000', '$350,000', '$375,000', '$400,000', '$425,000', '$450,000', '$475,000', '$500,000', '$550,000', '$600,000', 
                            '$650,000', '$700,000', '$750,000', '$800,000', '$850,000', '$900,000', '$950,000', '$1,000,000', '$1,100,000', '$1,200,000', '$1,300,000', 
                            '$1,400,000', '$1,500,000', '$1,600,000', '$1,700,000', '$1,800,000', '$1,900,000', '$2,000,000', '$2,500,000', '$3,000,000', '$4,000,000', 
                            '$5,000,000', '$7,500,000', '$10,000,000');
  for($i=0; $i<count($salemaxpriceArray); $i++)
  {
  ?>
    <option value="<?php echo $salemaxpriceArray[$i];?>"><?php echo $salemaxpriceArray[$i];?></option>
  <?php
  }
  ?>
</select>

<select class="form-control" name="leaseminprice" id="leaseminprice" style="display:none">
    <?php
    $leaseminpriceArray	= array('$0', '$250', '$500', '$750', '$1,000', '$1,250', '$1,500', '$1,750', '$2,000', '$2,500', '$3,000', '$3,500', '$4,000', '$4,500',
                                '$5,000', '$7,500', '$10,000', '$12,500', '$15,000');
    for($i=0; $i<count($leaseminpriceArray); $i++)
    {
    ?>
        <option value="<?php echo $leaseminpriceArray[$i];?>"><?php echo $leaseminpriceArray[$i];?></option>
    <?php
    }
    ?>
</select>

<select class="form-control" name="leasemaxprice" id="leasemaxprice" style="display:none;">
  <?php
  $leasemaxprice = array('Unlimited', '$250', '$500', '$750', '$1,000', '$1,250', '$1,500', '$1,750', '$2,000', '$2,500', '$3,000', '$3,500', '$4,000', '$4,500', 
                         '$5,000', '$7,500', '$10,000', '$12,500', '$15,000');
  for($i=0; $i<count($leasemaxprice); $i++)
  {
  ?>
    <option value="<?php echo $leasemaxprice[$i];?>"><?php echo $leasemaxprice[$i];?></option>
  <?php
  }
  ?>
</select>

<input type="hidden" name="default_load" id="default_load" value="0" />
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script> -->

<script type="text/javascript">
/*
if (annyang) {
	 var commands = {
    'hello *tag': intiatspeech
  };

  // Add our commands to annyang
  annyang.addCommands(commands);

  // Start listening. You can call this here, or attach this call to an event, button, etc.
  annyang.start();
  
  
  function intiatspeech(tag){
	  if(tag == 'Hola' || tag == 'formula' || tag == 'hum Bhula' || tag == 'ho Mora' || tag == 'homula' || tag == 'homulla' || tag == 'Home alone'){
		// Let's define our first command. First the text we expect, and then the function it should call
		  var commands = {
			'classification *tag': classificationspeechselect,
			'select options *tag': selectoptionspeechselect,
			'select bedroom *tag': bedroomspeechselect,
			'select bathroom *tag': bathroomspeechselect,
			'price *tag': pricespeechselect,
			'city *tag': cityspeechselect,
			'postal code *tag': postalcodespeechselect,
			'map *tag': mapspeechselect,
			'zoom *tag': zoomspeechselect,
			'move *tag': movespeechselect,
			'view *tag': viewspeechselect,
			'like *tag': likespeechselect,
			'dislike *tag': likespeechselect,
			'favour *tag': favourspeechselect,
			'unfavour *tag': favourspeechselect,
			'and favour *tag': favourspeechselect,
			'more info *tag': moreinfospeechselect,
			'contact agent *tag': contactagentspeechselect,
			'close *tag': closecontactagentspeechselect
		  };
		
		  // Add our commands to annyang
		  annyang.addCommands(commands);
		
		  // Start listening. You can call this here, or attach this call to an event, button, etc.
		  annyang.start();  
	  }
  }
}
*/
function enabledisablespeech()
{
	if($('#defspeechvar').val() == 1)
	{
		$('#speechspn').css('color', 'red');
		var commands = {
			'classification *tag': classificationspeechselect,
			'select options *tag': selectoptionspeechselect,
			'select bedroom *tag': bedroomspeechselect,
			'select bathroom *tag': bathroomspeechselect,
			'price *tag': pricespeechselect,
			'city *tag': cityspeechselect,
			'postal code *tag': postalcodespeechselect,
			'map *tag': mapspeechselect,
			'zoom *tag': zoomspeechselect,
			'move *tag': movespeechselect,
			'view *tag': viewspeechselect,
			'like *tag': likespeechselect,
			'dislike *tag': likespeechselect,
			'favour *tag': favourspeechselect,
			'unfavour *tag': favourspeechselect,
			'and favour *tag': favourspeechselect,
			'more info *tag': moreinfospeechselect,
			'contact agent *tag': contactagentspeechselect,
			'close *tag': closecontactagentspeechselect
		  };
		
		  // Add our commands to annyang
		  annyang.addCommands(commands);
		
		  // Start listening. You can call this here, or attach this call to an event, button, etc.
		  annyang.start();  
	}
	else if($('#defspeechvar').val() == 0)
	{
		$('#speechspn').css('color', 'white');
		annyang.removeCommands();
		//annyang.start({ paused: true });
		annyang.pause();
	}
}

function closecontactagentspeechselect(tag)
{
	if(tag == 'contact agent')
	{
		$('#fancybox-close').trigger('click');
	}
	else if(tag == 'view popup')
	{
		$('.boxinfo').each(function(){
			$(this).hide();
		});
		$('.gm-style-pbc+div').css({"opacity":"0"});		
	}
}

function moreinfospeechselect(tag)
{
	if(!isNaN(tag))
	{
		$("#"+tag).trigger('click');
	}	
}

function contactagentspeechselect(tag)
{
	if(!isNaN(tag))
	{
		$(".listingcontact").trigger('click');
	}
}

function likespeechselect(tag)
{
	if(!isNaN(tag))
	{
		$("#comp2"+tag).trigger('click');
	}	
}

function favourspeechselect(tag)
{
	if(!isNaN(tag))
	{
		$("#heartid2"+tag).trigger('click');
	}
}

function viewspeechselect(tag)
{
	if(!isNaN(tag))
	{
		$("#textrecord-"+tag).trigger('click');
	}
}

function zoomspeechselect(tag)
{
	if(tag == 'in')
	{
		$('#mapzoomin').trigger('click');
	}
	else if(tag == 'out')
	{
		$('#mapzoomout').trigger('click');
	}
}

function movespeechselect(tag)
{
	if(tag == 'up')
	{
		$('#maptop').trigger('click');
	}
	else if(tag == 'down')
	{
		$('#mapbottom').trigger('click');
	}
	else if(tag == 'left')
	{
		$('#mapleft').trigger('click');
	}
	else if(tag == 'right')
	{
		$('#mapright').trigger('click');
	}
}

function mapspeechselect(tag)
{
	if(tag == 'search')
	{
		$('#reSearchMap2').click();
	}
}

function postalcodespeechselect(tag)
{
	var fieldname = 'reQuery';
	$('#'+fieldname).val(tag);
	$('#postalcodelist').html('');
	$('#postalcodelist').hide();
	$.ajax({ 
		type: 'GET', 
		url: 'infoResults.php', 
		data:{term:tag, type:29}, 
		success: function(data){ 
			var temlhtml = '';
			var temp = JSON.parse(data);
			for(var i=0; i<temp.length; i++)
			{
				if(typeof(temp[i]) != 'undefined')
				{
					temlhtml+='<li class="ui-menu-item"><a class="ui-corner-all" onclick="fillvalue(\''+temp[i]+'\');">'+temp[i]+'</a></li>'
				}
			}
			if(temlhtml != '')
			{
				$('#postalcodelist').show();
				$('#postalcodelist').html(temlhtml);
			}
		}
	});	
}

function cityspeechselect(tag)
{
	var fieldname = 'reCity';
	$('#'+fieldname).val(tag);
}

function classificationspeechselect(tag)
{
	var fieldname = 'reClassification';
	if(tag == 'buy' || tag == 'by')
	{
		$('#'+fieldname).val('Sale');
		$('#'+fieldname).multiselect("refresh");
		$('#'+fieldname).trigger("change");
	}
	else
	{
		if($("#"+fieldname+" option[value='"+capitalize(tag)+"']").length > 0)
		{
			$('#'+fieldname).val(capitalize(tag));	
			$('#'+fieldname).multiselect("refresh");
			$('#'+fieldname).trigger("change");
		}
	}
}

function selectoptionspeechselect(tag)
{
	var fieldname = 'reType';
	
	if($("#"+fieldname+" option[value='"+capitalize(tag)+"']").length > 0)
	{
		$('#'+fieldname).val(capitalize(tag));	
		$('#'+fieldname).multiselect("refresh");
		$('#'+fieldname).trigger("change");
	}	
}

function bedroomspeechselect(tag)
{
	var fieldname = 'reBedrooms';
	if(tag == 'to' || tag == 'too')
	{
		$('#'+fieldname).val(2);
		$('#'+fieldname).multiselect("refresh");
	}
	else if($("#"+fieldname+" option[value='"+tag+"']").length > 0)
	{
		$('#'+fieldname).val(tag);
		$('#'+fieldname).multiselect("refresh");
	}
}

function bathroomspeechselect(tag)
{
	var fieldname = 'reBathrooms';
	if(tag == 'to' || tag == 'too')
	{
		$('#'+fieldname).val(2);
		$('#'+fieldname).multiselect("refresh");
	}
	else if($("#"+fieldname+" option[value='"+tag+"']").length > 0)
	{
		$('#'+fieldname).val(tag);
		$('#'+fieldname).multiselect("refresh");
	}
}

function pricespeechselect(tag)
{
	var fieldname = 'rePrice';
	if(tag == 'zero to $400' || tag == 'zero')
	{
		$('#'+fieldname).val('0-400');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$400 to $800' || tag == '$400')
	{
		$('#'+fieldname).val('400-800');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$800 to $1,000' || tag == '$800')
	{
		$('#'+fieldname).val('800-1000');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$1,000 to $1,200' || tag == '$1,000')
	{
		$('#'+fieldname).val('1000-1200');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$1,200 to $1,500' || tag == '$1,200')
	{
		$('#'+fieldname).val('1200-1500');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$1,500 to $2,000' || tag == '$1,500')
	{
		$('#'+fieldname).val('1500-2000');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$2,000 to $2,500' || tag == '$2,000')
	{
		$('#'+fieldname).val('2000-2500');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$2,500 to above' || tag == '$2,500')
	{
		$('#'+fieldname).val('2500-Above');
		$('#'+fieldname).multiselect("refresh");
	}
	
	
	else if(tag == 'zero to $50,000')
	{
		$('#'+fieldname).val('0-50K');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$50,000 to $100,000' || tag == '$50,000')
	{
		$('#'+fieldname).val('50K-100K');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$100,000 to $250,000' || tag == '$100,000')
	{
		$('#'+fieldname).val('100K-250K');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$250,000 to $500,000' || tag == '$250,000')
	{
		$('#'+fieldname).val('250K-500K');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$500,000 to $750,000' || tag == '$500,000')
	{
		$('#'+fieldname).val('500K-750K');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '$750,000 to 1 million dollars' || tag == '$750,000')
	{
		$('#'+fieldname).val('750K-1M');
		$('#'+fieldname).multiselect("refresh");
	}
	else if(tag == '1 million dollars to above' || tag == '1 million dollar' || tag == '1 million dollars')
	{
		$('#'+fieldname).val('1M-Above');
		$('#'+fieldname).multiselect("refresh");
	}
}
</script> 

<script type="text/javascript" src="js/wton.js"></script> 

<script type="text/javascript">
  
	window.setInterval(hidefn, 10000);
	function hidefn()
	{
		$('.redmic').hide();
	}
	
	function firstpopstartDictation(popupid)
	{
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				if(e.results[0][0].transcript == 'more info')
				{
					$("#"+popupid).trigger('click');
				}
				else if(e.results[0][0].transcript == 'contact agent')
				{
					$(".listingcontact").trigger('click');
				}
				recognition.stop();
          	};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
	}
	
	function likefavstartDictation(likefavid)
	{
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				if(e.results[0][0].transcript == 'like' || e.results[0][0].transcript == 'unlike' || e.results[0][0].transcript == 'dislike')
				{
					$("#comp2"+likefavid).trigger('click');
				}
				else if(e.results[0][0].transcript == 'favorite' || e.results[0][0].transcript == 'favourite' || e.results[0][0].transcript == 'unfavourite' || e.results[0][0].transcript == 'unfavor' || e.results[0][0].transcript == 'UN favour' || e.results[0][0].transcript == 'take out favourite' || e.results[0][0].transcript == 'take favourite out')
				{
					$("#heartid2"+likefavid).trigger('click');
				}
				recognition.stop();
          	};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
	}
	
	function viewdetailpopup(viewdetailid)
	{
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				//document.getElementById('transcript').value = e.results[0][0].transcript;
				if(e.results[0][0].transcript == 'view detail' || e.results[0][0].transcript == 'detail' || e.results[0][0].transcript == 'view')
				{
					$("#textrecord-"+viewdetailid).trigger('click');
				}
				recognition.stop();
          	};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
	}
	
	function mapstartDictation()
	{
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				//document.getElementById('transcript').value = e.results[0][0].transcript;
				if(e.results[0][0].transcript == 'zoom in')
				{
					$('#mapzoomin').trigger('click');
				}
				else if(e.results[0][0].transcript == 'zoom out')
				{
					$('#mapzoomout').trigger('click');
				}
				else if(e.results[0][0].transcript == 'left' || e.results[0][0].transcript == 'move left')
				{
					$('#mapleft').trigger('click');
				}
				else if(e.results[0][0].transcript == 'right' || e.results[0][0].transcript == 'move right')
				{
					$('#mapright').trigger('click');
				}
				else if(e.results[0][0].transcript == 'top' || e.results[0][0].transcript == 'move top' || e.results[0][0].transcript == 'move up' || e.results[0][0].transcript == 'up')
				{
					$('#maptop').trigger('click');
				}else if(e.results[0][0].transcript == 'bottom' || e.results[0][0].transcript == 'move bottom' || e.results[0][0].transcript == 'move down' || e.results[0][0].transcript == 'down')
				{
					$('#mapbottom').trigger('click');
				}
				
				recognition.stop();
          	};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
	}
	
	function capitalize(string) {
		return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
	}
	
	function dropdpwnstartDictation(fieldname, strtype)
	{
        $('.redmic').hide();
		$('#mic_'+fieldname).show();
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				if(strtype == 'text')
				{
					if(e.results[0][0].transcript == 'buy')
					{
						$('#'+fieldname).val('Sale');
						$('#'+fieldname).multiselect("refresh");
					}
					else
					{
						if($("#"+fieldname+" option[value='"+capitalize(e.results[0][0].transcript)+"']").length > 0)
						{
							$('#'+fieldname).val(capitalize(e.results[0][0].transcript));	
							$('#'+fieldname).multiselect("refresh");
						}
					}
				}
				else if(strtype == 'num')
				{
					if($("#"+fieldname+" option[value='"+WtoN.convert(e.results[0][0].transcript)+"']").length > 0)
					{
						$('#'+fieldname).val(WtoN.convert(e.results[0][0].transcript));
						$('#'+fieldname).multiselect("refresh");
					}
				}
				else if(strtype == 'price')
				{
					if(e.results[0][0].transcript == 'zero to $400')
					{
						$('#'+fieldname).val('0-400');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$400 to $800' || e.results[0][0].transcript == '$400')
					{
						$('#'+fieldname).val('400-800');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$800 to $1,000' || e.results[0][0].transcript == '$800')
					{
						$('#'+fieldname).val('800-1000');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$1,000 to $1,200' || e.results[0][0].transcript == '$1,000')
					{
						$('#'+fieldname).val('1000-1200');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$1,200 to $1,500' || e.results[0][0].transcript == '$1,200')
					{
						$('#'+fieldname).val('1200-1500');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$1,500 to $2,000' || e.results[0][0].transcript == '$1,500')
					{
						$('#'+fieldname).val('1500-2000');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$2,000 to $2,500' || e.results[0][0].transcript == '$2,000')
					{
						$('#'+fieldname).val('2000-2500');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$2,500 to above' || e.results[0][0].transcript == '$2,500')
					{
						$('#'+fieldname).val('2500-Above');
						$('#'+fieldname).multiselect("refresh");
					}
					
					
					else if(e.results[0][0].transcript == 'zero to $50,000')
					{
						$('#'+fieldname).val('0-50K');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$50,000 to $100,000' || e.results[0][0].transcript == '$50,000')
					{
						$('#'+fieldname).val('50K-100K');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$100,000 to $250,000' || e.results[0][0].transcript == '$100,000')
					{
						$('#'+fieldname).val('100K-250K');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$250,000 to $500,000' || e.results[0][0].transcript == '$250,000')
					{
						$('#'+fieldname).val('250K-500K');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$500,000 to $750,000' || e.results[0][0].transcript == '$500,000')
					{
						$('#'+fieldname).val('500K-750K');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '$750,000 to 1 million dollars' || e.results[0][0].transcript == '$750,000')
					{
						$('#'+fieldname).val('750K-1M');
						$('#'+fieldname).multiselect("refresh");
					}
					else if(e.results[0][0].transcript == '1 million dollars to above' || e.results[0][0].transcript == '1 million dollar' || e.results[0][0].transcript == '1 million dollars')
					{
						$('#'+fieldname).val('1M-Above');
						$('#'+fieldname).multiselect("refresh");
					}
				} 
				$('.redmic').hide();
				recognition.stop();
			};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
    }
	
	function postalstartDictation(fieldname) {
        $('.redmic').hide();
		$('#mic_'+fieldname).show();
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				//document.getElementById('transcript').value = e.results[0][0].transcript;
				document.getElementById(fieldname).value = e.results[0][0].transcript;
				recognition.stop();
				
				$.ajax({ 
					type: 'GET', 
					url: 'infoResults.php', 
					data:{term:e.results[0][0].transcript, type:29}, 
					success: function(data){ 
						var temlhtml = '';
						var temp = JSON.parse(data);
						for(var i=0; i<temp.length; i++)
						{
							if(typeof(temp[i]) != 'undefined')
							{
								temlhtml+='<li class="ui-menu-item"><a class="ui-corner-all" onclick="fillvalue(\''+temp[i]+'\');">'+temp[i]+'</a></li>'
							}
						}
						if(temlhtml != '')
						{
							$('#postalcodelist').show();
							$('#postalcodelist').html(temlhtml);
						}
					}
				 });
				
          	};
			
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
    }
	
	function startDictation(fieldname) {
        $('.redmic').hide();
		$('#mic_'+fieldname).show();
		if (window.hasOwnProperty('webkitSpeechRecognition')) {
    	    var recognition = new webkitSpeechRecognition();
     
          	recognition.continuous = false;
          	recognition.interimResults = false;
     
          	recognition.lang = "en-US";
          	recognition.start();
     
          	recognition.onresult = function(e) {
				//document.getElementById('transcript').value = e.results[0][0].transcript;
				document.getElementById(fieldname).value = e.results[0][0].transcript;
				
				recognition.stop();
				if((e.results[0][0].transcript == 'map search' || e.results[0][0].transcript == 'search') && fieldname == 'mapsearchhid')
				{
					$('#reSearchMap2').click();
				}
				//document.getElementById('labnol').submit();
          	};
     
          	recognition.onerror = function(e) {
            	recognition.stop();
          	}
        }
    }
	/*
	function fillvalue(selval)
	{
		$('#reQuery').val(selval);
		$('#postalcodelist').html('');
		$('#postalcodelist').hide();
	}
	
	$(document).click(function (e)
	{
		var container = $("#postalcodelist");
	
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			container.hide();
		}
	});		
	*/
	
</script> 

<script type="text/javascript">
function showhideprice()
{
	var clstype = $('input#reClassification').val();
	if(clstype == 'Rent')
  	{
		$("#minprice").html('');
		$("#maxprice").html('');
    	
		$("#minprice").html($("#leaseminprice").html());
		$("#maxprice").html($("#leasemaxprice").html());
		
    	$('#minprice').multiselect("refresh");
		$('#maxprice').multiselect("refresh");
  	}
  	else if(clstype == 'Sale')
  	{
		$("#minprice").html('');
		$("#maxprice").html('');
    	
		$("#minprice").html($("#saleminprice").html());
		$("#maxprice").html($("#salemaxprice").html());
		
    	$('#minprice').multiselect("refresh");
		$('#maxprice').multiselect("refresh");
  	}
  	else
  	{
		$("#minprice").html('');
		$("#maxprice").html('');
    	
		$("#minprice").html($("#saleminprice").html());
		$("#maxprice").html($("#salemaxprice").html());
		
    	$('#minprice').multiselect("refresh");
		$('#maxprice').multiselect("refresh");
  	}
}
showhideprice();
</script> 

