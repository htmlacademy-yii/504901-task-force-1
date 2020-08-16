<?php

namespace frontend\models;

/**
 * This is the model class for table "category".
 *
 * @property int $id_category
 * @property string $name
 * @property string $icon
 *
 * @property CategoryProfile[] $categoryProfiles
 * @property Profile[] $profiles
 * @property Task[] $tasks
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
     * Gets query for [[CategoryProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProfiles()
    {
        return $this->hasMany(CategoryProfile::className(), ['category_id' => 'id_category']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_user' => 'profile_id'])->viaTable('category_profile', ['category_id' => 'id_category']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id_category' => 'id_category']);
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
