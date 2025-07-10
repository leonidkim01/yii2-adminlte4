<?php

declare(strict_types=1);

namespace id161836712\adminlte4;

use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * @inheritdoc
 */
final class AdminLteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    /**
     * @inheritdoc
     */
    public $css = [
        YII_ENV_DEV ? 'css/adminlte.css' : 'css/adminlte.min.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        YII_ENV_DEV ? 'js/adminlte.js' : 'js/adminlte.min.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}
