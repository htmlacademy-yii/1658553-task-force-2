<?php

use yii\db\Migration;

/**
 * Class m220411_122819_update_users_table_phone_number
 */
class m220411_122819_update_users_table_phone_number extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'contact_phone', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220411_122819_update_users_table_phone_number cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220411_122819_update_users_table_phone_number cannot be reverted.\n";

        return false;
    }
    */
}
