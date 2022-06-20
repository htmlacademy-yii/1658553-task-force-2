<?php

namespace app\widgets\taskViewButtons\actions;

class ActionDone extends AbstractAction
{


    public function __construct()
    {
        $this->name = 'завершить';
        $this->code = 'done';
    }



    public function isAvailable(accessButtonsControl $task, int $profileUser):bool
    {
        if ($task->status === accessButtonsControl::STATUS_IN_WORK && $task->customerId === $profileUser) {
            return true;
        }
        return false;
    }

}
