<?php
include 'connect.php';
	$koor = mysql_query("select latitude, longitude from koordinat_objek") or die (mysql_error());
	while($row = mysql_fetch_array($koor)) {
		$data_koor[] = $row;
		// print_r($row); echo "<br>";
	}
	// print_r($data_koor);
	$jsonKoor = json_encode($data_koor);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 70%;
        height: 100%;
      }
      #right-panel {
        margin: 20px;
        border-width: 2px;
        width: 20%;
        height: 400px;
        float: left;
        text-align: left;
        padding-top: 0;
      }
      #directions-panel {
        margin-top: 10px;
        background-color: #FFEE77;
        padding: 10px;
        overflow: scroll;
        height: 174px;
      }
    </style>
  </head>
  <body onload="getLocation()">
    <div id="map"></div>
    <div id="right-panel">
      <input type="submit" id="submit">
    <p id="demo"></p>
    <script>
    	var jsonK = JSON.parse('<?php echo $jsonKoor ?>');
    	var origin="";
    	var map=null;
    	var jarak = [];
    	var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png");
    	function initMap() {
	        var directionsService = new google.maps.DirectionsService;
	        var directionsDisplay = new google.maps.DirectionsRenderer;
	        map = new google.maps.Map(document.getElementById('map'), {
	          center: new google.maps.LatLng(-7.9784695,112.5617418),
		    zoom:9,
        });
	        <?php
				$data = mysql_query("select longitude, latitude from koordinat_objek") or die (mysql_error());
				while($row = mysql_fetch_array($data))
			    {
			      $lat = $row['latitude'];
			      $lon = $row['longitude'];
			      echo("addMarker($lat, $lon);\n");
			   }
			?>
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
        	// console.log(origin);
        	// console.log(jsonK);
        	for(var i=0 ; i < 10 ; i++){
        		calculateAndDisplayRoute(directionsService, directionsDisplay, jsonK[i]['latitude'], jsonK[i]['longitude']);
       		}
       		console.log(jarak);
       	});
       }

    function addMarker(lat, lng) {
		var pt = new google.maps.LatLng(lat, lng);
		// bounds.extend(pt);
		var marker = new google.maps.Marker({
			position: pt,
			icon: icon,
			map: map
		});
	}

    function getLocation() {
    	if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(showPosition);
	    } else { 
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}

	function showPosition(position) {
	    origin = position.coords.latitude + "," + position.coords.longitude;
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay, latdest, longdest) {
        directionsService.route({
          origin:origin,
          destination: latdest+","+longdest,
          optimizeWaypoints: false,
          travelMode: 'DRIVING'
        }, function(response, status) {
        	if (status === 'OK') {
	            directionsDisplay.setDirections(response);
	            var route = response.routes[0];
	            for (var i = 0; i < route.legs.length; i++) {
	              var routeSegment = i + 1;
	            	console.log(route.legs[i].distance.text);
	            	// jarak.push(route.legs[i].distance.text);
	            }
	        } else {
	        	window.alert('Directions request failed due to ' + status);
	        }
	    });
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0XrPfqdsYM-JoVs7cNwp_7VnaIVvtUzw&callback=initMap">
    </script>
  </body>
</html>