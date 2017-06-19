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
use yii\data\Pagination;

class PointController extends CommonController
{
    public function actionList()
    {
        $query = Point::find();

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
                $point=$v->point>0?"+".$v->point:$v->point;

                $html.='<li class="box"><div class="box-flex wallet_left"><p class="f18">'.\app\models\doctor\Point::$sourceText[$v->source].'</p>

                <span class="f12">'.date('m/d  H:i',$v->createtime).'</span>
            </div>
            <div class="wallet_num f24"><span>'.$point.'</span></div>
        </li>';

            }

            return $html;
        }
        $sum=$query->sum('point');

        return $this->render('list', [
            'list'=>$dataProvider,
            'sum'=>$sum?$sum:'0.00',
        ]);
    }

}