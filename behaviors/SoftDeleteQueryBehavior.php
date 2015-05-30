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
 *         [
 *             'class' => 'cornernote\behaviors\SoftDeleteQueryBehavior',
 *             'attribute' => 'delete_time',
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

    /**
     * @return static
     */
    public function deleted()
    {
        return $this->owner->andWhere($this->attribute . ' IS NOT NULL');
    }

    /**
     * @return static
     */
    public function notDeleted()
    {
        return $this->owner->andWhere($this->attribute . ' IS NULL');
    }

}