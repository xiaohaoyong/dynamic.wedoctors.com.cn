<?php
$dbName=[
    'mp'=>"MP",
    'chat'=>"MP"
];

define('REDISPREFIX','WEDOCTORSRV_RD_');
foreach($dbName as $k=>$v)
{
    $redis['rd'.$k]=[
        'class' => 'app\components\vendor\RedisConnection',
        'hostname' => $WEDOCTORCONFIG[REDISPREFIX."HOST_{$v}"],
        'port' => $WEDOCTORCONFIG[REDISPREFIX."PORT_{$v}"],
        'password' => $WEDOCTORCONFIG[REDISPREFIX."PASS_{$v}"],
        'database' => 0,
    ];
}
return $redis;
