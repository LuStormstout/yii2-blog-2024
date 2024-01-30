<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 *
 * @depends m240130_073304_create_posts_table
 * @depends m240130_073304_create_users_table
 */
class m240130_073707_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey()->comment('主键'),
            'post_id' => $this->integer()->notNull()->comment('文章ID'),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'parent_id' => $this->integer()->null()->comment('父评论ID'),
            'content' => $this->text()->notNull()->comment('评论内容'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ]);

        $this->addForeignKey(
            'fk-comment-post_id',
            'comments',
            'post_id',
            'posts',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-user_id',
            'comments',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-parent_id',
            'comments',
            'parent_id',
            'comments',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment-post_id',
            'comments'
        );

        $this->dropForeignKey(
            'fk-comment-user_id',
            'comments'
        );

        $this->dropForeignKey(
            'fk-comment-parent_id',
            'comments'
        );

        $this->dropTable('{{%comments}}');
    }
}
