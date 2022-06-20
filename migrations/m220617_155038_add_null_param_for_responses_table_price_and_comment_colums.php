<?php

use yii\db\Migration;

/**
 * Class m220617_155038_add_null_param_for_responses_table_price_and_comment_colums
 */
class m220617_155038_add_null_param_for_responses_table_price_and_comment_colums extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('responses','price',$this->integer()->null());
        $this->alterColumn('responses','comment',$this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220617_155038_add_null_param_for_responses_table_price_and_comment_colums cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220617_155038_add_null_param_for_responses_table_price_and_comment_colums cannot be reverted.\n";

        return false;
    }
    */
}
