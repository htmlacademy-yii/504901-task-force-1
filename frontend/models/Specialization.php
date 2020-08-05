<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProfileSpecialization[] $profileSpecializations
 * @property Profile[] $profiles
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ProfileSpecializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileSpecializations()
    {
        return $this->hasMany(ProfileSpecialization::className(), ['specialization_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_user' => 'profile_id'])->viaTable('profile_specialization', ['specialization_id' => 'id']);
    }
}
