<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_activity".
 *
 * @property int $id_activity
 * @property int $id_user
 * @property int $id_event
 * @property string $date_activity
 *
 * @property User $user
 * @property Event $event
 */
class UserActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_event'], 'required'],
            [['id_user', 'id_event'], 'integer'],
            [['date_activity'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_event'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['id_event' => 'id_event']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_activity' => 'Id Activity',
            'id_user' => 'Id User',
            'id_event' => 'Id Event',
            'date_activity' => 'Date Activity',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id_event' => 'id_event']);
    }
}
