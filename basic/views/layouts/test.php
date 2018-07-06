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
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
            <header id="fh5co-header-section">
                <div class="container">
                    <div class="nav-header">
                        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                        <h1 id="fh5co-logo"><a href="<?php echo Yii::$app->homeUrl ?>">Malang Pride</a></h1>
                        <nav id="fh5co-menu-wrap" role="navigation">
                            <ul class="sf-menu" id="fh5co-primary-menu">
                                <li><a class="active" href="<?php echo Yii::$app->homeUrl ?>">Home</a></li>
                                <li>
                                    <a href="<?php echo Yii::$app->homeUrl ?>" class="fh5co-sub-ddown">Hotel</a>
                                </li>
                                <li><a href="<?php echo Yii::$app->homeUrl ?>">Services</a></li>
                                <li><a href="<?php echo Yii::$app->homeUrl ?>">Blog</a></li>
                                <li><a href="<?php echo Yii::$app->homeUrl ?>">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
        </div>
        <?= $content ?>

    <footer id="footer" class="fh5co-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                        <p><small>&copy; 2016 Free HTML5 Template. Edited by Zharfan Abshar Anantha</small></p>
                    </div>
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