<?php

namespace vyants\softdelete;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;


/**
 * Class SoftDelete
 *
 * @package vendor\vyants\softdelete
 * @author Vladimir Yants <vyants@dengisrazy.ru>
 * @property ActiveRecord $owner
 */
class SoftDelete extends Behavior
{
    /**
     * @var string delete time attribute
     */
    public $timeAttribute = false;

    /**
     *  @var string status attribute
     */
    public $statusAttribute = "status";

    /**
     *  @var string deleted status attribute
     */
    public $deletedValue = -1;

    /**
     *  @var string active status attribute
     */
    public $activeValue = 1;

    /**
     * @inheritdoc
     */
    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'softDelete',
        ];
    }

    /**
     * Set the attribute deleted
     *
     * @param Event $event
     */
    public function softDelete($event) {
        $attributes[0] = $this->timeAttribute;
        if($attributes[0]) {
            $this->owner->$attributes[0] = time();
        }

        $attributes[1] = $this->statusAttribute;
        $this->owner->$attributes[1] = $this->deletedValue;

        // save record
        $this->owner->save(false, $attributes);

        //prevent real delete
        $event->isValid = false;
    }

    /**
     * Restore soft-deleted record
     */
    public function restore() {
        $attributes[0] = $this->timeAttribute;
        if($attributes[0]) {
            $this->owner->$attributes[0] = null;
        }

        $attributes[1] = $this->statusAttribute;
        $this->owner->$attributes[1] = $this->activeValue;

        // save record
        $this->owner->save(false, $attributes);
    }
    /**
     * Force delete from database
     */
    public function forceDelete() {
        // store model so that we can detach the behavior and delete as normal
        $model = $this->owner;
        $this->detach();
        $model->delete();
    }
}