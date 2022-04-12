<?php

use yii\db\Migration;

/**
 * Class m220322_131926_files_table
 */
class m220322_131926_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'path' => $this->string(1024)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_131926_files_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_131926_files_table cannot be reverted.\n";

        return false;
    }
    */
}
