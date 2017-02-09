var mobject={};
    mobject.map=null;
    mobject.markers=[];
    mobject.markerids=[];
    mobject.markerClusterer=null;
    mobject.markerPop=null;
    mobject.geocoder=null;
    mobject.currentBounds=null;
    var remap=$('#mapResults');
    mobject.center=null;
  <?php if($mbtnClicked){ ?>
    mobject.clicked=true;
  <?php }else{ ?> 
    mobject.clicked=false;
  <?php } ?>      
   mobject.favclicked=false;
   
    function _(label,message){ window.console && console.log(label+": "+message);}
    function calculateCenter(){ 
		mobject.center = mobject.map.getCenter(); 
	}
    
    mobject.init= function(){
        var latlng = null;
        google.maps.visualRefresh = true;
             
        options = {
          'zoom': 14,
		  'styles':[{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}],
          'center': mobject.center,
          'mapTypeId': google.maps.MapTypeId.ROADMAP,
          scrollwheel: true,
          panControl: true,
          mapTypeControl: true,
      mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.RIGHT_TOP
          },
          panControlOptions: {
        <?php if($_SESSION["rtl"]){ ?> position: google.maps.ControlPosition.LEFT_TOP <?php }else{ ?>
          position: google.maps.ControlPosition.RIGHT_TOP
        <?php } ?>  
            },
          zoomControl: true,
          zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
       <?php if($_SESSION["rtl"]){ ?> position: google.maps.ControlPosition.LEFT_TOP <?php }else{ ?>
          position: google.maps.ControlPosition.RIGHT_TOP
        <?php } ?>
            },
			streetViewControl: true,
    		streetViewControlOptions: {
        <?php if($_SESSION["rtl"]){ ?> 	position: google.maps.ControlPosition.LEFT_TOP <?php }else{ ?>
		   position: google.maps.ControlPosition.RIGHT_TOP
    	 <?php } ?>	
			}
			
        };
        
        mobject.map = new google.maps.Map(document.getElementById('mapResults'), options);
      
        google.maps.event.addListener(mobject.map,'idle',function (event) { 
			calculateCenter(); 
		});
        google.maps.event.addListener(mobject.map, 'zoom_changed', function() { 
			loadTextData(0); 
			//$( "#sidebarTabs" ).tabs("select", "#sidebarResults"); // Hitesh for stop move to result section
		});
        google.maps.event.addListener(mobject.map, 'dragend', function() { 
			loadTextData(0); 
			//$( "#sidebarTabs" ).tabs("select", "#sidebarResults"); // Hitesh for stop move to result section
		});
        
        mobject.markerPop = new google.maps.InfoWindow();
        loadMapData();
  };
  
  
   $(window).resize(function () { loadMapData(); });
     
   mobject.geocoder = new google.maps.Geocoder();
        
    google.maps.event.addDomListener(window, 'load', mobject.init);
    google.maps.event.addDomListener(window, 'resize', function(){ 
      if(mobject.center!=null)mobject.map.setCenter(mobject.center); _("resize","yes"); });
    
      
    function getCoordinates(address){
      
     mobject.geocoder.geocode( {'address' : address}, function(results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
             mobject.center = results[0].geometry.location; 
             return mobject.center;
             }else{ return null;  }
           });    
     }
   
   $("#sidebarResults").on("click",".textrecord",function(){
	   	$('.gm-iv-close').trigger('click');
    	$("#theListing").hide("slow");
    	var clickedLatLong=$(".textlatlong",this).html();   
   		/* console.log(mobject.markerids);
    	console.log('val:'+mobject.markerids[clickedLatLong]); */
    	google.maps.event.trigger(mobject.markers[mobject.markerids[clickedLatLong]], 'click');
   });
           
    mobject.loadMarkers = function(data){ 
    
    mobject.clear();
    var tempArray={};
    var latLngStr;
    var shadow_marker = {url: 'images/markers/shadow.png', size: new google.maps.Size(51, 37), origin: new google.maps.Point(0,0),anchor: new google.maps.Point(0, 37)};
  	var mCounter=0;
  
    if(data!=null && $.trim(data)!=""){ 
    $('.nolisting').hide(); 
  
  $.each(data, function(index, d){  
       var latLng = new google.maps.LatLng(d.la,d.lo);
       var labelclass=""; 
       //alert(d.retype);
       if(d.pr!=0){
        <?php if($currency_before_price){ ?>
        d.pr="<?php print $defaultCurrency; ?>"+d.pr;
        <?php }else{ ?>
        d.pr=d.pr+" <?php print $defaultCurrency; ?>";
        <?php } ?>     
        if(d.su.indexOf("-a")>-1) labelclass="maplabels-a";
        if(d.su.indexOf("-b")>-1) labelclass="maplabels-b"; 
        if(d.su.indexOf("-c")>-1) labelclass="maplabels-c";
        if(d.su.indexOf("-d")>-1){ labelclass="maplabels-d"; d.su="symbol_num"; d.pr="<?php print __('Multiple'); ?>"; }
        if(d.lt==2){ labelclass="maplabelsFeatured"; } 
       }else{ 
        labelclass="maplabels2";  
        if(d.su.indexOf("-d")>-1){ d.su="symbol_num"; d.pr="<?php print __('Multiple'); ?>"; }
        d.pr="";
        }
        if(d.lt==2) mimage="featured.png"; else mimage=d.su+".png"; 
    
    /*
	if(d.subtype=='Apartment'){
      mimage="apartment-b.png";
      d.pr="<?php print __('Apartment'); ?>";
    }
	else if(d.subtype=='Finished'){
      mimage="gardenhome-b.png";
      d.pr="<?php print __('Finished'); ?>";
    }
    else if(d.subtype=='Sep Entrance'){
      mimage="shared-a.png";
      d.pr="<?php print __('Sep Entrance'); ?>";
    }
   else if(d.subtype=='Unfinished'){
      mimage="agricultural-a.png";
      d.pr="<?php print __('Unfinished'); ?>";
    }*/
    if(d.retype=='Residential'){
      mimage="house-a.png";
      d.pr="<?php print __('Residential'); ?>";
    }else if(d.retype=='Commercial'){
      mimage="industry-c.png";
      d.pr="<?php print __('Commercial'); ?>";
    }else if(d.retype=='Condo'){
      mimage="apartment-b.png";
      d.pr="<?php print __('Condo'); ?>";
    }
    
    if(d.classification=='Apartment'){
      mimage="apartment-b.png";
      d.pr="<?php print __('Apartment'); ?>"; 
    }
    
    
        var marker_image = {url: 'images/markers/'+mimage, size: new google.maps.Size(32, 37), origin: new google.maps.Point(0,0),anchor: new google.maps.Point(10, 37)};
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
    var marker = new google.maps.Marker({'position': latLng,'icon': marker_image,'shadow':shadow_marker});    
    }else{      
  var marker = new MarkerWithLabel({'position': latLng,'icon': marker_image,'shadow':shadow_marker, labelContent: d.pr, labelAnchor: new google.maps.Point(20, 0), labelClass: labelclass, labelStyle: {opacity: 0.75}});  
    }       
     latLngStr=latLng.toUrlValue(); 
       if(tempArray[latLngStr]==null){
       if(d.id==null) d.id=0; 
       mobject.markers.push(marker);
       mobject.markerids[d.la+","+d.lo]=mCounter;
       mCounter++;
       var fn = mobject.markerClickHandler(d.id, latLng);
       google.maps.event.addListener(marker, 'click', fn);
	   
	   // for put marker center position hitesh 
	   google.maps.event.addListener(marker, 'click', function() {
		   mobject.map.setCenter(marker.getPosition());
		});
    	// hitesh	
		
       //google.maps.event.addDomListener(document.getElementById('textrecord-1'), 'click', fn);
       mobject.bounds.extend(latLng);
       tempArray[latLngStr]=1;
       }        
   });
   mobject.map.setCenter(mobject.bounds.getCenter());
        
   mobject.markerClusterer = new MarkerClusterer(mobject.map, mobject.markers);
  
  <?php if($geoipenable!="yes"){ ?> 
   mobject.map.fitBounds(mobject.bounds);     
   var zoomLevel = mobject.map.getZoom(); _("zoom",zoomLevel);
   if(zoomLevel >=4 && mobject.clicked==true){ 
   	zoomLevel=zoomLevel-1; mobject.map.setZoom(zoomLevel); 
	}
   if(zoomLevel >=19){
   zoomLevel=18;
   mobject.map.setZoom(zoomLevel);
   }
  <?php }else{ ?> 
   var reCity=$.trim($('input#reCity').val());
   var reQuery=$.trim($('input#reQuery').val());
         
   if($.trim(reCity)=="" && $.trim(reQuery)=="" && mobject.clicked==false){
   var gLat=geoplugin_latitude();
   var gLong=geoplugin_longitude();
   
   
   var gLat='43.6532'; // hitesh
   var gLong='-79.3832'; // hitesh	
   
   var geoLatLng = new google.maps.LatLng(gLat, gLong);
   mobject.map.setCenter(geoLatLng);
   <?php if($defaultCityZoom>0){ ?>
   	//mobject.map.setZoom(<?php print $defaultCityZoom; ?>); Hitesh
   <?php }else{ ?>
   	mobject.map.setZoom(11);
   <?php } ?>
   }else{
   mobject.map.fitBounds(mobject.bounds);     
   var zoomLevel = mobject.map.getZoom(); 
   if(zoomLevel >=4 && mobject.clicked==true){ 
   		zoomLevel=zoomLevel-1; mobject.map.setZoom(zoomLevel); 
	}
   if(zoomLevel >=19){
   zoomLevel=18;  
   	mobject.map.setZoom(zoomLevel);
   }
   }
   
 <?php } ?>
    
	var gLat='43.6532'; // hitesh
   	var gLong='-79.3832'; // hitesh	
	var geoLatLng = new google.maps.LatLng(gLat, gLong);
   	mobject.map.setCenter(geoLatLng);
   	mobject.map.setZoom(11); //Hitesh
	//mobject.map.setZoom(10);/* Hitesh */
   }else{
           mobject.clear();
           var reCity=$.trim($('input#reCity').val());
           if($.trim(reCity)!=""){
           mobject.geocoder.geocode( {'address' : reCity}, function(results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
             mobject.map.setCenter(results[0].geometry.location);
             <?php if($defaultCityZoom>0){ ?>
          mobject.map.setZoom(<?php print $defaultCityZoom; ?>); 
        <?php }else{ ?>
		  mobject.map.setZoom(11);
        <?php } ?>
             }
          }); 
           }else{
             <?php if($geoipenable!="yes"){ ?> 
            <?php if($defaultcountry_latlng!=""){ 
            list($clat,$clong)=explode("::",$defaultcountry_latlng);  
            ?>
             var cgeoLatLng = new google.maps.LatLng("<?php print $clat; ?>", "<?php print $clong; ?>"); _("lat/lng1",cgeoLatLng);
         mobject.map.setCenter(cgeoLatLng);
             <?php if($defaultCountryZoom>0){ ?>
		  mobject.map.setZoom(<?php print $defaultCountryZoom; ?>); 
        <?php }else{ ?>
		  mobject.map.setZoom(4);
        <?php } 
        }else{ ?>
        var cgeoLatLng= new google.maps.LatLng("39.36827914916013","-101.865234375"); _("lat/lng2",cgeoLatLng);
        mobject.map.setCenter(cgeoLatLng);
		mobject.map.setZoom(<?php print $defaultCountryZoom; ?>);   
          <?php } ?>
          <?php }else{ ?>
          var gLat=geoplugin_latitude();
        var gLong=geoplugin_longitude();
        var geoLatLng = new google.maps.LatLng(gLat, gLong);
        mobject.map.setCenter(geoLatLng);
        <?php if($defaultCityZoom>0){ ?>
		mobject.map.setZoom(<?php print $defaultCityZoom; ?>); 
        <?php }else{ ?>
		mobject.map.setZoom(11);
        <?php } } ?>
   
           }
           $('.nolisting').show('slow');
       }
  };

    mobject.markerClickHandler = function(id,latLng){
      return function(e) {
       if(typeof e!='undefined'){
       e.cancelBubble = true;
       e.returnValue = false;
       if (e.stopPropagation) {
        e.stopPropagation();
        e.preventDefault();
        } 
       }
       
      /* console.log("clicked: "+id); */
     <?php
     $markerPopStyle="min-height:230px; min-width:700px;";
     if(isset($_SESSION["winwidth"]) && ($_SESSION["winwidth"]<=1024 && $_SESSION["winwidth"]>=768)){ $markerPopStyle="min-height:120px; min-width:350px;"; }
     if(isset($_SESSION["winwidth"]) && ($_SESSION["winwidth"]<768 && $_SESSION["winwidth"]>=500)){ $markerPopStyle="min-height:120px; min-width:250px;"; }
     if(isset($_SESSION["winwidth"]) && $_SESSION["winwidth"]<500){ $markerPopStyle="min-height:60px; min-width:150px;"; }
     ?>
       var infoHtml = '<div class="info" style="text-align:center; <?php print $markerPopStyle; ?>"><?php print __("Please wait, loading"); ?> ....<br /><br /><img src="images/loading2.gif" /></div>'; 
       mobject.markerPop.setContent(infoHtml);
       mobject.markerPop.setPosition(latLng);
       mobject.markerPop.open(mobject.map);
       /* ocoder syyle reponsive */
       var infobox = $(".gm-style-iw").parent().addClass('boxinfo');
       
      <?php if($readmin_settings['markerjsonurl']!=""){ ?>
      var url="<?php print trim($readmin_settings['markerjsonurl']).'?callback=?'; ?>"; 
      <?php }else{ ?> 
      var url="ajax.php"; 
      <?php } ?>
     	
       $.ajax({
          type: 'GET',    
          url: url,
          data:{id:id, latlng:latLng.toUrlValue()},
          <?php if($readmin_settings['markerjsonurl']!=""){ ?>
          dataType: "jsonp",
          crossDomain: true,     
          <?php } ?>       
          cache:false, 
          success: function(data){
            <?php if($readmin_settings['markerjsonurl']==""){ ?> data=$.parseJSON(data); <?php } ?>
            mobject.markerPop.setContent(data); 
            $("a[rel^='prettyPhoto']").prettyPhoto();
			addthis.layers.refresh();
          },
          error:function(jqXHR, textStatus, errorThrown){ /* alert(errorThrown); */ }
        });
        
      };
	  
    };
    
    mobject.getBounds=function(){
    var bounds = mobject.map.getBounds();
    var ne = bounds.getNorthEast();
    var sw = bounds.getSouthWest();   
    };
   
   mobject.clear = function() {
        for (var i = 0, marker; marker = mobject.markers[i]; i++) {
          marker.setMap(null);
        }
        mobject.markers=[];
        if (mobject.markerClusterer) mobject.markerClusterer.clearMarkers();
        mobject.bounds=null;
        mobject.bounds = new google.maps.LatLngBounds ();
        
   };
   $('.nav .first_item').addClass("active");
  
   $('#reSearchMap2').click(function() {
	   $('.gm-iv-close').trigger('click');
	  $("#default_load").val(1);
      mobject.clicked=true;
      mobject.favclicked=false;
      mobject.markerPop.close();
      $("#theListing").hide("slow");
      $('.nav .favli').removeClass("active");
      $('.nav .first_item').addClass("active");
      loadMapData();  
      $( "#sidebarTabs" ).tabs("select", "#sidebarResults");  
      <?php if(isset($_GET['hidesidebar'])){ ?>
    toggleSlidebar();
      <?php } ?> 
      if($(window).width()<=768){ toggleSlidebar(); }
   });
   
   $('.nav .favli').click(function(event){
      event.preventDefault(); 
    $('.nav li').removeClass("active");
    $(this).addClass("active");
    mobject.favclicked=true;
    loadMapData();
  });

  $("#sidebarTabs").on("click","#textResultsTable li:not(.disabled) a", function(){
      var clickedLinkid=this.id;
      var allData=clickedLinkid.split("-");
      loadTextData(allData[1]);
    }); 
   
  var successMapTextData=function(data){ 
   $("#MapLoadingImage").hide();  
     $("#sidebarResults").html(data); // Hitesh for stop move to result section
	 addthis.layers.refresh();
  /* condole.log("alldata: "+data); */
  };

	function loadTextData(pagenum){
    	$("#MapLoadingImage").show();    
       	$("#sidebarResults").html("<p align='center'>Loading ....</p>");
                       
       	mobject.currentBounds=mobject.map.getBounds();
    
     	var neCoordinates=mobject.currentBounds.getNorthEast();
     	var swCoordinates=mobject.currentBounds.getSouthWest();
     	var neLat=neCoordinates.lat();
     	var neLong=neCoordinates.lng();
     	var swLat=swCoordinates.lat();
     	var swLong=swCoordinates.lng();
     
     	if(neCoordinates.lng() < 0 && (swCoordinates.lng() > neCoordinates.lng())){ neLong=180; swLong=-180; }
     	if(neCoordinates.lng() > 0 && (swCoordinates.lng() > neCoordinates.lng())){ neLong=180; swLong=-180; }
     
    	var reClassification	= $.trim($('#reClassification').val());
      	var reType				= $.trim($('#reType').val());
      	/*
		var reSubtype=""; var reBedrooms=""; var reBathrooms=""; 
      	if($("#reSubtypeRange").css('display') != 'none') reSubtype=$.trim($('select#reSubtype').val());
      	if($(".onlyResidential").css('display') != 'none') reSubtype=$.trim($('select#reSubtypeResidential').val());
      	if($(".onlyCommercial").css('display') != 'none') reSubtype=$.trim($('select#reSubtypeCommercial').val());
      	if($(".nonCommercial").css('display') != 'none'){
        	reBedrooms=$.trim($('select#reBedrooms').val());
        	reBathrooms=$.trim($('select#reBathrooms').val());
      	} 
		*/
      	//var rePrice=$.trim($('select#rePrice').val());
      	//var reQuery=$.trim($('input#reQuery').val());
      	//var reCity=$.trim($('input#reCity').val());
      	var favorite=0;
    
    	// Start : Hitesh New Vars
    	//var moresubtype = $.trim($('select#moresubtype').val());
    	//var moreaddress = $.trim($('input#moreaddress').val());
    	//var morefrom = $.trim($('select#morefrom').val());
    	// End : Hitesh New Vars
    
      	if(mobject.favclicked==true) favorite=1;
     
      	<?php if($readmin_settings['jsontexturl']!=""){ ?>
      		var url="<?php print trim($readmin_settings['jsontexturl']).'?callback=?'; ?>"; 
      	<?php }else{ ?> 
      		var url="jsonTextData.php"; 
      	<?php } ?>
           
		
		// Start : New fields from new design
		//var minprice 	= $('select#minprice').val();
		//var maxprice 	= $('select#maxprice').val();
		//var othertype	= $('select#othertype').val();
		//var style		= $('select#style').val();
		//var bedrooms	= $('#selectedbedrooms').val();
		// End : New fields from new design  
		
		// Start : New fields from new design
		var minprice 	= $('select#minprice').val();
		var maxprice 	= $('select#maxprice').val();
		var othertype	= $('select#othertype').val();
		var style		= $('select#style').val();
		var bedrooms	= $('#selectedbedrooms').val();
		var bedplus		= $('#bedroomplus').val();
		var bathrooms	= $('#selectedbathrooms').val();
		var heatsource	= $("select#heatingSource").val();
		var cooling		= $("select#cooling").val();
		var basement	= $("select#basement").val();
		var kitchens 	= $("#selectedkitchens").val();
		var exterior	= $('select#exterior').val();
		var pool		= $('select#pool').val();
		var laundry		= $('select#laundry').val();
		var furnished	= $('#furnished').val();
		var heatinc		= $('#heatingIncluded').is(':checked');
		var hydroinc	= $('#hydroIncluded').is(':checked'); 
		var squarefeet	= $('select#squarefeet').val();
		var exposure	= $('select#exposure').val();
		var pets		= $('#pets').val();
		var locker		= $('#locker').is(':checked'); 
		var city		= $('#city').val();
		var postal		= $('#postal').val();
		// End : New fields from new design
     	$.ajax({
        	type: 'GET',    
          	url: url,          
          	//data:{classification:reClassification,type:reType,subtype:reSubtype,bedrooms:reBedrooms,bathrooms:reBathrooms,price:rePrice,requery:reQuery,city:reCity,favorite:favorite,nelatitude:neLat,nelongitude:neLong,swlatitude:swLat,swlongitude:swLong,pagenum:pagenum},
      		data:{classification:reClassification,
          		  type:reType,
        		  //subtype:reSubtype,
				  bedrooms:bedrooms,
          		  bathrooms:bathrooms,
				  //price:rePrice,
				  //requery:reQuery,
				  //city:reCity,
				  favorite:favorite,
				  nelatitude:neLat,
				  nelongitude:neLong,
				  swlatitude:swLat,
				  swlongitude:swLong,
				  pagenum:pagenum,
				  //moresubtype:moresubtype,
				  //moreaddress:moreaddress,
				  //morefrom:morefrom,
				  minprice:minprice,
				  maxprice:maxprice,
				  othertype:othertype,
				  style:style,
				  bedplus:bedplus,
				  heatsource:heatsource,
				  cooling:cooling,
				  basement:basement,
				  bedrooms:bedrooms,
				  kitchens:kitchens,
				  exterior:exterior,
				  pool:pool,
				  laundry:laundry,
				  furnished:furnished,
				  heatinc:heatinc,
				  hydroinc:hydroinc,
				  squarefeet:squarefeet,
				  exposure:exposure,
				  pets:pets,
				  locker:locker,
				  city:city,
				  postal:postal
				},
		  <?php if($readmin_settings['jsontexturl']!=""){ 
			   if(strpos($_SERVER['HTTP_HOST'],$readmin_settings['jsontexturl']) === false && strpos($readmin_settings['jsontexturl'],$_SERVER['HTTP_HOST']) === false ){
					?>
				  dataType: "jsonp",
				  crossDomain: true,     
		  <?php } 
		  } 
		  ?>       
          cache:false, 
          success: successMapTextData,
          error:function(jqXHR, textStatus, errorThrown){ /* alert(errorThrown); */ }
        });
   }
   
        
   	var successMapData=function(data){ 
   		var resultHtml=[]; 
       	<?php if(trim($readmin_settings['jsonurl'])==""){ ?>
       		data = $.parseJSON(data); 
       	<?php } ?> 
       	$('.nolisting').hide();
       	/*_('data',data); */
       	mobject.loadMarkers(data);
       
       	$("#MapLoadingImage").hide();
       	//alert(4)
		//setTimeout(function(){loadTextData(0);}, 1000);  //Hitesh
	   	google.maps.event.trigger(mobject.map, 'resize');
	   
    };
         
	function loadMapData(){
		$("#MapLoadingImage").show(); 
      	<?php if($readmin_settings['jsonurl']!=""){ ?>
      		var url="<?php print trim($readmin_settings['jsonurl']).'?callback=?'; ?>"; 
      	<?php }else{ ?> 
      		var url="jsonData.php"; 
      	<?php } ?>
      	//var reClassification=$.trim($('select#reClassification').val());
		var reClassification=$.trim($('#reClassification').val());
      	//var reType=$.trim($('select#reType').val());
		var reType=$.trim($('#reType').val());
      	/*
		var reSubtype=""; var reBedrooms=""; var reBathrooms=""; 
      	if($("#reSubtypeRange").css('display') != 'none') reSubtype=$.trim($('select#reSubtype').val());
      	if($(".onlyResidential").css('display') != 'none') reSubtype=$.trim($('select#reSubtypeResidential').val());
      	if($(".onlyCommercial").css('display') != 'none') reSubtype=$.trim($('select#reSubtypeCommercial').val());
      	if($(".nonCommercial").css('display') != 'none'){
        	reBedrooms=$.trim($('select#reBedrooms').val());
        	reBathrooms=$.trim($('select#reBathrooms').val());
      	} 
      	var rePrice=$.trim($('select#rePrice').val());
      	var reQuery=$.trim($('input#reQuery').val());
      	var reCity=$.trim($('input#reCity').val());
    	*/	
	  	var default_load=$.trim($('input#default_load').val());
	  	var gLat  = geoplugin_latitude();
   	  	var gLong = geoplugin_longitude();
	
		
	  	var gLat='43.6532'; // hitesh
      	var gLong='-79.3832'; // hitesh	
		
      	// Start : Hitesh New Vars
      	//var moresubtype = $.trim($('select#moresubtype').val());
      	//var moreaddress = $.trim($('input#moreaddress').val());
      	//var morefrom = $.trim($('select#morefrom').val());
      	// End : Hitesh New Vars
    
      	var favorite=0;
		
		
		// Start : New fields from new design
		var minprice 	= $('select#minprice').val();
		var maxprice 	= $('select#maxprice').val();
		var othertype	= $('select#othertype').val();
		var style		= $('select#style').val();
		var bedrooms	= $('#selectedbedrooms').val();
		var bedplus		= $('#bedroomplus').val();
		var bathrooms	= $('#selectedbathrooms').val();
		var heatsource	= $("select#heatingSource").val();
		var cooling		= $("select#cooling").val();
		var basement	= $("select#basement").val();
		var kitchens 	= $("#selectedkitchens").val();
		var exterior	= $('select#exterior').val();
		var pool		= $('select#pool').val();
		var laundry		= $('select#laundry').val();
		var furnished	= $('#furnished').val();
		var heatinc		= $('#heatingIncluded').is(':checked');
		var hydroinc	= $('#hydroIncluded').is(':checked'); 
		var squarefeet	= $('select#squarefeet').val();
		var exposure	= $('select#exposure').val();
		var pets		= $('#pets').val();
		var locker		= $('#locker').is(':checked'); 
		var city		= $('#city').val();
		var postal		= $('#postal').val();
		 
		// End : New fields from new design
      	if(mobject.favclicked==true) favorite=1;
       	$.ajax({
        	type: 'GET',    
          	url: url,
          	//data:{classification:reClassification,type:reType,subtype:reSubtype,bedrooms:reBedrooms,bathrooms:reBathrooms,price:rePrice,requery:reQuery,city:reCity,favorite:favorite},
      		data:{classification:reClassification,
					type:reType,
					//subtype:reSubtype,
					bedrooms:bedrooms,
					bathrooms:bathrooms,
					//price:rePrice,
					//requery:reQuery,
					//city:reCity,
					favorite:favorite,
					//moresubtype:moresubtype,
					//moreaddress:moreaddress,
					//morefrom:morefrom,
					default_load:default_load,
					gLat:gLat,
					gLong:gLong,
					minprice:minprice,
					maxprice:maxprice,
					othertype:othertype,
					style:style,
					bedplus:bedplus,
					heatsource:heatsource,
					cooling:cooling,
					basement:basement,
					bedrooms:bedrooms,
					kitchens:kitchens,
					exterior:exterior,
					pool:pool,
					laundry:laundry,
					furnished:furnished,
					heatinc:heatinc,
					hydroinc:hydroinc,
					squarefeet:squarefeet,
					exposure:exposure,
					pets:pets,
					locker:locker,
					city:city,
					postal:postal
			},
          	<?php if($readmin_settings['jsonurl']!=""){ ?>
          		dataType: "jsonp",
          		crossDomain: true,     
          	<?php } ?>       
          	cache:false, 
          	success: successMapData,
          	error:function(jqXHR, textStatus, errorThrown){ /* alert(errorThrown); */ }
        });
   	}
	
	$('#mapzoomin').click(function(){
		var orizoom = mobject.map.getZoom();
		mobject.map.setZoom(orizoom+1);
	});
	
	$('#mapzoomout').click(function(){
		var orizoom = mobject.map.getZoom();
		mobject.map.setZoom(orizoom-1);
	});
	
	$('#mapright').click(function(){
		mobject.map.panBy(200, 0);
	});
	
	$('#mapleft').click(function(){
		mobject.map.panBy(-200, 0);
	});
	
	$('#maptop').click(function(){
		mobject.map.panBy(0, -200);
	});
	
	$('#mapbottom').click(function(){
		mobject.map.panBy(0, 200);
	});
	
	$('#streetviewtmpdiv').click(function(evt,id,streetlat,streetlong){
		
		$('.boxinfo').each(function(){
			$(this).hide();
		});
		$('.gm-style-pbc+div').css({"opacity":"0"});
		
		var panoramaOptions = {
		position: new google.maps.LatLng(streetlat,streetlong),
		mode : 'webgl',
		pov: {
		  heading: 100,
		  pitch: 4
		},
		visible: true,
		addressControlOptions: { 
		    	position: google.maps.ControlPosition.TOP_CENTER 
    		},
			enableCloseButton: true
	  };
	 
	  var panorama = new google.maps.StreetViewPanorama(document.getElementById('mapResults'), panoramaOptions);
	
		var image = 'images/map-marker.png';
	   var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(streetlat,streetlong),
		  map: panorama,
		  title: 'Real Estate Homula',
		  icon: image
	  });
	  /*
	  var contentString = '<div id="content">'+
		  '<div id="siteNotice">'+
		  '</div>'+
		  '<h1 id="firstHeading" class="firstHeading"> Statue of Liberty </h1>'+
		  '<div id="bodyContent">'+
		  '<p><b>Pedestrian Walk</b>'+
		  '</div>'+
		' <input type="button" value="Click here" onclick="toggleStreetView();"></input>'+
		  '</div>';
		*/ 
		 var latLng = new google.maps.LatLng(streetlat,streetlong);
		 var id = id;
		 
		 <?php if($readmin_settings['markerjsonurl']!=""){ ?>
		  var url="<?php print trim($readmin_settings['markerjsonurl']).'?callback=?'; ?>"; 
		  <?php }else{ ?> 
		  var url="ajax.php"; 
		  <?php } ?>
		  
		 $.ajax({
          type: 'GET',    
          url: url,
          data:{id:id, latlng:latLng.toUrlValue()},
          <?php if($readmin_settings['markerjsonurl']!=""){ ?>
          dataType: "jsonp",
          crossDomain: true,     
          <?php } ?>       
          cache:false, 
          success: function(data){
            <?php if($readmin_settings['markerjsonurl']==""){ ?> data=$.parseJSON(data); <?php } ?>
            mobject.markerPop.setContent(data); 
		    var contentString1 = data;
			var infowindow = new google.maps.InfoWindow({
			 content: contentString1
			 });
		  
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(panorama,marker);
		  });
		   google.maps.event.addListener(panorama, "closeclick", function() {
			   $('.boxinfo').each(function(){
					$(this).hide();
				});
				$('.gm-style-pbc+div').css({"opacity":"0"});
    	   });
			    
          },
          error:function(jqXHR, textStatus, errorThrown){ // alert(errorThrown); 
		   }
        }); 
	});
	

