<?php 

    $login=trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));   
    $pass=trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));   


    $error='';
   
    if(isset($login)&&strlen($login)<8){
        $error='Неправильный login';
    }else if(isset($pass)&&strlen($pass)<8){
        $error='Неправильный пароль';
    }
    
    if($error!=''){
        echo $error;
        exit();
    }

    require_once '../lib/mysql.php';

    $salt='asdafaewfq213#@$#$';//соль+пароль
    $pass=md5($salt . $pass);//алгоритм кэширования 

    $sql="SELECT id FROM users WHERE login=? AND password=? ";
    $querry=$pdo->prepare($sql);
    $querry->execute([$login,$pass]);

    if($querry->rowCount()==0){
        echo "Такого пользователя нет";
    }
    else{
        setcookie('login',$login,time()+3600*24*30,"/phpProjects/project1");
        echo 'Done';
    }