<?php
/* @var $user app\models\doctor\User */
use yii\helpers\Html;
$this->title="我的钱包";
$user=Yii::$app->user->identity;
?>
<div class="walletTop clearfix">
    <p class="f15">我的资金(元)</p>
    <div class="wallet_money f50"><?=$sum?></div>
</div>
<div class="walet_line clearfix f16">绩效明细</div>
<ul class="wallet_list clearfix">
    <?php
    foreach($list->getModels() as $k=>$v) {
        ?>
        <li class="box">
            <div class="box-flex wallet_left">
                <p class="f18"><?=\app\models\doctor\Account::$sourceText[$v->source]?></p>

                <span class="f12"><?=date('m/d  H:i',$v->createtime)?></span>
            </div>
            <div class="wallet_num f24"><span><?=$v->money>0?"+".$v->money:$v->money?></span></div>
        </li>
        <?php
    }
    ?>
</ul>