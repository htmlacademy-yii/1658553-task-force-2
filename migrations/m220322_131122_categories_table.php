<?php

use yii\db\Migration;

/**
 * Class m220322_131122_categories_table
 */
class m220322_131122_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'icon' => $this->string(64)->notNull(),
        ]);
        $this->execute(file_get_contents(__DIR__.'/../chema/categories.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_131122_categories_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_131122_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
