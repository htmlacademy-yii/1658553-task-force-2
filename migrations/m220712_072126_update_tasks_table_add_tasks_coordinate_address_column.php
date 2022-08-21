<?php

use yii\db\Migration;

/**
 * Class m220712_072126_update_tasks_table_add_tasks_coordinate_address_column
 */
class m220712_072126_update_tasks_table_add_tasks_coordinate_address_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE tasks ADD COLUMN tasks_coordinate POINT NULL ;");

        $this->addColumn('tasks','address',$this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220712_072126_update_tasks_table_add_tasks_coordinate_address_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220712_072126_update_tasks_table_add_tasks_coordinate_address_column cannot be reverted.\n";

        return false;
    }
    */
}
