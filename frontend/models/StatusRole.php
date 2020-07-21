<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status_role".
 *
 * @property int $id_status
 * @property int $id_role
 *
 * @property Status $status
 * @property Role $role
 */
class StatusRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_status', 'id_role'], 'required'],
            [['id_status', 'id_role'], 'integer'],
            [['id_status', 'id_role'], 'unique', 'targetAttribute' => ['id_status', 'id_role']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['id_status' => 'id_status']],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id_role']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status' => 'Id Status',
            'id_role' => 'Id Role',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id_status' => 'id_status']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id_role' => 'id_role']);
    }
}
