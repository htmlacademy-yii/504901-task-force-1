<?php

namespace frontend\models;

use yii\base\Model;

class FilterUsersForm extends Model
{
    public $categories;
    public $freeNow;
    public $onlineNow;
    public $withReviews;
    public $withFavorites;
    public $search;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'freeNow' => 'Сейчас свободен',
            'onlineNow' => 'Сейчас онлайн',
            'withReviews' => 'Есть отзывы',
            'withFavorites' => 'В избранном',
            'search' => 'Поиск по имени'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'freeNow', 'onlineNow', 'withReviews', 'withFavorites', 'search'], 'safe']
        ];
    }
}