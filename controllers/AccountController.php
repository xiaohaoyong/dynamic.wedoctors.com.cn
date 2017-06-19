<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/19
 * Time: 上午9:29
 */

namespace app\controllers;


use app\models\doctor\Account;
use yii\data\ActiveDataProvider;

class AccountController extends CommonController
{
    public function actionList()
    {
        $query = Account::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => \Yii::$app->user->id,
        ]);
        $query->orderBy(['id'=>SORT_DESC]);

        $sum=$query->sum('money');

        return $this->render('list', [
            'list'=>$dataProvider,
            'sum'=>$sum?$sum:'0.00',
        ]);
    }

}