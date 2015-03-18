<?php

namespace vyants\softdelete;

use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;


/**
 * Class SoftDelete
 *
 * @package vendor\vyants\softdelete
 * @author Vladimir Yants <vladimir.yants@gmail.com>
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
     * Удалить софтделитом. Возращает true/false в зависимости от того, успешно ли
     * @return bool
     */
    public function softDelete() {
        if($this->timeAttribute) {
            $attributes[0] = $this->timeAttribute;
            $this->owner->$attributes[0] = time();
        }

        $attributes[1] = $this->statusAttribute;
        $this->owner->$attributes[1] = $this->deletedValue;

        // save record
        return $this->owner->save(false, $attributes);
    }

    /**
     * Restore soft-deleted record. Возращает true/false в зависимости от того, успешно ли
     * @return bool
     */
    public function restore() {
        if($this->timeAttribute) {
            $attributes[0] = $this->timeAttribute;
            $this->owner->$attributes[0] = null;
        }

        $attributes[1] = $this->statusAttribute;
        $this->owner->$attributes[1] = $this->activeValue;

        // save record
        return $this->owner->save(false, $attributes);
    }

    /**
     * Force delete from database. Возращает true/false в зависимости от того, успешно ли
     * @return bool
     */
    public function forceDelete() {
        // store model so that we can detach the behavior and delete as normal
        $model = $this->owner;
        $this->detach();
        $result = $model->delete();
        $this->attach($model);
        return $result;
    }

}