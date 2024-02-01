<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id 主键
 * @property string $name 姓名
 * @property string $email 电子邮件
 * @property string $subject 主题
 * @property string $body 消息内容
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Contact extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'subject', 'body', 'created_at', 'updated_at'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', '主键'),
            'name' => Yii::t('app', '姓名'),
            'email' => Yii::t('app', '电子邮件'),
            'subject' => Yii::t('app', '主题'),
            'body' => Yii::t('app', '消息内容'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ContactQuery the active query used by this AR class.
     */
    public static function find(): ContactQuery
    {
        return new ContactQuery(get_called_class());
    }
}
