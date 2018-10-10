<?php

namespace app\modules\api\controllers;

use common\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
        ];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['index', 'view', 'create', 'delete', 'update'],
            'rules' => [
                [
                    'actions' => ['index', 'create', 'delete', 'update'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        return \Yii::$app->user->identity->groups === 1;
                    }
                ],
                [
                    'actions' => ['view'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        return \Yii::$app->user->identity->getId() == \Yii::$app->request->get('id');
                    }
                ]
            ]
        ];
        return $behaviors;
    }

}