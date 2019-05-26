<?php
$redis=include './conn.php';
$artid=$_GET['artid'];
$artDataKey = 'article:'.$artid;
$articleListKey = 'article_list';
$del=$redis->del($artDataKey);

$del2=$redis->zDelete($articleListKey,$artid);
header('location:index.php');

?>