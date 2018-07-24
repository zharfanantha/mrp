<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Beach Destinations';
?>
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/kuncaran.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/lenggoksono.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/modangan.jpg"; ?>);">
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
                        <h2>Popular Beach Destinations</h2>
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
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/goacina1.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai Goa Cina',['places/details','id' => '37']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/3warna1.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai 3 Warna',['places/details','id' => '35']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/sempu.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pulau Sempu',['places/details','id' => '66']) ?></h3>
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
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/lenggoksono.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Pantai Lenggoksono',['places/details','id' => '46']) ?></h3>
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
                        <h2>All Beach Destinations</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                    for ($i=0; $i < sizeof($dataobj); $i++) { ?>
                        <div class="col-md-4">
                            <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/".$dataobj[$i]['img'];";" ?>);">
                            </div>
                            <div class="desc">
                                <h3><?= Html::a($dataobj[$i]['nama_objek'],['places/details','id' => $dataobj[$i]['id_objek']]) ?></h3>
                            </div>
                        </div>
                <?php }
                ?>
            </div>

        </div>
    </div>