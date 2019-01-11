<?php

use yii\db\Migration;

/**
 * Class m190111_133606_add_new_column
 */
class m190111_133606_add_new_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'created_at', $this->dateTime());
        $this->addColumn('users', 'update_at', $this->dateTime());

        $this->addColumn('tasks', 'created_at', $this->dateTime());
        $this->addColumn('tasks', 'update_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'created_at');
        $this->dropColumn('users', 'update_at');

        $this->dropColumn('tasks', 'created_at');
        $this->dropColumn('tasks', 'update_at');
    }
}
