<?php

namespace app\services\tasks;

use app\models\Tasks;
use app\models\Users;

class MyTasksService
{
    private $role;
    private $user;

    public function __construct(Users $user)
    {
        $this->role = $user->getRoleName();
        $this->user = $user;
    }

    public function getMyTasksNew()
    {
        $tasks = Tasks::find();

        $tasks = $tasks->where(['customer_id' => $this->user->id]);
        $tasks = $tasks->andWhere(['status' => Tasks::STATUS_NEW]);

        return $tasks->orderBy(['create_time' => SORT_DESC]);
    }

    public function getMyTasksInProgress()
    {
        $tasks = Tasks::find();
        if ($this->role === 'employer') {
            $tasks = $tasks->where(['customer_id' => $this->user->id]);
            $tasks = $tasks->andWhere(['status' => Tasks::STATUS_IN_WORK]);

            return $tasks->orderBy(['create_time' => SORT_DESC]);
        }

        if ($this->role === 'executor') {
            $tasks = $tasks->where(['executor_id' => $this->user->id]);
            $tasks = $tasks->andWhere(['status' => Tasks::STATUS_IN_WORK]);

            return $tasks->orderBy(['create_time' => SORT_DESC]);
        }
    }

    public function getMyTasksDelayed()
    {
        $tasks = Tasks::find();

        $tasks = $tasks->where(['executor_id' => $this->user->id]);
        $tasks = $tasks->andWhere(['status' => Tasks::STATUS_IN_WORK]);
        $tasks = $tasks->andWhere(['<', 'deadline_time', date('Y-m-d H:i:s')]);

        return $tasks->orderBy(['create_time' => SORT_DESC]);
    }

    public function getMyTasksClosed()
    {
        $tasks = Tasks::find();
        if ($this->role === 'employer') {
            $tasks = $tasks->where(['customer_id' => $this->user->id]);
            $tasks = $tasks->andWhere(['status' => Tasks::STATUS_CANCELLED]);
            $tasks = $tasks->orWhere(['executor_id'=>$this->user->id,'status' => Tasks::STATUS_DONE]);
            $tasks = $tasks->orWhere(['executor_id'=>$this->user->id,'status' => Tasks::STATUS_FAILED]);

            return $tasks->orderBy(['create_time' => SORT_DESC]);
        }

        if ($this->role === 'executor') {
            $tasks = $tasks->where(['executor_id' => $this->user->id]);
            $tasks = $tasks->andWhere(['status' => Tasks::STATUS_DONE]);

            $tasks = $tasks->orWhere(['executor_id'=>$this->user->id,'status' => Tasks::STATUS_FAILED,]);


            return $tasks->orderBy(['create_time' => SORT_DESC]);
        }
    }
}