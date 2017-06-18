<?php
/* @var $user app\models\doctor\User */
use yii\helpers\Html;
$this->title="我的";
$user=Yii::$app->user->identity;
?>
<div class="mine_Infor clearfix mt20 bgfff">
    <a class="box db" >
        <div class="mine_docPic">
            <img src="<?=$user->info->avatar?>" alt="">
        </div>
        <div class="box-flex">
            <p class="mt5 clearfix"><span class="f18 fl"><?=$user->info->name?></span><span class="mine_Title mt03 f12 fl"><?=\app\models\doctor\UserInfo::$titleText[$user->info->title]?></span></p>
            <p class="f15 c9 mt5 clearfix"><?=$user->info->hospital->name?><span class="ml25"><?=\app\models\doctor\Subject::$subject[$user->info->subject_b]?></span></p>
        </div>
    </a>
</div>

<div class="bgfff mt25 clearfix mine_Box">
    <ul>
        <li class="new"><a href=""><span class="f16">钱包</span></a></li>
        <li class="mine_icon1"><a href=""><span class="f16">积分</span></a></li>
        <li class="mine_icon2"><a href=""><span class="f16">认证</span><b class="fr f14 c9 fn mr20">未认证</b></a></li>
    </ul>
</div>
<div class="bgfff mt25 clearfix mine_Box">
    <ul>
        <li class="mine_icon3"><a href=""><span class="f16">我的收藏</span></a></li>
        <li class="mine_icon4"><a href=""><span class="f16">学习记录</span></a></li>
    </ul>
</div>
<div class="bgfff mt25 clearfix mine_Box">
    <ul>
        <li class="mine_icon5"><a href=""><span class="f16">设置</span></a></li>
    </ul>
</div>
