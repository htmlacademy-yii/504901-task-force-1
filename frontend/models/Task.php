<?php

namespace frontend\models;

/**
 * This is the model class for table "task".
 *
 * @property int $id_task
 * @property string $date_of_creation
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
 * @property string|null $status
 *
 * @property File[] $files
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property Profile $owner
 * @property City $city
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_PERFORMED = 'performed';
    const STATUS_FAILED = 'failed';

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
            [['name_task', 'id_city', 'id_category', 'description', 'id_owner'], 'required'],
            [['id_city', 'id_category', 'budget', 'id_owner'], 'integer'],
            [['description'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['name_task', 'status'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 50],
            [['id_owner'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['id_owner' => 'id_user']],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_city' => 'id_city']],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id_category']],
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
            'status' => 'Status',
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

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }
}
