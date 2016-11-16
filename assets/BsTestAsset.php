<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of BsTestAsset
 *
 * @author kerimov
 */
class BsTestAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/style.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/animate.css',
        'css/font_family_Lato.css',
        'css/font-awesome.min.css',
        'css/linear-icons.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.shuffle.min.js',
        'js/custom.js',
        'js/validator.min.js',
        'js/form-scripts.js',
        'js/sticky-nav.js',
        'js/jquery.easing.min.js',
        'js/scrolling-nav.js',
        'js/jquery.nav.js',
    ];
}
