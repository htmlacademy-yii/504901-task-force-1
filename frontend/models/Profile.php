<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id_user
 * @property string|null $avatar
 * @property string|null $birthday
 * @property int $id_role
 * @property string|null $about
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $telegram
 * @property int $id_city
 * @property string|null $address
 * @property int $new_message
 * @property int $actions
 * @property int $new_review
 * @property int $show_contact
 * @property int $show_profile
 *
 * @property ExecutorTask[] $executorTasks
 * @property Favorite[] $favorites
 * @property Favorite[] $favorites0
 * @property Profile[] $executors
 * @property Profile[] $customers
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property City $city
 * @property User $user
 * @property Role $role
 * @property ProfileSpecialization[] $profileSpecializations
 * @property Specialization[] $specializations
 * @property Response[] $responses
 * @property Statistic $statistic
 * @property Task[] $tasks
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_role', 'id_city'], 'required'],
            [['id_user', 'id_role', 'id_city', 'new_message', 'actions', 'new_review', 'show_contact', 'show_profile'], 'integer'],
            [['birthday'], 'safe'],
            [['about'], 'string'],
            [['avatar', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'telegram'], 'string', 'max' => 50],
            [['id_user'], 'unique'],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_city' => 'id_city']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id_role']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'avatar' => 'Avatar',
            'birthday' => 'Birthday',
            'id_role' => 'Id Role',
            'about' => 'About',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'id_city' => 'Id City',
            'address' => 'Address',
            'new_message' => 'New Message',
            'actions' => 'Actions',
            'new_review' => 'New Review',
            'show_contact' => 'Show Contact',
            'show_profile' => 'Show Profile',
        ];
    }

    /**
     * Gets query for [[ExecutorTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorTasks()
    {
        return $this->hasMany(ExecutorTask::className(), ['id_executor' => 'id_user']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['id_customer' => 'id_user']);
    }

    /**
     * Gets query for [[Favorites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites0()
    {
        return $this->hasMany(Favorite::className(), ['id_executor' => 'id_user']);
    }

    /**
     * Gets query for [[Executors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutors()
    {
        return $this->hasMany(Profile::className(), ['id_user' => 'id_executor'])->viaTable('favorite', ['id_customer' => 'id_user']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Profile::className(), ['id_user' => 'id_customer'])->viaTable('favorite', ['id_executor' => 'id_user']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['id_user' => 'id_user']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
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

    /**
     * Gets query for [[ProfileSpecializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfileSpecializations()
    {
        return $this->hasMany(ProfileSpecialization::className(), ['profile_id' => 'id_user']);
    }

    /**
     * Gets query for [[Specializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecializations()
    {
        return $this->hasMany(Specialization::className(), ['id' => 'specialization_id'])->viaTable('profile_specialization', ['profile_id' => 'id_user']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Statistic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatistic()
    {
        return $this->hasOne(Statistic::className(), ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id_owner' => 'id_user']);
    }
}

