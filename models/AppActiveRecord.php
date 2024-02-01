<?php

namespace app\models;

use DateTime;
use DateTimeInterface;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class AppActiveRecord, the base class for all models in the application
 *
 * @package app\models
 * @property mixed created_at
 * @property mixed updated_at
 */
class AppActiveRecord extends ActiveRecord
{
    /**
     * Add the TimestampBehavior to the behaviors method
     *
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // check if the table has created_at and updated_at columns
        if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
            $behaviors[] = [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new Expression('NOW()'),
            ];
        }
        return $behaviors;
    }

    /**
     *  Convert the created_at and updated_at attributes to a human-readable format
     */
    public function afterFind()
    {
        parent::afterFind();

        if ($this->hasAttribute('created_at') && $this->created_at !== null) {
            $this->created_at = (new DateTime())->setTimestamp($this->created_at)->format(DateTimeInterface::ATOM);
        }
        if ($this->hasAttribute('updated_at') && $this->updated_at !== null) {
            $this->updated_at = (new DateTime())->setTimestamp($this->updated_at)->format(DateTimeInterface::ATOM);
        }
    }

}