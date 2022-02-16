<?php

namespace taskforce\models;

class ActionDone extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'завершить';
        $this->code = 'done';
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
        if ($task->status === Task::STATUS_IN_WORK & $task->customerId === $profileUser) {
            return true;
        }
    }

}
