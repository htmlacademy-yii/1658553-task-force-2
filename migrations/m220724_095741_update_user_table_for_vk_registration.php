<?php

use yii\db\Migration;

/**
 * Class m220724_095741_update_user_table_for_vk_registration
 */
class m220724_095741_update_user_table_for_vk_registration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('users','password',$this->string(64)->null());

        $this->addColumn('users','auth_via',$this->string(24)->notNull());
        $this->addColumn('users','social_id',$this->string(24)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220724_095741_update_user_table_for_vk_registration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220724_095741_update_user_table_for_vk_registration cannot be reverted.\n";

        return false;
    }
    */
}
