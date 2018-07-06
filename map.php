<?php
include 'connect.php';
// $query = mysql_query("select longitude, latitude from koordinat_objek") or die(mysql_error());
// while ($row = mysql_fetch_array($query)) {
// 	$lat = $row['longitude'];
// 	$lon = $row['latitude'];
// 	echo("$lat, $lon\n");
// }

?>

<!DOCTYPE html>
<html>
<body onload="myMap()">

<h1>Malang Raya GMaps</h1>

<div id="googleMap" style="width:800px;height:500px;"></div>

<script>
var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png");
var map = null;
// var bounds = new google.maps.LatLngBounds();
function addMarker(lat, lng) {
	var pt = new google.maps.LatLng(lat, lng);
	// bounds.extend(pt);
	var marker = new google.maps.Marker({
		position: pt,
		icon: icon,
		map: map
	});
}
function myMap() {
	var mapProp= {
	    center: new google.maps.LatLng(-7.9784695,112.5617418),
	    zoom:9,
	};
	map= new google.maps.Map(document.getElementById("googleMap"),mapProp);

	<?php
		$data = mysql_query("select longitude, latitude from koordinat_objek") or die (mysql_error());
		while($row = mysql_fetch_array($data))
	    {
	      $lat = $row['latitude'];
	      $lon = $row['longitude'];
	      echo("addMarker($lat, $lon);\n");
	   }
	?>
}
</script>

<script src="http://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBhbkEbun3YZN_GNw3_RJqA8vMTdE_tOR8&callback=myMap"></script>

</body>
</html>
