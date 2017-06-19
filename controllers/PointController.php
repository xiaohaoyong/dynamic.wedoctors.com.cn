<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/19
 * Time: 上午9:29
 */

namespace app\controllers;


use app\models\doctor\Account;
use app\models\doctor\Point;
use yii\data\ActiveDataProvider;

class PointController extends CommonController
{
    public function actionList()
    {
        $query = Point::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => \Yii::$app->user->id,
        ]);
        $query->orderBy(['id'=>SORT_DESC]);

        $sum=$query->sum('point');

        return $this->render('list', [
            'list'=>$dataProvider,
            'sum'=>$sum?$sum:'0.00',
        ]);
    }

}