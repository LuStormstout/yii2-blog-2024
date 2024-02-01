<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m240201_074508_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey()->comment('主键'),
            'name' => $this->string()->notNull()->comment('姓名'),
            'email' => $this->string()->notNull()->comment('电子邮件'),
            'subject' => $this->string()->notNull()->comment('主题'),
            'body' => $this->text()->notNull()->comment('消息内容'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}
