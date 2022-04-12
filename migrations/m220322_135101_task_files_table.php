<?php

use yii\db\Migration;

/**
 * Class m220322_135101_task_files_table
 */
class m220322_135101_task_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task_files', [
            'id'            => $this->primaryKey(),
            'task_id'   => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('task_files_task', 'task_files', 'task_id', 'tasks', 'id');
        $this->addForeignKey('task_files_file', 'task_files', 'file_id', 'files', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_135101_task_files_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_135101_task_files_table cannot be reverted.\n";

        return false;
    }
    */
}
