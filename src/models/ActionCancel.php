<?php

namespace taskforce\models;

class ActionCancel extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'Отменить';
        $this->code = 'cancel';
    }


    public function isAvailable(Task $task, int $profileUser)
    {
        if ($task->status === Task::STATUS_NEW && $task->customerId === $profileUser) {
            return true;
        }
    }

}
