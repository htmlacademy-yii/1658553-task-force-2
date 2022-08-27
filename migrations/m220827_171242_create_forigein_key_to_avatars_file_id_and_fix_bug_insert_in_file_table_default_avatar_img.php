<?php

use yii\db\Migration;

/**
 * Class m220827_171242_create_forigein_key_to_avatars_file_id_and_fix_bug_insert_in_file_table_default_avatar_img
 */
class m220827_171242_create_forigein_key_to_avatars_file_id_and_fix_bug_insert_in_file_table_default_avatar_img extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('files',['path'=>'/img/avatars/anon.jpg']);

        $this->addForeignKey('users_to_avatar','users','avatar_file_id','files','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220827_171242_create_forigein_key_to_avatars_file_id_and_fix_bug_insert_in_file_table_default_avatar_img cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220827_171242_create_forigein_key_to_avatars_file_id_and_fix_bug_insert_in_file_table_default_avatar_img cannot be reverted.\n";

        return false;
    }
    */
}
