<?php
$redis = include './conn.php';
$artid=$_GET['artid'];
$time=date("Y-m-d H:i:s",time());
$artDataKey = 'article:'.$artid;
$redis->hIncrBy($artDataKey,'hits',1);
$data=$redis->hGetAll($artDataKey);

$hot_article='host_article';
$hits = $data['hits'] ?? 0;
$redis->zAdd($hot_article,'hits',$artid);

require 'detail.html';
$redis->close();
?>