var sidebarVisible=1;
$('#hidebar, #showbar').click(function(){
toggleSlidebar();
});
<?php print "/* windwidth: ".$_SESSION["winwidth"]."*/"; ?>
<?php if(isset($_GET['hidesidebar'])){ ?>
toggleSlidebar();
<?php } ?> 
if($(window).width()<=768){ toggleSlidebar(); }

function toggleSlidebar(){
	if($("#sidebar1:visible").length == 1 || $("#sidebarResults:visible").length == 1) sidebarVisible=0; else sidebarVisible=1;
	$('#sidebar').toggle('slide', {direction: '<?php if($rtl) print "right"; else print "left"; ?>'}, 500);
	$('#showbar').toggle('slide', {direction: '<?php if($rtl) print "right"; else print "left"; ?>'}, 500);
	$(".tooltip").hide();
	setWidthHeight();
	//google.maps.event.trigger(mobject.map, "resize"); 
	
	/* Hitesh for sidebar show/hide*/	
	var $mainContent = $('#mainContent');
	$mainContent.toggleClass('isOut');
	var isOut = $mainContent.hasClass('isOut');
    $mainContent.animate({marginLeft: isOut ? '0' : '315px'}, 300);
	$(window).resize();
}
/*
$('#mainContent').on('click', '#theListingLink', function (event){   
event.preventDefault();
});
*/
 
