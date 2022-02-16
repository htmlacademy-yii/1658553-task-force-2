<?php

namespace taskforce\models;

class ActionCancel extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'Отменить';
        $this->code = 'cancel';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function isAction(task $task, int $profileUser)
    {
        if ($task->status === Task::STATUS_NEW & $task->customerId === $profileUser) {
            return true;
        }
    }

}
