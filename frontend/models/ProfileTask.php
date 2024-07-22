<?php

namespace frontend\models;

/**
 * This is the model class for table "profile_task".
 *
 * @property int $profile_id
 * @property int $task_id
 * @property int|null $cost
 * @property string|null $message
 * @property int|null $status
 * @property int $created_at
 *
 * @property Profile $profile
 * @property Task $task
 */
class ProfileTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_id', 'task_id', 'created_at'], 'required'],
            [['profile_id', 'task_id', 'cost', 'status', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['profile_id', 'task_id'], 'unique', 'targetAttribute' => ['profile_id', 'task_id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id_user']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id_task']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => 'Profile ID',
            'task_id' => 'Task ID',
            'cost' => 'Cost',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'profile_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id_task' => 'task_id']);
    }
}
