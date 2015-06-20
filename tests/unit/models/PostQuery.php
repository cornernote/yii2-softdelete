<?php
/**
 * @link https://github.com/cornernote/yii2-softdelete
 * @copyright Copyright (c) 2013-2015 Mr PHP <info@mrphp.com.au>
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace tests\models;

use cornernote\softdelete\SoftDeleteQueryBehavior;
use yii\db\ActiveQuery;

/**
 * PostQuery
 *
 * @mixin SoftDeleteQueryBehavior
 */
class PostQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            SoftDeleteQueryBehavior::className(),
        ];
    }
}
