# AdminLTE v4 Extension for Yii 2

[![Latest Stable Version](http://poser.pugx.org/id161836712/yii2-adminlte4/v)](https://packagist.org/packages/id161836712/yii2-adminlte4)
[![Total Downloads](http://poser.pugx.org/id161836712/yii2-adminlte4/downloads)](https://packagist.org/packages/id161836712/yii2-adminlte4)
[![Latest Unstable Version](http://poser.pugx.org/id161836712/yii2-adminlte4/v/unstable)](https://packagist.org/packages/id161836712/yii2-adminlte4)
[![License](http://poser.pugx.org/id161836712/yii2-adminlte4/license)](https://packagist.org/packages/id161836712/yii2-adminlte4)
[![PHP Version Require](http://poser.pugx.org/id161836712/yii2-adminlte4/require/php)](https://packagist.org/packages/id161836712/yii2-adminlte4)

Installation
----

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require id161836712/yii2-adminlte4 "^1.1"
```

or add

```json
"id161836712/yii2-adminlte4": "^1.1"
```

to the require section of your application's `composer.json` file.

Usage
----

For example, the following
single line of code in a view file would render an AdminLTE Info Box widget:

```php
<?= \id161836712\adminlte4\InfoBox::widget([
    'text' => 'Bookmarks',
    'number' => '41,410',
    'iconClass' => 'bi bi-bookmarks-fill',
]); ?>
```
