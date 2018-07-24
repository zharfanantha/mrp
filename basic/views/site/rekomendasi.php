<!-- <pre>
 $longlat = (new \yii\db\Query())
                    ->select(['longitude', 'latitude'])
                    ->from('koordinat_objek')
                    ->all();
</pre> -->
<!-- <p>==> Asli <?= print_r($datnamkor) ?></p>

<p>==> Sort <?= print_r($datnamkor) ?></p> -->
<?php
    $jsonKoor = json_encode($longlat);
    $jsonDatbnc = json_encode($datbnc);
    $jsonDathtm = json_encode($dathtm);
    $jsonDatskor = json_encode($datskor);
    $jsonBatbnc = json_encode($batbnc);
    $jsonBatskor = json_encode($batskor);
    $jsonDatnamkor = json_encode($datnamkor);
    $this->title = 'Rekomendasi Objek Wisata';
?>

<div class="fh5co-parallax" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/paralayang.jpg"; ?>);" data-stellar-background-ratio="0.5">
        <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-12 col-md-offset-0 text-center slider-text">
                        <div class="slider-text-inner js-fullheight">
                            <div class="desc">
                                <br><br><br><br><br>
                                <p><span>Malang Raya Pride</span></p>
                                <h2>Recommend You The New Way</h2>
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
            <div class="col-md-12" id="input">
                <div class="row">
                    <h3>Lokasi Saya</h3>
                    <input type="text" id="lat" placeholder="Latitude" title="Latitude" style="width: 150px; height: 34px;" />
                    <input type="text" id="long" placeholder="Longitude" title="Longitude" style="width: 150px; height: 34px;"/>
                    <button id="add">Check My Location</button>
                    <br><br>
                    <h3>Input Batas Jarak</h3>
                    <h5>Batas Jarak Terdekat : <br><input type="text" id="bawah" placeholder="Contoh : 50" title="Bawah" required /> Kilometer</h5>
                    <h5>Batas Jarak Normal :<br><input type="text" id="tengah" placeholder="Contoh : 100" title="Tengah" required /> Kilometer</h5>
                    <h5>Batas Jarak Jauh : <br><input type="text" id="atas" placeholder="Contoh : 200" title="Atas" required /> Kilometer</h5>
                    
                    <h3>Input Batas Budget (Perjalanan + HTM)</h3>
                    <h5>Batas Budget Termurah : <br>Rp <input type="text" id="bbawah" placeholder="Contoh : 50000" title="Bawah" required /></h5>
                    <h5>Batas Budget Normal :<br>Rp <input type="text" id="btengah" placeholder="Contoh : 100000" title="Tengah" required /></h5>
                    <h5>Batas Budget Mahal : <br>Rp <input type="text" id="batas" placeholder="Contoh : 200000" title="Atas" required /></h5>
                    <button id="cari">Cari Rekomendasi !</button>
                </div>
            </div>
            <div class="col-md-12" id="list_rekom">
                <div class="row">
                    <h3>Hasil Perhitungan Fuzzy & Sentimen Analisis</h3>
                    <a class="list-group-item home-description left" style="width: 50%; float: left;">
                        <h4>Hasil Fuzzy + Sentimen</h4>
                        <div id="tes"></div>
                    </a>
                    <a class="list-group-item home-description right" style="width: 50%; float: right;">
                        <h4>Hasil Sentimen sebagai atribut</h4>
                        <div id="tessen"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loader">
    <img src="<?php echo Yii::$app->homeUrl."assets/images/loader.gif" ?>">
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAipJSjfkVSMGCmL10xbDjrJyTCxL3Uslc&language=in&region=ID"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
    var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/kml/paddle/red-circle-lv.png");
    var map;
    var lokasiSaya = "";
    // Contoh data lokasi perusahaan
    // atau ambil dari database
    var perusahaan = JSON.parse('<?php echo $jsonKoor ?>');
    var datbnc = JSON.parse('<?php echo $jsonDatbnc ?>');
    var dathtm = JSON.parse('<?php echo $jsonDathtm ?>');
    var datskor = JSON.parse('<?php echo $jsonDatskor ?>');
    var batbnc = JSON.parse('<?php echo $jsonBatbnc ?>');
    var batskor = JSON.parse('<?php echo $jsonBatskor ?>');
    var datnamkor = JSON.parse('<?php echo $jsonDatnamkor ?>');
    // console.log(perusahaan.length);

    var dist = [];
    var lat = [];
    var long = [];
    var jalan = [];
    var lokasi = []; // penampung maker supaya bisa menampilkan banyak marker dan dinamis
    var rute = []; // penampung rute
    var markers = [];
    var btsbwh, btstgh, btsats;
    var bbtsbwh, bbtstgh, bbtsats;

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
        foreach ($longlat as $row) {
            $lat = $row['latitude'];
            $lon = $row['longitude'];
            echo("addMarker($lat, $lon);\n");
        }
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
        markers.push(marker);
    }
    function deleteMarkers() {
        setMapOnAll(null);
        markers = [];
    }
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
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
        addMarker(position.coords.latitude,position.coords.longitude);
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
            ceksen();
        }
    }

    function cek() {
    // console.log(btsbwh); console.log(btsbwhtgh); console.log(btsatstgh); console.log(btsats);
    $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->homeUrl ?>site/fuzzy",
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
                datbnc: datbnc,
                dathtm: dathtm,
                datskor: datskor,
                batbnc: batbnc,
                batskor: batskor,
                datnamkor: datnamkor,
            },
            success: function(msg){
                console.log(msg);
                $("#input").hide();
                $("#list_rekom").show();
                $("#tes").html(msg);
                hapusRute();
                deleteMarkers();
                hideLoader();
                // window.location.href = 'hasil_input.php'
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(XMLHttpRequest+textStatus+errorThrown);
            },
        });
        // console.log(dist); console.log(lat); console.log(long);
        // console.log(dist.length);
    }

    function ceksen() {
        // console.log(btsbwh); console.log(btsbwhtgh); console.log(btsatstgh); console.log(btsats);
        $.ajax({
                type: "POST",
                url: "<?php echo Yii::$app->homeUrl ?>site/sentimen",
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
                    datbnc: datbnc,
                    dathtm: dathtm,
                    datskor: datskor,
                    batbnc: batbnc,
                    batskor: batskor,
                    datnamkor: datnamkor,
                },
                success: function(msg){
                    console.log(msg);
                    $("#input").hide();
                    $("#list_rekom").show();
                    $("#tessen").html(msg);
                    hapusRute();
                    deleteMarkers();
                    hideLoader();
                    // window.location.href = 'hasil_input.php'
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
        //hapusRute();
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
    function openLoader(){
        $('#loader')
            .show()  // show it initially
        ;
    }
    function hideLoader(){
        $('#loader')
            .hide()  // show it initially
        ;
    }


    $(function() {
        $("#list_rekom").hide();
        $("#add").click(function() {
            addLokasi();
        });

        $("#hapus").click(function() {
            hapusLokasi();
        });

        $("#cari").click(function() {
            lokasiSaya = document.getElementById("lat").value + "," + document.getElementById("long").value;
            openLoader();
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

        $('#loader')
            .hide()  // Hide it initially
        ;

        $("body").on('click', '.detail', function() {
            lokasiSaya = ($("#lokasi").val() == '' ? lokasiSaya : $("#lokasi").val());
            // menghapus rute sebelum.y yang di     maps
            hapusRute();
            // menampilkan rute baru
            jarak($(this).data('alamat'));
        });

         $(document).on('click', '.item', function(e){
            // alert();
            hapusRute();
            var long = $(this).data('long');
            var lat = $(this).data('lat');
            jarak(lat, long);
        });

    });

</script>