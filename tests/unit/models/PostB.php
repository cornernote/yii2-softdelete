<?php
/**
 * @link https://github.com/cornernote/yii2-softdelete
 * @copyright Copyright (c) 2013-2015 Mr PHP <info@mrphp.com.au>
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tests\models;

use cornernote\softdelete\SoftDeleteBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * PostB
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $deleted_at
 *
 * @mixin SoftDeleteBehavior
 */
class PostB extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_b';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SoftDeleteBehavior::className(),
                'attribute' => 'deleted_at',
                'value' => new Expression("date('now')"),
            ],
        ];
    }

}
