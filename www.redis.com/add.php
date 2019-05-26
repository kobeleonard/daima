<?php
session_start();
$redis=include './conn.php';
//$redis=new Redis();


if($_POST){
    //自增长id
    $artid=$redis->incr('articleid');

    //存储文章信息的key hash
    $artDataKey='article:'.$artid;
    //用户发表过的文章 set
    $userArticleKey = 'user_article_:'.$_SESSION['userid'];
    //文章列表集合 zset
    $articleListKey = 'article_list';

    $redis->hMset($artDataKey,$_POST);
    $redis->sAdd($userArticleKey,$artid);
    $redis->zAdd($articleListKey,$artid,$artid);

    header('location:index.php');
}

$redis->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加文章</title>
</head>
<body>
<form action="" method="post">

    <div>
        <label>
            账号: <input type="text" name="userid" id="" value="<?php echo $_SESSION['userid']?>"/>
        </label>
    </div>
    <div>
        <label>
            标题: <input type="text" name="title""/>
        </label>
    </div>
    <div>
        <label>
            内容: <textarea name="cnt" id="" cols="30" rows="10"></textarea>
        </label>
    </div>
    <div>
        <input type="submit" value="添加文章" />
    </div>

</form>
</body>
</html>
