<?php
use yii\helpers\Html;
$this->title="注册"
?>
<div class="clearfix RegBox">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'js-reg-form',
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<p>{label}</p>\n<div class=\"box-flex\"> {input} </div>\n",
            'options' => ['class' => 'login_line box'],
        ],
    ]); ?>
        <div class="clearfix RegForm f16">
            <?= Html::activeHiddenInput($login,'openid',array('value'=>OPENID)) ?>
            <?=$form->field($info,'phone')->textInput(['placeholder' => '请输入手机号码','class'=>'f16 userName'])?>
            <?=$form->field($login,'password',[
                    'template' =>
                        "<p>{label}</p>\n<div class=\"box-flex\"> \n{input} \n<span class=\"login_passIcon js-pass-display\"></span>\n</div>"])->passwordInput(['placeholder' => '请输入登录密码','class'=>'f16 userPass'])?>

            <?=$form->field($code,'code',[
                'template' =>
                    "<p>{label}</p>\n<div class=\"box-flex\"> \n{input} \n</div><div><p class=\"reg_code f14 js-reg-send\">获取验证码</p></div>"])->textInput(['placeholder' => '请输入登录密码','class'=>'f16 userCode'])?>
            </div>
        </div>
    <?= \yii\helpers\Html::submitButton('注册', ['class'=>'Login_sub clearfix f16']) ?>
    <p class="Reg_agree f13 tc"><span>我已阅读并同意<a href="" target="_blank">《拉手医生用户协议》</a></span></p>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
<div class="user-bubble none f14">请输入真实姓名</div>
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