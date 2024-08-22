<?php

namespace frontend\models;

use yii\db\Command;
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
 * @property Review[] $reviews 
 * @property Specialization[] $specializations
 * @property Task[] $tasks
 * @property City $city
 * @property Work[] $works 
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
    
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    protected function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }

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
            [['avatar'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 8, 'message' => "Длина пароля от 8 символов"],
            [['skype', 'telegram'], 'string', 'max' => 50],
            ['phone', 'match', 'pattern' => '/^[\d]{11}/i'],
            [['role'], 'string', 'max' => 10],
            ['email', 'email', 'message' => "Введите валидный адрес электронной почты"],
            [['email'], 'unique'],
            [['name'], 'string', 'max' => 50, 'message' => "Введите ваше имя и фамилию"],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id'], 
                'message' => "Укажите город, чтобы находить подходящие задачи"],
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
            'password' => 'Пароль',
            'name' => 'Имя',
            'date_of_registration' => 'Date Of Registration',
            'avatar' => 'Avatar',
            'birthday' => 'Birthday',
            'about' => 'About',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'city_id' => 'Город проживания',
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
    * Gets query for [[Reviews]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getReviews() 
   { 
       return $this->hasMany(Review::className(), ['user_id' => 'id']); 
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

    /** 
    * Gets query for [[Works]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getWorks() 
   { 
       return $this->hasMany(Work::className(), ['user_id' => 'id']); 
   }  

   public function beforeSave($insert) {
   if ($this->isAttributeChanged('password')) {
    $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
   }
   return parent::beforeSave($insert);
    
   }

   public function isExecutor() {
    if (isset($this->specializations[0])){
       return false;
    }
    return true;
   }

}
