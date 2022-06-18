<?php

use yii\db\Migration;

/**
 * Class m220617_190823_change_user_table_rating_column_to_float_param
 */
class m220617_190823_change_user_table_rating_column_to_float_param extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users','rating',$this->float()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_190823_change_user_table_rating_column_to_float_param cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_190823_change_user_table_rating_column_to_float_param cannot be reverted.\n";

        return false;
    }
    */
}
