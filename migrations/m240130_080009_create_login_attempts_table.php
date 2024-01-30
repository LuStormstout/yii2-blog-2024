<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%login_attempts}}`.
 *
 * @depends m240130_073304_create_users_table
 */
class m240130_080009_create_login_attempts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%login_attempts}}', [
            'id' => $this->primaryKey()->comment('主键'),
            'user_id' => $this->integer()->comment('用户ID，外键关联到users表'),
            'terminal' => $this->string()->notNull()->comment('用户使用的终端类型'),
            'ip_address' => $this->string()->notNull()->comment('用户的IP地址'),
            'user_agent' => $this->text()->comment('用户的浏览器代理信息'),
            'login_time' => $this->dateTime()->notNull()->comment('登录尝试的时间'),
            'status' => $this->string()->notNull()->comment('登录状态，如成功、失败'),
            'fail_reason' => $this->string()->comment('登录失败的原因'),
            'attempt_count' => $this->integer()->defaultValue(0)->comment('登录尝试次数'),
            'geo_location' => $this->string()->comment('登录时的地理位置信息'),
        ]);

        $this->addForeignKey(
            'fk-login_attempts-user_id',
            'login_attempts',
            'user_id',
            'users', // 确保外键引用的是复数形式的用户表名
            'id',
            'SET NULL',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-login_attempts-user_id',
            'login_attempts'
        );

        $this->dropTable('{{%login_attempts}}');
    }
}
