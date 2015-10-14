# Yii2 Soft Delete

[![Latest Version](https://img.shields.io/github/tag/cornernote/yii2-softdelete.svg?style=flat-square&label=release)](https://github.com/cornernote/yii2-softdelete/tags)
[![Software License](https://img.shields.io/badge/license-BSD-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/cornernote/yii2-softdelete/master.svg?style=flat-square)](https://travis-ci.org/cornernote/yii2-softdelete)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/cornernote/yii2-softdelete.svg?style=flat-square)](https://scrutinizer-ci.com/g/cornernote/yii2-softdelete/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/cornernote/yii2-softdelete.svg?style=flat-square)](https://scrutinizer-ci.com/g/cornernote/yii2-softdelete)
[![Total Downloads](https://img.shields.io/packagist/dt/cornernote/yii2-softdelete.svg?style=flat-square)](https://packagist.org/packages/cornernote/yii2-softdelete)

Soft delete behavior for Yii2.


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require cornernote/yii2-softdelete "*"
```

or add

```
"cornernote/yii2-softdelete": "*"
```

to the `require` section of your `composer.json` file.


## Usage

In your ActiveRecord class:

```php
public function behaviors() {
    return [
        \cornernote\softdelete\SoftDeleteBehavior::className(),
        // or
        [
            'class' => \cornernote\softdelete\SoftDeleteBehavior::className(),
            'attribute' => 'deleted_time',
            'value' => new \yii\db\Expression('NOW()'), // for sqlite use - new \yii\db\Expression("date('now')")
        ],
    ];
}
```

In your ActiveQuery class:

```php
public function behaviors() {
    return [
        \cornernote\softdelete\SoftDeleteQueryBehavior::className(),
        // or
        [
            'class' => \cornernote\softdelete\SoftDeleteQueryBehavior::className(),
            'attribute' => 'deleted_time',
        ],
    ];
}
```
