<?php

namespace taskforce\models;

class ActionDone extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'завершить';
        $this->code = 'done';
    }



    public function isAvailable(Task $task, int $profileUser)
    {
        if ($task->status === Task::STATUS_IN_WORK & $task->customerId === $profileUser) {
            return true;
        }
    }

}
