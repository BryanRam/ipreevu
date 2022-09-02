      var map;
      
      //new google.maps.event.addDomListener(window, "load", initMap);
      
      function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};  
        //var test = document;
        //console.log(test);
        map = new google.maps.Map(document.getElementById('googleMap'), {
          center: myLatLng,
          zoom: 8
        });
        
        var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
        });
      }
      
     // map.event.addDomListener(window, "load", initMap);
    


