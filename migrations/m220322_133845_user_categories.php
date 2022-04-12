<?php

use yii\db\Migration;

/**
 * Class m220322_133845_user_categories
 */
class m220322_133845_user_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_categories', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),

        ]);
        $this->addForeignKey('user_categories_categories','user_categories','category_id','categories','id');
        $this->addForeignKey('user_categories_users','user_categories','user_id','users','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_133845_user_categories cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_133845_user_categories cannot be reverted.\n";

        return false;
    }
    */
}
