<?php

use yii\db\Migration;

/**
 * Class m220726_113057_edit_users_table_to_auth_with_vk
 */
class m220726_113057_edit_users_table_to_auth_with_vk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('unique_email','users');
        $this->createIndex('unique_email','users','email',false);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220726_113057_edit_users_table_to_auth_with_vk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220726_113057_edit_users_table_to_auth_with_vk cannot be reverted.\n";

        return false;
    }
    */
}
