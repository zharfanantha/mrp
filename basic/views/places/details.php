<!-- <pre>
    <?= print_r($datnamkor) ?>;
</pre> -->

<?php
    //$jsonDatnamkor = json_encode($datnamkor);
    $this->title = 'Detail Places';
?>

<div class="fh5co-parallax" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/". $datnamkor[0]['img'];";" ?>);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
                    <div class="fh5co-intro fh5co-table-cell">
                        <h1 class="text-center"><?php echo $datnamkor[0]['nama_objek']; ?></h1>
                        <p>Surga Destinasi Wisata Jawa Timur</p>
                    </div>
                </div>
            </div>
        </div>
</div>
<div id="fh5co-contact-section">
    <div class="row">
        <div class="col-md-6">
            <div id="map"></div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h3><?php echo $datnamkor[0]['nama_objek']; ?></h3>
                <button id="direction" class="btn-primary btn-flat" style="float: right;">Directions</button>
                <p>Alamat<br><?php echo $datnamkor[0]['alamat']; ?></p>
                <p>Harga Tiket Masuk<br><img src="<?php echo Yii::$app->homeUrl."assets/images/ticket.png" ?>">&nbsp; Rp.<?php echo $datnamkor[0]['biaya'];?></p>
                <p>Riwayat Bencana<br><img src="<?php echo Yii::$app->homeUrl."assets/images/disaster.png" ?>">&nbsp; Sejak 2011, <?php echo $datnamkor[0]['bencana'];?> Kali</p>
                <p>Kategori<br><img src="<?php echo Yii::$app->homeUrl."assets/images/bath.png" ?>" style="width: 24px; height: 24px;">&nbsp; <?php echo $datnamkor[0]['kategori'];?></p>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i=0; $i < 20 ; $i++) { ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $datnamkor[$i]['review']; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAipJSjfkVSMGCmL10xbDjrJyTCxL3Uslc&language=in&region=ID"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
    var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/kml/paddle/red-circle-lv.png");
    var mylatlong = "";
    var mylat = "";
    var mylong = "";
    var map;
    var rute = []; // penampung rute

    function initialize() {
        cekLokasi();
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
            $lat = $datnamkor[0]['latitude'];
            $lon = $datnamkor[0]['longitude'];
            echo("addMarker($lat, $lon);\n");
        ?>
        

    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function addMarker(lat, lng) {
        var pt = new google.maps.LatLng(lat, lng);
        // bounds.extend(pt);
        var marker = new google.maps.Marker({
            position: pt,
            icon: icon,
            map: map
        });
    }

    function cekLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function showPosition(position) {
        mylat = position.coords.latitude;
        mylong = position.coords.longitude;
        mylatlong = mylat + "," + mylong;
        console.log(mylatlong);
        addMarker(mylat,mylong);
    }

    function hapusRute() {
        // cara.y yaitu kita set var rute = [] menjadi null
        for (var i = 0; i < rute.length; i++) {
            rute[i].setMap(null)
        }
    }

    function cariJarak() {
        hapusRute();
        <?php
            $lat = $datnamkor[0]['latitude'];
            $lon = $datnamkor[0]['longitude'];
            echo("jarak($lat, $lon);\n");
        ?>
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
        //hapusRute();
        // data request
        var request = {
            origin: mylatlong,
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

    $(function() {
        $("#direction").click(function() {
            cariJarak();
        });
    });

</script>