<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181221_111608_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string(25)->notNull(),
            'password' => $this->string(50)->notNull(),
            'name' => $this->string(50)->notNull(),
        ]);

        $this->createIndex('ix_users_login', 'users', 'login');
        $this->createIndex('ix_users_password', 'users', 'password');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
