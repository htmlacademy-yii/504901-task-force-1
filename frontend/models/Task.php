<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $date_of_creation
 * @property int $status_id
 * @property string $name_task
 * @property int $category_id
 * @property string $description
 * @property string|null $date_of_completion
 * @property int|null $budget
 * @property int $owner_id
 * @property string|null $address
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property File[] $files
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Status $status
 * @property User $owner
 * @property Category $category
 */
class Task extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_CANCELED = 2;
    const STATUS_IN_WORK = 3;
    const STATUS_PERFORMED = 4;
    const STATUS_FAILED = 5;

    public $imageFiles;
    public $errors;
    public $radio;
    public $comment;
    public $mark;
    public $cost;
    
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
            [['date_of_creation', 'date_of_completion', 'budget', 'latitude', 'longitude', 'address', 'comment', 'imageFiles', 'errors', 'radio' ], 'safe'],
            [['status_id', 'name_task', 'category_id', 'description', 'owner_id'], 'required'],
            [['status_id', 'category_id', 'owner_id', 'cost'], 'integer'],
            [['description'], 'string', 'min' => 30],
            [['mark'], 'integer', 'min' => 1, 'max' => 5],
            [['name_task'], 'string', 'min' => 10, 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => true],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_of_creation' => 'Date Of Creation',
            'status_id' => 'Status ID',
            'name_task' => 'Название задание',
            'category_id' => 'Категория',
            'description' => 'Описание',
            'date_of_completion' => 'Срок исполнения',
            'budget' => 'Бюджет',
            'owner_id' => 'Owner ID',
            'address' => 'Локация',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'imageFiles' => 'Файлы',
            'cost' => 'Ваша цена'
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
 
}
