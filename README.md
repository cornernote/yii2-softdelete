# Yii2 Soft Delete

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
        [
            'class' => 'cornernote\behaviors\SoftDeleteBehavior',
            'attribute' => 'deleted_time',
            'value' => new Expression('NOW()'),
        ],
    ];
}
```

In your ActiveQuery class:

```php
public function behaviors() {
    return [
        [
            'class' => 'cornernote\behaviors\SoftDeleteQueryBehavior',
            'attribute' => 'deleted_time',
        ],
    ];
}
```
