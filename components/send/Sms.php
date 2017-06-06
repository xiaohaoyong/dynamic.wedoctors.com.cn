<?php
namespace app\components\send;
use app\components\send\alidayu;

/**
 * 短信验证码类
 * 
 */
 
class Sms{
    /**
     *操作的手机号
     */
	protected $mobile ;
    /**
     * 在一定时间内 允许的最大次数
     */
	protected $maxCount;
    /**
     * 最大次数有效时间
     */
	protected $lifetime;
	
    /**
     * 两次验证码获取时间间隔
     */
    protected $interval ;
     
     /**
      * 一个手机号允许校验的次数
      */
    protected $maxValidateCount;
    
    /**
     *key前缀 
     */
    protected $keyprefix="X:sms";
    
    /**
     * 检验正确后失效
     */
    protected $invalidOnCheck;
    
	public function __construct($mobile,$maxCount = 10,$interval = 120 ,$lifetime=86400,$maxValidateCount = 10,$prefix='smslimit',$invalidOnCheck= false){
		$this->mobile   = $mobile;
		$this->maxCount = $maxCount; 
        $this->interval = $interval ;
		$this->lifetime = $lifetime;
        $this->maxValidateCount = $maxValidateCount;
        $this->keyprefix = $prefix;
        $this->invalidOnCheck = $invalidOnCheck;
	}
    
	/**
     * 发送短信验证码
     * @param $msg string 要发送的内容
     * @param $code int 发送的验证码
     * @param $mobile numeric 要发送的手机号，可选
     * @return mixed  1 发送成功  0 发送失败 -1 发送失败 超过限制次数 -2 获取时间小于时间间隔
     */
    
	public function send($msg="SMS_63950776",$code,$mobile=''){
		$mobile =$mobile ? $mobile :$this->mobile;
        $checkval = $this->check($mobile);
		if ( $checkval != 1 ) {
			return $checkval ; 
		}


        $c = new alidayu\top\TopClient();
        $c->appkey = '23785111';
        $c->secretKey = 'b98c1d4ee116f7f8316750542d49f914';
        $req = new alidayu\top\request\AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("拉手医生");
        $req->setSmsParam("{\"code\":\"".$code."\",\"product\":\"拉手医生\"}");
        $req->setRecNum((string)$mobile);
        $req->setSmsTemplateCode($msg);
        $resp = $c->execute($req);


		//$flag = Phone_send($this->mobile,'ask',$msg,'寻医问药网',1);
		if($resp=true){
			$this->save($code,$mobile);
		}
		return intval($resp);
	}
	
    /**
     * 检测手机号发送次数是否已超过最大次数
     * @param $mobile numeric 要判断的手机号
     * @return numeric -2 获取时间小于时间间隔 -1 超过最大次数  1 成功 
     */
	protected function check($mobile){
		$value = $this->get($mobile);
		if($value){
    	    if($value['time'] + $this->interval > time()){
                return -2;
    	    }
			return $value['count'] < $this->maxCount ? 1 : -1;
		}
		return 1;
	}
    
    /**
     * 保存短信验证码 (可重写)
     * @param $code int
     * @param $mobile numeric
     */
	protected function save($code,$mobile){
	    $redis=\Yii::$app->rdmp;
		$key = $this->keyprefix.$mobile;
		$data=array(
			'code'=>$code,
			'count'=>1,
            'check_count'=>0,
            'time' =>time(),
		);
		$curval = $this->get($mobile);
		if($curval){
			$data['count'] += $curval['count'];
		}
		$data = serialize($data);
		$redis->set($key,$data);
		$redis->expire($key,$this->lifetime);
		return true;
	}
	
    /**
     * 更新验证码缓存 (可重写)
     * @param numeric $mobile 
     * @param array $newvalue
     *  
     */
    protected function update($mobile,$newvalue){
        $redis=\Yii::$app->rdmp;
	    $key = $this->keyprefix.$mobile;
		$redis->set($key,serialize($newvalue));
 	    $redis->expire($key,$this->lifetime);
		return true;
    }
    
    
	/**
     * 获取保存的验证码
     * @param $mobile numeric
     * @return mixed 没有值返回 false 
     */
	protected function get($mobile){
        $redis=\Yii::$app->rdmp;
		$key = $this->keyprefix.$mobile;
		$value = $redis->get($key);
		if($value){
			return unserialize($value);
		}
		return false;
	}
	
	/**
     * 校验短信验证码
     * @param $code int 待校验的验证码
     * @param $mobile numeric 手机号 可选
     * @return boolean
     */
	public function validate($code,$mobile = ''){
		$mobile =$mobile ? $mobile :$this->mobile;
		$value  = $this->get($mobile);
        
        if($value['check_count'] >= $this->maxValidateCount) {
            return false;
        }
        $retval = false;
        if($code == $value['code']){
            if($this->invalidOnCheck){
                $value['code'] = null;
            }
            $retval = true;
        }
        $value['check_count']++;
        $this->update($mobile,$value);
        
		return $retval;
	}
}