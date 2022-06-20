<?php

use yii\db\Migration;

/**
 * Class m220523_115803_create_rbac_data
 */
class m220523_115803_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        //создаем пункт права (разрешения) в системе rbac
        $createPost = $auth->createPermission('createPost');
        $auth->add($createPost);

        //добавляем роли
        $employerRole = $auth->createRole('employer');
        $auth->add($employerRole);
        //связываем роли с правами
        $auth->addChild($employerRole,$createPost);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220523_115803_create_rbac_data cannot be reverted.\n";

        return false;
    }

}
