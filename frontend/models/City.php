<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id_city
 * @property string $name
 * @property float $latitude
 * @property float $longitude
 *
 * @property Profile[] $profiles
 * @property Task[] $tasks
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'latitude', 'longitude'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_city' => 'Id City',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_city' => 'id_city']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id_city' => 'id_city']);
    }
}
