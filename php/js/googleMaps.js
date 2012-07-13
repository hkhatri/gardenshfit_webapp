function update_maps()
    {
           
        var data = $("#mapdataForm").serialize();
        
        var map;
        var geocoder = new google.maps.Geocoder();

        var markersArray = [];

        var raleigh = new google.maps.LatLng(35.7699298, -78.4469157);

        var mapOptions = {
            zoom: 8,
            center: raleigh,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

        google.maps.event.addListener(map, 'click', function(event) {

        });
            
            
            
        var markersArray = [];

        $.ajax({
        type:"POST",
        url:"http://localhost:8888/index.php/pages/get_mapdata",
        data: data,
        success: function(response)
            {
                         
                 var obj = jQuery.parseJSON(response);
                 
                  
                for(i=0; i< obj.length; i++)
                                        {

                                            if(!isNaN(obj[i].zipcode))
                                                {
                                                  
                                                  codeAddress(obj[i]);  

                                                }


                                        }                
                 
                 showOverlays();
                 

            }
        });
        
    
        function addMarker(lat, log) {
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, log),
                map: map
                });
                markersArray.push(marker);
        }


        function showOverlays() {
        if (markersArray) {
            for (i in markersArray) {
            markersArray[i].setMap(map);
            }
        }
        }
        
        
        function codeAddress(obj) {
            
            var address = obj.zipcode;
            
            geocoder.geocode( { 'address': address}, function(results, status) {
                
            
            if (status == google.maps.GeocoderStatus.OK) {
                
               
                var marker = new google.maps.Marker({
                    map: map, 
                    position: results[0].geometry.location,
                    title: obj.name

                    
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
            });
        }
           
             $("#map_canvas").dialog('open');
             $("#mapdataForm")[0].reset();
            
            
    }
    
    