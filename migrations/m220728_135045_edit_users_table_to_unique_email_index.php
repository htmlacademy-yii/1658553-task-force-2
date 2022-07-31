<?php

use yii\db\Migration;

/**
 * Class m220728_135045_edit_users_table_to_unique_email_index
 */
class m220728_135045_edit_users_table_to_unique_email_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('unique_email','users');
        $this->createIndex('unique_email','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220728_135045_edit_users_table_to_unique_email_index cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220728_135045_edit_users_table_to_unique_email_index cannot be reverted.\n";

        return false;
    }
    */
}
