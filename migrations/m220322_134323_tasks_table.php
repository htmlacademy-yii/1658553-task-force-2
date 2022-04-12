<?php

use yii\db\Migration;

/**
 * Class m220322_134323_tasks_table
 */
class m220322_134323_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id'            => $this->primaryKey(),
            'create_time'   => $this->dateTime()->notNull(),
            'deadline_time' => $this->dateTime()->notNull(),
            'name'          => $this->string(255)->notNull(),
            'info'          => $this->text()->notNull(),
            'category_id'   => $this->integer()->notNull(),
            'city_id'       => $this->integer()->notNull(),
            'price'         => $this->integer()->notNull(),
            'customer_id'   => $this->integer()->notNull(),
            'executor_id'   => $this->integer()->null(),
            'status'        => $this->integer()->notNull(),

        ]);
        $this->addForeignKey('task_customer', 'tasks', 'customer_id', 'users', 'id');
        $this->addForeignKey('task_executor', 'tasks', 'executor_id', 'users', 'id');
        $this->addForeignKey('task_categories', 'tasks', 'category_id', 'categories', 'id');
        $this->addForeignKey('task_cities', 'tasks', 'city_id', 'cities', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_134323_tasks_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_134323_tasks_table cannot be reverted.\n";

        return false;
    }
    */
}
