<?php
var_dump($_SERVER['DOCUMENT_ROOT']);exit;
if($_POST) {
    var_dump($_FILES);exit;
    $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=i071-QQVXeO7oOoYmGsfNQ53eirx83sQJfPjsvMdBKP2oe3oujsMASn8GqkECw7V1Rcl3vYuXNfHNoEDtWSl3V9Xp9j5DlAKsRQikHYDcy8NorW7qFUKO1twiQT69TuMAAIfABAGGO&type=image";
    $ch1 = curl_init();
    $timeout = 5;
    $real_path = "{$_FILES['filename']}";
//$real_path=str_replace("/", "\\", $real_path);
    $data = array("media" => "@{$real_path}", 'form-data' => $_FILES);
    curl_setopt($ch1, CURLOPT_URL, $url);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch1);
    echo '<br/>';
    echo 'reulst is ==========>' . $result;
    curl_close($ch1);
    if (curl_errno($ch1) == 0) {
        $result = json_decode($result, true);
        //var_dump($result);
        echo  $result['media_id'];exit;
    }
    var_dump(curl_errno($ch1));exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="address=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>用户协议</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" >
    <input type="text" name="aa" value="123">
    <input type="file" name="dd">
    <input type="submit">
</form>
</body>
</html>
