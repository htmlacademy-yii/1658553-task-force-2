<?php

use yii\db\Migration;

/**
 * Class m220525_152332_change_tasks_table_price_column_add_null_atribute_for_price
 */
class m220525_152332_change_tasks_table_price_column_add_null_atribute_for_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tasks','price',$this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('tasks','price',$this->integer(11)->notNull());

        return false;
    }


}
