<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string $date_add
 * @property int|null $mark
 * @property string|null $comment
 * @property int $task_id
 * @property int $user_id 
 *
 * @property User $user 
 * @property Task $task
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_add'], 'safe'],
            [['mark', 'task_id', 'user_id'], 'integer'],
            [['comment'], 'string'],
            [['task_id', 'user_id'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_add' => 'Date Add',
            'mark' => 'Mark',
            'comment' => 'Comment',
            'task_id' => 'Task ID',
            'user_id' => 'User ID', 
        ];
    }

    /** 
    * Gets query for [[User]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getUser() 
   { 
       return $this->hasOne(User::className(), ['id' => 'user_id']); 
   }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
