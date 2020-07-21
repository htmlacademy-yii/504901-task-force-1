<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id_review
 * @property string $date_add
 * @property int|null $mark
 * @property string|null $comment
 * @property int $id_task
 *
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
            [['mark', 'id_task'], 'integer'],
            [['comment'], 'string'],
            [['id_task'], 'required'],
            [['id_task'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['id_task' => 'id_task']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_review' => 'Id Review',
            'date_add' => 'Date Add',
            'mark' => 'Mark',
            'comment' => 'Comment',
            'id_task' => 'Id Task',
        ];
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
