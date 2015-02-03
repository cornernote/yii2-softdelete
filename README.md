Soft delete behavior for Yii2
=======================


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vyants/yii2-softdelete "*"
```

or add

```
"vyants/yii2-softdelete": "*"
```

to the require section of your `composer.json` file.

Usage
-----

 ```
 public function behaviors() {
      return [
          'softDelete' => ['class' => 'vyants\softdelete\SoftDelete',
              'statusAttribute' => 'status',
              'timeAttribute' => false,
              'deletedValue' => -1,
              'activeValue' => 1,
          ],
      ];
 }
 ```