<?php

namespace backend\controllers;

use backend\models\UserForm;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['*'],
                        'allow' => true,
                        // 'roles' => ['@'],
                        'roles' => ['admin', 'owner'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = (new \yii\db\Query())
            ->select([
                'id',
                'username',
                'first_name',
                'second_name',
                'last_name',
                'email',
                'status',
            ])
            ->from('user')
            ->all();

        // $user = new ActiveDataProvider([
        //     // 'query' => User::find(), 
        //     'query' => $user,
        // ]);

        $user = new ArrayDataProvider([
            'allModels' => $user,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', ['user' => $user]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne(['id' => $id]);
        if ($user) {
            $user->status = User::STATUS_DELETED;
            if ($user->save()) {
                Yii::$app->session->addFlash('success', 'Пользователь удален');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления пользователя');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Пользователь не найден');
        }
        return $this->redirect(['/user/index']);
    }

    public function actionRecovery($id)
    {
        $user = User::findOne(['id' => $id]);
        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                Yii::$app->session->addFlash('success', 'Пользователь востановлен');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка востановления пользователя');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Пользователь не найден');
        }
        return $this->redirect(['/user/index']);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne(['id' => $id]);
        $model = new UserForm();
        $model->username = $user->username;
        $model->email = $user->email;
        $model->first_name = $user->first_name;
        $model->second_name = $user->second_name;
        $model->last_name = $user->last_name;

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $roles_array = [];
        foreach ($roles as $key => $value) {
            switch ($key) {
                case 'admin':
                    $roles_array[$key] = 'администратор';
                    break;
                case 'owner':
                    $roles_array[$key] = 'владелец';
                    break;
                case 'user':
                    $roles_array[$key] = 'пользователь';
                    break;
                case 'content_manager':
                    $roles_array[$key] = 'контент менеджер';
                    break;
                case 'seo_manager':
                    $roles_array[$key] = 'сео менеджер';
                    break;
                default:
                    $roles_array[$key] = $key;
                    break;
            }
        }
        $roles = $auth->getRolesByUser($id);
        $model->roles = [];
        foreach ($roles as $key => $value) {
            $model->roles[] = $key;
        }
        return $this->render('update', [
            'model' => $model,
            'roles_array' => $roles_array,
        ]);
    }
}
