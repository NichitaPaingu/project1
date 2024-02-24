<?php 

$username=trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$email=trim(filter_var($_POST['email'],FILTER_SANITIZE_SPECIAL_CHARS));
$mess=trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));


$error="";
if(isset($username))
    $error="Вы не ввеливашего имени";
else if(isset($email))
    $error="Вы не ввели ваш email";
else if(isset($mess))
    $error="Вы не написали ваше сообщение";

if ($error!=""){
    echo $error;
    exit();
}

$to="nichitapaingu123@icloud.com";
$subject="=?utf-8?B?".base64_encode("Новое сообщение")."?=";
$message="Пользователь: $username.<br>$mess";
$headers="From: $email\r\nReply-to:$email\r\nContent-type:text/html;charset=utf-8\r\n";

mail($to,$subject,$message,$headers);
//кому отправляется, тема сообщения, основной текст сообщения, заголовки 

echo "Done";
