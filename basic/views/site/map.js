var map;
    function initialize() {
        map = new google.maps.Map(document.getElementById('map'), {
            // peta indonesia
            center: {
                lat: -7.9784695,
                lng: 112.5617418
            },
            zoom: 9,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM
            }
        });

        // while($row = mysql_fetch_array($longlat)) {
        //     $lat = $row['latitude'];
        //     $lon = $row['longitude'];
        //     echo("addMarker($lat, $lon);\n");
        // }?>
    }

    google.maps.event.addDomListener(window, 'load', initialize);