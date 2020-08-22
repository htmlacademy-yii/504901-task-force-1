<?php

namespace frontend\models;

/**
 * This is the model class for table "review".
 *
 * @property int $id_review
 * @property string $date_add
 * @property int|null $mark
 * @property string|null $comment
 * @property int|null $id_user
 *
 * @property Profile $user
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
            [['mark', 'id_user'], 'integer'],
            [['comment'], 'string'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_user' => 'id_user']],
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
            'id_user' => 'Id User',
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
