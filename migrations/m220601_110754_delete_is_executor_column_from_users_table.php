<?php

use yii\db\Migration;

/**
 * Class m220601_110754_delete_is_executor_column_from_users_table
 */
class m220601_110754_delete_is_executor_column_from_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('users','is_executor');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220601_110754_delete_is_executor_column_from_users_table cannot be reverted.\n";

        return false;
    }

}
