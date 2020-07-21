<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id_customer
 * @property int $id_executor
 *
 * @property Profile $customer
 * @property Profile $executor
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_customer', 'id_executor'], 'required'],
            [['id_customer', 'id_executor'], 'integer'],
            [['id_customer', 'id_executor'], 'unique', 'targetAttribute' => ['id_customer', 'id_executor']],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_customer' => 'id_user']],
            [['id_executor'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_executor' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'id_executor' => 'Id Executor',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'id_customer']);
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
