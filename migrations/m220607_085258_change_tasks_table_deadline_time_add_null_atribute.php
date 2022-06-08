<?php

use yii\db\Migration;

/**
 * Class m220607_085258_change_tasks_table_deadline_time_add_null_atribute
 */
class m220607_085258_change_tasks_table_deadline_time_add_null_atribute extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tasks','deadline_time',$this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220607_085258_change_tasks_table_deadline_time_add_null_atribute cannot be reverted.\n";

        return false;
    }


}
