<?php
$dbconfig=[
    'ARTICLE' =>'zx',
    'DYNAMIC' =>'dc',
    'OTHER'   =>'ud',
    'USER'    =>'us',
    'HANDBOOK'=>'sc',
    'ADMIN'   =>'ad',
];
$charsets['media']="utf8";
define('DBPREFIX','WEDOCTORSRV_DB_');
foreach($dbconfig as $k=>$v)
{
    $charset=$charsets[$v]?"charset=".$charsets[$v]:"";
    $db['db'.$v]=[
        'class' => 'yii\db\Connection',
        // 配置主服务器
        'dsn' => "mysql:host={$WEDOCTORCONFIG[DBPREFIX."HOST_M_{$k}"]};port={$WEDOCTORCONFIG[DBPREFIX."PORT_M_{$k}"]};dbname={$WEDOCTORCONFIG[DBPREFIX."NAME_M_{$k}"]};$charset",
        'username' => $WEDOCTORCONFIG[DBPREFIX."USER_M_{$k}"],
        'password' => $WEDOCTORCONFIG[DBPREFIX."PASS_M_{$k}"],
        // 配置从服务器
        'slaveConfig' => [
            'username' =>  $WEDOCTORCONFIG[DBPREFIX."USER_S_{$k}"],
            'password' =>  $WEDOCTORCONFIG[DBPREFIX."PASS_S_{$k}"],
            'attributes' => [
                // use a smaller connection timeout
                PDO::ATTR_TIMEOUT => 10,
            ],
        ],
        // 配置从服务器组
        'slaves' => [
            ['dsn' => "mysql:host={$WEDOCTORCONFIG[DBPREFIX."HOST_S_{$k}"]};port={$WEDOCTORCONFIG[DBPREFIX."PORT_S_{$k}"]};dbname={$WEDOCTORCONFIG[DBPREFIX."NAME_S_{$k}"]};$charset"],
        ],
    ];

}

return $db;
