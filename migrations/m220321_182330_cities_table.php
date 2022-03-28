<?php

use yii\db\Migration;

/**
 * Class m220321_182330_cities_table
 */
class m220321_182330_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cities', [
           'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),

        ]);
        $this->execute("ALTER TABLE cities
	add coordinates point not null ;");
        $this->execute(file_get_contents(__DIR__.'/../schema/cities.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220321_182330_cities_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220321_182330_cities_table cannot be reverted.\n";

        return false;
    }
    */
}
