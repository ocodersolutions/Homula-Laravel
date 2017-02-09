 var listingmap= $('#reListingOnMap');
  function listingMapInit() {
        var myLatlng = new google.maps.LatLng('<?php print $viewListingRow['latitude']; ?>','<?php print $viewListingRow['longitude']; ?>');
        var mapOptions = {
          zoom: 15,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('reListingOnMap'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map            
        });
      }
      
google.maps.event.addDomListener(window, 'load', listingMapInit);

