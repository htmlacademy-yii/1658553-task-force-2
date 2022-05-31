<?php

namespace app\controllers;


use app\models\forms\LoginForm;
use app\models\forms\RegistrationForm;
use app\services\user\RegistrationService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;

class LandingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class'        => AccessControl::class,
                'only'         => [],
                'rules'        => [
                    [
                        'allow'   => true,
                        'actions' => ['index', 'registration'],
                        'roles'   => ['?'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['tasks/index']);
                },
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'landing';
        $loginForm = new LoginForm();


        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(Yii::$app->request->post());


            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($loginForm);
            }


            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                \Yii::$app->user->login($user);

                return $this->redirect(['tasks/index']);
            }
        }


        return $this->render('index', ['loginForm' => $loginForm,]);
    }


    public function actionRegistration()
    {
        $this->layout='registration';

        $regForm = new RegistrationForm();
        if (Yii::$app->request->post()) {
            $regForm->load(Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($regForm);
            }


            if ($regForm->validate()) {
                $registration = new RegistrationService();
                $registration->addUser($regForm);
                $this->redirect(['tasks/index']);
            }
        }


        return $this->render('registration', ['regForm' => $regForm]);
    }


}
