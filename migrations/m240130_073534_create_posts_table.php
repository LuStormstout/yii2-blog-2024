<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 *
 * @depends m240130_073304_create_users_table
 * @depends m240130_073441_create_categories_table
 */
class m240130_073534_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey()->comment('主键'),
            'user_id' => $this->integer()->notNull()->comment('用户ID'),
            'category_id' => $this->integer()->notNull()->comment('分类ID'),
            'title' => $this->string()->notNull()->comment('标题'),
            'content' => $this->text()->notNull()->comment('内容'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ]);

        $this->addForeignKey(
            'fk-post-user_id',
            'posts',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-post-category_id',
            'posts',
            'category_id',
            'categories',
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
            'fk-post-user_id',
            'posts'
        );

        $this->dropForeignKey(
            'fk-post-category_id',
            'posts'
        );

        $this->dropTable('{{%posts}}');
    }
}
