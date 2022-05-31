<?php

namespace app\services\tasks;

use app\models\Files;
use app\models\forms\AddTaskForm;
use app\models\TaskFiles;
use app\models\Tasks;
use Yii;
use yii\web\UploadedFile;

class AddTaskService
{
    public function addTask(AddTaskForm $addTaskForm)
    {
        $newTask = new Tasks();
        $newTask->create_time = date('Y-m-d H:i:s');
        $newTask->deadline_time = date('Y-m-d H:i:s',strtotime($addTaskForm->deadline_time));
        $newTask->name = $addTaskForm->name;
        $newTask->info = $addTaskForm->info;
        $newTask->category_id = $addTaskForm->category_id;
        $newTask->city_id = $addTaskForm->city_id;
        $newTask->price =  $addTaskForm->price;
        $newTask->customer_id = 1;
        $newTask->executor_id = null;
        $newTask->status = 1;
        $newTask->save();

        $addTaskForm->files = UploadedFile::getInstance($addTaskForm, 'files');
        if ($addTaskForm->files) {
            $fileName = $addTaskForm->files->baseName.date('yymmddHHmmss').
                '.'.
                $addTaskForm->files->extension;
            $path = 'img/tasksSrc/';
            $addTaskForm->files->saveAs(
                $path.$fileName
            );
            $newFile = new Files();
            $newFile->path = "/$path"."$fileName";
            $newFile->save();
            $taskFile = new TaskFiles();
            $taskFile->file_id = $newFile->getId();
            $taskFile->task_id = $newTask->getId();

        }

        return $newTask->getId();
    }
}