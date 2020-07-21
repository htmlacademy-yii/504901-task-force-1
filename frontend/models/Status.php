<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id_status
 * @property string|null $name
 * @property string|null $translation
 *
 * @property StatusRole[] $statusRoles
 * @property Role[] $roles
 * @property Task[] $tasks
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'translation'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status' => 'Id Status',
            'name' => 'Name',
            'translation' => 'Translation',
        ];
    }

    /**
     * Gets query for [[StatusRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRoles()
    {
        return $this->hasMany(StatusRole::className(), ['id_status' => 'id_status']);
    }

    /**
     * Gets query for [[Roles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Role::className(), ['id_role' => 'id_role'])->viaTable('status_role', ['id_status' => 'id_status']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id_status' => 'id_status']);
    }
}
