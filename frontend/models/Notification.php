<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id_notification
 * @property string $date_add
 * @property int $id_task
 * @property int $id_user
 * @property string|null $message
 *
 * @property Profile $user
 * @property Task $task
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_add'], 'safe'],
            [['id_task', 'id_user'], 'required'],
            [['id_task', 'id_user'], 'integer'],
            [['message'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_task'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['id_task' => 'id_task']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notification' => 'Id Notification',
            'date_add' => 'Date Add',
            'id_task' => 'Id Task',
            'id_user' => 'Id User',
            'message' => 'Message',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id_task' => 'id_task']);
    }
}
