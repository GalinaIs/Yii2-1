<?php

use yii\db\Migration;

/**
 * Class m181224_104406_create_foreign_key_tasks
 */
class m181224_104406_create_foreign_key_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_tasks_responsible_id', 
            'tasks', 
            'responsible_id', 
            'users', 
            'id'
        );

        $this->renameColumn('tasks', 'descripthion', 'description');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_tasks_responsible_id',
            'tasks'
        );

        $this->renameColumn('tasks', 'description', 'descripthion');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181224_104406_create_foreign_key_tasks cannot be reverted.\n";

        return false;
    }
    */
}
