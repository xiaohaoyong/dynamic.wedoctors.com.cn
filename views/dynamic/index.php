<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dyv app\models\dynamic\Dynamic */
/* @var $dynamic app\models\dynamic\Dynamic */
$this->title=$user->info->name;

if($dynamic)
{
    foreach($dynamic as $k=>$dyv){
    if($dyv->source==4){
        $row=\app\models\dynamic\DySeminar::findOne($dyv->id);
    }
    if($dyv->source==5)
    {
        $row=\app\models\dynamic\DyOpen::findOne($dyv->id);
    }
    if($row){

        $doctor=app\models\doctor\User::findOne($row->userid);
    }
    $img=\app\models\dynamic\Dyimgs::findOne(['dynamicid'=>$dyv->id]);

?>
<div class="Article_list clearfix tc">
    <span class="Article_time f12"><?=date('Y-m-d H:i',$dyv->createtime)?></span>
    <a href="http://dynamic.wedoctors.com.cn/show/<?=$dyv->id?>" class="db Article_box clearfix">
        <h3 class="fn f18"><?=$row->title?></h3>
        <p class="f16 tl"><?=$doctor->info->hospital->name?><?=\app\models\doctor\UserInfo::$titleText[$doctor->info->title]?> <?=$doctor->info->name?></p>
        <div class="Article_Img pr">
            <img src="<?=$img->src?>" alt="<?=$row->title?>">
            <div class="Article_th f14"><?=$row->ftitle?></div>
        </div>
    </a>
</div>
<?php }}?>
