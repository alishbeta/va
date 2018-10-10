<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 27.03.2017
 * Time: 23:08
 */

namespace backend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css ',
        'css/AdminLTE.min.css',
        'css/skin-green-light.min.css',
        'js/iCheck/all.css',
    ];
    public $js = [
        'js/init.js',
        'js/bootstrap.min.js',
        'js/fastclick.js',
        'js/app.min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.slimscroll.min.js',
        'js/Chart.min.js',
        'js/iCheck/icheck.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}