<?php
    setcookie('login','',time()-3600*24*30,"/phpProjects/project1");
    unset($_COOKIE['login']);// Удаление значение из массива куки
