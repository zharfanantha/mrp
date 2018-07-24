<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<link rel="shortcut icon" href="<?php echo Yii::$app->homeUrl ?>assets/images/mrpnew.png" type="image/x-icon" />
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();?>

<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
            <header id="fh5co-header-section">
                <div class="container">
                    <div class="nav-header">
                        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                        <h1 id="fh5co-logo"><a href="<?php echo Yii::$app->homeUrl ?>"><img src="<?php echo Yii::$app->homeUrl."assets/images/mrpnew.png" ?>" style="height: 80px; width: 80px;" ></a></h1>
                        <nav id="fh5co-menu-wrap" role="navigation">
                            <ul class="sf-menu" id="fh5co-primary-menu">
                                <li>
                                    <a class="<?php echo (Yii::$app->controller->action->id=='index')?'active':'';?>"
                                        href="<?php echo Yii::$app->homeUrl ?>">Home</a>
                                </li>
                                <li>
                                    <a class="<?php echo (Yii::$app->controller->action->id=='destination'
                                                        || Yii::$app->controller->id=='destination'
                                                        || Yii::$app->controller->id=='places')?'active':'';?>"
                                        href="<?php echo Yii::$app->homeUrl ?>site/destination">Destination</a>
                                    <ul class="fh5co-sub-menu">
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/pantai">Pantai</a></li>
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/terjun">Air Terjun</a></li>
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/pemandian">Pemandian Umum</a></li>
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/hiburan">Hiburan Keluarga</a></li>
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/budaya">Budaya dan Sejarah</a></li>
                                        <li><a href="<?php echo Yii::$app->homeUrl ?>destination/religi">Religi</a></li> 
                                    </ul>
                                </li>
                                <li>
                                    <a class="<?php echo (Yii::$app->controller->action->id=='rekomendasi')?'active':'';?>"
                                        href="<?php echo Yii::$app->homeUrl ?>site/rekomendasi">Rekomendasi</a>
                                </li>
                                <li>
                                    <a class="<?php echo (Yii::$app->controller->action->id=='uji')?'active':'';?>"
                                        href="<?php echo Yii::$app->homeUrl ?>site/uji">Uji Sentimen</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
        </div>
        <?= $content ?>

    <footer id="footer" class="fh5co-bg-color">
        <div class="container">
            <div class="col-md-6">
                <div class="copyright">
                    <p><small>&copy; 2016 Free HTML5 Template. Edited by Zharfan Abshar Anantha</small></p>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php
// $url = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAipJSjfkVSMGCmL10xbDjrJyTCxL3Uslc&language=in&region=ID';
// $this->registerJsFile($url, ['async' => false, 'defer' => true]);
// $this->registerJs($this->render('map.js'));
$tes = yii::$app->gmaps->tes();
// print_r($tes);
?>