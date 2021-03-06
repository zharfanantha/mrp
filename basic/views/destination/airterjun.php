<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Waterfall Destinations';
?>
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/gintung.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/kethak.jpg"; ?>);">
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
            <li style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/trisula.jpg"; ?>);">
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
                        <h2>Popular Waterfall Destinations</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobanrondo.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Rondo",['places/details','id' => '12']) ?></h3>
                    </div>
                </div>
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
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/cobantundo.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Tundo",['places/details','id' => '19']) ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-grid" style="background-image: url(<?php echo Yii::$app->homeUrl."assets/images/objek/rais.jpg"; ?>);">
                    </div>
                    <div class="desc">
                        <h3><?= Html::a("Coban Rais",['places/details','id' => '14']) ?></h3>
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
                        <h2>All Waterfall Destinations</h2>
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