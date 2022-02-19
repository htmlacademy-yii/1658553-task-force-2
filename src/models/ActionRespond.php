<?php

namespace taskforce\models;

class ActionRespond extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'откликнуться';
        $this->code = 'respond';
    }



    public function isAvailable(Task $task, int $profileUser):bool
    {
        if ($task->status === Task::STATUS_NEW && $task->executorId === $profileUser) {
            return true;
        }
        return false;
    }

}
