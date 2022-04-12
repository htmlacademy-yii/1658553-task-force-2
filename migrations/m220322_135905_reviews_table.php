<?php

use yii\db\Migration;

/**
 * Class m220322_135905_reviews_table
 */
class m220322_135905_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id'            => $this->primaryKey(),
            'executor_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'score' => $this->integer()->notNull(),
            'comment' => $this->text()->notNull(),
            'create_time' => $this->dateTime()->notNull(),
        ]);
        $this->createIndex('unique_email','users','email',true);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_135905_reviews_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_135905_reviews_table cannot be reverted.\n";

        return false;
    }
    */
}
