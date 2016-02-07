<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'statics/css/sb-admin.css',
        'statics/css/morris.css',
        'statics/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        // 'statics/js/jquery.js',
        // 'statics/js/plugins/morris/raphael.min.js',
        // 'statics/js/plugins/morris/morris.min.js',
        // 'statics/js/plugins/morris/morris-data.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
