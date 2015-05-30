<?php

namespace cornernote\behaviors;

use yii\base\Behavior;
use yii\db\ActiveQuery;

/**
 * SoftDeleteQueryBehavior
 *
 * @usage:
 * ```
 * public function behaviors() {
 *     return [
 *         'softDelete' => ['class' => 'cornernote\behaviors\SoftDeleteBehavior',
 *             'attribute' => 'delete_time',
 *             'value' => new Expression('NOW()'),
 *         ],
 *     ];
 * }
 * ```
 *
 * @property ActiveQuery $owner
 *
 * @author cornernote <cornernote@gmail.com>
 */
class SoftDeleteQueryBehavior extends Behavior
{
    /**
     * @var string SoftDelete attribute
     */
    public $attribute = 'deleted_at';

    public function deleteds()
    {
        return $this->owner->andWhere($this->attribute . ' IS NULL');
    }

    public function undeleteds()
    {
        return $this->owner->andWhere($this->attribute . ' IS NOT NULL');
    }

}