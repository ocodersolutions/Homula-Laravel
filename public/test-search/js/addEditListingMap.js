 var listingmap = $("#addListingMap");
 var map, marker;
  function addListingMapInit() {
        var myLatlng = new google.maps.LatLng('<?php print $fullRelisting['latitude']; ?>','<?php print $fullRelisting['longitude']; ?>');
        var geocoder = new google.maps.Geocoder();
        if(myLatlng.lat()==0 && myLatlng.lng()==0){ 
        geocoder.geocode( {'address' : '<?php print $vCity.", ".$vRegion.", ".$vCountry; ?>'}, function(results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
             myLatlng = results[0].geometry.location;
             map.setCenter(myLatlng);
             map.setZoom(10);
             }
           });    
         }
        
        var mapOptions = {
          zoom: 15,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('addListingMap'), mapOptions);

        marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: '<?php print __("You are here"); ?>'
        });
        
        google.maps.event.addListener(map, 'click', function(event) {
         marker.setMap(null);
         placeMarker(event.latLng);
        });
      }
      
google.maps.event.addDomListener(window, 'load', addListingMapInit);

function placeMarker(location) {
  marker = new google.maps.Marker({
      position: location,
      map: map
  });
$("#listingLatitude").val(location.lat());
$("#listingLongitude").val(location.lng()); 
}

