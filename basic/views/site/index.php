<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Malang Raya Pride';
?>
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/balekambang.jpg"; ?>);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-12 col-md-offset-0 text-center slider-text">
                        <div class="slider-text-inner js-fullheight">
                            <div class="desc">
                                <br><br><br><br><br>
                                <p><span>Malang Raya Pride</span></p>
                                <h2>Recommend You The New Way</h2>
                                <p>
                                    <a href="<?php echo Yii::$app->homeUrl ?>site/rekomendasi" class="btn btn-primary btn-lg">Let's Go</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/cobantalun.jpg"; ?>);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-12 col-md-offset-0 text-center slider-text">
                        <div class="slider-text-inner js-fullheight">
                            <div class="desc">
                                <br><br><br><br><br>
                                <p><span>Malang Raya Pride</span></p>
                                <h2>Recommend You The New Way</h2>
                                <p>
                                    <a href="<?php echo Yii::$app->homeUrl ?>site/rekomendasi" class="btn btn-primary btn-lg">Let's Go</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/masjidtiban.jpg"; ?>);">
                <div class="overlay-gradient"></div>
                <div class="container">
                    <div class="col-md-12 col-md-offset-0 text-center slider-text">
                        <div class="slider-text-inner js-fullheight">
                            <div class="desc">
                                <br><br><br><br><br>
                                <p><span>Malang Raya Pride</span></p>
                                <h2>Recommend You The New Way</h2>
                                <p>
                                    <a href="<?php echo Yii::$app->homeUrl ?>site/rekomendasi" class="btn btn-primary btn-lg">Let's Go</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            </ul>
        </div>
    </aside>


    <div id="fh5co-blog-section">
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <br><br><br><br><br><br><br><br><br>
                        <h2>Popular Destination</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/pantaibalekambang.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai Balekambang',['places/details','id' => '33']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobanrondo.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Rondo",['places/details','id' => '12']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/jatimpark1.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Jatim Park 1",['places/details','id' => '77']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/bns.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Batu Night Spectacular",['places/details','id' => '80']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/sendiki.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai Sendiki',['places/details','id' => '41']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/3warna.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai 3 Warna',['places/details','id' => '35']) ?></h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="fh5co-blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <br><br><br>
                        <h2>Best New Destinations</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobanputri.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Putri",['places/details','id' => '27']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobanbidadari.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Bidadari",['places/details','id' => '32']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobanpelangi.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Pelangi",['places/details','id' => '17']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/jatimpark3.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Jatim Park 3",['places/details','id' => '78']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/jodipan.jpeg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Kampung Warna Warni Jodipan",['places/details','id' => '89']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/sipelot.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai Sipelot',['places/details','id' => '45']) ?></h3>
                    </div>
                </div>
            </div>

        </div>
    </div>