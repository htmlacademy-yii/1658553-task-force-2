<?php

use app\rbacRules\CancelRules;
use app\rbacRules\DoneRules;
use app\rbacRules\RefuseRules;
use app\rbacRules\RespondRules;
use yii\db\Migration;

/**
 * Class m220629_101347_update_rbac_system_for_change_task_status
 */
class m220629_101347_update_rbac_system_for_change_task_status extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        //права на отмену задания
        $cancelTask = $auth->createPermission('cancelTask');
        $cancelTask->description = 'Отменить задание';
        $auth->add($cancelTask);
        //права на завершение задания
        $doneTask = $auth->createPermission('doneTask');
        $doneTask->description = 'Завершить задание';
        $auth->add($doneTask);
        //права на отказ от задания
        $refuseTask = $auth->createPermission('refuseTask');
        $refuseTask->description = 'отказаться от задание';
        $auth->add($refuseTask);
        //права на отклик на задания
        $responseTask = $auth->createPermission('respondTask');
        $responseTask->description = 'Откликнуться на задание';
        $auth->add($responseTask);


        //право на создание задания
        $createTask = Yii::$app->authManager->getPermission('createPost');

        //создаем роль Администратора сайта
        $adminRole =  $auth->createRole('admin');
        $adminRole->description = 'Роль Администратора сайта';
        $auth->add($adminRole);
        //связываем роли с правами
        $auth->addChild($adminRole,$cancelTask);
        $auth->addChild($adminRole,$doneTask);
        $auth->addChild($adminRole,$responseTask);
        $auth->addChild($adminRole,$refuseTask);
        $auth->addChild($adminRole,$createTask);


        //создаем роль исполнителя
        $executorRole = $auth->createRole('executor');
        $executorRole->description = 'Роль исполнителя';
        $auth->add($executorRole);

//        подключаем кастомные правила

        //Кастомное правило для отмены задания
        $cancelRule = new CancelRules();
        $auth->add($cancelRule);
        // добавляем право "$cancelOwnTask" и связываем правило с ним
        $cancelOwnTask = $auth->createPermission('cancelOwnTask');
        $cancelOwnTask->description = 'отменить собственное задание';
        $cancelOwnTask->ruleName = $cancelRule->name;
        $auth->add($cancelOwnTask);
        // "$cancelOwnTask" наследует право "$cancelTask"
        $updateTaskCancelRule = Yii::$app->authManager->getPermission('cancelTask');
        $auth->addChild($cancelOwnTask,$updateTaskCancelRule);
        $author = Yii::$app->authManager->getRole('employer');
        // и тут мы позволяем автору задания отменить свое задание
        $auth->addChild($author, $cancelOwnTask);


        //Кастомное правило для завершения задания
        $doneRule = new DoneRules();
        $auth->add($doneRule);
        // добавляем право "$doneOwnTask" и связываем правило с ним
        $doneOwnTask = $auth->createPermission('doneOwnTask');
        $doneOwnTask->description = 'завершить собственное задание';
        $doneOwnTask->ruleName = $doneRule->name;
        $auth->add($doneOwnTask);
        // "$doneOwnTask" наследует право "$doneTask"
        $updateTaskDoneRule = Yii::$app->authManager->getPermission('doneTask');
        $auth->addChild($doneOwnTask,$updateTaskDoneRule);
        $author = Yii::$app->authManager->getRole('employer');
        // и тут мы позволяем автору задания завершить свое задание
        $auth->addChild($author, $doneOwnTask);


        //Кастомное правило для отказа на задания
        $refuseRule = new RefuseRules();
        $auth->add($refuseRule);
        // добавляем право "$refuseOwnTask" и связываем правило с ним
        $refuseOwnTask = $auth->createPermission('refuseOwnTask');
        $refuseOwnTask->description = 'отказаться от исполнения задания';
        $refuseOwnTask->ruleName = $refuseRule->name;
        $auth->add($refuseOwnTask);
        // "$refuseOwnTask" наследует право "$refuseTask"
        $updateTaskRefuseRule = Yii::$app->authManager->getPermission('refuseTask');
        $auth->addChild($refuseOwnTask,$updateTaskRefuseRule);
        $author = Yii::$app->authManager->getRole('executor');
        // и тут мы позволяем исполнителю задания отказаться от своего задания
        $auth->addChild($author, $refuseOwnTask);


        //Кастомное правило для отклика на задания
        $respondRule = new RespondRules();
        $auth->add($respondRule);
        // добавляем право "$respondOwnTask" и связываем правило с ним
        $respondOwnTask = $auth->createPermission('respondOwnTask');
        $respondOwnTask->description = 'откликнуться на задание';
        $respondOwnTask->ruleName = $respondRule->name;
        $auth->add($respondOwnTask);
        // "$respondOwnTask" наследует право "$respondTask"
        $updateTaskRespondRule = Yii::$app->authManager->getPermission('respondTask');
        $auth->addChild($respondOwnTask,$updateTaskRespondRule);
        $author = Yii::$app->authManager->getRole('executor');
        // и тут мы позволяем исполнителю задания отказаться от своего задания
        $auth->addChild($author, $respondOwnTask);

    }




    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220629_101347_update_rbac_system_for_change_task_status cannot be reverted.\n";

        return false;
    }


}
