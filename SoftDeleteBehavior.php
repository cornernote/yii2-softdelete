<?php

namespace cornernote\behaviors;

use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\behaviors\AttributeBehavior;

/**
 * SoftDeleteBehavior
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
 * @property BaseActiveRecord $owner
 *
 * @author cornernote <cornernote@gmail.com>
 * @author amnah <amnah.dev@gmail.com>
 */
class SoftDeleteBehavior extends AttributeBehavior
{
    /**
     * @var string SoftDelete attribute
     */
    public $deletedAtAttribute = 'deleted_at';
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
        return [BaseActiveRecord::EVENT_BEFORE_DELETE => 'doDeleteTimestamp'];
    }

    /**
     * Set the attribute with the current timestamp to mark as deleted
     *
     * @param Event $event
     */
    public function doDeleteTimestamp($event)
    {
        // remove and mark as invalid to prevent real deletion
        $this->remove();
        $event->isValid = false;
    }

    /**
     * Remove (aka soft-delete) record
     */
    public function remove()
    {
        // evaluate timestamp and set attribute
        $timestamp = $this->evaluateAttributes();
        $attribute = $this->attribute;
        $this->owner->$attribute = $timestamp;
        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Restore soft-deleted record
     */
    public function restore()
    {
        // mark attribute as null
        $attribute = $this->attribute;
        $this->owner->$attribute = null;
        // save record
        $this->owner->save(false, [$attribute]);
    }

    /**
     * Delete record from database regardless of the $safeMode attribute
     */
    public function forceDelete()
    {
        // store model so that we can detach the behavior and delete as normal
        $model = $this->owner;
        $this->detach();
        $model->delete();
    }


    /**
     * @inheritdoc
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