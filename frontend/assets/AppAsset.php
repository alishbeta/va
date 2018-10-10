<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css ',
        'css/AdminLTE.min.css',
        'css/skin-green.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/fastclick.js',
        'js/app.min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.slimscroll.min.js',
        'js/Chart.min.js',
        'js/iCheck/icheck.min.js',
        'js/dashboard2.js',
        '//ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js',
        '//ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular-animate.min.js',
        'js/angular/module.js',
        'js/init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
