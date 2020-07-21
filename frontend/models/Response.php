<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property int $id_response
 * @property string $date_add
 * @property int|null $cost
 * @property int $id_task
 * @property int $id_user
 * @property int|null $mark
 * @property int|null $performed
 * @property string|null $message
 *
 * @property Profile $user
 * @property Task $task
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_add'], 'safe'],
            [['cost', 'id_task', 'id_user', 'mark', 'performed'], 'integer'],
            [['id_task', 'id_user'], 'required'],
            [['message'], 'string'],
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
            'id_response' => 'Id Response',
            'date_add' => 'Date Add',
            'cost' => 'Cost',
            'id_task' => 'Id Task',
            'id_user' => 'Id User',
            'mark' => 'Mark',
            'performed' => 'Performed',
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
