<?php 

    $username=trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));   
    //фильтруем username ЕСЛИ ТАМ БУДЕТ HTML КОД
    //trim удаляет пробелы до и после 
    $email=trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));   
    $login=trim(filter_var($_POST['login'],FILTER_SANITIZE_SPECIAL_CHARS));   
    $pass=trim(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));   


    $error='';
    if(isset($username)&&strlen($username)<=3){
       $error='Неправильное имя';
    }else if(isset($email)&&strlen($email)<6){
        $error='Неправильный email';
    }else if(isset($login)&&strlen($login)<8){
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
    $pass=md5($salt.$pass);//алгоритм кэширования 

    $sql='INSERT INTO users(name,email,login,password) VALUES(?,?,?,?)';
    $querry=$pdo->prepare($sql);
    $querry->execute([$username,$email,$login,$pass]);
    echo 'Done';