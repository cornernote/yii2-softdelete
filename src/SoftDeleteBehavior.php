<?php
/**
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @copyright 2015 Mr PHP
 * @link https://github.com/cornernote/yii2-softdelete
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii2-softdelete/master/LICENSE.md
 */

namespace cornernote\softdelete;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * SoftDeleteBehavior
 *
 * @usage:
 * ```
 * public function behaviors() {
 *     return [
 *         [
 *             'class' => 'cornernote\behaviors\SoftDeleteBehavior',
 *             'attribute' => 'delete_time',
 *             'value' => new Expression('NOW()'),
 *         ],
 *     ];
 * }
 * ```
 *
 * @property BaseActiveRecord $owner
 */
class SoftDeleteBehavior extends Behavior
{
    /**
     * @var string SoftDelete attribute
     */
    public $attribute = 'deleted_at';

    /**
     * @var callable|Expression The expression that will be used for generating the timestamp.
     * This can be either an anonymous function that returns the timestamp value,
     * or an [[Expression]] object representing a DB expression (e.g. `new Expression('NOW()')`).
     * If not set, it will use the value of `time()` to set the attributes.
     */
    public $value;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [BaseActiveRecord::EVENT_BEFORE_DELETE => 'softDeleteEvent'];
    }

    /**
     * Set the attribute with the current timestamp to mark as deleted
     *
     * @param Event $event
     */
    public function softDeleteEvent($event)
    {
        // remove and mark as invalid to prevent real deletion
        $this->softDelete();
        $event->isValid = false;
    }

    /**
     * Soft delete record
     */
    public function softDelete()
    {
        // set attribute with evaluated timestamp
        $attribute = $this->attribute;
        $this->owner->$attribute = $this->getValue(null);
        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Restore record
     */
    public function unDelete()
    {
        // set attribute as null
        $attribute = $this->attribute;
        $this->owner->$attribute = null;
        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Delete record from database regardless of the $safeMode attribute
     */
    public function hardDelete()
    {
        // store model so that we can detach the behavior
        $model = $this->owner;
        $this->detach();
        // delete as normal
        $model->delete();
    }

    /**
     * Evaluate the timestamp to be saved.
     *
     * @param Event|null $event the event that triggers the current attribute updating.
     * @return mixed the attribute value
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : time();
        }
    }

}