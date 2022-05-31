<?php

namespace app\models\forms;

use app\models\Categories;
use yii\base\Model;

class TaskFilterForm extends Model
{
    const INTERVAL_1_HOURS = 1;
    const INTERVAL_12_HOURS = 2;
    const INTERVAL_24_HOURS = 3;

    public $categoryIds;
    public $isNoExecutor;
    public $isRemote;
    public $interval;

    /**
     * @return string[] Названия полей формы
     */
    public function attributeLabels(): array
    {
        return [
            'categoryIds'  => 'Категория',
            'isNoExecutor' => 'Без исполнителя',
            'isRemote'     => 'Удаленно',
            'interval'     => 'Интервал',

        ];
    }

    /**
     * @return array[] Поля формы
     */
    public function rules(): array
    {
        return [
            [['categoryIds', 'isNoExecutor', 'isRemote', 'interval'], 'safe'],
        ];
    }

    /**
     * @return array список чекбоксов для лейбла "категории"
     */
    public static function getCategories()
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


    /**
     * @return array дропдаун для лейбла "период"
     */
    public static function getInterval()
    {
        $interval = [];
        $interval[self::INTERVAL_1_HOURS] = '1 час';
        $interval[self::INTERVAL_12_HOURS] = '12 часов';
        $interval[self::INTERVAL_24_HOURS] = '24 часа';

        return $interval;
    }
}