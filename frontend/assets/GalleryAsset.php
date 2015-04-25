<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/swiper/';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $css = [
        '/dist/css/swiper.min.css',
    ];
    public $js = [
        '/dist/js/swiper.jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
