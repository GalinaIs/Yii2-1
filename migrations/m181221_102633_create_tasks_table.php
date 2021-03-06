<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181221_102633_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'descripthion' => $this->text(),
            'responsible_id' => $this->integer()
        ]);

        $this->createIndex("ix_tasks_responsible", "tasks", "responsible_id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
