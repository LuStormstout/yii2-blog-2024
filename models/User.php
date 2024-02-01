<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "users".
 *
 * @property int $id 主键
 * @property string $username 用户名
 * @property string $email 电子邮件
 * @property string $password_hash 加密密码
 * @property string $auth_key 认证密钥
 * @property string|null $email_verification_token 邮箱验证令牌
 * @property int $status 用户状态
 * @property int $is_admin 是否管理员
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 *
 * @property Comment[] $comments
 * @property LoginAttempt[] $loginAttempts
 * @property Post[] $posts
 */
class User extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'is_admin', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'email_verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email_verification_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', '主键'),
            'username' => Yii::t('app', '用户名'),
            'email' => Yii::t('app', '电子邮件'),
            'password_hash' => Yii::t('app', '加密密码'),
            'auth_key' => Yii::t('app', '认证密钥'),
            'email_verification_token' => Yii::t('app', '邮箱验证令牌'),
            'status' => Yii::t('app', '用户状态'),
            'is_admin' => Yii::t('app', '是否管理员'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[LoginAttempts]].
     *
     * @return ActiveQuery
     */
    public function getLoginAttempts(): ActiveQuery
    {
        return $this->hasMany(LoginAttempt::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return ActiveQuery
     */
    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Post::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find(): UserQuery
    {
        return new UserQuery(get_called_class());
    }
}
