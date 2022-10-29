<?php
    $host = 'std-mysql';  //  имя  хоста
    $db   = 'std_1548_prbd'; // имя бд
    $user = 'std_1548_prbd'; //имя пользователя
    $pass = 'Aa123456'; //пароль к бд
    $charset = 'utf8'; //кодировка юникод (поддерживает кирилицу)
// формируем данные для одключения
// где mysql – название СУБД
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
//Формируем переменную со служебными характеристиками //подключения
    $opt = array ( PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                   PDO::ATTR_EMULATE_PREPARES   => false,);
//формируем подключение к БД
    $pdo = new PDO($dsn, $user, $pass, $opt);
?>