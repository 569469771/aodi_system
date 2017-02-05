<?php
header("Content-type: text/html; charset=utf-8");
var_dump($_POST);
$str='2016-11-16 20:03:20';

//时间戳
$times = strtotime($str);
var_dump($times); 


$str='2016年11月16日 20时03分20秒';
preg_match_all('/\d/',$str,$arr);
var_dump($arr);// die;
$timer=implode('',$arr[0]);
echo $timer.'</br>';
$timer=strtotime($timer);
// var_dump(date('Y-m-d H:i:s'));
echo $timer;