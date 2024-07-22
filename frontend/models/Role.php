<?php

namespace frontend\models;


/**
 * This is the model class for table "role".
 *
 * @property int $id_role
 * @property string|null $name
 *
 * @property Profile[] $profiles
 * @property StatusRole[] $statusRoles
 * @property Status[] $statuses
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_role' => 'Id Role',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['id_role' => 'id_role']);
    }

    /**
     * Gets query for [[StatusRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRoles()
    {
        return $this->hasMany(StatusRole::className(), ['id_role' => 'id_role']);
    }

    /**
     * Gets query for [[Statuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasMany(Status::className(), ['id_status' => 'id_status'])->viaTable('status_role', ['id_role' => 'id_role']);
    }
}
