<?php
$redis  = new Redis();

$redis->connect('47.75.217.82',6379,5);

$redis->auth('971110');

return $redis;
?>