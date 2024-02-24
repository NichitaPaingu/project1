<?php 

    $title=trim(filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS));   
    //фильтруем username ЕСЛИ ТАМ БУДЕТ HTML КОД
    //trim удаляет пробелы до и после 
    $anons=trim(filter_var($_POST['anons'],FILTER_SANITIZE_SPECIAL_CHARS));   
    $fullText=trim(filter_var($_POST['full_text'],FILTER_SANITIZE_SPECIAL_CHARS));   


    $error='';
    if(isset($title)&&strlen($title)<=5){
       $error='Введите название статьи';
    }else if(isset($anons)&&strlen($anons)<10){
        $error='Введите анонс статьи';
    }else if(isset($fullText)&&strlen($fullText)<10){
        $error='Введите текст для статьи';
    }
    
    if($error!=''){
        echo $error;
        exit();
    }

    require_once '../lib/mysql.php';


    $sql='INSERT INTO articles(title,anons,full_text,date,avtor) VALUES(?,?,?,?,?)';
    $querry=$pdo->prepare($sql);
    $querry->execute([$title,$anons,$fullText,time(),$_COOKIE['login']]);
    echo 'Done';