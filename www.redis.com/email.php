<?php
set_time_limit(0);
$redis=include './conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

$sendMailListKey='sendMailListKey';

while (true){
    sleep(3);
    $email=$redis->rPop($sendMailListKey);
    if(!$email)continue;

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'stmp.qq.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '165899669@qq.com';                     // SMTP username
        $mail->Password   = 'xqgvwyxqpytjcgag';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465 ;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('1246360293@qq.com', 'kobe');
        $mail->addAddress('1246360293@qq.com', '小董');     // Add a recipient


        // Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '登录提示';
        $mail->Body    = '你好小董，你长得很帅</b>';
        $mail->AltBody = '好好学习小董';

        $mail->send();
//        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
