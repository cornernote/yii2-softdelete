<?php
/**
 * @link https://github.com/cornernote/yii2-softdelete
 * @copyright Copyright (c) 2013-2015 Mr PHP <info@mrphp.com.au>
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tests\models;

use cornernote\softdelete\SoftDeleteBehavior;
use yii\db\ActiveRecord;

/**
 * PostA
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $deleted_at
 *
 * @mixin SoftDeleteBehavior
 */
class PostA extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_a';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            SoftDeleteBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
