<?php
	include 'connect.php';
	$koor = mysql_query("SELECT a.nama_objek, a.kategori, b.latitude, b.longitude FROM data_objek a, koordinat_objek b WHERE a.id_objek=b.id_objek") or die (mysql_error());
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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
#map {
	width: 70%;
	height: 100%;
}

.samping {
	position: absolute;
	top: 0px;
	right: 0px;
	width: 30%;
	height: 100%;
	overflow: auto;
}

.samping div {
	width: 100%;
	padding: 10px;
	box-sizing: border-box;
}


/* Optional: Makes the sample page fill the window. */
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}</style>
	</head>
	<body>

<div id="map"></div>
<div class="samping">
	<div>
		<h3>Lokasi Saya</h3>
		<input type="text" id="lat" placeholder="Latitude" title="Latitude"/>
		<input type="text" id="long" placeholder="Longitude" title="Longitude"/>
		<button id="add">Check My Location</button>
		<hr>
		<h3>Input Batas Jarak</h3>
		<h5>Batas Bawah : <br><input type="text" id="bawah" placeholder="Batas Bawah" title="Bawah" required /></h5>
		<h5>Batas Tengah :<br><input type="text" id="tengah" placeholder="Batas Tengah" title="Tengah" required /></h5>
		<h5>Batas Atas : <br><input type="text" id="atas" placeholder="Batas Atas" title="Atas" required /></h5>
		<hr>
		<h3>Input Batas Biaya</h3>
		<h5>Batas Bawah : <br><input type="text" id="bbawah" placeholder="Batas Bawah" title="Bawah" required /></h5>
		<h5>Batas Tengah :<br><input type="text" id="btengah" placeholder="Batas Tengah" title="Tengah" required /></h5>
		<h5>Batas Atas : <br><input type="text" id="batas" placeholder="Batas Atas" title="Atas" required /></h5>
		<button id="cari">Cari Rekomendasi !</button>
	</div>          
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCky3lMoHy8nS_Rk-7_KX938m6LXs4rnks&language=in&region=ID"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>

<script>// GPS

var lokasiSaya = "";
// Contoh data lokasi perusahaan
// atau ambil dari database
var perusahaan = JSON.parse('<?php echo $jsonKoor ?>');
// console.log(perusahaan.length);

var map;
var dist = [];
var lat = [];
var long = [];
var jalan = [];
var lokasi = []; // penampung maker supaya bisa menampilkan banyak marker dan dinamis
var rute = []; // penampung rute
var btsbwh, btstgh, btsats;
var bbtsbwh, bbtstgh, bbtsats;

// merubah icon atau sobat bisa menggunakan icon sobat sendiri sesuai keinginan
// tinggal masukan url image.y di bawah
var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/kml/paddle/red-circle-lv.png");

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

	<?php
	$data = mysql_query("select longitude, latitude from koordinat_objek") or die (mysql_error());
	while($row = mysql_fetch_array($data)) {
		$lat = $row['latitude'];
		$lon = $row['longitude'];
		echo("addMarker($lat, $lon);\n");
	}?>
}

google.maps.event.addDomListener(window, 'load', initialize);

// fungsi untuk menampilkan data perusahaan ke maps
function addMarker(lat, lng) {
	var pt = new google.maps.LatLng(lat, lng);
	// bounds.extend(pt);
	var marker = new google.maps.Marker({
		position: pt,
		icon: icon,
		map: map
	});
}

function addLokasi() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}
function showPosition(position) {
	lokasiSaya = position.coords.latitude + "," + position.coords.longitude;
	document.getElementById("lat").value = position.coords.latitude;
	document.getElementById("long").value = position.coords.longitude;
	console.log(lokasiSaya);
}

function hapusRute() {
	// cara.y yaitu kita set var rute = [] menjadi null
	for (var i = 0; i < rute.length; i++) {
		rute[i].setMap(null)
	}
}

function cariJarak() {
	hapusRute();
	var count = -1;
	// console.log("Perusahaan.length "+perusahaan.length);
		for (var i = 0; i < perusahaan.length; i++) {
			// console.log(perusahaan.length);
			setTimeout(function(y){
				lat.push(perusahaan[y]['latitude']);
				long.push(perusahaan[y]['longitude']);
				if(typeof callback == 'function'){
					// cek();
					jarak(perusahaan[y]['latitude'],perusahaan[y]['longitude']);
					count++;
					callback(count);
				}
			}, 1000*i,i);
		}
}

function callback(count) {
	// console.log("DISTANCE callback = "+dist);
	if(count == perusahaan.length-1) {
		cek();
	}
}

function cek() {
	// console.log(btsbwh); console.log(btsbwhtgh); console.log(btsatstgh); console.log(btsats);
	$.ajax({
			type: "POST",
			url: "input_fuzzy.php",
			data: {
				jarak: dist,
				lat: lat,
				long: long,
				origin: lokasiSaya,
				bwh: btsbwh,
				tgh: btstgh,
				ats: btsats,
				bbwh: bbtsbwh,
				btgh: bbtstgh,
				bats: bbtsats,
			},
			success: function(msg){
				console.log(msg);
				window.location.href = 'hasil_input.php'
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				console.log(XMLHttpRequest+textStatus+errorThrown);
			},
		});
	// console.log(dist); console.log(lat); console.log(long);
	// console.log(dist.length);
}

// kita buat funsi jarak
function jarak(lat,long) {
	var a = new google.maps.DirectionsService();
	var b = new google.maps.DirectionsRenderer({
		preserveViewport: true
	});
	// menamppilkan rute di maps
	b.setMap(map);
	// menambahkan rute baru ke array rute
	rute.push(b);
	// data request
	var request = {
		origin: lokasiSaya,
		destination: lat+","+long,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	a.route(request, function(response, status) {
	// console.log(google.maps.DirectionsStatus);
		if (status == google.maps.DirectionsStatus.OK) {
			var route = response.routes[0];
			b.setDirections(response);
			// console.log(route.legs.length);
			for (var i = 0; i < route.legs.length; i++) {
				var routeSegment = i + 1;
				// console.log(route.legs[i].distance.text);
				dist.push(route.legs[i].distance.text);
			}
		} else {
			console.log('Error, Try again');
		}
	});

}

// function.y sudah tinggal kita panggi function finLokasi.y
$(function() {

	$("#add").click(function() {
		addLokasi();

	});

	$("#hapus").click(function() {
		hapusLokasi();
	});

	$("#cari").click(function() {
		cariJarak();
		btsbwh = document.getElementById("bawah").value;
		btstgh = document.getElementById("tengah").value;
		btsats = document.getElementById("atas").value;
		bbtsbwh = document.getElementById("bbawah").value;
		bbtstgh = document.getElementById("btengah").value;
		bbtsats = document.getElementById("batas").value;
		// console.log(btsbwh); console.log(btsbwhtgh); console.log(btsatstgh); console.log(btsats);
		// cek();
		 
	});

	$("body").on('click', '.detail', function() {
		lokasiSaya = ($("#lokasi").val() == '' ? lokasiSaya : $("#lokasi").val());
		// menghapus rute sebelum.y yang di maps
		hapusRute();
		// menampilkan rute baru
		jarak($(this).data('alamat'));
	});

});</script>
	</body>
</html>