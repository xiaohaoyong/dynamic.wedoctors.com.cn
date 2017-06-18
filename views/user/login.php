<?php
use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); $this->title="注册"?>
<div class="Login_logo clearfix">
    <img src="http://static.i.wedoctors.com.cn/login_logo.png" alt="">
</div>
<div class="clearfix LoginBox">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'js-reg-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<p>{label}</p>\n<div class=\"box-flex\"> {input} </div>\n",
            'options' => ['class' => 'login_line box'],
        ],
    ]); ?>
        <div class="clearfix LoginForm f16">
            <?=$form->field($model,'phone',[
                'template' =>
                    "<p>{label}</p>\n<div class=\"box-flex\"> \n{input} \n</div>"])->textInput(['placeholder' => '请输入手机号码','class'=>'f16 userPass'])?>
            <?=$form->field($model,'password',[
                'template' =>
                    "<p>{label}</p>\n<div class=\"box-flex\"> \n{input} \n<span class=\"login_passIcon js-pass-display\"></span>\n</div>"])->passwordInput(['placeholder' => '请输入登录密码','class'=>'f16 userPass'])?>
        </div>
    <?= \yii\helpers\Html::submitButton('登录', ['class'=>'Login_sub clearfix f16']) ?>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
    <p class="Login_forget f13 tc"><a href="">忘记密码</a></p>
</div>
<div class="Login_reg tc f16"><a href="<?=\yii\helpers\Url::to(['user/register'])?>">注册</a></div>
<div class="user-bubble none f14">请输入真实姓名</div>
<?php
//提示框
if(Yii::$app->getSession()->hasFlash('error')) {
    $js[]=' login_reg.tipsShow("'.Yii::$app->getSession()->getFlash('error').'");';
}
?>
<?php
$jsform = <<< EOD
$('#js-reg-form').on("afterValidate", function(event, messages, errorAttributes) {
   $('.help-block').hide();
    var is_push=true;
    var msg='';
    $.each(messages, function () {
        if(this[0] && is_push){
            msg+='<p class="alert-error">'+this[0]+'</p>';
            is_push=false;
        }
    });
    if(msg){
        login_reg.tipsShow(msg);
    }
});
EOD;
$js[]=$jsform;
$this->registerJs(implode("\n",$js));
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
