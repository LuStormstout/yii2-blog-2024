<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "login_attempts".
 *
 * @property int $id 主键
 * @property int|null $user_id 用户ID，外键关联到users表
 * @property string $terminal 用户使用的终端类型
 * @property string $ip_address 用户的IP地址
 * @property string|null $user_agent 用户的浏览器代理信息
 * @property string $login_time 登录尝试的时间
 * @property string $status 登录状态，如成功、失败
 * @property string|null $fail_reason 登录失败的原因
 * @property int|null $attempt_count 登录尝试次数
 * @property string|null $geo_location 登录时的地理位置信息
 *
 * @property User $user
 */
class LoginAttempt extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'login_attempts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'attempt_count'], 'integer'],
            [['terminal', 'ip_address', 'login_time', 'status'], 'required'],
            [['user_agent'], 'string'],
            [['login_time'], 'safe'],
            [['terminal', 'ip_address', 'status', 'fail_reason', 'geo_location'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', '主键'),
            'user_id' => Yii::t('app', '用户ID，外键关联到users表'),
            'terminal' => Yii::t('app', '用户使用的终端类型'),
            'ip_address' => Yii::t('app', '用户的IP地址'),
            'user_agent' => Yii::t('app', '用户的浏览器代理信息'),
            'login_time' => Yii::t('app', '登录尝试的时间'),
            'status' => Yii::t('app', '登录状态，如成功、失败'),
            'fail_reason' => Yii::t('app', '登录失败的原因'),
            'attempt_count' => Yii::t('app', '登录尝试次数'),
            'geo_location' => Yii::t('app', '登录时的地理位置信息'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return LoginAttemptQuery the active query used by this AR class.
     */
    public static function find(): LoginAttemptQuery
    {
        return new LoginAttemptQuery(get_called_class());
    }
}
