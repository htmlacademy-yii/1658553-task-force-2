<?php

use yii\db\Migration;

/**
 * Class m220322_132102_users_table
 */
class m220322_132102_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'create_date' => $this->dateTime()->notNull(),
            'email' => $this->string(128)->notNull(),
            'login' => $this->string(128)->notNull(),
            'password' => $this->string(64)->notNull(),
            'avatar_file_id' => $this->integer()->Null(),
            'contact_telegram' => $this->string(24)->null(),
            'contact_phone' => $this->string(11)->null(),
            'city_id' => $this->integer()->notNull(),
            'birthday' => $this->dateTime()->null(),
            'info' => $this->text()->null(),
            'rating' => $this->integer()->null(),
            'status' => $this->integer()->null(),
            'is_executor' => $this->boolean()->notNull()
        ]);
        $this->addForeignKey('user_city','users','city_id','cities','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220322_132102_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220322_132102_users_table cannot be reverted.\n";

        return false;
    }
    */
}
