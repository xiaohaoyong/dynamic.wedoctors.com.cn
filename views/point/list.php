<?php
/* @var $user app\models\doctor\User */
use yii\helpers\Html;
$this->title="我的钱包";
$user=Yii::$app->user->identity;
?>
<div class="walletTop clearfix points">
    <p class="f15">我的积分</p>
    <div class="wallet_money f50"><?=$sum?></div>
</div>
<div class="walet_line clearfix f16">积分明细</div>
<ul class="wallet_list clearfix">
    <?php
    foreach($list->getModels() as $k=>$v) {
        ?>
        <li class="box">
            <div class="box-flex wallet_left">
                <p class="f18"><?=\app\models\doctor\Point::$sourceText[$v->source]?></p>

                <span class="f12"><?=date('m/d  H:i',$v->createtime)?></span>
            </div>
            <div class="wallet_num f24"><span><?=$v->point>0?"+".$v->point:$v->point?></span></div>
        </li>
        <?php
    }
    ?>
</ul>