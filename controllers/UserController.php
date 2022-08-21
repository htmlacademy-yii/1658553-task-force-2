<?php

namespace app\controllers;

use app\models\forms\ChangePassForm;
use app\models\forms\ChooseRoleForm;
use app\models\forms\UserSettingsForm;
use app\models\Users;
use app\services\user\ChangePasswordService;
use app\services\user\ChooseRoleService;
use app\services\user\SuccessFailCountService;
use app\services\user\UserSettingsService;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => [],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index', 'view', 'settings','change-pass','role-choose'],
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $query = Users::find()->where("id = $id")->one();

        if (!$query) {
            throw new NotFoundHttpException('Пользователь не найден');
        }
        $successFailCount = new SuccessFailCountService();
        $successFailCount = $successFailCount->search($id);


        return $this->render('view', ['userInfo' => $query, 'successFailCount' => $successFailCount]);
    }

    public function actionSettings()
    {
        $userId = \Yii::$app->user->getId();
        $userInfo = Users::find()->where(['id' => $userId])->one();
        $userSettingsForm = new UserSettingsForm();
        if (\Yii::$app->request->post()) {
            $userSettingsForm->load(\Yii::$app->request->post());
            if ($userSettingsForm->validate()) {
                $userSettingsService = new UserSettingsService();
                $userSettingsService->submitChanges($userSettingsForm);
                $userInfo = Users::find()->where(['id' => $userId])->one();

                return $this->render('settings', ['userInfo' => $userInfo, 'userSettingsForm' => $userSettingsForm]);
            }
        }


        return $this->render('settings', ['userInfo' => $userInfo, 'userSettingsForm' => $userSettingsForm]);
    }

    public function actionChangePass()
    {
        $user = Users::find()->where(['id'=>Yii::$app->user->id])->one();
        $changePasswordForm = new ChangePassForm();
        if (Yii::$app->request->post()){
            $changePasswordForm->load(Yii::$app->request->post());
            if ($changePasswordForm->validate()){
                $changePasswordService = new ChangePasswordService();
                $changePasswordService->changePass($changePasswordForm);
                return Yii::$app->response->redirect(["user/settings"]);


            }
        }
        return $this->render('changePass',['changePasswordForm'=>$changePasswordForm,'user'=>$user]);
    }

    public function actionRoleChoose(){
        $chooseRoleForm = new ChooseRoleForm();
        if (\Yii::$app->request->post()){
            $chooseRoleForm->load(\Yii::$app->request->post());
            if ($chooseRoleForm->validate()){
                $chooseRoleService = new ChooseRoleService();
                $chooseRoleService->acceptRole($chooseRoleForm);
                return Yii::$app->response->redirect(['tasks/index']);
            }
        }
        return $this->render('roleChoose',['chooseRoleForm'=>$chooseRoleForm]);
    }
}
