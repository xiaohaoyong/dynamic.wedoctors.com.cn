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
            'pagination'=>['validatePage'=>false]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => \Yii::$app->user->id,
        ]);
        $query->orderBy(['id'=>SORT_DESC]);

        if(\Yii::$app->request->isAjax)
        {
            $html="";
            foreach($dataProvider->getModels() as $k=>$v)
            {
                $money=$v->money>0?"+".$v->money:$v->money;

                $html.='<li class="box"><div class="box-flex wallet_left"><p class="f18">'.\app\models\doctor\Account::$sourceText[$v->source].'</p>

                <span class="f12">'.date('m/d  H:i',$v->createtime).'</span>
            </div>
            <div class="wallet_num f24"><span>'.$money.'</span></div>
        </li>';

            }

            return $html;
        }

        $sum=$query->sum('money');

        return $this->render('list', [
            'list'=>$dataProvider,
            'sum'=>$sum?$sum:'0.00',
        ]);
    }

}