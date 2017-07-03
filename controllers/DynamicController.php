<?php

namespace app\controllers;

use app\models\doctor\User;
use Yii;
use app\models\dynamic\Dynamic;
use app\models\dynamic\DynamicSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DynamicController implements the CRUD actions for Dynamic model.
 */
class DynamicController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dynamic models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $user=User::findOne($id);

        $dynamic = Dynamic::find()->where(['userid'=>$id,'source'=>[4,5]])->orderBy('id desc')->all();

        return $this->render('index', [
            'user' => $user,
            'dynamic' => $dynamic
        ]);
    }
}
