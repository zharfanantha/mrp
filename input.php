<?php
include 'connect.php';
	$koor = mysql_query("select latitude, longitude from koordinat_objek") or die (mysql_error());
	while($row = mysql_fetch_array($koor)) {
		$data_koor[] = $row;
		// print_r($row); echo "<br>";
	}
	// print_r($data_koor);
	$jsonKoor = json_encode($data_koor);
	$text = "117 km";
	echo substr($text, 0, strlen($text)-3);
?>

<!DOCTYPE html>
<html>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<body>

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<script>
	$(document).ready(function() {
		var jsonK = JSON.parse('<?php echo $jsonKoor ?>');
		// console.log(jsonK);
		$.ajax({
			type: "POST",
			url: 'coba.php',
			data: {
				data: jsonK,
			},
			dataType: "html",
			success: function(msg){
				console.log(msg);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				console.log(XMLHttpRequest+textStatus+errorThrown);
			},
		});
		// $.getJSON({
		// 	url: 'https://maps.googleapis.com/maps/api/directions/json?origin=-7.276662099999999,112.79463009999999&destination=-7.741727,112.534377&key=AIzaSyC0XrPfqdsYM-JoVs7cNwp_7VnaIVvtUzw&mode=driving',
		// })
	})

var x = document.getElementById("demo");



function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>

</body>
</html>