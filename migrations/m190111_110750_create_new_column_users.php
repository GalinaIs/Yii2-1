<?php

use yii\db\Migration;

/**
 * Class m190111_110750_create_new_column_users
 */
class m190111_110750_create_new_column_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'email', $this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');
    }
}