$('#mainContent').on('click', '#theListingLink', function (event){
       //$("#listingImage a").lightBox();
     event.preventDefault();
       $("#theListing").show("slow");
       
       $("#theListing").html("<div style='margin-left:50%; margin-top:25%;'><b><?php print __('Loading'); ?>....</b><br /><br /><img src='images/loading1b.gif' /></div>");
        var idNum = $("span",this).attr("id");
        <?php if($readmin_settings['listingjsonurl']==""){ ?>
        //infoResults(idNum,23,'theListing'); 
        $.ajax({ type: 'GET', url: 'infoResults.php', data:{q:idNum, type:23}, success: function(data){ 
          $('#theListing').html(data); 
          $('#rememberAction').css('background-color',$('body').css('background-color'));
      $('#rememberAction').css('color',$('body').css('color'));
      $('#rememberAction').css('font-family',$('body').css('font-family'));
      $("a[rel^='prettyPhoto']").prettyPhoto();
      $("#ws-walkscore-tile").hide();
      //$("#listingImage a").lightBox();
      //$('#rememberAction').css('line-height',$('body').css('line-height'));
          }});
        <?php }else{ ?>
        var url="<?php print trim($readmin_settings['listingjsonurl']).'?callback=?'; ?>";    
         $.ajax({
          type: 'GET',    
          url: url,
          data:{id:idNum},
          dataType: "jsonp",
          crossDomain: true,     
          cache:false, 
          success: function(data){ 
            $("#theListing").html(data);
             
          },
          error:function(jqXHR, textStatus, errorThrown){ /* alert(errorThrown); */ }
          });
          
          <?php } ?>
          
      $('#theListing').css('overflow', 'auto');
      //$("#listingImage a").lightBox();
   });
