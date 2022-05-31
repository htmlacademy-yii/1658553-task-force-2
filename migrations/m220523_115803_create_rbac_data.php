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
        $executorRole = $auth->createRole('employer');
        $auth->add($executorRole);
        //связываем роли с правами
        $auth->addChild($executorRole,$createPost);

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
