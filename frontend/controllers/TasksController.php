<?php

namespace frontend\controllers;
use yii\bootstrap5\ActiveForm;

use frontend\models\FilterTasksForm;
use frontend\models\Task;
use frontend\models\User;
use frontend\models\Category;
use frontend\models\File;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\FileHelper;

/**
 * Tasks Controller
 */
class TasksController extends SecuredController
{
    // public function behaviors()
    // {
    //     $rules = parent::behaviors();
    //     $rule = [
    //         'allow' => true,
    //         'actions' => ['create'],
    //         'roles' => ['@'],
    //         'matchCallback' => function () {
    //            return Yii::$app->user->identity->isExecutor();
    //         },
    //         'denyCallback'  => function () {
    //             return Yii::$app->getResponse()->redirect(['/tasks']);
    //         }, 
    //     ];

    //     array_unshift($rules['access']['rules'], $rule);

    //     return $rules;
    // }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $this->changeActivity();
        $filter = new FilterTasksForm();
        $query = Task::find()
            ->joinWith('category')
            ->where(['status_id' => Task::STATUS_NEW])
            ->orderBy(['date_of_creation' => SORT_DESC]);
     
            $filter->load(Yii::$app->request->get());
            if ($filter->withoutResponse) {
                $query->join('LEFT JOIN', 'response', 'response.task_id = task.id');
                $query->andWhere(['task_id' => null]);
            }
            if ($filter->categories) {
                $categories = [];
                foreach($filter->categories as $category) {
                    $categories[] = $category + 1;
                }
                $query->andWhere(['in', 'category_id', $categories]);
            }
            if ($filter->remoteWork) {
                $query->andWhere(['address' => null]);
            }
            if ($filter->search) {
                $query->andWhere(['LIKE', 'task.name_task', $filter->search]);
            }
            switch ($filter->period) {
                case 'day':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d", strtotime("-1 day"))]);
                    break;
                case 'week':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 week"))]);
                    break;
                case 'month':
                    $query->andWhere(['>=', 'date_of_creation', date("Y-m-d H:i:s", strtotime("-1 month"))]);
                    break;
            };
        $tasks = $query->all();
        return $this->render('index', [
            'tasks' => $tasks,
            'filter' => $filter,
        ]);
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задания с id $id не существует");
        }
        return $this->render('view',['task' => $task]);
    }

    public function changeActivity(){
        $user = User::findOne(Yii::$app->user->identity->id);
        $user->date_activity=(new \DateTime())->format( 'Y-m-d H:i:s' );;
        $user->save();
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->identity->isExecutor()) {
            return Yii::$app->getResponse()->redirect(['/tasks']);
        };
        $model = new Task();
        $model->owner_id = Yii::$app->user->id;
        $model->status_id = Task::STATUS_NEW;
        $categories = Category::find()->all();

        if($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                if ($model->upload() && $model->save(false)) {
                    // file is uploaded successfully
                    foreach ($model->imageFiles as $file) {
                        $file = 'uploads/' . $file->baseName . '.' . $file->extension;
                        $image = new File();
                        $image->task_id = $model->id;
                        $image->name = $file;
                        $image->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                // else {
                //     $model->errors = $model->getErrors();
                //     var_dump($model->errors);
                //}
            } 
            
            
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }
}
