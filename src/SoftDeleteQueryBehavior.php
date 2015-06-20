<?php
/**
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @copyright 2015 Mr PHP
 * @link https://github.com/cornernote/yii2-softdelete
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii2-softdelete/master/LICENSE.md
 */

namespace cornernote\softdelete;

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