<?php

declare(strict_types=1);
// ensure we get report on all possible php errors
error_reporting(-1);

const YII_ENABLE_ERROR_HANDLER = false;
const YII_DEBUG = true;
$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@id161836712/tests/adminlte4', __DIR__);
Yii::setAlias('@id161836712/adminlte4', dirname(__DIR__) . '/src');
