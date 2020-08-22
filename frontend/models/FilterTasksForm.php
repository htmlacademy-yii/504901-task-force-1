<?php

namespace frontend\models;

use yii\base\Model;

class FilterTasksForm extends Model
{
    public $categories;
    public $withoutResponse;
    public $remoteWork;
    public $period;
    public $search;

    public function attributeLabels()
    {
        return [
            'withoutResponse' => 'Без откликов',
            'remoteWork' => 'Удаленная работа',
            'period' => 'Период',
            'search' => 'Поиск по названию'
        ];
    }

    public function attributeLabelsPeriod()
    {
        return [
            'day' => 'За день',
            'week' => 'За неделю',
            'month' => 'За месяц',
            'all' => 'За всё время',
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'withoutResponse', 'remoteWork', 'period', 'search'], 'safe']
        ];
    }

}
