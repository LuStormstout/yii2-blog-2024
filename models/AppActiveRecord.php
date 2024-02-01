<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class AppActiveRecord, the base class for all models in the application
 *
 * @package app\models
 * @property int|null created_at
 * @property int|null updated_at
 */
class AppActiveRecord extends ActiveRecord
{
    /**
     * @var int|null
     */
    protected ?int $updated_at;
    /**
     * @var int|null
     */
    protected ?int $created_at;

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
     * Change the format of the created_at and updated_at fields
     *
     * @return array|int[]|string[]
     */
    public function fields(): array
    {
        $fields = parent::fields();

        if($this->hasAttribute('created_at')) {
            $fields['created_at'] = function() {
                return Yii::$app->formatter->asDatetime($this->created_at);
            };
        }

        if ($this->hasAttribute('updated_at')) {
            $fields['updated_at'] = function() {
                return Yii::$app->formatter->asDatetime($this->updated_at);
            };
        }

        return $fields;
    }
}