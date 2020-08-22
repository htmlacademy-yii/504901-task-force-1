<?php

namespace frontend\models;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $date_of_registration
 * @property int|null $last_activity
 *
 * @property Profile $profile
 * @property UserActivity[] $userActivities
 */
class User extends \yii\db\ActiveRecord
{
    const CUSTOMER = 1;
    const EXECUTOR = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name'], 'required'],
            [['date_of_registration'], 'safe'],
            [['last_activity'], 'integer'],
            [['email'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'date_of_registration' => 'Date Of Registration',
            'last_activity' => 'Last Activity',
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[UserActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserActivities()
    {
        return $this->hasMany(UserActivity::className(), ['id_user' => 'id_user']);
    }
}
