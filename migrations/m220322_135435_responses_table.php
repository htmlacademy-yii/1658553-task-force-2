<?php

use yii\db\Migration;

/**
 * Class m220322_135435_responses_table
 */
class m220322_135435_responses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('responses', [
            'id'            => $this->primaryKey(),
            'task_id'   => $this->integer()->notNull(),
            'executor_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'comment' => $this->text()->notNull(),
            'rejected' => $this->boolean()->notNull()->defaultValue(false),
            'create_time' => $this->dateTime()->notNull(),
        ]);
        $this->addForeignKey('responses_tasks', 'responses', 'task_id', 'tasks', 'id');
        $this->addForeignKey('responses_users', 'responses', 'executor_id', 'users', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_135435_responses_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_135435_responses_table cannot be reverted.\n";

        return false;
    }
    */
}
