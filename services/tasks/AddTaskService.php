<?php

namespace app\services\tasks;

use app\models\Cities;
use app\models\Files;
use app\models\forms\AddTaskForm;
use app\models\TaskFiles;
use app\models\Tasks;
use Yii;
use yii\db\Exception;
use yii\db\Migration;
use yii\web\UploadedFile;

class AddTaskService
{
    public function addTask(AddTaskForm $addTaskForm)
    {
        $migration = new Migration();
        $newTask = new Tasks();

        $newTask->create_time = date('Y-m-d H:i:s');
        $newTask->name = $addTaskForm->name;
        $newTask->info = $addTaskForm->info;
        $newTask->category_id = $addTaskForm->category_id;

        $newTask->price = $addTaskForm->price;
        $newTask->customer_id = Yii::$app->user->identity->getId();
        $newTask->executor_id = null;
        $newTask->status = 1;


        if ($addTaskForm->deadline_time) {
            $newTask->deadline_time = date('Y-m-d H:i:s', strtotime($addTaskForm->deadline_time));
        } else {
            $newTask->deadline_time = null;
        }
        $city = Cities::find()->where(['name'=>$addTaskForm->city])->one();


        if (!$city){
            return false;
        }

        $newTask->city_id = $city->id;


        $newTask->save();
        $taskId = $newTask->getId();


        $latLonArray = explode(',', $addTaskForm->tasks_coordinate);
        $lat = rtrim($latLonArray[0]);
        $lon = ltrim($latLonArray[1]);
        $migration->execute(
            "UPDATE tasks  SET tasks_coordinate = (point($lat,$lon)) where tasks.id = $taskId"
        );
        $newTask->address = $addTaskForm->address;


        $newTask->save();




        $addTaskForm->files = UploadedFile::getInstances($addTaskForm, 'files');
        if ($addTaskForm->files) {
            if (!mkdir($concurrentDirectory = "taskSrc/"."$taskId") && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
            $path = "taskSrc/"."$taskId/";
            foreach ($addTaskForm->files as $file) {
                $fileName = $file->baseName.'.'.$file->extension;

                $file->saveAs(
                    $path.$fileName
                );
                $newFile = new Files();
                $newFile->path = "$path"."$fileName";
                $newFile->save();
                $taskFile = new TaskFiles();
                $taskFile->file_id = $newFile->getId();
                $taskFile->task_id = $newTask->getId();
                $taskFile->save();
            }
        }

        return $newTask->getId();
    }
}