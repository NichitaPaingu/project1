<?php
$user='root';
$password='';
$port='3306';
$db='web-blog';
$host='localhost';

$dsn="mysql:host=$host;dbname=$db;port=$port;";
$pdo=new PDO($dsn,$user,$password);