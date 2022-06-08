<?php

namespace app\widgets\taskViewButtons\actions;

class ActionRefuse extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'отказаться';
        $this->code = 'refuse';
    }



    public function isAvailable(accessButtonsControl $task, int $profileUser):bool
    {
        if ($task->status === accessButtonsControl::STATUS_IN_WORK && $task->executorId === $profileUser) {
            return true;
        }
        return false;
    }

}
