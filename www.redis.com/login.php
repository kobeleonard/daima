<?php
session_start();
$redis = include './conn.php';
//$redis  = new Redis();

    if($_POST){
        if(false !=($id=$redis->get('user:'.$_POST['username']))){
            $hashuserKey = 'user:id:'.$id;
            $userInfo = $redis->hGetAll($hashuserKey);
            if($_POST['pwd']==$userInfo['pwd']){
                $_SESSION['userid']=$id;

//            $sendMailListKey='sendMailListKey';
//            $redis->lPush($sendMailListKey,'1246360293@qq.com');
                header('location:index.php');
            }
        }
    }





$redis->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>用户登录</title>
</head>
<body>
    <form method="post">
    <div>
        <label>
            账号: <input type="text" name="username" id="" />
        </label>
    </div>
    <div>
        <label>
            账号: <input type="text" name="pwd" id="" />
        </label>
    </div>
    <div>
        <input type="submit" value="登录系统" />
    </div>



    </form>
</body>
</html>