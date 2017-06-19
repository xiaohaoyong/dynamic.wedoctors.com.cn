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
<ul class="wallet_list clearfix" id="wallet_list">
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
    <div class="f14 tc pt10 pb10 graydeep none Loading_box">加载中...</div>
    <input type="hidden" id="page" value="2">
<?php
$url=\yii\helpers\Url::to(['list']);
$jsform = <<< EOD
    var startX,startY,endX,endY;
    var scrollTopVal=0; //滑动请自行修改
    //假定接受手指触摸事件的Dom对象id是"touchBox"
    document.getElementById("wallet_list").addEventListener("touchstart", touchStart, false);
    document.getElementById("wallet_list").addEventListener("touchmove", touchMove, false);
    document.getElementById("wallet_list").addEventListener("touchend", touchEnd, false);
    function touchStart(event){
        var touch = event.touches[0];
        startY = touch.pageY;
    }
    var flag=false;
    //var page =2;
    function touchMove(event){
        var touch = event.touches[0];
        endY = (startY-touch.pageY);
        if(endY>10){
            var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
            if($('#wallet_list').height()-75 <= totalheight){
                $('.Loading_box').show();
                if(flag!=false){
                    return false;
                }
                flag = true;
                //ajax
                var page= $('#page').val();
                var js =new Date().getTime();
                $.get('$url?page='+page,function(data){
                    if(data!=0)
                    {
                        page=parseInt(page)+1;
                        $('#wallet_list').append(data);
                        $('#page').val(page);
                        flag = false;
                        $('.Loading_box').hide();
                    }else{
                        $('.Loading_box').html('没有更多了');
                    }

                });
            }
        }
    }
    function touchEnd(event){
        scrollTopVal=$("#wallet_list").scrollTop();
    }
EOD;
$js[]=$jsform;
$this->registerJs(implode("\n",$js));