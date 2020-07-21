<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id_category
 * @property string $name
 * @property string $icon
 *
 * @property Specialization[] $specializations
 * @property Profile[] $users
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'Id Category',
            'name' => 'Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[Specializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecializations()
    {
        return $this->hasMany(Specialization::className(), ['id_category' => 'id_category']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Profile::className(), ['id_user' => 'id_user'])->viaTable('specialization', ['id_category' => 'id_category']);
    }
}
