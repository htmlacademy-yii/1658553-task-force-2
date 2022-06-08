<?php

namespace app\services\tasks;

use app\models\TaskFiles;
use Yii;

class GetFilesTaskService
{
    public $taskFiles;

    public function __construct(int $taskId){
        $this->taskFiles = TaskFiles::find()->where("task_id = $taskId")->all();

    }
    public function getFilesName(){
        if ($this->taskFiles){
            $fileInfo = [];
            foreach ($this->taskFiles as $file){

                $fileSize = filesize(Yii::getAlias($file->file->path));

                $fileName = mb_substr($file->file->path, mb_strpos($file->file->path, '/') + mb_strlen('/')+
                    mb_strlen(' / '));


                $fileInfo[$file->file->id] =  [
                    'name'=>$fileName,
                    'size'=>$fileSize
                ];
            }

            return $fileInfo;
        }
        return false;
    }
}
