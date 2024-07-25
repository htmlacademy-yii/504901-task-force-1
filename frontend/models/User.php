<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $date_of_registration
 * @property string|null $avatar
 * @property string|null $birthday
 * @property string|null $about
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $telegram
 * @property int $city_id
 * @property int $new_message
 * @property int $actions
 * @property int $new_review
 * @property int $show_contact
 * @property int $show_profile
 * @property float $rating
 * @property int $count_tasks
 * @property int $count_views
 * @property int $count_fail
 * @property string $date_activity
 * @property string|null $role
 *
 * @property ExecutorTask[] $executorTasks
 * @property Response[] $responses
 * @property Specialization[] $specializations
 * @property Task[] $tasks
 * @property City $city
 */
class User extends \yii\db\ActiveRecord
{
    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name', 'city_id'], 'required'],
            [['date_of_registration', 'birthday', 'date_activity'], 'safe'],
            [['about'], 'string'],
            [['city_id', 'new_message', 'actions', 'new_review', 'show_contact', 'show_profile', 'count_tasks', 'count_views', 'count_fail'], 'integer'],
            [['rating'], 'number'],
            [['email'], 'string', 'max' => 128],
            [['password', 'avatar'], 'string', 'max' => 255],
            [['name', 'skype', 'telegram'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 11],
            [['role'], 'string', 'max' => 10],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'date_of_registration' => 'Date Of Registration',
            'avatar' => 'Avatar',
            'birthday' => 'Birthday',
            'about' => 'About',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'city_id' => 'City ID',
            'new_message' => 'New Message',
            'actions' => 'Actions',
            'new_review' => 'New Review',
            'show_contact' => 'Show Contact',
            'show_profile' => 'Show Profile',
            'rating' => 'Rating',
            'count_tasks' => 'Count Tasks',
            'count_views' => 'Count Views',
            'count_fail' => 'Count Fail',
            'date_activity' => 'Date Activity',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[ExecutorTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorTasks()
    {
        return $this->hasMany(ExecutorTask::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Specializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecializations()
    {
        return $this->hasMany(Specialization::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['owner_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
