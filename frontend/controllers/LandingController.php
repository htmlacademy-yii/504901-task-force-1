<?php
namespace frontend\controllers;
use frontend\models\LoginForm;
use yii\web\Controller;
use Yii;

class LandingController extends Controller
{

    // public function beforeAction($action)
    // {
    //     $this->layout = 'landing';

    //     $this->enableCsrfValidation = false;
    //     return true;
    // }

    // public function actions()
    // {
    //     return [
    //         'error' => [
    //             'class' => 'yii\web\ErrorAction',
    //         ],
    //     ];
    // }

    public function actionIndex()
    {
        $this->layout = 'landing'; 
       
        return $this->render('index');
    }
    
    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());

            if ($loginForm->validate()) {
                $user = $loginForm->getUser();

                \Yii::$app->user->login($user);

                return $this->goHome();
            }
        }
        //if (Yii::$app->request->isAjax) {
        // $loginForm = new LoginForm();
        // if (\Yii::$app->request->getIsPost()) {
        //     $loginForm->load(\Yii::$app->request->post());
        //     if ($loginForm->validate()) {
        //         $user = $loginForm->getUser();
        //         \Yii::$app->user->login($user);
        //         return $this->redirect("/tasks");
           
        //      }     
        //  }
        // return $this->render('login', [
        //     'model' => $loginForm,
        // ]);
   // }
}


}
