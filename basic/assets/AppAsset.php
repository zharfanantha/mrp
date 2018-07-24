<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'css/superfish.css',
        'css/bootstrap-datepicker.min.css',
        'css/cs-select.css',
        'css/cs-skin-border.css',
        'css/themify-icons.css',
        'css/flaticon.css',
        'css/icomoon.css',
        'css/flexslider.css',
        'css/style.css',
        'css/dataTables.bootstrap.min.css',
        'css/pure-min.css',
        // 'css/owl.theme.default.min.css',
        // 'css/owl.carousel.css',
    ];
    public $js = [
        // 'js/bootstrap.min.js',
        // 'js/jquery-2.1.4.min.js',
        'js/hoverIntent.js',
        'js/superfish.js',
        'js/jquery.waypoints.min.js',
        'js/jquery.countTo.js',
        'js/jquery.stellar.min.js',
        'js/bootstrap-datepicker.min.js',
        'js/classie.js',
        'js/selectFx.js',
        'js/jquery.flexslider-min.js',
        'js/custom.js',
        'js/dataTables.bootstrap.min.js',
        'js/jquery.dataTables.min.js',
        // 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAipJSjfkVSMGCmL10xbDjrJyTCxL3Uslc&language=in&region=ID',
        // 'js/map.js',
        // 'js/modernizr-2.6.2.min.js',
        // 'js/owl.carousel.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
