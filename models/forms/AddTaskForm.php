<?php

namespace app\models\forms;


use app\models\Categories;
use app\models\Cities;
use yii\base\Model;

class AddTaskForm extends Model
{
    public $name;
    public $info;
    public $category_id;
    public $city_id;
    public $price;
    public $deadline_time;
    public $files;
    public $address;
    public $tasks_coordinate;

    public function rules()
    {
        return [
            [['name', 'info'], 'required', 'message' => 'поле должно быть заполнено'],
            [['deadline_time'], 'date', 'format' => 'php:Y-m-d', 'skipOnEmpty' => false],
            [['city_id'], 'integer'],
            [
                ['price'],
                'integer',
                'min'      => 1,
                'tooSmall' => 'Бюджет не может быть 0 или меньше',
                'message'  => 'Бюджет должен быть целым числом',
            ],
            [['category_id'], 'integer'],
            [
                ['files'],
                'file',
                'maxSize'        => 1024 * 1024 * 0.5,
                'maxFiles'       => 4,
                'tooBig'         => 'файл слишком большой',

            ],
            [['name', 'info'], 'validateNameInfo'],
            [['deadline_time'],'validateDate'],


        ];
    }


    /**
     * @return string[] Названия полей формы
     */
    public function attributeLabels(): array
    {
        return [
            'name'          => 'Опишите суть работы',
            'info'          => 'Подробности задания',
            'category_id'   => 'Категория',
            'city_id'       => 'Локация',
            'price'         => 'Бюджет',
            'deadline_time' => 'Срок исполнения',
            'files'         => 'Файлы',

        ];
    }


    public static function getCities()
    {
        /**
         * @var Cities[] $cities
         */
        $cities = Cities::find()->all();
        $citiesData = [];
        foreach ($cities as $city) {
            $citiesData[$city->id] = $city->name;
        }

        return $citiesData;
    }


    public static function getCategory()
    {
        /**
         * @var Categories[] $categories
         */
        $categories = Categories::find()->all();
        $categoriesData = [];
        foreach ($categories as $category) {
            $categoriesData[$category->id] = $category->name;
        }

        return $categoriesData;
    }

    public function validateNameInfo()
    {
        if (!empty($this->name) && (mb_strlen(str_replace(' ', '', $this->name)) < 10)) {
            $errorMsg = 'Не пробельных символов должно быть не менее 10';
            $this->addError('name', $errorMsg);
        }
        if (!empty($this->name) && (mb_strlen(str_replace(' ', '', $this->name)) > 35)) {
            $errorMsg = 'Не пробельных символов должно быть не менее 10 и не более 35';
            $this->addError('name', $errorMsg);
        }
        if (!empty($this->info) && (mb_strlen(str_replace(' ', '', $this->info)) < 30)) {
            $errorMsg = 'Не пробельных символов должно быть не менее 30';
            $this->addError('info', $errorMsg);
        }
        if (!empty($this->info) && (mb_strlen(str_replace(' ', '', $this->info)) > 450)) {
            $errorMsg = 'Не пробельных символов должно быть не менее 30 и не более 450';
            $this->addError('info', $errorMsg);
        }
    }
    public function validateDate()
    {
        if ($this->deadline_time < date('Y-m-d')){
            $errorMsg = 'Дата не может быть раньше текущего дня.';
            $this->addError('deadline_time', $errorMsg);
        }
    }


}