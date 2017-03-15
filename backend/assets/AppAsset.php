<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'http://xiumi.us/connect/ue/v5/xiumi-ue-v5.css',
    ];
    public $js = [
		'http://xiumi.us/connect/ue/v5/xiumi-ue-dialog-v5.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'dmstr\web\AdminLteAsset',

    ];
}
