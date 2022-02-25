<?php

namespace taskforce\models;

class ActionRefuse extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'отказаться';
        $this->code = 'refuse';
    }



    public function isAvailable(Task $task, int $profileUser):bool
    {
        if ($task->status === Task::STATUS_IN_WORK && $task->executorId === $profileUser) {
            return true;
        }
        return false;
    }

}
