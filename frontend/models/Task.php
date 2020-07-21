<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id_task
 * @property string $date_of_creation
 * @property int $id_status
 * @property string $name_task
 * @property int $id_city
 * @property string|null $address
 * @property int $id_category
 * @property string $description
 * @property string|null $date_of_completion
 * @property int|null $budget
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $id_owner
 *
 * @property File[] $files
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Status $status
 * @property Profile $owner
 * @property City $city
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_creation', 'date_of_completion'], 'safe'],
            [['id_status', 'name_task', 'id_city', 'id_category', 'description', 'id_owner'], 'required'],
            [['id_status', 'id_city', 'id_category', 'budget', 'id_owner'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['name_task'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 50],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['id_status' => 'id_status']],
            [['id_owner'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_owner' => 'id_user']],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_city' => 'id_city']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_task' => 'Id Task',
            'date_of_creation' => 'Date Of Creation',
            'id_status' => 'Id Status',
            'name_task' => 'Name Task',
            'id_city' => 'Id City',
            'address' => 'Address',
            'id_category' => 'Id Category',
            'description' => 'Description',
            'date_of_completion' => 'Date Of Completion',
            'budget' => 'Budget',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'id_owner' => 'Id Owner',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id_task' => 'id_task']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['id_task' => 'id_task']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['id_task' => 'id_task']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id_task' => 'id_task']);
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
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Profile::className(), ['id_user' => 'id_owner']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id_city' => 'id_city']);
    }
}
