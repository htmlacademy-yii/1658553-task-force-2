<?php

namespace taskforce\models;
use taskforce\exception;

class ActionCancel extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'Отменить';
        $this->code = 'cancel';
    }


    public function isAvailable(Task $task, int $profileUser):bool
    {
        if ($task->status === Task::STATUS_NEW && $task->customerId === $profileUser) {
            return true;
        }
        return false;
    }

}
