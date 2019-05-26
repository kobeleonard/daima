<?php
session_start();
$redis=include './conn.php';
include './Page.php';
$userid=$_SESSION['userid'];

$articleListKey = 'article_list';

$total=$redis->zCard($articleListKey);

$page=new Page($total,10);



$dataListId=$redis->zRange($articleListKey,$page->offset,$page->offset+1);


$dataListId2=$redis->zRevRange($articleListKey,0,-1);
//$dataListId2=$redis->zRange($articleListKey,$page->offset,$page->offset+1);



require 'index.html';


//echo $page->fpage();
$redis->close();

?>

