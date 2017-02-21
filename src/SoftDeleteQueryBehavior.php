<?php

namespace cornernote\softdelete;

use yii\base\Behavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
        return $this->owner->andWhere($this->tableName() . '.' . $this->attribute . ' IS NOT NULL');
    }

    /**
     * @return static
     */
    public function notDeleted()
    {
        return $this->owner->andWhere($this->tableName() . '.' . $this->attribute . ' IS NULL');
    }

    /**
     * @return string
     */
    protected function tableName()
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->owner->modelClass;
        return $modelClass::tableName();
    }

}
