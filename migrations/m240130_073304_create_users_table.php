<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240130_073304_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey()->comment('主键'),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'email' => $this->string()->notNull()->unique()->comment('电子邮件'),
            'password_hash' => $this->string()->notNull()->comment('加密密码'),
            'auth_key' => $this->string(32)->notNull()->comment('认证密钥'),
            'email_verification_token' => $this->string()->unique()->comment('邮箱验证令牌'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('用户状态'),
            'is_admin' => $this->smallInteger()->notNull()->defaultValue(0)->comment('是否管理员'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
