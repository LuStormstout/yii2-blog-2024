<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "comments".
 *
 * @property int $id 主键
 * @property int $post_id 文章ID
 * @property int $user_id 用户ID
 * @property int|null $parent_id 父评论ID
 * @property string $content 评论内容
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 *
 * @property Comment[] $comments
 * @property Comment $parent
 * @property Post $post
 * @property User $user
 */
class Comment extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['post_id', 'user_id', 'content', 'created_at', 'updated_at'], 'required'],
            [['post_id', 'user_id', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
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
            'post_id' => Yii::t('app', '文章ID'),
            'user_id' => Yii::t('app', '用户ID'),
            'parent_id' => Yii::t('app', '父评论ID'),
            'content' => Yii::t('app', '评论内容'),
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
        return $this->hasMany(Comment::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return ActiveQuery
     */
    public function getParent(): ActiveQuery
    {
        return $this->hasOne(Comment::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return ActiveQuery
     */
    public function getPost(): ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
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
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find(): CommentQuery
    {
        return new CommentQuery(get_called_class());
    }
}
