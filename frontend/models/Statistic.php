<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "statistic".
 *
 * @property int $id_user
 * @property float $rating
 * @property int $count_tasks
 * @property int $count_views
 * @property int $count_fail
 * @property int $count_reviews
 *
 * @property Profile $user
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statistic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user', 'count_tasks', 'count_views', 'count_fail'], 'integer'],
            [['rating'], 'number'],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'rating' => 'Rating',
            'count_tasks' => 'Count Tasks',
            'count_views' => 'Count Views',
            'count_fail' => 'Count Fail',
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
}
