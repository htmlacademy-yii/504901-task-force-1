<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "executor_task".
 *
 * @property int $id_task
 * @property string $date_of_appointment
 * @property int $id_executor
 *
 * @property Profile $executor
 */
class ExecutorTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'executor_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_task', 'id_executor'], 'required'],
            [['id_task', 'id_executor'], 'integer'],
            [['date_of_appointment'], 'safe'],
            [['id_task'], 'unique'],
            [['id_executor'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_executor' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_task' => 'Id Task',
            'date_of_appointment' => 'Date Of Appointment',
            'id_executor' => 'Id Executor',
        ];
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'id_executor']);
    }
}
