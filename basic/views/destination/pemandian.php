<!-- <pre>
    <?= print_r($dataobj) ?>;
</pre> -->

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Baths & Waterpark Destinations';
?>
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/maron.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/sumberjenon.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/sumbersirah.jpg"; ?>);">
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
                        <h2>Popular Baths & Waterpark Destinations</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/jenon.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Sumber Jenon',['places/details','id' => '6']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/panascangar.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Air Panas Cangar',['places/details','id' => '3']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/maron.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a('Sumber Maron',['places/details','id' => '5']) ?></h3>
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
                        <h2>All Baths & Waterpark Destinations</h2>
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