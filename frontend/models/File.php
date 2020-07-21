<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id_file
 * @property int $id_task
 * @property string|null $name
 *
 * @property Task $task
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_task'], 'required'],
            [['id_task'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_task'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['id_task' => 'id_task']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_file' => 'Id File',
            'id_task' => 'Id Task',
            'name' => 'Name',
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
